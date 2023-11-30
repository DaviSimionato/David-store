<?php 
    require("login.php");
    session_destroy();
    header("Location: ../index.php");
?>