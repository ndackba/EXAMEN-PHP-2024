<!-- dashboard.php -->
<?php
session_start();
include 'navbar.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tableau de Bord</title>
    <style>
        body {
            padding: 20px;
        }

        .background-image {
            background-image: url('images/img memoire/img1.jpeg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Bienvenue sur le Tableau de Bord</h2>
    <p>Utilisateur connecté : <?php echo $_SESSION['username']; ?></p>
    
    <div class="background-image">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Consulter les Mémoires</h5>
                        <p class="card-text">Consultez la liste des mémoires disponibles.</p>
                        <a href="consulter_memoires.php" class="btn btn-primary">Consulter</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter une Mémoire</h5>
                        <p class="card-text">Ajoutez une nouvelle mémoire à la base de données.</p>
                        <a href="ajouter_memoire.php" class="btn btn-primary">Ajouter</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inscription</h5>
                        <p class="card-text">Cliquez pour vous inscrire.</p>
                        <a href="ajouter_utilisateur.php" class="btn btn-primary">Inscription</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gérer le Compte</h5>
                        <p class="card-text">Modifiez votre compte utilisateur.</p>
                        <a href="liste_utilisateurs.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Votre script JavaScript personnalisé ici -->


<br>
    <a href="deconnexion.php">Se Déconnecter</a>
    <!-- Ajoutez ici le reste du contenu du tableau de bord -->
</body>
</html>
