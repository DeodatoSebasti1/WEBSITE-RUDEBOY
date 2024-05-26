<?php 
//require('../M/venda.php');
session_start();
//unset($_SESSION['car']);
?>

<!-- CARRINHO -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/fontawesome.min.css">
<link rel="stylesheet" href="../css/all.css">
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>


<?php 
    $produto = $_SESSION['produto'];
    // adicionando ao carrinho
    if(isset($_REQUEST['adicionar']))
    {
        var_dump($produto);
        $idproduto = (int) $_GET['adicionar'];
        
            if(isset($_SESSION['car'][$idproduto]))
            {
                $_SESSION['car'][$idproduto]['quantidade']++;
            }
            else{
                $_SESSION['car'][$idproduto] = array('quantidade'=>1,'id_produto'=>$produto[0]['id_produto'],
            'descricao'=>$produto[0]['descricao'],'cor'=>$produto[0]['cor'],'tamanho'=>$produto[0]['tamanho'],
            'quantidade_ext'=>$produto[0]['quantidade_ext'],'preco'=>$produto[0]['preco']);
            header("location:vendas.php");
            }
                    
    }
    var_dump($_SESSION['car']);
    // REMOVER
    // removendo  produtos do carrinho   
    if(isset($_GET['remover']))
    {
        $idproduto = (int) $_GET['remover'];
        
            if(isset($_SESSION['car'][$idproduto]))
            {
                if($_SESSION['car'][$idproduto]['quantidade'] == 1)
                {
                    unset($_SESSION['car'][$idproduto]);
                
                }
            else{
                //$_SESSION['carrinho'] = array_diff($_SESSION['carrinho'],$idproduto);
                $_SESSION['car'][$idproduto]['quantidade'] = $_SESSION['car'][$idproduto]['quantidade']-1;
            }
            }
    }
    ?>
<div class="container">
    <div class="col col-md-12 table-responsive">
        <div style="">
            <a href="vendas.php" class="btn">Voltar</a>
        </div>
        <h2>CARRINHO</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                    <th style="width: 2%;">ID.</th>
                    <th style="width: 32%;">Nome do Produto</th>
                    <th style="width: 20%;">Cor</th>
                    <th style="width: 3%;">Tamanho</th>
                    <th style="width: 2%;">Quantidade</th>
                    <th style="width: 4%;">Preço</th>
                    <th style="width: 6%;">Action</th>
                    </tr>
                </thead>
                <?php
                /*if(isset($_GET['adicionar']) || isset($_GET['remover']) )
                {*/
                    if(count($_SESSION['car']) > 0){
                    ?>
                        <?php
                            foreach ($_SESSION['car'] as $key => $value){         
                        ?>
                        <!-- listando o carrinho -->
                        <tbody id="medicines_div" style="color:#727272">
                            <td style="width: 2%;"><?php echo $value['id_produto']?></td>
                            <td style="width: 32%;"><?php echo $value['descricao']?></td>
                            <td style="width: 3%;"><?php echo $value['cor']?></td>
                            <td style="width: 20%;"><?php echo $value['tamanho']?></td>
                            <td style="width: 4%;"><?php echo $value['quantidade']?></td>
                            <td style="width: 2%;"><?php echo $value['preco'] * $value['quantidade']?></td>
                            <td style="width: 4%;">
                                <a href="?adicionar=<?php echo $key ?>" style="margin-right:13px">
                                    <span class="fa fa-plus"style="color:blue"></span>
                                </a>
                                <a href="?remover=<?php echo $key ?>">
                                    <span class="fa fa-trash"style="color:red"></span>
                                </a>
                            </td>
                        </tbody>
                        <?php 
                        }//fim foreache 
                    //} //fim if count
                }   //fim if isset     
            ?>
            </table>
            
            <?php
            if(count($_SESSION['car'])<=0){
                echo '<div class="form-group m-5"><p>carrinho está vazio</p></div>';
                //header('Location:add_venda.php');
            }
                if(count($_SESSION['car']) > 0){
            ?>
                <div style="margin-left:350px;margin-top:80px">
                    <a href="../M/venda.php"  class="btn btn-success">Continuar</a>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<script src="../Assets/js/all.min.js"></script>