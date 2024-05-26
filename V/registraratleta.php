

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
            require("../M/modelo_atleta.php");
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
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">REGISTRAR ATLETA</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">ATLETAS REGISTRADOS</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <!----------------------Registrar atleta form------------------>
        <div  class="formulario_dashboard">  
        <form action="" method="POST" class="forms">
        <table style="text-align: left;">
 
            <th> <label for="">Nome</label></th>
            <th> <label for="">Sobrenome</label></th>
            <tr>
                 <td><input type="text"  <?php if(!empty($erroNome)){ echo "style='border: 2px solid #ff3b3b;'";}?> name="nome" required="" class="input required erro_input" oninput="validarNome()"> </td>
                 <td><input type="text" <?php if(!empty($erroSobrenome)){ echo "style='border: 2px solid #ff3b3b;'";}?> name="sobrenome"required="" class="input required erro_input" oninput="validarSobrenome()"> </td>
            </tr>
            <tr>
                <td><span class="span span-required"></span> </td>
                <td><span class="span span-required"></span> </td>
            </tr>
  

            <th> <label for="">Data de Nascimento</label></th>
            <th> <label for="">Nº do BI</label></th>
            <tr>
                 <td> <input type="date" name="data_nas" required="Ta maluco?"  class="input"></td>
                 <td><input type="text" <?php if(!empty($erroBI)){ echo "style='border: 2px solid #ff3b3b;'";}?> name="bi" required=""  class="input required erro_input" oninput="validarBI()" minlength="14" maxlength="14"></td>
            </tr>
            <th> <label for="">Periodo de Treino</label></th>
            <th> <label for="">Gênero</label></th>
            <tr>
             <td> 
                <select name="turno" id="">
                 <option value="manha">Manhã</option>
                 <option value="tarde">Tarde</option>
                 <option value="noite">Noite</option>
                </select></td>
                <td>
                    <input type="radio" name="genero" value="masculino" required=""> 
                    <label for="">Masculino</label> 
                    <input type="radio" name="genero" value="feminino" required="">
                    <label for="">Femenino</label>
                </td>
            </tr>

            <th> <label for="">Telefone</label></th>
            <th> <label for="">Telefone Alternativo</label></th>
            <tr>
                <td><input type="number"  name="telefone"  required=""  class="input required erro_input" oninput="validarNumero()" minlength="9" maxlength="9"></td>
                <td><input type="number"  name="telefone2" class="input required erro_input" oninput="validarNumero2()" minlength="9" maxlength="9"></td>
            </tr>

            

        </table>
        <input class="btn_registrar" id="submitbutton" type="submit" value="Registrar"> 
        </form> 
    </div>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


        <!----------------------Tabela de saida------------------>
        <div class="scroll_tb" >
            <?php if ($query->rowCount()): ?> 
                <div class="scroll_conteudo2" >
        <table  class="tabela_saida">
            <tr class="cabecalho_tabela">
                <th>ID</th>
                <th>Nome</th>
                <th>Sobreome</th>
                <th>Data Nasc</th>
                <th>Nº BI</th>
                <th>Gênero</th>
                <th>Turno</th>
                <th>Telefone</th>
                <th>Data de cadastro</th>  
                <th>Cadstd por:</th>        
                <th>Ações</th>
            </tr>
            
            <?php 
            #________selecionar os dados da tabela 
                $query = $pdo->prepare("SELECT id_atleta, nome_atleta, tb_atleta.sobrenome, tb_atleta.data_nascimento, bi, tb_atleta.genero, turno, tb_atleta.telefone, tb_atleta.telefone2, data_cadastro, tb_usuario.nome FROM tb_atleta INNER JOIN tb_usuario on fk_usuario = id_usuario ORDER BY `id_atleta` ASC");
                $query->execute();
                $atleta =  $query->fetchAll(PDO::FETCH_ASSOC);
                
                #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
                for ($i=0; $i < sizeof($atleta) ; $i++):
                    $atletaActual = $atleta[$i];
            ?>
            <tr class="tbody">
                <td><?php echo $atletaActual["id_atleta"]; ?></td>
                <td><?php echo $atletaActual["nome_atleta"]; ?></td>  
                <td><?php echo $atletaActual["sobrenome"]; ?></td>   
                <td><?php echo $atletaActual["data_nascimento"]; ?></td>
                <td><?php echo $atletaActual["bi"]; ?></td>
                <td><?php echo $atletaActual["genero"]; ?></td>
                <td><?php echo $atletaActual["turno"]; ?></td>
                <td><?php echo $atletaActual["telefone"]."<br>".$atletaActual["telefone2"]; ?></td>
                <td><?php echo $atletaActual["data_cadastro"]; ?></td>
                <td><?php echo $atletaActual["nome"]; ?></td>
                <td>
                    <?php
                    echo "
                    <a href='registraratletaEditar.php?id=$atletaActual[id_atleta]' class='green'><i class='fa-solid fa-pen '></i></a>
                    <a href='../C/controlo_atletaEliminar.php?id=$atletaActual[id_atleta]' class='red'><i class='fa-solid fa-trash-can'></i></a>"
                    ?>
                </td>
            </tr>
            <?php endfor?>
        </table>
        <?php
        #CASO A TABELA ESTEJA VAZIA,
         else: echo "<h5 style='padding-top:30px; padding-left: 70px; '>NENHUM ATLETA REGISTRADO</h5>";
        
        endif?>
        
        </div> </div>


        </div>
    
    </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script src="../js/sweetalert.js"></script>
<script src="../js/validacao.js"></script>
<script type="text/javascript" src="../js/v.js"></script>
</body>
</html>
