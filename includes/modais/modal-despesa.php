<div id="modalExcluirDespesa" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalExcluirDespesaContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalExcluirDespesa" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoExcluirDespesa" class="hidden mt-2">
            <form action="api/despesas/excluir-despesa.php" method="post">
                <p class="font-semibold text-xl mb-2">Você tem certeza que deseja excluir a despesa?</p>

                <input type="hidden" name="idDespesa" id="idDespesaExcluir">

                <div class="flex flex-col">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mb-2" type="submit">Confirmar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalExcluirDespesa();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script><?= include_once("scripts/modais/despesas/modal-excluir-despesa.js"); ?></script>
