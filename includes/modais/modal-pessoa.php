<div id="modalExcluirPessoa" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-40 z-20">
    <div id="modalExcluirPessoaContent" class="w-11/12 md:w-1/3 h-auto p-6 rounded-md bg-white">
        <img id="fecharModalExcluirPessoa" class="w-4 h-4 cursor-pointer mb-2 outline-none" src="images/close.svg" alt="Ícone Fechar">
        <div id="conteudoExcluirPessoa" class="hidden mt-2">
            <form action="api/pessoas/excluir-pessoa.php" method="post">
                <p class="font-semibold text-xl mb-2">Você tem certeza que deseja excluir a pessoa?</p>

                <input type="hidden" name="idPessoa" id="idPessoaExcluir">

                <div class="flex flex-col">
                    <button class="w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-semibold p-2.5 rounded-md outline-none mb-2" type="submit">Confirmar</button>
                    <button class="w-full bg-red-600 hover:bg-red-500 text-white text-center font-semibold p-2.5 rounded-md outline-none" type="button" onclick="fecharModalExcluirPessoa();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script><?= include_once("scripts/modais/pessoas/modal-excluir-pessoa.js"); ?></script>
