<?php
session_start();
#$_SESSION['is_auth'] = false; #La session est 'false' aucun utilisateur authentifie
ini_set('display_errors', 'off'); #Eviter d'afficher les erreurs
function login($db_table, $db_champ1, $db_champ2, $db_login, $db_mdp, $db_champ_login, $db_champ_mdp, $db_id, $severiteTicket=false, $erreur=false, $idTicket=false, $contenuTicket=false, $idUtilisateur=false,  $nomUtilisateur=false,  $prenomUtilisateur=false,  $identifiantUtilisateur=false,  $motDePasseUtilisateur=false) #Parametres de connexion
{
    if (isset($_GET['login']) && isset($_GET['password'])) {

        $db_username = 'root';
        $db_password = '';
        $db_name = 'logger';
        $db_host = 'localhost';
        $db = new mysqli($db_host, $db_username, $db_password, $db_name);

        #Requette de connexion
        $sql = "SELECT * FROM $db_table WHERE $db_champ_login LIKE '$db_login' AND $db_champ_mdp LIKE '$db_mdp';";

#####################################################################################################



        #################################################################################################
        $pseudo = mysqli_fetch_array(mysqli_query($db, $sql)); #Creer un tableau de la requete (pour executer la requette de conexion)
        if (mysqli_fetch_array(mysqli_query($db, $sql))) {
            if($db_table == "utilisateurs") { #Recupere les valeurs pour la table Patients
                $_SESSION['idUtilisateur'] = $pseudo[$db_id];
            header("Location: http://localhost/TicketManagment2/profilEmploye.php");
    
        } else {
            header("Location: http://localhost/TicketManagment2/profilAdministrateur.php");
            }
            
            $_SESSION['name'] = $pseudo[$db_champ1];
            $_SESSION['fname'] = $pseudo[$db_champ2];

            $_SESSION['pseudo'] = $pseudo[$db_champ1] . " " . $pseudo[$db_champ2]; #Garde le pseudo dans une variable de session
            $_SESSION['is_auth'] = true; #L'utilisateur est authentifie
            $_SESSION['idInformaticien'] = $pseudo[$db_id]; #Recupere l'ID de l'utilisateur
        } else {
            echo '<div class="alert" style="height:20px; width: 20%; margin: 5px;">
            <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
            <strong>Erreur</strong> pas de compte associé.
          </div>';

        }

        if($db_table == "utilisateurs") {
            $_SESSION['is_admin'] = false;
          }  else if($db_table == "informaticiens"){
            $_SESSION['is_admin'] = true;
            }
    }
}
