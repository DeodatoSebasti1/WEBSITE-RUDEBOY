<?php
 require("../M/conecao.php");
 require("cabe_sweetalert.php");

    //reficara se o Id existe
    if (!empty($_GET['id'])) { 
        $id_pag= $_GET['id'];
        $query = $pdo->prepare("SELECT * FROM tb_pagamento where id_pagamento=$id_pag");
        $query->execute();
        $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 

        //query para eliminar
        $query = "DELETE FROM tb_pagamento WHERE `tb_pagamento`.`id_pagamento`=$id_pag";
        $pdo->exec($query);

       
    //sweet alert
    echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Pagamento Eliminado com Sucesso',
                showConfirmButton: false,
                timer: 850
            })
</script>";      

         //redirecionar
            echo "   
            <script>
                        setTimeout(function(){
                            window.location.href='../V/pagamentos.php';
                        }, 850);
            </script> 
";
        } 

?>