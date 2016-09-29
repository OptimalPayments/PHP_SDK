<?php

namespace OptimalPayments\DirectDebit;

/**
 * @property int $day
 * @property int $month
 * @property int $year
 */
class DateOfBirth extends \OptimalPayments\JSONObject
{

    protected static $fieldTypes = array(
        'day' => 'int',
        'month' => 'int',
        'year' => 'int'
    );

}
