<?php
require_once 'dbConnect.php';
// opening db connection
$db = new dbConnect();
$conn = $db->connect();
$query= "Select * from members";
$conn->set_charset("utf8");
$result = $conn->query($query);

$members = array();

$id = 0;
while($row = $result->fetch_row())
{
    $id = $id + 1;
    $members[] = array("id" => $id, "name" => $row[1], "surname" => $row[2], "email" => $row[3]);
}

$response['members'] = $members;
echo json_encode($response);







?>