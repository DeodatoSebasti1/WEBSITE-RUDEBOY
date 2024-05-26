

<?php 
    include("../M/conecao.php");
    $query = $pdo->prepare("SELECT * FROM tb_venda");
    $query->execute();
    $venda = $query-> fetchAll();
?>

        <?php 
        //reficara se o Id existe
        if (!empty($_GET['id'])) { 
            $id_vendas= $_GET['id'];
            $query = $pdo->prepare("SELECT id_venda,  tb_usuario.nome,tb_usuario.sobrenome, tb_produto.descricao,tb_produto.preco, quantidade, data_venda FROM tb_venda INNER JOIN tb_usuario ON fk_usuario= id_usuario INNER JOIN tb_produto ON fk_produto = id_produto");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 
            
            //var_dump ($resultado); 
            
            if ($query->rowCount()) {
                for ($i=0; $i < sizeof($resultado); $i++) { 
                    $resultado_Actual = $resultado[$i];
                    $id_venda =  $resultado_Actual["id_venda"];
                    $atendente = $resultado_Actual["nome"]." ".$resultado_Actual["sobrenome"] ;
                    $produto = $resultado_Actual["descricao"];     
                    $preco = $resultado_Actual["preco"];
                    $quantidade =  $resultado_Actual["quantidade"];
                    $data_venda =  $resultado_Actual["data_venda"];
                    $valorTotal = $preco * $quantidade; 
                }
            }
        }
        ?>  
    <?php
 
    ?>

    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Venda</title>
</head>
<body>
    te amo
</body>
</html>