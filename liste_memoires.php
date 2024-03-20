<!-- liste_memoires.php -->
<?php
// Inclure le fichier de configuration
include("config.php");

// Récupérer la liste des mémoires depuis la base de données
$stmt = $db->query("SELECT * FROM memoires");
$memoires = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Mémoires</title>
</head>
<body>
    <h2>Liste des Mémoires</h2>

    <?php foreach ($memoires as $memoire): ?>
        <div>
            <h3><?= $memoire['titre']; ?></h3>
            <p><?= $memoire['description']; ?></p>
            <a href="telecharger_memoire.php?id=<?= $memoire['id']; ?>">Télécharger</a>
        </div>
    <?php endforeach; ?>
</body>
</html>
