<?php

header('Content-Type: text/html; charset=utf-8');

require_once 'dbConnect.php';
// opening db connection
$db = new dbConnect();
$conn = $db->connect();
    
$json = array();
$json = json_decode(file_get_contents("php://input"));
$conn->set_charset("utf8");

$equipmentID = $json->equipment;
$storage = $json->storage;

$query = "Insert into inventory (equipmentID,storageNo) values ('$equipmentID', '$storage')";
$conn->query($query);

?>