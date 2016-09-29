<?php

namespace OptimalPayments\DirectDebit;

/**
 * @property string $carrier
 * @property string $shipMethod
 * @property string $recipientName
 * @property string $street
 * @property string $street2
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $zip
 */
class ShippingDetails
{

//put your code here

    protected static $fieldTypes = array(
        'carrier' => array(
            'APC',
            'APS',
            'CAD',
            'DHL',
            'FEX',
            'RML',
            'UPS',
            'USPS',
            'CLK',
            'EMS',
            'NEX'
        ),
        'shipMethod' => array(
            'N',
            'T',
            'C',
            'O'
        ),
        'recipientName' => 'string',
        'street' => 'string',
        'street2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'country' => 'string',
        'zip' => 'string'
    );

}

?>
