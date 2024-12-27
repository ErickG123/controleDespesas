<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $idCidade = isset($_POST["idCidade"]) ? $_POST["idCidade"] : "";
    $cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : "";
    $idEstado = isset($_POST["estado"]) ? $_POST["estado"] : "";

    $campos = [
        "cidade" => $cidade,
        "estado" => $idEstado
    ];

    validarCampos("Cidades", $campos);

    $sql = "UPDATE CIDADES SET
            CIDADE = :cidade,
            IDESTADO = :idEstado
            WHERE IDCIDADE = :idCidade";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":cidade", $cidade);
    $stmt->bindParam(":idEstado", $idEstado);
    $stmt->bindParam(":idCidade", $idCidade);

    try {
        $stmt->execute();

        redirecionar("Cidades", "Cidade atualizada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Cidades", "Erro ao atualizar a Cidade. Erro: $ex", "red");
        exit;
    }
?>
