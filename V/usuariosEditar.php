

<?php 
    include("cabecalhodashboard.php");
    error_reporting(E_ALL^E_NOTICE);
?>

<!---------------conteúdo---------->
<div class="conteudo">

<?php 
    include("barralateral.php");


    $erroNome = "";
    $erroSobrenome = "";
    $erroSenha = "";
    $erroRedpetirsenha = "";
    //__________________________________VALIDAÇÃO DE FORMULARIO___________________
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    #dados
    $dados[0]= $_POST["nivel"];
    $dados[1]= $_POST["nome_user"];
    $dados[2]= $_POST["sobrenome"];
    $dados[3]= $_POST["data_nas"];
    $dados[4]= $_POST["genero"];
    $dados[5]= $_POST["telefone"];
    $dados[6]= $_POST["telefone2"];
    $dados[7]= $_POST["nome_user"];
    $dados[8]= $_POST["email"];
    $dados[9]= $_POST["senha"];
    $_POST["repetir_senha"];

        #limpar o valor vindo do post
        $nome = limpaPost($dados[1]);
        $sobrenome = limpaPost($dados[2]);
        $senha = limpaPost($dados[9]);
        $repetir_senha = limpaPost($_POST["repetir_senha"]);
    
        #verificar se tem apenas letras
          if ((!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $nome)) || (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $sobrenome)) || ($senha != $repetir_senha)) {
    
            if (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/",$nome)) {
                $erroNome = "Apenas aceitamos letras";
               # echo "tem erro nome <br>"; 
            }
                      #verificar se tem apenas letras
            if (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $sobrenome)) {
                $erroSobrenome = "Apenas aceitamos letras";
               # echo "tem erro sobrenome <br>";
            }
            if ($senha != $repetir_senha) {

                    $erroSenha = "Apenas aceitamos letras";
                    $erroRedpetirsenha = "Apenas aceitamos letras";
                   # echo "tem erro senha <br>";
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
            require("../C/controlo_usuarioEditar.php");
          // cadastrar ($dados);
           # echo "te amo";
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
            $id_user= $_GET['id'];
            $query = $pdo->prepare("SELECT id_usuario,tb_nivel.descricao, nome, sobrenome, data_nascimento, genero, telefone, telefone2, username, email, palavrapasse, data_registro FROM tb_usuario INNER JOIN tb_nivel on fk_nivel=id_nivel where id_usuario =  $id_user  ");
            $query->execute();
            $resultado = $query-> fetchAll(PDO::FETCH_ASSOC); 
            
            //var_dump ($resultado); 
            
            if ($query->rowCount()) {
                for ($i=0; $i < sizeof($resultado); $i++) { 
                    $resultado_Actual = $resultado[$i];
                    echo "<br><br>";
                    $nome_usuario = $resultado_Actual["nome"];
                    $sobrenome = $resultado_Actual["sobrenome"]; 
                    $senha = $resultado_Actual["palavrapasse"]; 
                    $nivel = $resultado_Actual["descricao"];
                    $genero = $resultado_Actual["genero"];
                    $data_nasc = $resultado_Actual["data_nascimento"];
                    $genero = $resultado_Actual["genero"];     
                    $email = $resultado_Actual["email"];
                    $telefone = $resultado_Actual["telefone"];
                    $telefone2 = $resultado_Actual["telefone2"];
                }
                $_SESSION['cod_user'] =  $id_user;

            }
            else {
                echo "n existe";
            }

            #$_SESSION['id_user'] =  $id_user;
            #var_dump($nome);

        } else {
            //echo "vazio";
        }
?>  

    <div class="corpo">
        <div class="main">

        <!----------------------TABS BOOTSTRAP------------------>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">EDITAR USUÁRIO</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div  class="formulario_dashboard"  >  
        <form action="" method="POST">

        <table style="text-align: left;">
            <th> <label for="">Nome</label></th>
            <th> <label for="">Sobrenome</label></th>
            <tr>
                 <td> <input type="text" name="nome_user" <?php if(!empty($erroNome)){ echo "style='border: 2px solid #ff3b3b;'";}?>  required="" class="input required erro_input" oninput="validarNome()"value="<?php echo $nome_usuario ?>" ></td>
                 <td><input type="text" <?php if(!empty($erroSobrenome)){ echo "style='border: 2px solid #ff3b3b;'";}?> name="sobrenome"required="" class="input required erro_input" oninput="validarSobrenome()" value="<?php echo $sobrenome ?>" ></td>
            </tr>

            <th> <label for="">Senha</label></th>
            <th> <label for="">Repetir Senha</label></th>
            <tr>
                 <td> <input type="text" minlength="4" maxlength="8"  <?php if(!empty($erroSenha)){ echo "style='border: 2px solid #ff3b3b;'";}?>  name="senha" required="" class="input required erro_input" oninput="validarsenha()" value="<?php echo $senha ?>" ></td>
                 <td><input type="text" minlength="4" maxlength="8"  <?php if(!empty($erroRedpetirsenha)){ echo "style='border: 2px solid #ff3b3b;'";}?>  name="repetir_senha"required="" class="input required erro_input" oninput="validarsenha()"value="<?php echo $senha ?>" ></td>
            </tr>

            <th> <label for="">Nivel de acesso</label></th>
            <th> <label for="">Gênero</label></th>
            <tr>
             <td> 
                <select name="nivel" id="nivel" class="select" required=""> 
                <option required=""></option>
                            <!-- caso tenha dados na tabela executar: -->
             <?php if ($query->rowCount()): ?> 
                <?php 
            #________selecionar os dados da tabela 
                $query = $pdo->prepare("SELECT * FROM tb_nivel");
                $query->execute();
                $nivel =  $query->fetchAll(PDO::FETCH_ASSOC);
            
                #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
                for ($i=0; $i < sizeof($nivel) ; $i++):
                    $nivelActual = $nivel[$i];
            ?>
                
                <option value="<?php echo $nivelActual["id_nivel"]; ?>"><?php echo $nivelActual["descricao"]; ?></option>
                <?php endfor?>
                <?php endif?>
                </select></td>

                <td>
                    <input type="radio" name="genero" value="masculino" required="" <?php echo ($genero =='masculino') ? 'checked': '' ?> > 
                    <label for="">Masculino</label> 
                    <input type="radio" name="genero" value="feminino" required="" <?php echo ($genero =='feminino') ? 'checked': '' ?>>
                    <label for="">Femenino</label>
                </td>
            </tr>

            <th> <label for="">Data de Nascimento</label></th>
            <th> <label for="">Email</label></th>
            <tr>
                <td><input type="date"  name="data_nas"  required=""  class="input" value="<?php echo $data_nasc; ?>"></td>
                <td><input type="email"  name="email"  required=""  class="input required erro_input" oninput="validarEmail()" value="<?php echo $email ?>"></td>
            </tr>

            <th> <label for="">Telefone</label></th>
            <th> <label for="">Telefone Alternativo</label></th>
            <tr>
                <td><input type="tel"  name="telefone" class="input required erro_input" oninput="validarNumero()" minlength="9" maxlength="9" value="<?php echo $telefone ?>"></td>
                <td><input type="tel"  name="telefone2"  required=""  class="input required erro_input" oninput="validarNumero2()" minlength="9" maxlength="9" value="<?php echo $telefone2 ?>"></td>
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

}
//retirar
function removeError(index) {
    campos[index].style.border= '2px solid rgb(0, 205, 7)';

}
//____________________CONST FORMULARIOS__________________________
//const form = document.getElementById('form');

//_________________________________________VALIDAR LOGIN__________________________________
    
const form = document.getElementById('form');
const campos =  document.querySelectorAll('.required');
const spans =  document.querySelectorAll('.span-required');
const emailRegex = /^\w+([-+']\w+)*@\w+([-.]\w+)*$/;
const textRegex = /^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/;
const BIRegex = /[^\W\d_]/ 
const numberRegex =  /^\d+$/;
const tamanhoRegex = /^[a-zA-Z0-9_.-]*$/;

//_________________________________________VALIDAR CAmpos__________________________________

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
    function validarSobrenome() {
        if(!textRegex.test(campos[1].value)){
            setError(1); 
        }
        else{
            removeError(1); 
        } 
    }
            //SENHA
            function validarsenha() {
                if((campos[2].value) == (campos[3].value) ){
                    
                    removeError(2)
                    removeError(3)
                
                }
                else{ 
                    setError(2)
                    setError(3)
                    
                } 
            }

    //numero
    function validarEmail() {
        if(!emailRegex.test(campos[4].value)){
                setError(4); 
        }
        else{
            removeError(4); 
        } 
    }
    //numero
    function validarNumero() {
        if(!numberRegex.test(campos[5].value)){
                setError(5); 
        }
        else{
            removeError(5); 
        } 
    }
    //numero2
    function validarNumero2() {
        if(!numberRegex.test(campos[6].value)){
                setError(6); 
        }
        else{
            removeError(6); 
        } 
    }
            
    </script>

<script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>
