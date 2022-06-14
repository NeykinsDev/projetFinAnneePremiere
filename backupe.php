
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
    <?php require_once 'controller/functions.ctl.php' ;
    include "nav_bar.php" ?>
    <div class="container">
    <?php  if (isset($_SESSION['message']) && isset($_SESSION['msg_type'])):  ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type']?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']); 
            unset($_SESSION['msg-type']);
            ?>
        </div>
    <?php endif; ?>
    <div class="main_container">
        <div class="search">
            <form  method="POST">
                            <input type="text" name="search" placeholder="Apprenant">
                            <input type="submit" name="submit-search" value="Rechercher" class="btn btn-primary">
            </form>
        </div>
        <table class="table">
            <thead class="text-white">
            <tr>
                <th>Intitulé de la formation</th>
                <th>langue</th>
                <th>Type</th>
                <th>Durée </th>
                <th colspan='2'>Action </th>
            </tr>
            </thead>
            <tbody>
            <?php
            // get the data from the database
            $result=get_formations();
            while($row=$result->fetch_assoc()):
            ?>
            <tr>
                <td>
                    <?php echo $row['intitule']; ?>
                </td>
                <td>
                    <?php   echo $row['Langue']; ?>
                </td>
                <td>
                    <?php echo $row['Type']; ?>
                </td>
                <td>
                    <?php echo $row['Duree_annee']; ?>
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
            <a class="btn btn-secondary" href="app_form.php"> New Data</a>
        </div>
    </div>
    <?php include_once "footer.php"?>
</body>

</html>