<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idCategoria = isset($_POST["idCategoria"]) ? $_POST["idCategoria"] : "";
    $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";

    $campos = [
        "categoria" => $categoria
    ];

    validarCampos("Categorias", $campos);

    $sql = "UPDATE CATEGORIAS SET
            CATEGORIA = :categoria
            WHERE IDCATEGORIA = :idCategoria";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->bindParam(":idCategoria", $idCategoria);

    try {
        $stmt->execute();

        redirecionar("Categorias", "Categoria atualizada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Categorias", "Erro ao atualizar a Categoria.", "red");
        exit;
    }
?>
