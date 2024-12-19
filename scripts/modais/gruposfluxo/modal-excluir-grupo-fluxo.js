const modalExcluirGrupoFluxo = document.getElementById("modalExcluirGrupoFluxo");
const modalExcluirGrupoFluxoContent = document.getElementById("conteudoExcluirGrupoFluxo");
const fecharModalExcluirGrupoFluxoBtn = document.getElementById("fecharModalExcluirGrupoFluxo");

function abrirModalExcluirGrupoFluxo() {
    modalExcluirGrupoFluxo.classList.remove("hidden");
    modalExcluirGrupoFluxoContent.classList.remove("hidden");
}

function fecharModalExcluirGrupoFluxo() {
    modalExcluirGrupoFluxo.classList.add("hidden");
    modalExcluirGrupoFluxoContent.classList.add("hidden");
}

fecharModalExcluirGrupoFluxoBtn.addEventListener("click", fecharModalExcluirGrupoFluxo);

modalExcluirGrupoFluxo.addEventListener("click", function (event) {
    if (event.target === modalExcluirGrupoFluxo) {
        fecharModalExcluirGrupoFluxo();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalExcluirGrupoFluxo();
    }
});

document.querySelectorAll(".excluir-grupo-fluxo").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idGrupoFluxo = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/gruposfluxo/obter-detalhes-grupo-fluxo.php?idGrupoFluxo=" + idGrupoFluxo, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                atualizarHiddenFieldGrupoFluxoExcluir(data.IDGRUPOFLUXO);
            } else {
                console.error("Erro ao obter os detalhes do grupo de fluxo.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldGrupoFluxoExcluir(idGrupoFluxo) {
    var input = document.getElementById("idGrupoFluxoExcluir");

    input.value = idGrupoFluxo;
}
