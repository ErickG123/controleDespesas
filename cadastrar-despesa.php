<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Despesas - Cadastrar Despesa</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/output.css">
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

    <main class="shadow-lg rounded-md p-4">
        <form action="api/despesas/criar-despesa.php" method="post">
            <div class="grid grid-cols-4 gap-2.5">
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownPessoas" class="font-semibold mb-1">Cedente <span class="text-red-700">*</span></label>

                    <div id="dropdownPessoas" class="relative">
                        <div id="selectedValuesPessoas" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('Pessoas')">
                            <span id="selectedTextPessoas" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsPessoas" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputPessoas" oninput="filterOptions('Pessoas')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "PESSOAS", "IDPESSOA", "NOME", "opcoesPessoas", "Pessoas", "Nenhum cedente cadastrado."); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="observacoes">Observações</label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="observacoes">
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="valor">Valor <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="valor" required>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="dataCompra">Data da Compra <span class="text-red-700">*</span></label>
                    <input class="border border-black p-2.5 rounded-md outline-none" type="date" name="dataCompra" id="dataCompra" required>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="dataVencimento">Data de Vencimento <span class="text-red-700">*</span></label>
                    <input class="border border-black p-2.5 rounded-md outline-none" type="date" name="dataVencimento" id="dataVencimento" required>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="totalParcelas">Parcelas</label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="number" name="totalParcelas">
                </div>
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownGruposFluxo" class="font-semibold mb-1">Grupo de Fluxo</label>

                    <div id="dropdownGruposFluxo" class="relative">
                        <div id="selectedValuesGruposFluxo" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('GruposFluxo')">
                            <span id="selectedTextGruposFluxo" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsGruposFluxo" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputGruposFluxo" oninput="filterOptions('GruposFluxo')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "GRUPOSFLUXO", "IDGRUPOFLUXO", "GRUPOFLUXO", "opcoesGruposFluxo", "GruposFluxo", "Nenhuma grupo de fluxo cadastrada."); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full h-full">
                    <label for="dropdownFormasPagamento" class="font-semibold mb-1">Forma de Pagamento</label>

                    <div id="dropdownFormasPagamento" class="relative">
                        <div id="selectedValuesFormasPagamento" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('FormasPagamento')">
                            <span id="selectedTextFormasPagamento" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsFormasPagamento" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputFormasPagamento" oninput="filterOptions('FormasPagamento')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "FORMASPAGAMENTO", "IDFORMAPAGAMENTO", "FORMAPAGAMENTO", "opcoesFormasPagamento", "FormasPagamento", "Nenhuma forma de pagamento cadastrada."); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-px bg-gray-100 my-2.5"></div>
            <div class="flex justify-end">
                <button class="w-1/6 bg-green-600 hover:bg-green-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="submit">Criar</button>
            </div>
        </form>
    </main>

    <script><?= include_once("scripts/select.js"); ?></script>
    <script><?= include_once("scripts/alerta.js"); ?></script>
</body>
</html>
