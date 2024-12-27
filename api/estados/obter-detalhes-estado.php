<?php 
    include_once("../../database/conn.php");

    $idEstado = isset($_GET["idEstado"]) ? $_GET["idEstado"] : "";

    $sql = "SELECT E.IDESTADO, E.ESTADO, E.SIGLA
            FROM ESTADOS E
            WHERE E.IDESTADO = :idEstado";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idEstado", $idEstado);
    $stmt->execute();

    $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pessoa) {
        echo json_encode($pessoa);
    } else {
        echo json_encode(array("error" => "Estado não encontrado."));
    }
?>
