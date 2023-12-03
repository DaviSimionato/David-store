<?php 
    require_once("banco.php");
    require_once("login.php");
    if(!isset($_SESSION['user'])) {
        header("Location: ../entrar.php");
        die();
    }
    $idProd = $_GET["c"];
    $nomeProd = $_GET['n'];
    $favLink = $_GET['favUser'] ?? "";
    $idUsuario = $_SESSION['user']->idUsuario;
    $testeFav = $bd->query("select idProduto from favoritos where idProduto = $idProd and idUsuario = $idUsuario");
    if($testeFav->num_rows > 0) {
        $bd->query("delete from favoritos where idProduto = $idProd and idUsuario = $idUsuario");
    }else {
        $bd->query("insert into favoritos (idUsuario,idProduto) values ('$idUsuario','$idProd')");
    }
    if($favLink) {
        header("Location: ../favoritos.php");
    }else {
        header("Location: ../produto.php?$nomeProd&c=$idProd");
    }
?>