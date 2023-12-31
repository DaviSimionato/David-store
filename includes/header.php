<?php 
    require_once("banco.php");
    require_once("login.php");
    include_once("menuLateral.php");
    $carrinhoAlert = "";
    if(isset($_SESSION['user'])) {
        $carrinhoAlertTest = $bd->query("select idUsuario from carrinho where idUsuario = {$_SESSION['user']->idUsuario}");
        if($carrinhoAlertTest->num_rows != 0) {
            $carrinhoAlert = "carrinhoIco";
        }
    }
?>
<header>
        <div class="header">
            <span class="material-symbols-outlined menuLateral">menu</span>
            <a href="index.php"><img src="imgs/svg/logo-no-background.svg" alt="Logo" height="20"></a>
            <div class="barraPesquisa">
                <form action="pesquisa.php" method="get" autocomplete="off">
                    <input type="text" name="pesquisa" class="pesqBar" placeholder="Busque aqui">
                    <a href="submit"><span class="material-symbols-outlined" title="Pesquisar">search</span></a>
                </form>
            </div>
            <?php 
                if(isset($_SESSION["user"])) {
                    echo "
                    <div class='entrarOuCad'>
                        <span class='material-symbols-outlined'>account_circle</span>
                        <div class='sessionInfo'>
                            <p>
                                Olá, {$_SESSION['user']->nomeUsuario}
                            </p>
                            <p><strong><a href='minhaConta.php'>MINHA CONTA</a></strong> | <strong><a href='includes/sair.php'>SAIR</a></strong></p>
                        </div>
                    </div>
                    ";  
                }else {
                    echo "
                    <div class='entrarOuCad'>
                        <span class='material-symbols-outlined'>account_circle</span>
                        <p><strong><a href='entrar.php'>Entrar</a></strong> ou <strong><a href='cadastrar.php'>Cadastre-se</a></strong></p>
                    </div>
                    ";
                }
            echo "
            <div class='linksUser'>
                <a href='favoritos.php'><span class='material-symbols-outlined fav' title='Favoritos'>favorite</span></a>
                <a href='carrinho.php'><span class='material-symbols-outlined fav $carrinhoAlert' title='Carrinho'>shopping_cart</span></a>
            </div>
            ";
            ?>
        </div>
        <script src="js/menuLateral.js"></script>
</header>