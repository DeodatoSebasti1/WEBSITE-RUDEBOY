<?php 
     include("cabecalhodashboard.php");
     //session_start();
     /*var_dump($_SESSION["id_usuario"]);
     var_dump($_SESSION["usuario"]);
     var_dump($_SESSION["nivel"]);*/
?>





<!---------------conteúdo---------->
<div class="conteudo">


<?php 
     include("barralateral.php");
?>
    <div class="corpo">
        <div class="main">
            <!----------------------Principal------------------>
            <div class="principal"> 
                <div class="conteudo centro">

                <div class="resumo2">
                <h4>Atletas Cadastrados</h4>
                        <?php 
                            $query = $pdo->prepare("SELECT COUNT(*) FROM tb_atleta");
                            $query->execute();
                            $contar_atletas = $query-> fetchColumn();
                            echo "<h1>$contar_atletas</h1>";
                        ?>

                    </div>
                    
                    <div class="resumo2">
                                                <h4>Produtos Registrados</h4>
                        <?php 
                            $query = $pdo->prepare("SELECT COUNT(*) FROM tb_produto");
                            $query->execute();
                            $contar_produto = $query-> fetchColumn();
                            echo "<h1>$contar_produto</h1>";
                        ?>

                    </div>

                <!--Card ultimo post-->
                </div>
            </div>
            <!----------------------Produtos------------------>

            <div class="conteudo centro"> 

            <div class="resumo">
                    <h4>Total de Pagamentos</h4>
                        <?php 
                            $query = $pdo->prepare("SELECT COUNT(*) FROM tb_pagamento");
                            $query->execute();
                            $contar_pagamentos = $query-> fetchColumn();
                            echo "<h1>$contar_pagamentos</h1>";
                        ?>
            </div>

            <div class="resumo">
            <h4>Produtos Vendidos</h4>
                        <?php 
                            $query = $pdo->prepare("SELECT COUNT(*) FROM tb_venda");
                            $query->execute();
                            $contar_vendas = $query-> fetchColumn();
                            echo "<h1>$contar_vendas</h1>";
                        ?>

             </div>


             <div class="resumo">
             <h4> Total de Usuários</h4> 
                        <?php 
                            $query = $pdo->prepare("SELECT COUNT(*) FROM tb_usuario");
                            $query->execute();
                            $contar_usuarios = $query-> fetchColumn();
                            echo "<h1>$contar_usuarios</h1>";
                        ?>
                </div> 
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>