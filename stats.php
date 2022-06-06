<?php

include_once("template.php");
include_once("session.php");
include_once("conDB.php");
include_once("showTextLimit.php");
include_once("getTicketContent.php");
session_start();




$nRows = $pdo->query('SELECT COUNT(*) FROM ticket')->fetchColumn(); 
echo $nRows;

    ?>