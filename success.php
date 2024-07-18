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
            if (nav.classList.contains('active')) {
                nav.classList.remove('active');
            } else {
                nav.classList.add('active');
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
    <div class="menu-toggle" id="menu-toggle">&#9654;</div>

    <div id="sidebar">
        <a href="index.html" class="category" id="cat1">Accueil
            <div class="subcategories">
                <div>Sous-catégorie 1.1</div>
                <div>Sous-catégorie 1.2</div>
                <div>Sous-catégorie 1.3</div>
            </div>
        </a>
        <a href="idées.html" class="category" id="cat2">Des idées
            <div class="subcategories">
                <div>Sous-catégorie 2.1</div>
                <div>Sous-catégorie 2.2</div>
                <div>Sous-catégorie 2.3</div>
            </div>
        </a>
        <a href="#" class="category" id="cat3">contact
            <div class="subcategories">
                <div>Sous-catégorie 3.1</div>
                <div>Sous-catégorie 3.2</div>
                <div>Sous-catégorie 3.3</div>
            </div>
        </a>
        <a href="#" class="category" id="cat4">Catégorie 4
            <div class="subcategories">
                <div>Sous-catégorie 4.1</div>
                <div>Sous-catégorie 4.2</div>
                <div>Sous-catégorie 4.3</div>
            </div>
        </a>
    </div>
</body>
</html>

