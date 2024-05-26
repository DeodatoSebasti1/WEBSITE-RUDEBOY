<?php
 require("../M/conecao.php");
 require("cabe_sweetalert.php");


 $dados[0]= $_POST["nivel"];
 $nome= $_POST["nome_user"];
 $sobrenome= $_POST["sobrenome"]; 
 $dados[1]= $_POST["data_nas"];
 $dados[2]= $_POST["genero"];
 $dados[3]= $_POST["telefone"];
 $dados[4]= $_POST["telefone2"];
 $dados[5]= $_POST["email"];
 $dados[6]= $_POST["senha"];

 $id_user = $_SESSION['cod_user'];

 #var_dump($id_user);


 $query =" UPDATE tb_usuario SET id_usuario ='$id_user', fk_nivel='$dados[0]', nome='$nome', sobrenome='$sobrenome', data_nascimento='$dados[1]', genero='$dados[2]', telefone='$dados[3]', telefone2='$dados[4]', username='$nome', email='$dados[5]', palavrapasse='$dados[6]' WHERE id_usuario = $id_user";
 $pdo->exec($query);

   //sweet alert
   echo "<script>
   Swal.fire({
       position: 'center',
       icon: 'success',
       title: 'Usuário Editado com Sucesso',
       showConfirmButton: false,
       timer: 800
   })
</script>";
#echo "<script> window.location.href='../V/registraratleta.php'</script>";

//redirecionar
echo "   
<script>
setTimeout(function(){
   window.location.href='../V/usuarios.php';
}, 800);
</script> ";

 ?>

