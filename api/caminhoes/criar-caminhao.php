<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $caminhao = isset($_POST["caminhao"]) ? $_POST["caminhao"] : "";

    $campos = [
        "caminhão" => $caminhao
    ];

    validarCampos("Caminhões", $campos);

    $sql = "INSERT INTO CAMINHOES (CAMINHAO)
            VALUES (:caminhao)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":caminhao", $caminhao);

    try {
        $stmt->execute();

        redirecionar("Caminhões", "Caminhão cadastrado com Sucesso", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Caminhões", "Erro ao cadastrar o Caminhão. Erro: $ex", "red");
        exit;
    }
?>
