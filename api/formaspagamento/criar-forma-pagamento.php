<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $formaPagamento = isset($_POST["formaPagamento"]) ? $_POST["formaPagamento"] : "";

    $campos = [
        "forma de pagamento" => $formaPagamento
    ];

    validarCampos("Formas de Pagamento", $campos);

    $sql = "INSERT INTO FORMASPAGAMENTO (FORMAPAGAMENTO)
            VALUES (:formaPagamento)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":formaPagamento", $formaPagamento);

    try {
        $stmt->execute();

        redirecionar("Formas de Pagamento", "Forma de Pagamento cadastrada com Sucesso", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Formas de Pagamento", "Erro ao cadastrar a Forma de Pagamento. Erro: $ex", "red");
        exit;
    }
?>
