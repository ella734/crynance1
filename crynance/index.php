<?php
session_start();

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=crypto_users;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$erreur = '';
$succes = '';

// Connexion
if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($motdepasse, $user['motdepasse'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'] ?? 'user';

        // Redirection selon le rôle
        if ($_SESSION['role'] === 'admin' || $_SESSION['email'] === 'admin@admin.com') {
            header("Location: admin.php");
        } else {
            header("Location: mainpage.php");
        }
        exit();
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}

// Inscription
if (isset($_POST['action']) && $_POST['action'] === 'signup') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';

    $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $erreur = "Email déjà utilisé.";
    } else {
        $hash = password_hash($motdepasse, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, motdepasse) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nom, $prenom, $email, $hash])) {
            $succes = "Compte créé avec succès. Connectez-vous.";
        } else {
            $erreur = "Erreur lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Crynance – Connexion / Inscription</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
    body {
      background: #e7e7e7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 500px;
      text-align: center;
    }
    h1 { margin-bottom: 20px; color: #007BFF; }
    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }
    button {
      width: 100%;
      background: #007BFF;
      color: #fff;
      border: none;
      padding: 14px;
      font-size: 1rem;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
    }
    button:hover { background-color: #0056b3; }
    .error-message { color: red; margin: 10px 0; }
    .success-message { color: green; margin: 10px 0; }
    .toggle-link {
      color: #007BFF;
      cursor: pointer;
      text-decoration: underline;
      margin-top: 15px;
      display: inline-block;
    }
    .hidden { display: none; }
  </style>
</head>
<body>

  <div class="form-container">
    <h1 id="form-title">Connexion</h1>

    <?php if ($erreur): ?>
      <p class="error-message"><?= htmlspecialchars($erreur) ?></p>
    <?php elseif ($succes): ?>
      <p class="success-message"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <!-- FORMULAIRE CONNEXION -->
    <form method="POST" id="login-form">
      <input type="hidden" name="action" value="login">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="motdepasse" placeholder="Mot de passe" required>
      <button type="submit">Se connecter</button>
    </form>

    <!-- FORMULAIRE INSCRIPTION -->
    <form method="POST" id="signup-form" class="hidden">
      <input type="hidden" name="action" value="signup">
      <input type="text" name="nom" placeholder="Nom" required>
      <input type="text" name="prenom" placeholder="Prénom" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="motdepasse" placeholder="Mot de passe" required>
      <button type="submit">Créer un compte</button>
    </form>

    <p class="toggle-link" onclick="toggleForms()">Pas encore inscrit ? Créer un compte</p>
  </div>

  <script>
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');
    const formTitle = document.getElementById('form-title');
    const toggleLink = document.querySelector('.toggle-link');

    function toggleForms() {
      loginForm.classList.toggle('hidden');
      signupForm.classList.toggle('hidden');
      if (loginForm.classList.contains('hidden')) {
        formTitle.textContent = 'Inscription';
        toggleLink.textContent = 'Déjà inscrit ? Se connecter';
      } else {
        formTitle.textContent = 'Connexion';
        toggleLink.textContent = 'Pas encore inscrit ? Créer un compte';
      }
    }
  </script>

</body>
</html>
