<?php 
    require_once("includes/login.php");
    require_once("includes/banco.php");
    $idProd = $_GET["c"];
    $bd->query("update vwProdutos set acessos = acessos + 1 where codigo = $idProd");
    $produto = $bd->query("select * from vwProdutos where codigo = $idProd")->fetch_object();
    if(is_null($produto)) {
        header("Location: index.php");
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
    <title><?php echo $produto->nome;?></title>
<body style="background-color: #f2f2f2;">
    <?php include("includes/header.php");?>
    <section class="produtoInfo container1400">
        <?php 
            echo "<p style='font-size: 14px'><strong>Você está em:</strong> {$produto->departamento}
             > {$produto->categoria} > <strong style='color: #e8772e'>Codigo: {$produto->codigo}</strong>";
        ?>
        <hr>
        <?php 
            echo "<h2 class='tituloProduto'>{$produto->nome}</h2>";
        ?>
        <div class="secproduto">
            <div class="produto">
                <?php 
                $estrelasNota = '';
                for($i = 0;$i<$produto->nota;$i++) {
                    $estrelasNota .= '<span class="material-symbols-outlined estrelaCheia">star</span>';
                }
                for($i = 0;$i<(5 - $produto->nota);$i++) {
                    $estrelasNota .= '<span class="material-symbols-outlined estrelaVazia">star</span>';
                }
                echo "
                    <div class='infoGeral'>
                        <img src='{$produto->imagemMarca}' alt='{$produto->marca}' width='70' height='28'>
                        <div class='space'></div>
                        <div class='nota'>$estrelasNota <p> - {$produto->nota} ({$produto->qtdReviews} Reviews)</p></div>
                        <div class='space'></div>
                        <a href='#'><span class='material-symbols-outlined fav' title='Adicionar aos favoritos' 
                        style='color:#7F858D;font-size:30px'>favorite</span></a>
                    </div>
                    <div class='imagemProduto'>
                        <img src='{$produto->imagemProduto}' alt='$produto->nome' class='imagemProduto'>
                    </div>
                    "; 
                ?>
            </div>
            <div class="infoPreco">
                <?php
                $precoParcelReais = number_format(floatval($produto->precoOriginal) / 12,2,",",".");
                if($produto->estoque > 1) {
                    echo "
                        <div class='preco'>
                            <h2 class='produtoPreco'>{$produto->precoAvista}</h2>
                            <div class='space'></div>
                            <p>Em estoque</p>
                        </div>
                        <p>À vista com <strong>10% OFF</strong></p>
                        <p><strong>{$produto->precoParcel}</strong></p>
                        <p>Em até 12x de <strong>R$$precoParcelReais</strong> sem juros no cartão</p>
                        <a href='#' class='comprar'>COMPRAR</a>
                        <a href='#' class='addCarrinho'><span class='material-symbols-outlined'>add_shopping_cart</span></a>
                    ";           
                }else {
                    echo "
                        <span class='material-symbols-outlined erroEstoque'>cancel</span>
                        <h2 class='produtoSemEstoque'>Desculpe!</h2>
                        <p>O produto que você está procurando está sem estoque.</p>
                    "; 
                }
                ?>
            </div>
        </div>
    </section>
</body>
</html>