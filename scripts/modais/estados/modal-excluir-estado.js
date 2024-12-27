const modalExcluirEstado = document.getElementById("modalExcluirEstado");
const modalExcluirEstadoContent = document.getElementById("conteudoExcluirEstado");
const fecharModalExcluirEstadoBtn = document.getElementById("fecharModalExcluirEstado");

function abrirModalExcluirEstado() {
    modalExcluirEstado.classList.remove("hidden");
    modalExcluirEstadoContent.classList.remove("hidden");
}

function fecharModalExcluirEstado() {
    modalExcluirEstado.classList.add("hidden");
    modalExcluirEstadoContent.classList.add("hidden");
}

fecharModalExcluirEstadoBtn.addEventListener("click", fecharModalExcluirEstado);

modalExcluirEstado.addEventListener("click", function (event) {
    if (event.target === modalExcluirEstado) {
        fecharModalExcluirEstado();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalExcluirEstado();
    }
});

document.querySelectorAll(".excluir-estado").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idEstado = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/estados/obter-detalhes-estado.php?idEstado=" + idEstado, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                atualizarHiddenFieldEstadoExcluir(data.IDESTADO);
            } else {
                console.error("Erro ao obter os detalhes do estado.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldEstadoExcluir(idEstado) {
    var input = document.getElementById("idEstadoExcluir");

    input.value = idEstado;
}
