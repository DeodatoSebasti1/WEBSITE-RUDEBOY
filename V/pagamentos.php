

<?php 
    include("cabecalhodashboard.php");
    $display= "none";
    error_reporting(E_ALL^E_NOTICE);
?>

<!---------------conteúdo---------->
<div class="conteudo">

<?php 
    include("barralateral.php");

    $query = $pdo->prepare("SELECT * FROM tb_pagamento");
    $query->execute();
    $pagamento = $query-> fetchAll();
?>

    <div class="corpo">
        <div class="main">

        <!----------------------TABS BOOTSTRAP------------------>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">REGISTRAR PAGAMENTOS</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">LISTA DE PAGAMENTOS</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div  class="formulario_dashboard"  >  

        <!--formulario 1 pesquisar-->
        <form action="">
        <table>
            <th> <label for="">Pesquisar Cliente</label></th>
            <tr>
                 <td> <input type="text" name="text_pesquisar_atleta" required="" class="input" placeholder="Pesquisar cliente"></td>
                 <td><input type="submit" class="btn_pesquisar" value="Pesquisar"></td>
                 <span id="resultado_pesquisa"></span>
            </tr>
        </table>
        </form>

          <!--__________SELECT PARA PROCURAR DADOS DEPOIS DE CLICAR EM PESQUISAR _________-->
          <?php
            #select para procurar produto

            if (isset($_REQUEST['text_pesquisar_atleta'])): ?>

            <?php
                $pesquisar = $_REQUEST['text_pesquisar_atleta'];

                $query = $pdo->prepare("SELECT * FROM tb_atleta where nome_atleta=?");
                $query->execute(array($pesquisar));
                $result = $query-> fetchAll(); 
            ?>
                <?php 
                #mostrar resultado caso exista dados na tabela
                if ($result): echo "<br>";?>

                  <!--______________tabela resultados_________-->
        <table  class="tabela_saida2 tab2">
            <tr class="cabecalho_tabela">
            <th>id</th>
            <th>Nome do Cliente</th>
            <th>Telefone</th>
            <th>Gênero</th>
            <th>Periodo</th>
            <th>Data de Nascimento</th>
            <th>Adicionar</th>
            </tr>
            <?php
            
            for ($i=0; $i < sizeof($result) ; $i++):
                $resultActual = $result[$i];
            ?>

        <tr class="tbody">
                <td><?php echo $resultActual["id_atleta"]; ?></td>  
                <td><?php echo $resultActual["nome_atleta"]; echo " ";  echo $resultActual["sobrenome"]; ?></td>
                <td><?php echo $resultActual["telefone"];  ?></td>  
                <td><?php echo $resultActual["genero"]; ?></td>
                <td><?php echo $resultActual["turno"]; ?></td>
                <td><?php echo $resultActual["data_nascimento"]; ?></td>
                <?php 
                #receber o id quando clicar no icone
                echo "
                <td>
                    <a href='pagamentos.php?id=$resultActual[id_atleta]' class='green_center'><i class='fa-solid fa-plus fa-beat'></i></a>
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
                                                    title: 'Este Atltea não existe',
                                                    showConfirmButton: false,
                                                    timer: 1400
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
            $id_at= $_GET['id'];
            $query = $pdo->prepare("SELECT nome_atleta, sobrenome, telefone FROM tb_atleta where id_atleta=$id_at");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 
            
            //var_dump ($resultado); 
            
            if ($query->rowCount()) {
                for ($i=0; $i < sizeof($resultado); $i++) { 
                    $resultado_Actual = $resultado[$i];
                    echo "<br><br>";
                    $nome_atleta = $resultado_Actual["nome_atleta"];
                    $sobrenome = $resultado_Actual["sobrenome"]; 
                    $telefone = $resultado_Actual["telefone"];     
                }
            }
            else {
                echo "n existe";
            }

        
        ?>  
        <!--formulario 2 resultado-->
        <form action="../C/controlo_pagamento.php" method="post">
        <table style="text-align: left;">
            <th> <label for="">Nome</label></th>
            <th> <label for="">Sobrenome</label></th>
            <tr>
                 <td> <input type="text" name="nome" required="" class="input" placeholder="" value="<?php echo $nome_atleta ?>" disabled="disabled"></td>
                 <td><input type="text" name="sobrenome" required="" class="input" minlength="9" maxlength="9" value="<?php echo $sobrenome ?>" disabled="disabled"></td>
            </tr>
            
            <th> <label for="">Telefone</label></th>
            <th> <label for="">Preço</label></th>
            <tr>
            <td><input type="tel" name="telefone"required="" class="input" minlength="9" maxlength="9" value="<?php echo $telefone ?>" disabled="disabled"></td>
                <td><input type="number" name="preco"required="" class="input required erro_input" oninput="validarNumero()" placeholder="Valor a Pagar em KZS"></td>
            </tr>
            <th><label for="">Mês a Pagar</label></th>
            <tr>
            
            <td> 
                <select name="mes" id="mes" required class="select">
                <option value="" required>Selecione o mês</option>
                 <!-- caso tenha dados na tabela executar: -->
                <?php if ($query->rowCount()): ?> 
                <?php 
            #________selecionar os dados da tabela 
                $query = $pdo->prepare("SELECT * FROM tb_meses");
                $query->execute();
                $mes =  $query->fetchAll(PDO::FETCH_ASSOC);
            
                #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
                for ($i=0; $i < sizeof($mes) ; $i++):
                    $mesActual = $mes[$i];
                ?>
                
                <option value="<?php echo $mesActual["id_mes"]; ?>"><?php echo $mesActual["descricao"]; ?></option>
                <?php endfor?>
                <?php endif?>
                </select>
            </td>
        </tr>
        </table>
        <input class="btn_registrar" type="submit" value="Registrar"> 
        </form> 

        <?php 
            } else {
                //echo "vazio";
            }

        ?>

    <?php
           // print_r($sobrenome);
           $_SESSION["id_atle"] = $id_at;        
            #$dados[1]= $telefone;
            #$dados[2]= $_POST["preco"];
            #$dados[3]= $_POST["mes"];
           // cadastrar ($dados);  
    ?>

    
</div>
    </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

        <!----------------------Tabela de saida------------------>
        <!--____#################################################################################___-->
        <!----------------------RETORNAR OS REGISTROS------------------>
        <div class="scroll_tb" >
            
        <!-- caso tenha dados na tabela executar: -->
        <?php 
                $query = $pdo->prepare("SELECT * FROM tb_pagamento");
                $query->execute();
        if ($query->rowCount()): ?> 
            <div class="scroll_conteudo" >
        <table  class="tabela_saida">
            
            <tr class="cabecalho_tabela">
            <th>ID</th>
            <th>Atleta</th>
            <th>Mes</th>
            <th>Valor</th>
            <th>Atendente</th>
            <th>Data de Pagamento</th>
            <th>Ações</th>
            </tr>
            <?php 
            #________selecionar os dados da tabela 
                $query = $pdo->prepare("SELECT id_pagamento, tb_usuario.nome, tb_atleta.nome_atleta, tb_atleta.sobrenome, tb_meses.descricao, valor, data_pagamento FROM tb_pagamento INNER JOIN tb_usuario ON fk_usuario= id_usuario INNER JOIN tb_atleta ON fk_atleta = id_atleta INNER JOIN tb_meses ON fk_mes = id_mes ORDER BY id_pagamento ");
                $query->execute();
                $pagamento =  $query->fetchAll(PDO::FETCH_ASSOC);
            
                #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
                for ($i=0; $i < sizeof($pagamento) ; $i++):
                    $pagamentoActual = $pagamento[$i];
            ?>

            <tr class="tbody">
                <td><?php echo $pagamentoActual["id_pagamento"]; ?></td>
                <td><?php echo $pagamentoActual["nome_atleta"]." ".$pagamentoActual["sobrenome"]; ?></td>  
                <td><?php echo $pagamentoActual["descricao"]; ?></td>
                <td><?php echo $pagamentoActual["valor"]; ?></td>
                <td><?php echo $pagamentoActual["nome"]; ?></td>
                <td><?php echo $pagamentoActual["data_pagamento"]; ?></td>
                <td>
                <?php
                    echo "
                    <a href='pagamentosEditar.php?id=$pagamentoActual[id_pagamento]' class='green'><i class='fa-solid fa-pen '></i></a>
                    <a href='../C/controlo_pagamentoEliminar.php?id=$pagamentoActual[id_pagamento]' class='red'><i class='fa-solid fa-trash-can'></i></a>"
                ?>
                </td>
            </tr>
            <?php endfor?>
        </table>
        <!-- caso não tenha dados na tabela executar: -->
        <?php
        #CASO A TABELA ESTEJA VAZIA,
         else: echo "<h5 style='padding-top:30px; padding-left: 70px; '>NENHUM ATLETA REGISTRADO</h5>";
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
<script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>
