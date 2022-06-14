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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet">
    <link rel="stylesheet" href="css/list_apps.css">
    <title>Liste des apprenants</title>
</head>

<body>
    <?php include_once "nav_bar.php" ?>
    <?php  if (isset($_SESSION['message']) && isset($_SESSION['msg_type'])):  ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type']?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']); 
            unset($_SESSION['msg-type']);
            ?>
        </div>
    <?php endif; ?>

    <?php require_once 'controller/functions.ctl.php' ?>

    <div class="container">
        <div class="main_container">
            <div class="search">
                <form  method="POST">
                            <input type="text" name="search" placeholder="Apprenant">
                            <input type="submit" name="submit-search" value="Rechercher" class="btn btn-primary">
                </form>
            </div>
            <table class="table">
                <thead >
                    <tr>
                        <th>
                            Nom
                        </th>
                        <th>
                            Prénom
                        </th>
                        <th>
                            Sexe
                        </th>
                        <th>
                            Dernier diplôme
                        </th>
                        <th>
                            formations
                        </th>
                        <th colspan='2'>Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            // get the data from the database
            
            $result = $_SESSION["user_role"]=="professeur"?get_eleves($id): get_eleves();

            while($row=$result->fetch_assoc()):
            ?>
                    <tr>
                        <td>
                            <?php echo $row['Nom']; ?>
        
                        </td>
                        <td>
                            <?php   echo $row['Prenom']; ?>
                        </td>
                        <td>
                            <?php echo $row['Sexe']; ?>
                        </td>
                        <td>
                            <?php echo $row['Formation_initiale']; ?>
                        </td>
                        <td>
                            <a href="app_training.php?Identifiant=<?php echo $row['Identifiant']; ?>">Voir formations</a>
                        </td>
                        <td>
                            <a href="app_form.php?edit=<?php echo $row['Identifiant']; ?>">
                            <span class="material-icons-outlined" style="color:blue">
                            edit
                            </span>
                            </a>
                            <a href="controller/process_app.ctl.php?delete=<?php echo $row['Identifiant'] ?>" >
                            <span class="material-icons-outlined" style="color:red">
                            delete
                            </span>
                            </a>
        
                        </td>
                    </tr>
                    <?php endwhile ;?>
                </tbody>
            </table>
            <!-- <a class="btn btn-secondary" href="app_form.php"> New Data</a> -->
        </div>
    </div>
    <?php include_once "footer.php"?>
</body>

</html>