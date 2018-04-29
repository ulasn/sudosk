<?php

$json = array();
$json = json_decode(file_get_contents("php://input"));

mail("sudosk@sabanciuniv.edu", "contact", $json->text);


?>