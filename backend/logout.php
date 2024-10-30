<?php  
session_start();
session_destroy();
header("Location:/ManageShop/form-login.php");
?>