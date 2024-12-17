<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idCaminhao = isset($_POST["idCaminhao"]) ? $_POST["idCaminhao"] : "";

    $sql = "DELETE FROM CAMINHOES
            WHERE IDCAMINHAO = :idCaminhao";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idCaminhao", $idCaminhao);

    try {
        $stmt->execute();

        redirecionar("Caminhões", "Caminhão excluído com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Caminhões", "Erro ao excluir o Caminhão. Ele está relacionado a outros registros.", "red");
            }
        } else {
            redirecionar("Caminhões", "Erro ao excluir o Caminhão. Erro: $ex", "red");
            exit;
        }
    }
?>
