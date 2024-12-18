<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Despesas - Adicionais</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/output.css">

    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
</head>
<body class="w-11/12 mx-auto p-4">
    <?php 
        session_start();
        include_once("database/conn.php");
        include_once("includes/alerta.php");
        getAlerta();
    ?>

    <?php include_once("header.php"); ?>

    <main class="shadow-lg rounded-md">
        
    </main>

    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
    <script><?= include_once("scripts/alerta.js"); ?></script>
</body>
</html>
