<?php 
    $host = "localhost";
    $dbname = "controledespesas";
    $username = "root";
    $password = "root";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        print_r("Erro ao se Conectar com o Banco de Dados");
        exit;
    }
?>
