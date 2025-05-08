<?php
session_start();
require_once 'connexion.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['email']) || $_SESSION['email'] !== 'admin@admin.com') {
    echo "<h2 style='color:red; text-align:center;'>⛔ Accès refusé. Réservé à l'administrateur.</h2>";
    exit();
}

$prenom = $_SESSION['prenom'] ?? '';
$nom = $_SESSION['nom'] ?? '';

// 🔴 Supprimer un utilisateur
if (isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    if ($id !== $_SESSION['user_id']) {
        $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?")->execute([$id]);
    }
}

// 👑 Promouvoir un utilisateur
if (isset($_POST['promote_id'])) {
    $id = intval($_POST['promote_id']);
    $pdo->prepare("UPDATE utilisateurs SET role = 'admin' WHERE id = ?")->execute([$id]);
}

// 📥 Charger tous les utilisateurs
$stmt = $pdo->query("SELECT id, nom, prenom, email, role, date_creation FROM utilisateurs ORDER BY id ASC");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin – Crynance</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mainpage.css">
  <style>
    .user-table {
      width: 90%;
      margin: 30px auto;
      border-collapse: collapse;
      background-color: #1c1f4a;
      color: #fff;
      border-radius: 10px;
      overflow: hidden;
    }
    .user-table th, .user-table td {
      padding: 12px 15px;
      border-bottom: 1px solid #4a90e2;
      text-align: left;
    }
    .user-table th {
      background-color: #232861;
    }
    .user-table tr:hover {
      background-color: #2d328f;
    }
    .user-actions {
      display: flex;
      gap: 10px;
    }
    .user-actions form {
      display: inline;
    }
    .user-actions button {
      background: none;
      border: none;
      color: #4a90e2;
      cursor: pointer;
      font-weight: bold;
    }
    .user-actions button:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <header>
    <nav>
      <div class="logo">crynance</div>
      <ul>
        <li><a href="mainpage.php">Accueil</a></li>
        <li><a href="markets.php">Marchés</a></li>
        <li><a href="education.php">Éducation</a></li>
        <li><a href="admin.php">Admin</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <h1>Panneau d’administration</h1>
    <p>Bienvenue <b><?= htmlspecialchars($prenom . ' ' . $nom) ?></b> 👑</p>
  </section>

  <section class="crypto-table">
    <h2>Liste des utilisateurs</h2>

    <table class="user-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Rôle</th>
          <th>Date d'inscription</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($utilisateurs as $user): ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= htmlspecialchars($user['nom']) ?></td>
          <td><?= htmlspecialchars($user['prenom']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= htmlspecialchars($user['role']) ?></td>
          <td><?= $user['date_creation'] ?></td>
          <td class="user-actions">
            <?php if ($user['id'] !== $_SESSION['user_id']) : ?>
              <form method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                <input type="hidden" name="delete_id" value="<?= $user['id'] ?>">
                <button type="submit" style="color: red;">Supprimer</button>
              </form>
              <?php if ($user['role'] !== 'admin') : ?>
                <form method="POST">
                  <input type="hidden" name="promote_id" value="<?= $user['id'] ?>">
                  <button type="submit" style="color: green;">Promouvoir</button>
                </form>
              <?php endif; ?>
            <?php else: ?>
              <em>Vous</em>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

  <footer>
    <p>&copy; <span id="year"></span> Crynance – Tous droits réservés.</p>
  </footer>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>
