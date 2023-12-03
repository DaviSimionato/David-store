<?php
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(isset($_SESSION['user'])) {
        header("Location: index.php");
    }
    $erro = $_GET['erro'] ?? "";
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
        if($erro == "senhaRep") {
            echo "
                <div style='margin-top:20px' class='msgDisplay erro'>
                    <p>As senhas inseridas são diferentes!</p>
                </div>
                ";
        }
        if($erro == "termoInex") {
            echo "
                <div style='margin-top:20px' class='msgDisplay erro'>
                    <p>Nenhum usuário encontrado!</p>
                </div>
                ";
        }
        if($erro == "resposta") {
            echo "
                <div style='margin-top:20px' class='msgDisplay erro'>
                    <p>Resposta incorreta!</p>
                </div>
                ";
        }
    ?>
    <div class="loginForm container1400">
        <h2 style="width: 400px;margin-top:80px">Alterar senha</h2>
        <form action="includes/mudarSenha.php" method="post">
            <label for="loginEmail">Email, CPF ou Nome de usuário</label>
            <input type="text" name="loginEmail" placeholder="Insira seu e-mail">
            <label for="senha">Insira uma nova senha</label>
            <input type="password" name="senha" placeholder="Insira sua senha">
            <label for="senhaRep">Repita a senha</label>
            <input type="password" name="senhaRep" placeholder="Insira sua senha novamente">
            <label for="respostaSecreta">Resposta da pergunta secreta</label>
            <input type="tex" name="respostaSecreta" placeholder="Insira sua resposta">
            <button type="submit" class="btnForm">
                <span class="material-symbols-outlined">login</span>
                Mudar senha
            </button>
        </form>
    </div>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
</body>
</html>