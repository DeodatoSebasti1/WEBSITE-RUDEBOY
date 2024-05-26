

<?php 
    include("cabecalhodashboard.php");
    error_reporting(E_ALL^E_NOTICE);
?>

<!---------------conteúdo---------->
<div class="conteudo">

<?php 
    include("barralateral.php");
    $query = $pdo->prepare("SELECT * FROM tb_produto");
    $query->execute();
    $produto = $query-> fetchAll();

    $erroNome = "";
    $erroCor = "";
    $erroTamanho = "";

    //__________________________________VALIDAÇÃO DE FORMULARIO___________________
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    #dados
    $dados[0]= $_POST["descricao"];
    $dados[1]= $_POST["cor"];
    $dados[2]= $_POST["tamanho"];
    $dados[3]= $_POST["preco"];
    $dados[4]= $_POST["quantidade"];



        #limpar o valor vindo do post
        $nome = limpaPost($dados[0]);
        $cor = limpaPost($dados[1]);
        $tamanho = limpaPost($dados[2]);
    

    
        #verificar se tem apenas letras
          if ((!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $nome)) || (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $cor)) || (!preg_match("/^[a-zA-Z0-9]*$/", $tamanho)) ) {
    
            if (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/",$nome)) {
                $erroNome = "Apenas aceitamos letras";
                #echo "tem erro nome <br>"; 
            }
                      #verificar se tem apenas letras
            if (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $cor)) {
                $erroCor = "Apenas aceitamos letras";
                #echo "tem erro sobrenome <br>";
            }
                      #verificar se tem apenas letras
            if (!preg_match("/^[a-zA-Z0-9]*$/", $tamanho)) {
                $erroTamanho = "Apenas numeros e letras";
                #echo "tem erro bi <br>";
            }

                 //sweet alert
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Preencha os campos correctamente',
            showConfirmButton: false,
            timer: 1700
        })
        </script>";
            //header("location:../V/registraratleta.php");
        }
        else {
            require("../M/modelo_produto.php");
            cadastrar ($dados);
        }
    }
 
    //função para limpar post 
function limpaPost($valor){
    $valor=trim($valor);
    $valor=  stripcslashes($valor);
    $valor= htmlspecialchars($valor);
    return $valor;
}



?>

    <div class="corpo">
        <div class="main">

        <!----------------------TABS BOOTSTRAP------------------>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">REGISTRAR PRODUTOS</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">PRODUTOS CADASTRADOS</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div  class="formulario_dashboard"  >  
        <form action="" method="POST">

        <table style="text-align: left;">
            <th> <label for="">Nome</label></th>
            <th> <label for="">Tamanho</label></th>
            <tr>
                 <td> <input type="text" <?php if(!empty($erroNome)){ echo "style='border: 2px solid #ff3b3b;'";}?>  name="descricao" required="" class="input required erro_input" oninput="validarNome()"></td>
                 <td><input type="text" <?php if(!empty($erroTamanho)){ echo "style='border: 2px solid #ff3b3b;'";}?> name="tamanho"required="" class="input required erro_input" oninput="validarTamanho()"></td>
            </tr>

            <th> <label for="">Cor </label></th>
            <th> <label for="">Preço</label></th>
            <tr>
                 <td> <input type="text" <?php if(!empty($erroCor)){ echo "style='border: 2px solid #ff3b3b;'";}?>  name="cor" required=""  class="input required erro_input" oninput="validarSobrenome()"></td>
                 <td><input type="number" name="preco" required=""  class="input required erro_input" oninput="validarNumero()"></td>
            </tr>
            <th> <label for="">Quantidade</label></th>
            <tr>
                 <td><input type="number" name="quantidade" required=""  class="input required erro_input" oninput="validarNumero2()"></td>
            </tr>

              

        </table>
        <input class="btn_registrar" type="submit" value="Registrar"> 
        </form> 
    </div>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

        <!----------------------Tabela de saida------------------>

        <!----------------------Tabela de saida------------------>
        <div class="scroll_tb" >
        <!-- caso tenha dados na tabela executar: -->
        <?php if ($query->rowCount()): ?> 
            <div class="scroll_conteudo2" >
        <table  class="tabela_saida">
            
        <tr class="cabecalho_tabela">
            <th>ID</th>
            <th>Nome</th>
            <th>Cor</th>
            <th>Tamanho</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Adicionado por:</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>

        </tr>
            <?php 
            #________selecionar os dados da tabela 
                $query = $pdo->prepare("select id_produto, descricao, cor, tamanho, preco, quantidade_ext, tb_usuario.nome, data_cadastro from tb_produto INNER JOIN tb_usuario on quantidade_ext >0 and fk_usuario= id_usuario ORDER BY `id_produto` ASC");
                $query->execute();
                $produto =  $query->fetchAll(PDO::FETCH_ASSOC);
            
                #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
            
                for ($i=0; $i < sizeof($produto) ; $i++):
                    $produtoActual = $produto[$i];
            ?>

            <tr class="tbody">
                <td><?php echo $produtoActual["id_produto"]; ?></td>
                <td><?php echo $produtoActual["descricao"]; ?></td>  
                <td><?php echo $produtoActual["cor"]; ?></td>
                <td><?php echo $produtoActual["tamanho"]; ?></td>
                <td><?php echo $produtoActual["preco"]; ?></td>
                <td><?php echo $produtoActual["quantidade_ext"]; ?></td>
                <td><?php echo $produtoActual["nome"]; ?></td>
                <td><?php echo $produtoActual["data_cadastro"]; ?></td>
                <td>
                <?php
                    echo "
                    <a href='produtosEditar.php?id=$produtoActual[id_produto]' class='green'><i class='fa-solid fa-pen '></i></a>
                    <a href='../C/controlo_produtoEliminar.php?id=$produtoActual[id_produto]' class='red'><i class='fa-solid fa-trash-can'></i></a>"
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

const form = document.getElementById('form');
const campos =  document.querySelectorAll('.required');
const spans =  document.querySelectorAll('.span-required');
const emailRegex = /^\w+([-+']\w+)*@\w+([-.]\w+)*$/;
const textRegex = /^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/ ;
const BIRegex = /[^\W\d_]/ 
const numberRegex =  /^\d+$/;
const tamanhoRegex = /^[a-zA-Z0-9]*$/;

/*________validações______ */

    //NOME
    function validarNome() {
        if(!textRegex.test(campos[0].value)){
                setError(0); 
        }
        else{
            removeError(0); 
        } 
    }
    //SOBRENOME
    function validarTamanho() {
        if(!tamanhoRegex.test(campos[1].value)){
            setError(1); 
        }
        else{
            removeError(1); 
        } 
    }
    //BI 
    function validarSobrenome() {
        if(!textRegex.test(campos[2].value)){
                setError(2); 
        }
        else{
            removeError(2); 
        } 
    }
    //numero
    function validarNumero() {
        if(!numberRegex.test(campos[3].value)){
                setError(3); 
        }
        else{
            removeError(3); 
        } 
    }
    //numero2
    function validarNumero2() {
        if(!numberRegex.test(campos[4].value)){
                setError(4); 
        }
        else{
            removeError(4); 
        } 
    }



</script>

<script type="text/javascript" src="../js/bootstrap.js"></script>

</body>
</html>
