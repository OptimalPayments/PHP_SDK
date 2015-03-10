<?php

$optimalApiKeyId = 'your-key-id';
$optimalApiKeySecret = 'your-key-secret';
$optimalAccountNumber = 'your-account-number';
// The currencyCode should match the currency of your Optimal account. 
// The currencyBaseUnitsMultipler should in turn match the currencyCode.
// Since the API accepts only integer values, the currencyBaseUnitMultiplier is used convert the decimal amount into the accepted base units integer value.
$currencyCode = 'your-account-currency-code'; // for example: CAD
$currencyBaseUnitsMultiplier = 'currency-base-units-multiplier'; // for example: 100 

require_once('../source/optimalpayments.php');