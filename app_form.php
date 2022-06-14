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
    <link rel="stylesheet" href="css/app_form.css">
    <title> Inscription élève</title>
</head>

<body>
<?php include "nav_bar.php" ;?>
<?php require_once "controller/process_app.ctl.php"?>
<?php // get the data from the database
        $formations=get_formations();
?>
<?php include_once "nav_bar.php"?>

<div class="container">
    <p> Inscription d'un nouvel étudiant: </p>
    <form action="controller/process_app.ctl.php" method="post">
            <input type="text" name="id" <?php   if($update):?> value="<?php echo $id ?>" <?php endif;?> hidden>
            <label for="nom"> Nom:</label>
            <input type="text" name="nom"<?php   if($update):?> value="<?php echo $nom ?>" <?php endif;?> placeholder="Nom">
            <label for="prenom"> Prénom:</label>
            <input type="text"  name="prenom" <?php   if($update):?> value="<?php echo $prenom ?>" <?php endif;?>placeholder="Prénom">
            <label for="ddn"> Date de naissance:</label>    
            <input type="date" <?php   if($update):?> value="<?php echo $ddn ?>" <?php endif;?> class="ddn">
            <label> Sexe</label>

            <div class="radio-btn">
                <input type="radio" name="sexe" value="M" <?php   if($update && $sexe=='M'):?> checked <?php endif;?>><span>M</span>
                <input type="radio" name="sexe" value="F" <?php   if($update && $sexe=='F'):?> checked <?php endif;?>><span>F</span>
            </div>
            <label for="email"> Adresse mail:</label>
            <input type="email" name="email" <?php   if($update):?> value="<?php echo $email ?>" <?php endif;?>placeholder="email">
            <label for="telephone"> Numéro de téléphone:</label>
            <input type="text" name="telephone" <?php   if($update):?> value="<?php echo $telephone ?>" <?php endif;?> placeholder="téléphone">
            <label for="diplome"> Formation initiale:</label>
            <input type="text" name="diplome" <?php   if($update):?> value="<?php echo $diplome ?>" <?php endif;?> placeholder="Formation initiale">
            <label for="photo"> Insérer la photo:</label>
            <input type="file" name="photo" id="photo">
            
            <div class="submit">
                <?php if(!$update): ?>
                    <input type="submit" name="post_app" value="Envoyer">
                <?php else: ?>
                    <input type="submit" name="update" value="Update">
                <?php endif; ?>
            </div>
    </form>
</div>
<?php include_once "footer.php"?>
</body>

</html>