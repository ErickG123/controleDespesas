const modalEditarFormaPagamento = document.getElementById("modalEditarFormaPagamento");
const modalEditarFormaPagamentoContent = document.getElementById("conteudoEditarFormaPagamento");
const fecharEditarModaFormaPagamentolBtn = document.getElementById("fecharModalEditarFormaPagamento");

function abrirModalEditarFormaPagamento() {
    modalEditarFormaPagamento.classList.remove("hidden");
    modalEditarFormaPagamentoContent.classList.remove("hidden");
}

function fecharModalEditarFormaPagamento() {
    modalEditarFormaPagamento.classList.add("hidden");
    modalEditarFormaPagamentoContent.classList.add("hidden");
}

fecharEditarModaFormaPagamentolBtn.addEventListener("click", fecharModalEditarFormaPagamento);

modalEditarFormaPagamento.addEventListener("click", function (event) {
    if (event.target === modalEditarFormaPagamento) {
        fecharModalEditarFormaPagamento();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalEditarFormaPagamento();
    }
});

document.querySelectorAll(".editar-forma-pagamento").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idFormaPagamento = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/formaspagamento/obter-detalhes-forma-pagamento.php?idFormaPagamento=" + idFormaPagamento, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                document.getElementById("formaPagamentoEditar").value = data.FORMAPAGAMENTO;

                abrirModalEditarFormaPagamento();
                atualizarHiddenFieldFormaPagamentoEditar(data.IDFORMAPAGAMENTO);
            } else {
                console.error("Erro ao obter os detalhes da forma de pagamento.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldFormaPagamentoEditar(idFormaPagamento) {
    var input = document.getElementById("idFormaPagamentoEditar");

    input.value = idFormaPagamento;
}
