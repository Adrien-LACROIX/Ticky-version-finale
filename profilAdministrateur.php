<?php include_once("template.php");
include_once("session.php");
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styleMainPage.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />


    <head>

    <body>

        <?php

        if ($_SESSION['is_auth'] && $_SESSION['is_admin']) {

        ?>
            <title>Espace Administrateur</title>

            <div class="header">
                <img src="laRodaLogo.jpg" alt="Avatar" style="width:200px; margin-left: 50px; margin-top: 10px;" align="left">
                <h1 style="text-align:left">LA RODA</h1>
                <div class="slogan">En route vers le futur!</div>
            </div>

</head>

<ul class="topnav">
    <li><a href="main.php">Accueil</a></li>
    <li><a href="viewTickets.php" style="margin:auto; text-align:center; display:block;">Gestion des Tickets</a></li>
    <div class="dropdown">
    <li class="right"><a href="#about"> <?php echo "<i class=\"fa fa-user\" aria-hidden=\"true\"></i>" . $_SESSION['pseudo']; ?></a>
            <div class="dropdown-content">
                <a href="#"><?php echo "<form method=\"post\" id=\"deconnexion\"><input class=\"button button1\" type=\"submit\" value=\"Deconnexion\" name=\"log_off\"/></form>"; ?></a>
                <a href="competences.html">Compétences</a>
            </div>
        </div>
    </li>
</ul>
<?php echo "<form method=\"post\" id=\"deconnexion\"><input class=\"button button1\" type=\"submit\" value=\"Deconnexion\" name=\"log_off\"/></form>"; ?></a>

<?php


            echo "<h1 style=\"color:white;\" id=\"pseudo\">Bienvenue " . $_SESSION['pseudo'] . " !</h2>";
            echo "<h3 style=\"color:white;\"id=\"pseudo\">Votre ID: " . $_SESSION['idInformaticien'] . "</h3>";
           // echo "<form method=\"post\" id=\"deconnexion\"><input class=\"button button1\" type=\"submit\" value=\"Deconnexion\" name=\"log_off\"/></form>";
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