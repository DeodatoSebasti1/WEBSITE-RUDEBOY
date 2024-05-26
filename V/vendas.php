

<?php 
    include("cabecalhodashboard.php");
?>
<!---------------conteúdo---------->
<div class="conteudo">

<?php 
    include("barralateral.php");
    $query = $pdo->prepare("SELECT * FROM tb_venda");
    $query->execute();
    $venda = $query-> fetchAll();
?>

    <div class="corpo">
        <div class="main">

        <!----------------------TABS BOOTSTRAP------------------>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">EFECTUAR VENDA</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">PRODUTOS VENDIDOS</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div  class="formulario_dashboard"  >  
        <form action="" method="#">

        <input type="text" name="text_pesquisar_produto" placeholder="Pesquisar Produto">
        <input type="submit" value="Pesquisar" class="btn_pesquisar">

        <!--________________________select para procurar_________________-->
        <?php
            #select para procurar produto

            if (isset($_REQUEST['text_pesquisar_produto'])): ?>

            <?php
                $pesquisar = $_REQUEST['text_pesquisar_produto'];

                $query = $pdo->prepare("SELECT * FROM tb_produto where descricao like ? and quantidade_ext>0");
                $query->execute(["%".$pesquisar."%"]);
                $result = $query-> fetchAll();
                
            ?>
                <?php 
                #mostrar resultado caso exista dados na tabela
                if ($result): ?>

                  <!--______________tabela resultados_________-->
        <table  class="tabela_saida2">
            <tr class="cabecalho_tabela">
            <th>id</th>
            <th>Nome do Produto</th>
            <th>Cor</th>
            <th>Tamanho</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Carrinho</th>
            </tr>
            <?php
            $_SESSION['produto'] =  $result;
            for ($i=0; $i < sizeof($result) ; $i++):
                $resultActual = $result[$i];
            ?>

        <tr class="tbody">
            <td><?php echo $resultActual["id_produto"]; ?></td>
            <td><?php echo $resultActual["descricao"]; ?></td>  
            <td><?php echo $resultActual["cor"]; ?></td>
            <td><?php echo $resultActual["tamanho"]; ?></td>
            <td><?php echo $resultActual["quantidade_ext"]; ?></td>
            <td><?php echo $resultActual["preco"]; ?></td>
            <td>
                <a href="carrinho.php?adicionar=<?php echo $i. " ". $resultActual["id_produto"]; ?>" class="green_center"><i class="fa-solid fa-plus fa-beat"></i></a>
            </td>
        </tr>
        <?php endfor?>
            
        </table>
             
                    
                 <?php else: 
                                                echo "<script>
                                                Swal.fire({
                                                    position: 'center',
                                                    icon: 'error',
                                                    title: 'O Produto não existe',
                                                    showConfirmButton: false,
                                                    timer: 1000
                                                })
                                                </script>";
                endif?>
   
        <?php
            else:
            # code...
            endif?>

        </form> 
        </div>
  </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

        <!----------------------Tabela de saida------------------>

        <!----------------------Tabela de saida------------------>
        <div class="scroll_tb" >
        <!-- caso tenha dados na tabela executar: -->
        <?php
                $query = $pdo->prepare("SELECT * FROM tb_venda");
                $query->execute();
        if ($query->rowCount()): ?> 
        <div class="scroll_conteudo">
        <table  class="tabela_saida ">
        <tr class="cabecalho_tabela">           
            <th>Id</th>
            <th>Atendente</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Data de Venda</th>
            <th>Factura</th>
        </tr>
            <?php 
            #________selecionar os dados da tabela 
                $query = $pdo->prepare("SELECT id_venda, tb_usuario.nome, tb_produto.descricao, quantidade, data_venda FROM tb_venda INNER JOIN tb_usuario on fk_usuario = id_usuario INNER JOIN tb_produto on fk_produto = id_produto ORDER BY `id_venda` ASC");
                $query->execute();
                $venda =  $query->fetchAll(PDO::FETCH_ASSOC);
            
                #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
                for ($i=0; $i < sizeof($venda) ; $i++):
                    $vendaActual = $venda[$i];
                    $_SESSION['quant'] = $vendaActual["quantidade"];
            ?>

            <tr class="tbody">
                <td><?php echo $vendaActual["id_venda"]; ?></td>
                <td><?php echo $vendaActual["nome"]; ?></td>  
                <td><?php echo $vendaActual["descricao"]; ?></td>
                <td><?php echo $vendaActual["quantidade"]; ?></td>
                <td><?php echo $vendaActual["data_venda"]; ?></td>
                <td>
                <?php
                    echo "
                    <center><a href='teste.php?id=$vendaActual[id_venda]' class='factura'><i class='fa-solid fa-print'></i></a></center>"
                ?>
                </td>
            </tr>
            <?php endfor?>
        </table>
        <!-- caso não tenha dados na tabela executar: -->
        <?php
        #CASO A TABELA ESTEJA VAZIA,
         else: echo "<h5 style='padding-top:30px; padding-left: 70px; '>NENHUMA VENDA REGISTRADA</h5>";
        endif?>
        </div>
        </div>

            <!----------------------Registrar atleta------------------>
            <!----------------------Registrar atleta------------------>

        </div>
    </div>
</div>
<script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>
