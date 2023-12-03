<?php 
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(!isset($_SESSION["user"])) {
        header("Location: entrar.php");
    }
    $idUsuario = $_SESSION['user']->idUsuario;
    $buscaPedidos = $bd->query("select * from pedidos where idUsuario = $idUsuario");
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
    <title>Meus pedidos</title>
</head>
<body style="background-color: #f2f2f2;">
    <?php 
        include_once("includes/header.php");
    ?>
    <section class="container1400">
        <div style="margin: 20px 0;" class="sectionTopic">
            <h2 style="text-transform: uppercase;margin:0;font-size:20px;padding-left:0" class="tituloSection">
                Meus pedidos
            </h2>
            <span class="material-symbols-outlined">shopping_basket</span>
        </div>
        <?php 
            while($ped = $buscaPedidos->fetch_object()) {
                echo "
                <div class='pedido'>
                    <div class='pedInfo'>
                        <p style='text-transform:uppercase'><b>Número do pedido</b></p>
                        <p>#{$ped->idPedido}</p>
                    </div>
                    <div class='pedInfo'>
                        <p style='text-transform:uppercase'><b>Status</b></p>
                        <p><b style='color:#2dc26e'>Concluído</b></p>
                    </div>
                    <div class='pedInfo'>
                        <p style='text-transform:uppercase'><b>Data</b></p>
                        <p>{$ped->dataPedido}</p>
                    </div>
                    <div class='pedInfo'>
                        <p style='text-transform:uppercase'><b>Valor</b></p>
                        <p>{$ped->totalPedido}</p>
                    </div>
                    <div style='margin-right:30px' class='pedInfo'>
                        <a href='detalhesPedido.php?c={$ped->idPedido}' style='color:#E8772E'>
                            Detalhes do pedido <b style='color:#E8772E'>+</b>
                        </a>
                    </div>
                </div>
                ";
            }
        ?>
    </section>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
</body>
</html>