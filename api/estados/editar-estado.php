<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $idEstado = isset($_POST["idEstado"]) ? $_POST["idEstado"] : "";
    $estado = isset($_POST["estado"]) ? $_POST["estado"] : "";
    $sigla = isset($_POST["sigla"]) ? $_POST["sigla"] : "";

    $campos = [
        "estado" => $idEstado,
        "sigla" => $sigla
    ];

    validarCampos("Estados", $campos);

    $sql = "UPDATE ESTADOS SET
            ESTADO = :estado,
            SIGLA = :sigla
            WHERE IDESTADO = :idEstado";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":estado", $estado);
    $stmt->bindParam(":sigla", $sigla);
    $stmt->bindParam(":idEstado", $idEstado);

    try {
        $stmt->execute();

        redirecionar("Estados", "Estado atualizado com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Estados", "Erro ao atualizar o Estado. Erro: $ex", "red");
        exit;
    }
?>
