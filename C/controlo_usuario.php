

<?php
 require("../M/modelo_usuario.php");
 $dados[0]= $_POST["nivel"];
 $dados[1]= $_POST["nome"];
 $dados[2]= $_POST["sobrenome"];
 $dados[3]= $_POST["data_nas"];
 $dados[4]= $_POST["genero"];
 $dados[5]= $_POST["telefone"];
 $dados[6]= $_POST["telefone2"];
 $dados[7]= $_POST["nome"];
 $dados[8]= $_POST["email"];
 $dados[9]= $_POST["senha"];
 cadastrar ($dados);
 ?>

