<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $idDespesa = isset($_POST["idDespesa"]) ?  $_POST["idDespesa"] : "";
    $descricao = isset($_POST["descricao"]) ?  $_POST["descricao"] : "";
    $valor = isset($_POST["valor"]) ?  tratarValorDecimal($_POST["valor"]) : "";
    $dataCompra = isset($_POST["dataCompra"]) ?  $_POST["dataCompra"] : "";
    $dataVencimento = isset($_POST["dataVencimento"]) ?  $_POST["dataVencimento"] : "";
    $parcelas = isset($_POST["parcelas"]) ?  $_POST["parcelas"] : "";
    $idFormaPagamento = isset($_POST["idFormaPagamento"]) ?  $_POST["idFormaPagamento"] : "";
    $idCategoria = isset($_POST["idCategoria"]) ?  $_POST["idCategoria"] : "";
    $idEmpresa = isset($_POST["idEmpresa"]) ?  $_POST["idEmpresa"] : "";
    $idPessoa = isset($_POST["idPessoa"]) ?  $_POST["idPessoa"] : "";
    $idCaminhao = isset($_POST["idCaminhao"]) ?  $_POST["idCaminhao"] : "";
    $idEquipamento = isset($_POST["idEquipamento"]) ?  $_POST["idEquipamento"] : "";
    $idCarregadeira = isset($_POST["idCarregadeira"]) ?  $_POST["idCarregadeira"] : "";

    $campos = [
        "descrição" => $descricao,
        "valor" => $valor
    ];

    validarCampos("Despesas", $campos);

    $sql = "UPDATE DESPESAS SET
            DESCRICAO = :descricao,
            VALOR = :valor,
            DATACOMPRA = :dataCompra,
            DATAVENCIMENTO = :dataVencimento,
            PARCELAS = :parcelas,
            IDFORMAPAGAMENTO = :idFormaPagamento,
            IDCATEGORIA = :idCategoria,
            IDEMPRESA = :idEmpresa,
            IDPESSOA = :idPessoa,
            IDCAMINHAO = :idCaminhao,
            IDEQUIPAMENTO = :idEquipamento,
            IDCARREGADEIRA = :idCarregadeira,
            WHERE IDDESPESA = :idDespesa";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":valor", $valor);
    $stmt->bindParam(":dataCompra", $dataCompra);
    $stmt->bindParam(":dataVencimento", $dataVencimento);
    $stmt->bindParam(":parcelas", $parcelas);
    $stmt->bindParam(":idFormaPagamento", $idFormaPagamento);
    $stmt->bindParam(":idCategoria", $idCategoria);
    $stmt->bindParam(":idEmpresa", $idEmpresa);
    $stmt->bindParam(":idPessoa", $idPessoa);
    $stmt->bindParam(":idCaminhao", $idCaminhao);
    $stmt->bindParam(":idEquipamento", $idEquipamento);
    $stmt->bindParam(":idCarregadeira", $idCarregadeira);
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
