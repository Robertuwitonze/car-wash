<?php
header('Access-Control-Allow-origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization,X-Request-With');
// include 'includes/config.php';










 function Creat(){
$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON);

$transactionId = $data->transactionId;
$amount = $data-> paidAmount;
$servername = "localhost";
$username = "root";
$password = "";

    $conn = new PDO("mysql:host=$servername;dbname=cwmsdb", $username, $password);
    $sql = "INSERT INTO tblTest(transactionId,amount) Values(:transactionId,:amount )";
    $query = $conn->prepare($sql);
    $query->bindParam(':transactionId', $transactionId, PDO::PARAM_STR);
    $query->bindParam(':amount', $amount, PDO::PARAM_STR);
    if($query->execute()){
        return true;
    }
    else
    {
        return false;
    }

}

if(Creat())
{
    $response = array('message' => 'created');
    echo json_encode($response);
   
}
else{
    $response = array('message' => 'failed');
    echo json_encode($response);
   
}




?>