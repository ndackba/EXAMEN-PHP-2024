<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_memoire = $_POST['id_memoire'];
    $id_theme = $_POST['id_theme'];

    $stmt = $db->prepare("UPDATE memoires_themes SET ID_Theme = :id_theme WHERE ID_Memoire = :id_memoire");
    $stmt->bindParam(':id_memoire', $id_memoire);
    $stmt->bindParam(':id_theme', $id_theme);
    $stmt->execute();

    echo "Association modifiée avec succès !";
}
?>
