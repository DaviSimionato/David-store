<?php
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(!isset($_SESSION["user"])) {
        header("Location: entrar.php");
    }
    $userId = $_SESSION['user']->idUsuario;
    $buscaHistorico = $bd->query("select * from vwProdutosHistorico
    where idUsuario = $userId order by codHist desc limit 25");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs/davidstore-icon.ico" type="image/ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>Meu perfil</title>
</head>
<body style="background-color:#F2F3F4;">
    <?php 
        include_once("includes/header.php");
    ?>
    <section style="width: 1430px;" class="container1400">
        <div class="userIntro">
            <div class="infoUser">
                <span style="font-size: 60px;margin: 0 20px" class="material-symbols-outlined">account_circle</span>
                <?php 
                    echo "
                    <div class='bemVindo'>
                        <h2 style='margin:0'>Bem vindo, {$_SESSION['user']->nomeUsuario}</h2>
                        <div class='emailUsuario'>
                            <span style='font-size: 16px;margin-right:5px' class='material-symbols-outlined'>mail</span>
                            <p style='margin:0'>{$_SESSION['user']->email}</p>
                        </div>
                    </div>
                    ";
                ?>
            </div>
            <div class="configConta">
                <a href='configConta.php'>
                    <span style='font-size: 50px;margin-right:30px;margin-top:10px' class='material-symbols-outlined config'>settings</span>
                </a>
            </div>
        </div>
        <div class="itensAcesso">
            <div class="acessConta">
                <a href="pedidos.php">
                    <span style="margin-bottom: 5px;" class="material-symbols-outlined">
                        shopping_basket
                    </span>
                    <p>Meus pedidos</p>
                </a>
            </div>
            <div class="acessConta">
                <a href="favoritos.php">
                    <span class="material-symbols-outlined">
                        favorite
                    </span>
                    <p>Favoritos</p>
                </a>
            </div>
            <div class="acessConta">
                <a href="reviewsUser.php">
                    <span class="material-symbols-outlined">
                        thumb_up
                    </span>
                    <p>Avaliações</p>
                </a> 
            </div>
        </div>
    </section>
    <section style="margin-top:30px" class="sectionProds container1400">
        <?php 
            echo "
            <div class='sectionTopic'>
                <h2 style='text-transform: uppercase; margin-bottom: 0' class='tituloSection'>Produtos vistos recentemente</h2>
                <span style='margin-top: 15px;' class='material-symbols-outlined'>history</span>
            </div>
            <div class='produtosHistorico'>
                <div class='ant'>
                    <span class='material-symbols-outlined'>navigate_before</span>
                </div>
            ";
            while($prodHist = $buscaHistorico->fetch_object()) {
                echo "
                    <div class='produtos prodHist' title='{$prodHist->nome}'>
                        <a href='produto.php?{$prodHist->nome}&c={$prodHist->codigo}'>
                        <img src='{$prodHist->imagemProduto}' alt=' width='268' height='162'>
                        <p class='nome'>{$prodHist->nome}</p>
                        <div class='infoPreco'>
                            <p class='preco'>{$prodHist->precoAvista}</p>
                            <p class='avisoPix'>À vista no PIX</p>
                        </div>
                        </a>
                        <a href='includes/addCarrinho.php?c={$prodHist->codigo}&preCarrinho=1' class='comprar'>COMPRAR</a>
                    </div>
                    ";
            }
            echo "
                <div class='prox'>
                    <span class='material-symbols-outlined'>navigate_next</span>
                </div>
            </div>
            ";
        ?>
    </section>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
    <script src="js/sliderHist.js"></script>
</body>
</html>