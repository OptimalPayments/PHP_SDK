<?php

    namespace OptimalPayments\DirectDebit;

    /**
     * @property String $id
     * @property String $merchantRefNum
     * @property String $amount
     * @property \OptimalPayments\DirectDebit\ach $ach
     * @property \OptimalPayments\DirectDebit\eft $eft
     * @property \OptimalPayments\DirectDebit\bacs $bacs
     * @property \OptimalPayments\DirectDebit\sepa $sepa
     * @property \OptimalPayments\DirectDebit\profile $profile
     * @property \OptimalPayments\DirectDebit\billingDetails $billingDetails
     * @property String $customerIp
     * @property String $dupCheck
     * @property String $txnTime
     * @property String $currencyCode
     * @property \OptimalPayments\Error $error
     * @property String $status
     */
    class Purchase extends \OptimalPayments\JSONObject implements \OptimalPayments\Pageable {

        public static function getPageableArrayKey() {
            return "purchases";
        }

        protected static $fieldTypes = array(
            'id' => 'string',
            'merchantRefNum' => 'string',
            'amount' => 'string',
            'ach' => '\OptimalPayments\DirectDebit\ACH',
            'eft' => '\OptimalPayments\DirectDebit\EFT',
            'bacs' => '\OptimalPayments\DirectDebit\BACS',
            'sepa' => '\OptimalPayments\DirectDebit\SEPA',
            'profile' => '\OptimalPayments\DirectDebit\Profile',
            'billingDetails' => '\OptimalPayments\DirectDebit\BillingDetails',
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
