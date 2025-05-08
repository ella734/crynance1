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
  <title>Marchés – Crynance</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mainpage.css">
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
    <h1>Marchés de la cryptomonnaie</h1>
    <p>Bonjour <b><?= htmlspecialchars($prenom . ' ' . $nom) ?></b>, suivez les prix en direct.</p>
  </section>

  <section class="crypto-table">
    <h2>Données en temps réel</h2>

    <table id="crypto-table">
      <thead>
        <tr>
          <th>Crypto</th>
          <th>Prix (USD)</th>
          <th>Variation 24h</th>
          <th>Volume</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="4">Chargement des données...</td></tr>
      </tbody>
    </table>

    <p style="margin-top: 20px;"><i>Données fournies par l'API publique de CoinGecko.</i></p>
  </section>

  <footer>
    <p>&copy; <span id="year"></span> Crynance – Tous droits réservés.</p>
  </footer>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();

    async function loadCryptoData() {
      try {
        const res = await fetch("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin,ethereum,cardano,ripple");
        const data = await res.json();

        const tbody = document.querySelector("#crypto-table tbody");
        tbody.innerHTML = "";

        data.forEach(coin => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${coin.name} (${coin.symbol.toUpperCase()})</td>
            <td>$${coin.current_price.toLocaleString()}</td>
            <td class="${coin.price_change_percentage_24h >= 0 ? 'positive' : 'negative'}">
              ${coin.price_change_percentage_24h.toFixed(2)}%
            </td>
            <td>$${coin.total_volume.toLocaleString()}</td>
          `;
          tbody.appendChild(tr);
        });
      } catch (error) {
        console.error("Erreur API CoinGecko :", error);
        document.querySelector("#crypto-table tbody").innerHTML = `
          <tr><td colspan="4" style="color:red;">Impossible de charger les données.</td></tr>`;
      }
    }

    loadCryptoData();
  </script>
</body>
</html>
