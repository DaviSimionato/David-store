<header>
        <div class="header">
            <span class="material-symbols-outlined menuLateral">menu</span>
            <img src="imgs/svg/logo-no-background.svg" alt="Logo" height="20">
            <div class="barraPesquisa">
                <input type="text" name="pesquisa" class="pesqBar" placeholder="Busque aqui">
                <a href="#"><span class="material-symbols-outlined" title="Pesquisar">search</span></a>
            </div>
            <?php 
                if(isset($_SESSION["user"])) {

                }else {
                    echo "
                    <div class='entrarOuCad'>
                        <span class='material-symbols-outlined'>account_circle</span>
                        <p><strong><a href='#'>Entrar</a></strong> ou <strong><a href='#'>Cadastre-se</a></strong></p>
                    </div>
                    ";
                }
            ?>
            <div class="linksUser">
                <a href="#"><span class="material-symbols-outlined fav" title="Favoritos">favorite</span></a>
                <a href="#"><span class="material-symbols-outlined" title="Carrinho">shopping_cart</span></a>
            </div>
        </div>
</header>