<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</html>

 <?php
include_once("session.php");

    $conn = mysqli_connect("localhost", "root", "", "logger");
    if ($conn === false) {
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    $nomEmetteurTicket =  $_REQUEST['user_name'];
    $prenomEmetteur = $_REQUEST['user_fname'];
    $titreTicket =  $_REQUEST['ticket_title'];
    $contenuTicket = $_REQUEST['ticket_content'];
    $idEmetteur = $_SESSION['idUtilisateur'];

   if (!empty($nomEmetteurTicket)) {
    
    $contenuTicketS = htmlspecialchars($contenuTicket, ENT_QUOTES);
    $prenomEmetteurTicketS = htmlspecialchars($prenomEmetteur, ENT_QUOTES);
    $titreTicketS = strtoupper(htmlspecialchars($titreTicket, ENT_QUOTES));
    $nomEmetteurTicketS = htmlspecialchars($nomEmetteurTicket, ENT_QUOTES);

    $sql = "INSERT INTO `ticket`(`contenuTicket`, `ticketLevel`, `statut`, `titreTicket`, `nomEmetteurTicket`, `prenomEmetteurTicket`, `idEmetteur`)
   VALUES ('$contenuTicketS', 0, 0, '$titreTicketS', '$nomEmetteurTicketS', '$prenomEmetteurTicketS', $idEmetteur)";

    if (mysqli_query($conn, $sql)) {
      /*
       echo "<div class=\"alert success\">
        <span class=\"closebtn\">&times;</span>  
        <strong>Envoyé!</strong> Votre ticket à bien été transmis au support.
        </div>";*/
      header("Location: profilEmploye.php");
    } else {
        echo "Erreur $sql. "
            . mysqli_error($conn);
    }

    mysqli_close($conn);
}
    ?>

<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>