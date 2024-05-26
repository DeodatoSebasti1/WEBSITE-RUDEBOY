<div class="barralateral">
        <ul>
            <li> <a href="paineladmin.php"><i class="fa-sharp fa-solid fa-house"></i>Painel Principal</a></li>
            <li> <a href="registraratleta.php"><i class="fa-solid fa-person-running"></i>Registrar Atletas</a></li>
            <?php if($_SESSION["nivel"]==1){ ?>
            <li> <a href="produtos.php"><i class="fas fa-dumbbell"></i>Produtos</a></li>
            <?php }?>
            <li> <a href="pagamentos.php"><i class="fas fa-comments-dollar"></i>Pagamentos</a></li>
            <li> <a href="vendas.php"><i class="fas fa-shopping-cart"></i>Vendas</a></li>
            <?php if($_SESSION["nivel"]==1){ ?>
            <li> <a href="stock.php"><i class="fas fa-boxes"></i>Stock</a></li>
            <?php }?>
            <?php if($_SESSION["nivel"]==1){ ?>
            <li> <a href="usuarios.php"><i class="fas fa-users"></i>Usuários</a></li>
            <?php }?>
            <li> <a href="definicoes.php"><i class="fas fa-tools"></i>Definições</a></li>
        </ul>
    </div >