 <?php
    include_once '../M/conecao.php';   
    

// Ler os registros retornado do BD
        //reficara se o Id existe
        if (!empty($_GET['id'])) { 
            $id_vendas= $_GET['id'];
            #consulta sql
            $query = $pdo->prepare("SELECT id_venda,  tb_usuario.nome,tb_usuario.sobrenome, tb_produto.descricao,tb_produto.tamanho,tb_produto.cor,tb_produto.preco, quantidade, data_venda FROM tb_venda INNER JOIN tb_usuario ON fk_usuario= id_usuario INNER JOIN tb_produto ON fk_produto = id_produto where id_venda = $id_vendas ");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 
            
            //var_dump ($resultado); 
            
            if ($query->rowCount()) {
                for ($i=0; $i < sizeof($resultado); $i++) { 
                    $resultado_Actual = $resultado[$i];
                    $id_venda =  $resultado_Actual["id_venda"];
                    $atendente = $resultado_Actual["nome"]." ".$resultado_Actual["sobrenome"] ;
                    $produto = $resultado_Actual["descricao"]; 
                    $tamanho = $resultado_Actual["tamanho"];  
                    $preco = $resultado_Actual["preco"];
                    $cor =  $resultado_Actual["cor"];
                    $quantidade =  $resultado_Actual["quantidade"];
                    $data_venda =  $resultado_Actual["data_venda"];
                    $valorTotal = $preco * $quantidade; 
                }
            }
        }
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Fatura</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/scripts.js" defer></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/estilo3.css">
</head>

<body>

        
<div class="borda" id="content">
        <table  class="tabela_saida">
            <tr>
                <th colspan="3"><h1>Fatura</h1></th>
                <th><img src="../img/logo2.png" width="200" height="60" ></th>
            </tr>


            <tr >
                <td > <b>Localização:</b> Talatona,<br> Condominio American Plaza</td>
                <td colspan="2" style="width: 180px;">Venda nº: <?php echo $id_venda ?> </td>
                <td>Telefone: </td>

            </tr>      
        </table>

        
        <table  class="tabela_saida2 tb3 top">
            <tr class="cabecalho_tabela ">
            <th>Produto</th>
            <th>Cor</th>
            <th>Tamanho</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            </tr> 
            <tr style="">
                <td><?php echo $produto ?></td>
                <td><?php echo $cor ?></td>
                <td><?php echo $tamanho ?></td>
                <td><?php echo $quantidade ?></td>
                <td><?php echo $preco ?></td>
            </tr>
        </table>

        <table  class=" tabela_saida3 top ">
            <tr >
            <td style="text-align: right;"> <b>Total a Pagar:</b> <?php echo $valorTotal ?> kzs </td> 
            </tr>      
            <tr>
                <td><b>Atendente:</b> <?php echo $atendente ?></td>
            </tr>
            <tr>
            <td><b>Data-venda:</b> <?php echo $data_venda ?></td>
            </tr>
        </table>

        <table  class=" tabela_saida3 top ">
            <tr>
                <td>
                    <center>
                        <span>Obrigado pela Preferencia, Volte Sempre!!!</span>
                    </center>
                </td>
            </tr>
        </table>

</div>
        
        <button id="gerar_pdf" style="background-color:#2ab56b; margin:10px; border:none; padding:10px; border-radius:20px;">IMPRIMIR RECIBO</button>

        <a href="../V/vendas.php" style="background-color:#bf2f2f; border:none; color:white; padding:10px; border-radius:20px; text-decoration: none;" >VOLTAR</a>
  
</body>
</html>

