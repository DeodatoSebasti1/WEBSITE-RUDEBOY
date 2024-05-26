<?php
 //require("../M/modelo_pagamento.php");
 require("../M/conecao.php");
 require("cabe_sweetalert.php");
 
 $dados[0]= $_POST["preco"];
 $mes= $_POST["mes"];
 $_SESSION["id_mes"] = $mes;
 //cadastrar ($dados); 

 //cadastrar DADOS
 $query = "INSERT INTO tb_pagamento (fk_usuario, fk_atleta, fk_mes, valor) 
 VALUE ('$_SESSION[id_usuario]','$_SESSION[id_atle]', '$_SESSION[id_mes]','$dados[0]')";
 $pdo->exec($query);


      //sweet alert
      echo "<script>
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Pagamento Efectuado com Sucesso',
          showConfirmButton: false,
          timer: 800
      })
      </script>";
      #echo "<script> window.location.href='../V/registraratleta.php'</script>";

      //redirecionar
      echo "   
      <script>
      setTimeout(function(){
      window.location.href='../V/pagamentos.php';
      }, 800);
      </script> ";
 
 ?>

