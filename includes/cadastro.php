<?php 
    require_once("banco.php");
    require_once("login.php");

    if($_POST) {
        $nome = $_POST['cadastroNome'];
        $sobrenome = $_POST['cadastroSobrenome'];
        $nomeUsuario = $_POST['cadastroNomeUsuario'];
        $email = $_POST['cadastroEmail'];
        $telefone = $_POST['cadastroTelefone'];
        $cpf = $_POST['cadastroCPF'];
        $senha = $_POST['cadastroSenha'];
        $senhaRep = $_POST['cadastroSenhaRep'];
        $perguntaSecreta = $_POST['perguntaSecreta'];
        $perguntaSecretaResposta = $_POST['perguntaSecretaResposta'];
        $testeVazio = [];
        array_push($testeVazio,$nome,$sobrenome,$nomeUsuario,$email,$telefone,
        $cpf,$senha,$senhaRep,$perguntaSecreta,$perguntaSecretaResposta);
        for($i =0;$i<sizeof($testeVazio);$i++) {
            if(empty($testeVazio[$i])) {
                header("Location: ../cadastrar.php?erroVazio=1");
                die();
            }
        }
        if(strlen($telefone) < 15 || strlen($cpf) < 14) {
            header("Location: ../cadastrar.php?erroCpfOuTelefone=1");
            die();
        }
        if($senha != $senhaRep) {
            header("Location: ../cadastrar.php?erroSenhasDiferentes=1");
            die();
        }
        $testeCredenciaisJaCadastradas = $bd->query("select * from usuarios where nomeUsuario = '$nomeUsuario'
        or email = '$email' or cpf = '$cpf' limit 1")->fetch_object();
        if(is_null($testeCredenciaisJaCadastradas)) {
            $senhaCadastro = base64_encode(password_hash($senha, PASSWORD_DEFAULT));
            $respostaSecreta = base64_encode(password_hash($perguntaSecretaResposta, PASSWORD_DEFAULT));
            $bd->query("insert into usuarios (nomeUsuario,email,nome,sobrenome,telefone,cpf,perguntaSecreta,respostaPergunta,tipo,senha)
            values ('$nomeUsuario','$email','$nome','$sobrenome','$telefone','$cpf','$perguntaSecreta',
            '$respostaSecreta','cliente','$senhaCadastro')");
            header("Location: ../entrar.php?contaCriada=1");
        }else {
            header("Location: ../cadastrar.php?erroCredenciaisRepetidas=1");
            die();
        }
    }
?>