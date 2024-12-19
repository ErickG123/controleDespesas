const modalCriarFormaPagamento = document.getElementById("modalCriarFormaPagamento");
const modalCriarFormaPagamentoContent = document.getElementById("conteudoAbrirFormaPagamento");
const fecharModalCriarFormaPagamentoBtn = document.getElementById("fecharModalCriarFormaPagamento");

function abrirModalCriarFormaPagamento() {
    modalCriarFormaPagamento.classList.remove("hidden");
    modalCriarFormaPagamentoContent.classList.remove("hidden");
}

function fecharModalCriarFormaPagamento() {
    modalCriarFormaPagamento.classList.add("hidden");
    modalCriarFormaPagamentoContent.classList.add("hidden");
}

fecharModalCriarFormaPagamentoBtn.addEventListener("click", fecharModalCriarFormaPagamento);

modalCriarFormaPagamento.addEventListener("click", function (event) {
    if (event.target === modalCriarFormaPagamento) {
        fecharModalCriarFormaPagamento();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalCriarFormaPagamento();
    }
});
