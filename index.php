<?php 
    require_once("includes/banco.php");
    $buscaProdutosRecomendados = $bd->query("select * from vwProdutosRecomendados");
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
    <?php include("includes/header.php");?>
    <div class="bannerIntro">
            <img src="imgs/svg/bannerIndex.svg" alt="banner">
    </div>
    <section class="introIndex">
        <div class="container1400"> 
            <div class="recomendBar">
                <h2>RECOMENDADO</h2>
            </div>
            <div class="recomendadosProdutos">
                <div class="ant">
                    <span class="material-symbols-outlined">navigate_before</span>
                </div>
                <?php 
                    while($prod = $buscaProdutosRecomendados->fetch_object()) {
                        echo "
                        <div class='produtos prodRec' title='{$prod->nome}'>
                            <img src='{$prod->imagemProduto}' alt=' width='268' height='162'>
                            <p class='nome'>{$prod->nome}</p>
                            <div class='infoPreco'>
                                <p class='preco'>{$prod->precoAvista}</p>
                                <p class='avisoPix'>À vista no PIX</p>
                            </div>
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
        <img src="imgs/svg/bannerRecomend.svg" alt="banner" class="banner">
        <div class="marcasRecomendadasTitle">
                <h2 style="text-transform: uppercase;">Marcas Recomendadas</h2>
                <span class="material-symbols-outlined">thumb_up</span>
        </div>
        <div class="marcasRecomendadas container1330">
            <?php 
                while($marca = $buscaMarcas->fetch_object()) {
                    echo "
                        <div class='marca'>
                            <img src='{$marca->foto}' alt='{$marca->nome}'>
                            <h2>{$marca->nome}</h2>
                            <a href='#'>VER PRODUTOS</a>
                        </div>
                    ";
                }
            ?>
        </div>
        <div class="marcasRecomendadasTitle">
                <h2 style="text-transform: uppercase;">Marcas Recomendadas</h2>
                <span class="material-symbols-outlined">lists</span>
        </div>
        <div class="marcasRecomendadas container1330 departamentos">
            <?php 
                while($dep = $buscaDepartamentos->fetch_object()) {
                    echo "
                        <div class='departamento'>
                            <img src='{$dep->foto}' alt='{$dep->departamento}'>
                            <h2>{$dep->departamento}</h2>
                            <a href='#'></a>
                        </div>
                    ";
                }
            ?>
        </div>
    </section>
    <script src="js/index.js"></script>
</body>
</html>