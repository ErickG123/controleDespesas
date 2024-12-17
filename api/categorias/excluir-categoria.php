<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idCategoria = isset($_POST["idCategoria"]) ? $_POST["idCategoria"] : "";

    $sql = "DELETE FROM CATEGORIAS
            WHERE IDCATEGORIA = :idCategoria";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idCategoria", $idCategoria);

    try {
        $stmt->execute();

        redirecionar("Categorias", "Categoria excluída com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        if ($ex->getCode() == "23000") {
            if (strpos($ex->getMessage(), "a foreign key constraint fails") != false) {
                redirecionar("Categorias", "Erro ao excluir a Categoria. Ela está relacionada a outros registros.", "red");
            }
        } else {
            redirecionar("Categorias", "Erro ao excluir a Categoria. Erro: $ex", "red");
            exit;
        }
    }
?>
