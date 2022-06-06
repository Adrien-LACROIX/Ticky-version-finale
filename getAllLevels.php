<?php
include_once("session.php");
include_once("conDB.php");

$level = $_POST['level'];
$id = $_POST['ticketId'];

$query = "UPDATE `ticket` SET `ticketLevel`=$level WHERE `idTicket` = $id;";

$result = $conn->query($query);

echo $result;
?>