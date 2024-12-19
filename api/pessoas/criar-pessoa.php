<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

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

    $sql = "INSERT INTO PESSOAS (NOME, DOCUMENTO, INSCRICAOESTADUAL, CEP, ENDERECO, BAIRRO, NUMERO,
                                 COMPLEMENTO, IDCIDADE, TELEFONE, EMAIL)
            VALUES (:nome, :documento, :inscricaoEstadual, :cep, :endereco, :bairro, :numero,
                    :complemento, :idCidade, :telefone, :email)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":documento", $documento);
    $stmt->bindParam(":inscricaoEstadual", $inscricaoEstadual);
    $stmt->bindParam(":cep", $cep);
    $stmt->bindParam(":endereco", $endereco);
    $stmt->bindParam(":bairro", $bairro);
    $stmt->bindParam(":numero", $numero);
    $stmt->bindParam(":complemento", $complemento);
    $stmt->bindParam(":idCidade", $idCidade);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":email", $email);

    try {
        $stmt->execute();

        redirecionar("Pessoas", "Pessoa cadastrada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Pessoas", "Erro ao cadastrar a Pessoa. Erro: $ex", "red");
        exit;
    }
?>
