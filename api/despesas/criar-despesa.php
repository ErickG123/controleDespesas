<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $observacoes = isset($_POST["observacoes"]) ?  $_POST["observacoes"] : "";
    $valor = isset($_POST["valor"]) ?  tratarValorDecimal($_POST["valor"]) : 0;
    $dataCompra = isset($_POST["dataCompra"]) ?  $_POST["dataCompra"] : null;
    $dataVencimento = isset($_POST["dataVencimento"]) ?  $_POST["dataVencimento"] : null;
    $totalParcelas = isset($_POST["totalParcelas"]) ?  (int)$_POST["totalParcelas"] : null;
    $idFormaPagamento = isset($_POST["opcoesFormasPagamento"]) ?  $_POST["opcoesFormasPagamento"][0] : null;
    $idGrupoFluxo = isset($_POST["opcoesCategorias"]) ?  $_POST["opcoesCategorias"][0] : null;
    $idPessoa = isset($_POST["opcoesPessoas"]) ?  $_POST["opcoesPessoas"][0] : null;

    $campos = [
        "valor" => $valor,
        "cedente" => $idPessoa,
        "data de compra" => $dataCompra,
        "data de vencimento" => $dataVencimento
    ];

    validarCampos("Despesas", $campos);

    try {
        $conn->beginTransaction();

        $dataAtual = $dataVencimento ? new DateTime($dataVencimento) : null;

        $sqlPai = "INSERT INTO DESPESAS (OBSERVACOES, VALOR, DATACOMPRA, DATAVENCIMENTO, TOTALPARCELAS, PARCELA, IDFORMAPAGAMENTO,
                                         IDGRUPOFLUXO, IDPESSOA)
                VALUES (:observacoes, :valor, :dataCompra, :dataVencimento, :totalParcelas, :parcela, :idFormaPagamento,
                        :idGrupoFluxo, :idPessoa)";

        $stmtPai = $conn->prepare($sqlPai);
        $stmtPai->bindParam(":observacoes", $observacoes);
        $stmtPai->bindParam(":valor", $valor);
        $stmtPai->bindParam(":dataCompra", $dataCompra, $dataCompra == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmtPai->bindParam(":dataVencimento", $dataVencimento, $dataVencimento == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmtPai->bindParam(":totalParcelas", $totalParcelas, PDO::PARAM_INT);
        $parcelaPai = 1;
        $stmtPai->bindParam(":parcela", $parcelaPai, PDO::PARAM_INT);
        $stmtPai->bindParam(":idFormaPagamento", $idFormaPagamento);
        $stmtPai->bindParam(":idGrupoFluxo", $idGrupoFluxo);
        $stmtPai->bindParam(":idPessoa", $idPessoa);
        $stmtPai->execute();

        $idDespesaPai = $conn->lastInsertId();

        for ($i = 2; $i <= $totalParcelas; $i++) {
            $dataAtual = $dataAtual ? $dataAtual->modify("+1 month") : null;
            $dataParcela = $dataAtual ? $dataAtual->format("Y-m-d") : null;

            $sqlFilha = "INSERT INTO DESPESAS (OBSERVACOES, VALOR, DATACOMPRA, DATAVENCIMENTO, TOTALPARCELAS, PARCELA, IDFORMAPAGAMENTO,
                                               IDGRUPOFLUXO, IDPESSOA, IDDESPESAREF)
                        VALUES (:observacoes, :valor, :dataCompra, :dataVencimento, :totalParcelas, :parcela, :idFormaPagamento,
                                :idGrupoFluxo, :idPessoa, :idDespesaRef)";

            $stmtFilha = $conn->prepare($sqlFilha);
            $stmtFilha->bindParam(":observacoes", $observacoes);
            $stmtFilha->bindParam(":valor", $valor);
            $stmtFilha->bindParam(":dataCompra", $dataCompra, $dataCompra == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmtFilha->bindParam(":dataVencimento", $dataParcela, $dataParcela == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmtFilha->bindParam(":totalParcelas", $totalParcelas, PDO::PARAM_INT);
            $stmtFilha->bindParam(":parcela", $i, PDO::PARAM_INT);
            $stmtFilha->bindParam(":idFormaPagamento", $idFormaPagamento);
            $stmtFilha->bindParam(":idGrupoFluxo", $idGrupoFluxo);
            $stmtFilha->bindParam(":idPessoa", $idPessoa);
            $stmtFilha->bindParam(":idDespesaRef", $idDespesaPai, PDO::PARAM_INT);
            $stmtFilha->execute();
        }

        $conn->commit();

        redirecionarComPath("Despesas", "Despesas cadastradas com sucesso!", "green", "../../index.php");
        exit;
    } catch (PDOException $ex) {
        $conn->rollBack();

        redirecionar("Despesas", "Erro ao cadastrar as despesas. Erro: $ex", "red");
        exit;
    }
?>
