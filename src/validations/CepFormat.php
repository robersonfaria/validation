<?php
/**
 * User: roberson.faria
 * Date: 26/12/16
 * Time: 11:07
 */

namespace RobersonFaria\Validation\Validations;


use RobersonFaria\Validation\Contracts\CustomValidationInterface;

class CepFormat implements CustomValidationInterface
{

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public static function validate($attribute, $value)
    {
        if (preg_match("/^[0-9]{5}-[0-9]{3}/", trim($value))) {
            return true;
        } else {
            return false;
        }
    }

}