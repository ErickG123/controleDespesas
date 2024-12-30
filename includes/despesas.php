<?php
    function obterDadosDespesas($dataCompraInicial, $dataCompraFinal, $dataVencimentoInicial, $dataVencimentoFinal, $filtroPessoa, $filtroGrupoFluxo, $filtroFormaPagamento) {
        global $conn;

        $sql = "SELECT DP.IDDESPESA, DP.OBSERVACOES, DP.VALOR, DP.DATACOMPRA, DP.DATAVENCIMENTO,
                       DP.TOTALPARCELAS, DP.PARCELA, DP.IDDESPESAREF, FP.FORMAPAGAMENTO, GF.GRUPOFLUXO, 
                       PS.NOME
                FROM DESPESAS DP
                LEFT JOIN FORMASPAGAMENTO FP ON DP.IDFORMAPAGAMENTO = FP.IDFORMAPAGAMENTO
                LEFT JOIN GRUPOSFLUXO GF ON DP.IDGRUPOFLUXO = GF.IDGRUPOFLUXO
                LEFT JOIN PESSOAS PS ON DP.IDPESSOA = PS.IDPESSOA
                WHERE (FP.IDFORMAPAGAMENTO = :idFormaPagamento OR :idFormaPagamento = '')
                AND (GF.IDGRUPOFLUXO = :idGrupoFluxo OR :idGrupoFluxo = '')
                AND (PS.IDPESSOA = :idPessoa OR :idPessoa = '')";

        if ($dataCompraInicial && $dataCompraFinal) {
            $sql .= " AND DP.DATACOMPRA BETWEEN :dataCompraInicial AND :dataCompraFinal";
        }
        if ($dataVencimentoInicial && $dataVencimentoFinal) {
            $sql .= " AND DP.DATAVENCIMENTO BETWEEN :dataVencimentoInicial AND :dataVencimentoFinal";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":idFormaPagamento", $filtroFormaPagamento);
        $stmt->bindParam(":idGrupoFluxo", $filtroGrupoFluxo);
        $stmt->bindParam(":idPessoa", $filtroPessoa);

        if ($dataCompraInicial && $dataCompraFinal) {
            $stmt->bindParam(":dataCompraInicial", $dataCompraInicial);
            $stmt->bindParam(":dataCompraFinal", $dataCompraFinal);
        }
        if ($dataVencimentoInicial && $dataVencimentoFinal) {
            $stmt->bindParam(":dataVencimentoInicial", $dataVencimentoInicial);
            $stmt->bindParam(":dataVencimentoFinal", $dataVencimentoFinal);
        }

        $stmt->execute();

        $despesas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $despesas;
    }

    function obterTotalGastos($dataCompraInicial, $dataCompraFinal, $dataVencimentoInicial, $dataVencimentoFinal, $filtroPessoa, $filtroGrupoFluxo, $filtroFormaPagamento) {
        global $conn;

        $sqlTotalGastos = "SELECT SUM(DP.VALOR) AS TOTAL_GASTOS
                           FROM DESPESAS DP
                           INNER JOIN PESSOAS PS ON DP.IDPESSOA = PS.IDPESSOA
                           LEFT JOIN FORMASPAGAMENTO FP ON DP.IDFORMAPAGAMENTO = FP.IDFORMAPAGAMENTO
                           LEFT JOIN GRUPOSFLUXO GF ON DP.IDGRUPOFLUXO = GF.IDGRUPOFLUXO
                           WHERE (FP.IDFORMAPAGAMENTO = :idFormaPagamento OR :idFormaPagamento = '')
                           AND (GF.IDGRUPOFLUXO = :idGrupoFluxo OR :idGrupoFluxo = '')
                           AND (PS.IDPESSOA = :idPessoa OR :idPessoa = '')";

        if ($dataCompraInicial && $dataCompraFinal) {
            $sqlTotalGastos .= " AND DP.DATACOMPRA BETWEEN :dataCompraInicial AND :dataCompraFinal";
        }
        if ($dataVencimentoInicial && $dataVencimentoFinal) {
            $sqlTotalGastos .= " AND DP.DATAVENCIMENTO BETWEEN :dataVencimentoInicial AND :dataVencimentoFinal";
        }

        $stmtTotalGastos = $conn->prepare($sqlTotalGastos);
        $stmtTotalGastos->bindParam(":idFormaPagamento", $filtroFormaPagamento);
        $stmtTotalGastos->bindParam(":idGrupoFluxo", $filtroGrupoFluxo);
        $stmtTotalGastos->bindParam(":idPessoa", $filtroPessoa);

        if ($dataCompraInicial && $dataCompraFinal) {
            $stmtTotalGastos->bindParam(":dataCompraInicial", $dataCompraInicial);
            $stmtTotalGastos->bindParam(":dataCompraFinal", $dataCompraFinal);
        }
        if ($dataVencimentoInicial && $dataVencimentoFinal) {
            $stmtTotalGastos->bindParam(":dataVencimentoInicial", $dataVencimentoInicial);
            $stmtTotalGastos->bindParam(":dataVencimentoFinal", $dataVencimentoFinal);
        }

        $stmtTotalGastos->execute();

        $totalGastos = $stmtTotalGastos->fetchColumn();

        return $totalGastos;
    }
?>
