<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : "";
    $idEstado = isset($_POST["idEstado"]) ? $_POST["idEstado"] : "";

    $campos = [
        "cidade" => $cidade,
        "estado" => $idEstado
    ];

    validarCampos("Cidades", $campos);

    $sql = "INSERT INTO CIDADES (CIDADE, IDESTADO)
            VALUES (:cidade, :idEstado)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":cidade", $cidade);
    $stmt->bindParam(":idEstado", $idEstado);

    try {
        $stmt->execute();

        redirecionar("Cidades", "Cidade cadastrada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Cidades", "Erro ao cadastrar a Cidade. Erro: $ex", "red");
        exit;
    }
?>
