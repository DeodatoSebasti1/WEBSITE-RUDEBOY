<?php
require('conecao.php');
require("../C/cabe_sweetalert.php");
error_reporting(0);
$_SESSION['pdo'] = $pdo;

if(isset(($_SESSION['car'])))
{
    if(count($_SESSION['car']) > 0)
    {
        foreach ($_SESSION['car'] as $key => $value) {
            cadastrar($value);
        }
    }
}

function cadastrar($dados)
{
    //var_dump($dados);
 #fazer insert na tabela da venda
   $query ="INSERT INTO tb_venda (fk_usuario,fk_produto,quantidade)VALUE('$_SESSION[id_usuario]', '$dados[id_produto]','$dados[quantidade]')";
   $result1 = $_SESSION['pdo']->exec($query);
   
   #var_dump($query);
   if(isset($result1)){

    #selecionar o ultima venda registrada
        $query = $_SESSION['pdo']->prepare("SELECT id_venda FROM tb_venda ORDER by data_venda DESC LIMIT 1");
        $query->execute();
        $result2 = $query-> fetchAll();
        $id_venda = $result2[0]["id_venda"];
       # var_dump($id_venda);
       
    #atualizar quantidade do produto (descontar)
       $query = $_SESSION['pdo']->prepare("UPDATE tb_produto SET `quantidade_ext`= `quantidade_ext` - $dados[quantidade] WHERE `id_produto`=$dados[id_produto]");
       $query->execute();
       $quantidade_ext = (int)$dados['quantidade_ext'];
       $quantidade = $dados['quantidade'];

       $quant_rest = ($quantidade_ext  - $quantidade);

    #adicionar registro na tabela de stock
    $query ="INSERT INTO tb_stcok_saida (fk_venda,quantidade_saida,quantidade_restante)VALUE('$id_venda', '$dados[quantidade]','$quant_rest') ";
    $result = $_SESSION['pdo']->exec($query);

    }
}
      //sweet alert
      echo "<script>
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Venda Efectuada com Sucesso',
          showConfirmButton: false,
          timer: 850
      })
      </script>";
#echo "<script> window.location.href='../V/registraratleta.php'</script>";

      //redirecionar
      echo "   
      <script>
      setTimeout(function(){
      window.location.href='../C/limpar.php';
      }, 850);
      </script> 
      ";

?>