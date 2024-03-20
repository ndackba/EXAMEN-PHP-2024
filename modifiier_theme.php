<!-- modif_theme.php -->
<?php
include("config.php");

// Vérifiez si un ID de thème est fourni
if (isset($_GET['id_theme'])) {
    $id_theme = $_GET['id_theme'];

    // Récupérer les informations du thème à modifier depuis la base de données
    $stmt = $db->prepare("SELECT * FROM themes WHERE ID = :id_theme");
    $stmt->bindParam(':id_theme', $id_theme);
    $stmt->execute();
    $theme = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mettez à jour les informations du thème dans la base de données
        $nom_theme = $_POST['nom_theme'];
        $stmt = $db->prepare("UPDATE themes SET NomTheme = :nom_theme WHERE ID = :id_theme");
        $stmt->bindParam(':nom_theme', $nom_theme);
        $stmt->bindParam(':id_theme', $id_theme);
        $stmt->execute();

        echo "Thème modifié avec succès !";
    }
} else {
    die("ID du thème non fourni.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de Thème</title>
</head>
<body>
    <h2>Modification de Thème</h2>
    <form action="modif_theme.php?id_theme=<?= $theme['ID']; ?>" method="post">
        <label for="nom_theme">Nom du Thème :</label>
        <input type="text" id="nom_theme" name="nom_theme" value="<?= $theme['NomTheme']; ?>" required><br>

        <button type="submit">Modifier Thème</button>
    </form>
</body>
</html>
