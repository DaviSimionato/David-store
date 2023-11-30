<?php 
    require_once("banco.php");
    require_once("login.php");

    if(!isset($_SESSION['user'])) {
        header("Location: ../entrar.php");
    }else {
        $idUsuario = $_SESSION['user']->idUsuario;
        $idProduto = $_POST['idProduto'];
        $nota = $_POST['nota'];
        $comentario = $_POST['comentario'];
        $dataReview = date("d/m/Y");
        if($comentario == "") {
            $comentario = "Nenhum comentário";
        }
        $bd->query("insert into reviews (nota,idUsuario,idProduto,comentario, dataReview)
        values ('$nota','$idUsuario','$idProduto','$comentario','$dataReview')");
        $produto = $bd->query("select * from vwProdutos where codigo = $idProduto")->fetch_object();
        header("Location: ../produto.php?{$produto->nome}&c=$idProduto&reviewFeita=1");
    }
?>