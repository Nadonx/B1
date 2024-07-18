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

    <div id="sidebar" class="side-nav">
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
        <a href="#" class="category" id="cat3">Contact
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menu-toggle');

            menuToggle.addEventListener('click', function () {
                if (sidebar.style.right === '0px' || sidebar.style.right === '') {
                    sidebar.style.right = '-250px';
                    menuToggle.style.right = '0';
                } else {
                    sidebar.style.right = '0';
                    menuToggle.style.right = '250px';
                }
            });

            const categories = document.querySelectorAll('.category');

            categories.forEach(category => {
                category.addEventListener('mouseover', function () {
                    this.querySelector('.subcategories').style.display = 'block';
                });

                category.addEventListener('mouseout', function () {
                    this.querySelector('.subcategories').style.display = 'none';
                });
            });
        });
    </script>
</body>
</html>

