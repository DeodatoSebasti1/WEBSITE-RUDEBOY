<?php
 require("../M/conecao.php");
 require("cabe_sweetalert.php");

$id_produto = $_SESSION['prod'];
 $quantidade_post =  $_POST['quantidade'];

 $query =" INSERT INTO tb_stcok_entrada(fk_produto, quantidade_entrada) VALUES ('$id_produto','$quantidade_post')";
 $pdo->exec($query);

 $query =" UPDATE tb_produto SET  quantidade_ext=quantidade_ext+'$quantidade_post' WHERE id_produto = $id_produto";
 $pdo->exec($query);


     //sweet alert
     echo "<script>
     Swal.fire({
         position: 'center',
         icon: 'success',
         title: 'Adicionado ao Stock com sucesso',
         showConfirmButton: false,
         timer: 850
     })
</script>";      

  //redirecionar
     echo "   
     <script>
                 setTimeout(function(){
                     window.location.href='../V/stock.php';
                 }, 850);
     </script> 
";
 ?>

