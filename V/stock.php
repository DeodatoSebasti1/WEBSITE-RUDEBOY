
<?php 
    include("cabecalhodashboard.php");
    error_reporting(E_ALL^E_NOTICE);
?>

<!---------------conteúdo---------->
<div class="conteudo">

<?php 
    include("barralateral.php");
?>



    <div class="corpo">
        <div class="main">

        <!----------------------TABS BOOTSTRAP------------------>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">ADICIONAR AO STOCK</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">STOCK DE ENTRADA</button>
        </li>
        <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">STOCK DE SAIDA</button>
         </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div  class="formulario_dashboard"  >  
        <form action="">
        <table>
            <th> <label for="">Pesquisar Produto</label></th>
            <tr>
                 <td> <input type="text" name="text_pesquisar_produto" required="" class="input" placeholder="Pesquisar Produto"></td>
                 <td><input type="submit" class="btn_pesquisar" value="Pesquisar"></td>
                 <span id="resultado_pesquisa"></span>
            </tr>
        </table>
        </form>

          <!--__________SELECT PARA PROCURAR DADOS DEPOIS DE CLICAR EM PESQUISAR _________-->
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
                if ($result): echo "<br>";?>

                  <!--______________tabela resultados_________-->
        <table  class="tabela_saida2 tab2">
            <tr class="cabecalho_tabela">
            <th>id</th>
            <th>Nome do Produto</th>
            <th>Quantidade</th>
            <th>Cor</th>
            <th>Tamanho</th>
            <th>Data de Nascimento</th>
            <th>Adicionar</th>
            </tr>
            <?php
            
            for ($i=0; $i < sizeof($result) ; $i++):
                $resultActual = $result[$i];
            ?>

        <tr class="tbody">
                <td><?php echo $resultActual["id_produto"]; ?></td>  
                <td><?php echo $resultActual["descricao"]; ?></td>
                <td><?php echo $resultActual["quantidade_ext"];  ?></td>  
                <td><?php echo $resultActual["cor"]; ?></td>
                <td><?php echo $resultActual["tamanho"]; ?></td>
                <td><?php echo $resultActual["data_cadastro"]; ?></td>
                <?php 
                #receber o id quando clicar no icone
                echo "
                <td>
                    <a href='stock.php?id=$resultActual[id_produto]'  class='green_center'><i class='fa-solid fa-plus fa-beat'></i></a>
                </td>";
                ?>    
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

        <!--____#################################################################################___-->
        <!--___________________RETORNAR OS DADOS DA TABELA NO FORMULARIO____________-->

        <?php 
        //reficara se o Id existe
        if (!empty($_GET['id'])) { 
            $id_produto= $_GET['id'];
            $query = $pdo->prepare("SELECT * FROM tb_produto where id_produto=$id_produto");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 
            
            //var_dump ($resultado); 
            
            if ($query->rowCount()) {
                for ($i=0; $i < sizeof($resultado); $i++) { 
                    $resultado_Actual = $resultado[$i];
                    echo "<br><br>";
                    $nome_produto = $resultado_Actual["descricao"];
                    $tamanho = $resultado_Actual["tamanho"]; 
                    $cor = $resultado_Actual["cor"];     
                }
            }
            else {
                echo "não existe";
            }
            $_SESSION['prod'] = $id_produto;

        ?>  
        <!--___________________PREENCHER O FORMULÁRIO____________-->

        <form action="../C/controlo_stockentrada.php" method="POST" id="retorno" ">
        <table style="text-align: left;">

            <th> <label for="">Nome Produto</label></th>
            <th> <label for="">Tamanho</label></th>
            <tr>
                 <td> <input type="text" name="nome" required="" class="input" disabled ="" value="<?php echo $nome_produto; ?>"></td>
                 <td><input type="text" name="sobrenome"required="" class="input" value="<?php echo $tamanho; ?>" disabled =""></td>
            </tr>

            <th> <label for="">Cor</label></th>
            <th> <label for=""> Quantidade</label></th>
            <tr>
                 <td> <input type="text" name="cor" required=""  class="input" value="<?php echo $cor; ?>" disabled =""></td>
                 <td><input type="number" name="quantidade" required=""  class="input required erro_input" oninput="validarNumero()" ></td>
            </tr>

        </table>
        <input class="btn_registrar" type="submit" value="Registrar" "> 
        </form> 

<?php 
        } 

?>
        </div>
        </div>
<!--____________________________________________________________________________________________________-->


<script>
        function toggle(){
            var x = document.getElementById("retorno");

            if (x.style.display ==="none") {
                x.style.display ="block";
            } else {
                x.style.display ="none";
            }
        }
    </script>


        <!----------------------STOCK DE ENTRADA------------------>

<?php
    $query = $pdo->prepare("SELECT * FROM tb_stcok_entrada");
    $query->execute();
?>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> <div >       
        <div class="scroll_tb" >    
        <?php if ($query->rowCount()): ?> 
        <div class="scroll_conteudo" >
        <table  class="tabela_saida">
            <tr class="cabecalho_tabela">
                <th>ID</th>
                <th>Nome do produto</th>
                <th>Quantidade de Entrada</th>
                <th>Data de Entrada</th>
              
            </tr>
            <?php 
            #________selecionar os dados da tabela 
                $query = $pdo->prepare("SELECT id_entrada, tb_produto.descricao, quantidade_entrada, data_entrada FROM tb_stcok_entrada INNER JOIN tb_produto on fk_produto = id_produto ORDER BY `id_entrada` ASC");
                $query->execute();
                $atleta =  $query->fetchAll(PDO::FETCH_ASSOC);
                
                #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
                for ($i=0; $i < sizeof($atleta) ; $i++):
                    $atletaActual = $atleta[$i];
            ?>
            <tr class="tbody">
                <td><?php echo $atletaActual["id_entrada"]; ?></td>
                <td><?php echo $atletaActual["descricao"]; ?></td>  
                <td><?php echo $atletaActual["quantidade_entrada"]; ?></td> 
                <td><?php echo $atletaActual["data_entrada"]; ?></td>
               
            </tr>
            <?php endfor?>
        </table>
        <?php
        #CASO A TABELA ESTEJA VAZIA,
         else: echo "<h5 style='padding-top:30px; padding-left: 70px; '>SEM DADOS NA TABELA</h5>";
        
        endif?>
        
        </div>
        </div>
        </div>
                </div>


        <!----------------------STOCK DE SAIDA------------------>
<?php
    $query = $pdo->prepare("SELECT * FROM tb_stcok_saida");
    $query->execute();
?>

        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="scroll_tb" >
            <?php if ($query->rowCount()): ?> 
            <div class="scroll_conteudo" >
        <table  class="tabela_saida">
            <tr class="cabecalho_tabela">
                <th>ID</th>
                <th>Nome do produto</th>
                <th>Quantidade saida</th>
                <th>Quantidade restante</th>
                <th>Data de saída</th>
              
            </tr>
            <?php 
            #________selecionar os dados da tabela 
                $query = $pdo->prepare("SELECT id_saida, tb_produto.descricao, quantidade_saida, quantidade_restante, data_saida FROM tb_stcok_saida INNER JOIN tb_produto INNER JOIN tb_venda on fk_produto = id_produto AND id_venda = fk_venda ORDER BY `id_saida` ASC");
                $query->execute();
                $atleta =  $query->fetchAll(PDO::FETCH_ASSOC);
                
                #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
                for ($i=0; $i < sizeof($atleta) ; $i++):
                    $atletaActual = $atleta[$i];
            ?>
            <tr class="tbody">
                <td><?php echo $atletaActual["id_saida"]; ?></td>
                <td><?php echo $atletaActual["descricao"]; ?></td>  
                <td><?php echo $atletaActual["quantidade_saida"]; ?></td>   
                <td><?php echo $atletaActual["quantidade_restante"]; ?></td>
                <td><?php echo $atletaActual["data_saida"]; ?></td>
               
            </tr>
            <?php endfor?>
        </table>
        <?php
        #CASO A TABELA ESTEJA VAZIA,
         else: echo "<h5 style='padding-top:30px; padding-left: 70px; '>SEM DADOS NA TABELA</h5>";
        
        endif?>
        
        </div>
        </div>
            
             </div>
    
    </div>




        <!----------------------Registrar atleta------------------>



            <!----------------------Registrar atleta------------------>





        </div>
    </div>
</div>

<script>
//função de erros
//mostrar
function setError(index) {
    campos[index].style.border= '2px solid red';
    spans[index].style.display= 'block';
}
//retirar
function removeError(index) {
    campos[index].style.border= '2px solid rgb(0, 205, 7)';
    spans[index].style.display= 'none';
}
const numberRegex =  /^\d+$/;
const campos =  document.querySelectorAll('.required');

    //numero
    function validarNumero() {
        if(!numberRegex.test(campos[0].value)){
                setError(0); 
        }
        else{
            removeError(0); 
        } 
    }
</script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>
