<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idGrupoFluxo = isset($_POST["idGrupoFluxo"]) ? $_POST["idGrupoFluxo"] : "";

    $sql = "DELETE FROM GRUPOSFLUXO
            WHERE IDGRUPOFLUXO = :idGrupoFluxo";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idGrupoFluxo", $idGrupoFluxo);

    try {
        $stmt->execute();

        redirecionar("Grupos de Fluxo", "Grupo de Fluxo excluído com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Grupos de Fluxo", "Erro ao excluir o Grupo de Fluxo. Ele está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Grupos de Fluxo", "Erro ao excluir o Grupo de Fluxo. Erro: $ex", "red");
            exit;
        }
    }
?>
