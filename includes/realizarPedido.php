<?php 
    require_once("login.php");
    if(isset($_SESSION['user'])) {
        function cadastrarPedido() {
            require("banco.php");
            $tipoPag = $_GET['fPag'] ?? "";
            $idUsuario = $_SESSION['user']->idUsuario;
            $totalCompra = $bd->query("
            select concat('R$',format(sum(precoOriginal) + 25,2,'de_DE')) 'precoParcel', 
            concat('R$',format(sum(precoAvistaVlr) + 25,2,'de_DE')) 'precoAvista'
            from vwCarrinho where idUsuario = '$idUsuario'")->fetch_object();
            $numeroPedido = floor(mt_rand(1000000,9999999));
            $testeBd = $bd->query("select idPedido from pedidos where numeroPedido = $numeroPedido");
            if($testeBd->num_rows > 0) {
                cadastrarPedido();
            }else {
                if($tipoPag == "pix") {
                    $totalPedido = $totalCompra->precoAvista;
                }else {
                    $totalPedido = $totalCompra->precoParcel;
                }
                $dataPedido = date("d/m/Y");
                $bd->query("insert into pedidos (numeroPedido,totalPedido,dataPedido,idUsuario)
                values ($numeroPedido,'$totalPedido','$dataPedido',$idUsuario)");
                $itens = $bd->query("select * from vwCarrinho where idUsuario = $idUsuario");
                while($prod = $itens->fetch_object()) {
                    $bd->query("insert into itensPedido (idproduto,numeroPedido)
                    values ('{$prod->codigo}','$numeroPedido')");
                }
                $bd->query("delete from carrinho where idUsuario = $idUsuario");
                header("Location: ../compraRealizada.php?compra=$numeroPedido");
            }
        }
        cadastrarPedido();
    }else {
        header("Location: ../login.php");
    }
?>