<?php 
    include_once("../../database/conn.php");

    $idFormaPagamento = isset($_GET["idFormaPagamento"]) ? $_GET["idFormaPagamento"] : "";

    $sql = "SELECT FP.IDFORMAPAGAMENTO, FP.FORMAPAGAMENTO
            FROM FORMASPAGAMENTO FP
            WHERE FP.IDFORMAPAGAMENTO = :idFormaPagamento";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idFormaPagamento", $idFormaPagamento);
    $stmt->execute();

    $formaPagamento = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($formaPagamento) {
        echo json_encode($formaPagamento);
    } else {
        echo json_encode(array("error" => "Forma de Pagamento não encontrada."));
    }
?>
