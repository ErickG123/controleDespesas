<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idEquipamento = isset($_POST["idEquipamento"]) ? $_POST["idEquipamento"] : "";

    $sql = "DELETE FROM EQUIPAMENTOS
            WHERE IDEQUIPAMENTO = :idEquipamento";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idEquipamento", $idEquipamento);

    try {
        $stmt->execute();

        redirecionar("Equipamentos", "Equipamento excluído com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Equipamentos", "Erro ao excluir o Equipamento. Ele está relacionado a outros registros.", "red");
            }
        } else {
            redirecionar("Equipamentos", "Erro ao excluir o Equipamento. Erro: $ex", "red");
            exit;
        }
    }
?>
