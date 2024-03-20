<!-- ajout_domaine.php -->
<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_domaine = $_POST['nom_domaine'];

    // Insérer le domaine dans la base de données
    $stmt = $db->prepare("INSERT INTO domaines (NomDomaine) VALUES (:nom_domaine)");
    $stmt->bindParam(':nom_domaine', $nom_domaine);
    $stmt->execute();

    echo "Domaine ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Domaine</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Ajout de Domaine</h2>
        <form action="ajouter_domaine.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="nom_domaine">Nom du Domaine :</label>
                <input type="text" id="nom_domaine" name="nom_domaine" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter Domaine</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

