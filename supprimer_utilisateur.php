<!-- supprimer_utilisateur.php -->
<?php
include("config.php");

// Assurez-vous que vous avez reçu un ID d'utilisateur à supprimer
if (!isset($_GET['id'])) {
    die("ID d'utilisateur non spécifié.");
}

$id_utilisateur = $_GET['id'];

// Récupérez les informations de l'utilisateur à partir de la base de données
$stmt = $db->prepare("SELECT * FROM utilisateurs WHERE ID = :id_utilisateur");
$stmt->bindParam(':id_utilisateur', $id_utilisateur);
$stmt->execute();
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    die("Utilisateur non trouvé.");
}

// Supprimez l'utilisateur de la base de données
$stmt = $db->prepare("DELETE FROM utilisateurs WHERE ID = :id_utilisateur");
$stmt->bindParam(':id_utilisateur', $id_utilisateur);
$stmt->execute();

echo "Utilisateur supprimé avec succès !";
?>
