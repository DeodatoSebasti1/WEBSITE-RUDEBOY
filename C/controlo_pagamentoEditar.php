<?php
 //require("../M/modelo_pagamento.php");
 require("../M/conecao.php");
 require("cabe_sweetalert.php");
 
 $dados[0]= $_POST["preco"];
 $mes= $_POST["mes"];
 $user = $_SESSION["id_usuario"];
 $id_pagamento = $_SESSION["id_pagamento"];
$fk_atleta = $_SESSION['fk_atleta'];


 $query =" UPDATE tb_pagamento SET id_pagamento ='$id_pagamento', fk_usuario='$user',fk_atleta='$fk_atleta', fk_mes='$mes', valor='$dados[0]' WHERE id_pagamento = $id_pagamento";
 $pdo->exec($query);
 #var_dump($query);

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
                window.location.href='../V/pagamentos.php';
            }, 800);
</script> ";
 ?>

