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

    function formatarIE($inscricaoEstadual) {
        if ($inscricaoEstadual == null || $inscricaoEstadual == "") {
            return "";
        }

        $inscricaoEstadual = preg_replace("/\D/", "", $inscricaoEstadual);

        if (strlen($inscricaoEstadual) == 9) {
            $inscricaoEstadualFormatada = substr($inscricaoEstadual, 0, 3) . "." . substr($inscricaoEstadual, 3, 3) . "." . substr($inscricaoEstadual, 6, 3);
        } elseif (strlen($inscricaoEstadual) == 12) {
            $inscricaoEstadualFormatada = substr($inscricaoEstadual, 0, 3) . "." . substr($inscricaoEstadual, 3, 3) . "." . substr($inscricaoEstadual, 6, 3) . "/" . substr($inscricaoEstadual, 9, 3);
        } else {
            return "Inscrição Estadual inválida";
        }

        return $inscricaoEstadualFormatada;
    }

    function formatarTelefone($telefone) {
        if ($telefone == null || $telefone == "") {
            return "";
        }

        $telefone = preg_replace("/\D/", "", $telefone);

        $tamanho = strlen($telefone);

        if ($tamanho == 8) {
            $telefoneFormatado = substr($telefone, 0, 4) . "-" . substr($telefone, 4);
        } elseif ($tamanho == 9) {
            $telefoneFormatado = substr($telefone, 0, 5) . "-" . substr($telefone, 5);
        } elseif ($tamanho == 10) {
            $telefoneFormatado = "(" . substr($telefone, 0, 2) . ") " . substr($telefone, 2, 4) . "-" . substr($telefone, 6);
        } elseif ($tamanho == 11) {
            $telefoneFormatado = "(" . substr($telefone, 0, 2) . ") " . substr($telefone, 2, 5) . "-" . substr($telefone, 7);
        } else {
            return "Telefone inválido";
        }

        return $telefoneFormatado;
    }

    function formatarCEP($cep) {
        if ($cep == null || $cep == "") {
            return "";
        }

        $cep = preg_replace("/\D/", "", $cep);

        if (strlen($cep) != 8) {
            return "CEP inválido";
        }

        $cepFormatado = substr($cep, 0, 5) . "-" . substr($cep, 5, 3);

        return $cepFormatado;
    }

    function formatarDocumento($documento) {
        if ($documento == null || $documento == "") {
            return "";
        }

        $documento = preg_replace("/\D/", "", $documento);

        $tamanho = strlen($documento);

        if ($tamanho == 11) {
            $documentoFormatado = substr($documento, 0, 3) . "." . substr($documento, 3, 3) . "." . substr($documento, 6, 3) . "-" . substr($documento, 9, 2);
        } elseif ($tamanho == 14) {
            $documentoFormatado = substr($documento, 0, 2) . "." . substr($documento, 2, 3) . "." . substr($documento, 5, 3) . "/" . substr($documento, 8, 4) . "-" . substr($documento, 12, 2);
        } else {
            return "Documento inválido";
        }

        return $documentoFormatado;
    }
?>
