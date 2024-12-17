<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idEmpresa = isset($_POST["idEmpresa"]) ? $_POST["idEmpresa"] : "";
    $empresa = isset($_POST["empresa"]) ? $_POST["empresa"] : "";

    $campos = [
        "empresa" => $empresa
    ];

    validarCampos("Empresas", $campos);

    $sql = "UPDATE EMPRESAS SET
            EMPRESA = :empresa
            WHERE IDEMPRESA = :idEmpresa";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":empresa", $empresa);
    $stmt->bindParam(":idEmpresa", $idEmpresa);

    try {
        $stmt->execute();

        redirecionar("Empresas", "Empresa atualizada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Empresas", "Erro ao atualizar a Empresa.", "red");
        exit;
    }
?>
