

<?php 
    include("cabecalhodashboard.php");
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
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Alterar Configurações</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <div  class="formulario_dashboard"  >  
        <form action="../C/controlo_definicoes.php" method="POST" enctype="multipart/form-data">

        <table>
        <th> <label for="">Carregar Foto de Perfil</label></th>
            <tr>  
                <td> 
                    <input type="file" name="arquivo" required="" accept="image/png, image/jpeg" class="file">
                 <input class="btn_atualizarfoto" type="submit" value="Confirmar"> 
                </td>    
            </tr>
        </table>
        </form> 



        <button class="btn_alterar_senha" onclick="toggle()">Alterar Minha Senha</button>


    
        <form action="../C/controlo_definicoesenha.php" method="POST" id="alterar_senha" style="display: none">
        <table style="text-align: left;">
            <th> <label for="">Palavra Passe Antiga</label></th>
            <tr>
                 <td><input type="password" minlength="4" maxlength="8"  name="senha_antiga" required="" class="input required erro_input" oninput="validarsenha1()"></td>
            </tr>
            <tr>
                 <td><span class="span span-required">Minimo 4 e maximo 8 digitos</span></td>
            </tr>
            <th> <label for="">Palavra Passe Nova</label></th>
            <th> <label for="">Repetir Palavra Passe</label></th>
            <tr>
                 <td> <input type="password" minlength="4" maxlength="8"  name="senha_nova" required=""  class="input required erro_input" oninput="validarsenha()"></td>
                 <td><input type="password" minlength="4" maxlength="8"  name="repetir_senha" required=""  class="input required erro_input" oninput="validarsenha()"></td>
            </tr>
            <tr>
                 <td><span class="span span-required">Digite senhas Iguais</span></td>
                 <td><span class="span span-required">Digite senhas Iguais</span></td>
            </tr>
        </table>
        <input class="btn_registrar" type="submit" value="Atualizar Senha"> 

        </form> 
    </div>

        </div>

        </div>
    </div>

    <script>
        function toggle(){
            var x = document.getElementById("alterar_senha");

            if (x.style.display ==="none") {
                x.style.display ="block";
            } else {
                x.style.display ="none";
            }
        }
    </script>
    <!--_______________________________VALIDAÇÃO D CAMPOS________________ -->
    <script>
        const campos =  document.querySelectorAll('.required');
        const spans =  document.querySelectorAll('.span-required');

        //SENHAA
        function validarsenha1() {
                if((campos[0].value.length) >= 4 ){

                    removeError(0); 
                }
                else{ 
                    setError(0); 
                } 
            }

        //SENHAA
            function validarsenha() {
                if((campos[1].value) == (campos[2].value) ){
                    removeError(1); 
                    removeError(2);
                }
                else{ 
                    setError(1); 
                    setError(2); 
                } 
            }

            function setError(index) {
                campos[index].style.border= '2px solid red';
                spans[index].style.display= 'block';
            }
            //retirar
            function removeError(index) {
                campos[index].style.border= '2px solid rgb(0, 205, 7)';
                spans[index].style.display= 'none';
            }
    </script>
</div>
<script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>
