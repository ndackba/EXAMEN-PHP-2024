<?php
// Inclure le fichier de configuration
include("navbar.php");
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $type_utilisateur = $_POST['type_utilisateur'];

    // Insérer les données dans la base de données
    $stmt = $db->prepare("INSERT INTO utilisateurs (NomUtilisateur, MotDePasse, TypeUtilisateur) VALUES (:nom_utilisateur, :mot_de_passe, :type_utilisateur)");
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':type_utilisateur', $type_utilisateur);
    $stmt->execute();

    echo "Utilisateur ajouté avec succès !";
}

// Récupérer la liste des utilisateurs depuis la base de données
$stmt = $db->query("SELECT * FROM utilisateurs");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <title>Liste des Utilisateurs</title>
</head>
<body>
    <h2>Liste des Utilisateurs</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom d'Utilisateur</th>
            <th>Type d'Utilisateur</th>
            <th>Action</th>
        </tr>
        
        <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <td><?= $utilisateur['ID']; ?></td>
                <td><?= $utilisateur['NomUtilisateur']; ?></td>
                <td><?= $utilisateur['TypeUtilisateur']; ?></td>
                <td>
                    <!-- Ajoutez ici des liens pour modifier ou supprimer un utilisateur -->
                    <a href="modifier_utilisateur.php?id=<?= $utilisateur['ID']; ?>">Modifier</a>
                    <a href="supprimer_utilisateur.php?id=<?= $utilisateur['ID']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
