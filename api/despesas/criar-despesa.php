<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

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

    $sql = "INSERT INTO DESPESAS (DESCRICAO, VALOR, DATACOMPRA, DATAVENCIMENTO, PARCELAS, IDFORMAPAGAMENTO,
                                  IDCATEGORIA, IDEMPRESA, IDPESSOA, IDCAMINHAO, IDEQUIPAMENTO, IDCARREGADEIRA)
            VALUES (:descricao, :valor, :dataCompra, :dataVencimento, :parcelas, :idFormaPagamento,
                    :idCategoria, :idEmpresa, :idPessoa, :idCaminhao, :idEquipamento, :idCarregadeira)";

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

    try {
        $stmt->execute();

        redirecionar("Despesas", "Despesa cadastrada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Despesas", "Erro ao cadastrar a Despesa.", "red");
        exit;
    }
?>
