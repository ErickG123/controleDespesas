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
        include_once("includes/alerta.php");
        getAlerta();
    ?>

    <?php include_once("header.php"); ?>

    <main class="shadow-lg rounded-md">
        <div class="border-b border-gray-200">
            <ul class="flex flex-wrap" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 active" id="caminhoes-tab" data-tabs-target="#caminhoes" type="button" role="tab" aria-controls="caminhoes" aria-selected="true">Caminhões</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="equipamentos-tab" data-tabs-target="#equipamentos" type="button" role="tab" aria-controls="equipamentos" aria-selected="false">Equipamentos</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="carregadeiras-tab" data-tabs-target="#carregadeiras" type="button" role="tab" aria-controls="carregadeiras" aria-selected="false">Carregadeiras</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="categorias-tab" data-tabs-target="#categorias" type="button" role="tab" aria-controls="categorias" aria-selected="false">Categorias</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="formasPagamento-tab" data-tabs-target="#formasPagamento" type="button" role="tab" aria-controls="formasPagamento" aria-selected="false">Formas de Pagamento</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="estados-tab" data-tabs-target="#estados" type="button" role="tab" aria-controls="estados" aria-selected="false">Estados</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="cidades-tab" data-tabs-target="#cidades" type="button" role="tab" aria-controls="cidades" aria-selected="false">Cidades</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2" id="empresas-tab" data-tabs-target="#empresas" type="button" role="tab" aria-controls="empresas" aria-selected="false">Empresas</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent" class="min-h-[32rem] max-h-[32rem] overflow-y-scroll">
            <div class="p-4 rounded-lg" id="caminhoes" role="tabpanel" aria-labelledby="caminhoes-tab">
                
            </div>
            <div class="p-4 rounded-lg" id="equipamentos" role="tabpanel" aria-labelledby="equipamentos-tab">
                
            </div>
            <div class="p-4 rounded-lg" id="carregadeiras" role="tabpanel" aria-labelledby="carregadeiras-tab">
                
            </div>
            <div class="p-4 rounded-lg" id="categorias" role="tabpanel" aria-labelledby="categorias-tab">
                
            </div>
            <div class="p-4 rounded-lg" id="formasPagamento" role="tabpanel" aria-labelledby="formasPagamento-tab">
                
            </div>
            <div class="p-4 rounded-lg" id="estados" role="tabpanel" aria-labelledby="estados-tab">
                
            </div>
            <div class="p-4 rounded-lg" id="cidades" role="tabpanel" aria-labelledby="cidades-tab">
                
            </div>
            <div class="p-4 rounded-lg" id="empresas" role="tabpanel" aria-labelledby="equipamentos-tab">
                
            </div>
        </div>
    </main>

    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
    <script><?= include_once("scripts/alerta.js"); ?></script>
</body>
</html>
