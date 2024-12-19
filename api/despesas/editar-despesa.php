<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $idDespesa = isset($_POST["idDespesa"]) ?  $_POST["idDespesa"] : "";
    $observacoes = isset($_POST["observacoes"]) ?  $_POST["observacoes"] : "";
    $valor = isset($_POST["valor"]) ?  tratarValorDecimal($_POST["valor"]) : 0;
    $dataCompra = isset($_POST["dataCompra"]) ?  $_POST["dataCompra"] : null;
    $dataVencimento = isset($_POST["dataVencimento"]) ?  $_POST["dataVencimento"] : null;
    $parcelas = isset($_POST["parcelas"]) ?  $_POST["parcelas"] : null;
    $idFormaPagamento = isset($_POST["opcoesFormasPagamento"]) ?  $_POST["opcoesFormasPagamento"][0] : null;
    $idGrupoFluxo = isset($_POST["opcoesGruposFluxo"]) ?  $_POST["opcoesGruposFluxo"][0] : null;
    $idPessoa = isset($_POST["opcoesPessoas"]) ?  $_POST["opcoesPessoas"][0] : null;

    $campos = [
        "valor" => $valor
    ];

    validarCampos("Despesas", $campos);

    $sql = "UPDATE DESPESAS SET
            OBSERVACOES = :observacoes,
            VALOR = :valor,
            DATACOMPRA = :dataCompra,
            DATAVENCIMENTO = :dataVencimento,
            PARCELAS = :parcelas,
            IDFORMAPAGAMENTO = :idFormaPagamento,
            IDGRUPOFLUXO = :idGrupoFluxo,
            IDPESSOA = :idPessoa
            WHERE IDDESPESA = :idDespesa";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":observacoes", $observacoes);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":dataCompra", $dataCompra, $dataCompra == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(":dataVencimento", $dataVencimento, $dataVencimento == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(":parcelas", $parcelas);
    $stmt->bindParam(":idFormaPagamento", $idFormaPagamento);
    $stmt->bindParam(":idGrupoFluxo", $idGrupoFluxo);
    $stmt->bindParam(":idPessoa", $idPessoa);
    $stmt->bindParam(":idDespesa", $idDespesa);

    try {
        $stmt->execute();

        redirecionar("Despesas", "Despesa atualizada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Despesas", "Erro ao atualizar a Despesa.", "red");
        exit;
    }
?>
