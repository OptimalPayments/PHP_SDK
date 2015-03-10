<?php
require_once('config.php');

use OptimalPayments\OptimalApiClient;
use OptimalPayments\Environment;
use OptimalPayments\HostedPayment\Order;

if ($_POST) {
	$client = new OptimalApiClient($optimalApiKeyId, $optimalApiKeySecret, Environment::TEST, $optimalAccountNumber);
	try {
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		
		session_start();
		
		$order = $client->hostedPaymentService()->processOrder(new Order(array(
			 'merchantRefNum' => $_POST['merchant_ref_num'],
			 'currencyCode' => $currencyCode,
			 'totalAmount' => $_POST['amount'] * $currencyBaseUnitsMultiplier,
			 'redirect' => array(
				  array(
						'rel' => 'on_success',
						'uri' => $pageURL,
						'returnKeys' => array(
							 'id'
						)
				  ),
				  array(
						'rel' => 'on_decline',
						'uri' => $pageURL,
						'returnKeys' => array(
							 'id'
						)
				  ),
				  array(
						'rel' => 'on_error',
						'uri' => $pageURL,
						'returnKeys' => array(
							 'id'
						)
				  )
			 ),
			 'customerNotificationEmail' => $_POST['email'],
			 'profile' => array(
				  'firstName' => $_POST['first_name'],
				  'lastName' => $_POST['last_name']
			 ),
			 'billingDetails' => array(
				  'street' => $_POST['street'],
				  'city' => $_POST['city'],
				  'state' => $_POST['state'],
				  'country' => $_POST['country'],
				  'zip' => $_POST['zip']
		))));
		
		$_SESSION['order'] = $order;
		
		header('location: '.$order->getLink('hosted_payment')->uri);
		die;
	} catch (OptimalPayments\NetbanxException $e) {
		echo '<pre>';
		var_dump($e->getMessage());
		if ($e->fieldErrors) {
			var_dump($e->fieldErrors);
		}
		if ($e->links) {
			var_dump($e->links);
		}
		echo '</pre>';
	} catch (\OptimalPayments\OptimalException $e) {
		//for debug only, these errors should be properly handled before production
		var_dump($e->getMessage());
	}
} elseif (isset($_GET['id'])) {
	$client = new OptimalApiClient($optimalApiKeyId, $optimalApiKeySecret, Environment::TEST, $optimalAccountNumber);
	try {
		session_start();
		if(!isset($_SESSION['order'])) {
			die('No pending order found');
		}
		$sessionOrder = $_SESSION['order'];
		unset($_SESSION['order']);
		session_destroy();
		if($sessionOrder->id != $_GET['id']) {
			die('Invalid id');
		}
		$client = new OptimalApiClient($optimalApiKeyId, $optimalApiKeySecret, Environment::TEST, $optimalAccountNumber);
		$order = $client->hostedPaymentService()->getOrder(new Order(array(
			 'id' => $_GET['id']
		)));
		if($order->transaction->status == 'success') {
			if($sessionOrder->totalAmount != $order->transaction->amount) {
				die('Invalid amount.');
			}
			die('Payment successful! ID: ' . $order->id);
		}
		var_dump($order->transaction->status);
		var_dump($order);
		die;
	} catch (OptimalPayments\NetbanxException $e) {
		echo '<pre>';
		var_dump($e->getMessage());
		if ($e->fieldErrors) {
			var_dump($e->fieldErrors);
		}
		if ($e->links) {
			var_dump($e->links);
		}
		echo '</pre>';
	} catch (\OptimalPayments\OptimalException $e) {
		//for debug only, these errors should be properly handled before production
		var_dump($e->getMessage());
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Optimal SDK - Hosted Payment With Silent Post</title>
	</head>
	<body>
		<form method="post">
			<fieldset>
				<legend>Billing Details</legend>
				<div>
					<label>
						First Name: 
						<input type="input" name="first_name" value="<?php
						if (isset($_POST['first_name'])) {
							echo $_POST['first_name'];
						} else {
							echo "First";
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						Last Name: 
						<input type="input" name="last_name" value="<?php
						if (isset($_POST['last_name'])) {
							echo $_POST['last_name'];
						} else {
							echo "Last";
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						Email: 
						<input type="input" name="email" value="<?php
						if (isset($_POST['email'])) {
							echo $_POST['email'];
						} else {
							echo "test@test.com";
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						Street: 
						<input type="input" name="street" value="<?php
						if (isset($_POST['street'])) {
							echo $_POST['street'];
						} else {
							echo "123 Fake St.";
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						City: 
						<input type="input" name="city" value="<?php
						if (isset($_POST['city'])) {
							echo $_POST['city'];
						} else {
							echo "Toronto";
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						State/Province: 
						<input type="input" name="state" value="<?php
						if (isset($_POST['state'])) {
							echo $_POST['state'];
						} else {
							echo "ON";
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						Country: 
						<select name="country">
							<option value="CA"<?php
							if (isset($_POST['country']) && $_POST['country'] == 'CA') {
								echo ' selected';
							}
							?>>Canada</option>
							<option value="US"<?php
							if (isset($_POST['country']) && $_POST['country'] == 'US') {
								echo ' selected';
							}
							?>>USA</option>
						</select>
					</label>
				</div>
				<div>
					<label>
						Zip/Postal Code: 
						<input type="input" name="zip" value="<?php
						if (isset($_POST['zip'])) {
							echo $_POST['zip'];
						} else {
							echo "M5H 2N2";
						}
						?>"/>
					</label>
				</div>
			</fieldset>
			<fieldset>
				<legend>Order Details</legend>
				<div>
					<label>
						Merchant Ref Num: 
						<input type="input" name="merchant_ref_num" value="<?php
						if (isset($_POST['merchant_ref_num'])) {
							echo $_POST['merchant_ref_num'];
						} else {
							echo uniqid(date('Ymd-'));
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						Amount: 
						<input type="input" name="amount" value="<?php
						if (isset($_POST['amount'])) {
							echo $_POST['amount'];
						} else {
							echo "100.00";
						}
						?>"/>
					</label>
				</div>
			</fieldset>
			<input type="submit" />
		</form>
	</body>
</html>
