
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>Sign up</title>
</head>
<body>
<?php include_once "nav_bar.php"?>
    <div class="container">
        <form  method="post" action="controller/signup.ctl.php">
                <div class="form-right">
                    <h1>Nouvelle utilisateur</h1>
                    <input type="text" name="nom" placeholder="Nom">
                    <input type="text" name="prenom" placeholder="Prénom">
                    <label for="ddn">Date de naissance:</label>
                    <input type="date" name="ddn" placeholder="date de naissance" class="form-control">
                    <label> Sexe</label>
                    <div class="radio-btn">
                        <input type="radio" name="sexe" value="M" checked ><span>M</span>
                        <input type="radio" name="sexe" value="F"  checked ><span>F</span>
                        <input type="text" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-left">

                    <div class="select">
                        <select name="role">
                            <option class="selected" selected disabled> Choisissez un rôle:</option>
                            <option value=1> Administrateur</option>
                            <option value=2> Professeur </option>
                            <option value=3> Apprenant </option>
                        </select>
                    </div>
                    <input type="password" name="pwd" placeholder="Mot de passe">
                    <input type="password" name="rpwd" placeholder="Répéter le mot de passe">
                    <input type="submit" name="signup" value="Enregistrer" class="btn btn-secondary">
                    <?php
                        if(isset($_GET["error"])){
                        if($_GET["error"] =="empty_input"){
                        echo "<p style=color:red>  Champ vide !!! </p>";
                        }
                        elseif($_GET["error"] =="invalid_uid"){
                            echo "<p style=color:black>  Nom utilisateur invalid  !!! </p>";
                        }
                        elseif($_GET["error"] =="invalid_email"){
                            echo "<p style=color:red>  Email invalid !!! </p>";
                        }
                        elseif($_GET["error"] =="passwords_dont_match"){
                            echo "<p style=color:red>  Les deux mot de passe sont différents !!! </p>";
                        }
                        elseif($_GET["error"] =="user_exists"){
                            echo "<p style=color:red>  utilisateur existe dejà !!! </p>";
                        }
                        elseif($_GET["error"] =="statement_failed"){
                            echo "<p style=color:red>  Problème quelque part !!! </p>";
                        }
                        elseif($_GET["error"] =="none"){
                            echo "<p style=color:red>  Signup success !!! </p>";
                        }
                    }
                ?>
                </div>
                
            
        </form>
    </div>
    
    <?php include_once "footer.php"?>
</body>

</html>