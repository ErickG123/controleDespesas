const modalEditarGrupoFluxo = document.getElementById("modalEditarGrupoFluxo");
const modalEditarGrupoFluxoContent = document.getElementById("conteudoEditarGrupoFluxo");
const fecharEditarModaGrupoFluxolBtn = document.getElementById("fecharModalEditarGrupoFluxo");

function abrirModalEditarGrupoFluxo() {
    modalEditarGrupoFluxo.classList.remove("hidden");
    modalEditarGrupoFluxoContent.classList.remove("hidden");
}

function fecharModalEditarGrupoFluxo() {
    modalEditarGrupoFluxo.classList.add("hidden");
    modalEditarGrupoFluxoContent.classList.add("hidden");
}

fecharEditarModaGrupoFluxolBtn.addEventListener("click", fecharModalEditarGrupoFluxo);

modalEditarGrupoFluxo.addEventListener("click", function (event) {
    if (event.target === modalEditarGrupoFluxo) {
        fecharModalEditarGrupoFluxo();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalEditarGrupoFluxo();
    }
});

document.querySelectorAll(".editar-grupo-fluxo").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idGrupoFluxo = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/gruposfluxo/obter-detalhes-grupo-fluxo.php?idGrupoFluxo=" + idGrupoFluxo, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                document.getElementById("grupoFluxoEditar").value = data.GRUPOFLUXO;

                abrirModalEditarGrupoFluxo();
                atualizarHiddenFieldGrupoFluxoEditar(data.IDGRUPOFLUXO);
            } else {
                console.error("Erro ao obter os detalhes do grupo de fluxo.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldGrupoFluxoEditar(idGrupoFluxo) {
    var input = document.getElementById("idGrupoFluxoEditar");

    input.value = idGrupoFluxo;
}
