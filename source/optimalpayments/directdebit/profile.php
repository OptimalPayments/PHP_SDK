<?php

namespace OptimalPayments\DirectDebit;

/**
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $ssn
 * @property \OptimalPayments\DirectDebit\DateOfBirth $dateOfBirth
 */
class Profile extends \OptimalPayments\JSONObject
{

    protected static $fieldTypes = array(
        'firstName' => 'string',
        'lastName' => 'string',
        'email' => 'string',
        'ssn' => 'string',
        'dateOfBirth' => '\OptimalPayments\DirectDebit\DateOfBirth'
    );

}
