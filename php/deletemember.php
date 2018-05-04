<?php

header('Content-Type: text/html; charset=utf-8');

require_once 'dbConnect.php';
// opening db connection
$db = new dbConnect();
$conn = $db->connect();
    
$json = array();
$json = json_decode(file_get_contents("php://input"));
$conn->set_charset("utf8");

$name = $json->name;
$surname =$json->surname;
$email = $json->email;

$query= "Delete from members where email ='$email'";

$result = $conn->query($query);

?>