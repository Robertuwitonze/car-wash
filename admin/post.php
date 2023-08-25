<?php

function update_payment($data)
  {
    $status = strtolower($data->status);
    $ret = array();
    if (isset($data->status)) {
      $status = strtolower($data->status);
      if ($status == "success") {
        // $rt = new hdev_db;
        // $tab = $rt->table("payment");
        // $ck = $rt->insert("UPDATE `$tab` SET `tx_id` = :tx_id, `status` = :status WHERE `tx_ref` = :transaction_ref",[[":transaction_ref",$data->transactionId],[":tx_id",$data->spTransactionId],[":status",$status]]);

        $ret['status'] = "success";
        $ret['message'] = $data->statusDescription;
        $ret["link"] = "";
        $status = "failed";
        
      }else{

        // $rt = new hdev_db;
        // $tab = $rt->table("payment");
        // $ck = $rt->insert("UPDATE `$tab` SET  `status` = :status WHERE `tx_ref` = :transaction_ref",[[":transaction_ref",$data->transactionId],[":status",$status]]);

        $ret['status'] = "error";
        $ret['message'] = $data->statusDescription;
      }
    }else{
      $ret['status'] = "error";
      $ret['message'] = "Transaction Failed";
    }
    return $ret;
  }



$json = file_get_contents('php://input');
var_dump($json);
$json = json_decode($json);
update_payment($json);



// header('Access-Control-Allow-origin: *');
// header('Content-Type: application/json');
// header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization,X-Request-With');
// // include 'includes/config.php';


//  function Creat()
//  {
//     $inputJSON = file_get_contents('php://input');
//     $data = json_decode($inputJSON);

//     $transactionId = $data->transactionId;
//     $amount = $data-> paidAmount;
//     $servername = "localhost";
//     $username = "root";
//     $password = "";

//     $conn = new PDO("mysql:host=$servername;dbname=cwmsdb", $username, $password);
//     if($transactionId !=null && $amount != null)
//     {
//         $sql = "INSERT INTO tblTest(transactionId,amount) Values(:transactionId,:amount )";
//         $query = $conn->prepare($sql);
//         $query->bindParam(':transactionId', $transactionId, PDO::PARAM_STR);
//         $query->bindParam(':amount', $amount, PDO::PARAM_STR);
//         if($query->execute()){
//             return true;
//         }
//         else
//         {
//             return false;
//         }
//     }
//     else{
//         return false;
//     }

// }

// if(Creat())
// {
//     $response = array('message' => 'created');
//     echo json_encode($response);
   
// }
// else{
//     $response = array('message' => 'failed');
//     echo json_encode($response);
   
// }




?>