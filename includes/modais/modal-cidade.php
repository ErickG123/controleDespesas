<div id="modalCriarCidade" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalCriarCidadeContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalCriarCidade" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoAbrirCidade" class="hidden mt-2">
            <form action="api/cidades/criar-cidade.php" method="post">
                <div class="flex flex-col mb-2">
                    <label for="cidade">Cidade <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="cidade" required>
                </div>

                <div class="flex flex-col w-full h-full mb-2.5">
                    <label for="dropdownEstados">Estado <span class="text-red-700">*</span></label>

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

                <div class="flex flex-col md:flex-row justify-between">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2 mb-2 md:mb-0" type="submit">Cadastrar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalCriarCidade();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalEditarCidade" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalEditarCidadeContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalEditarCidade" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoEditarCidade" class="hidden mt-2">
            <form action="api/cidades/editar-cidade.php" method="post">
                <div class="flex flex-col mb-2.5">
                    <label for="cidade">Cidade <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="cidade" id="cidadeEditar" required>
                </div>

                <div class="flex flex-col mb-2.5">
                    <label class="font-semibold" for="estado">Estado</label>
                    <select class="bg-gray-100 rounded-md p-2.5 outline-none" name="estado" id="estado">
                        <?php
                            $sql = "SELECT E.IDESTADO, E.ESTADO
                                    FROM ESTADOS E";

                            $stmt = $conn->query($sql);
                            $estados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($estados as $estado) {
                        ?>
                            <option value="<?= $estado["IDESTADO"]; ?>"><?= $estado["ESTADO"]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <input type="hidden" name="idCidade" id="idCidadeEditar">

                <div class="flex flex-col md:flex-row justify-between">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2 mb-2 md:mb-0" type="submit">Atualizar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalEditarCidade();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalExcluirCidade" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalExcluirCidadeContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalExcluirCidade" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoExcluirCidade" class="hidden mt-2">
            <form action="api/cidades/excluir-cidade.php" method="post">
                <p class="font-semibold text-xl mb-2">Você tem certeza que deseja excluir a cidade?</p>

                <input type="hidden" name="idCidade" id="idCidadeExcluir">

                <div class="flex flex-col">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mb-2" type="submit">Confirmar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalExcluirCidade();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script><?= include_once("scripts/modais/cidades/modal-criar-cidade.js"); ?></script>
<script><?= include_once("scripts/modais/cidades/modal-editar-cidade.js"); ?></script>
<script><?= include_once("scripts/modais/cidades/modal-excluir-cidade.js"); ?></script>
