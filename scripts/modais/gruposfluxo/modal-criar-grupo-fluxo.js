const modalCriarGrupoFluxo = document.getElementById("modalCriarGrupoFluxo");
const modalCriarGrupoFluxoContent = document.getElementById("conteudoAbrirGrupoFluxo");
const fecharModalCriarGrupoFluxoBtn = document.getElementById("fecharModalCriarGrupoFluxo");

function abrirModalCriarGrupoFluxo() {
    modalCriarGrupoFluxo.classList.remove("hidden");
    modalCriarGrupoFluxoContent.classList.remove("hidden");
}

function fecharModalCriarGrupoFluxo() {
    modalCriarGrupoFluxo.classList.add("hidden");
    modalCriarGrupoFluxoContent.classList.add("hidden");
}

fecharModalCriarGrupoFluxoBtn.addEventListener("click", fecharModalCriarGrupoFluxo);

modalCriarGrupoFluxo.addEventListener("click", function (event) {
    if (event.target === modalCriarGrupoFluxo) {
        fecharModalCriarGrupoFluxo();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalCriarGrupoFluxo();
    }
});
