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

        redirecionar("Cedentes", "Cedente excluído com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Cedentes", "Erro ao excluir o Cedente. Ele está relacionado a outros registros.", "red");
            }
        } else {
            redirecionar("Cedentes", "Erro ao excluir o Cedente. Erro: $ex", "red");
            exit;
        }
    }
?>
