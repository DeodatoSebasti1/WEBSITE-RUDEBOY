<?php
require('conecao.php');
$_SESSION['pdo'] = $pdo;

if(isset(($_SESSION['car'])))
{
    if(count($_SESSION['car']) > 0)
    {
        //var_dump($_SESSION['car']);
        echo "</br>";
        echo "</br>";
        //var_dump($_SESSION['car'][3]["nome"]);
        echo "</br>";
        foreach ($_SESSION['car'] as $key => $value) {
            //echo $value["id_produto"];
            cadastrar($value);
        }
        /*for($i=0; $i < count($_SESSION['car']);$i++)
        {
            cadastrar( $_SESSION['car'][$_SESSION['car'][2]] );
        }*/
    }
}
//echo $_SESSION["usuario"];
function cadastrar($dados)
{

    //var_dump($chave);
    //echo $_SESSION["id_usuario"]." id_produto: ".$dados["id_produto"]." quantidade: ".$dados["quantidade"]."</br>";
    
    #fazer insert na tabela da venda
    $query ="INSERT INTO tb_venda (fk_usuario,fk_produto,quantidade)VALUE('$_SESSION[id_usuario]', '$dados[id_produto]','$dados[quantidade]')";
    $result1=$_SESSION['pdo']->exec($query);

    #selecionar o ultima venda registrada
    if($result1){
        // retorna o ultimo dado da tabela venda
        $query =$_SESSION['pdo']->prepare("SELECT id_venda FROM `tb_venda` ORDER BY id_venda DESC LIMIT 1");
        $query->execute();
        //$result2 = $query-> fetchAll();
        $result2 = $query->fetchAll(PDO::FETCH_ASSOC)[0]; 
        //var_dump($result2["id_venda"]);
        //$result2["id_venda"];
    
        // subtrair produtos da tabela produto
        $query =$_SESSION['pdo']->prepare("UPDATE tb_produto SET quantidade_ext = quantidade_ext - $dados[quantidade] WHERE id_produto = $dados[id_produto]");
        $query->execute();

        $query ="INSERT INTO tb_stcok_saida (fk_venda,quantidade_saida)VALUE('$result2[id_venda]','$dados[quantidade]')";
        $_SESSION['pdo']->exec($query);

        header("location:../V/vendas.php");     
        
    }

}

?>