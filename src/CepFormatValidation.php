<?php
/**
 * Created by PhpStorm.
 * User: roberson.faria
 * Date: 26/12/16
 * Time: 11:07
 */

namespace RobersonFaria\Validation;


use Illuminate\Container\Container;
use Illuminate\Validation\Validator;

class CepFormatValidation extends Validator
{

    private $_custom_messages;

    public function __construct($translator, $data, $rules, $messages, $customAttributes)
    {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);

        $this->setMessage();
        $this->_set_custom_stuff();
    }

    public function app()
    {
        return Container::getInstance()->make('config');
    }

    public function setMessage()
    {
        $this->_custom_messages = ['cep_format' => config('custom-validation.' . app()->getLocale() . ".cep_format")];
    }

    protected function _set_custom_stuff()
    {
        $this->setCustomMessages($this->_custom_messages);
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function validateCepFormat($attribute, $value)
    {
        if (preg_match("/^[0-9]{5}-[0-9]{3}/", trim($value))) {
            return true;
        } else {
            return false;
        }
    }

}