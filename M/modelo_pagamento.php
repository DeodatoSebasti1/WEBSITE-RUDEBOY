<?php
   
    

function cadastrar ($dados)
{
    require("conecao.php");
    require("../C/cabe_sweetalert.php");

   // var_dump($dados);
    //echo $mes;
    $_SESSION["id_usuario"];
    $_SESSION["id_mes"];

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

}  

?>


