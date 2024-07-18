<?php
session_start();

$host = '127.0.0.1';
$db   = 'users';
$user = 'root';
$pass = 'Nadir123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$message = ''; // Message à afficher après la tentative d'inscription

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        // Vérifiez si l'utilisateur existe déjà
        $stmt = $pdo->prepare("SELECT * FROM users WHERE nom = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            $message = "Ce nom d'utilisateur est déjà pris.";
        } else {
            // Insérer l'utilisateur dans la base de données
            $insertStmt = $pdo->prepare("INSERT INTO users (nom, mdp) VALUES (?, ?)");
            $insertStmt->execute([$username, $password]);

            $message = "Inscription réussie. Vous pouvez maintenant vous connecter.";
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
    <title>Inscription</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Inscription</h2>
            <?php if (!empty($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>
            <form action="inscription.php" method="post">
                <div class="input-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">S'inscrire</button>
            </form>
            <form action="index.php" method="get">
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
