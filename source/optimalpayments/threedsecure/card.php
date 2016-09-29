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

namespace OptimalPayments\ThreeDSecure;

/**
 * @property string $paymentToken
 * @property string $cardNum
 * @property string $type
 * @property string $lastDigits
 * @property \OptimalPayments\ThreeDSecure\CardExpiry $cardExpiry
 * @property string $cvv
 * @property string $track1
 * @property string $track2
 */
class Card extends \OptimalPayments\JSONObject
{

    protected static $fieldTypes = array(
        'paymentToken' => 'string',
        'cardNum' => 'string',
        'cardType' => array(
            'AM',
            'DC',
            'DI',
            'JC',
            'MC',
            'MD',
            'SF',
            'SO',
            'VI',
            'VD',
            'VE'
        ),
        'lastDigits' => 'string',
        'cardExpiry' => '\OptimalPayments\ThreeDSecure\CardExpiry',
        'cvv' => 'string',
        'track1' => 'string',
        'track2' => 'string'
    );

}