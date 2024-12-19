function toggleOptions(nomeInput) {
    var options = document.getElementById("options" + nomeInput);
    options.classList.toggle("hidden");
}

function updateSelectedText(selectedText, nomeInput) {
    var checkboxes = document.querySelectorAll(`input[name="${nomeInput}[]"]:checked`);
    var values = Array.from(checkboxes).map(function (checkbox) {
        return checkbox.nextElementSibling.textContent;
    });

    var selectedText = document.getElementById("selectedText" + selectedText);
    selectedText.textContent = values.length > 0 ? values.join(", ") : "Opções";
    selectedText.classList.toggle("truncate", values.length > 0);
}

function filterOptions(nomeInput) {
    var input = document.getElementById("searchInput" + nomeInput);
    var filter = input.value.toUpperCase();
    var options = document.getElementById("options" + nomeInput);
    var labels = options.getElementsByTagName("label");

    for (var i = 0; i < labels.length; i++) {
        var labelInnerText = labels[i].innerText || labels[i].textContent;
        labels[i].style.display = labelInnerText.toUpperCase().indexOf(filter) > -1 ? "" : "none";
    }
}

function updateSelect(nomeInput) {
    let input = document.getElementById("id" + nomeInput);

    if (input) {
        let selectedId = input.value;

        let radio = document.getElementById("opcao" + nomeInput + selectedId);

        if (radio) {
            radio.checked = true;

            let selectedTextElement = document.getElementById("selectedText" + nomeInput);
            let labelText = radio.nextElementSibling.textContent;

            selectedTextElement.textContent = labelText || "Opções";
        }
    }
}

function clearFilter() {
    uncheckRadios("Pessoas", "opcoesPessoas");
    uncheckRadios("GruposFluxo", "opcoesGruposFluxo");
    uncheckRadios("FormasPagamento", "opcoesFormasPagamento");

    limparDatas();
}

function uncheckRadios(selectedText, nomeInput) {
    var checkboxes = document.querySelectorAll(`input[name="${nomeInput}[]"]`);

    checkboxes.forEach(function (checkbox) {
        checkbox.checked = false;
    });

    updateSelectedText(selectedText, nomeInput);
    clearHiddenInput(selectedText);
}

function limparDatas() {
    document.getElementById("dataCompraInicial").value = "";
    document.getElementById("dataCompraFinal").value = "";
    document.getElementById("dataVencimentoInicial").value = "";
    document.getElementById("dataVencimentoFinal").value = "";
}

function clearHiddenInput(nomeInput) {
    var hiddenInput = document.getElementById(`id${nomeInput}`);

    hiddenInput.value = "";
}

document.addEventListener("click", function (event) {
    var dropdowns = document.querySelectorAll("[id^='dropdown']");
    dropdowns.forEach(function (dropdown) {
        var options = dropdown.querySelector("[id^='options']");
        if (options && !dropdown.contains(event.target)) {
            options.classList.add("hidden");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    updateSelect("Pessoas");
    updateSelect("GruposFluxo");
    updateSelect("FormasPagamento");
});
