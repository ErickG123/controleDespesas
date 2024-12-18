const modalExcluirDespesa = document.getElementById("modalExcluirDespesa");
const modalExcluirDespesaContent = document.getElementById("conteudoExcluirDespesa");
const fecharModalExcluirDespesaBtn = document.getElementById("fecharModalExcluirDespesa");

function abrirModalExcluirDespesa() {
    modalExcluirDespesa.classList.remove("hidden");
    modalExcluirDespesaContent.classList.remove("hidden");
}

function fecharModalExcluirDespesa() {
    modalExcluirDespesa.classList.add("hidden");
    modalExcluirDespesaContent.classList.add("hidden");
}

fecharModalExcluirDespesaBtn.addEventListener("click", fecharModalExcluirDespesa);

modalExcluirDespesa.addEventListener("click", function (event) {
    if (event.target === modalExcluirDespesa) {
        fecharModalExcluirDespesa();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalExcluirDespesa();
    }
});

document.querySelectorAll(".excluir-despesa").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idDespesa = this.getAttribute("data-id");

        atualizarHiddenFieldDespesaExcluir(idDespesa);
    });
});

function atualizarHiddenFieldDespesaExcluir(idDespesa) {
    var input = document.getElementById("idDespesaExcluir");

    input.value = idDespesa;
}
