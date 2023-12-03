<?php 
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(!isset($_SESSION["user"])) {
        header("Location: entrar.php");
    }
    $idUsuario = $_SESSION['user']->idUsuario;
    $idPedido = $_GET['c'];
    $buscaPedido = $bd->query("select * from vwPedidos where idPedido = $idPedido");
    $totalCompra = $bd->query("select totalPedido from vwPedidos where idPedido = $idPedido limit 1")->fetch_object()->totalPedido;
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
    <?php 
        echo "
        <title>Pedido #$idPedido</title>
        ";
    ?>
</head>
<body style="background-color: #F2F3F4;">
    <?php 
        include_once("includes/header.php");
    ?>
    <section style="margin-top: 15px;" class="container1400 carrinhoCompras">
        <div class="produtosCarrinho">
            <div class="sectionTopic">
                    <h2 style="text-transform: uppercase;margin:0;font-size:20px;padding-bottom:0" class="tituloSection">
                        Informações do seu pedido
                    </h2>
                    <span class="material-symbols-outlined">shopping_bag</span>
            </div>
            <?php 
                echo "
                    <div class='dadosCliente'>
                        <p style='font-size:18px;margin-bottom:15px'>
                            <b>Número do pedido #$idPedido</b>
                        </p>
                        <p style='font-size:18px'>
                            <b>Dados pessoais</b>
                        </p>
                        <p style='font-size:14px;margin-top:5px'>
                            <b>{$_SESSION['user']->nome} {$_SESSION['user']->sobrenome}</b>
                        </p>
                        <p style='font-size:14px;margin-top:3px'>
                            <b>CPF:</b> {$_SESSION['user']->cpf}
                        </p>
                        <p style='font-size:14px;margin-top:3px'>
                            <b>Telefone:</b> {$_SESSION['user']->telefone}
                        </p>
                        <p style='font-size:14px;margin-top:3px'>
                            <b>Email:</b> {$_SESSION['user']->email}
                        </p>
                        <p style='font-size:14px;margin-top:3px'>
                            <b>Nome de usuário:</b> {$_SESSION['user']->nomeUsuario}
                        </p>
                    </div>
                ";
            ?>
            <div style="margin-top: 25px;" class="sectionTopic">
                <h2 style="text-transform: uppercase;margin:0;font-size:18px" class="tituloSection">
                    Produtos
                </h2>
                <span class="material-symbols-outlined">shopping_basket</span>
            </div>
            <?php
                while($item = $buscaPedido->fetch_object()) {
                    echo "
                        <div class='produtoCart'>
                            <div class='infoProduto'>
                                <img style='margin-right:25px' src='{$item->imagemProduto}' alt='{$item->nome}' width=120>
                                <div class='infoNomes'>
                                    <p style='font-weight:500'>{$item->marca}</p>
                                        <p style='width:550px;margin-bottom:2px;margin-top:2px'>
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
                        </div>
                    ";
                }
            ?>
            </div>
        <div style="max-height: 190px;" class="resumoCompra">
            <div class="sectionTopic">
                    <h2 style="text-transform: uppercase;margin:0;font-size:20px" class="tituloSection">
                        Valor da compra
                    </h2>
                    <span style="font-size: 25px;" class="material-symbols-outlined">local_atm</span>
            </div>
            <div class="infoprecos">
                <?php
                    echo "
                    <div style='display:flex;justify-content:space-between;align-items:center'>
                        <p style='margin:0;font-size:12px'>Valor da compra: </p>
                        <p style='margin:0;margin-right:10px'><strong>$totalCompra</strong></p>
                    </div>
                    <hr>
                    <div class='btnsCarrinho'>
                        <a href='pedidos.php' class='gotoCarrinho'>Voltar</a>
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