<?php 
    require_once("banco.php");
    require_once("login.php");
    if(isset($_SESSION['user'])) {
        $idUsuario = $_SESSION['user']->idUsuario;
        $newNomeUsuario = $_POST['nomeUsuario'];
        $newEmail = $_POST['email'];
        $newNome = $_POST['nome'];
        $newSobNome = $_POST['sobrenome'];
        $newTel = $_POST['telefone'];
        $newCpf = $_POST['CPF'];
        $senha = $_POST['senha'];
        $testeNomeUsuario = $bd->query("select nomeUsuario from usuarios where nomeUsuario = '$newNomeUsuario' and idUsuario <> $idUsuario");
        $testeEmail = $bd->query("select email from usuarios where email = '$newEmail' and idUsuario <> $idUsuario");
        $testeCpf = $bd->query("select cpf from usuarios where cpf = '$newCpf' and idUsuario <> $idUsuario");
        if($testeNomeUsuario->num_rows > 0) {
            header("Location: ../configConta.php?erro=nomeUsuario");
            die();
        }
        if($testeEmail->num_rows > 0) {
            header("Location: ../configConta.php?erro=email");
            die();
        }
        if($testeCpf->num_rows > 0) {
            header("Location: ../configConta.php?erro=cpf");
            die();
        }
        if(password_verify($senha,base64_decode($_SESSION['user']->senha))) {
            $bd->query("update usuarios set nomeUsuario = '$newNomeUsuario', email = '$newEmail',
            nome = '$newNome', sobrenome = '$newSobNome', telefone = '$newTel', cpf = '$newCpf'
            where idUsuario = $idUsuario");
            header("Location: ../configConta.php?altDados=1");
        }else {
            header("Location: ../configConta.php?erro=senha");
        }
    }else {
        header("Location: ../entrar.php");
    }
?>