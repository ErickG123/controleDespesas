<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";

    $campos = [
        "categoria" => $categoria
    ];

    validarCampos("Categorias", $campos);

    $sql = "INSERT INTO CATEGORIAS (CATEGORIA)
            VALUES (:categoria)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":categoria", $categoria);

    try {
        $stmt->execute();

        redirecionar("Categorias", "Categoria cadastrada com Sucesso", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Categorias", "Erro ao cadastrar a Categoria. Erro: $ex", "red");
        exit;
    }
?>
