<?php
ob_start();
require_once(__DIR__ . '/../includes/header.php'); // Inclure le fichier de header pour démarrer la session
require '../config/db.php'; // Inclure le fichier de configuration de la base de données

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Adresse e-mail invalide.";
    } else {
        $pdo = getDatabaseConnection();

        if ($pdo) {
            try {
                $sql = "SELECT * FROM utilisateurs WHERE email = :email";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email']; // Ajout de cette ligne
                    $_SESSION['role'] = $user['role'];

                    switch ($user['role']) {
                        case 'administateur':
                            header("Location: /dashboardAdmin/dashboardAdmin.php");
                            exit();
                        case 'veterinaire':
                            header("Location: /dashboardVeto/dashboardVeto.php");
                            exit();
                        case 'employe':
                            header("Location: /dashboardEmploye/dashboardEmploye.php");
                            exit();
                        default:
                            $error_message = "Rôle d'utilisateur inconnu.";
                    }
                } else {
                    $error_message = "Identifiants incorrects.";
                }
            } catch (PDOException $e) {
                $error_message = "Erreur lors de la connexion: " . $e->getMessage();
            }
        } else {
            $error_message = "Erreur: Impossible de se connecter à la base de données.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../styles/style.css"> <!-- Inclure votre fichier CSS -->
</head>
<body>
    <h1>Connexion</h1>
    <?php if ($error_message): ?>
        <p class="error-message"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="email">Adresse mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('password')">👁️</span>
            </div>
        </div>
        <button type="submit" class="btn-submit">Se connecter</button>
    </form>

    <script>
        function togglePasswordVisibility(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
    <?php require_once(__DIR__ . '/../includes/footer.php'); ?>
</body>
</html>

<?php
ob_end_flush();
?>