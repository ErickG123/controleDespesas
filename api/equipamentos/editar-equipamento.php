<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idEquipamento = isset($_POST["idEquipamento"]) ? $_POST["idEquipamento"] : "";
    $equipamento = isset($_POST["equipamento"]) ? $_POST["equipamento"] : "";

    $campos = [
        "equipamento" => $equipamento
    ];

    validarCampos("Equipamentos", $campos);

    $sql = "UPDATE EQUIPAMENTOS SET
            EQUIPAMENTO = :equipamento
            WHERE IDEQUIPAMENTO = :idEquipamento";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":equipamento", $equipamento);
    $stmt->bindParam(":idEquipamento", $idEquipamento);

    try {
        $stmt->execute();

        redirecionar("Equipamentos", "Equipamento atualizado com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Equipamentos", "Erro ao atualizar o Equipamento.", "red");
        exit;
    }
?>
