<?php
/*
 * @Author: Mwai
 * @card processing
 */
error_reporting(E_ALL); 
ini_set('display_errors', 1);
echo "DUPA";

//include 'db.php';

//include 'functions.php';

session_start();
//$session_user_id = $_SESSION['user_id'];

//$session_price = $_SESSION['session_price'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
/*	$card_number = str_replace("+", "", $_POST['card_number']);
	$card_name = $_POST['card_name'];
	$expiry_month = $_POST['expiry_month'];
	$expiry_year = $_POST['expiry_year'];
	$cvv = $_POST['cvv'];
	$expirationDate = $expiry_month.'/'.$expiry_year;
*/
	$nonceFromTheClient = $_POST["payment_method_nonce"];
	$amount = $_POST["amount"];
	
	require_once 'braintree/Braintree.php';
	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId('7q8gbjg56f3mm6pz');
	Braintree_Configuration::publicKey('hxr5w83cqyjg9rrb');
	Braintree_Configuration::privateKey('6d4e6ba3fa58b74f18b3dbde3923bdcf');


	$result = Braintree_Transaction::sale([
	'amount'=> $amount,
	'paymentMethodNonce' =>$nonceFromTheClient,
	'options' => [
	  'submitForSettelment' => True
	  ]
	]);


/*	$result = Braintree_Transaction::sale(array(
		'amount' => $price,
		'creditCard' => array(
			'number' => $card_number,
			'cardholderName' => $card_name,
			'expirationDate' => $expiryDate,
			'cvv' => $cvv)));
*/



	if ($result->success) {
		if($result->transaction->id) {
			$braintreeCode=$result->transaction->id;
			updateUserOrder($braintreeCode, $session_user_id);
		}

	}
	else if ($result->transaction) {
		echo '{"OrderStatus": [{"status":"2"}]}';
	}
	else {
		echo '{"OrderStatus": [{"status":"0"}]}';
	}

	
}
else
{
	echo "No POST data found\n";
}

?>
