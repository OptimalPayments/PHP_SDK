<?php
require_once('config.php');

use OptimalPayments\OptimalApiClient;
use OptimalPayments\Environment;
use OptimalPayments\CustomerVault\Profile;
use OptimalPayments\CustomerVault\Address;
use OptimalPayments\CustomerVault\Card;
use OptimalPayments\CardPayments\Authorization;

if ($_POST) {
	$client = new OptimalApiClient($optimalApiKeyId, $optimalApiKeySecret, Environment::TEST, $optimalAccountNumber);
	try {
		$profile = $client->customerVaultService()->createProfile(new Profile(array(
			 "merchantCustomerId" => $_POST['merchant_customer_id'],
			 "locale" => "en_US",
			 "firstName" => $_POST['first_name'],
			 "lastName" => $_POST['last_name'],
			 "email" => $_POST['email']
		)));
		$address = $client->customerVaultService()->createAddress(new Address(array(
			 "nickName" => "home",
			 'street' => $_POST['street'],
			 'city' => $_POST['city'],
			 'state' => $_POST['state'],
			 'country' => $_POST['country'],
			 'zip' => $_POST['zip'],
			 "profileID" => $profile->id
		)));
		$card = $client->customerVaultService()->createCard(new Card(array(
			 "nickName" => "Default Card",
			 'cardNum' => $_POST['card_number'],
			 'cardExpiry' => array(
				  'month' => $_POST['card_exp_month'],
				  'year' => $_POST['card_exp_year']
			 ),
			 'billingAddressId' => $address->id,
			 "profileID" => $profile->id
		)));
		$auth = $client->cardPaymentService()->authorize(new Authorization(array(
			 'merchantRefNum' => $_POST['merchant_ref_num'],
			 'amount' => $_POST['amount'] * $currencyBaseUnitsMultiplier,
			 'settleWithAuth' => true,
			 'card' => array(
				  'paymentToken' => $card->paymentToken
			 )
		)));
		die('Payment successful! ID: ' . $auth->id);
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
		var_dump($e->getMessage());
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Optimal SDK - CardPayment With Customer Vault</title>
	</head>
	<body>
		<form method="post">
			<fieldset>
				<legend>Billing Details</legend>
				<div>
					<label>
						Merchant Customer Id: 
						<input type="input" name="merchant_customer_id" size="30" value="<?php
						if (isset($_POST['merchant_customer_id'])) {
							echo $_POST['merchant_customer_id'];
						} else {
							echo uniqid('cust-' . date('Ymd-'));
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						First Name: 
						<input type="input" name="first_name" value="<?php
						if (isset($_POST['first_name'])) {
							echo $_POST['first_name'];
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
				<div>
					<label>
						Card Number: 
						<input type="input" autocomplete="off" name="card_number" value="<?php
						if (isset($_POST['card_number'])) {
							echo $_POST['card_number'];
						} else {
							echo "4444333322221111";
						}
						?>"/>
					</label>
				</div>
				<div>
					<label>
						Card Expiry: 
						<select name="card_exp_month">
							<?php
							$currentMonth = Date('n');
							for ($i = 1; $i <= 12; $i++) {
								echo '<option value="' . $i . '"' . (((isset($_POST['card_exp_month']) && $_POST['card_exp_month'] == $i) || (!isset($_POST['card_exp_month']) && $i == $currentMonth)) ? ' selected' : '') . '>' . DateTime::createFromFormat('!m', $i)->format('F') . '</option>';
							}
							?>
						</select>
					</label>
				</div>
				<div>
					<label>
						Card Expiry: 
						<select name="card_exp_year">
							<?php
							$currentYear = Date('Y');
							for ($i = $currentYear; $i < $currentYear + 5; $i++) {
								echo '<option value="' . $i . '"' . (((isset($_POST['card_exp_year']) && $_POST['card_exp_year'] == $i) || (!isset($_POST['card_exp_year']) && $i == $currentYear)) ? ' selected' : '') . '>' . $i . '</option>';
							}
							?>
						</select>
					</label>
				</div>
			</fieldset>
			<input type="submit" />
		</form>
	</body>
</html>