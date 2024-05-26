<?php
     require("../M/conecao.php");
     require("cabe_sweetalert.php");
     $id = $_SESSION["id_usuario"];
    $senha_nova = $_POST["senha_nova"];

    $query = $pdo->prepare("SELECT * FROM tb_usuario WHERE id_usuario = $id");
    $query->execute();
    $senha = $query-> fetchAll(); 

    for ($i=0; $i < sizeof($senha) ; $i++) { 
        $senhaActual = $senha[$i];
    }
     
   if (($_POST['senha_antiga']) == ($senhaActual["palavrapasse"])) {
    
    $query =" UPDATE tb_usuario SET id_usuario ='$id', palavrapasse='$senha_nova' WHERE id_usuario = $id";
    $pdo->exec($query);

    //sweet alert

    echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Senha Alterada com Sucesso',
                showConfirmButton: false,
                timer: 850
            })
        </script>";      

         //redirecionar

            echo "   
            <script>
                        setTimeout(function(){
                            window.location.href='../V/paineladmin.php';
                        }, 850);
            </script>";   
    }
    
    
    else {
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Erro tente Novamente',
            showConfirmButton: false,
            timer: 1200
        })
</script>";      

     //redirecionar
       echo "   
        <script>
                    setTimeout(function(){
                        window.location.href='../V/definicoes.php';
                    }, 850);
        </script> ";
    }


    
?>
