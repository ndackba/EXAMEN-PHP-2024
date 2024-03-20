<?php
include("navbar.php");
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement du formulaire d'ajout de mémoire
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $fichier = $_FILES['fichier']['name'] ?? '';
    $fichier_temp = $_FILES['fichier']['tmp_name'] ?? '';
    $id_etudiant = $_POST['id_etudiant'] ?? '';

    move_uploaded_file($fichier_temp, "C:/xampp/htdocs/gestion_memoire/{$fichier}");

    try {
        // Insérez les données dans la table "memoires"
        $stmt = $db->prepare("INSERT INTO memoires (titre, description, fichier, ID) VALUES (:titre, :description, :fichier, :id_etudiant)");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':fichier', $fichier);
        $stmt->bindParam(':id_etudiant', $id_etudiant);
        $stmt->execute();

        // Récupérez l'ID de la mémoire nouvellement insérée
        $id_memoire = $db->lastInsertId();

        // Associez la mémoire aux thèmes sélectionnés
        if (!empty($_POST['themes'])) {
            foreach ($_POST['themes'] as $theme) {
                $stmt = $db->prepare("INSERT INTO memoires_themes (memoire_id, theme_id) VALUES (:memoire_id, :theme_id)");
                $stmt->bindParam(':memoire_id', $id_memoire);
                $stmt->bindParam(':theme_id', $theme);
                $stmt->execute();
            }
        }

        // Associez la mémoire aux domaines sélectionnés
        if (!empty($_POST['domaines'])) {
            foreach ($_POST['domaines'] as $domaine) {
                $stmt = $db->prepare("INSERT INTO memoires_domaines (memoire_id, domaine_id) VALUES (:memoire_id, :domaine_id)");
                $stmt->bindParam(':memoire_id', $id_memoire);
                $stmt->bindParam(':domaine_id', $domaine);
                $stmt->execute();
            }
        }


        // Rediriger après l'ajout
        header('Location: consulter_memoires.php');
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la mémoire : " . $e->getMessage();
    }
}

// Récupérez la liste des thèmes et domaines depuis la base de données
$themes = $db->query("SELECT * FROM themes")->fetchAll(PDO::FETCH_ASSOC);
$domaines = $db->query("SELECT * FROM domaines")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de Mémoire</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Ajout de Mémoire</h2>
        <form action="ajouter_memoire.php" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="fichier">Fichier :</label>
                <input type="file" id="fichier" name="fichier" class="form-control-file" accept=".pdf, .doc, .docx" required>
            </div>

            <div class="form-group">
                <label for="id_etudiant">Code Étudiant :</label>
                <input type="text" id="id_etudiant" name="id_etudiant" class="form-control" required>
            </div>

            <!-- Champs pour les thèmes (ajout) -->
            <div class="form-group">
                <label for="themes">Thèmes :</label>
                <select id="themes" name="themes[]" class="form-control" multiple>
                    <?php foreach ($themes as $theme): ?>
                        <option value="<?= $theme['ID']; ?>"><?= $theme['NomTheme']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Champs pour les domaines (ajout) -->
            <div class="form-group">
                <label for="domaines">Domaines :</label>
                <select id="domaines" name="domaines[]" class="form-control" multiple>
                    <?php foreach ($domaines as $domaine): ?>
                        <option value="<?= $domaine['ID']; ?>"><?= $domaine['NomDomaine']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter Mémoire</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
