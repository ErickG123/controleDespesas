const modalEditarEstado = document.getElementById("modalEditarEstado");
const modalEditarEstadoContent = document.getElementById("conteudoEditarEstado");
const fecharEditarModaEstadolBtn = document.getElementById("fecharModalEditarEstado");

function abrirModalEditarEstado() {
    modalEditarEstado.classList.remove("hidden");
    modalEditarEstadoContent.classList.remove("hidden");
}

function fecharModalEditarEstado() {
    modalEditarEstado.classList.add("hidden");
    modalEditarEstadoContent.classList.add("hidden");
}

fecharEditarModaEstadolBtn.addEventListener("click", fecharModalEditarEstado);

modalEditarEstado.addEventListener("click", function (event) {
    if (event.target === modalEditarEstado) {
        fecharModalEditarEstado();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalEditarEstado();
    }
});

document.querySelectorAll(".editar-estado").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idEstado = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/estados/obter-detalhes-estado.php?idEstado=" + idEstado, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                document.getElementById("estadoEditar").value = data.ESTADO;
                document.getElementById("siglaEditar").value = data.SIGLA;

                abrirModalEditarEstado();
                atualizarHiddenFieldEstadoEditar(data.IDESTADO);
            } else {
                console.error("Erro ao obter os detalhes do estado.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldEstadoEditar(idEstado) {
    var input = document.getElementById("idEstadoEditar");

    input.value = idEstado;
}
