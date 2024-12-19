<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Despesas - Pessoas</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/output.css">
    <link rel="stylesheet" href="styles/dropdown.css">
</head>
<body class="w-11/12 mx-auto p-4">
    <?php
        session_start();
        include_once("database/conn.php");
        include_once("includes/select.php");
        include_once("includes/formatacoes.php");
        include_once("includes/alerta.php");
        getAlerta();
    ?>

    <?php include_once("header.php"); ?>

    <main class="shadow-md rounded-md my-4 min-h-[32rem] max-h-[32rem] overflow-y-scroll">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr class="text-gray-600">
                    <th class="text-start p-2.5">Cedente</th>
                    <th class="text-start p-2.5">CPF/CNPJ</th>
                    <th class="text-start p-2.5">Cidade</th>
                    <th class="text-start p-2.5">Telefone</th>
                    <th class="text-center p-2.5">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT PS.IDPESSOA, PS.NOME, PS.DOCUMENTO, PS.INSCRICAOESTADUAL, PS.CEP, PS.ENDERECO,
                                   PS.BAIRRO, PS.NUMERO, PS.COMPLEMENTO, PS.TELEFONE, PS.EMAIL, CD.CIDADE, ED.SIGLA
                            FROM PESSOAS PS
                            LEFT JOIN CIDADES CD ON PS.IDCIDADE = CD.IDCIDADE
                            LEFT JOIN ESTADOS ED ON CD.IDESTADO = ED.IDESTADO";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    $pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($pessoas as $pessoa) {
                ?>
                    <tr class="border-b border-gray-100">
                        <td class="p-2.5 whitespace-nowrap overflow-hidden text-ellipsis max-w-48"><?= $pessoa["NOME"]; ?></td>
                        <td class="p-2.5"><?= $pessoa["DOCUMENTO"] ? formatarDocumento($pessoa["DOCUMENTO"]) : "-"; ?></td>
                        <td class="p-2.5"><?= $pessoa["CIDADE"] ? $pessoa["CIDADE"] . "/" . $pessoa["SIGLA"] : "-"; ?></td>
                        <td class="p-2.5"><?= $pessoa["TELEFONE"] ? formatarTelefone($pessoa["TELEFONE"]) : "-"; ?></td>
                        <td class="p-2.5 text-center font-bold cursor-pointer relative dropdown">
                            ...
                            <div class="dropdown-content absolute right-0 bg-white shadow-lg rounded-lg">
                                <a href="<?= "pessoa.php?idPessoa=" . $pessoa["IDPESSOA"]; ?>">Ver</a>
                                <a href="<?= "atualizar-pessoa.php?idPessoa=" . $pessoa["IDPESSOA"]; ?>">Editar</a>
                                <p class="excluir-pessoa" data-id="<?= $pessoa["IDPESSOA"]; ?>" onclick="abrirModalExcluirPessoa();">Excluir</p>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <?php include_once("includes/modais/modal-pessoa.php"); ?>

    <script><?= include_once("scripts/alerta.js"); ?></script>
    <script><?= include_once("scripts/select.js"); ?></script>
    <script><?= include_once("scripts/dropdown.js"); ?></script>
</body>
</html>
