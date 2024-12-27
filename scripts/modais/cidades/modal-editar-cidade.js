const modalEditarCidade = document.getElementById("modalEditarCidade");
const modalEditarCidadeContent = document.getElementById("conteudoEditarCidade");
const fecharEditarModaCidadelBtn = document.getElementById("fecharModalEditarCidade");

function abrirModalEditarCidade() {
    modalEditarCidade.classList.remove("hidden");
    modalEditarCidadeContent.classList.remove("hidden");
}

function fecharModalEditarCidade() {
    modalEditarCidade.classList.add("hidden");
    modalEditarCidadeContent.classList.add("hidden");
}

fecharEditarModaCidadelBtn.addEventListener("click", fecharModalEditarCidade);

modalEditarCidade.addEventListener("click", function (event) {
    if (event.target === modalEditarCidade) {
        fecharModalEditarCidade();
    }
});

window.addEventListener("keyup", (event) => {
    if (event.key === "Escape") {
        fecharModalEditarCidade();
    }
});

document.querySelectorAll(".editar-cidade").forEach(function (botao) {
    botao.addEventListener("click", function () {
        var idCidade = this.getAttribute("data-id");

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "api/cidades/obter-detalhes-cidade.php?idCidade=" + idCidade, true);
        xhr.onload = function () {
            if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);

                document.getElementById("cidadeEditar").value = data.CIDADE;
                document.getElementById("estado").value = data.IDESTADO;

                abrirModalEditarCidade();
                atualizarHiddenFieldCidadeEditar(data.IDCIDADE);
            } else {
                console.error("Erro ao obter os detalhes do cidade.");
            }
        };
        xhr.send();
    });
});

function atualizarHiddenFieldCidadeEditar(idCidade) {
    var input = document.getElementById("idCidadeEditar");

    input.value = idCidade;
}
