<?php 
    session_start();
    if(!isset($_SESSION['auth'])){
        header("Location:/ManageShop/form-login.php");
    }
?>