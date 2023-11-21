<?php 
    require_once("includes/login.php");
    $contaCriada = $_GET['contaCriada'] ?? false;
    $credIncor = $_GET['credIncor'] ?? false;
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
    <div class="loginForm container1400">
        <?php 
            if($contaCriada) {
                echo "
                    <div class='msgDisplay sucesso'>
                        <p>Conta criada com sucesso!</p>
                    </div>
                ";
            }
            if($credIncor) {
                echo "
                    <div class='msgDisplay erro'>
                        <p>Credenciais incorretas!</p>
                    </div>
                ";
            }
        ?>
        <h2>Fazer Login</h2>
        <form action="includes/login.php" method="post">
            <label for="loginEmail">Email, CPF ou Nome de usuário</label>
            <input type="text" name="loginEmail" placeholder="Insira seu e-mail">
            <label for="loginSenha">Senha</label>
            <input type="password" name="loginSenha" placeholder="Insira sua senha">
            <button type="submit" class="btnForm">
                <span class="material-symbols-outlined">login</span>
                Entrar
            </button>
            <div style="display: flex;justify-content: space-between" class="optsLogin">
                <div class="irCadastro">
                    <p style="font-size: 13px;margin-top: 5px;color:#63686e">
                        Não tem uma conta 
                        <a href="cadastrar.php" style="color:#E8772E;font-weight:700;text-decoration:underline">cadastre-se</a>
                    </p>
                </div>
                <div class="esqueceuSenha">
                    <a href="recuperarSenha.php" style="color:#7F858D;font-weight:700;text-decoration:underline;font-size:13px">Esqueci a senha</a>
                </div>
            </div>
        </form>
    </div>
    <div class="footerPesquisa">
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
</body>
</html>