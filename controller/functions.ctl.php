<?php
function get_connexion(){
    $server_name='localhost';
    $user_name='root';
    $password='';
    $database='ecole';
    $connexion =  mysqli_connect($server_name, $user_name, $password,$database);
    if(!$connexion)
        die("connection échouée").mysqli_connect_error();
    else 
        return $connexion;
}

function get_eleves(){
    $connexion=get_connexion();
    $query= "SELECT * FROM eleves ORDER BY Nom";
    if(isset($_POST["submit-search"])){
        $searchString=trim(mysqli_real_escape_string($connexion, $_POST['search']));
        if ( !ctype_alnum($searchString) || empty($searchString)){
            echo "entrée invalid !!!";
            exit();
        }  
        else
            $query="SELECT * FROM eleves WHERE NOM LIKE '%$searchString%' OR Prenom  LIKE '%$searchString%' ORDER BY Nom";
    }
    $eleves=mysqli_query($connexion, $query);
    $connexion->close();
    return $eleves;
}
function get_users(){
    $connexion=get_connexion();
    $query= "SELECT u.Id, u.Nom,u.Prenom, u.Sexe, u.DDN,  u.Email,u.pwd,  r.Role as Role FROM utilisateurs as u,`roles`as r WHERE u.Num_role=r.Id ORDER BY Nom";
    if(isset($_POST["submit-search"])){
        $searchString=trim(mysqli_real_escape_string($connexion, $_POST['search']));
        if ( !ctype_alnum($searchString) || empty($searchString)){
            echo "entrée invalid !!!";
            exit();
        }  
        else
            $query="SELECT * FROM utilisateurs WHERE NOM LIKE '%$searchString%' OR Prenom  LIKE '%$searchString%' ORDER BY Nom";
    }
    $eleves=mysqli_query($connexion, $query);
    $connexion->close();
    return $eleves;
}
function get_formations(){
    $connexion=get_connexion();
    $query= "SELECT * FROM formations";
    $formations=$connexion->query($query) or die($connexion->error());
    $connexion->close();
    return $formations;
}
function get_formations_app($identifiant){
    $connexion=get_connexion();

    $query =" SELECT Nom, Prenom, Intitule, Annee  FROM  formations 
    JOIN inscrit_dans
    ON formations.Id_formation= inscrit_dans.Num_formation
    JOIN eleves 
    ON inscrit_dans.Num_eleve=eleves.Identifiant
    WHERE Identifiant =  ?";
    $statement=mysqli_stmt_init($connexion);
    //retourne une erreur dans le cas ou la requete est invalide
    if(!mysqli_stmt_prepare($statement, $query)){
        header("location: ../list.app?error=statementfailed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "s", $identifiant );
    mysqli_stmt_execute($statement);
    $formations= mysqli_stmt_get_result($statement);
    if($formations){
        return $formations;
    }
    else{
        $result=false;
        return $result;
    }
    mysqli_stmt_close($statement);
    $connexion->close();
}
/* ====== signup form validations =====================
   ====================================================*/
function empty_input_signup($nom, $prenom,$ddn,$sexe, $email, $pwd, $rpwd,$role){
     return(empty($nom) || empty($prenom) || empty($ddn)||empty($sexe)||empty($email)  || empty($pwd) || empty($rpwd));
}

function invalid_email($email){
    return(!filter_var($email, FILTER_VALIDATE_EMAIL));   
}

function invalid_pwd($pwd){
    return(!preg_match("/^[a-zA-Z0-9]*$/", $pwd));
}

function pwd_dont_match($pwd, $rpwd){  
    return($pwd !== $rpwd);
}
//Vérifie si l'utilisateur existe dans la bd
//Elle renvoie null si l'utilisateur n'existe pas 
//Elle renvoie l'utilisateur lui même s'il en existe
function user_exists( $email){
    $connexion=get_connexion();
    $query ="SELECT u.Nom,u.Prenom, u.DDN,  u.Email,u.pwd,  r.Role as Role FROM utilisateurs as u,`roles`as r WHERE u.Num_role=r.Id AND Email=?";
    $statement=mysqli_stmt_init($connexion);
    //retourne une erreur dans le cas ou la requete est invalide
    if(!mysqli_stmt_prepare($statement, $query)){
        header("location: ../singup.php?error=statementfailed");
        exit();
    }

    mysqli_stmt_bind_param($statement, "s", $email );
    mysqli_stmt_execute($statement);
    //mysqli_stmt_get_result: Retourne un jeu de résultats pour les requêtes SELECT réussies, ou false en cas d'échec
    $user= mysqli_stmt_get_result($statement);
    //mysqli_fetch_assoc: Renvoie un tableau associatif représentant la ligne extraite, où chaque clé du tableau représente le nom d'une des colonnes du jeu de résultats, null s'il n'y a plus de lignes
    return mysqli_fetch_assoc($user);
    mysqli_stmt_close($statement);
    $connexion->close();
}

function create_user($nom, $prenom, $ddn, $sexe,  $email, $pwd, $role ){
    $connexion=get_connexion();
    $query ="INSERT INTO utilisateurs (Nom,  Prenom,DDN, Sexe, Email, pwd, Num_role) VALUES (?,?,?,?,?,?,?)";
    $statement=mysqli_stmt_init($connexion);
    //retourne une erreur dans le cas ou la requete est invalide
    if(!mysqli_stmt_prepare($statement, $query)) {
        header("location: ../singup.php?error=statementfailed");
        exit();
    }
    //hash pwd
    $hashed_pwd=password_hash($pwd, PASSWORD_DEFAULT);
    //Add parameters
    mysqli_stmt_bind_param($statement, "ssssssi",$nom, $prenom, $ddn, $sexe, $email, $hashed_pwd, $role );
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    //récupérer le dernier id inséré
    $user_id=get_inserted_user_id();
    if($role!=1)
        insert_into_app_or_prof($role, $nom, $prenom, $ddn, $sexe, $email,$user_id);
    $connexion->close();
    header("location: ../users_list.php");
    exit();  
}

function get_inserted_user_id(){
    $connexion=get_connexion();
    //Initialize a statement and return an object to use with stmt_prepare():
    $statement=mysqli_stmt_init($connexion);
    $query ="SELECT MAX(Id) as Id FROM utilisateurs";
    if(!mysqli_stmt_prepare($statement, $query)){
        header("location: ../singup.php?error=statementfailed");
        exit();
    }
    mysqli_stmt_execute($statement);
    $result= mysqli_stmt_get_result($statement);
    $row=mysqli_fetch_assoc($result);
    return $row["Id"];
    mysqli_stmt_close($statement);
    $connexion->close();
}
function insert_into_app_or_prof($role, $nom, $prenom, $ddn, $sexe, $email,$user_id){
    $query;
    switch ($role) {
        case 2:
            $query ="INSERT INTO professeurs (Nom,  Prenom,DDN, Sexe, Email,num_utilisateur ) VALUES (?,?,?,?,?,?)";
            break;
        case 3:
            $query ="INSERT INTO eleves (Nom,  Prenom,DDN, Sexe, Email,num_utilisateur) VALUES (?,?,?,?,?,?)";
            break;
    }
    $connexion=get_connexion();
    $statement=mysqli_stmt_init($connexion);
    if(!mysqli_stmt_prepare($statement, $query)) {
        header("location: ../singup.php?error=statementfailed");
        exit();
    }
    //Add parameters
    mysqli_stmt_bind_param($statement, "sssssi",$nom, $prenom, $ddn, $sexe, $email, $user_id );
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    $connexion->close();      
}
// login functions
function empty_input_login($email, $pwd){
    return(empty($email) ||  empty($pwd));

}

function login($email, $pwd){
    $user=user_exists($email);
    var_dump ($user);
    if($user ===null){
        header("location: ../login.php?error=user_not_found");
        exit();
    }
    $pwd_hashed=$user["pwd"];
    //password_verify — Vérifie qu'un mot de passe correspond à un hachage
    //Retourne true si le mot de passe et le hachage correspondent, ou false sinon.
    if(password_verify($pwd, $pwd_hashed)==false){
        header("location: ../login.php?error=wrong_password");
        exit();
    }
    else{
        session_start();
        $_SESSION["user_lname"]=$user["Nom"];
        $_SESSION["user_fname"]=$user["Prenom"];
        $_SESSION["DDN"]=$user["DDN"];
        $_SESSION["Email"]=$user["Email"];
        $_SESSION["user_role"]=$user["Role"];
        $_SESSION["logged_in"]=true;
        header("location: ../index.php");
        exit();
    } 
}





?>