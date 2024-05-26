 <?php
 
    // include autoloader
    require_once 'dompdf/autoload.inc.php';
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

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/WEBSITE%20RUDEBOY/css/estilo2.css'";
$dados .= "<title>Gerar PDF</title>";
$dados .= "</head>";
$dados .= "<body>";

$dados .= "<div class=''>";
$dados .= "<h1 >FACTURA</h1>";
$dados .= "<table  class='tb3 border'>";
$dados .= "<th>RUDEBOY TRAINING </th>";
$dados .= "<tr>";
$dados .= "<th><td><b>Localização:</b> Talatona,<br> Condominio American Plaza</td></th>";
$dados .= "<th><td style='width: 180px;'><b>Venda nº: </b>  $id_venda  </td></th>";
$dados .= "<th><td><b>Telefone:</b> 942582270/957389481 </td></th>";
$dados .= "</tr>";
$dados .= "<th> </table></th>";  

$dados .= "<br>";
$dados .= "<br>";

$dados .= "<table  class='tabela_saida2 tb3 top'>";
$dados .= "<tr class='cabecalho_tabela'>";
$dados .= "<th>Produto</th>";
$dados .= "<th>Cor</th>";
$dados .= "<th>Tamanho</th>";
$dados .= "<th>Quantidade</th>";
$dados .= "<th>Preço</th>";
$dados .= "</tr>";
$dados .= "<tr>";
$dados .= "<td>$produto</td>";
$dados .= "<td> $cor</td>";
$dados .= "<td> $tamanho </td>";
$dados .= "<td> $quantidade </td>";
$dados .= "<td> $preco</td>";
$dados .= "</tr>";
$dados .= "</table>";

$dados .= "<br>";
$dados .= "<br>";

$dados .= "<table class='tb3 top'>";
$dados .= "<tr>";
$dados .= "<td style='text-align: right;'> <b>Total a Pagar:</b>$valorTotal kzs </td>";
$dados .= "</tr>";
$dados .= "<tr><td><b>Atendente:</b> $atendente</td></tr>";
$dados .= "<tr><td><b>Data-venda:</b> $data_venda</td></tr>";
$dados .= "</table>";
$dados .= "<br>";
$dados .= "<br>";
$dados .= "<center><span>RUDEBOY TRAINING</span></center>";
$dados .= "<center><span>Obrigado pela Preferencia, Volte Sempre!!!</span></center>";
$dados .= "<br>";
$dados .= "<center><span>___________________________________________</span></center>";
$dados .= "<br>";
$dados .= "</body>";


    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf(['enable_remote' => true]);
    $dompdf->loadHtml($dados);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("factura", //nome do arquivo
    array("Attachment"=> false));
 
 ?>



 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Fatura</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/estilo2.css">
    <link rel="stylesheet" href="../css/estilo.css"> 
</head>

<body>

        
<div class="borda">
<table  class="tb3 border">
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
            <tr style="height: 50px; margin-top: 30px">
                <td><?php echo $produto ?></td>
                <td><?php echo $cor ?></td>
                <td><?php echo $tamanho ?></td>
                <td><?php echo $quantidade ?></td>
                <td><?php echo $preco ?></td>
            </tr>
        </table>

        <table  class=" tb3 top ">
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
        <center>
            <span>Obrigado pela Preferencia, Volte Sempre!!!</span>
        </center>
        <center>
            <span>deo</span>
        </center>
</div>
  
</body>
</html>

    -->
