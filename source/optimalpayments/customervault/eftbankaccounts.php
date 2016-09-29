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
     * @property string $transitNumber
     * @property string $institutionId
     * @property string $lastDigits
     * @property string $billingAddressId
     * @property string $paymentToken
     */
    class EFTBankaccounts extends \OptimalPayments\JSONObject
    {

        protected static $fieldTypes = array(
            'id' => 'string',
            'nickName' => 'string',
            'merchantRefNum' => 'string',
            'status' => array(
                'ACTIVE',
                'INVALID',
                'INACTIVE'
            ),
            'statusReason' => 'string',
            'accountNumber' => 'string',
            'accountHolderName' => 'string',
            'transitNumber' => 'string',
            'institutionId' => 'string',
            'lastDigits' => 'string',
            'billingAddressId' => 'string',
            'paymentToken' => 'string'
        );

    }
