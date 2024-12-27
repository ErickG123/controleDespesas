const modalExcluirCidade = document.getElementById("modalExcluirCidade");
const modalExcluirCidadeContent = document.getElementById("conteudoExcluirCidade");
const fecharModalExcluirCidadeBtn = document.getElementById("fecharModalExcluirCidade");

function abrirModalExcluirCidade() {
    modalExcluirCidade.classList.remove("hidden");
    modalExcluirCidadeContent.classList.remove("hidden");
}

function fecharModalExcluirCidade() {
    modalExcluirCidade.classList.add("hidden");
    modalExcluirCidadeContent.classList.add("hidden");
}

fecharModalExcluirCidadeBtn.addEventListener("click", fecharModalExcluirCidade);

modalExcluirCidade.addEventListener("click", function (event) {
    if (event.target === modalExcluirCidade) {
        fecharModalExcluirCidade();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalExcluirCidade();
    }
});

document.querySelectorAll(".excluir-cidade").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idCidade = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/cidades/obter-detalhes-cidade.php?idCidade=" + idCidade, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                atualizarHiddenFieldCidadeExcluir(data.IDCIDADE);
            } else {
                console.error("Erro ao obter os detalhes da cidade.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldCidadeExcluir(idCidade) {
    var input = document.getElementById("idCidadeExcluir");

    input.value = idCidade;
}
