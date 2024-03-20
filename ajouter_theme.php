<!-- ajout_theme.php -->
<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_theme = $_POST['nom_theme'];

    // Insérer le thème dans la base de données
    $stmt = $db->prepare("INSERT INTO themes (NomTheme) VALUES (:nom_theme)");
    $stmt->bindParam(':nom_theme', $nom_theme);
    $stmt->execute();

    echo "Thème ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Thème</title>
</head>
<body>
    <h2>Ajout de Thème</h2>
    <form action="ajouter_theme.php" method="post">
        <label for="nom_theme">Nom du Thème :</label>
        <input type="text" id="nom_theme" name="nom_theme" required><br>

        <button type="submit">Ajouter Thème</button>
    </form>
</body>
</html>
