<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");
    
    include_once("../../includes/validacoes.php");
    $idGrupoFluxo = isset($_POST["idGrupoFluxo"]) ? $_POST["idGrupoFluxo"] : "";
    $grupoFluxo = isset($_POST["grupoFluxo"]) ? $_POST["grupoFluxo"] : "";

    $campos = [
        "grupo de fluxo" => $grupoFluxo
    ];

    validarCampos("Grupos de Fluxo", $campos);

    $sql = "UPDATE GRUPOSFLUXO SET
            GRUPOFLUXO = :grupoFluxo
            WHERE IDGRUPOFLUXO = :idGrupoFluxo";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":grupoFluxo", $grupoFluxo);
    $stmt->bindParam(":idGrupoFluxo", $idGrupoFluxo);

    try {
        $stmt->execute();

        redirecionar("Grupos de Fluxo", "Grupo de Fluxo atualizado com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Grupos de Fluxo", "Erro ao atualizar o Grupo de Fluxo.", "red");
        exit;
    }
?>
