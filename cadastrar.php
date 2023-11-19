<?php 
    require_once("includes/login.php");
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
    <title>Entrar</title>
</head>
<body>
    <?php 
        include_once("includes/header.php");
    ?>
    <div style="display: block; height:auto" class="loginForm container1400">
        <h2>Criar Conta</h2>
        <form action="includes/cadastro.php" method="post">
            <label for="cadastroNome">Nome</label>
            <input type="text" name="cadastroNome" placeholder="Insira seu nome">
            <label for="cadastroSobrenome">Sobrenome</label>
            <input type="text" name="cadastroSobrenome" placeholder="Insira seu sobrenome">
            <label for="cadastroNome">Nome de usuário</label>
            <input type="text" name="cadastroNomeUsuario" placeholder="Insira seu nome de usuário">
            <label for="cadastroEmail">Email</label>
            <input type="email" name="loginEmail" placeholder="Insira seu e-mail">
            <label for="cadastroTelefone">Telefone</label>
            <input type="text" name="cadastroTelefone" placeholder="Insira seu telefone (somente numeros)" class="cadTel">
            <label for="cadastroCPF">CPF</label>
            <input type="text" name="cadastroCPF" placeholder="Insira seu CPF (somente numeros)" class="cadCPF">
            <label for="loginSenha">Senha</label>
            <input type="password" name="loginSenha" placeholder="Insira sua senha">
            <label for="loginSenhaRep">Repita a senha</label>
            <input type="password" name="loginSenhaRep" placeholder="Insira sua senha novamente">
            <label for="perguntaSecreta">Crie uma pergunta secreta</label>
            <input type="text" name="perguntaSecreta" placeholder="Será utilizada para recuperar a senha">
            <label for="perguntaSecretaResposta">Resposta da pergunta secreta</label>
            <input type="text" name="perguntaSecretaResposta" placeholder="Insira a resposta da pergunta secreta">
            <button type="submit" class="btnForm">
                <span class="material-symbols-outlined">login</span>
                Criar conta
            </button>
            <div style="display: flex;justify-content: space-between" class="optsLogin">
                <div class="irCadastro">
                    <p style="font-size: 13px;margin-top: 5px;color:#63686e">
                        Já tem uma conta? 
                        <a href="entrar.php" style="color:#E8772E;font-weight:700;text-decoration:underline">Entrar</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
    <script src="js/formatDados.js"></script>
</body>
</html>