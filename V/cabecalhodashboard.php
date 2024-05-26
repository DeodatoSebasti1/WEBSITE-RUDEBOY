<?php
 require("../M/conecao.php");


 if (isset($_SESSION["usuario"])) {
    $nome= $_SESSION["usuario"];
    $nivel= $_SESSION["nivel"];
    $id= $_SESSION["id_usuario"];


    $query = $pdo->prepare("SELECT descricao FROM `tb_nivel` WHERE id_nivel = $nivel");
    $query->execute(array($_SESSION["id_usuario"]));

    if ($query->rowcount()) {
        $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        $nivel = $user["descricao"];       
        
    } 
 }
?>

<?php  

        #MOSTRAR A FOTO DO PERFIL 

        #________selecionar os dados da tabela usuario 
        $query = $pdo->prepare("SELECT * FROM tb_usuario WHERE id_usuario = $id");
        $query->execute();
        $foto =  $query->fetchAll(PDO::FETCH_ASSOC);
        
            #estrutura de repetição para adicionar uma linha a cada vez q um dado por adicionado na tabela
            for ($i=0; $i < sizeof($foto) ; $i++):
                $fotoActual = $foto[$i];
        ?>
        <?php endfor?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bem-vindo <?php echo $nivel?> </title>
    <link rel="stylesheet" href="../css/estilo2.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/all.css">
    <script src="../js/sweetalert.js"> </script>
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

<!-----------BARRA DE MENU-------------->    
<div class="menu">

          <img src="<?php echo $fotoActual["foto"]; ?>" width="60" height="60" class="img_menu"> 

    <div class="texto_menu">
    <h4>  <?php echo $nome; ?> </h4>
    <h5 > <?php echo $nivel; ?> </h5>
    </div>
    
    <div>
    <img src="../img/logo.jpg" class="img_logo">
    </div>
        
    <form action="">
    <div style="" >
    <span>
    <?php if(isset($_SESSION["car"])){ ?>
        <a href="carrinho.php" style="margin-right:20px; border:none;">
            <i class="fas fa-shopping-cart"></i>
            <sup><?= count($_SESSION["car"]) ?></sup>
        </a>
    <?php }?>
</span>

        <a href="terminar.php">TERMINAR</a>

    </div>
    </form>
</div>
