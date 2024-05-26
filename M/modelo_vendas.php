<?php


function cadastrar ($dados)
{
    require("../C/cabe_sweetalert.php");
    require("conecao.php");
    var_dump($dados);
    echo "<br>".$_SESSION["id_usuario"];
    $query ="INSERT INTO tb_atleta (fk_usuario,nome_atleta,sobrenome,bi,data_nascimento,genero,telefone,telefone2,turno) 
    VALUE('$_SESSION[id_usuario]','$dados[0]', '$dados[1]','$dados[2]','$dados[3]','$dados[4]','$dados[5]','$dados[6]',
    '$dados[7]')";
    $pdo->exec($query);

}  

?>


