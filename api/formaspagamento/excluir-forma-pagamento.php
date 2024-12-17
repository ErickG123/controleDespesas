<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idFormaPagamento = isset($_POST["idFormaPagamento"]) ? $_POST["idFormaPagamento"] : "";

    $sql = "DELETE FROM FORMASPAGAMENTO
            WHERE IDFORMAPAGAMENTO = :idFormaPagamento";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idFormaPagamento", $idFormaPagamento);

    try {
        $stmt->execute();

        redirecionar("Formas de Pagamento", "Forma de Pagamento excluída com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Formas de Pagamento", "Erro ao excluir a Forma de Pagamento. Ela está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Formas de Pagamento", "Erro ao excluir a Forma de Pagamento. Erro: $ex", "red");
            exit;
        }
    }
?>
