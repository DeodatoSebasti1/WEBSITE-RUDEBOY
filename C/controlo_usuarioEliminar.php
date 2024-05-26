<?php
 require("../M/conecao.php");
  require("cabe_sweetalert.php");
    //reficara se o Id existe
    if (!empty($_GET['id'])) { 
        $id_usuario= $_GET['id'];
        $query = $pdo->prepare("SELECT * FROM tb_usuario where id_usuario=$id_usuario");
        $query->execute();
        $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 

        //query para eliminar
        $query = "DELETE FROM tb_usuario WHERE `tb_usuario`.`id_usuario`=$id_usuario";
        $pdo->exec($query);

    //sweet alert
    echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Usuário Eliminado com Sucesso',
                showConfirmButton: false,
                timer: 850
            })
</script>";      

         //redirecionar
            echo "   
            <script>
                        setTimeout(function(){
                            window.location.href='../V/usuarios.php';
                        }, 850);
            </script> 
";
        
        } 

?>