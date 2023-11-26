<?php
    require_once("includes/banco.php");
    require_once("includes/login.php");
    $idProd = $_GET["c"];
    $produto = $bd->query("select * from vwProdutos where codigo = $idProd")->fetch_object();
    if(!isset($_SESSION['user'])) {
        header("Location: entrar.php");
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
    <title>David'store - Review</title>
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
            <form action="includes/review.php" class="formReview" method="post">
                <label for="nota"><strong>Qual sua nota para o produto</strong></label>
                <div class="estrelasReview">
                    <select name="nota" class="inputNota">
                        <option value="5">5 - Ótimo</option>
                        <option value="4">4 - Bom</option>
                        <option value="3">3 - Regular</option>
                        <option value="2">2 - Insatisfatório</option>
                        <option value="1">1 - Ruim</option>
                        <option value="0">0 - Péssimo</option>
                    </select>
                    <span>-</span>
                    <span class="material-symbols-outlined estrelaRev estrelaCheia">star</span>
                    <span class="material-symbols-outlined estrelaRev estrelaCheia">star</span>
                    <span class="material-symbols-outlined estrelaRev estrelaCheia">star</span>
                    <span class="material-symbols-outlined estrelaRev estrelaCheia">star</span>
                    <span class="material-symbols-outlined estrelaRev estrelaCheia">star</span>
                </div>
                <label for="comentario" style="display: block;margin:20px 0; margin-bottom:10px"><strong>Dê sua opnião sobre o produto</strong></label>
                <textarea name="comentario" cols="30" rows="10" placeholder="Escreva o que achou do produto" style="width: 700px;height:150px;resize:none;display:block;margin-bottom:15px"></textarea>
                <button type="submit">Enviar avaliação</button>
                <?php 
                    echo "<input type='hidden' name='idProduto' value='{$produto->codigo}'>";
                ?>
            </form>

        </div>
    </section>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
    <script src="js/review.js"></script>
</body>
</html>