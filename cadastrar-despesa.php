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
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="descricao">Descrição <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="descricao" required>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="valor">Valor <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="valor" required>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="dataCompra">Data da Compra</label>
                    <input class="border border-black p-2.5 rounded-md outline-none" type="date" name="dataCompra" id="dataCompra">
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="dataVencimento">Data de Vencimento</label>
                    <input class="border border-black p-2.5 rounded-md outline-none" type="date" name="dataVencimento" id="dataVencimento">
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="parcelas">Parcelas</label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="number" name="parcelas">
                </div>
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownPessoas" class="font-semibold mb-1">Pessoa</label>

                    <div id="dropdownPessoas" class="relative">
                        <div id="selectedValuesPessoas" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('Pessoas')">
                            <span id="selectedTextPessoas" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsPessoas" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputPessoas" oninput="filterOptions('Pessoas')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "PESSOAS", "IDPESSOA", "NOME", "opcoesPessoas", "Pessoas", "Nenhuma pessoa cadastrado."); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownCaminhoes" class="font-semibold mb-1">Caminhão</label>

                    <div id="dropdownCaminhoes" class="relative">
                        <div id="selectedValuesCaminhoes" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('Caminhoes')">
                            <span id="selectedTextCaminhoes" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsCaminhoes" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputCaminhoes" oninput="filterOptions('Caminhoes')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "CAMINHOES", "IDCAMINHAO", "CAMINHAO", "opcoesCaminhoes", "Caminhoes", "Nenhum caminhão cadastrado."); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownEquipamentos" class="font-semibold mb-1">Equipamento</label>

                    <div id="dropdownEquipamentos" class="relative">
                        <div id="selectedValuesEquipamentos" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('Equipamentos')">
                            <span id="selectedTextEquipamentos" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsEquipamentos" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputEquipamentos" oninput="filterOptions('Equipamentos')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "EQUIPAMENTOS", "IDEQUIPAMENTO", "EQUIPAMENTO", "opcoesEquipamentos", "Equipamentos", "Nenhum equipamento cadastrado."); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownCarregadeiras" class="font-semibold mb-1">Carregadeira</label>

                    <div id="dropdownCarregadeiras" class="relative">
                        <div id="selectedValuesCarregadeiras" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('Carregadeiras')">
                            <span id="selectedTextCarregadeiras" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsCarregadeiras" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputCarregadeiras" oninput="filterOptions('Carregadeiras')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "CARREGADEIRAS", "IDCARREGADEIRA", "CARREGADEIRA", "opcoesCarregadeiras", "Carregadeiras", "Nenhuma carregadeira cadastrada."); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownCategorias" class="font-semibold mb-1">Categoria</label>

                    <div id="dropdownCategorias" class="relative">
                        <div id="selectedValuesCategorias" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('Categorias')">
                            <span id="selectedTextCategorias" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsCategorias" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputCategorias" oninput="filterOptions('Categorias')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "CATEGORIAS", "IDCATEGORIA", "CATEGORIA", "opcoesCategorias", "Categorias", "Nenhuma categoria cadastrada."); ?>
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
