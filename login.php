<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>login </title>
</head>

<body>
    <form action="controller/login.ctl.php" method="post">
        <h1>Login</h1>
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <input type="submit" name="login" value="login">
        <?php
        
        if(isset($_GET["error"])){
            if($_GET["error"] =="empty_input"){
            echo "<p style=color:red>  Champ vide !!! </p>";
            }
            if($_GET["error"] =="user_not_found"){
                echo "<p style=color:red>  Utilisateur pas trouvé !!! </p>";
            }
            elseif($_GET["error"] =="wrong_password"){
                echo "<p style=color:red>   Mot de passe ou nom utilisateur incorrecte  !!! </p>";
            }
        }
    ?>
    </form>
</body>

</html>