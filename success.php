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
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-left">
                <nav>
                    <ul class="nav-links">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Médicaments</a></li>
                    </ul>
                </nav>
            </div>
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
        <div class="welcome-container">
            <h2>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !</h2>
            <p class="success-message">Vous êtes connecté avec succès.</p>
        </div>
    </div>
</body>
</html>

