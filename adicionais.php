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
        include_once("includes/select.php");
        include_once("includes/alerta.php");
        getAlerta();
    ?>

    <?php include_once("header.php"); ?>

    <div class="shadow-lg rounded-md p-4">
        <button class="w-1/6 bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="abrirModalCriarFormaPagamento();">+ Forma de Pagamento</button>
        <button class="w-1/6 bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="abrirModalCriarGrupoFluxo();">+ Grupo de Fluxo</button>
        <button class="w-1/6 bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="abrirModalCriarEstado();">+ Estado</button>
        <button class="w-1/6 bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="abrirModalCriarCidade();">+ Cidade</button>
    </div>

    <main class="shadow-lg rounded-md p-4">
        <div class="border-b border-gray-200">
            <ul class="flex flex-wrap" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 active" id="formasPagamento-tab" data-tabs-target="#formasPagamento" type="button" role="tab" aria-controls="formasPagamento" aria-selected="true">Formas de Pagamento</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="gruposFluxo-tab" data-tabs-target="#gruposFluxo" type="button" role="tab" aria-controls="gruposFluxo" aria-selected="false">Grupos de Fluxo</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="estados-tab" data-tabs-target="#estados" type="button" role="tab" aria-controls="estados" aria-selected="false">Estados</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="cidades-tab" data-tabs-target="#cidades" type="button" role="tab" aria-controls="cidades" aria-selected="false">Cidades</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent" class="min-h-[32rem] max-h-[32rem] overflow-y-scroll">
            <div class="p-4 rounded-lg" id="formasPagamento" role="tabpanel" aria-labelledby="formasPagamento-tab">
                <?php 
                    $sql = "SELECT FP.IDFORMAPAGAMENTO, FP.FORMAPAGAMENTO
                            FROM FORMASPAGAMENTO FP";

                    $stmt = $conn->query($sql);

                    $formasPagamento = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($formasPagamento as $formaPagamento) {
                ?>
                    <div class="flex items-center justify-between border-b border-gray-400">
                        <p><?= $formaPagamento["FORMAPAGAMENTO"]; ?></p>
                        <div class="flex my-2">
                            <p class="w-full md:w-auto bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold rounded-md p-2.5 outline-none cursor-pointer mr-2 editar-forma-pagamento" data-id="<?= $formaPagamento["IDFORMAPAGAMENTO"]; ?>">Editar</p>
                            <p class="w-full md:w-auto bg-red-600 hover:bg-red-500 text-white text-center font-semibold rounded-md p-2.5 outline-none cursor-pointer excluir-forma-pagamento" data-id="<?= $formaPagamento["IDFORMAPAGAMENTO"]; ?>" onclick="abrirModalExcluirFormaPagamento();">Excluir</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="p-4 rounded-lg hidden" id="gruposFluxo" role="tabpanel" aria-labelledby="gruposFluxo-tab">
                <?php 
                    $sql = "SELECT GF.IDGRUPOFLUXO, GF.GRUPOFLUXO
                            FROM GRUPOSFLUXO GF";

                    $stmt = $conn->query($sql);

                    $gruposFluxo = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($gruposFluxo as $grupoFluxo) {
                ?>
                    <div class="flex items-center justify-between border-b border-gray-400">
                        <p><?= $grupoFluxo["GRUPOFLUXO"]; ?></p>
                        <div class="flex my-2">
                            <p class="w-full md:w-auto bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold rounded-md p-2.5 outline-none cursor-pointer mr-2 editar-grupo-fluxo" data-id="<?= $grupoFluxo["IDGRUPOFLUXO"]; ?>">Editar</p>
                            <p class="w-full md:w-auto bg-red-600 hover:bg-red-500 text-white text-center font-semibold rounded-md p-2.5 outline-none cursor-pointer excluir-grupo-fluxo" data-id="<?= $grupoFluxo["IDGRUPOFLUXO"]; ?>" onclick="abrirModalExcluirGrupoFluxo();">Excluir</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="p-4 rounded-lg hidden" id="estados" role="tabpanel" aria-labelledby="estados-tab">
                <?php 
                    $sql = "SELECT E.IDESTADO, E.ESTADO
                            FROM ESTADOS E";

                    $stmt = $conn->query($sql);

                    $estados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($estados as $estado) {
                ?>
                    <div class="flex items-center justify-between border-b border-gray-400">
                        <p><?= $estado["ESTADO"]; ?></p>
                        <div class="flex my-2">
                            <p class="w-full md:w-auto bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold rounded-md p-2.5 outline-none cursor-pointer mr-2 editar-estado" data-id="<?= $estado["IDESTADO"]; ?>">Editar</p>
                            <p class="w-full md:w-auto bg-red-600 hover:bg-red-500 text-white text-center font-semibold rounded-md p-2.5 outline-none cursor-pointer excluir-estado" data-id="<?= $estado["IDESTADO"]; ?>" onclick="abrirModalExcluirEstado();">Excluir</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="p-4 rounded-lg hidden" id="cidades" role="tabpanel" aria-labelledby="cidades-tab">
                <?php 
                    $sql = "SELECT C.IDCIDADE, C.CIDADE, E.ESTADO
                            FROM CIDADES C
                            INNER JOIN ESTADOS E ON C.IDESTADO = E.IDESTADO";

                    $stmt = $conn->query($sql);

                    $cidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($cidades as $cidade) {
                ?>
                    <div class="flex items-center justify-between border-b border-gray-400">
                        <div class="w-full flex">
                            <p class="w-1/3"><?= $cidade["CIDADE"]; ?></p>
                            <p class="w-1/3"><?= $cidade["ESTADO"]; ?></p>
                        </div>
                        <div class="flex my-2">
                            <p class="w-full md:w-auto bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold rounded-md p-2.5 outline-none cursor-pointer mr-2 editar-cidade" data-id="<?= $cidade["IDCIDADE"]; ?>">Editar</p>
                            <p class="w-full md:w-auto bg-red-600 hover:bg-red-500 text-white text-center font-semibold rounded-md p-2.5 outline-none cursor-pointer excluir-cidade" data-id="<?= $cidade["IDCIDADE"]; ?>" onclick="abrirModalExcluirCidade();">Excluir</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php include_once("includes/modais/modal-forma-pagamento.php"); ?>
    <?php include_once("includes/modais/modal-grupo-fluxo.php"); ?>
    <?php include_once("includes/modais/modal-estado.php"); ?>
    <?php include_once("includes/modais/modal-cidade.php"); ?>

    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
    <script><?= include_once("scripts/alerta.js"); ?></script>
    <script><?= include_once("scripts/select.js"); ?></script>
</body>
</html>
