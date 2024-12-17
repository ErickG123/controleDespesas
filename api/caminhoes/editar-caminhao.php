<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $idCaminhao = isset($_POST["idCaminhao"]) ? $_POST["idCaminhao"] : "";
    $caminhao = isset($_POST["caminhao"]) ? $_POST["caminhao"] : "";

    $campos = [
        "caminhão" => $caminhao
    ];

    validarCampos("Caminhões", $campos);

    $sql = "UPDATE CAMINHOES SET
            CAMINHAO = :caminhao
            WHERE IDCAMINHAO = :idCaminhao";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":caminhao", $caminhao);
    $stmt->bindParam(":idCaminhao", $idCaminhao);

    try {
        $stmt->execute();

        redirecionar("Caminhões", "Caminhão atualizado com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Caminhões", "Erro ao atualizar o Caminhão.", "red");
        exit;
    }
?>
