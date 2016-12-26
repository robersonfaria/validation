<?php
/**
 * User: roberson.faria
 * Date: 26/12/16
 * Time: 10:50
 */

namespace RobersonFaria\Validation\Validations;

use RobersonFaria\Validation\Contracts\CustomValidationInterface;

class Cnpj implements CustomValidationInterface
{

    /**
     * Função para validação do cnpj retirado do https://gist.github.com/willianmano/1a8abab569e4ae8c2604136d87870c43
     * @param $attribute
     * @param $value
     * @return bool
     */
    public static function validate($attribute, $value)
    {
        /*
        Etapa 1: Cria um array com apenas os digitos numéricos,
        isso permite receber o cnpj em diferentes
        formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00"
        etc...
        */
        $cnpj = preg_replace('/\D/', '', $value);
        $num = array();

        /* Cria um array com os valores */
        for ($i = 0; $i < (strlen($cnpj)); $i++) {
            $num[] = $cnpj[$i];
        }

        //Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
        if (count($num) != 14) {
            return false;
        }
        /*
        Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria
        um cnpj válido após o calculo dos dígitos verificares
        e por isso precisa ser filtradas nesta etapa.
        */
        if ($num[0] == 0 && $num[1] == 0 && $num[2] == 0
            && $num[3] == 0 && $num[4] == 0 && $num[5] == 0
            && $num[6] == 0 && $num[7] == 0 && $num[8] == 0
            && $num[9] == 0 && $num[10] == 0 && $num[11] == 0
        ) {
            return false;
        } //Etapa 4: Calcula e compara o primeiro dígito verificador.
        else {
            $j = 5;
            for ($i = 0; $i < 4; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }

            $soma = array_sum($multiplica);
            $j = 9;

            for ($i = 4; $i < 12; $i++) {
                $multiplica[$i] = $num[$i] * $j;
                $j--;
            }

            $soma = array_sum($multiplica);
            $resto = $soma % 11;

            if ($resto < 2) {
                $dg = 0;
            } else {
                $dg = 11 - $resto;
            }

            if ($dg != $num[12]) {
                return false;
            }
        }
        //Etapa 5: Calcula e compara o segundo dígito verificador.

        $j = 6;
        for ($i = 0; $i < 5; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }

        $soma = array_sum($multiplica);
        $j = 9;

        for ($i = 5; $i < 13; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }

        $soma = array_sum($multiplica);
        $resto = $soma % 11;

        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }

        if ($dg != $num[13]) {
            return false;
        } else {
            return true;
        }
    }
}