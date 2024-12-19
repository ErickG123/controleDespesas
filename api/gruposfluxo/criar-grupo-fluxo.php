<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $grupoFluxo = isset($_POST["grupoFluxo"]) ? $_POST["grupoFluxo"] : "";

    $campos = [
        "grupo de fluxo" => $grupoFluxo
    ];

    validarCampos("Grupos de Fluxo", $campos);

    $sql = "INSERT INTO GRUPOSFLUXO (GRUPOFLUXO)
            VALUES (:grupoFluxo)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":grupoFluxo", $grupoFluxo);

    try {
        $stmt->execute();

        redirecionar("Grupos de Fluxo", "Grupo de Fluxo cadastrado com Sucesso", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Grupos de Fluxo", "Erro ao cadastrar o Grupo de Fluxo. Erro: $ex", "red");
        exit;
    }
?>
