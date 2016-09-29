<?php


namespace OptimalPayments\DirectDebit;

/**
 * @property String $paymentToken
 * @property String $accountHolderName
 * @property String $sortCode
 * @property String $accountNumber
 * @property String $mandateReference
 * @property String $lastDigits
 */
class BACS extends \OptimalPayments\JSONObject
{

    protected static $fieldTypes = array(
        'paymentToken' => 'string',
        'accountHolderName' => 'string',
        'sortCode' => 'string',
        'accountNumber' => 'string',
        'mandateReference' => 'string',
        'lastDigits' => 'string'
    );

}
