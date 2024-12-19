<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Despesas - Pessoa</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/output.css">
</head>
<body class="w-11/12 mx-auto p-4">
    <?php 
        include_once("database/conn.php");
        include_once("includes/formatacoes.php");
        include_once("includes/alerta.php");
        getAlerta();

        $idPessoa = isset($_GET["idPessoa"]) ? $_GET["idPessoa"] : "";

        $sql = "SELECT PS.NOME, PS.DOCUMENTO, PS.INSCRICAOESTADUAL, PS.CEP, PS.ENDERECO,
                       PS.BAIRRO, PS.NUMERO, PS.COMPLEMENTO, CD.CIDADE, ED.SIGLA, PS.TELEFONE,
                       PS.EMAIL
                FROM PESSOAS PS
                LEFT JOIN CIDADES CD ON PS.IDCIDADE = CD.IDCIDADE
                LEFT JOIN ESTADOS ED ON CD.IDESTADO = ED.IDESTADO
                WHERE PS.IDPESSOA = :idPessoa";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":idPessoa", $idPessoa);
        $stmt->execute();

        $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <?php include_once("header.php"); ?>

    <main class="shadow-lg rounded-md p-4">
        <p class="rounded-md bg-blue-500 text-white text-center font-semibold p-2.5 mb-2.5">Dados do Cedente</p>
        <div class="grid grid-cols-3 gap-2.5 mb-2.5">
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Nome</p>
                <p><?= $pessoa["NOME"] ? $pessoa["NOME"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">CPF/CNPJ</p>
                <p><?= $pessoa["DOCUMENTO"] ? formatarDocumento($pessoa["DOCUMENTO"]) : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Inscrição Estadual</p>
                <p><?= $pessoa["INSCRICAOESTADUAL"] ? formatarIE($pessoa["INSCRICAOESTADUAL"]) : ""; ?></p>
            </div>
        </div>
        <p class="rounded-md bg-blue-500 text-white text-center font-semibold p-2.5 mb-2.5">Endereço do Cedente</p>
        <div class="grid grid-cols-4 mb-2.5">
            <div class="flex flex-col">
                <p class="font-semibold mb-1">CEP</p>
                <p><?= $pessoa["CEP"] ? $pessoa["CEP"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Endereço</p>
                <p><?= $pessoa["ENDERECO"] ? $pessoa["ENDERECO"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Cidade</p>
                <p><?= $pessoa["CIDADE"] ? $pessoa["CIDADE"] . "/" . $pessoa["SIGLA"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Bairro</p>
                <p><?= $pessoa["BAIRRO"] ? $pessoa["BAIRRO"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Número</p>
                <p><?= $pessoa["NUMERO"] ? $pessoa["NUMERO"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Complemento</p>
                <p><?= $pessoa["COMPLEMENTO"] ? $pessoa["COMPLEMENTO"] : ""; ?></p>
            </div>
        </div>
        <p class="rounded-md bg-blue-500 text-white text-center font-semibold p-2.5 mb-2.5">Informações para Contato</p>
        <div class="grid grid-cols-4 gap-2.5">
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Telefone</p>
                <p><?= $pessoa["TELEFONE"] ? formatarTelefone($pessoa["TELEFONE"]) : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">E-mail</p>
                <p><?= $pessoa["EMAIL"] ? $pessoa["EMAIL"] : ""; ?></p>
            </div>
        </div>
    </main>

    <script><?= include_once("scripts/alerta.js"); ?></script>
</body>
</html>
