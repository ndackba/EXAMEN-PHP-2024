<?php
// process_login.php

// Démarrez la session
session_start();

// Vérifiez les informations de connexion (remplacez ceci par votre logique d'authentification réelle)
$correct_username = "ndack";
$correct_password = "ba";

if ($_POST['username'] === $correct_username && $_POST['password'] === $correct_password) {
    // Authentification réussie, stockez l'identifiant de l'utilisateur dans la session
    $_SESSION['username'] = $_POST['username'];
    // Redirigez vers la page appropriée
    header("Location: dashboard.php");
    exit();
} else {
    // Authentification échouée, redirigez vers la page de connexion avec un message d'erreur
    header("Location: index.php?error=1");
    exit();
}
?>
