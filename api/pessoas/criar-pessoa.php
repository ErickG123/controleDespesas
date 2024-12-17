<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $tipoPessoa = isset($_POST["tipoPessoa"]) ? $_POST["tipoPessoa"] : "";

    $campos = [
        "nome" => $nome
    ];

    validarCampos("Pessoas", $campos);

    $sql = "INSERT INTO PESSOAS (NOME, TIPOPESSOA)
            VALUES (:nome, :tipoPessoa)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":tipoPessoa", $tipoPessoa);

    try {
        $stmt->execute();

        redirecionar("Pessoas", "Pessoa cadastrada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Pessoas", "Erro ao cadastrar a Pessoa. Erro: $ex", "red");
        exit;
    }
?>
