<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $estado = isset($_POST["estado"]) ? $_POST["estado"] : "";
    $sigla = isset($_POST["sigla"]) ? $_POST["sigla"] : "";

    $campos = [
        "estado" => $estado,
        "estado" => $sigla
    ];

    validarCampos("Estados", $campos);

    $sql = "INSERT INTO ESTADOS (ESTADO, SIGLA)
            VALUES (:estado, :sigla)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":estado", $estado);
    $stmt->bindParam(":sigla", $sigla);

    try {
        $stmt->execute();

        redirecionar("Estados", "Estado cadastrado com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Estados", "Erro ao cadastrar o Estado. Erro: $ex", "red");
        exit;
    }
?>
