<?php 
    require_once("banco.php");
    require_once("login.php");
    if(isset($_SESSION["user"])) {
        $idProd = $_GET["c"];
        $idUsuario = $_SESSION["user"]->idUsuario;
        $bd->query("delete from carrinho where idProduto = '$idProd' and idUsuario = '$idUsuario'");
    }
    header("Location: ../carrinho.php");
?>