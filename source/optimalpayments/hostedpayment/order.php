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

namespace OptimalPayments\HostedPayment;

/**
 * @property string $id
 * @property string $merchantRefNum
 * @property string $currencyCode
 * @property int $totalAmount
 * @property string $customerIp
 * @property email $customerNotificationEmail
 * @property email $merchantNotificationEmail
 * @property string $dueDate
 * @property \OptimalPayments\HostedPayment\Profile $profile
 * @property \OptimalPayments\HostedPayment\CartItem[] $shoppingCart
 * @property \OptimalPayments\HostedPayment\AncillaryFee[] $ancillaryFees
 * @property \OptimalPayments\HostedPayment\BillingDetails $billingDetails
 * @property \OptimalPayments\HostedPayment\ShippingDetails $shippingDetails
 * @property \OptimalPayments\HostedPayment\Callback[] $callback
 * @property \OptimalPayments\HostedPayment\Redirect[] $redirect
 * @property \OptimalPayments\HostedPayment\Link[] $link
 * @property string[] $paymentMethod
 * @property \OptimalPayments\HostedPayment\KeyValuePair[] $addendumData
 * @property \OptimalPayments\HostedPayment\Locale $locale
 * @property \OptimalPayments\HostedPayment\KeyValuePair[] $extendedOptions
 * @property \OptimalPayments\HostedPayment\Transaction[] $associatedTransactions
 * @property \OptimalPayments\HostedPayment\Transaction $transaction
 * @property \OptimalPayments\Error $error
 * @property \OptimalPayments\Link[] $links
 */
class Order extends \OptimalPayments\JSONObject implements \OptimalPayments\Pageable
{
    public static function getPageableArrayKey()
    {
        return "records";
    }

    protected static $fieldTypes = array(
         'id' => 'string',
         'merchantRefNum' => 'string',
         'currencyCode' => 'string',
         'totalAmount' => 'int',
         'customerIp' => 'string',
         'customerNotificationEmail' => 'email',
         'merchantNotificationEmail' => 'email',
         'dueDate' => 'string',
         'profile' => '\OptimalPayments\HostedPayment\Profile',
         'shoppingCart' => 'array:\OptimalPayments\HostedPayment\CartItem',
         'ancillaryFees' => 'array:\OptimalPayments\HostedPayment\AncillaryFee',
         'billingDetails' => '\OptimalPayments\HostedPayment\BillingDetails',
         'shippingDetails' => '\OptimalPayments\HostedPayment\ShippingDetails',
         'callback' => 'array:\OptimalPayments\HostedPayment\Callback',
         'redirect' => 'array:\OptimalPayments\HostedPayment\Redirect',
         'link' => 'array:\OptimalPayments\HostedPayment\Link',
         'mode' => 'string',
         'type' => 'string',
         'paymentMethod' => 'array:string',
         'addendumData' => 'array:\OptimalPayments\HostedPayment\KeyValuePair',
         'locale'=>array(
              'en_US',
              'fr_CA',
              'en_GB'
         ),
         'extendedOptions' => 'array:\OptimalPayments\HostedPayment\KeyValuePair',
         'associatedTransactions' => 'array:\OptimalPayments\HostedPayment\Transaction',
         'transaction'=> '\OptimalPayments\HostedPayment\Transaction',
         'error' => '\OptimalPayments\Error',
    );

    /**
	 *
	 * @param type $linkName
	 * @return \OptimalPayments\HostedPayment\Link
	 * @throws OptimalException
	 */
    public function getLink($linkName)
    {
        if(!empty($this->link)) {
            foreach($this->link as $link) {
                if($link->rel == $linkName) {
                    return $link;
                }
            }
        }
        throw new OptimalException("Link $linkName not found in order.");
    }

}
