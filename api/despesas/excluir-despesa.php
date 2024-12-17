<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idDespesa = isset($_POST["idDespesa"]) ? $_POST["idDespesa"] : "";

    $sql = "DELETE FROM DESPESAS
            WHERE IDDESPESA = :idDespesa";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idDespesa", $idDespesa);

    try {
        $stmt->execute();

        redirecionar("Despesas", "Despesa excluída com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Despesas", "Erro ao excluir a Despesa. Ela está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Despesas", "Erro ao excluir a Despesa. Erro: $ex", "red");
            exit;
        }
    }
?>
