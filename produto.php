<?php
    require_once("includes/banco.php");
    require_once("includes/login.php");
    $idProd = $_GET["c"];
    $reviewFeita = $_GET['reviewFeita'] ?? false;
    $addCart = $_GET['addCart'] ?? false;
    $bd->query("update vwProdutos set acessos = acessos + 1 where codigo = $idProd");
    $produto = $bd->query("select * from vwProdutos where codigo = $idProd")->fetch_object();
    $buscaProdutosSimilares = $bd->query("select * from vwProdutos where idCategoria = {$produto->idCategoria}
    and codigo != {$produto->codigo} limit 9");
    $buscaProdutosMaisAces = $bd->query("select * from vwProdutos order by acessos desc limit 30");
    $buscaReviews = $bd->query("select * from vwReviews where idProduto = $idProd limit 5");
    $testeReviews = $bd->query("select ifnull(count(idReview),0) as 'qtd' from vwReviews where idProduto = $idProd")->fetch_object();
    if($testeReviews->qtd == 0) {
        $reviewsVazias = true;
    }else {
        $reviewsVazias = false;
    }
    if($produto->qtdReviews > 5) {
        $btnVerMaisReviews = true;
    }else {
        $btnVerMaisReviews = false;
    }
    if(is_null($produto)) {
        header("Location: index.php");
    }
    if(isset($_SESSION["user"])) {
        $bd->query("call procHistorico({$_SESSION['user']->idUsuario},{$produto->codigo})");
        $userId = $_SESSION['user']->idUsuario;
        $buscaHistorico = $bd->query("select * from vwProdutosHistorico
        where idUsuario = $userId order by codHist desc limit 25");
    }
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
    <title><?php echo $produto->nome;?></title>
</head>
<body style="background-color: #f2f2f2;">
    <?php include_once("includes/header.php");?>
    <?php 
        if($reviewFeita) {
            echo "
            <div style='margin-top:15px;' class='msgDisplay sucesso'>
                <p>Avaliação cadastrada!</p>
            </div>
            ";
        }
        if($addCart) {
            echo "
            <div style='margin-top:15px;' class='msgDisplay sucesso'>
                <p>Produto adicionado ao carrinho!</p>
            </div>
            ";
        }
    ?>
    <section class="sectionProds container1400">
        <?php 
            echo "<p style='font-size: 14px'><strong>Você está em:</strong> 
                <a href='pesquisa.php?pesquisa={$produto->departamento}'>{$produto->departamento}</a> > 
                <a href='pesquisa.php?pesquisa={$produto->categoria}'>{$produto->categoria}</a> > 
                <strong style='color: #e8772e'>Codigo: {$produto->codigo}</strong>";
        ?>
        <hr>
        <?php 
            echo "<h2 class='tituloProduto'>{$produto->nome}</h2>";
        ?>
        <div class="secProduto">
            <div class="produto">
                <?php
                if($produto->qtdReviews == 1) {
                    $review = "Review";
                }else {
                    $review = "Reviews";
                }
                $estrelasNotaProduto = getEstrelas($produto->nota);
                echo "
                    <div class='infoGeral'>
                        <img src='{$produto->imagemMarca}' alt='{$produto->marca}' width='70' height='28'>
                        <div class='space'></div>
                        <div class='nota'>$estrelasNotaProduto <p> - {$produto->nota} ({$produto->qtdReviews} $review)</p></div>
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
                            <a href='includes/addCarrinho.php?c=$idProd&preCarrinho=1' class='comprar'><span class='material-symbols-outlined'>shopping_cart</span>COMPRAR</a>
                            <a href='includes/addCarrinho.php?c=$idProd' class='addCarrinho'><span class='material-symbols-outlined'>add_shopping_cart</span></a>
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
        <div class="produtosSimilares container1330">
            <div class="sectionTopic">
                    <h2 style="text-transform: uppercase; margin-bottom: 0;margin-left:0; font-size:16px" class="tituloSection">Produtos similares</h2>
                    <span style="margin-top: 15px;" class="material-symbols-outlined">search</span>
            </div>
            <?php 
                echo "
                <p style='padding-left:10px;margin:0;margin-top: -15px;font-size:12px;font-wheight:200'>Categoria: 
                <strong style='font-size:12px'><a href='pesquisa.php?pesquisa={$produto->categoria}' class='categ'>
                    {$produto->categoria}
                </a></strong></p>";
            ?>
            <div class="prodsSim">
                <?php
                    while($prodSimilar = $buscaProdutosSimilares->fetch_object()) {
                        echo "
                        <div class='produtoSimilar' title='{$prodSimilar->nome}'>
                            <a href='produto.php?{$prodSimilar->nome}&c={$prodSimilar->codigo}'>
                                <img src='{$prodSimilar->imagemProduto}' width='100'>
                                <p>{$prodSimilar->precoAvista}</p>
                            </a>
                        </div>";
                    } 
                ?>  
            </div>
        </div>
    </section>
    <section class="sectionProds container1400 descritivoProd">
        <div style="justify-content: space-between;" class="sectionTopic">
            <div style="display: flex;align-items:center">
                <h2 style="text-transform: uppercase; margin: 20px 0; padding:0; font-size:20px" class="tituloSection">Descrição do produto</h2>
                <span style="margin-left:10px" class="material-symbols-outlined">description</span>
            </div>
            <span style="font-size: 35px;margin-right: 45px" class="material-symbols-outlined mostrar">expand_less</span>
        </div>
        <div class="descritivo">
            <?php 
                echo "{$produto->descritivo}";
            ?>
        </div>
    </section>
    <section class="sectionProds container1400 infotecProd">
        <div style="justify-content: space-between;" class="sectionTopic">
            <div style="display: flex;align-items:center">
                <h2 style="text-transform: uppercase; margin: 20px 0; padding:0; font-size:20px" class="tituloSection">Informações técnicas</h2>
                <span style="margin-left:10px" class="material-symbols-outlined">info</span>
            </div>
            <span style="font-size: 35px;margin-right: 45px" class="material-symbols-outlined mostrar">expand_less</span>
        </div>
        <div class="infoTecnica">
            <?php 
                echo "{$produto->infoTecnica}";
            ?>
        </div>
    </section>
    <section class="sectionProds container1400">
        <div class="sectionTopic">
            <h2 style="text-transform: uppercase; margin: 20px 0; padding:0; font-size:20px" class="tituloSection">Avaliações</h2>
            <span style="margin-left:10px" class="material-symbols-outlined">reviews</span>
        </div>
        <div class="reviews">
            <?php 
                if($reviewsVazias) {
                    echo "
                            <div class='review'>
                                <p style='opacity:0.5;font-size:18px;font-weight:bold;margin:0; text-align:center'>
                                Nenhuma avaliação até agora!
                                </p>
                            </div>
                        ";
                }else {
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
                                    <p style='margin:0;margin-left:5px;font-size:13px;font-weight:700;opacity:0.7'>
                                        {$rev->dataReview}
                                    </p>
                                </div>
                                <p style='margin:0;font-size:16px;font-weight:bold;margin-left:5px;margin-top:4px'>
                                $nota
                                </p>
                                <p style='font-size:14px;margin-top: 5px;margin-left:5px'>{$rev->comentario}</p>
                            </div>
                        ";
                    }
                }
            ?>
            <div class="btnsReview">
                <div>
                    <?php 
                        if($testeReviews->qtd > 5) {
                            echo "
                                <a href='reviews.php?{$produto->nome}&c=$idProd'>Ver mais avaliações</a>
                            ";
                        }
                        echo "
                            <a href='escreverReview.php?{$produto->nome}&c=$idProd'>Escrever review</a>
                        ";
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section class="sectionProds container1400">
        <div class="sectionTopic">
            <h2 style="text-transform: uppercase; margin-bottom: 0" class="tituloSection">Produtos mais acessados</h2>
            <span style="margin-top: 15px;" class="material-symbols-outlined">ads_click</span>
        </div>
        <div class="produtosMaisAcessados">
                <div class="ant">
                    <span class="material-symbols-outlined">navigate_before</span>
                </div>
                <?php 
                    while($prodMaisAces = $buscaProdutosMaisAces->fetch_object()) {
                        echo "
                            <div class='produtos prodMA' title='{$prodMaisAces->nome}'>
                                <a href='produto.php?{$prodMaisAces->nome}&c={$prodMaisAces->codigo}'>
                                <img src='{$prodMaisAces->imagemProduto}' alt=' width='268' height='162'>
                                <p class='nome'>{$prodMaisAces->nome}</p>
                                <div class='infoPreco'>
                                    <p class='preco'>{$prodMaisAces->precoAvista}</p>
                                    <p class='avisoPix'>À vista no PIX</p>
                                </div>
                                </a>
                                <a href='includes/addCarrinho.php?c={$prodMaisAces->codigo}&preCarrinho=1' class='comprar'>COMPRAR</a>
                            </div>
                            ";
                        }
                    ?>
                <div class="prox">
                    <span class="material-symbols-outlined">navigate_next</span>
                </div>
            </div>
    </section>
    <section class="sectionProds container1400">
        <?php 
                if(isset($_SESSION['user'])) {
                    echo "
                    <div class='sectionTopic'>
                        <h2 style='text-transform: uppercase; margin-bottom: 0' class='tituloSection'>Produtos vistos recentemente</h2>
                        <span style='margin-top: 15px;' class='material-symbols-outlined'>history</span>
                    </div>
                    <div class='produtosHistorico'>
                        <div class='ant'>
                            <span class='material-symbols-outlined'>navigate_before</span>
                        </div>
                    ";
                    while($prodHist = $buscaHistorico->fetch_object()) {
                        echo "
                            <div class='produtos prodHist' title='{$prodHist->nome}'>
                                <a href='produto.php?{$prodHist->nome}&c={$prodHist->codigo}'>
                                <img src='{$prodHist->imagemProduto}' alt=' width='268' height='162'>
                                <p class='nome'>{$prodHist->nome}</p>
                                <div class='infoPreco'>
                                    <p class='preco'>{$prodHist->precoAvista}</p>
                                    <p class='avisoPix'>À vista no PIX</p>
                                </div>
                                </a>
                                <a href='includes/addCarrinho.php?c={$prodHist->codigo}&preCarrinho=1' class='comprar'>COMPRAR</a>
                            </div>
                            ";
                    }
                    echo "
                        <div class='prox'>
                            <span class='material-symbols-outlined'>navigate_next</span>
                        </div>
                    </div>
                    ";
                }
            ?>
            <br>
    </section>
    <?php 
        include_once("includes/footer.php");
    ?>
    <script src="js/sliderMA.js"></script>
    <script src="js/completarSimilar.js"></script>
    <script src="js/mostrarInfoProd.js"></script>
    <?php 
        if(isset($_SESSION["user"])) {
            echo "<script src='js/sliderHist.js'></script>";
        }
    ?>
</body>
</html>