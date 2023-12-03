<?php
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(!isset($_SESSION["user"])) {
        header("Location: entrar.php");
    }
    $user = $_SESSION['user'];
    $erro = $_GET['erro'] ?? "";
    $altDados = $_GET['altDados'] ?? false;
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
    <title>Alterar dados</title>
</head>
<body>
    <?php 
        include_once("includes/header.php");
    ?>
    <section class="container1400">
        <?php 
            if($altDados) {
                echo "
                    <div style='margin-top:20px' class='msgDisplay sucesso'>
                        <p>Dados alterados!</p>
                    </div>
                ";
            }
            if($erro == "nomeUsuario") {
                echo "
                    <div style='margin-top:20px' class='msgDisplay erro'>
                        <p>Nome de usuário já cadastrado!</p>
                    </div>
                ";
            }
            if($erro == "email") {
                echo "
                    <div style='margin-top:20px' class='msgDisplay erro'>
                        <p>Email já cadastrado!</p>
                    </div>
                ";
            }
            if($erro == "cpf") {
                echo "
                    <div style='margin-top:20px' class='msgDisplay erro'>
                        <p>CPF já cadastrado!</p>
                    </div>
                ";
            }
        ?>
        <div style="height:auto;" class="loginForm container1400">
            <h2 style="width: 400px;">Alterar dados</h2>
            <?php 
                echo "
                <form action='includes/alterarDados.php' method='post'>
                <label for='nomeUsuario'>Nome de usuário</label>
                <input type='text' name='nomeUsuario' placeholder='Insira seu nome de usuário' value='{$user->nomeUsuario}' required>
                <label for='email'>Email</label>
                <input type='text' name='email' placeholder='Insira seu e-mail' value='{$user->email}' required>
                <label for='nome'>Nome</label>
                <input type='text' name='nome' placeholder='Insira seu nome' value='{$user->nome}' required>
                <label for='sobrenome'>Sobrenome</label>
                <input type='text' name='sobrenome' placeholder='Insira seu sobrenome' value='{$user->sobrenome}' required>
                <label for='telefone'>Telefone</label>
                <input type='text' name='telefone' placeholder='Insira seu telefone (somente numeros)' class='cadTel' value='{$user->telefone}' required>
                <label for='CPF'>CPF</label>
                <input type='text' name='CPF' placeholder='Insira seu CPF (somente numeros)' class='cadCPF' value='{$user->cpf}' required>
                <label for='senha'>Senha</label>
                <input type='password' name='senha' placeholder='Insira sua senha' required>
                <button type='submit' class='btnForm 2'>
                    <span class='material-symbols-outlined'>edit</span>
                    Aplicar alterações
                </button>
                <a href='minhaConta.php' class='btnForm'>
                    <span class='material-symbols-outlined'>cancel</span>
                    Descartar alterações
                </a>
                </form>
                ";
            ?>
        </div>
    </section>
    <div class='footerPesquisa'>
        <?php 
            include_once("includes/footer.php");
        ?>
    </div>
    <script src="js/formatDados.js"></script>
</body>
</html>