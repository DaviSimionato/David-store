<?php 
    require_once("banco.php");
    require_once("login.php");
    if(isset($_SESSION['user'])) {
        $idProd = $_GET['c'];
        $preCarrinho = $_GET['preCarrinho'] ?? false;
        $idUsuario = $_SESSION['user']->idUsuario;
        $prod = $bd->query("select * from vwProdutos where codigo = '$idProd'")->fetch_object();
        $testCarrinho = $bd->query("select * from carrinho 
        where idProduto = $idProd and idUsuario = $idUsuario")->fetch_object();
        if(is_null($testCarrinho->idProduto)) {
            $bd->query("insert into carrinho (idProduto,idUsuario) 
            values ('$idProd','$idUsuario')");
        }
        if($preCarrinho) {
            header("Location: ../preCarrinho.php?{$prod->nome}&c=$idProd");
        }else {
            header("Location: ../produto.php?{$prod->nome}&c=$idProd&addCart=1");
        }
    }else {
        header("Location: ../entrar.php");
    }
?>