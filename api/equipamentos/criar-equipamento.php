<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $equipamento = isset($_POST["equipamento"]) ? $_POST["equipamento"] : "";

    $campos = [
        "equipamento" => $equipamento
    ];

    validarCampos("Equipamentos", $campos);

    $sql = "INSERT INTO EQUIPAMENTOS (EQUIPAMENTO)
            VALUES (:equipamento)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":equipamento", $equipamento);

    try {
        $stmt->execute();

        redirecionar("Equipamentos", "Equipamento cadastrado com Sucesso", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Equipamentos", "Erro ao cadastrar o Equipamento. Erro: $ex", "red");
        exit;
    }
?>
