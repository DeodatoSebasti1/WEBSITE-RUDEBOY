
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatibl e" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/all.css">
    <script src="../js/sweetalert.js"></script>  
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../icone/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../icone/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../icone/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../icone/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../icone/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../icone/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../icone/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../icone/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../icone/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../icone/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../icone/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../icone/favicon-16x16.png">
        <link rel="manifest" href="../icone/manifest.json">
        <meta name="msapplication-TileColor" content="">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ff3b3b">	

</head>
<body>

<div class="completo" style="background-image: url(../img/fundo.jpg);    background-repeat: no-repeat;">


        <!--__________________LOGIN__________________-->
        <div  class="formulario_login"  >  
        <form action="" method="POST" id="form">
            <h2>Iniciar Sessão</h2>
            <input type="text" class="input_login required"  name="usuario" placeholder="Digite o E-mail ou Username" oninput="validarusuario()" required> <br>
            <span class="span span-required">Permitido Apenas Nome ou Email</span>
            <input type="password" class="input_login required" minlength="4" maxlength="8"   name="senha" placeholder="Digite a Senha" oninput="validarsenha()" required>
            <span class="span span-required">Senha deve conter mais de 4 caracteres</span>
            <input class="btn_login" type="submit" id="button_login" value="ENTRAR">
        </form>  
        <br>
        <center><a href="index.php">VOLTAR</a></center>  
    </div>

</div>

<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/v.js"></script>
</body>

</html>

<?php
#chamar conexão
require('../M/conecao.php');
if (isset($_POST["usuario"]) && isset($_POST["senha"])) {
    $query = $pdo->prepare("SELECT * FROM tb_usuario WHERE (username=? or email= ?) AND palavrapasse= ?");
    $query->execute(array($_POST["usuario"], $_POST["usuario"], $_POST["senha"]));

    #condiçao para  saber o tipo de usuario

    if ($query->rowcount()) {
        $user = $query->fetchAll(PDO::FETCH_ASSOC)[0]; 
        $_SESSION["usuario"] = $user["nome"];
        $_SESSION["nivel"] =$user["fk_nivel"];
        $_SESSION["id_usuario"] =$user["id_usuario"];    
        //var_dump($user["fk_nivel"]);   

             //sweet alert
             echo "<script>
             Swal.fire({
                 position: 'center',
                 icon: 'success',
                 title: 'Sessão autorizada',
                 showConfirmButton: false,
                 timer: 1000
             })
             </script>";

        //redirecionar
        echo "   
        <script>
                setTimeout(function(){
                window.location.href='paineladmin.php';
                }, 1000);               
         </script> ";

      # header("location:paineladmin.php");
        
    } else {
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Dados Incorrectos',
            showConfirmButton: false,
            timer: 1200
        })
        </script>";
    }
     
} else {
    
}

?>