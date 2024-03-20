<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memoire_id = $_POST['memoire_id'];
    $theme_id = $_POST['theme_id'];

    // Insertion dans la table de liaison memoires_themes
    $stmt = $db->prepare("INSERT INTO memoires_themes (memoire_id, theme_id) VALUES (:memoire_id, :theme_id)");
    $stmt->bindParam(':memoire_id', $memoire_id);
    $stmt->bindParam(':theme_id', $theme_id);
    $stmt->execute();

    echo "Thème ajouté à la mémoire avec succès !";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Thème à Mémoire</title>
</head>
<body>
    <h2>Ajout de Thème à Mémoire</h2>
    <form action="ajouter_memoire_theme.php" method="post">
        <label for="memoire_id">ID de la Mémoire :</label>
        <input type="text" id="memoire_id" name="memoire_id" required><br>

        <label for="theme_id">ID du Thème :</label>
        <input type="text" id="theme_id" name="theme_id" required><br>

        <button type="submit">Ajouter Thème à Mémoire</button>
    </form>
</body>
</html>