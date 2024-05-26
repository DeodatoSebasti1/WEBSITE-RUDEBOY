
<?php



function cadastrar ($dados)
{
    require("conecao.php");
    require("../C/cabe_sweetalert.php");
    
#______________________________________________________________________________________


    //INSERIR VALORES NA BASE DE DADOS 


    $query ="INSERT INTO tb_atleta (fk_usuario,nome_atleta,sobrenome,bi,data_nascimento,genero,telefone,telefone2,turno) 
    VALUE('$_SESSION[id_usuario]','$dados[0]', '$dados[1]','$dados[2]','$dados[3]','$dados[4]','$dados[5]','$dados[6]',
    '$dados[7]')";
    $pdo->exec($query);

      //sweet alert
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Atleta Cadastrado com Sucesso',
            showConfirmButton: false,
            timer: 800
        })
        </script>";
#echo "<script> window.location.href='../V/registraratleta.php'</script>";

        //redirecionar
        echo "   
        <script>
        setTimeout(function(){
        window.location.href='../V/registraratleta.php';
        }, 800);
        </script> 
        ";
}  





?>


