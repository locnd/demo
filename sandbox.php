<?php

// eWAY API key & Password
$api_key = '44DD7CWRgzetjiLUyZftrCbHz+gRi9JuxCcQUGB3ZYpFYXAOPNk0eY80yI9kq4bRMHMafS';
$api_password = 'hXB23Ucc';
$accessCode = $_GET['AccessCode'];
$accessCode = 'C3AB998agXu2npfJZaaFgRc-pounyRBbp-lhilb9DwEY7_shVoR6iMvw_kH0mNs_Q2rfynYq02uwJ9HRIL-MOMSnQH6aRE5eA-oy5veRM4bWQehHX7dlOvrVx9TqaVhSiGz2X';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.ewaypayments.com/Transaction/'.$accessCode);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key . ":" . $api_password);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$output = curl_exec($ch);
curl_close($ch);

$result = json_decode($output);

 exit(json_encode($result));
if ($result->Transactions[0]->TransactionStatus) {
    echo "Transaction Id = ".$result->Transactions[0]->TransactionID;
} else {
    echo "Transaction declined";
}