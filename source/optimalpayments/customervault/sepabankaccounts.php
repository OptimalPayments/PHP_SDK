<?php

    namespace OptimalPayments\CustomerVault;

    /**
     * @property string $id
     * @property string $nickName
     * @property string $merchantRefNum
     * @property string $status
     * @property string $statusReason
     * @property string $iban
     * @property string $bic
     * @property string $accountHolderName
     * @property string $lastDigits
     * @property string $billingAddressId
     * @property string $paymentToken
     */
    class SEPABankaccounts extends \OptimalPayments\JSONObject
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
            'iban' => 'string',
            'bic' => 'string',
            'accountHolderName' => 'string',
            'lastDigits' => 'string',
            'billingAddressId' => 'string',
            'paymentToken' => 'string',
            'mandates' => 'array:\OptimalPayments\CustomerVault\Mandates'
        );

    }
