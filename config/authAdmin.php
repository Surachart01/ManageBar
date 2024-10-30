<?php 
    session_start();
    if(!isset($_SESSION['auth'])){
        header("Location:/ManageShop/form-login.php");
    }else{
        if($_SESSION['auth']->role == 1){
            header("Location:/ManageShop/user/index.php");
        }
    }
?>

<link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">


