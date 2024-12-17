<?php 
    function formatarTimestamp($datetime) {
        if ($datetime == null || $datetime == "") {
            return "";
        }

        $timestamp = strtotime($datetime);

        if ($timestamp === false) {
            return "Data e hora inválidas";
        }

        $dataFormatada = date("d/m/Y H:i", $timestamp);

        return $dataFormatada;
    }

    function formatarData($data) {
        if ($data) {
            $data_formatada = DateTime::createFromFormat("Y-m-d", $data)->format("d/m/Y");
        } else {
            $data_formatada = "";
        }

        return $data_formatada;
    }

    function formatarValorReal($valor) {
        if ($valor) {
            return "R$ " . number_format($valor, 2, ",", ".");
        } else {
            return "";
        }
    }
?>
