<?php 
    require_once("includes/login.php");
    require_once("includes/banco.php");
    $pesquisa = $_GET["pesquisa"] ?? "";
    $ord = $_GET["ord"] ?? "codigo";
    if(!empty($pesquisa)) {
        $buscaPesquisa = $bd->query("select * from vwProdutos where categoria like'%$pesquisa%' or nome like '%$pesquisa%' 
        or departamento like'%$pesquisa%' or marca like '%$pesquisa%' order by $ord");
    }
    $menorPreco = $bd->query("select min(precoOriginal) as 'mp' from vwProdutos where categoria like'%$pesquisa%' or nome like '%$pesquisa%' 
    or departamento like'%$pesquisa%' or marca like '%$pesquisa%'")->fetch_object()->mp;
    $maiorPreco = $bd->query("select max(precoOriginal) as 'mp' from vwProdutos where categoria like'%$pesquisa%' or nome like '%$pesquisa%' 
    or departamento like'%$pesquisa%' or marca like '%$pesquisa%'")->fetch_object()->mp;
    $menorPreco = $menorPreco - ($menorPreco * 0.1); 
    $maiorPreco = $maiorPreco - ($maiorPreco * 0.1); 
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
    <title><?php echo "Busca por $pesquisa";?></title>
</head>
<body style="background-color: #F2F3F4;">
    <?php include_once("includes/header.php") ?>
    <div class="resultadoPesquisa container1400">
        <?php 
            echo "<h2 style='font-size:1.25em'>Resultados da pesquisa: $pesquisa</h2>"
        ?>
        <hr>
    <div class="produtosResultados">
        <div class="filtro">
                <?php
                    echo "
                        <label for='precoMin' class='precoMinLabel'>Preço mínimo: <strong><br>R$$menorPreco</strong></label>
                        <input type='range' name='precoMin' class='precoMinInput' min='$menorPreco' 
                        max='$maiorPreco' value='$menorPreco'>
                        <label for='precoMax' class='precoMaxLabel'>Preço máximo: <strong><br>R$$maiorPreco</strong></label>
                        <input type='range' name='precoMax' class='precoMaxInput' min='$menorPreco' 
                        max='$maiorPreco' value='$maiorPreco'>
                        <p style='display:none' class='btnAplicar'>Aplicar</p>
                    ";
                ?>
            </div>
            <div class="resultados">
                <div class="ordenarLista">
                    <span style="color: #E8772E;margin-left:15px" class="material-symbols-outlined">swap_vert</span>
                    <p><strong>Ordenar por: </strong></p>
                    <div class="ordOptions">
                        <?php 
                            echo "
                                <a href='pesquisa.php?pesquisa=$pesquisa&ord=codigo'}' class='codigo'>Nada | </a>
                                <a href='pesquisa.php?pesquisa=$pesquisa&ord=precoOriginal' class='precoOriginal'>Menor preço | </a>
                                <a href='pesquisa.php?pesquisa=$pesquisa&ord=precoOriginal desc' class='precoOriginal desc'>Maior preço | </a>
                                <a href='pesquisa.php?pesquisa=$pesquisa&ord=acessos' class='acessos'>Acessos</a>
                                <p style='display:none' class='valorOrd'>$ord</p>
                            ";
                        ?>
                    </div>
                </div>
                <div class="produtosList">
                    <?php 
                        while($prod = $buscaPesquisa->fetch_object()) {
                            echo "
                            <div class='produtos prodPesq' title='{$prod->nome}'>
                                <a href='produto.php?n={$prod->nome}&c={$prod->codigo}'>
                                <img src='{$prod->imagemProduto}' alt=' width='268' height='162'>
                                <p class='nome'>{$prod->nome}</p>
                                <div class='infoPreco'>
                                    <p class='preco'>{$prod->precoAvista}</p>
                                    <p class='avisoPix'>À vista no PIX</p>
                                    <p style='display:none' class='prcOcult'>{$prod->precoOriginal}</p>
                                </div>
                                </a>
                                <a href='#' class='comprar'>COMPRAR</a>
                            </div>
                            ";
                        }
                    ?>
                </div>
            </div>
       </div>
    </div>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
    <script src="js/filtroPesquisa.js"></script>
    <script src="js/showOrd.js"></script>
</body>
</html>