<?php
 require("../M/conecao.php");
 require("cabe_sweetalert.php");

    //reficara se o Id existe
    if (!empty($_GET['id'])) { 
        $id_at= $_GET['id'];
        $query = $pdo->prepare("SELECT * FROM tb_atleta where id_atleta=$id_at");
        $query->execute();
        $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 

        //query para eliminar
        $query = "DELETE FROM tb_atleta WHERE `tb_atleta`.`id_atleta`=$id_at";
        $pdo->exec($query);

    //sweet alert
    echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Atleta Eliminado com Sucesso',
                showConfirmButton: false,
                timer: 850
            })
</script>";      

         //redirecionar
            echo "   
            <script>
                        setTimeout(function(){
                            window.location.href='../V/registraratleta.php';
                        }, 850);
            </script> 
";
       
        } 
?>