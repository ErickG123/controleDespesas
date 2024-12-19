<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Despesas - Home</title>

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

    <?php include_once("includes/filtros.php"); ?>

    <main class="shadow-md rounded-md my-4 min-h-[32rem] max-h-[32rem] overflow-y-scroll">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr class="text-gray-600">
                    <th class="text-start p-2.5">Cedente</th>
                    <th class="text-start p-2.5">Valor</th>
                    <th class="text-start p-2.5">Observacoes</th>
                    <th class="text-start p-2.5">Dt. Compra</th>
                    <th class="text-start p-2.5">Dt. Vencimento</th>
                    <th class="text-start p-2.5">Parcelas</th>
                    <th class="text-start p-2.5">Forma de Pagamento</th>
                    <th class="text-start p-2.5">Grupo de Fluxo</th>
                    <th class="text-start p-2.5">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "SELECT DP.IDDESPESA, DP.OBSERVACOES, DP.VALOR, DP.DATACOMPRA, DP.DATAVENCIMENTO,
                                   DP.PARCELAS, FP.FORMAPAGAMENTO, GF.GRUPOFLUXO, PS.NOME
                            FROM DESPESAS DP
                            LEFT JOIN FORMASPAGAMENTO FP ON DP.IDFORMAPAGAMENTO = FP.IDFORMAPAGAMENTO
                            LEFT JOIN GRUPOSFLUXO GF ON DP.IDGRUPOFLUXO = GF.IDGRUPOFLUXO
                            LEFT JOIN PESSOAS PS ON DP.IDPESSOA = PS.IDPESSOA
                            WHERE (FP.IDFORMAPAGAMENTO = :idFormaPagamento OR :idFormaPagamento = '')
                            AND (GF.IDGRUPOFLUXO = :idGrupoFluxo OR :idGrupoFluxo = '')
                            AND (PS.IDPESSOA = :idPessoa OR :idPessoa = '')";

                    if ($dataCompraInicial && $dataCompraFinal) {
                        $sql .= " AND DP.DATACOMPRA BETWEEN :dataCompraInicial AND :dataCompraFinal";
                    }
                    if ($dataVencimentoInicial && $dataVencimentoFinal) {
                        $sql .= " AND DP.DATAVENCIMENTO BETWEEN :dataVencimentoInicial AND :dataVencimentoFinal";
                    }

                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":idFormaPagamento", $filtroFormaPagamento);
                    $stmt->bindParam(":idGrupoFluxo", $filtroGrupoFluxo);
                    $stmt->bindParam(":idPessoa", $filtroPessoa);

                    if ($dataCompraInicial && $dataCompraFinal) {
                        $stmt->bindParam(":dataCompraInicial", $dataCompraInicial);
                        $stmt->bindParam(":dataCompraFinal", $dataCompraFinal);
                    }
                    if ($dataVencimentoInicial && $dataVencimentoFinal) {
                        $stmt->bindParam(":dataVencimentoInicial", $dataVencimentoInicial);
                        $stmt->bindParam(":dataVencimentoFinal", $dataVencimentoFinal);
                    }

                    $stmt->execute();

                    $despesas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($despesas as $despesa) {
                ?>
                    <tr class="border-b border-gray-100">
                        <td class="p-2.5 whitespace-nowrap overflow-hidden text-ellipsis max-w-48"><?= $despesa["NOME"]; ?></td>
                        <td class="p-2.5"><?= formatarValorReal($despesa["VALOR"]); ?></td>
                        <td class="p-2.5 whitespace-nowrap overflow-hidden text-ellipsis max-w-48"><?= $despesa["OBSERVACOES"] ? $despesa["OBSERVACOES"] : "-"; ?></td>
                        <td class="p-2.5"><?= $despesa["DATACOMPRA"] ? formatarData($despesa["DATACOMPRA"]) : "-"; ?></td>
                        <td class="p-2.5"><?= $despesa["DATAVENCIMENTO"] ? formatarData($despesa["DATAVENCIMENTO"]) : "-"; ?></td>
                        <td class="p-2.5"><?= $despesa["PARCELAS"] ? $despesa["PARCELAS"] : "-"; ?></td>
                        <td class="p-2.5"><?= $despesa["FORMAPAGAMENTO"] ? $despesa["FORMAPAGAMENTO"] : "-"; ?></td>
                        <td class="p-2.5"><?= $despesa["GRUPOFLUXO"] ? $despesa["GRUPOFLUXO"] : "-"; ?></td>
                        <td class="p-2.5 text-center font-bold cursor-pointer relative dropdown">
                            ...
                            <div class="dropdown-content absolute right-0 bg-white shadow-lg rounded-lg">
                                <a href="<?= "despesa.php?idDespesa=" . $despesa["IDDESPESA"]; ?>">Ver</a>
                                <a href="<?= "atualizar-despesa.php?idDespesa=" . $despesa["IDDESPESA"]; ?>">Editar</a>
                                <p class="excluir-despesa" data-id="<?= $despesa["IDDESPESA"]; ?>" onclick="abrirModalExcluirDespesa();">Excluir</p>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <?php include_once("includes/modais/modal-despesa.php"); ?>

    <script><?= include_once("scripts/alerta.js"); ?></script>
    <script><?= include_once("scripts/select.js"); ?></script>
    <script><?= include_once("scripts/dropdown.js"); ?></script>
</body>
</html>
