const modalCriarCidade = document.getElementById("modalCriarCidade");
const modalCriarCidadeContent = document.getElementById("conteudoAbrirCidade");
const fecharModalCriarCidadeBtn = document.getElementById("fecharModalCriarCidade");

function abrirModalCriarCidade() {
    modalCriarCidade.classList.remove("hidden");
    modalCriarCidadeContent.classList.remove("hidden");
}

function fecharModalCriarCidade() {
    modalCriarCidade.classList.add("hidden");
    modalCriarCidadeContent.classList.add("hidden");
}

fecharModalCriarCidadeBtn.addEventListener("click", fecharModalCriarCidade);

modalCriarCidade.addEventListener("click", function (event) {
    if (event.target === modalCriarCidade) {
        fecharModalCriarCidade();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalCriarCidade();
    }
});
