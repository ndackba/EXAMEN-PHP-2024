<!-- suppression_memoire.php -->
<?php
// Assurez-vous que l'utilisateur est un administrateur avant d'accéder à cette page
// Vous pouvez implémenter cette vérification en fonction de votre système d'authentification
// ...

// Récupérez l'identifiant de la mémoire à supprimer depuis la requête GET
include("config.php");

$id_memoire = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous que la connexion est établie correctement
    if ($db !== null) {
        // ... le reste de votre logique de suppression
    } else {
        echo "Erreur de connexion à la base de données.";
    }
}

?>

