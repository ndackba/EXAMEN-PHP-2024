<!-- modif_domaine.php -->
<?php
include("config.php");

// Vérifiez si un ID de domaine est fourni
if (isset($_GET['id_domaine'])) {
    $id_domaine = $_GET['id_domaine'];

    // Récupérer les informations du domaine à modifier depuis la base de données
    $stmt = $db->prepare("SELECT * FROM domaines WHERE ID = :id_domaine");
    $stmt->bindParam(':id_domaine', $id_domaine);
    $stmt->execute();
    $domaine = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mettez à jour les informations du domaine dans la base de données
        $nom_domaine = $_POST['nom_domaine'];
        $stmt = $db->prepare("UPDATE domaines SET NomDomaine = :nom_domaine WHERE ID = :id_domaine");
        $stmt->bindParam(':nom_domaine', $nom_domaine);
        $stmt->bindParam(':id_domaine', $id_domaine);
        $stmt->execute();

        echo "Domaine modifié avec succès !";
    }
} else {
    die("ID du domaine non fourni.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de Domaine</title>
</head>
<body>
    <h2>Modification de Domaine</h2>
    <form action="modif_domaine.php?id_domaine=<?= $domaine['ID']; ?>" method="post">
        <label for="nom_domaine">Nom du Domaine :</label>
        <input type="text" id="nom_domaine" name="nom_domaine" value="<?= $domaine['NomDomaine']; ?>" required><br>

        <button type="submit">Modifier Domaine</button>
    </form>
</body>
</html>
