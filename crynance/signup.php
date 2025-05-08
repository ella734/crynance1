<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $erreur = "Cet email est déjà utilisé.";
    } else {
        $hash = password_hash($motdepasse, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, motdepasse) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $hash]);

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Crynance</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Arial', sans-serif; }
        body {
            background: url('https://www.istockphoto.com/fr/photo/contexte-de-concept-de-bitcoin-de-crypto-monnaie-gm1698944045-538490432') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            text-align: center;
            backdrop-filter: blur(5px);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #007BFF;
        }
        .input-group {
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            outline: none;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #007BFF;
        }
        button {
            background-color: #007BFF;
            color: white;
            font-size: 1.2rem;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 1rem;
            margin-bottom: 20px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .toggle-form {
            margin-top: 20px;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Inscription</h1>

        <?php if (isset($erreur)): ?>
            <p class="error-message"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>

        <form method="POST" action="signup.php" id="signup-form">
            <div class="input-group">
                <input type="text" name="nom" id="nom" placeholder="Nom" required>
            </div>
            <div class="input-group">
                <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="motdepasse" id="motdepasse" placeholder="Mot de passe" required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>

        <p class="toggle-form">Déjà un compte ? <a href="index.php">Se connecter</a></p>
    </div>

    <script>
        // Validation du formulaire
        document.getElementById('signup-form').addEventListener('submit', function(event) {
            const nom = document.getElementById('nom').value;
            const prenom = document.getElementById('prenom').value;
            const email = document.getElementById('email').value;
            const motdepasse = document.getElementById('motdepasse').value;

            if (!nom || !prenom || !email || !motdepasse) {
                alert("Veuillez remplir tous les champs.");
                event.preventDefault();
            }
        });
    </script>

</body>
</html>




