<?php 
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(!isset($_SESSION["user"])) {
        header("Location: entrar.php");
    }
    $idUsuario = $_SESSION['user']->idUsuario;
    $formaPag = $_GET['fPag'] ?? "";
    $itensCarrinho = $bd->query("select * from vwCarrinho where idUsuario = '$idUsuario'");
    $totalCompra = $bd->query("
    select concat('R$',format(sum(precoOriginal),2,'de_DE')) 'precoParcel', 
    concat('R$',format(sum(precoAvistaVlr),2,'de_DE')) 'precoAvista',
    sum(precoAvistaVlr) 'precoAvistaVlr',
    concat('R$',format((sum(precoOriginal) + 25) / 12,2,'de_DE')) 'parcelasTotais',
    sum(precoOriginal) 'precoOriginal'
    from vwCarrinho where idUsuario = '$idUsuario'")->fetch_object();
    $pix = "";
    $cartao = "";
    $vlrDiff = number_format(floatval($totalCompra->precoOriginal) - floatval($totalCompra->precoAvistaVlr),2,",",".");
    if($itensCarrinho->num_rows < 1) {
        header("Location: carrinhoVazio.php");
    }
    if($formaPag == "pix") {
        $pix = "selected";
    }
    if($formaPag == "cartaoCredito") {
        $cartao = "selected";
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
    <title>Pagamento</title>
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
    </header>
    <section class="container1400 carrinhoCompras">
        <div class="produtosCarrinho">
            <div class="sectionTopic">
                    <h2 style="text-transform: uppercase;margin:0;font-size:20px" class="tituloSection">
                        Forma de pagamento
                    </h2>
                    <span class="material-symbols-outlined">shopping_basket</span>
            </div>
            <div class="formasPagamento">
                <?php 
                    echo "
                        <a href='pagamento.php?fPag=pix' class='pix $pix'>Pix</a>
                        <a href='pagamento.php?fPag=cartaoCredito' class='cartao $cartao'>Cartão de crédito</a>
                    ";
                    if($formaPag == "cartaoCredito") {
                        echo "
                        <div class='cadCartao'>
                            <input type='text' placeholder='Número do cartão *'>
                            <input type='text' placeholder='Nome impresso no cartão *'>
                            <div class='cartaoHalfSpace'>
                                <input type='text' placeholder='Validade *'>
                                <input type='text' placeholder='Código de verificação *'>
                                <input type='text' placeholder='CPF/CNPJ do titular *'>
                                <input type='text' placeholder='Data de nascimento *'>
                            </div>
                            <select class='qtdParcel'>
                                <option value='1'>Pagar a vista com o cartão</option>
                                <option value='2'>Parcelar em 2x sem juros</option>
                                <option value='3'>Parcelar em 3x sem juros</option>
                                <option value='4'>Parcelar em 4x sem juros</option>
                                <option value='5'>Parcelar em 5x sem juros</option>
                                <option value='6'>Parcelar em 6x sem juros</option>
                                <option value='7'>Parcelar em 7x sem juros</option>
                                <option value='8'>Parcelar em 8x sem juros</option>
                                <option value='9'>Parcelar em 9x sem juros</option>
                                <option value='10'>Parcelar em 10x sem juros</option>
                                <option value='11'>Parcelar em 11x sem juros</option>
                                <option value='12'>Parcelar em 12x sem juros</option>
                            </select>
                        </div>";
                    }
                ?>
            </div>
        </div>
        <div class="resumoCompra">
            <div class="sectionTopic">
                    <h2 style="text-transform: uppercase;margin:0;font-size:20px" class="tituloSection">
                        Valor da compra
                    </h2>
                    <span style="font-size: 25px;" class="material-symbols-outlined">local_atm</span>
            </div>
            <div class="infoprecos">
                <?php
                    $valorFinalParcel = number_format(floatval($totalCompra->precoOriginal) + 25,2,",",".");
                    $valorFinalAvista = number_format(floatval($totalCompra->precoAvistaVlr) + 25,2,",",".");
                    echo "
                    <div style='display:flex;justify-content:space-between;align-items:center'>
                        <p style='margin:0;font-size:12px'>Valor dos Produtos: </p>
                        <p style='margin:0;margin-right:10px'><strong>R$$valorFinalParcel</strong></p>
                    </div>
                    <hr>
                    <div style='margin-top:15px;display:flex;justify-content:space-between;align-items:center'>
                        <p style='margin:0;font-size:12px'>Total a prazo: </p>
                        <p style='margin:0;margin-right:10px'><strong>R$$valorFinalParcel</strong></p>
                    </div>
                    <div style='display:flex;justify-content:center;align-items:center'>
                        <p style='margin:0;margin-top:5px;font-size:12px'>
                            (Em até <strong style='font-size:12px'>12x de {$totalCompra->parcelasTotais} sem juros</strong>)
                        </p>
                    </div>";
                    if($formaPag == "pix") {
                        echo "
                        <div class='precoAvista'>
                            <p style='margin-top:10px;font-size:12px'>
                                Valor à vista no <b>Pix:</b>
                            </p>
                            <p style='font-size:30px'>
                                <b>R$$valorFinalAvista</b>
                            </p>
                            <p style='font-size:14px;margin-bottom:10px'>
                                (Economize <b>R$$vlrDiff</b>)
                            </p>
                        </div>
                        ";
                    }
                    echo "
                    <div class='btnsCarrinho'>
                        <a href='confirmarCompra.php?fPag=$formaPag' class='gotoCarrinho'>Continuar</a>
                        <a href='carrinho.php' class='gotoCarrinho'>Voltar</a>
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
    <script src="js/pagamento.js"></script>
</body>
</html>