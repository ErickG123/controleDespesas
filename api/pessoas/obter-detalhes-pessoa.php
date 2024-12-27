<?php 
    include_once("../../database/conn.php");

    $idPessoa = isset($_GET["idPessoa"]) ? $_GET["idPessoa"] : "";

    $sql = "SELECT PS.IDPESSOA, PS.NOME
            FROM PESSOAS PS
            WHERE PS.IDPESSOA = :idPessoa";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idPessoa", $idPessoa);
    $stmt->execute();

    $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pessoa) {
        echo json_encode($pessoa);
    } else {
        echo json_encode(array("error" => "Pessoa não encontrada."));
    }
?>
