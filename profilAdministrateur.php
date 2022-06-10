<?php include_once("template.php");
include_once("session.php");
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />


    <head>

    <body>

        <?php

        if ($_SESSION['is_auth'] && $_SESSION['is_admin']) {

        ?>
            <title>Espace Administrateur</title>

            <div class="header">
      <a href="profilEmploye.php"><button class="button selected_page">MON PROFIL</button></a>
      <a href="viewTickets.php"><button class="button main_page">GESTION DES TICKETS</button></a>
    </div>

</head>

<?php


echo "<center><h1 id=\"pseudo\">Bienvenue " . $_SESSION['pseudo'] . " | ID: " .$_SESSION['idUtilisateur']."</h1></center>";

echo "<center><form method=\"post\" id=\"deconnexion\"> <input class=\"button button1\" type=\"submit\" value=\"Deconnexion\" name=\"log_off\"/></form></center>";
?>


<script>
    document.getElementById("button_is_auth2").style.display = "none";
    document.getElementById("button_is_auth").style.display = "none";
</script>
<?php
            if (isset($_POST['log_off'])) {
                $_SESSION['is_auth'] = false;
                header("Location: http://localhost/TicketManagment2/connexionAdministrateur.php");
?>
    <script type='text/javascript'>
        document.getElementById("connexion").style.display = "none";
        document.getElementById("pseudo").style.display = "none";
        document.getElementById("connexion").style.display = "flex";
        document.getElementById("deconnexion").style.display = "none";
    </script>
<?php
            }
        } else {
?>
<title>La Roda - 404 :(</title>
<div style="position: fixed; bottom: 290px; right: 720; width: -110px; text-align:left;">
    <div class="ErrorContainer">
        <strong style="font-size:10vw">404 </strong>
        <p>La page que vous demandez n'est pas acessible
    </div>
    <center><a class="button button1" href="main.php"></i> Revenir au menu</a>
        <center>
</div> <?php } ?>
</body>

</html>