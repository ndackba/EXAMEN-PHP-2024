<!-- config.php -->
<?php
$host = 'localhost'; // Adresse du serveur de base de données
$dbname = 'db_memoire'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur de la base de données
$password = ''; // Mot de passe de la base de données

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    die();
}
?>
