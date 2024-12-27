<?php 
    include_once("../../database/conn.php");

    $idCidade = isset($_GET["idCidade"]) ? $_GET["idCidade"] : "";

    $sql = "SELECT C.IDCIDADE, C.CIDADE, C.IDESTADO
            FROM CIDADES C
            WHERE C.IDCIDADE = :idCidade";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idCidade", $idCidade);
    $stmt->execute();

    $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pessoa) {
        echo json_encode($pessoa);
    } else {
        echo json_encode(array("error" => "Cidade não encontrada."));
    }
?>
