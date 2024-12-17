<?php 
    session_start();
    include_once("../../database/conn.php");
    include_once("../../includes/alerta.php");

    $idCarregadeira = isset($_POST["idCarregadeira"]) ? $_POST["idCarregadeira"] : "";
    $carregadeira = isset($_POST["carregadeira"]) ? $_POST["carregadeira"] : "";

    $campos = [
        "carregadeira" => $carregadeira
    ];

    validarCampos("Carregadeiras", $campos);

    $sql = "UPDATE CARREGADEIRAS SET
            CARREGADEIRA = :carregadeira
            WHERE IDCARREGADEIRA = :idCarregadeira";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":carregadeira", $carregadeira);
    $stmt->bindParam(":idCarregadeira", $idCarregadeira);

    try {
        $stmt->execute();

        redirecionar("Carregadeiras", "Carregadeira atualizada com Sucesso!", "green");
        exit;
    } catch (PDOException $ex) {
        redirecionar("Carregadeiras", "Erro ao atualizar a Carregadeira.", "red");
        exit;
    }
?>
