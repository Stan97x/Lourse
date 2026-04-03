<?php
$title = "Ajout d'actualités";
$h1 = "Ajout d'actualités";
$txtHeader = "Qu'est ce qu'il y a au programme aujourd'hui ?";
require_once('../composants/header.php');

require_once('../db/db_config.php');
require_once('../db/fonctions_actualites.php');

if (isset($_POST['submit'])) {
  $titreActu = $_POST['titre'];
  $imgArray = $_FILES['image'];
  $imgName = $imgArray['name'];
  $imgActu= '../images/actualites' . $imgName;
  $imgTmpName = $imgArray['tmp_name'];

  // Chemin d'accès au dossier de destination
  $destination = '../images/actualites/' . $imgName;
  
  // Déplacer le fichier téléchargé vers le dossier de destination
  if (move_uploaded_file($imgTmpName, $destination)) {
      // Si le déplacement réussit, tu peux utiliser $destination comme chemin d'accès dans ta base de données
      $imgActu = '../images/actualites/' . $imgName;
  } else {
      // En cas d'erreur lors du déplacement du fichier, affiche un message d'erreur
      $error_message = "Une erreur s'est produite lors du téléchargement de l'image.";
      $isValide = false;
  }

  $descActu = $_POST['description'];
  $dateActu = $_POST['date'];
  $villeActu = $_POST['ville'];
  $actus = new Actualites($pdo);
  $result = $actus->insertACTU($titreActu, $imgActu, $descActu, $dateActu, $villeActu);
  if ($result === true) {
    $error_message = 'Actualité ajoutée';
    $isValide = true;
  } else {
    $error_message = "Un problème est survenue lors de l'ajout";
    $isValide = false;
  }
}
?>
x
<section class="container_actu">
  <?php if (isset($_SESSION['user'])) : ?>
    <form action="" method="POST" enctype="multipart/form-data">
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
      <label for="titre">Titre de l'actualité</label>
      <input type="text" name="titre" id="titre" required>
      <label for="image">Image de l'actualité</label>
      <input type="file" name="image" id="image" required>
      <label for="description">Description de l'actualité</label>
      <textarea type="text" name="description" id="description" required></textarea>
      <label for="date">Date de l'actualité</label>
      <input type="date" name="date" id="date" required>
      <label for="ville">Ville</label>
      <input type="text" name="ville" id="ville" required>
      <input type="submit" name="submit" value="Ajouter" class="button_form button_connexion">
    </form>
  <?php else : ?>
    <h2>Vous n'êtes pas autorisé   à accéder à cette page</h2>
  <?php endif ?>
</section>
<?php require_once('../composants/footer.php') ?>