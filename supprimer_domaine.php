<!-- suppr_domaine.php -->
<?php
include("config.php");

// Vérifiez si un ID de domaine est fourni
if (isset($_GET['id_domaine'])) {
    $id_domaine = $_GET['id_domaine'];

    // Supprimer le domaine de la base de données
    $stmt = $db->prepare("DELETE FROM domaines WHERE ID = :id_domaine");
    $stmt->bindParam(':id_domaine', $id_domaine);
    $stmt->execute();

    echo "Domaine supprimé avec succès !";
} else {
    die("ID du domaine non fourni.");
}
?>
