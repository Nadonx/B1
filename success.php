<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="index2.css">
    <script>
        function toggleMenu() {
            var nav = document.getElementById('side-nav');
            if (nav.style.display === 'block') {
                nav.style.display = 'none';
            } else {
                nav.style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-right">
                <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="settings.php" class="settings-link">
                    <img src="settings-icon.png" alt="Settings" class="settings-icon">
                </a>
                <a href="logout.php" class="logout-button">Déconnexion</a>
            </div>
        </div>
    </header>
    <div class="main-content">
        <!-- Main content goes here -->
    </div>
    <div class="welcome-container">
        <h2>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !</h2>
        <p class="success-message">Vous êtes connecté avec succès.</p>
    </div>
    <div class="menu-toggle" onclick="toggleMenu()"></div>
    <div id="side-nav" class="side-nav">
        <a href="#">Accueil</a>
        <a href="#">Médicaments</a>
        <a href="#">Paramètres</a>
        <a href="logout.php">Déconnexion</a>
    </div>
</body>
</html>

