<?php
require_once 'dbConnect.php';
// opening db connection
$db = new dbConnect();
$conn = $db->connect();

$query= "Select equipmentID, equipmentName, modelName, brandName from equipment";
$conn->set_charset("utf8");

$result = $conn->query($query);

$equipments = array();


$id = 0;
while($row = $result->fetch_row())
{
    $id = $id +1;
    $equipments[] = array("id"=> $id, "equipmentID" => $row[0], "equipmentName" => $row[1], "modelName" => $row[2], "brandName" => $row[3]);
}

$response['equipments'] = $equipments;

$query = "
Select e.equipmentName, e.modelName, e.brandName, i.storageNo, i.inventoryID,i.state
from equipment e, inventory i
where i.equipmentID = e.equipmentID
order by i.storageNo,e.modelName
";

$result = $conn->query($query);

$inventory = array();
$id = 0;
while($row = $result->fetch_row())
{
    if($row[5] == 1)
    {
        $id = $id+1;
        $inventory[] = array("inventoryID" => $id, "equipmentName" => $row[0], "modelName" => $row[1], "brandName" => $row[2], "storage" => $row[3], "dbid" => $row[4]);
    } 
}

$query = "Select e.equipmentName, e.modelName, e.brandName 
          From equipment e, inventory i, maintenance m
          Where m.inventoryID = i.inventoryID and i.equipmentID = e.equipmentID";

$result = $conn->query($query);

$maintain = array();
$id = 0;
while($row = $result->fetch_row())
{
    $id = $id+1;
    $maintain[] = array("id"=> $id,"equipmentName" => $row[0], "modelName" => $row[1], "brandName" => $row[2]);
}

$query ="Select b.startingDate, b.borrowReason, e.equipmentName, e.modelName, b.responsible 
         From borrows b, inventory i, equipment e 
         Where b.inventoryID = i.inventoryID and i.equipmentID = e.equipmentID
         order by b.borrowid"; 
$query2 = "Select m.name, m.surname
         From members m, borrows b
         Where m.id = b.memberID
         Order by b.borrowid ";

$result = $conn->query($query);
$result2 = $conn->query($query2);


$borrow = array();
$id = 0;
while($row = $result->fetch_row())
{
    $row2 = $result2->fetch_row();
    $id = $id+1;
    $borrow[] = array("id"=> $id,"startingdate" => $row[0], "borrowreason" => $row[1], "equipmentname" => $row[2],"modelname" => $row[3],"responsible" => $row[4], "name" => $row2[0], "surname" => $row2[1]);
}

$response['maintain'] = $maintain;
$response['inventory'] = $inventory;
$response['borrow'] = $borrow;

echo json_encode($response);

?>