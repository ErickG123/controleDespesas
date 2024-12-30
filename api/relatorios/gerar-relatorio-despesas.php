<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Despesas - Relatório</title>

    <link rel="icon" href="../../images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/output.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="p-4 conteudo">
    <?php 
        include_once("../../includes/formatacoes.php");
        include_once("../../includes/despesas.php");
        include_once("../../database/conn.php");

        $dataCompraInicial = isset($_GET["dataCompraInicial"]) ? $_GET["dataCompraInicial"] : "";
        $dataCompraFinal = isset($_GET["dataCompraFinal"]) ? $_GET["dataCompraFinal"] : "";
        $dataVencimentoInicial = isset($_GET["dataVencimentoFinal"]) ? $_GET["dataVencimentoFinal"] : "";
        $dataVencimentoFinal = isset($_GET["dataVencimentoFinal"]) ? $_GET["dataVencimentoFinal"] : "";
        $filtroPessoa = isset($_GET["idPessoa"]) ? $_GET["idPessoa"] : "";
        $filtroGrupoFluxo = isset($_GET["idGrupoFluxo"]) ? $_GET["idGrupoFluxo"] : "";
        $filtroFormaPagamento = isset($_GET["idFormaPagamento"]) ? $_GET["idFormaPagamento"] : "";

        $despesas = obterDadosDespesas($dataCompraInicial, $dataCompraFinal, $dataVencimentoInicial, $dataVencimentoFinal, $filtroPessoa, $filtroGrupoFluxo, $filtroFormaPagamento);

        $totalGastos = obterTotalGastos($dataCompraInicial, $dataCompraFinal, $dataVencimentoInicial, $dataVencimentoFinal, $filtroPessoa, $filtroGrupoFluxo, $filtroFormaPagamento);

        $dataHoraAtual = date("d/m/Y H:i:s");
    ?>

    <header class="grid grid-cols-3 mb-2.5">
        <div class="col-span-1 w-64">
            <img src="../../images/recicla-eco-save.png" alt="Ícone Recicla">
        </div>

        <div class="col-span-1 w-full flex flex-col items-center">
            <h1 class="font-bold mb-4">RELATÓRIO DE DESPESA</h1>

            <p>RELATÓRIO GERADO: <?= $dataHoraAtual; ?></p>
        </div>
    </header>

    <div class="w-full flex justify-end mb-4 no-print">
        <button class="w-1/6 bg-blue-600 hover:bg-blue-500 text-white font-semibold p-2.5 rounded-md outline-none mr-2" onclick="imprimirRelatorio();">Imprmir</button>
        <button class="w-1/6 bg-yellow-600 hover:bg-yellow-500 text-white font-semibold p-2.5 rounded-md outline-none" onclick="salvarPDF()">Salvar como PDF</button>
    </div>

    <main>
        <table class="w-full"> 
            <thead>
                <tr>
                    <th class="border border-black text-center p-2.5">Cedente</th>
                    <th class="border border-black text-center p-2.5">Valor</th>
                    <th class="border border-black text-center p-2.5">Dt. Compra</th>
                    <th class="border border-black text-center p-2.5">Dt. Vencimento</th>
                    <th class="border border-black text-center p-2.5">Parcelas</th>
                    <th class="border border-black text-center p-2.5">Formas de Pagamento</th>
                    <th class="border border-black text-center p-2.5">Grupo de Fluxo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($despesas as $despesa): ?>
                    <tr>
                        <td class="border-b border-black p-2.5"><?= $despesa["NOME"]; ?></td>
                        <td class="border-b border-black text-end p-2.5"><?= $despesa["VALOR"] ? formatarValorReal($despesa["VALOR"]) : "-"; ?></td>
                        <td class="border-b border-black text-end p-2.5"><?= $despesa["DATACOMPRA"] ? formatarData($despesa["DATACOMPRA"]) : "-"; ?></td>
                        <td class="border-b border-black text-end p-2.5"><?= $despesa["DATAVENCIMENTO"] ? formatarData($despesa["DATAVENCIMENTO"]) : "-"; ?></td>
                        <td class="border-b border-black text-end p-2.5">
                            <?php
                                if ($despesa["TOTALPARCELAS"]) {
                                    echo $despesa["PARCELA"] . "/" . $despesa["TOTALPARCELAS"];
                                } else {
                                    echo "1/1";
                                }
                            ?>
                        </td>
                        <td class="border-b border-black text-center p-2.5"><?= $despesa["FORMAPAGAMENTO"] ? $despesa["FORMAPAGAMENTO"] : "-"; ?></td>
                        <td class="border-b border-black text-center p-2.5"><?= $despesa["GRUPOFLUXO"] ? $despesa["GRUPOFLUXO"] : "-"; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer class="border border-black mt-4">
        <div class="flex justify-between">
            <p class="font-bold p-2.5">TOTAL</p>
            <p class="p-2.5"><?= $totalGastos ? formatarValorReal($totalGastos) : "R$ 0,00"; ?></p>
        </div>
    </footer>

    <script><?php include_once("../../scripts/relatorios.js"); ?></script>
</body>
</html>
