<?php
    require_once("includes/banco.php");
    require_once("includes/login.php");
    $idProd = $_GET["c"];
    $produto = $bd->query("select * from vwProdutos where codigo = $idProd")->fetch_object();
    $buscaReviews = $bd->query("select * from vwReviews where idProduto = $idProd");
    function getEstrelas($nota) {
        $estrelasNota = '';
        for($i = 0;$i<floor($nota);$i++) {
            $estrelasNota .= '<span class="material-symbols-outlined estrelaCheia">star</span>';
        }
        if($nota > floor($nota) + 0.49 && $nota < floor($nota) + 1) {
            $estrelasNota .= '<span class="material-symbols-outlined estrelaCheia">star_half</span>';
            $notaLength = 4;
        }else {
            $notaLength = 5;
        }
        for($i = 0;$i<($notaLength - floor($nota));$i++) {
            $estrelasNota .= '<span class="material-symbols-outlined estrelaVazia">star</span>';
        }        
        return $estrelasNota;
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
    <title>David'store - Reviews</title>
</head>
<body style="background-color: #f2f2f2;">
    <?php 
        include_once("includes/header.php");
    ?>
    <section class="sectionProds container1400">
        <div style="margin-left: 20px" class="reviewContainer">
            <h2>Avaliações do produto</h2>
            <div style="display: flex;margin-bottom: 25px" class="prodOp">
                <?php 
                    echo "
                        <img src='{$produto->imagemProduto}' alt='{$produto->nome}' width=150>
                        <p style='margin-left:15px'>{$produto->nome}</p>
                    ";
                ?>
            </div>
            <div style="margin-left: 20px;margin-top:30px" class="reviews">
            <?php 
                while($rev = $buscaReviews->fetch_object()) {
                    $notaTitulo = "";
                    switch($rev->nota) {
                        case 0: $nota = "Péssimo";
                            break;
                        case 1: $nota = "Ruim";
                            break;
                        case 2: $nota = "Insatisfatório";
                            break;
                        case 3: $nota = "Regular";
                            break;
                        case 4: $nota = "Bom";
                            break;
                        case 5: $nota = "Ótimo";
                    }
                    $notaEstrelas = getEstrelas($rev->nota);
                    echo "
                        <div class='review'>
                            <div class='nota'>
                                <span style='margin-right:2px' class='material-symbols-outlined'>person</span>
                                <p style='margin:0;font-weight:600;margin-right:5px;color:#444d59'>{$rev->nomeUsuario}</p>
                                - 
                                $notaEstrelas
                                <p>{$rev->dataReview}</p>
                            </div>
                            <p style='margin:0;font-size:16px;font-weight:bold;margin-left:5px;margin-top:4px'>
                            $nota
                            </p>
                            <p style='font-size:14px;margin-top: 5px;margin-left:5px'>{$rev->comentario}</p>
                        </div>
                    ";
                }
            ?>
        </div>
    </section>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
</body>
</html>