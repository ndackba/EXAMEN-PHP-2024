<?php
// consulter_memoires.php
include("navbar.php");
include("config.php");

// Récupérer la liste des mémoires depuis la base de données
$stmt = $db->query("SELECT memoires.*, GROUP_CONCAT(themes.NomTheme) AS themes, GROUP_CONCAT(domaines.NomDomaine) AS domaines FROM memoires
                   LEFT JOIN memoires_themes ON memoires.ID = memoires_themes.memoire_id
                   LEFT JOIN themes ON memoires_themes.theme_id = themes.ID
                   LEFT JOIN memoires_domaines ON memoires.ID = memoires_domaines.memoire_id
                   LEFT JOIN domaines ON memoires_domaines.domaine_id = domaines.ID
                   GROUP BY memoires.ID");
$memoires = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer la liste des thèmes et des domaines depuis la base de données
$stmtThemes = $db->query("SELECT * FROM themes");
$themes = $stmtThemes->fetchAll(PDO::FETCH_ASSOC);

$stmtDomaines = $db->query("SELECT * FROM domaines");
$domaines = $stmtDomaines->fetchAll(PDO::FETCH_ASSOC);

// Filtrer les mémoires par thème et/ou domaine si des filtres sont appliqués
if (isset($_GET['theme']) && $_GET['theme'] !== 'all') {
    $themeFiltre = $_GET['theme'];
    $stmtTheme = $db->prepare("SELECT * FROM memoires WHERE id IN (SELECT memoire_id FROM memoires_themes WHERE theme_id = ?)");
    $stmtTheme->execute([$themeFiltre]);
    // Vérifier le nombre de résultats
    $rowCountTheme = $stmtTheme->rowCount();
    echo "Nombre de mémoires trouvées par thème : " . $rowCountTheme;
    $memoires = $stmtTheme->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['domaine']) && $_GET['domaine'] !== 'all') {
    $domaineFiltre = $_GET['domaine'];
    $stmtDomaine = $db->prepare("SELECT * FROM memoires WHERE id IN (SELECT memoire_id FROM memoires_domaines WHERE domaine_id = ?)");
    $stmtDomaine->execute([$domaineFiltre]);
    // Vérifier le nombre de résultats
    $rowCountDomaine = $stmtDomaine->rowCount();
    echo "Nombre de mémoires trouvées par domaine : " . $rowCountDomaine;
    $memoires = $stmtDomaine->fetchAll(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <title>Consulter les Mémoires</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Consulter les Mémoires</h2>

    <!-- Ajouter des filtres par thème et domaine -->
    <form method="get" action="consulter_memoires.php">
        <label for="theme">Filtrer par thème :</label>
        <select name="theme" id="theme">
            <option value="all">Tous les thèmes</option>
            <?php foreach ($themes as $theme): ?>
                <option value="<?= $theme['ID']; ?>"><?= $theme['NomTheme']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="domaine">Filtrer par domaine :</label>
        <select name="domaine" id="domaine">
            <option value="all">Tous les domaines</option>
            <?php foreach ($domaines as $domaine): ?>
                <option value="<?= $domaine['ID']; ?>"><?= $domaine['NomDomaine']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Filtrer">
    </form>

        <div class="container mt-5">
            <h2>Consulter les Mémoires</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Thèmes</th>
                        <th scope="col">Domaines</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle PHP pour afficher les mémoires -->
                    <?php foreach ($memoires as $memoire): ?>
                        <tr>
                            <td><?= $memoire['titre']; ?></td>
                            <td><?= $memoire['description']; ?></td>
                            <td><?= isset($memoire['themes']) ? $memoire['themes'] : 'Aucun thème'; ?></td>
                            <td><?= isset($memoire['domaines']) ? $memoire['domaines'] : 'Aucun domaine'; ?></td>
                            <td><a href="telecharger_memoire.php?id=<?= $memoire['id']; ?>" class="btn btn-primary">Télécharger</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

</body>
</html>