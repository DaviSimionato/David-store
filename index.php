<?php 
    require_once("includes/banco.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo/davidstore-icon.ico" type="image/ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title>David'store</title>
</head>
<body>
    <header>
        <div class="header">
            <span class="material-symbols-outlined menuLateral">menu</span>
            <img src="logo/svg/logo-no-background.svg" alt="Logo" height="20">
            <div class="barraPesquisa">
                <input type="text" name="pesquisa" class="pesqBar">
                <span class="material-symbols-outlined">search</span>
            </div>
            <div class="user">
            <span class="material-symbols-outlined">account_circle</span>
            <p></p>
            </div>
        </div>
    </header>
</body>
</html>