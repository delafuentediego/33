<?php
require 'php/config.php';
if (!isset($_SESSION['user'])) {
    header('Location: connexion.html');
    exit;
}
$vid = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT title,price FROM voyages WHERE id = ?");
$stmt->execute([$vid]);
$voyage = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$voyage) {
    header('Location: recherche.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Personnalisation - O’Bitoun Travel</title>
  <link rel="stylesheet" id="theme-css" href="css/style-light.css">
</head>
<body>
  <header>
    <h1 class="main-title">Personnaliser : <?= htmlspecialchars($voyage['title']) ?></h1>
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

  <main class="form-section">
    <form id="personalize-form">
      <input type="hidden" name="voyage_id" value="<?= $vid ?>">

      <p>Prix de base : <strong><?= $voyage['price'] ?>€</strong></p>

      <label for="step-1">Étape 1 :</label>
      <select id="step-1" name="step1" class="step-select" data-step-id="1"></select>

      <label for="step-2">Étape 2 :</label>
      <select id="step-2" name="step2" class="step-select" data-step-id="2"></select>

      <p>Total : <span id="total">0.00 €</span></p>

      <button type="submit" class="btn">Valider et passer au paiement</button>
    </form>
  </main>

  <footer>
    <p>&copy; 2025 O’Bitoun Travel - Tous droits réservés</p>
  </footer>

  <script src="js/theme-toggle.js"></script>
  <script src="js/personalization.js"></script>
</body>
</html>
