
const form = document.getElementById('form');
const campos =  document.querySelectorAll('.required');
const spans =  document.querySelectorAll('.span-required');
const emailRegex = /^\w+([-+']\w+)*@\w+([-.]\w+)*$/;
const textRegex = /^[a-zA-Z]+$/;
const BIRegex = /[^\W\d_]/ ;
const numberRegex =  /^\d+$/;
const tamanhoRegex = /^[a-zA-Z0-9_.-]*$/;

