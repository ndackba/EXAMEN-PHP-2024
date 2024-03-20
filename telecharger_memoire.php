<!-- telecharger_memoire.php -->
<?php
// Inclure le fichier de configuration
include("config.php");

// Récupérer l'ID du mémoire à télécharger depuis l'URL
$id_memoire = $_GET['id'];

// Récupérer les informations du mémoire depuis la base de données
$stmt = $db->prepare("SELECT * FROM memoires WHERE id = :id");
$stmt->bindParam(':id', $id_memoire);
$stmt->execute();
$memoire = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le mémoire existe
if (!$memoire) {
    die("Mémoire non trouvé.");
}

// Mettez en œuvre la logique de téléchargement ici (par exemple, envoyer le fichier au navigateur)
$chemin_fichier = "C:/xampp/htdocs/gestion_memoire/" . $memoire['fichier'];

// Assurez-vous que le fichier existe
if (file_exists($chemin_fichier)) {
    // Configuration des en-têtes pour indiquer qu'il s'agit d'un fichier à télécharger
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($chemin_fichier) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($chemin_fichier));

    // Lire le fichier et le transmettre au navigateur
    readfile($chemin_fichier);

    // Terminer l'exécution du script après le téléchargement
    exit;
} else {
    // Si le fichier n'existe pas, affichez un message d'erreur
    die("Fichier non trouvé.");
}


// Ensuite, rediriger l'utilisateur vers la liste des mémoires
header("Location: liste_memoires.php");
exit();
?>
