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
 * @property string $status
 * @property string $lastUpdate
 * @property string $authType
 * @property string $authCode
 * @property string $merchantRefNum
 * @property \OptimalPayments\HostedPayment\Transaction[] $associatedTransactions
 * @property \OptimalPayments\HostedPayment\Card $card
 * @property string $confirmationNumber
 * @property string $currencyCode
 * @property int $amount
 * @property string $paymentType
 * @property bool $settled
 * @property bool $refunded
 * @property bool $reversed
 * @property string $dateTime
 * @property string $datetime
 * @property string $reference
 * @property string $cvdVerification
 * @property string $houseNumberVerification
 * @property string $zipVerification
 * @property int[] $riskReasonCode
 * @property int $errorCode
 * @property string $errorMessage
 */
class Transaction extends \OptimalPayments\JSONObject
{
    protected static $fieldTypes = array(
         'status'=>'string',
         'lastUpdate'=>'string',
         'authType' => array(
              'auth',
              'purchase',
              'settlement',
              'refund'
         ),
         'authCode' => 'string',
         'merchantRefNum'=>'string',
         'associatedTransactions'=>'array:\OptimalPayments\HostedPayment\Transaction',
         'card'=>'\OptimalPayments\HostedPayment\Card',
         'confirmationNumber'=>'string',
         'currencyCode'=>'string',
         'amount' => 'int',
         'paymentType'=>'string',
         'settled'=>'bool',
         'refunded'=>'bool',
         'reversed'=>'bool',
         'dateTime' => 'string',
         'reference' => 'string',
         'cvdVerification'=>'string',
         'houseNumberVerification'=>'string',
         'zipVerification'=>'string',
         'riskReasonCode'=>'array:int',
         'errorCode'=>'int',
         'errorMessage'=>'string'
    );

}
