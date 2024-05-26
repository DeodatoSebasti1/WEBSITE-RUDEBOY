

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

<!--___________________RETORNAR OS DADOS DA TABELA NO FORMULARIO____________-->

<?php 
        //reficara se o Id existe
        if (!empty($_GET['id'])) { 
            $id_pag= $_GET['id'];
            $query = $pdo->prepare("SELECT * FROM tb_pagamento where id_pagamento=$id_pag");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 
            
            //var_dump ($resultado); 
            
            if ($query->rowCount()) {
                for ($i=0; $i < sizeof($resultado); $i++) { 
                    $resultado_Actual = $resultado[$i];
                    echo "<br><br>";
                    $nome_atleta = $resultado_Actual["nome_atleta"];
                    $sobrenome = $resultado_Actual["sobrenome"]; 
                    $data_nasc = $resultado_Actual["data_nascimento"];
                    $bi = $resultado_Actual["bi"];
                    $turno = $resultado_Actual["turno"];
                    $genero = $resultado_Actual["genero"];     
                    $telefone = $resultado_Actual["telefone"];
                    $telefone2 = $resultado_Actual["telefone2"];
                }
            }
            else {
                echo "n existe";
            }

        } else {
            //echo "vazio";
        }
?>  

    <div class="corpo">
        <div class="main">

        <!----------------------TABS BOOTSTRAP------------------>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">EDITAR PAGAMENTOS</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div  class="formulario_dashboard"  >  
        <!--____#################################################################################___-->
        <!--___________________RETORNAR OS DADOS DA TABELA NO FORMULARIO____________-->

        <?php 
        //reficara se o Id existe
        if (!empty($_GET['id'])) { 
            $id_pag= $_GET['id'];
            $query = $pdo->prepare("SELECT id_pagamento,  tb_usuario.telefone, tb_atleta.id_atleta, tb_atleta.nome_atleta, tb_atleta.sobrenome, tb_meses.descricao, valor, data_pagamento FROM tb_pagamento INNER JOIN tb_usuario ON fk_usuario= id_usuario INNER JOIN tb_atleta ON fk_atleta = id_atleta INNER JOIN tb_meses ON fk_mes = id_mes ");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 
            
            //var_dump ($resultado); 
            
            if ($query->rowCount()) {
                for ($i=0; $i < sizeof($resultado); $i++) { 
                    $resultado_Actual = $resultado[$i];
                    $id_atle =  $resultado_Actual["id_atleta"];
                    $nome_atleta = $resultado_Actual["nome_atleta"];
                    $sobrenome = $resultado_Actual["sobrenome"]; 
                    $telefone = $resultado_Actual["telefone"];     
                    $preco = $resultado_Actual["valor"];
                }
            }

            $_SESSION['fk_atleta']= $id_atle;
            $_SESSION['id_pagamento']= $id_pag;
            #var_dump($_SESSION['fk_atleta']);


        } else {
            //echo "vazio";
        }
        ?>  
        <!--formulario 2 resultado-->
        <form action="../C/controlo_pagamentoEditar.php" method="post">
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
                <td><input type="number" name="preco"required="" class="input required erro_input" oninput="validarNumero()" placeholder="Valor a Pagar em KZS" value="<?php echo $preco ?>"></td>
            </tr>
            <th><label for="">Mês a Pagar</label></th>
            <tr>
            
            <td> 
                <select name="mes" id="mes" class="select" required="">
                <option value="" required="">Selecione o mês</option>
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
        <input class="btn_registrar" type="submit" value="Guardar"> 
        </form> 

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
