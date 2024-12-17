<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idEstado = isset($_POST["idEstado"]) ? $_POST["idEstado"] : "";

    $sql = "DELETE FROM ESTADOS
            WHERE IDESTADO = :idEstado";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idEstado", $idEstado);

    try {
        $stmt->execute();

        redirecionar("Estados", "Estado excluído com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Estados", "Erro ao excluir o Estado. Ele está relacionado a outros registros.", "red");
            }
        } else {
            redirecionar("Estados", "Erro ao excluir o Estado. Erro: $ex", "red");
            exit;
        }
    }
?>
