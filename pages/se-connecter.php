<?php
$title = 'Connexion';
$h1 = 'Connexion';
$txtHeader = 'Bon retour parmis nous !';

require_once('../db/db_config.php');
require_once('../db/fonctions_user.php');

$userObject = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = $_POST['nom'];
  $password = $_POST['password'];

  $userData = $userObject->Login($user, $password);
  if (is_array($userData)) {
    session_start();
    $_SESSION['user'] = $userData;
    if (isset($_SESSION['user'])) {
      header('Location: /l-ourse');
    }
  }
}
require_once('../composants/header.php');
?>

<section class="container_adherer">
  <form method="POST" action="">
    <p class="champ_obligatoire">Connectez-vous</p>
    <label for="nom">Nom d'utilisateur :</label>
    <input type="text" id="nom" name="nom" required />
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required />
    <input type="submit" value="Connexion" class="button_form button_connexion">
  </form>
  <a href="/l-ourse/pages/s-inscrire.php" class="button_form button_sincrire">S'inscrire</a>
</section>

<?php require_once('../composants/footer.php') ?>