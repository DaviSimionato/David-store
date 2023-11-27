<?php 
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(!isset($_SESSION["user"])) {
        header("Location: entrar.php");
    }
    $idUsuario = $_SESSION['user']->idUsuario;
    $infoUser = $bd->query("select * from usuarios where idUsuario = '$idUsuario'");
    $itensCarrinho = $bd->query("select * from vwCarrinho where idUsuario = '$idUsuario'");
    $totalCompra = $bd->query("
    select concat('R$',format(sum(precoOriginal),2,'de_DE')) 'precoParcel', 
    concat('R$',format(sum(precoAvistaVlr),2,'de_DE')) 'precoAvista',
    concat('R$',format(sum(precoOriginal) / 12,2,'de_DE')) 'parcelasTotais',
    sum(precoOriginal) 'precoOriginal'
    from vwCarrinho where idUsuario = '$idUsuario'")->fetch_object();
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
    <title>Carrinho</title>
</head>
<body style="background-color: #F2F3F4;">
    <header>
            <div class="header">
                <a href="index.php"><img src="imgs/svg/logo-no-background.svg" alt="Logo" height="20"></a>
                <?php 
                    if(isset($_SESSION["user"])) {
                        echo "
                        <div class='entrarOuCad'>
                            <span class='material-symbols-outlined'>account_circle</span>
                            <div class='sessionInfo'>
                                <p>
                                    Olá, {$_SESSION['user']->nomeUsuario}
                                </p>
                                <p><strong><a href='minhaConta.php'>MINHA CONTA</a></strong>
                            </div>
                        </div>
                        ";  
                    }
                ?>
            </div>
            <script src="js/menuLateral.js"></script>
    </header>
    <section class="container1400 carrinhoCompras">
        <div class="produtosCarrinho">
        <div class="sectionTopic">
                <h2 style="text-transform: uppercase;margin:0;font-size:20px" class="tituloSection">
                    Produtos selecionados
                </h2>
                <span class="material-symbols-outlined">shopping_basket</span>
        </div>
            <?php
                while($item = $itensCarrinho->fetch_object()) {
                    echo "
                        <div class='produtoCart'>
                            <div class='infoProduto'>
                                <img style='margin-right:25px' src='{$item->imagemProduto}' alt='{$item->nome}' width=120>
                                <div class='infoNomes'>
                                    <p style='font-weight:500'>{$item->marca}</p>
                                    <p style='max-width:600px;margin-bottom:2px;margin-top:2px'>
                                        <strong>{$item->nome}</strong>
                                    </p>
                                    <p class='infoPrecoPequeno'>Com desconto no PIX: 
                                        <strong style='font-size: 12px;color: #7f858d;'>{$item->precoAvista}</strong>
                                    </p>
                                    <p class='infoPrecoPequeno'>
                                        Parcelado no cartão em até 12x sem juros: 
                                        <strong style='font-size: 12px;color: #7f858d;'>{$item->precoParcel}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class='precoItem'>
                                <p style='font-weight:400;margin-bottom:5px'>Preço à vista no PIX:</p>
                                <p style='font-weight:700;font-size:14px;color: #E8772E;text-align:right'>
                                    {$item->precoAvista}
                                </p>
                            </div>
                        </div>
                    ";
                }
            ?>
        </div>
        <div class="resumoCompra">
            <div class="sectionTopic">
                    <h2 style="text-transform: uppercase;margin:0;font-size:20px" class="tituloSection">
                        Resumo
                    </h2>
                    <span style="font-size: 25px;" class="material-symbols-outlined">local_atm</span>
            </div>
            <div class="infoprecos">
                <?php
                    $valorFinal = number_format(floatval($totalCompra->precoOriginal) + 25,2,",",".");
                    echo "
                    <div style='display:flex;justify-content:space-between;align-items:center'>
                        <p style='margin:0;font-size:12px'>Valor dos Produtos: </p>
                        <p style='margin:0;margin-right:10px'><strong>{$totalCompra->precoParcel}</strong></p>
                    </div>
                    <hr>
                    <div style='display:flex;justify-content:space-between;align-items:center'>
                        <p style='margin:0;font-size:12px'>Frete: </p>
                        <p style='margin:0;margin-right:10px'><strong>R$25,00</strong></p>
                    </div>
                    <div style='margin-top:30px;display:flex;justify-content:space-between;align-items:center'>
                        <p style='margin:0;font-size:12px'>Total a prazo: </p>
                        <p style='margin:0;margin-right:10px'><strong>R$$valorFinal</strong></p>
                    </div>
                    <div style='display:flex;justify-content:center;align-items:center'>
                        <p style='margin:0;margin-top:3px;font-size:12px'>
                            (Em até <strong style='font-size:12px'>12x de {$totalCompra->parcelasTotais} sem juros</strong>)
                        </p>
                    </div>
                    <div class='precoAvista'>
                        <p style='margin:0;margin-top:3px;font-size:12px'>
                            Valor à vista no <b>Pix:</b>
                        </p>
                    </div>
                    ";
                ?>
            </div>
        </div>
    </section>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
</body>
</html>