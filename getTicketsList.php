<?php
include_once("template.php");
include_once("session.php");
include_once("conDB.php");
include_once("getTicketContent.php");
session_start();
$statut = $_POST['statut'];


if ($statut == 0) {
    $sql = "SELECT idTicket, contenuTicket, severiteTicket, ticketLevel, statut, titreTicket, dateCreationTicket, nomEmetteurTicket, prenomEmetteurTicket, solutionTicket ,dateResolution 
    FROM ticket 
    WHERE statut = $statut
    AND ticketLevel = 0
    ORDER BY dateCreationTicket ASC";
} else {
    $sql = "SELECT idTicket, contenuTicket, severiteTicket, ticketLevel, statut, titreTicket, dateCreationTicket, nomEmetteurTicket, prenomEmetteurTicket, solutionTicket ,dateResolution 
    FROM ticket 
    WHERE statut = $statut
    OR statut = 2
    ORDER BY statut ASC";
}


$lignes = [];

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_all();
    echo json_encode($row);
} else {
    echo ($sql);
}
