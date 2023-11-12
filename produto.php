<?php 
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
        <div class="produto">
            <?php 
            $estrelasNota = '';
            for($i = 0;$i<$produto->nota;$i++) {
                $estrelasNota .= '<span class="material-symbols-outlined class="estrelaCheia">star</span>';
            }
            echo "
                <div class='infoGeral'>
                    <img src='{$produto->imagemMarca}' alt='{$produto->marca}' width='70' height='28'>
                    <div class='space'></div>
                    <div class='nota'>$estrelasNota - {$produto->nota} ({$produto->qtdReviews})</div>
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
    </section>
</body>
</html>