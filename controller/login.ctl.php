<?php
require_once 'functions.ctl.php' ;
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    if(empty_input_login($email, $pwd)!==false){
        header("location: ../login.php?error=empty_input");
        exit();
    } 
    login($email, $pwd);
    
}
else{
    header("location: ../login.php");
    exit();
}
?>