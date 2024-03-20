<!-- ajouter_utilisateur.php -->
<?php
include("navbar.php");  
include("config.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $type_utilisateur = $_POST['type_utilisateur'];
    $id_etudiant = $_POST[ 'ID' ];

    // Insérer les données dans la base de données
    $stmt = $db->prepare("INSERT INTO utilisateurs (NomUtilisateur, MotDePasse, TypeUtilisateur, ID) VALUES (:nom_utilisateur, :mot_de_passe, :type_utilisateur, :ID)");
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':type_utilisateur', $type_utilisateur);
    $stmt->bindParam(':ID', $id_etudiant);
    $stmt->execute();

    echo "Utilisateur ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Utilisateur</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Ajouter Utilisateur</h2>
    <form action="dashboard.php" method="post" class="mt-4">
        <div class="form-group">
            <label for="nom_utilisateur">Nom d'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="type_utilisateur">Type d'utilisateur :</label>
            <select id="type_utilisateur" name="type_utilisateur" class="form-control" required>
                <option value="Administrateur">Administrateur</option>
                <option value="Etudiant">Etudiant</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter Utilisateur</button>
    </form>
</div>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
