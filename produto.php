<?php 
    require_once("includes/login.php");
    require_once("includes/banco.php");
    $idProd = $_GET["c"];
    $bd->query("update vwProdutos set acessos = acessos + 1 where codigo = $idProd");
    $produto = $bd->query("select * from vwProdutos where codigo = $idProd")->fetch_object();
    $buscaProdutosSimilares = $bd->query("select * from vwProdutos where categoria = '{$produto->categoria}'");
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
    <?php include_once("includes/header.php");?>
    <section class="sectionProds container1400">
        <?php 
            echo "<p style='font-size: 14px'><strong>Você está em:</strong> {$produto->departamento}
             > {$produto->categoria} > <strong style='color: #e8772e'>Codigo: {$produto->codigo}</strong>";
        ?>
        <hr>
        <?php 
            echo "<h2 class='tituloProduto'>{$produto->nome}</h2>";
        ?>
        <div class="secProduto">
            <div class="produto">
                <?php 
                $estrelasNota = '';
                for($i = 0;$i<floor($produto->nota);$i++) {
                    $estrelasNota .= '<span class="material-symbols-outlined estrelaCheia">star</span>';
                }
                for($i = 0;$i<(5 - floor($produto->nota));$i++) {
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
                            <p><strong style='color: #1fa342'>Em estoque</strong></p>
                        </div>
                        <p style='margin-top:-40px;margin-bottom: 40px;font-size:14px'>
                            À vista no PIX com <strong>10% OFF</strong>
                        </p>
                        <p style='margin-bottom:0'><strong>{$produto->precoParcel}</strong></p>
                        <p style='margin: 0'>Em até 12x de <strong>R$$precoParcelReais</strong> sem juros no cartão</p>
                        <div class='btns'>
                            <a href='#' class='comprar'><span class='material-symbols-outlined'>shopping_cart</span>COMPRAR</a>
                            <a href='#' class='addCarrinho'><span class='material-symbols-outlined'>add_shopping_cart</span></a>
                        </div>
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
        <div class="produtosSimilares">
            <div class="sectionTopic">
                    <h2 style="text-transform: uppercase; margin-bottom: 0; font-size:16px" class="tituloSection">Produtos similares</h2>
                    <span style="margin-top: 15px;" class="material-symbols-outlined">ads_click</span>
            </div>
            <div class="prodsSim">
                <div class="produtoSimilar">

                </div>
            </div>
        </div>
    </section>
    <section class="sectionProds container1400">
        <div class="descritivo">
            <div class="sectionTopic">
                    <h2 style="text-transform: uppercase; margin: 20px 0; padding:0; font-size:20px" class="tituloSection">Descrição do produto</h2>
                    <span style="margin-left:10px" class="material-symbols-outlined">description</span>
            </div>
            <?php 
                echo "{$produto->descritivo}";
            ?>
        </div>
    </section>
    <section class="sectionProds container1400">
            <div class="sectionTopic">
                <h2 style="text-transform: uppercase; margin: 20px 0; padding:0; font-size:20px" class="tituloSection">INFORMAÇÕES TÉCNICAS</h2>
                <span style="margin-left:10px" class="material-symbols-outlined">info</span>
            </div>
        <div class="infoTecnica">
            <?php 
                echo "{$produto->infoTecnica}";
            ?>
        </div>
    </section>
    <?php 
        include_once("includes/footer.php");
    ?>
</body>
</html>