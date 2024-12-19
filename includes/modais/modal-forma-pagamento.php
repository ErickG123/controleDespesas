<div id="modalCriarFormaPagamento" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalCriarFormaPagamentoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalCriarFormaPagamento" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoAbrirFormaPagamento" class="hidden mt-2">
            <form action="api/formaspagamento/criar-forma-pagamento.php" method="post">
                <div class="flex flex-col mb-2">
                    <label for="formaPagamento">Forma de Pagamento <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="formaPagamento" required>
                </div>

                <div class="flex flex-col md:flex-row justify-between">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2 mb-2 md:mb-0" type="submit">Cadastrar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalCriarFormaPagamento();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalEditarFormaPagamento" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalEditarFormaPagamentoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalEditarFormaPagamento" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoEditarFormaPagamento" class="hidden mt-2">
            <form action="api/formaspagamento/editar-forma-pagamento.php" method="post">
                <div class="flex flex-col mb-2">
                    <label for="formaPagamento">Forma de Pagamento <span class="text-red-700">*</span></label>
                    <input class="border border-black rounded-md p-2.5 outline-none" type="text" name="formaPagamento" id="formaPagamentoEditar" required>
                </div>

                <input type="hidden" name="idFormaPagamento" id="idFormaPagamentoEditar">

                <div class="flex flex-col md:flex-row justify-between">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mr-2 mb-2 md:mb-0" type="submit">Atualizar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalEditarFormaPagamento();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalExcluirFormaPagamento" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalExcluirFormaPagamentoContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalExcluirFormaPagamento" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoExcluirFormaPagamento" class="hidden mt-2">
            <form action="api/formaspagamento/excluir-forma-pagamento.php" method="post">
                <p class="font-semibold text-xl mb-2">Você tem certeza que deseja excluir a forma de pagamento?</p>

                <input type="hidden" name="idFormaPagamento" id="idFormaPagamentoExcluir">

                <div class="flex flex-col">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mb-2" type="submit">Confirmar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalExcluirFormaPagamento();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script><?= include_once("scripts/modais/formaspagamento/modal-criar-forma-pagamento.js"); ?></script>
<script><?= include_once("scripts/modais/formaspagamento/modal-editar-forma-pagamento.js"); ?></script>
<script><?= include_once("scripts/modais/formaspagamento/modal-excluir-forma-pagamento.js"); ?></script>
