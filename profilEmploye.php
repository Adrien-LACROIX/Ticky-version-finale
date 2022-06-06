<?php
include_once("template.php");
include_once("session.php");
include_once("sendTicketContent.php");
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styleMainPage.css" type="text/css">

</head>

<body>
    <?php
    #$_GET['login'], $_GET['password'],
    if ($_SESSION['is_auth'] && !$_SESSION['is_admin']) {
    ?>
        <title>Espace Utilisateur</title>
        <div class="header">
            <img src="laRodaLogo.jpg" alt="Avatar" style="width:200px; margin-left: 50px; margin-top: 10px;" align="left">
            <h1 style="text-align:left">LA RODA</h1>
            <div class="slogan">En route vers le futur!</div>
        </div>

        </head>
        <?php


        echo "<h1 id=\"pseudo\">Bienvenue " . $_SESSION['pseudo'] . " | ID: " .$_SESSION['idUtilisateur']."</h1><br><br><br>";
        echo "<a id=\"button_is_auth\" class=\"button button1\" href=\"createTicket.php\">Creer un nouveau ticket</a>";
        echo "<a id=\"button_is_auth\" class=\"button button1\" href=\"viewTicketsAsUser.php\">Mes tickets</a><br><br><br>";

        echo "<form method=\"post\" id=\"deconnexion\"> <input class=\"button button1\" type=\"submit\" value=\"Deconnexion\" name=\"log_off\"/></form>";
        ?>


        <script>
            document.getElementById("button_is_auth2").style.display = "none";
            document.getElementById("button_is_auth").style.display = "none";
            document.getElementById("connexion").style.display = "none";
        </script>
        <?php
        if (isset($_POST['log_off'])) {
            $_SESSION['is_auth'] = false;
            header("Location: http://localhost/Logger/TicketManagment/connexionEmploye.php");
        ?>
            <script type='text/javascript'>
                document.getElementById("pseudo").style.display = "none";
                //document.getElementById("is_auth").innerHTML = "Deconnecte";   // Affiche deconnecte au moment de la deconnexion   
                document.getElementById("connexion").style.display = "flex";
                document.getElementById("deconnexion").style.display = "none";
            </script>
        <?php
        }
    } else { ?>
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