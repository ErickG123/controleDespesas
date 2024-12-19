<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Despesas - Despesa</title>

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

        $idDespesa = isset($_GET["idDespesa"]) ? $_GET["idDespesa"] : "";

        $sql = "SELECT DP.OBSERVACOES, DP.VALOR, DP.DATACOMPRA, DP.DATAVENCIMENTO, DP.PARCELAS,
                       FP.FORMAPAGAMENTO, GF.GRUPOFLUXO, PS.NOME
                FROM DESPESAS DP
                LEFT JOIN FORMASPAGAMENTO FP ON DP.IDFORMAPAGAMENTO = FP.IDFORMAPAGAMENTO
                LEFT JOIN GRUPOSFLUXO GF ON DP.IDGRUPOFLUXO = GF.IDGRUPOFLUXO
                LEFT JOIN PESSOAS PS ON DP.IDPESSOA = PS.IDPESSOA
                WHERE DP.IDDESPESA = :idDespesa";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":idDespesa", $idDespesa);
        $stmt->execute();

        $despesa = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <?php include_once("header.php"); ?>

    <main class="shadow-lg rounded-md p-4">
        <p class="rounded-md bg-blue-500 text-white text-center font-semibold p-2.5 mb-2.5">Detalhes da Despesa</p>
        <div class="grid grid-cols-4 gap-2.5">
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Cedente</p>
                <p><?= $despesa["NOME"] ? $despesa["NOME"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Observações</p>
                <p><?= $despesa["OBSERVACOES"] ? $despesa["OBSERVACOES"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Valor</p>
                <p><?= $despesa["VALOR"] ? formatarValorReal($despesa["VALOR"]) : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Data de Compra</p>
                <p><?= $despesa["DATACOMPRA"] ? formatarData($despesa["DATACOMPRA"]) : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Data de Vencimento</p>
                <p><?= $despesa["DATAVENCIMENTO"] ? formatarData($despesa["DATAVENCIMENTO"]) : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Parcelas</p>
                <p><?= $despesa["PARCELAS"] ? $despesa["PARCELAS"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Grupo de Fluxo</p>
                <p><?= $despesa["GRUPOFLUXO"] ? $despesa["GRUPOFLUXO"] : ""; ?></p>
            </div>
            <div class="flex flex-col">
                <p class="font-semibold mb-1">Forma de Pagamento</p>
                <p><?= $despesa["FORMAPAGAMENTO"] ? $despesa["FORMAPAGAMENTO"] : ""; ?></p>
            </div>
        </div>
    </main>

    <script><?= include_once("scripts/alerta.js"); ?></script>
</body>
</html>
