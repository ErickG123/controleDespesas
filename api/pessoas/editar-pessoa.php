<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idPessoa = isset($_POST["idPessoa"]) ? $_POST["idPessoa"] : "";
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";

    $campos = [
        "nome" => $nome
    ];

    validarCampos("Pessoas", $campos);

    $sql = "UPDATE PESSOAS SET
            NOME = :nome
            WHERE IDPESSOA = :idPessoa";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":idPessoa", $idPessoa);

    try {
        $stmt->execute();

        redirecionar("Pessoas", "Pessoa atualizada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Pessoas", "Erro ao atualizar a Pessoa. Erro: $ex", "red");
        exit;
    }
?>
