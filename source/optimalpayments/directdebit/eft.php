<?php


namespace OptimalPayments\DirectDebit;

/**
 * @property string $paymentToken
 * @property string $paymentDescriptor
 * @property string $accountHolderName
 * @property string $accountNumber
 * @property string $transitNumber
 * @property string $institutionId
 * @property string $lastDigits
 */
class EFT extends \OptimalPayments\JSONObject
{

    protected static $fieldTypes = array(
        'paymentToken' => 'string',
        'paymentDescriptor' => 'string',
        'accountHolderName' => 'string',
        'accountNumber' => 'string',
        'transitNumber' => 'string',
        'institutionId' => 'string',
        'lastDigits' => 'string'
    );

}
