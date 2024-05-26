//_________________________________________FUNÇÕES PARA MNOSTARA E REMOVER ERROS__________________________________
//função de erros
//mostrar
function setError(index) {
    campos[index].style.border= '2px solid red';
    spans[index].style.display= 'block';
    //spans[index].textContent= 'Digite Apenas Letras';
}
//retirar
function removeError(index) {
    campos[index].style.border= '2px solid rgb(0, 205, 7)';
    spans[index].style.display= 'none';
}
//____________________CONST FORMULARIOS__________________________
//const form = document.getElementById('form');

//_________________________________________VALIDAR LOGIN__________________________________
///^[a-z]+$/i;
const form = document.getElementById('form');
const campos =  document.querySelectorAll('.required');
const spans =  document.querySelectorAll('.span-required');
const emailRegex = /^\w+([-+']\w+)*@\w+([-.]\w+)*$/;
const textRegex = /^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/ ;
//const BIRegex = /[^\W\d_]/;
const BIRegex = /\d{9}[A-Z]{2}\d{3}/;
const numberRegex =  /^\d+$/;
const tamanhoRegex = /^[a-zA-Z0-9_.-]*$/;


    //usuario_login
    function validarusuario() {
        if((!textRegex.test(campos[0].value)) && (!emailRegex.test(campos[0].value))){
                setError(0); 
        }
        else{
            removeError(0); 
        } 
    }
    //senha_login
    function validarsenha() {
        if(campos[1].value.length < 4){
            setError(1); 
            spans[index].style.display= 'none';
        }
        else{
            removeError(1); 
        }
    }
//_________________________________________VALIDAR CAmpos__________________________________

    //NOME
    function validarNome() {
        if(!textRegex.test(campos[0].value)){
                setError(0); 
        }
        else{
            removeError(0); 
        } 
    }
    //SOBRENOME
    function validarSobrenome() {
        if(!textRegex.test(campos[1].value)){
            setError(1); 
        }
        else{
            removeError(1); 
        } 
    }
    //BI 
    function validarBI() {
        if(!BIRegex.test(campos[2].value)){
                setError(2); 
        }
        else{
            removeError(2); 
        } 
    }
    //numero
    function validarNumero() {
        if(!numberRegex.test(campos[3].value)){
                setError(3); 
        }
        else{
            removeError(3); 
        } 
    }
    //numero2
    function validarNumero2() {
        if(!numberRegex.test(campos[4].value)){
                setError(4); 
        }
        else{
            removeError(4); 
        } 
    }

//_________________________________________VALIDAR FORMULARIOS__________________________________
