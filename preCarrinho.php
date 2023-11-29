<?php
    require_once("includes/banco.php");
    require_once("includes/login.php");
    $idProd = $_GET['c'];
    $produto = $bd->query("select * from vwProdutos where codigo = $idProd")->fetch_object();
    $precoParcelReais = number_format(floatval($produto->precoOriginal) / 12,2,",",".");
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
    <title>Pré carrinho</title>
</head>
<body style="background-color:#F2F3F4;">
    <?php 
        include_once("includes/header.php");
    ?>
    <div style='margin-top:15px;' class='msgDisplay sucesso'>
        <p>Produto adicionado ao carrinho!</p>
    </div>
    <section class="sectionProds container1400">
        <div class="prodPreCarrinho">
            <?php 
                echo "
                    <div class='infoProdPC'>
                        <img src='{$produto->imagemProduto}' alt='{$produto->nome}' width=180>
                        <div style='max-width:650px;margin-left:20px' class='infoProd'>
                            <p style='margin-top:0;margin-bottom:5px'>{$produto->marca}</p>
                            <p style='margin:0;margin-bottom:10px'><strong>{$produto->nome}</strong></p>
                        </div>
                    </div>
                    <div class='precos'>
                        <div class='parcel'>
                            <p style='font-size:22px;margin:0;color:#565C69'>
                                12x R$$precoParcelReais
                            </p>
                            <p style='font-size:16px;margin:0;color:#565C69'>
                                (A prazo: {$produto->precoParcel})
                            </p>
                        </div>
                        <span></span>
                        <div class='vista'>
                            <p style='font-size:22px;margin:0;color: #E8772E;font-weight: 700'>
                                {$produto->precoAvista}
                                </p>
                            <p style='font-size:16px;margin:0;color: #E8772E;font-weight: 700'>
                                (A vista no PIX)
                            </p>
                        </div>
                    </div>
                ";
            ?>
        </div>
        <div class="btnsPreCarrinho">
            <a href='carrinho.php' class='gotoCarrinho'>Ir para o carrinho</a>
            <a href='index.php' class='gotoCarrinho'>Continuar comprando</a>
        </div>
    </section>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
</body>
</html>