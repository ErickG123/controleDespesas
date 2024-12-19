<div id="modalCriarGrupoFluxo" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalCriarGrupoFluxoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalCriarGrupoFluxo" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoAbrirGrupoFluxo" class="hidden mt-2">
            <form action="api/gruposfluxo/criar-grupo-fluxo.php" method="post">
                <div class="flex flex-col mb-2">
                    <label for="grupoFluxo">Grupo de Fluxo <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="grupoFluxo" required>
                </div>

                <div class="flex flex-col md:flex-row justify-between">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2 mb-2 md:mb-0" type="submit">Cadastrar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalCriarGrupoFluxo();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalEditarGrupoFluxo" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalEditarGrupoFluxoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalEditarGrupoFluxo" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoEditarGrupoFluxo" class="hidden mt-2">
            <form action="api/gruposfluxo/editar-grupo-fluxo.php" method="post">
                <div class="flex flex-col mb-2">
                    <label for="grupoFluxo">Grupo de Fluxo <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="grupoFluxo" id="grupoFluxoEditar" required>
                </div>

                <input type="hidden" name="idGrupoFluxo" id="idGrupoFluxoEditar">

                <div class="flex flex-col md:flex-row justify-between">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2 mb-2 md:mb-0" type="submit">Atualizar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalEditarGrupoFluxo();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalExcluirGrupoFluxo" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalExcluirGrupoFluxoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalExcluirGrupoFluxo" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoExcluirGrupoFluxo" class="hidden mt-2">
            <form action="api/gruposfluxo/excluir-grupo-fluxo.php" method="post">
                <p class="font-semibold text-xl mb-2">Você tem certeza que deseja excluir o grupo de fluxo?</p>

                <input type="hidden" name="idGrupoFluxo" id="idGrupoFluxoExcluir">

                <div class="flex flex-col">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mb-2" type="submit">Confirmar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalExcluirGrupoFluxo();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script><?= include_once("scripts/modais/gruposfluxo/modal-criar-grupo-fluxo.js"); ?></script>
<script><?= include_once("scripts/modais/gruposfluxo/modal-editar-grupo-fluxo.js"); ?></script>
<script><?= include_once("scripts/modais/gruposfluxo/modal-excluir-grupo-fluxo.js"); ?></script>
