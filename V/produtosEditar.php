

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
            require("../C/controlo_produtoEditar.php");
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

<!--___________________RETORNAR OS DADOS DA TABELA NO FORMULARIO____________-->

<?php 
        //reficara se o Id existe
        if (!empty($_GET['id'])) { 
            $id_prod= $_GET['id'];
            $query = $pdo->prepare("SELECT * FROM tb_produto where id_produto=$id_prod");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 
            
            //var_dump ($resultado); 
            
            if ($query->rowCount()) {
                for ($i=0; $i < sizeof($resultado); $i++) { 
                    $resultado_Actual = $resultado[$i];
                    echo "<br><br>";
                    $descricao = $resultado_Actual["descricao"];
                    $tamanho = $resultado_Actual["tamanho"]; 
                    $cor = $resultado_Actual["cor"];
                    $preco = $resultado_Actual["preco"];
                    $quantidade = $resultado_Actual["quantidade_ext"];
                }

            $_SESSION['id_produto'] = $id_prod;
            }
            else {
                echo "n existe";
            }

        } 
?>  

    <div class="corpo">
        <div class="main">

        <!----------------------TABS BOOTSTRAP------------------>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">EDITAR PRODUTOS</button>
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
                 <td> <input type="text" <?php if(!empty($erroNome)){ echo "style='border: 2px solid #ff3b3b;'";}?>  name="descricao" required="" class="input required erro_input" oninput="validarNome()" value="<?php echo $descricao ?>"></td>
                 <td><input type="text" <?php if(!empty($erroTamanho)){ echo "style='border: 2px solid #ff3b3b;'";}?>  name="tamanho"required="" class="input required erro_input" oninput="validarTamanho()" value="<?php echo $tamanho ?>"></td>
            </tr>

            <th> <label for="">Cor </label></th>
            <th> <label for="">Preço</label></th>
            <tr>
                 <td> <input type="text" name="cor" <?php if(!empty($erroCor)){ echo "style='border: 2px solid #ff3b3b;'";}?>  required=""  class="input required erro_input" oninput="validarSobrenome()" value="<?php echo $cor ?>"></td>
                 <td><input type="number" name="preco" required=""  class="input required erro_input" oninput="validarNumero()" value="<?php echo $preco ?>"></td>
            </tr>
            <th> <label for="">Quantidade</label></th>
            <tr>
                 <td><input type="number" name="quantidade" required=""  class="input required erro_input" oninput="validarNumero2()" value="<?php echo $quantidade ?>"></td>
            </tr>

              

        </table>
        <input class="btn_registrar" type="submit" value="Guardar"> 
        </form> 
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
const textRegex = /^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/;
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
