<?php

include_once('conDB.php');

$id = $_POST['ticketId'];
$content = $_POST['ticketContent'];

$contentS = htmlspecialchars($content, ENT_QUOTES);

$query = "UPDATE `ticket` SET `solutionTicket`='$contentS', `statut`=1 WHERE `idTicket` = $id;";

$result = $conn->query($query);

echo $result;
?>