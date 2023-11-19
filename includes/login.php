<?php
    require_once("banco.php");
    session_start();

    if($_POST) {
        $termoLogin = $_POST["loginEmail"];
        $senha = $_POST["loginSenha"];
        $testeAcesso = $bd->query("select * from usuarios where nomeUsuario = '$termoLogin'
        or email = '$termoLogin' or cpf = '$termoLogin' limit 1")->fetch_object();
        if(!is_null($testeAcesso)) {
            $senhaUser = base64_decode($testeAcesso->senha);
            if(password_verify($senha, $senhaUser)) {
                $_SESSION["user"] = $testeAcesso;
                header("Location: ../index.php");
            }else {
                header("Location: ../entrar.php?erro=credIncor");
            }
        }else {
            header("Location: ../entrar.php?erro=credIncor");
        }
    }
?>