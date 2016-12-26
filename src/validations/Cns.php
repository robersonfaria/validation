<?php
/**
 * User: roberson.faria
 * Date: 22/12/16
 * Time: 17:29
 */

namespace RobersonFaria\Validation\Validations;

use RobersonFaria\Validation\Contracts\CustomValidationInterface;

class Cns implements CustomValidationInterface
{
    public static function validate($attribute, $value)
    {
        $cns = $value;
        $cnsValido = true;
        $vlrCNS = str_replace(".", "", $cns);
        // Verifica se o CNS possui 15 números e se é provisório ou definitivo para realizar as validações
        if (strlen($vlrCNS) != 15 || !is_numeric($vlrCNS) || strpos($vlrCNS, '-') !== false || $vlrCNS == '000000000000000')
            $cnsValido = false;
        else if (substr($vlrCNS, 0, 1) == '7' || substr($vlrCNS, 0, 1) == '8' || substr($vlrCNS, 0, 1) == '9')
            $cnsValido = self::calc1($vlrCNS);
        else
            $cnsValido = self::calc2($vlrCNS);

        if (!$cnsValido)
            return false;
        return true;
    }

    private static function calc1($cns)
    {
        //Variável de retorno da função. Só é alterada nos casos TRUE
        $cnsValido = false;
        $soma = 0;
        for ($i = 0; $i < 15; $i++) {
            $soma += substr($cns, $i, 1) * (15 - $i);
        }
        $resto = $soma % 11;
        if ($resto == 0)
            $cnsValido = true;
        return $cnsValido;
    }

    private static function calc2($cns)
    {
        $cnsValido = false;
        // A décima segunda e décima terceira posições do CNS definitivo devem ser sempre '0'
        if (substr($cns, 11, 1) == '0' && substr($cns, 12, 1) == '0') {
            $soma = 0;
            for ($i = 0; $i < 11; $i++) {
                $soma += substr($cns, $i, 1) * (15 - $i);
            }
            $resto = $soma % 11;
            $dv = 11 - $resto;
            if ($dv == 10) {
                if (substr($cns, 13, 1) == '1' && substr($cns, 14, 1) == '8')
                    $cnsValido = true;
            } else {
                if ($dv == 11)
                    $dv = 0;
                if (substr($cns, 13, 1) == "0" && substr($cns, 14, 1) == $dv)
                    $cnsValido = true;
            }
        }
        return $cnsValido;
    }

}