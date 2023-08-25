<?php
header('Access-Control-Allow-origin: *');
header('Content-Type: application/json');
// This script will handle the callback from the payment gateway

// Verify that the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    exit("Bad Request");
}

// Assuming the payment gateway sends data in JSON format
$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON, true);

// Validate the data received from the payment gateway
// You would typically check for things like transaction status, amount, etc.
$transactionStatus = $data['status'];
$amount = $data['amount'];

// Perform your business logic based on the transaction status
if ($transactionStatus === 'success') {
    // Payment was successful, update your database or perform other necessary actions
    // You might also send a confirmation email to the user
    echo("successfully paid");
} else {
    echo("payment failed");
}

// Send a response back to the payment gateway
$response = array('status' => 'success');

echo json_encode($response);
?>