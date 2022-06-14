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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/training_form.css">
    <title> Ajouter une formation </title>
</head>

<body>
<?php include "nav_bar.php" ;?>
<?php require_once "controller/process_training.ctl.php"?>
<?php 
        $formations=get_formations();
?>
<?php include_once "nav_bar.php"?>

<div class="container">
    <p> Ajouter une Formation: </p>
    <form action="controller/process_training.ctl.php" method="post">
            <label for="intitule"> Intitulé:</label>
            <input type="text" name="intitule"<?php   if($update):?> value="<?php echo $intitule ?>" <?php endif;?> placeholder="Intitule">
            <label for="duree"> Durée de la  formation:</label>
            <input type="text" name="duree" <?php   if($update):?> value="<?php echo $duree ?>" <?php endif;?> placeholder="Nombre d'années">
            <label for="langue"> Langue:</label>    
            <div class="radio-btn">
                <input type="radio" name="langue" value="FR" <?php   if($update && $langue=='FR'):?> checked <?php endif;?>><span>FR
                </span>
                <input type="radio" name="langue" value="NL" <?php   if($update && $langue=='NL'):?> checked <?php endif;?>>
                <span>NL</span>
                <input type="radio" name="langue" value="EN" <?php   if($update && $langue=='EN'):?> checked <?php endif;?>>
                <span>EN</span>
            </div>
            <label for="type_formation"> Type de formation:</label>
            <div class="radio-btn">
                <input type="radio" name="type_formation" value="général" <?php   if($update && $type_formation=='général'):?> checked <?php endif;?>><span>Général
                </span>
                <input type="radio" name="type_formation" value="professionnel" <?php   if($update && $type_formation=='professionnel'):?> checked <?php endif;?>>
                <span>Professionnel</span>
            </div>
            <div class="submit">
                <?php if(!$update): ?>
                    <input type="submit" name="post_training" value="Envoyer">
                <?php else: ?>
                    <input type="submit" name="update_training" value="Update">
                <?php endif; ?>
            </div>
    </form>
</div>
<?php include_once "footer.php"?>
</body>

</html>