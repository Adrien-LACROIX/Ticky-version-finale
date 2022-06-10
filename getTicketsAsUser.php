<?php
include_once("template.php");
include_once("session.php");
include_once("conDB.php");
//
session_start();
$statut = $_POST['statut'];
$idConnectedUser = $_SESSION['idUtilisateur'];

if($statut == 0) {
    $sql = "SELECT * 
    FROM ticket 
    WHERE idEmetteur = $idConnectedUser
    AND statut = $statut
    ORDER BY dateCreationTicket DESC";
} else {
    $sql = "SELECT *
    FROM ticket
    WHERE idEmetteur = $idConnectedUser
    AND statut = $statut
    OR statut = 2
    ORDER BY dateCreationTicket ASC";
}


$lignes = [];

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_all();
    echo json_encode($row);
} else {
    echo ($sql);
}
