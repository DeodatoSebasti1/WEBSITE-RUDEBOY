<?php
 function cadastrar ($dados)
 {
   require("../M/conecao.php");
 require("cabe_sweetalert.php");


 $id_produto = $_SESSION['id_produto'];
 $query =" UPDATE tb_produto SET id_produto ='$id_produto', fk_usuario='$_SESSION[id_usuario]',descricao='$dados[0]',cor='$dados[1]', tamanho='$dados[2]', preco='$dados[3]', quantidade_ext='$dados[4]' WHERE id_produto = $id_produto";
 $pdo->exec($query);

   //sweet alert
   echo "<script>
   Swal.fire({
       position: 'center',
       icon: 'success',
       title: 'Produto Alterado com Sucesso',
       showConfirmButton: false,
       timer: 800
   })
</script>";
#echo "<script> window.location.href='../V/registraratleta.php'</script>";

//redirecionar
echo "   
<script>
setTimeout(function(){
   window.location.href='../V/produtos.php';
}, 800);
</script> ";
}
?>

