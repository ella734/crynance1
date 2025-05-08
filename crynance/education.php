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
  <title>Éducation – Crynance</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mainpage.css">
  <style>
    .education-content {
      max-width: 900px;
      margin: auto;
      padding: 30px;
      color: #ddd;
      line-height: 1.6;
    }
    .education-content ul {
      list-style: disc;
      padding-left: 20px;
    }
    .education-content li {
      margin-bottom: 16px;
    }
    .education-links ul {
      list-style: none;
      padding: 0;
      margin-top: 10px;
    }
    .education-links li {
      margin: 8px 0;
    }
    .education-links a {
      color: #4a90e2;
      text-decoration: none;
      font-weight: bold;
    }
    .education-links a:hover {
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
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <h1>📘 Espace Éducation</h1>
    <p>Bonjour <b><?= htmlspecialchars($prenom . ' ' . $nom) ?></b>, développez vos connaissances sur la cryptomonnaie.</p>
  </section>

  <section class="crypto-table education-content">
    <h2 style="color: #4a90e2;">Ressources d'apprentissage</h2>

    <ul>
      <li><b>Qu'est-ce que la cryptomonnaie ?</b><br>Une cryptomonnaie est une monnaie numérique sécurisée par la cryptographie. Elle est décentralisée et fonctionne via une blockchain.</li>
      <li><b>Comment fonctionne une blockchain ?</b><br>La blockchain est un registre distribué, immuable, et partagé entre tous les utilisateurs du réseau.</li>
      <li><b>Exemples populaires :</b> Bitcoin, Ethereum, Binance Coin, Solana...</li>
      <li><b>Portefeuille crypto :</b> Un portefeuille permet de stocker et de gérer vos actifs numériques en toute sécurité.</li>
      <li><b>Types d'investissements :</b> achat/vente directe, staking, trading, NFT...</li>
    </ul>

    <div class="education-links">
      <p style="color: #b0b3ff;"><i>Pour aller plus loin :</i></p>
      <ul>
        <li><a href="https://www.coinbase.com/fr/learn/crypto-basics" target="_blank">🔗 Guide débutant – Coinbase Learn</a></li>
        <li><a href="https://academy.binance.com/fr" target="_blank">🎓 Binance Academy (FR)</a></li>
        <li><a href="https://www.investopedia.com/terms/c/cryptocurrency.asp" target="_blank">📚 Investopedia – Définition</a></li>
      </ul>
    </div>
  </section>

  <footer>
    <p>
