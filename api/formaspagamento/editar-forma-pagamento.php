<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $idFormaPagamento = isset($_POST["idFormaPagamento"]) ? $_POST["idFormaPagamento"] : "";
    $formaPagamento = isset($_POST["formaPagamento"]) ? $_POST["formaPagamento"] : "";

    $campos = [
        "forma de pagamento" => $formaPagamento
    ];

    validarCampos("Formas de Pagamento", $campos);

    $sql = "UPDATE FORMASPAGAMENTO SET
            FORMAPAGAMENTO = :formaPagamento
            WHERE IDFORMAPAGAMENTO = :idFormaPagamento";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":formaPagamento", $formaPagamento);
    $stmt->bindParam(":idFormaPagamento", $idFormaPagamento);

    try {
        $stmt->execute();

        redirecionar("Formas de Pagamento", "Forma de Pagamento atualizada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Formas de Pagamento", "Erro ao atualizar a Forma de Pagamento.", "red");
        exit;
    }
?>
