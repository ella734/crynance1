<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$prenom = $_SESSION['prenom'] ?? '';
$nom = $_SESSION['nom'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crynance</title>
  <link rel="stylesheet" href="mainpage.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo">crynance</div>
      <ul>
        <li><a href="markets.php">Marchés</a></li>
        <li><a href="education.php">Éducation</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <h1>Bienvenue <b><?= htmlspecialchars($prenom . ' ' . $nom) ?></b> 👋</h1>
    <p>Tradez <u>Bitcoin</u>, <u>Ethereum</u>, et bien plus.</p>
    <a href="#" class="btn">Commencer</a>
  </section>

  <section class="crypto-table">
    <h2>Prix du marché</h2>
    <article>
      <p>Voici les prix actuels des cryptomonnaies les plus populaires :</p>
    </article>

    <aside>
      <p>Note : les prix peuvent varier rapidement.</p>
    </aside>

    <figure>
      <img src="cripto.jpg" alt="Marché des cryptomonnaies" width="600" height="400">
      <figcaption>Tendances actuelles du marché.</figcaption>
    </figure>

    <table>
      <thead>
        <tr>
          <th>Cryptomonnaie</th>
          <th>Prix (USD)</th>
          <th>Évolution 24h</th>
          <th>Capitalisation</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Bitcoin (BTC)</td>
          <td>$50,000</td>
          <td class="positive">+2.5%</td>
          <td>$950B</td>
        </tr>
        <tr>
          <td>Ethereum (ETH)</td>
          <td>$3,400</td>
          <td class="negative">-1.2%</td>
          <td>$400B</td>
        </tr>
        <tr>
          <td>Binance Coin (BNB)</td>
          <td>$550</td>
          <td class="positive">+3.8%</td>
          <td>$90B</td>
        </tr>
        <tr>
          <td>Solana (SOL)</td>
          <td>$120</td>
          <td class="negative">-0.5%</td>
          <td>$50B</td>
        </tr>
      </tbody>
    </table>

    <p><q>Investissez intelligemment et restez informé !</q> – <b>Équipe Crynance</b></p>

    <fieldset>
      <legend>Conseils d’investissement</legend>
      <pre>
1. Diversifiez votre portefeuille.
2. Suivez les tendances du marché.
3. N’investissez que ce que vous êtes prêt à perdre.
      </pre>
    </fieldset>
  </section>

  <footer>
    <p>&copy; <span id="year"></span> Crynance – Tous droits réservés.</p>
  </footer>

  <script src="mainpage.js"></script>
  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>
