<?php
 require("../M/modelo_produto.php");
 $dados[0]= $_POST["descricao"];
 $dados[1]= $_POST["cor"];
 $dados[2]= $_POST["tamanho"];
 $dados[3]= $_POST["preco"];
 $dados[4]= $_POST["quantidade"];
 cadastrar ($dados);

 ?>

