<?php
namespace RobersonFaria\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{

    public function boot(){

        Validator::extend('cpf', 'RobersonFaria\Validation\Validations\Cpf@validate');
        Validator::extend('cnpj', 'RobersonFaria\Validation\Validations\Cnpj@validate');
        Validator::extend('cns', 'RobersonFaria\Validation\Validations\Cns@validate');
        Validator::extend('cep_format', 'RobersonFaria\Validation\Validations\CepFormat@validate');
    }

    public function register()
    {

    }
}