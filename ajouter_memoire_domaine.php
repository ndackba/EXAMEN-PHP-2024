<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memoire_id = $_POST['memoire_id'];
    $domaine_id = $_POST['domaine_id'];

    // Insertion dans la table de liaison memoires_domaines
    $stmt = $db->prepare("INSERT INTO memoires_domaines (memoire_id, domaine_id) VALUES (:memoire_id, :domaine_id)");
    $stmt->bindParam(':memoire_id', $memoire_id);
    $stmt->bindParam(':domaine_id', $domaine_id);
    $stmt->execute();

    echo "Domaine ajouté à la mémoire avec succès !";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Domaine à Mémoire</title>
</head>
<body>
    <h2>Ajout de Domaine à Mémoire</h2>
    <form action="ajouter_memoire_domaine.php" method="post">
        <label for="memoire_id">ID de la Mémoire :</label>
        <input type="text" id="memoire_id" name="memoire_id" required><br>

        <label for="domaine_id">ID du Domaine :</label>
        <input type="text" id="domaine_id" name="domaine_id" required><br>

        <button type="submit">Ajouter Domaine à Mémoire</button>
    </form>
</body>
</html>
