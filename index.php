<?php 
    require_once("includes/banco.php");
    $buscaProdutos = $bd->query("select * from vwProdutos");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo/davidstore-icon.ico" type="image/ico">
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
            <img src="logo/svg/bannerIndex.svg" alt="banner">
    </div>
    <section class="introIndex">
        <div class="container"> 
            <div class="recomendBar">
                <h2>RECOMENDADO</h2>
            </div>
            <div class="recomendadosProdutos">
                <?php 
                    while($prod = $buscaProdutos->fetch_object()) {
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
            </div>
        </div>
    </section>
</body>
</html>