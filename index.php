<?php 
    require_once("includes/login.php");
    require_once("includes/banco.php");
    $buscaProdutosRecomendados = $bd->query("select * from vwProdutosRecomendados");
    $buscaProdutosMaisAces = $bd->query("select * from vwProdutos order by acessos desc limit 30");
    $buscaDepartamentos = $bd->query("select * from departamentos");
    $buscaMarcas = $bd->query("select * from vwmarcasRecomendadas limit 6");
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
    <title>David'store</title>
</head>
<body style="background-color: #D7E1E0;">
    <?php include_once("includes/header.php");?>
    <div class="bannerIntro">
            <a href="pesquisa.php?pesquisa=TV"><img src="imgs/svg/bannerIndex.svg" alt="banner"></a>
    </div>
    <section class="introIndex">
        <div class="container1400"> 
            <div class="recomendBar">
                <h2 class="tituloSection">RECOMENDADO</h2>
            </div>
            <div class="recomendadosProdutos">
                <div class="ant">
                    <span class="material-symbols-outlined">navigate_before</span>
                </div>
                <a href=''></a>
                <?php 
                    while($prod = $buscaProdutosRecomendados->fetch_object()) {
                        echo "
                        <div class='produtos prodRec' title='{$prod->nome}'>
                            <a href='produto.php?n={$prod->nome}&c={$prod->codigo}'>
                            <img src='{$prod->imagemProduto}' alt=' width='268' height='162'>
                            <p class='nome'>{$prod->nome}</p>
                            <div class='infoPreco'>
                                <p class='preco'>{$prod->precoAvista}</p>
                                <p class='avisoPix'>À vista no PIX</p>
                            </div>
                            </a>
                            <a href='#' class='comprar'>COMPRAR</a>
                        </div>
                        ";
                    }
                ?>
                <div class="prox">
                    <span class="material-symbols-outlined ">navigate_next</span>
                </div>
            </div>
        </div>
        <a href="pesquisa.php?pesquisa=TV"><img src="imgs/svg/bannerRecomend.svg" alt="banner" class="banner"></a>
        <div class="sectionTopic">
                <h2 style="text-transform: uppercase;" class="tituloSection">Marcas Recomendadas</h2>
                <span class="material-symbols-outlined">thumb_up</span>
        </div>
        <div class="marcasRecomendadas container1330">
            <?php 
                while($marca = $buscaMarcas->fetch_object()) {
                    echo "
                        <div class='marca'>
                            <h2>{$marca->nome}</h2>
                            <img src='{$marca->foto}' alt='{$marca->nome}'>
                        </div>
                    ";
                }
            ?>
        </div>
        <div class="sectionTopic">
                <h2 style="text-transform: uppercase;" class="tituloSection">Departamentos</h2>
                <span class="material-symbols-outlined">lists</span>
        </div>
        <div class="departamentos container1330 ">
            <?php 
                while($dep = $buscaDepartamentos->fetch_object()) {
                    echo "
                        <div class='departamento'>
                            <a href='#'>
                            <h2>{$dep->departamento}</h2>
                            <img src='{$dep->foto}' alt='{$dep->departamento}'>
                            </a>
                        </div>
                    ";
                }
            ?>
        </div>
        <img src="imgs/svg/bannerAcer.svg" alt="banner" class="banner">
        <div class="sectionTopic">
                <h2 style="text-transform: uppercase; margin-bottom: 0" class="tituloSection">Produtos mais acessados</h2>
                <span style="margin-top: 15px;" class="material-symbols-outlined">ads_click</span>
        </div>
        <div class="produtosMaisAcessados">
            <div class="ant">
                <span class="material-symbols-outlined">navigate_before</span>
            </div>
            <?php 
                while($prodMaisAces = $buscaProdutosMaisAces->fetch_object()) {
                    echo "
                        <div class='produtos prodMA' title='{$prodMaisAces->nome}'>
                            <a href='produto.php?n={$prodMaisAces->nome}&c={$prodMaisAces->codigo}'>
                            <img src='{$prodMaisAces->imagemProduto}' alt=' width='268' height='162'>
                            <p class='nome'>{$prodMaisAces->nome}</p>
                            <div class='infoPreco'>
                                <p class='preco'>{$prodMaisAces->precoAvista}</p>
                                <p class='avisoPix'>À vista no PIX</p>
                            </div>
                            </a>
                            <a href='#' class='comprar'>COMPRAR</a>
                        </div>
                        ";
                    }
                ?>
            <div class="prox">
                <span class="material-symbols-outlined">navigate_next</span>
            </div>
        </div>
        <br>
        <!-- Quando tiver feito session criar uma parte de historico -->
    </section>
    <?php 
        include_once("includes/footer.php");
    ?>
    <script src="js/sliderRec.js"></script>
    <script src="js/sliderMA.js"></script>
</body>
</html>