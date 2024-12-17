<?php 
    function tratarValorDecimal($valor) {
        if (isset($valor) && $valor != "") {
            $valor = preg_replace("/\.(?=\d{3}(?:,|\.|$))/", "", $valor);

            $valor = str_replace(",", ".", $valor);

            $valor = (float)$valor;

            $valor = number_format($valor, 2, ".", "");
        } else {
            $valor = "0.00";
        }
        return $valor;
    }

    function limparNumeros($input) {
        return preg_replace('/\D/', '', $input);
    }

    function validarCampos($titulo, $campos) {
        foreach ($campos as $nomeCampo => $valor) {
            if (is_null($valor) || (is_string($valor) && empty($valor))) {
                redirecionar($titulo, "Você não informou o/a $nomeCampo.", "red");
            } else if (is_numeric($valor) && $valor <= 0) {
                redirecionar($titulo, "O/A $nomeCampo não pode ser menor ou igual a zero.", "red");
            }
        }
    }
?>
