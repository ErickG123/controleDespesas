<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idEmpresa = isset($_POST["idEmpresa"]) ? $_POST["idEmpresa"] : "";

    $sql = "DELETE FROM EMPRESAS
            WHERE IDEMPRESA = :idEmpresa";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idEmpresa", $idEmpresa);

    try {
        $stmt->execute();

        redirecionar("Empresas", "Empresa excluída com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Empresas", "Erro ao excluir a Empresa. Ela está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Empresas", "Erro ao excluir a Empresa. Erro: $ex", "red");
            exit;
        }
    }
?>
