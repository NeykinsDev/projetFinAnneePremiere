<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app_training.css">
    <style>
        .my_container{
            padding:2rem;
            gap:2rem;
            height: 35rem;
            width: 1024px;
            margin: auto;
            display: flex;
            justify-content: space-around;
            align-content: stretch;
            flex-wrap: wrap;
        }

    </style>
    <title> Formation d'un élève</title>
</head>

<body>
<?php include_once "nav_bar.php"?>
<?php require_once 'controller/functions.ctl.php' ; ?>
<div class="my_container">
    <h1> Liste des formations de   : </h1>
    
    <?php 
    if(isset($_GET["Identifiant"]))
        $identifiant=$_GET["Identifiant"];
        $formations= get_formations_app($identifiant);
    ?>  
     
     <table class="table">
                <thead>
                    <tr>
                        <th>
                            Nom
                        </th>
                        <th>
                            Prénom
                        </th>
                        <th>
                            Intitulé
                        </th>
                        <th>
                            Année
                        </th>
   
                    </tr>
                </thead>
                <tbody>
                    <?php
            // get the data from the database
            while($row=$formations->fetch_assoc()):
            ?>
                    <tr>
                        <td>
                            <?php echo $row['Nom']; ?>
        
                        </td>
                        <td>
                            <?php   echo $row['Prenom']; ?>
                        </td>
                        <td>
                            <?php echo $row['Intitule']; ?>
                        </td>
                        <td>
                            <?php echo $row['Annee']; ?>
                        </td>
                        
                    </tr>
                    <?php endwhile ;?>
                </tbody>
            </table>
    



</div>
<?php include_once "footer.php"?>
</body>

</html>