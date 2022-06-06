<?php
include_once("template.php");
include_once("session.php");
include_once("conDB.php");
include_once("sendTicketContent.php");
include_once("showTextLimit.php");
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="laroda.jpg" type="image/x-icon">

</head>


<body>

    <?php
    if (!$_SESSION['is_auth']) { ?>
        <title>La Roda - 404 :(</title>
        <div style="position: fixed; bottom: 290px; right: 720; width: -110px; text-align:left;">
            <div class="ErrorContainer">
                <strong style="font-size:10vw">404 </strong>
                <p>La page que vous demandez n'est pas acessible
            </div>
            <center><a class="button button1" href="main.php"></i> Revenir au menu</a>
                <center>
        </div> <?php } ?>

    <?php

    if ($_SESSION['is_auth'] && !$_SESSION['is_admin']) {
    ?>

        <title>Créer un nouveau ticket</title>
        <h1><img src="laroda.jpg" alt="Avatar" style="width:38px"> Créer un ticket</h1><br><br>

        <form action="sendTicketContent.php">

            <label class="required" style="color:white; font-family: Arial, Helvetica, sans-serif;" for="userName">Indiquez votre Nom</label><br>
            <input type="text" minlength="2" maxlength="25" id="userName" name="user_name" placeholder="Nom" required size="60" pattern="[a-z] {}" required>
            <span class="validity"></span><br>

            <label class="required" style="color:white; font-family: Arial, Helvetica, sans-serif;" for="userFname">Indiquez votre Prénom</label><br>
            <input type="text" minlength="2" maxlength="15" id="userFname" name="user_fname" placeholder="Prénom" required size="60" pattern="[a-z] {}" required>
            <span class="validity"></span><br>

            <label class="required" style="color:white; font-family: Arial, Helvetica, sans-serif;" for="ticketTitle">Donnez un titre à votre ticket</label><br>
            <input type="text" minlength="4" maxlength="20" id="ticketTitle" name="ticket_title" style="text-transform:uppercase" placeholder="titre" pattern="[a-z] {}" required>
            <span class="validity"></span><br>

            <label class="required" style="color:white; font-family: Arial, Helvetica, sans-serif;" for="textarea">Décrivez votre probleme</label><br>
            <div class="textarea-wrapper">
                <textarea id="textarea" name="ticket_content" cols="50" oninput="limitChar(this)" minlength="4" maxlength="2000" placeholder="Décrivez votre problème" required></textarea>
                <div class="complements">
                    <span id="charCounter" style="font-family: Arial, Helvetica, sans-serif;">2000(MAX)</span>
                </div>
            </div>
            <br>
            <span class="validity"></span><br><br>
            <label class="required" style="color:white; font-family: Arial, Helvetica, sans-serif;">Note: Les champs marqués d'une étoile sont obligatoires</label><br><br>

            <button type="submit" class="button button1" formmethod="post">Soumettre ma demande</button>
            <a id="button_is_auth" class="button button1" href="profilEmploye.php">Annuler</a>
        </form>

        <div style="position: fixed; bottom: 165px; right: 10; width: -110px; text-align:left;">
            <div class="infoContainer">
                <h2><i class="fa fa-info-circle" aria-hidden="true" style="font-size:44px"></i> Comment créer un ticket? </h2>
                <p>Pour créer un ticket, vous devez remplir le formulaire situé à gauche de cette page. Veuillez indiquer votre nom, prénom en tout premier.
                    Dans un second temps, vous devrez donner un titre à votre ticket. Cette fonction est limitée à 20 caractères maximum afin d'optimiser sa lecture lors de la réception
                    par nos services. Le titre de votre ticket sera généralement une description breve du problème. C'est a l'étape suivante que vous décrivez en intégralité votre problème,
                    celle-ci se limite également à un nombre de caractères donné qui est de 250 afin de pouvoir avoir la possibilité de décrire le problème en intégralité.
                    Une fois toutes ces étapes complétées, vous pouvez cliquer sur "Soumettre ma demande" ou corriger les erreurs faites lors de la rédaction de votre ticket.
                <p>Une fois votre ticket soumis au support, vous pouvez le consulter sur cette <a href="connexAdministration.php">page</a>.
                    Lorsqu'il sera resolu, le label de celui-ci changera et vous pourrez consulter la reponse du support.
                    <br><br>Voici les differents labels:
                <div>
                    <p><span class="statutColor statutEnCours">EN COURS</span> Le label "EN COURS" est un ticket venant d'etre soumis
                </div>
                <div>
                    <p><span class="statutColor statutResolu">RÉSOLU</span> Lorsque le label indique "RÉSOLU", l'affaire est considerée comme close et résolue
                </div>
                <div>
                    <p><span class="statutColor statutNonResolu">NON RÉSOLU</span>Lorsque le label indique "NON RÉSOLU", l'affaire est considerée comme close mais non résolue
                </div>
            </div>
        </div>
    <?php
    } ?>
</body>

</html>