<?php 
    include_once("../../database/conn.php");

    $idGrupoFluxo = isset($_GET["idGrupoFluxo"]) ? $_GET["idGrupoFluxo"] : "";

    $sql = "SELECT GF.IDGRUPOFLUXO, GF.GRUPOFLUXO
            FROM GRUPOSFLUXO GF
            WHERE GF.IDGRUPOFLUXO = :idGrupoFluxo";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idGrupoFluxo", $idGrupoFluxo);
    $stmt->execute();

    $grupoFluxo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($grupoFluxo) {
        echo json_encode($grupoFluxo);
    } else {
        echo json_encode(array("error" => "Grupo de Fluxo não encontrado."));
    }
?>
