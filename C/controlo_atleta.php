<?php
 require("../M/modelo_atleta.php");

    $dados[0]= $_POST["nome"];
    $dados[1]= $_POST["sobrenome"];
    $dados[2]= $_POST["bi"];
    $dados[3]= $_POST["data_nas"];
    $dados[4]= $_POST["genero"];
    $dados[5]= $_POST["telefone"];
    $dados[6]= $_POST["telefone2"];
    $dados[7]= $_POST["turno"];
 cadastrar ($dados);

 ?>

