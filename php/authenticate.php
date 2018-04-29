<?php

if(!isset($_POST)) die();

require_once 'dbConnect.php';
// opening db connection
$db = new dbConnect();
$conn = $db->connect();

$json = array();
$json = json_decode(file_get_contents("php://input"));
$email = $json->email;
$password = $json->password;

$query = "Select password from admin where email='$email'";
$result = $conn->query($query);

$response = [];

$noofrows= mysqli_num_rows($result);

if($noofrows == 0)
{
    $response['status'] = 'red';
    $response['message'] = 'No such user with this email';
}

else
{
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password,$row['password']))
    {
        session_start();
        $response['status'] = 'green';
        $response['message'] ='loggedin';
        $response['email'] = $email;
        $response['uniqueid'] = md5(uniqid());
        $_SESSION['uniqueid'] = $response['uniqueid'];
    }
    else
    {
        $response['status'] = 'red';
        $response['message'] = 'Password doesn\'t match with email address';
    }
}

echo json_encode($response);

?>

