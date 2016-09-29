<?php

namespace OptimalPayments\DirectDebit;

/**
 * @property String $paymentToken paymentToken
 * @property Array $payMethod
 * @property String $paymentDescriptor
 * @property String $accountHolderName
 * @property Array $accountType
 * @property String $accountNumber
 * @property String $routingNumber
 * @property String $lastDigits
 */
class ACH extends \OptimalPayments\JSONObject
{

    protected static $fieldTypes = array(
        'paymentToken' => 'string',
        'payMethod' =>
        array('WEB',
            'TEL',
            'PPD',
            'CCD'),
        'paymentDescriptor' => 'string',
        'accountHolderName' => 'string',
        'accountType' =>
        array('SAVINGS',
            'CHECKING',
            'LOAN'),
        'accountNumber' => 'string',
        'routingNumber' => 'string',
        'lastDigits' => 'string'
    );

}
