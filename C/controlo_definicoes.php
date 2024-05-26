<?php
     require("../M/conecao.php");
     require("cabe_sweetalert.php");
     $id = $_SESSION["id_usuario"];


    $msg =  false;

    if (isset($_FILES['arquivo'])) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4)); //pega extensão do arquivo
        $novo_nome = md5(time()). $extensao; #define nome do ficheiro
        $diretorio =  "../upload/"; #define o diretorio onde será enviado o arquivo

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome); #efectua o upload

        $result = $diretorio.$novo_nome;
       $query =" UPDATE tb_usuario SET id_usuario ='$id', foto='$result' WHERE id_usuario = $id";
       $pdo->exec($query);
    //sweet alert
    echo "<script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Foto Alterada com Sucesso',
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

    } else {
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Erro tente Novamente',
            showConfirmButton: false,
            timer: 850
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
