<!-- suppr_theme.php -->
<?php
include("config.php");

// Vérifiez si un ID de thème est fourni
if (isset($_GET['id_theme'])) {
    $id_theme = $_GET['id_theme'];

    // Supprimer le thème de la base de données
    $stmt = $db->prepare("DELETE FROM themes WHERE ID = :id_theme");
    $stmt->bindParam(':id_theme', $id_theme);
    $stmt->execute();

    echo "Thème supprimé avec succès !";
} else {
    die("ID du thème non fourni.");
}
?>
