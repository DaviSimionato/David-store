<?php 
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(!isset($_SESSION["user"])) {
        header("Location: entrar.php");
    }
    $idUsuario = $_SESSION['user']->idUsuario;
    $itensFav = $bd->query("select * from vwFavoritos where idUsuario = '$idUsuario'");
    $favVazio = false;
    if($itensFav->num_rows == 0) {
        $favVazio = true;
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
    <title>Favoritos</title>
</head>
<body style="background-color: #f2f2f2;">
    <?php 
        include_once("includes/header.php");
    ?>
    <section class="sectionProds container1400">
        <div class="sectionTopic">
            <h2 style="text-transform: uppercase;margin:0;font-size:20px;margin-left:25px" class="tituloSection">
                Produtos favoritos
            </h2>
            <span class="material-symbols-outlined">favorite</span>
        </div>
        <div style="max-width: 80%;" class="produtosCarrinho">
            <?php
                if($favVazio) {
                    echo "
                    <h2 style='margin:80px auto;text-align:center;text-transform:uppercase;font-size:18px'>
                        Nenhum item favoritado
                    </h2>";
                }else {
                    while($item = $itensFav->fetch_object()) {
                        echo "
                            <div class='produtoCart'>
                                <div class='infoProduto'>
                                    <img style='margin-right:25px' src='{$item->imagemProduto}' alt='{$item->nome}' width=120>
                                    <div class='infoNomes'>
                                        <p style='font-weight:700'>{$item->marca}</p>
                                        <a class='nomeProd' href='produto.php?{$item->nome}&c={$item->codigo}'>
                                            <p style='width:700px;margin-bottom:2px;margin-top:2px'>
                                                <strong>{$item->nome}</strong>
                                            </p>
                                        </a>
                                    </div>
                                    <div style='margin-left: 450px' class='favoritar'>
                                        <a href='includes/favoritar.php?n={$item->nome}&c={$item->codigo}&favUser=true'>
                                        <span class='material-symbols-outlined fav favorito' title='Remover dos favoritos' style='font-size:30px'>favorite</span></a>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                }
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