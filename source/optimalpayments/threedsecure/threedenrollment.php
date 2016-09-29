<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OptimalPayments\ThreeDSecure;

/*
 * @property string $id
 * @property string $merchantRefNum
 * @property int $amount
 * @property string $currency
 * @property \OptimalPayments\ThreeDSecure\Card $card
 * @property string $customerIp
 * @property string $userAgent
 * @property string $acceptHeader
 * @property string $merchantUrl
 * @property string $txnTime
 * @property \OptimalPayments\Error $error
 * @property string $status
 * @property string $acsURL
 * @property string $paReq
 * @property string $eci
 * @property \OptimalPayments\ThreeDSecure\profile $threeDEnrollment
 */

class ThreeDEnrollment extends \OptimalPayments\JSONObject
{

    protected static $fieldTypes = array(
        'id' => 'string',
        'merchantRefNum' => 'string',
        'amount' => 'int',
        'currency' => 'string',
        'card' => '\OptimalPayments\ThreeDSecure\Card',
        'customerIp' => 'string',
        'userAgent' => 'string',
        'acceptHeader' => 'string',
        'merchantUrl' => 'string',
        'txnTime' => 'string',
        'error' => '\OptimalPayments\Error',
        'status' => array(
            'RECEIVED',
            'COMPLETED',
            'HELD',
            'FAILED',
            'CANCELLED'
        ),
        'acsURL' => 'string',
        'paReq' => 'string',
        'eci' => 'int',
        'threeDEnrollment' => array(
            'Y',
            'N',
            'U'
        ),
        'links' => 'array:\OptimalPayments\Link'
    );

}
