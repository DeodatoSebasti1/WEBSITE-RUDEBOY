
<?php

session_start();
//$_SESSION["id_mes"];
//Configurações
$servidor="localhost";
$usuario="root";
$senha="";
$banco="rudeboy";

//__________________________Conexão______________________

try {
    $pdo= new  PDO("mysql: host=$servidor;dbname=$banco",$usuario,$senha);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

} catch (PDOException $erro) {
    echo "OCORREU UM ERRO DE CONEXÃO{$erro->getMessage()}";
    $pdo= null;
}
?>