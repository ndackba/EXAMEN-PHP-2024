<!-- modifier_utilisateur.php -->
<?php
include("config.php");

// Assurez-vous que vous avez reçu un ID d'utilisateur à modifier
if (!isset($_GET['id'])) {
    die("ID d'utilisateur non spécifié.");
}

$id_utilisateur = $_GET['id'];

// Récupérez les informations de l'utilisateur à partir de la base de données
$stmt = $db->prepare("SELECT * FROM utilisateurs WHERE ID = :id_utilisateur");
$stmt->bindParam(':id_utilisateur', $id_utilisateur);
$stmt->execute();
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$utilisateur) {
    die("Utilisateur non trouvé.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $type_utilisateur = $_POST['type_utilisateur'];

    // Mettez à jour les données dans la base de données
    $stmt = $db->prepare("UPDATE utilisateurs SET NomUtilisateur = :nom_utilisateur, MotDePasse = :mot_de_passe, TypeUtilisateur = :type_utilisateur WHERE ID = :id_utilisateur");
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':type_utilisateur', $type_utilisateur);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->execute();

    echo "Utilisateur modifié avec succès !";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
</head>
<body>
    <h2>Modifier Utilisateur</h2>
    <form action="modifier_utilisateur.php?id=<?php echo $id_utilisateur; ?>" method="post">
        <label for="nom_utilisateur">Nom d'utilisateur :</label>
        <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?php echo $utilisateur['NomUtilisateur']; ?>" required><br>

        <label for="mot_de_passe">Nouveau mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe"><br>

        <label for="type_utilisateur">Type d'utilisateur :</label>
        <select id="type_utilisateur" name="type_utilisateur" required>
            <option value="Administrateur" <?php echo ($utilisateur['TypeUtilisateur'] === 'Administrateur') ? 'selected' : ''; ?>>Administrateur</option>
            <option value="Etudiant" <?php echo ($utilisateur['TypeUtilisateur'] === 'Etudiant') ? 'selected' : ''; ?>>Etudiant</option>
        </select><br>

        <button type="submit">Modifier Utilisateur</button>
    </form>
</body>
</html>
