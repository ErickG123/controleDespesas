const modalExcluirPessoa = document.getElementById("modalExcluirPessoa");
const modalExcluirPessoaContent = document.getElementById("conteudoExcluirPessoa");
const fecharModalExcluirPessoaBtn = document.getElementById("fecharModalExcluirPessoa");

function abrirModalExcluirPessoa() {
    modalExcluirPessoa.classList.remove("hidden");
    modalExcluirPessoaContent.classList.remove("hidden");
}

function fecharModalExcluirPessoa() {
    modalExcluirPessoa.classList.add("hidden");
    modalExcluirPessoaContent.classList.add("hidden");
}

fecharModalExcluirPessoaBtn.addEventListener("click", fecharModalExcluirPessoa);

modalExcluirPessoa.addEventListener("click", function (event) {
    if (event.target === modalExcluirPessoa) {
        fecharModalExcluirPessoa();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalExcluirPessoa();
    }
});

document.querySelectorAll(".excluir-pessoa").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idPessoa = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/pessoas/obter-detalhes-pessoa.php?idPessoa=" + idPessoa, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                atualizarHiddenFieldPessoaExcluir(data.IDPESSOA);
            } else {
                console.error("Erro ao obter os detalhes do cedente.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldPessoaExcluir(idPessoa) {
    var input = document.getElementById("idPessoaExcluir");

    input.value = idPessoa;
}
