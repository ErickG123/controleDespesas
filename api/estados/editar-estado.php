<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idEstado = isset($_POST["idEstado"]) ? $_POST["idEstado"] : "";
    $idCidade = isset($_POST["idCidade"]) ? $_POST["idCidade"] : "";
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
