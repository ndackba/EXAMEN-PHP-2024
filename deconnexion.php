<?php
// deconnexion.php

session_start();
session_unset();
session_destroy();

// Redirigez vers la page de connexion après la déconnexion
header("Location: connexion.php");
exit();
?>
