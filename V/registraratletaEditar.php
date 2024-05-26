

<?php 
    include("cabecalhodashboard.php");
    error_reporting(E_ALL^E_NOTICE);
?>

<!---------------conteúdo---------->
<div class="conteudo">

<?php 
    include("barralateral.php");

    $query = $pdo->prepare("SELECT * FROM tb_atleta");
    $query->execute();
    $atleta = $query-> fetchAll();

    $erroNome = "";
    $erroSobrenome = "";
    $erroBI = "";

        //__________________________________VALIDAÇÃO DE FORMULARIO___________________
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
            #dados
            $dados[0]= $_POST["nome"];
            $dados[1]= $_POST["sobrenome"];
            $dados[2]= $_POST["bi"];
            $dados[3]= $_POST["data_nas"];
            $dados[4]= $_POST["genero"];
            $dados[5]= $_POST["telefone"];
            $dados[6]= $_POST["telefone2"];
            $dados[7]= $_POST["turno"];    
        
        
        
                #limpar o valor vindo do post
                $nome = limpaPost($dados[0]);
                $sobrenome = limpaPost($dados[1]);
                $bi = limpaPost($dados[2]);
            
        
            
                #verificar se tem apenas letras
                  if ((!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $nome)) || (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $sobrenome)) || (!preg_match("/\d{9}[A-Z]{2}\d{3}/", $bi)) ) {
            
                    if (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/",$nome)) {
                        $erroNome = "Apenas aceitamos letras";
                        #echo "tem erro nome <br>"; 
                    }
                              #verificar se tem apenas letras
                    if (!preg_match("/^[a-zA-Z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ']*$/", $sobrenome)) {
                        $erroSobrenome = "Apenas aceitamos letras";
                        #echo "tem erro sobrenome <br>";
                    }
                              #verificar se tem apenas letras
                    if (!preg_match("/\d{9}[A-Z]{2}\d{3}/", $bi)) {
                        $erroBI = "Apenas numeros e letras";
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
                    require("../c/controlo_atletaEditar.php");
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
            $id_at= $_GET['id'];
            $query = $pdo->prepare("SELECT * FROM tb_atleta where id_atleta=$id_at");
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

            $_SESSION['id_atleta'] = $id_at;
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
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">EDITAR DADOS DO ATLETA</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <!----------------------Registrar atleta form------------------>
        <div  class="formulario_dashboard">  
        <form action="" method="POST">
        <table style="text-align: left;">

            <th> <label for="">Nome</label></th>
            <th> <label for="">Sobrenome</label></th>
            <tr>
                 <td> <input type="text" <?php if(!empty($erroNome)){ echo "style='border: 2px solid #ff3b3b;'";}?>  name="nome" required="" class="input required erro_input" oninput="validarNome()" value="<?php echo $nome_atleta; ?>"></td>
                 <td><input type="text" <?php if(!empty($erroSobrenome)){ echo "style='border: 2px solid #ff3b3b;'";}?>  name="sobrenome"required="" class="input required erro_input" oninput="validarSobrenome()" value="<?php echo $sobrenome; ?>"></td>
            </tr>

            <th> <label for="">Data de Nascimento</label></th>
            <th> <label for="">Nº do BI</label></th>
            <tr>
                 <td> <input type="date" name="data_nas" required="Ta maluco?"  class="input" value="<?php echo $data_nasc; ?>"></td>
                 <td><input type="text" name="bi" <?php if(!empty($erroBI)){ echo "style='border: 2px solid #ff3b3b;'";}?>  required=""  class="input required erro_input" oninput="validarBI()" minlength="14" maxlength="14" value="<?php echo $bi; ?>"></td>
            </tr>

            <th> <label for="">Periodo de Treino</label></th>
            <th> <label for="">Gênero</label></th>
            <tr>
             <td> 
                <select name="turno" id="">
                 <option value="manha" <?php echo ($turno =='manha') ? 'selected': '' ?>>Manhã</option>
                 <option value="tarde" <?php echo ($turno =='tarde') ? 'selected': '' ?>>Tarde</option>
                 <option value="noite" <?php echo ($turno =='noite') ? 'selected': '' ?>>Noite</option>
                </select></td>
                <td>
                    <input type="radio" name="genero" value="masculino" required="" <?php echo ($genero =='masculino') ? 'checked': '' ?> > 
                    <label for="">Masculino</label> 
                    <input type="radio" name="genero" value="feminino" required="" <?php echo ($genero =='feminino') ? 'checked': '' ?>>
                    <label for="">Femenino</label>
                </td>
            </tr>

            <th> <label for="">Telefone</label></th>
            <th> <label for="">Telefone Alternativo</label></th>
            <tr>
                <td><input type="tel"  name="telefone"  required="" class="input required erro_input" oninput="validarNumero()" minlength="9" maxlength="9" value="<?php echo $telefone; ?>"></td>
                <td><input type="tel"  name="telefone2" class="input required erro_input" oninput="validarNumero2()" minlength="9" maxlength="9" value="<?php echo $telefone2; ?>"></td>
            </tr>

        </table>
        <input class="btn_registrar" type="submit" value="Guardar" href="V/registraratleta.php"> 
        </form> 
    </div>




        </div>
    
    </div>


        </div>
    </div>
</div>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/v.js"></script>
</body>
</html>
