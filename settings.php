<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$host = '127.0.0.1';
$db   = 'users';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $current_username = $_SESSION['username'];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        if (isset($_POST['update'])) {
            $stmt = $pdo->prepare("UPDATE users SET nom = ?, mdp = ? WHERE nom = ?");
            $stmt->execute([$new_username, $new_password, $current_username]);
            $_SESSION['username'] = $new_username;
            $message = "Mise à jour réussie.";
        }

        if (isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE nom = ?");
            $stmt->execute([$current_username]);
            session_destroy();
            header('Location: index.php');
            exit;
        }

    } catch (\PDOException $e) {
        echo 'Erreur PDO : ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres du compte</title>
    <link rel="stylesheet" href="index2.css">
    <link rel="stylesheet" href="settings.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-right">
                <a href="success.php" class="home-link">Accueil  </a>
                <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="settings.php" class="settings-link">
                    <img src="settings-icon.png" alt="Settings" class="settings-icon">
                </a>
                <a href="logout.php" class="logout-button">Déconnexion</a>
            </div>
        </div>
    </header>
    <div class="container2">
        <div class="form-container2">
            <h2>Paramètres du compte</h2>
            <?php if (!empty($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="settings.php" method="post">
                <div class="input-group">
                    <label for="new_username">Nouveau nom d'utilisateur</label>
                    <input type="text" id="new_username" name="new_username" required>
                </div>
                <div class="input-group">
                    <label for="new_password">Nouveau mot de passe</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <button type="submit" name="update">Mettre à jour</button>
                <button type="submit" name="delete" class="delete-button" onclick="return confirm('Voulez-vous vraiment supprimer votre compte ?');">Supprimer le compte</button>
            </form>
        </div>
    </div>
</body>
</html>
