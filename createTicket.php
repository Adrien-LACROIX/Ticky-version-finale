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

        <div class="header">
        <a href="profilEmploye.php"><button class="button main_page">MON PROFIL</button></a>
      <a href="createTicket.php"><button class="button selected_page">CRÉER UN TICKET</button></a>
      <a href="viewTicketsAsUser.php"><button class="button main_page">MES TICKETS</button></a>
    </div>

        <div class="createTicketForm">
            <form action="sendTicketContent.php">

                <label style="color:white; font-family: Arial, Helvetica, sans-serif;" for="userName">Votre ticket sera au nom de:</label><br>
                <input style="cursor: not-allowed;" type="text" id="userName" name="user_name" value="<?php echo ($_SESSION['pseudo']) ?>" required readonly>
                <span class="validity"></span><br>

                <label class="required" style="color:white; font-family: Arial, Helvetica, sans-serif;" for="subject">Indiquez la catégorie</label><br>
                <select id="subject" class="objectList" name="subject">
                    <option value="Matériel">Matériel</option>
                    <option value="Logiciel">Logiciel</option>
                    <option value="Autre">Autre</option>
                </select><br>

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
        </div>
    <?php
    } ?>
</body>

</html>