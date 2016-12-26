<?php
/**
 * User: roberson.faria
 * Date: 26/12/16
 * Time: 11:52
 */

namespace RobersonFaria\Validation\Contracts;


interface CustomValidationInterface
{
    public static function validate($attribute, $value);
}