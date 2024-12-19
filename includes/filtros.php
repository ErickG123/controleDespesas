<?php
    $filtroCategoria = isset($_GET["opcoesGruposFluxo"]) ? $_GET["opcoesGruposFluxo"][0] : "";
    $filtroFormaPagamento = isset($_GET["opcoesFormasPagamento"]) ? $_GET["opcoesFormasPagamento"][0] : "";
?>

<form class="shadow-lg rounded-md p-4" action="#" method="get">
    <div class="grid grid-cols-5 mb-2.5">
        <div class="flex flex-col mr-2.5">
            <label class="font-semibold mb-1" for="dataCompra">Data da Compra</label>
            <input class="border border-black p-2.5 rounded-md outline-none cursor-pointer" type="date" name="dataCompra" id="dataCompra">
        </div>
        <div class="flex flex-col">
            <label class="font-semibold mb-1" for="dataVencimento">Data de Vencimento</label>
            <input class="border border-black p-2.5 rounded-md outline-none cursor-pointer" type="date" name="dataVencimento" id="dataVencimento">
        </div>
    </div>
    <div class="flex">
        <div class="flex flex-col w-full h-full mr-2.5">
            <label for="dropdownPessoas" class="font-semibold mb-1">Cedente</label>

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

                <input type="hidden" id="idGruposFluxo" name="idGruposFluxo" value="<?= $filtroCategoria; ?>">
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

                <input type="hidden" id="idFormasPagamento" name="idFormasPagamento" value="<?= $filtroFormaPagamento; ?>">
            </div>
        </div>
    </div>
    <div class="h-px bg-gray-100 my-2.5"></div>
    <div class="flex justify-end">
        <button class="w-1/6 bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2.5" type="submit" onclick="clearFilter();">Limpar</button>
        <button class="w-1/6 bg-green-600 hover:bg-green-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="submit">Filtrar</button>
    </div>
</form>