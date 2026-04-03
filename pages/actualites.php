<?php
$title = 'Actualités';
$h1 = 'Actualités';
$txtHeader = 'Retrouvez les différentes actualités et évènements de l\'association';


require_once('../db/db_config.php');
require_once('../db/fonctions_actualites.php');
$actus = new Actualites($pdo);
$allActus = $actus->getAllACTU();
if (isset($_POST['delete'])) {
    // Vérifie si l'identifiant de l'actualité à supprimer est présent
    if (isset($_POST['actu_id'])) {
        $actu_id = $_POST['actu_id'];
        // Appelle la fonction deleteActu pour supprimer l'actualité
        $result = $actus->deleteActu($actu_id);
        var_dump($result);
        if ($result === true) {
            // Affiche un message de confirmation
            echo "Actualité supprimée avec succès.";
            // Rafraîchit la page pour refléter les changements
            //header("Refresh:0");
        } else {
            echo "Une erreur s'est produite lors de la suppression de l'actualité.";
        }
    }
}
require_once('../composants/header.php');
?>
<section class="container_actu">
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['TYPCOMPTE'] === 'admin') {
    ?>
        <div class="item_ajouter_actus">
            <a class="link_ajouter_actus" href="/l-ourse/pages/ajouter_actus.php">Ajouter des actualités</a>
        </div>
    <?php } ?>
    <?php foreach ($allActus as $index => $actu) : ?>
        <?php if ($index % 2 === 0) : ?>
            <div class='item_actu item_actu1'>
            <?php else : ?>
                <div class='item_actu item_actu2'>
                <?php endif; ?>
                <h2><?= $actu['TITREACTU'] ?></h2>
                <p class='txt_actu'><?= $actu['formatted_date'] ?> - <?= $actu['VILLEACTU'] ?></p>
                <img src="<?= $actu['IMGACTU'] ?>" class="img_actu" alt='affiche actualité' />
                <p class='txt_actu'><?= $actu['DESCACTU'] ?></p>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['typcompt'] === 'admin') : ?>
                    <form action="" method="POST">
                        <input type="hidden" name="actu_id" value="<?= $actu['NOACTU'] ?>">
                        <input type="submit" name="delete" value="Supprimer" class="supprimer_actus">
                    </form>
                <?php endif; ?>
                </div>
            <?php endforeach; ?>
</section>
<?php require_once('../composants/footer.php') ?>