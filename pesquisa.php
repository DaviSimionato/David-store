<?php 
    require_once("includes/login.php");
    require_once("includes/banco.php");
    $departamento = $_GET["departamento"] ?? "";
    $categoria = $_GET["categoria"] ?? "";
    $pesquisa = $_GET["pesquisa"] ?? "";
    $marca = $_GET["marca"] ?? "";
    if(!empty($pesquisa)) {
        $buscaPesquisa = $bd->query("select * from vwProdutos where categoria like'%$pesquisa%' or nome like '%$pesquisa%' 
        or departamento like'%$pesquisa%' or marca like '%$pesquisa%'");
        $termoPesquisa = $pesquisa;
    }
    if(!empty($departamento)) {
        $buscaPesquisa = $bd->query("select * from vwProdutos where departamento = '$departamento'");  
        $termoPesquisa = $departamento;
    }
    if(!empty($marca)) {
        $buscaPesquisa = $bd->query("select * from vwProdutos where marca = '$marca'");  
        $termoPesquisa = $marca;
    }
    if(!empty($categoria)) {
        $buscaPesquisa = $bd->query("select * from vwProdutos where categoria = '$categoria'");  
        $termoPesquisa = $categoria;
    }
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
    <title><?php echo "Busca por $termoPesquisa";?></title>
</head>
<body style="background-color: #F2F3F4;">
    <?php include_once("includes/header.php") ?>
    <div class="resultadoPesquisa container1400">
        <?php 
            echo "<h2 style='font-size:1.25em'>Resultados da pesquisa: $termoPesquisa</h2>"
        ?>
        <hr>
    <div class="produtosResultados">
        <div class="filtro">
                <label for="precoMin">Preço mínimo</label>
                <input type="range" name="precoMin" class="precoMin">
                <label for="precoMax">Preço máximo</label>
                <input type="range" name="precoMax" class="precoMax">
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
</body>
</html>