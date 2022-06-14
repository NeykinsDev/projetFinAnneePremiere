<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/nav_bar.css">
</head>
<body>
<header>
    <div class="logo"><span class="highlight">
        <img src="images/logo_ecole.png">
    </div>
    <nav>
    <a href="index.php" class="mybutton">Accueil</a>
    <a href="#" class="mybutton">Contact</a>
    <?php if(isset($_SESSION["logged_in"])):?>
        <a href="#" class="mybutton">Profil</a>
        <?php if($_SESSION["user_role"]=="admin"):?>
            <a href="signup.php" class="mybutton">Ajouter un utilisateurs</a>
        <?php endif;?>
    <a href="controller/logout.php" class="mybutton">Se déconnecter</a>
    <span class="role"> <?php echo "Bonjour ".$_SESSION["user_lname"]." : ".$_SESSION["user_role"];?> </span>
    <?php else: ?>
        <a href="login.php" class="mybutton">Log in</a>
    <?php endif;?>
    </nav>
</header>
</body>
</html>