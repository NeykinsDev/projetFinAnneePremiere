<h1> page recherche</h1>
<div>
<?php
require_once "functions.ctl.php";
$connexion=get_connexion();
if(isset($_POST["submit-search"])){
   
    $searchString=mysqli_real_escape_string($connexion, $_POST['search']);
    if ($searchString === "" || !ctype_alnum($searchString) || $searchString < 3) {
        echo "Invalid search string";
        exit();
    }
    $sql="SELECT * FROM eleves WHERE NOM LIKE '%$searchString%' OR Prenom  LIKE '%$searchString%'";
    $result=mysqli_query($connexion, $sql);
    $query_result=mysqli_num_rows($result);
    if($query_result > 0){
        while($row=$result->fetch_assoc()){
            echo $row["Nom"]."<br>";
            echo $row["Prenom"];

        }
        
    }
    else {
       echo "Il n'y a pas d'élève" ;
    }
}


?>



</div>