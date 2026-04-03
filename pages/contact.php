<?php
$title = 'Contact';
$h1 = 'Contactez-nous !';
$txtHeader = 'Vous avez beoin de renseignement ou de nous faire remonter une information ? ';
require_once('../composants/header.php');
?>
<section class="container_adherer">
    <form action="" method="POST" enctype="multipart/form-data">
        <p class="champ_obligatoire">Les champs marqués d'une <span class="stars_form">*</span> sont obligatoires</p>
        <label for="name">Nom <span class="stars_form">*</span></label><input class="saisie" type="text" name="name" id="name" required />
        <label for="prenom">Prénom <span class="stars_form">*</span></label><input class="saisie" type="text" name="prenom" id="prenom" required />
        <label for="mail">Email <span class="stars_form">*</span></label><input class="saisie" type="email" name="mail" id="mail" required />
        <label for="objet">Sujet de votre prise de contact <span class="stars_form">*</span></label><input class="saisie" type="text" name="objet" id="objet" required />
        <label for="message">Message <span class="stars_form">*</span></label><textarea type="textarea" name="message" id="message" required></textarea>
        <input type="submit" value="Envoyer" class="button_form button_connexion">
    </form>
</section>
<?php require_once('../composants/footer.php') ?>
<?php
//----------------------------------------------------------- Envoie du formulaire ---------------------------------------------------------------------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*Classe de traitement des exceptions et des erreurs*/

require '../PHPMailer-master/src/Exception.php';
/*Classe-PHPMailer*/
require '../PHPMailer-master/src/PHPMailer.php';
/*Classe SMTP nécessaire pour établir la connexion avec un serveur SMTP*/
require '../PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire 
    $objet_demande = $_POST['objet'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['name'];
    $email = $_POST['mail'];
    $message = $_POST['message'];
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();

        // Configuration du serveur SMTP
        $mail->Host = "";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "florian.s@miinde.fr";
        $mail->Password = "";

        // Paramètres du message
        $mail->setFrom('stanley77185@gmail.com');
        $mail->addAddress($_POST['mail']);
        $mail->AddReplyTo($_POST['mail'], $_POST['name']);
        $mail->isHTML(true);

        // Composition du sujet et du corps du message
        $mail->Subject = "Nouveau message depuis le formulaire de contact";
        $mail->Body = "Objet de la demande : $objet_demande <br> Prénom : $prenom <br> Nom : $nom <br> Email : $email <br><br> Message : <br> $message";
        $mail->AltBody = "Objet de la demande : $objet_demande \n Prénom : $prenom \n Nom : $nom \n Email : $email \n\n Précisions de la demande : \n $message";

        // Configuration des encodages
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Envoi du message
        $mail->send();
        // (…)
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du message : " . $e->getMessage();
    }
}
?>