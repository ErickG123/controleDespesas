<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $empresa = isset($_POST["empresa"]) ? $_POST["empresa"] : "";

    $campos = [
        "empresa" => $empresa
    ];

    validarCampos("Empresas", $campos);

    $sql = "INSERT INTO EMPRESAS (EMPRESA)
            VALUES (:empresa)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":empresa", $empresa);

    try {
        $stmt->execute();

        redirecionar("Empresas", "Empresa cadastrada com Sucesso", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Empresas", "Erro ao cadastrar a Empresa. Erro: $ex", "red");
        exit;
    }
?>
