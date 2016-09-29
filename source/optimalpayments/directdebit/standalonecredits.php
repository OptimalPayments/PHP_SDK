<?php

    namespace OptimalPayments\DirectDebit;

/*
     * @property string $id
     * @property string $merchantRefNum
     * @property int $amount
     * @property \OptimalPayments\DirectDebit\ach $ach
     * @property \OptimalPayments\DirectDebit\eft $eft
     * @property \OptimalPayments\DirectDebit\bacs $bacs
     * @property \OptimalPayments\DirectDebit\profile $profile
     * @property \OptimalPayments\DirectDebit\billingDetails $billingDetails
     * @property \OptimalPayments\DirectDebit\ShippingDetails $shippingDetails
     * @property string $customerIp
     * @property string $dupCheck
     * @property string $txnTime
     * @property string $currencyCode
     * @property \OptimalPayments\Error $error
     * @property string $status
     */

    class StandaloneCredits extends \OptimalPayments\JSONObject implements \OptimalPayments\Pageable {

        public static function getPageableArrayKey() {
            return "standaloneCredits";
        }

        protected static $fieldTypes = array(
            'id' => 'string',
            'merchantRefNum' => 'string',
            'amount' => 'int',
            'ach' => '\OptimalPayments\DirectDebit\ACH',
            'eft' => '\OptimalPayments\DirectDebit\EFT',
            'bacs' => '\OptimalPayments\DirectDebit\BACS',
            'profile' => '\OptimalPayments\DirectDebit\Profile',
            'filter' => '\OptimalPayments\DirectDebit\Filter',
            'billingDetails' => '\OptimalPayments\DirectDebit\BillingDetails',
            'shippingDetails' => '\OptimalPayments\DirectDebit\ShippingDetails',
            'customerIp' => 'string',
            'dupCheck' => 'bool',
            'txnTime' => 'string',
            'currencyCode' => 'string',
            'error' => '\OptimalPayments\Error',
            'status' => array(
                'RECEIVED',
                'PENDING',
                'PROCESSING',
                'COMPLETED',
                'FAILED',
                'CANCELLED'
            ),
            'links' => 'array:\OptimalPayments\Link'
        );

        /**
         *
         * @param type $linkName
         * @return \OptimalPayments\HostedPayment\Link
         * @throws OptimalException
         */
        public function getLink( $linkName ) {
            if (!empty($this->link)) {
                foreach ($this->link as $link) {
                    if ($link->rel == $linkName) {
                        return $link;
                    }
                }
            }
            throw new OptimalException("Link $linkName not found in purchase.");
        }

    }
