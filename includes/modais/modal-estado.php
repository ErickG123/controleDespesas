<div id="modalCriarEstado" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalCriarEstadoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalCriarEstado" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoAbrirEstado" class="hidden mt-2">
            <form action="api/estados/criar-estado.php" method="post">
                <div class="flex">
                    <div class="w-full flex flex-col mb-2 mr-2.5">
                        <label for="estado">Estado <span class="text-red-700">*</span></label>
                        <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="estado" required>
                    </div>

                    <div class="w-full flex flex-col mb-2">
                        <label for="estado">Sigla <span class="text-red-700">*</span></label>
                        <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="sigla" required>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-between">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2 mb-2 md:mb-0" type="submit">Cadastrar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalCriarEstado();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalEditarEstado" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalEditarEstadoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalEditarEstado" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoEditarEstado" class="hidden mt-2">
            <form action="api/estados/editar-estado.php" method="post">
                <div class="flex">
                    <div class="w-full flex flex-col mb-2 mr-2.5">
                        <label for="estado">Grupo de Fluxo <span class="text-red-700">*</span></label>
                        <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="estado" id="estadoEditar" required>
                    </div>

                    <div class="w-full flex flex-col mb-2">
                        <label for="estado">Sigla <span class="text-red-700">*</span></label>
                        <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="sigla" id="siglaEditar" required>
                    </div>
                </div>

                <input type="hidden" name="idEstado" id="idEstadoEditar">

                <div class="flex flex-col md:flex-row justify-between">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2 mb-2 md:mb-0" type="submit">Atualizar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalEditarEstado();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalExcluirEstado" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalExcluirEstadoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalExcluirEstado" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoExcluirEstado" class="hidden mt-2">
            <form action="api/estados/excluir-estado.php" method="post">
                <p class="font-semibold text-xl mb-2">Você tem certeza que deseja excluir o estado?</p>

                <input type="hidden" name="idEstado" id="idEstadoExcluir">

                <div class="flex flex-col">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mb-2" type="submit">Confirmar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalExcluirEstado();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script><?= include_once("scripts/modais/estados/modal-criar-estado.js"); ?></script>
<script><?= include_once("scripts/modais/estados/modal-editar-estado.js"); ?></script>
<script><?= include_once("scripts/modais/estados/modal-excluir-estado.js"); ?></script>
