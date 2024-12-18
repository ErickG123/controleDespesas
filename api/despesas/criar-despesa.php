<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $descricao = isset($_POST["descricao"]) ?  $_POST["descricao"] : "";
    $valor = isset($_POST["valor"]) ?  tratarValorDecimal($_POST["valor"]) : 0;
    $dataCompra = isset($_POST["dataCompra"]) ?  $_POST["dataCompra"] : null;
    $dataVencimento = isset($_POST["dataVencimento"]) ?  $_POST["dataVencimento"] : null;
    $parcelas = isset($_POST["parcelas"]) ?  (int)$_POST["parcelas"] : 0;
    $idFormaPagamento = isset($_POST["opcoesFormasPagamento"]) ?  $_POST["opcoesFormasPagamento"][0] : null;
    $idCategoria = isset($_POST["opcoesCategorias"]) ?  $_POST["opcoesCategorias"][0] : null;
    $idEmpresa = isset($_POST["opcoesEmpresas"]) ?  $_POST["opcoesEmpresas"][0] : null;
    $idPessoa = isset($_POST["opcoesPessoas"]) ?  $_POST["opcoesPessoas"][0] : null;
    $idCaminhao = isset($_POST["opcoesCaminhoes"]) ?  $_POST["opcoesCaminhoes"][0] : null;
    $idEquipamento = isset($_POST["opcoesEquipamentos"]) ?  $_POST["opcoesEquipamentos"][0] : null;
    $idCarregadeira = isset($_POST["opcoesCarregadeiras"]) ?  $_POST["opcoesCarregadeiras"][0] : null;

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
    $stmt->bindParam(":dataCompra", $dataCompra, $dataCompra == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(":dataVencimento", $dataVencimento, $dataCompra == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
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
        redirecionar("Despesas", "Erro ao cadastrar a Despesa. Erro: $ex", "red");
        exit;
    }
?>
