<?php
/*
 * Copyright (c) 2014 Optimal Payments
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
 * associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or
 * substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT
 * NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace OptimalPayments\CardPayments;

/**
 * @property string $id
 * @property string $merchantRefNum
 * @property int $amount
 * @property bool $settleWithAuth
 * @property int $availableToSettle
 * @property string $childAccountNum
 * @property \OptimalPayments\CardPayments\Card $card
 * @property \OptimalPayments\CardPayments\Authentication $authentication
 * @property string $authCode
 * @property \OptimalPayments\CardPayments\Profile $profile
 * @property \OptimalPayments\CardPayments\BillingDetails $billingDetails
 * @property \OptimalPayments\CardPayments\ShippingDetails $shippingDetails
 * @property string $recurring
 * @property string $customerIp
 * @property bool $dupCheck
 * @property string[] $keywords
 * @property \OptimalPayments\CardPayments\MerchantDescriptor $merchantDescriptor
 * @property \OptimalPayments\CardPayments\AccordD $accordD
 * @property string $description
 * @property \OptimalPayments\CardPayments\MasterPass
 * @property string $txnTime
 * @property string $currencyCode
 * @property string $avsResponse
 * @property string $cvvVerication
 * @property string $status
 * @property int[] $riskReasonCode
 * @property \OptimalPayments\CardPayments\AcquirerResponse $acquirerRresponse
 * @property \OptimalPayments\CardPayments\VisaAdditionalAuthData $visaAdditionalAuthData
 * @property \OptimalPayments\CardPayments\Settlement $settlements
 * @property \OptimalPayments\Error $error
 * @property \OptimalPayments\Link[] $links
 */
class Authorization extends \OptimalPayments\JSONObject implements \OptimalPayments\Pageable
{
    public static function getPageableArrayKey()
    {
        return 'auths';
    }

    protected static $fieldTypes = array(
         'id' => 'string',
         'merchantRefNum' => 'string',
         'amount' => 'int',
         'settleWithAuth' => 'bool',
         'availableToSettle' => 'int',
         'childAccountNum' => 'string',
         'card' => '\OptimalPayments\CardPayments\Card',
         'authentication' => '\OptimalPayments\CardPayments\Authentication',
         'authCode' => 'string',
         'profile' => '\OptimalPayments\CardPayments\Profile',
         'billingDetails' => '\OptimalPayments\CardPayments\BillingDetails',
         'shippingDetails' => '\OptimalPayments\CardPayments\ShippingDetails',
         'recurring' => array(
              'INITIAL',
              'RECURRING'
         ),
         'customerIp' => 'string',
         'dupCheck' => 'bool',
         'keywords' => 'array:string',
         'merchantDescriptor' => '\OptimalPayments\CardPayments\MerchantDescriptor',
         'accordD' => '\OptimalPayments\CardPayments\AccordD',
         'description' => 'string',
         'masterPass' => '\OptimalPayments\CardPayments\MasterPass',
         'txnTime' => 'string',
         'currencyCode' => 'string',
         'avsResponse' => array(
              'MATCH',
              'MATCH_ADDRESS_ONLY',
              'MATCH_ZIP_ONLY',
              'NO_MATCH',
              'NOT_PROCESSED',
              'UNKNOWN'
         ),
         'cvvVerification' => array(
              'MATCH',
              'NO_MATCH',
              'NOT_PROCESSED',
              'UNKNOWN'
         ),
         'status' => array(
              'RECEIVED',
              'COMPLETED',
              'HELD',
              'FAILED',
              'CANCELLED'
         ),
         'riskReasonCode' => 'array:int',
         'acquirerResponse' => '\OptimalPayments\CardPayments\AcquirerResponse',
         'visaAdditionalAuthData' => '\OptimalPayments\CardPayments\VisaAdditionalAuthData',
         'settlements' => 'array:\OptimalPayments\CardPayments\Settlement',
         'error' => '\OptimalPayments\Error',
         'links' => 'array:\OptimalPayments\Link'
    );

}
