<?php

    namespace OptimalPayments\CustomerVault;

    /**
     * @property String $id
     * @property String $reference
     * @property String $bankAccountId
     * @property String $status
     * @property String $paymentToken
     * @property String $statusChangeDate
     * @property String $statusReasonCode
     * @property String $statusReason
     */
    class Mandates extends \OptimalPayments\JSONObject
    {

        protected static $fieldTypes = array(
            'id' => 'string',
            'reference' => 'string',
            'bankAccountId' => 'string',
            'status' => array(
                'INITIAL',
                'PENDING',
                'DECLINED',
                'BATCHED',
                'ACTIVE',
                'CANCELLED',
                'REJECTED',
                'DISPUTED',
                'INACTIVE'
            ),
            'paymentToken' => 'string',
            'statusChangeDate' => 'string',
            'statusReasonCode' => 'string',
            'statusReason' => 'string',
            'links' => 'array:\OptimalPayments\Link',
            'profileID' => 'string'
        );

    }
