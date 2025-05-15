<?php
require 'php/config.php';
if (empty($_SESSION['cart'])) {
    header('Location: recherche.html');
    exit;
}
$total = array_sum(array_column($_SESSION['cart'], 'price'));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Paiement - O’Bitoun Travel</title>
  <link rel="stylesheet" id="theme-css" href="css/style-light.css">
</head>
<body>
  <header>
    <h1 class="main-title">Paiement</h1>
    <nav>
      <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="presentation.html">Présentation</a></li>
        <li><a href="recherche.html">Rechercher un voyage</a></li>
        <li><a href="inscription.html">Inscription</a></li>
        <li><a href="connexion.html">Connexion</a></li>
        <li><a href="profil.php">Profil</a></li>
        <li><a href="admin.php">Admin</a></li>
      </ul>
    </nav>
  </header>

  <main class="table-container">
    <h2>Récapitulatif du panier</h2>
    <table>
      <thead>
        <tr><th>Voyage</th><th>Prix</th></tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['cart'] as $item): ?>
        <tr>
          <td><?= htmlspecialchars($item['voyage_id']) ?></td>
          <td><?= $item['price'] ?>€</td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <th>Total</th><th><?= $total ?>€</th>
        </tr>
      </tbody>
    </table>
    <form action="php/scripts/traitement_paiement.php" method="POST">
      <button type="submit" class="btn">Payer maintenant</button>
    </form>
  </main>

  <footer>
    <p>&copy; 2025 O’Bitoun Travel - Tous droits réservés</p>
  </footer>

  <script src="js/theme-toggle.js"></script>
</body>
</html>
