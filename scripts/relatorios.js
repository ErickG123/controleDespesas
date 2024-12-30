function imprimirRelatorio() {
    window.print();
}

async function salvarPDF() {
    var botoes = document.getElementsByTagName("button");
    Array.from(botoes).forEach(botao => {
        botao.style.display = "none";
    });

    const { jsPDF } = window.jspdf;

    const content = document.getElementsByClassName("conteudo")[0];

    const canvas = await html2canvas(content);
    const imgData = canvas.toDataURL("image/png");

    const pdf = new jsPDF("l", "mm", "a4");
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

    pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);

    pdf.save("relatorio.pdf");

    var botoes = document.getElementsByTagName("button");
    Array.from(botoes).forEach(botao => {
        botao.style.display = "block";
    });
}
