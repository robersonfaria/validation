<?php
namespace RobersonFaria\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('custom-validation.php'),
        ],'config');

        $this->app->validator->resolver( function( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
            return new CnsValidation( $translator, $data, $rules, $messages, $customAttributes );
        });

        $this->app->validator->resolver( function( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
            return new CnpjValidation( $translator, $data, $rules, $messages, $customAttributes );
        });

        $this->app->validator->resolver( function( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
            return new CpfValidation( $translator, $data, $rules, $messages, $customAttributes );
        });

        $this->app->validator->resolver( function( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
            return new CepFormatValidation( $translator, $data, $rules, $messages, $customAttributes );
        });
    }

    public function register()
    {
        // TODO: Implement register() method.
    }
}