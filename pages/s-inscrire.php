<?php
$title = 'S\'inscrire';
$h1 = 'S\'inscrire';
$txtHeader = 'Inscrivez-vous pour nous rejoindre !';
require_once('../composants/header.php');
require_once('../db/db_config.php');
require_once('../db/fonctions_user.php');

if (isset($_POST['submit'])) {
  $user = $_POST['user'];
  $email = $_POST['email'];
  $password = $_POST['MDP'];
  $result = $User->Register($user, $email, $password);
  if ($result == true) {
    $error_message = 'Compte créé';
    $isValide = true;
  } else {
    $error_message = "Le nom d'utilisateur est déjà utilisé";
    $isValide = false;
  }
}
?>
<section class="container_adherer">
  <form method="POST" action="">
    <p class="champ_obligatoire">Inscrivez-vous</p>
    <?php
    // Afficher le message d'erreur s'il existe
    if (isset($isValide)) {
      if ($isValide === false) {
        echo "<p class='txt_error'>$error_message</p>";
      } else {
        echo "<p class='txt_validate'>$error_message</p>";
      }
    }
    ?>
    <label for="">Nom d'utilisateur / pseudo :</label>
    <input type="text" id="user" name="user" />
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" />
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="MDP" />
    <input type="submit" name="submit" value="S'inscrire" class="button_form button_connexion">
  </form>
</section>
<?php require_once('../composants/footer.php') ?>