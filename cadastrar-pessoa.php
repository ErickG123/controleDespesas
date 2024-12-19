<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Despesas - Cadastrar Pessoa</title>

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
        <form action="api/pessoas/criar-pessoa.php" method="post">
            <p class="rounded-md bg-blue-500 text-white text-center font-semibold p-2.5 mb-2.5">Dados do Cedente</p>
            <div class="grid grid-cols-3 gap-2.5 mb-2.5">
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="nome">Nome <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="nome" required>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="documento">CPF/CNPJ</label>
                    <input class="border border-black rounded-md p-2.5 outline-none input-documento" type="text" name="documento">
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="inscricaoEstadual">Inscrição Estadual</label>
                    <input class="border border-black rounded-md p-2.5 outline-none input-ie" type="text" name="inscricaoEstadual">
                </div>
            </div>
            <p class="rounded-md bg-blue-500 text-white text-center font-semibold p-2.5 mb-2.5">Endereço do Cedente</p>
            <div class="grid grid-cols-4 gap-2.5 mb-2.5">
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="cep">CEP</label>
                    <input class="border border-black rounded-md p-2.5 outline-none input-cep" type="text" name="cep">
                </div>
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownEstados" class="font-semibold mb-1">Estado</label>

                    <div id="dropdownEstados" class="relative">
                        <div id="selectedValuesEstados" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('Estados')">
                            <span id="selectedTextEstados" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsEstados" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputEstados" oninput="filterOptions('Estados')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "ESTADOS", "IDESTADO", "ESTADO", "opcoesEstados", "Estados", "Nenhum estado cadastrado."); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full h-full mr-2.5">
                    <label for="dropdownCidades" class="font-semibold mb-1">Cidade</label>

                    <div id="dropdownCidades" class="relative">
                        <div id="selectedValuesCidades" class="flex items-center justify-between rounded-md p-2.5 border border-black cursor-pointer" onclick="toggleOptions('Cidades')">
                            <span id="selectedTextCidades" class="truncate">Opções</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>

                        <div id="optionsCidades" class="absolute hidden mt-1 w-full bg-white rounded-md border border-gray-300 shadow-lg max-h-48 overflow-y-auto z-50">
                            <input type="text" id="searchInputCidades" oninput="filterOptions('Cidades')" placeholder="Pesquisar..." class="w-full p-2 border-b border-gray-300 outline-none">
                            <?php gerarSelect($conn, "CIDADES", "IDCIDADE", "CIDADE", "opcoesCidades", "Cidades", "Nenhuma cidade cadastrada."); ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="bairro">Bairro</label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="bairro">
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="numero">Número</label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="numero">
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="complemento">Complemento</label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="complemento">
                </div>
            </div>
            <p class="rounded-md bg-blue-500 text-white text-center font-semibold p-2.5 mb-2.5">Informações para Contato</p>
            <div class="grid grid-cols-4 gap-2.5">
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="telefone">Telefone</label>
                    <input class="border border-black rounded-md p-2.5 outline-none input-telefone" type="text" name="telefone">
                </div>
                <div class="flex flex-col">
                    <label class="font-semibold mb-1" for="email">E-mail</label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="email">
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
    <script><?= include_once("scripts/mascaras.js"); ?></script>
</body>
</html>
