const modalExcluirFormaPagamento = document.getElementById("modalExcluirFormaPagamento");
const modalExcluirFormaPagamentoContent = document.getElementById("conteudoExcluirFormaPagamento");
const fecharModalExcluirFormaPagamentoBtn = document.getElementById("fecharModalExcluirFormaPagamento");

function abrirModalExcluirFormaPagamento() {
    modalExcluirFormaPagamento.classList.remove("hidden");
    modalExcluirFormaPagamentoContent.classList.remove("hidden");
}

function fecharModalExcluirFormaPagamento() {
    modalExcluirFormaPagamento.classList.add("hidden");
    modalExcluirFormaPagamentoContent.classList.add("hidden");
}

fecharModalExcluirFormaPagamentoBtn.addEventListener("click", fecharModalExcluirFormaPagamento);

modalExcluirFormaPagamento.addEventListener("click", function (event) {
    if (event.target === modalExcluirFormaPagamento) {
        fecharModalExcluirFormaPagamento();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalExcluirFormaPagamento();
    }
});

document.querySelectorAll(".excluir-forma-pagamento").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idFormaPagamento = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/formaspagamento/obter-detalhes-forma-pagamento.php?idFormaPagamento=" + idFormaPagamento, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                atualizarHiddenFieldFormaPagamentoExcluir(data.IDFORMAPAGAMENTO);
            } else {
                console.error("Erro ao obter os detalhes da forma de pagamento.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldFormaPagamentoExcluir(idFormaPagamento) {
    var input = document.getElementById("idFormaPagamentoExcluir");

    input.value = idFormaPagamento;
}
