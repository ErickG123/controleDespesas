<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idCidade = isset($_POST["idCidade"]) ? $_POST["idCidade"] : "";

    $sql = "DELETE FROM CIDADES
            WHERE IDCIDADE = :idCidade";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idCidade", $idCidade);

    try {
        $stmt->execute();

        redirecionar("Cidades", "Cidade excluída com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Cidades", "Erro ao excluir a Cidade. Ela está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Cidades", "Erro ao excluir a Cidade. Erro: $ex", "red");
            exit;
        }
    }
?>
