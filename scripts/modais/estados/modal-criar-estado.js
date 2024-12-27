const modalCriarEstado = document.getElementById("modalCriarEstado");
const modalCriarEstadoContent = document.getElementById("conteudoAbrirEstado");
const fecharModalCriarEstadoBtn = document.getElementById("fecharModalCriarEstado");

function abrirModalCriarEstado() {
    modalCriarEstado.classList.remove("hidden");
    modalCriarEstadoContent.classList.remove("hidden");
}

function fecharModalCriarEstado() {
    modalCriarEstado.classList.add("hidden");
    modalCriarEstadoContent.classList.add("hidden");
}

fecharModalCriarEstadoBtn.addEventListener("click", fecharModalCriarEstado);

modalCriarEstado.addEventListener("click", function (event) {
    if (event.target === modalCriarEstado) {
        fecharModalCriarEstado();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalCriarEstado();
    }
});
