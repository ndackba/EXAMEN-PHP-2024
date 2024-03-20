<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_memoire = $_POST['id_memoire'];
    $id_domaine = $_POST['id_domaine'];

    $stmt = $db->prepare("UPDATE memoires_domaines SET ID_Domaine = :id_domaine WHERE ID_Memoire = :id_memoire");
    $stmt->bindParam(':id_memoire', $id_memoire);
    $stmt->bindParam(':id_domaine', $id_domaine);
    $stmt->execute();

    echo "Association modifiée avec succès !";
}
?>
