<?php
    require_once("includes/banco.php");
    require_once("includes/login.php");
    if(!isset($_SESSION["user"])) {
        header("Location: entrar.php");
    }
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
    <title>Meu perfil</title>
</head>
<body style="background-color:#F2F3F4;">
    <?php 
        include_once("includes/header.php");
    ?>
    <section class="container1400">
        <div class="userIntro">
            <div class="infoUser">
                <span style="font-size: 60px;margin: 0 20px" class="material-symbols-outlined">account_circle</span>
                <?php 
                    echo "
                    <div class='bemVindo'>
                        <h2 style='margin:0'>Bem vindo, {$_SESSION['user']->nomeUsuario}</h2>
                        <div class='emailUsuario'>
                            <span style='font-size: 16px;margin-right:5px' class='material-symbols-outlined'>mail</span>
                            <p style='margin:0'>{$_SESSION['user']->email}</p>
                        </div>
                    </div>
                    ";
                ?>
            </div>
            <div class="configConta">
                <a href='#'>
                    <span style='font-size: 50px;margin-right:30px;margin-top:10px' class='material-symbols-outlined config'>settings</span>
                </a>
            </div>
        </div>
        <div class="ultimoPedido">
            
        </div>
    </section>
</body>
</html>