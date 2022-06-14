<?php
require_once "functions.ctl.php";
if (isset($_POST["signup"])){
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $ddn =$_POST["ddn"];
    $sexe=$_POST["sexe"];
    $email=$_POST["email"];
    $role=$_POST["role"];
    $pwd =$_POST["pwd"];
    $rpwd=$_POST["rpwd"];
    //validation des entrées:
    if(empty_input_signup($nom, $prenom, $ddn, $sexe,$email, $pwd, $rpwd, $role)){
        header("location:../signup.php?error=empty_input");
        exit();
    }
    if(invalid_email($email)){
        header("location:../signup.php?error=invalid_email");
        exit();
    }
    if(invalid_pwd($pwd)){
        header("location:../signup.php?error=invalid_pwd");
        exit();
    }
    if(pwd_dont_match($pwd, $rpwd)){
        header("location:../signup.php?error=pwd_dont_match");
        exit();
    }
   // if(user_exists($email) !==null)//equivalent à
    if(user_exists($email)!==null)
    {
        header("location:../signup.php?error=user_exists");
        exit();
    }
    create_user($nom, $prenom, $ddn, $sexe,  $email, $pwd, $role );
    
}
?>