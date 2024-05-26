<?php


function cadastrar ($dados)
{
    require("conecao.php");
    require("../C/cabe_sweetalert.php");

   # echo "<br>".$_SESSION["id_usuario"];
    $query ="INSERT INTO tb_produto (fk_usuario,descricao,cor,tamanho,preco,quantidade_ext) 
    VALUE('$_SESSION[id_usuario]','$dados[0]', '$dados[1]','$dados[2]','$dados[3]','$dados[4]')";
    $pdo->exec($query);
      //sweet alert
      echo "<script>
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Produto Cadastrado com Sucesso',
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
      </script> 
      ";
}  

?>


