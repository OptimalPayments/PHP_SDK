<?php

namespace OptimalPayments\DirectDebit;

/**
 * @property String $paymentToken
 * @property String $mandateReference
 * @property String $accountHolderName
 * @property String $iban
 * @property String $lastDigits
 */
class SEPA extends \OptimalPayments\JSONObject
{

    protected static $fieldTypes = array(
        'paymentToken' => 'string',
        'mandateReference' => 'string',
        'accountHolderName' => 'string',
        'iban' => 'string',
        'lastDigits' => 'string'
    );

}
