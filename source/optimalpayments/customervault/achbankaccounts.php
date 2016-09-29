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
     * @property string $routingNumber
     * @property string $accountType
     * @property string $lastDigits
     * @property string $billingAddressId
     * @property string $paymentToken
     */
    class ACHBankaccounts extends \OptimalPayments\JSONObject
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
            'routingNumber' => 'string',
            'accountType' => array(
                'CHECKING',
                'LOAN',
                'SAVINGS'
            ),
            'lastDigits' => 'string',
            'billingAddressId' => 'string',
            'paymentToken' => 'string'
        );

    }
