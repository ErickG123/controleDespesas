<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idCarregadeira = isset($_POST["idCarregadeira"]) ? $_POST["idCarregadeira"] : "";

    $sql = "DELETE FROM CARREGADEIRAS
            WHERE IDCARREGADEIRA = :idCarregadeira";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idCarregadeira", $idCarregadeira);

    try {
        $stmt->execute();

        redirecionar("Carregadeiras", "Carregadeira excluída com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Carregadeiras", "Erro ao excluir a Carregadeira. Ela está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Carregadeiras", "Erro ao excluir a Carregadeira. Erro: $ex", "red");
            exit;
        }
    }
?>
