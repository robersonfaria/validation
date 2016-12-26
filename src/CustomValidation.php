<?php
/**
 * User: roberson.faria
 * Date: 26/12/16
 * Time: 11:49
 */

namespace RobersonFaria\Validation;

use Illuminate\Container\Container;
use Illuminate\Validation\Validator;
use RobersonFaria\Validation\Validations\CepFormat;
use RobersonFaria\Validation\Validations\Cnpj;
use RobersonFaria\Validation\Validations\Cns;
use RobersonFaria\Validation\Validations\Cpf;

class CustomValidation extends Validator
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
        $this->_custom_messages = config('custom-validation.'.app()->getLocale());
    }

    protected function _set_custom_stuff()
    {
        $this->setCustomMessages($this->_custom_messages);
    }


    public function validateCns($attribute, $value)
    {
        return Cns::validate($attribute,$value);
    }

    public function validateCpf($attribute,$value){
        return Cpf::validate($attribute,$value);
    }

    public function validateCnpj($attribute,$value){
        return Cnpj::validate($attribute,$value);
    }

    public function validateCepFormat($attribute,$value){
        return CepFormat::validate($attribute,$value);
    }

}