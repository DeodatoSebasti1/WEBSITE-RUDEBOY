<?php



 function cadastrar ($dados)
{
  require("../M/conecao.php");
require("cabe_sweetalert.php");

 $id_atleta = $_SESSION['id_atleta'];

  $query =" UPDATE tb_atleta SET id_atleta ='$id_atleta', fk_usuario='$_SESSION[id_usuario]',nome_atleta='$dados[0]',sobrenome='$dados[1]', data_nascimento='$dados[3]', bi='$dados[2]', genero='$dados[4]',telefone='$dados[5]',telefone2='$dados[6]',turno=' $dados[7]' WHERE id_atleta = $id_atleta";
    $pdo->exec($query);
  
  //sweet alert
  echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Alterado com Sucesso',
                    showConfirmButton: false,
                    timer: 800
                })
  </script>";
 #echo "<script> window.location.href='../V/registraratleta.php'</script>";

 //redirecionar
 echo "   
 <script>
            setTimeout(function(){
                window.location.href='../V/registraratleta.php';
            }, 800);
</script> 
";
}
 ?>
