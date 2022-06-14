<?php 
session_start();
if(!isset($_SESSION['logged_in']))
    header("location: login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Accueil</title>
</head>
<body>
<?php include_once "nav_bar.php"?>
<div class="container">
    <?php if ($_SESSION["user_role"]=="admin"): ?>
    <div class="card">
        <a href="apps_list.php">
                <img src="images/apps.jpg" alt="Liste d'apprenants">
        </a>
    </div>
    <?php endif;?>
    <div class="card">
        <a href="training_list.php">
            <img src="images/training.png" alt="">
        </a>
    </div>
    <?php if ($_SESSION["user_role"]=="admin"): ?>
    <div class="card">
        <a href="teachers_list.php">
            <img src="images/professors.png" alt="Liste de professeurs">
        </a>
    </div>
    <?php endif;?>
    <div class="card">
        <a href="classes_list.php">
            <img src="images/classes.jpg" alt="Liste de formations ">
        </a>
    </div>
    <?php if ($_SESSION["user_role"]=="admin"): ?>
    <div class="card">
        <a href="poles_list.php">
            <img src="images/poles.jpeg" alt="Liste de pôles">
        </a>
    </div>
    <?php endif;?>
    <div class="card">
        <a href="statistics.php">
            <img src="images/statistics.jpg" alt="Statistiques">
        </a>
    </div>
</div>
<?php include_once "footer.php"?>
</body>

</html>