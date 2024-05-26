<?php


function cadastrar ($dados)
{
    require("conecao.php");
    require("../C/cabe_sweetalert.php");

    if ($dados[4] == 'masculino'){
        $result = "../upload/d6d12205ef17853cac107d6a6e9d44f1.png";
    } else {
        $result = "../upload/273a2c818503ff1055019f31bf24b679.png";
    }
    
    #echo($result);
    #echo "<br>".$_SESSION["id_usuario"];
    $query ="INSERT INTO tb_usuario (fk_nivel,nome,sobrenome,data_nascimento,genero,telefone,telefone2,username,email,palavrapasse,foto) 
    VALUE('$dados[0]', '$dados[1]','$dados[2]','$dados[3]','$dados[4]','$dados[5]','$dados[6]',
   '$dados[7]','$dados[8]','$dados[9]', '$result')";
    $pdo->exec($query);

      //sweet alert
      echo "<script>
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Usuario Cadastrado com Sucesso',
          showConfirmButton: false,
          timer: 800
      })
      </script>";
#echo "<script> window.location.href='../V/registraratleta.php'</script>";


   //sweet alert
   echo "<script>
   Swal.fire({
       position: 'center',
       icon: 'success',
       title: 'Usuário Cadastrado com Sucesso',
       showConfirmButton: false,
       timer: 800
   })
</script>";
      //redirecionar
    echo "   
      <script>
      setTimeout(function(){
      window.location.href='../V/usuarios.php';
      }, 800);
      </script> 
      ";
}  

?>


