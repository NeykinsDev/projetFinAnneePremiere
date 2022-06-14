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
    <title>Statistiques</title>
</head>
<body>
    <h1>Quelques statistiques:</h1>
</body>
</html>