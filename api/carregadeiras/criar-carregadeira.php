<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $carregadeira = isset($_POST["carregadeira"]) ? $_POST["carregadeira"] : "";

    $campos = [
        "carregadeira" => $carregadeira
    ];

    validarCampos("Carregadeiras", $campos);

    $sql = "INSERT INTO CARREGADEIRAS (CARREGADEIRA)
            VALUES (:carregadeira)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":carregadeira", $carregadeira);

    try {
        $stmt->execute();

        redirecionar("Carregadeiras", "Carregadeira cadastrada com Sucesso", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Carregadeiras", "Erro ao cadastrar a Carregadeira. Erro: $ex", "red");
        exit;
    }
?>
