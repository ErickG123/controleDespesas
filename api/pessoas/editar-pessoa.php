<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idPessoa = isset($_POST["idPessoa"]) ? $_POST["idPessoa"] : "";
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $documento = isset($_POST["documento"]) ? $_POST["nome"] : "";
    $inscricaoEstadual = isset($_POST["inscricaoEstadual"]) ? $_POST["inscricaoEstadual"] : "";
    $cep = isset($_POST["cep"]) ? $_POST["cep"] : "";
    $endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : "";
    $bairro = isset($_POST["bairro"]) ? $_POST["bairro"] : "";
    $numero = isset($_POST["numero"]) ? $_POST["numero"] : null;
    $complemento = isset($_POST["complemento"]) ? $_POST["complemento"] : "";
    $idCidade = isset($_POST["idCidade"]) ? $_POST["idCidade"] : null;
    $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";

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
