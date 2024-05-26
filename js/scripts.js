const btnGenerate = document.querySelector("#gerar_pdf");

btnGenerate.addEventListener("click", ()=> {

    //conteudo pdf
    const content = document.querySelector("#content");

    //configuração
    const options = {   
        html2canvas: {scale: 2},
        filename: "fatura.pdf",
        jsPDF: {unit: "mm", format:"a4", orientation: "portrait"},

    };

    //gerar pdf
    html2pdf().set(options).from(content).save();
})