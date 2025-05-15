<?php
require 'php/config.php';
if (!isset($_SESSION['user']) /*|| $_SESSION['user']['role']!='admin'*/) {
    header('Location: connexion.html');
    exit;
}
$stmt = $pdo->query("SELECT id, nom, email, active FROM users ORDER BY id");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin - O’Bitoun Travel</title>
  <link rel="stylesheet" id="theme-css" href="css/style-light.css">
</head>
<body>
  <header>
    <h1 class="main-title">Administration</h1>
    <nav>
      <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="presentation.html">Présentation</a></li>
        <li><a href="recherche.html">Rechercher un voyage</a></li>
        <li><a href="inscription.html">Inscription</a></li>
        <li><a href="connexion.html">Connexion</a></li>
        <li><a href="profil.php">Profil</a></li>
        <li><a href="admin.php" class="active">Admin</a></li>
      </ul>
    </nav>
  </header>

  <main class="table-container">
    <h2>Utilisateurs</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th><th>Nom</th><th>Email</th><th>Actif</th><th>Action</th>
        </tr>
      </thead>
      <tbody id="user-table-body">
        <?php foreach ($users as $u): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= htmlspecialchars($u['nom']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td>
            <input type="checkbox"
                   name="active"
                   <?= $u['active'] ? 'checked' : '' ?>>
          </td>
          <td>
            <button data-id="<?= $u['id'] ?>" data-field="active">
              Appliquer
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <footer>
    <p>&copy; 2025 O’Bitoun Travel - Tous droits réservés</p>
  </footer>

  <script src="js/theme-toggle.js"></script>
  <script src="js/admin-update.js"></script>
</body>
</html>
