
<?php
include 'includes/config.php';
if (isset($_POST['pay'])) {
    $phone = "25" . $_POST['phone_number'];
    $amount = $_POST['amount'];
    $random = random_int(100, 999);

    $curl = curl_init();

    $bookingid = $_POST['request_id'];
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://opay-api.oltranz.com/opay/paymentrequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '
{
  "telephoneNumber" : "' . $phone . '",
  "amount" : "' . $amount . '",
  "organizationId" : "951486e5-491c-4862-b8f7-a6d82fca10af",
  "description" : "Payment for Car wash",
  "callbackUrl" : "",
  "transactionId" : "03c1e56b-' . $random . 'b-4cf5-a949-7521072ts0gsf"
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $response = json_decode($response);

    curl_close($curl);
    if ($httpcode == 200 && is_object($response)) {

        if ($response->status == "PENDING") {

            $pmade = 'mobile';
            // $transactionno = $_POST['transactionno'];
            // $message = $_POST['message'];

            // $sql = "update  tblcarwashbooking set paymentStatus='payed',paymentMode=:pmade where bookingId=:bookingid";
            // $query = $dbh->prepare($sql);
            // $query->bindParam(':pmade', $pmade, PDO::PARAM_STR);
            // $query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
            // $query->execute();
            echo '<script>alert("Please continue by allowing the payment on the phone. If the prompt fails to come out dial *182*7*1#");</script>';

            echo '<script>window.location="complete-booking.php";</script>';


            exit();
        } else {
            echo '<script>alert("user number with enought money !!");</script>';
            echo '<script>window.location="pay-booking.php";</script>';
        }
    }
}
