<?php

header('Content-Type: text/html; charset=utf-8');

require_once 'dbConnect.php';
// opening db connection
$db = new dbConnect();
$conn = $db->connect();
    
$json = array();
$json = json_decode(file_get_contents("php://input"));
$conn->set_charset("utf8");

$itemID = $json->maintain->item;
$responsible = $json->responsible;

date_default_timezone_set('Europe/Istanbul');
$date = date('d/m/Y G:i:s', time());



$query = "Insert into maintenance (inventoryID, starttime, responsible) values ('$itemID', '$date', '$responsible')";
$query2 = "Update inventory set state=0 where inventoryID = '$itemID'";

$conn->query($query);
$conn->query($query2);

?>