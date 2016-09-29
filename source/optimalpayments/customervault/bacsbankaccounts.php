<?php

    namespace OptimalPayments\CustomerVault;

    /**
     * @property string $id
     * @property string $nickName
     * @property string $merchantRefNum
     * @property string $status
     * @property string $statusReason
     * @property string $accountNumber
     * @property string $accountHolderName
     * @property string $sortCode
     * @property string $lastDigits
     * @property string $billingAddressId
     * @property string $paymentToken
     * @property string $mandates
     */
    class BACSBankaccounts extends \OptimalPayments\JSONObject
    {

        protected static $fieldTypes = array(
            'id' => 'string',
            'nickName' => 'string',
            'merchantRefNum' => 'string',
            'status' =>  array(
                'ACTIVE',
                'INVALID',
                'INACTIVE'
            ),
            'statusReason' => 'string',
            'accountNumber' => 'string',
            'accountHolderName' => 'string',
            'sortCode' => 'string',
            'lastDigits' => 'string',
            'billingAddressId' => 'string',
            'paymentToken' => 'string',
            'mandates' => 'array:\OptimalPayments\CustomerVault\Mandates'
        );

    }
