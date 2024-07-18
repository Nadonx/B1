<?php
session_start();

$host = getenv('host');
$db   = getenv('db');
$user = getenv('user');
$pass = getenv('pass');
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$message = ''; // Message à afficher après la tentative de connexion

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Utilisation de trim pour supprimer les espaces blancs

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE nom = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            // Utilisateur trouvé, vérifier le mot de passe
            if ($password === trim($user['mdp'])) { // Comparaison avec trim pour mot de passe non haché
                $_SESSION['username'] = $user['nom'];
                header('Location: success.php'); // Redirection vers la page de succès
                exit;
            } else {
                $message = "Mot de passe incorrect.";
            }
        } else {
            $message = "Nom d'utilisateur incorrect.";
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
    <title>Connexion</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<img src="pharmadis.png" alt="Logo" class="form-logo">
    <div class="container">
        <div class="form-container">
            <h2>Connexion</h2>
            <?php if (!empty($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="index.php" method="post">
                <div class="input-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <form action="inscription.php" method="get">
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </div>
</body>
</html>
