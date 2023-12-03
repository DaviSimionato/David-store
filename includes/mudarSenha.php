<?php 
    require_once("banco.php");
    
    if($_POST) {
        $termoLogin = $_POST['loginEmail'];
        $newSenha = $_POST['senha'];
        $newSenhaRep = $_POST['senhaRep'];
        $respostaSecreta = $_POST['respostaSecreta'];
        $testeAcesso = $bd->query("select * from usuarios where nomeUsuario = '$termoLogin'
        or email = '$termoLogin' or cpf = '$termoLogin' limit 1")->fetch_object();
        if($newSenha != $newSenhaRep) {
            header("Location: ../recuperarSenha.php?erro=senhaRep");
            die();
        }
        if(is_null($testeAcesso)) {
            header("Location: ../recuperarSenha.php?erro=termoInex");
            die();
        }else {
            $idUsuario = $testeAcesso->idUsuario;
            if(password_verify($respostaSecreta,base64_decode($testeAcesso->respostaPergunta))) {
                $senhaSegura = base64_encode(password_hash($newSenha,PASSWORD_DEFAULT));
                $bd->query("update usuarios set senha = '$senhaSegura' where idUsuario = $idUsuario");
                header("Location: ../entrar.php?senhaAlter=1");
            }else {
                header("Location: ../recuperarSenha.php?erro=resposta");
            }
        }
    }
?>