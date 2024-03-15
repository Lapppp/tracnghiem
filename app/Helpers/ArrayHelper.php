<?php

namespace App\Helpers;


class ArrayHelper
{
    /**
     * @param array $array
     * @return bool
     */
    public static function arrayHasEmptyValue(array $array)
    {
        foreach ($array as $value) {
            if (!empty($value)) {
                return false;
            }
        }
        return true;
    }
}
