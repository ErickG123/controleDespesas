var inputsDocumento = document.getElementsByClassName("input-documento");
var inputsIE = document.getElementsByClassName("input-ie");
var inputsTelefone = document.getElementsByClassName("input-telefone");
var inputsCEP = document.getElementsByClassName("input-cep");

if (inputsDocumento) {
    Array.from(inputsDocumento).forEach(inputDocumento => {
        inputDocumento.addEventListener("input", () => {
            let valor = inputDocumento.value;
            var documento = valor.replace(/\D/g, "");

            if (documento.length === 11) {
                inputDocumento.value = documento.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
            } else if (documento.length === 14) {
                inputDocumento.value = documento.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
            }
        });
    })
}

if (inputsIE) {
    Array.from(inputsIE).forEach(inputIE => {
        inputIE.addEventListener("input", () => {
            let valor = inputIE.value;
            var ie = valor.replace(/\D/g, "");

            if (ie.length <= 12) {
                inputIE.value = ie.replace(/(\d{3})(\d{3})(\d{3})(\d{3}?)/, "$1.$2.$3.$4").replace(/\.$/, "");
            } else {
                inputIE.value = ie.substring(0, 12).replace(/(\d{3})(\d{3})(\d{3})(\d{3}?)/, "$1.$2.$3.$4").replace(/\.$/, "");
            }
        });
    });
}

if (inputsTelefone) {
    Array.from(inputsTelefone).forEach(inputTelefone => {
        inputTelefone.addEventListener("input", () => {
            let valor = inputTelefone.value;
            var telefone = valor.replace(/\D/g, "");

            if (telefone.length <= 10) {
                inputTelefone.value = telefone.replace(/(\d{2})(\d{4})(\d{0,4})/, "($1) $2-$3");
            } else {
                inputTelefone.value = telefone.replace(/(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3");
            }
        });
    })
}

if (inputsCEP) {
    Array.from(inputsCEP).forEach(inputCEP => {
        inputCEP.addEventListener("input", () => {
            let valor = inputCEP.value;
            var cep = valor.replace(/\D/g, "");

            if (cep.length <= 8) {
                inputCEP.value = cep.replace(/(\d{5})(\d{3})?/, "$1-$2").replace(/-$/, "");
            } else {
                inputCEP.value = cep.substring(0, 8).replace(/(\d{5})(\d{3})/, "$1-$2");
            }
        });
    });
}
