<?php
require_once 'dbConnect.php';
// opening db connection
$db = new dbConnect();
$conn = $db->connect();

$query= "Select equipmentID, equipmentName, modelName, brandName from equipment";
$conn->set_charset("utf8");

$result = $conn->query($query);

$equipments = array();

while($row = $result->fetch_row())
{
    $equipments[] = array("equipmentID" => $row[0], "equipmentName" => $row[1], "modelName" => $row[2], "brandName" => $row[3]);
}

$response['equipments'] = $equipments;

$query = "
Select e.equipmentName, e.modelName, e.brandName, i.storageNo 
from equipment e, inventory i
where i.equipmentID = e.equipmentID
order by i.storageNo,e.modelName
";

$result = $conn->query($query);

$inventory = array();
$id = 0;
while($row = $result->fetch_row())
{
    $id = $id+1;
    $inventory[] = array("inventoryID" => $id, "equipmentName" => $row[0], "modelName" => $row[1], "brandName" => $row[2], "storage" => $row[3]);
}



$response['inventory'] = $inventory;

echo json_encode($response);

?>