<?php
require 'php/config.php';
if (!isset($_SESSION['user'])) {
    header('Location: connexion.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Profil - O’Bitoun Travel</title>
  <link rel="stylesheet" id="theme-css" href="css/style-light.css">
</head>
<body>
  <header>
    <h1 class="main-title">Mon Profil</h1>
    <nav>
      <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="presentation.html">Présentation</a></li>
        <li><a href="recherche.html">Rechercher un voyage</a></li>
        <li><a href="inscription.html">Inscription</a></li>
        <li><a href="connexion.html">Connexion</a></li>
        <li><a href="profil.php" class="active">Profil</a></li>
        <li><a href="admin.php">Admin</a></li>
      </ul>
    </nav>
  </header>

  <main class="profile-container">
    <form>
      <label for="username">Nom d'utilisateur :</label>
      <input type="text"
             id="username"
             name="username"
             readonly
             value="<?= htmlspecialchars($_SESSION['user']['nom']) ?>">
      <button type="button" class="edit-btn">✏️</button>
      <!-- ajoutez d'autres champs de profil ici de la même façon -->
    </form>
  </main>

  <footer>
    <p>&copy; 2025 O’Bitoun Travel - Tous droits réservés</p>
  </footer>

  <script src="js/theme-toggle.js"></script>
  <script src="js/profile-inline-edit.js"></script>
</body>
</html>

