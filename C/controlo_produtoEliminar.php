<?php
 require("../M/conecao.php");
 require("cabe_sweetalert.php");

        //reficara se o Id existe
        if (!empty($_GET['id'])) { 
            $id_prod= $_GET['id'];
            $query = $pdo->prepare("SELECT * FROM tb_produto where id_produto=$id_prod");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 

     //query para eliminar
        $query = "DELETE FROM tb_produto WHERE `tb_produto`.`id_produto`=$id_prod";
        $pdo->exec($query);

    //sweet alert
    echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Produto Eliminado com Sucesso',
                showConfirmButton: false,
                timer: 850
            })
</script>";      

         //redirecionar
            echo "   
            <script>
                        setTimeout(function(){
                            window.location.href='../V/produtos.php';
                        }, 850);
            </script> 
";
        } 

        
 ?>

