<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/validacoes.php");
    include_once("../../includes/alerta.php");

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $documento = isset($_POST["documento"]) ? limparNumeros($_POST["documento"]) : "";
    $inscricaoEstadual = isset($_POST["inscricaoEstadual"]) ? limparNumeros($_POST["inscricaoEstadual"]) : "";
    $cep = isset($_POST["cep"]) ? limparNumeros($_POST["cep"]) : "";
    $endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : "";
    $bairro = isset($_POST["bairro"]) ? $_POST["bairro"] : "";
    $numero = isset($_POST["numero"]) ? $_POST["numero"] : null;
    $complemento = isset($_POST["complemento"]) ? $_POST["complemento"] : "";
    $idCidade = isset($_POST["opcoesCidades"]) ? $_POST["opcoesCidades"][0] : null;
    $telefone = isset($_POST["telefone"]) ? limparNumeros($_POST["telefone"]) : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";

    $campos = [
        "nome" => $nome
    ];

    validarCampos("Cedentes", $campos);

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
    $stmt->bindParam(":numero", $numero, $numero == null ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindParam(":complemento", $complemento);
    $stmt->bindParam(":idCidade", $idCidade);
    $stmt->bindParam(":telefone", $telefone, $telefone == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(":email", $email);

    try {
        $stmt->execute();

        redirecionarComPath("Cedentes", "Cedente cadastrado com Sucesso!", "green", "../../pessoas.php");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Cedentes", "Erro ao cadastrar o Cedente. Erro: $ex", "red");
        exit;
    }
?>
