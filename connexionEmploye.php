<?php
include_once("template.php");
include_once("session.php");
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styleMainPage.css" type="text/css">
    <link rel="shortcut icon" href="laroda.jpg" type="image/x-icon">
</head>
</html>

<body>

<div class="header">
<img src="laRodaLogo.jpg" alt="Avatar" style="width:200px; margin-left: 50px; margin-top: 10px;" align="left">
<h1 style="text-align:left">LA RODA</h1>
<div class="slogan">En route vers le futur!</div>
<title>La Roda - Connexion Utilisateur</title>
</div>

</head>

<ul>
  <li><a href="main.php">Accueil</a></li>
  <li><a href="connexionEmploye.php"><b>Connexion Employé</b></a></li>
  <li><a href="connexionAdministrateur.php" >Connexion Administrateur</a></li>
</ul>
<body>
<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
</head>
<body>

<?php
    if ($_SESSION['is_auth'] && !$_SESSION['is_admin']) {

        echo "<p id=\"pseudo\" style=\"color:white; font-size:1vw;\"> Hey " . $_SESSION['pseudo'] . " vous êtes actuellement connecté! <br>Vous pouvez retourner sur votre profil en cliquant sur le bouton ci-dessous.</p><br>";
        echo "<a id=\"button_is_auth\" class=\"button button1\" href=\"profilEmploye.php\">Retourner au profil</a>";
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
             header("Location: http://localhost/TicketManagment2/main.php");
         ?>
             <script type='text/javascript'>
                 document.getElementById("pseudo").style.display = "none"; 
                 document.getElementById("connexion").style.display = "flex";
                 document.getElementById("deconnexion").style.display = "none";
             </script>
     <?php
         }
     } else {
        createLoginForm(login('utilisateurs', 'prenomUtilisateur', 'nomUtilisateur', $_GET['login'], $_GET['password'], 'identifiantUtilisateur', 'motDePasseUtilisateur', 'idUtilisateur'));
    }
     ?>


</body>
<div id="footer"><center>La Roda - Société</center></div>
                  
</html>
