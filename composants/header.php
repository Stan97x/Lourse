<?php require_once($_SERVER['DOCUMENT_ROOT'].'/l-ourse/db/session.php') ?>
<!DOCTYPE html>
<html lang="fr">

<head>    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?> - L'ourse</title>
    <link rel="icon" type="text/css" href="/l-ourse/images/ourse2.webp" />

    <link rel="stylesheet" href="/l-ourse/styles/nav.css">
    <link rel="stylesheet" href="/l-ourse/styles/header.css">
    <link rel="stylesheet" href="/l-ourse/styles/index.css">
    <link rel="stylesheet" href="/l-ourse/styles/adherer.css">
    <link rel="stylesheet" href="/l-ourse/styles/footer.css">
    <link rel="stylesheet" href="/l-ourse/styles/carte.css">
    <link rel="stylesheet" href="/l-ourse/styles/contact.css">
    <link rel="stylesheet" href="/l-ourse/styles/campagne.css">
    <link rel="stylesheet" href="/l-ourse/styles/actualites.css">
</head>

<body>
    <header>
        <?php require_once('nav.php') ?>
        <div class="container_entete">
            <div class="item_header">
                <p class="txt_header"><?php echo $txtHeader ?></p>
            </div>
            <img class="image_entete" src="/l-ourse/images/ourse3.webp" alt="logo l'ourse">
        </div>
    </header>