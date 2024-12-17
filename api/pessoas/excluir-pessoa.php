<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idPessoa = isset($_POST["idPessoa"]) ? $_POST["idPessoa"] : "";

    $sql = "DELETE FROM PESSOAS
            WHERE IDPESSOA = :idPessoa";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idPessoa", $idPessoa);

    try {
        $stmt->execute();

        redirecionar("Pessoas", "Pessoa excluída com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Pessoas", "Erro ao excluir a Pessoa. Ela está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Pessoas", "Erro ao excluir a Pessoa. Erro: $ex", "red");
            exit;
        }
    }
?>
