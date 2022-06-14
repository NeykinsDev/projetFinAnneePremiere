<?php
require_once "functions.ctl.php";
$update=false;
if(isset($_POST['post_app'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $diplome = $_POST['diplome'];
    //$formation= $_POST['formation'];
    //Database connexion
    $connexion=get_connexion();
    if($connexion){
        $query="insert into eleves (Nom, Prenom, Sexe, Email,Telephone, Formation_initiale ) values(?,?,?,?,?,?)";
        echo $query;
        $statement=$connexion->prepare($query);
        $statement->bind_param("ssssss",$nom, $prenom, $sexe, $email, $telephone, $diplome);
        $statement->execute();
        $statement->close();
        $connexion->close();
        $_SESSION['message']="Enregistrement réussi";
        $_SESSION['msg_type']="success";
        header("location:../list_apps.php");
    }
}
elseif(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $query= "DELETE FROM eleves WHERE Identifiant=$id";
    $connexion=get_connexion();
    if($connexion){
        $statement=$connexion->prepare($query);
        $statement->execute();
        $statement->close();
        $connexion->close();
        $_SESSION['message']= "suppression réussite";
        $_SESSION['msg_type'] ="danger";
        header("location: ../list_apps.php");
    }
    else{
        header("location: ../list_apps.php?error");
    }
}
elseif(isset($_GET['edit'])){
    $update=true;
    $id=$_GET['edit'];
    $query ="SELECT * FROM eleves WHERE Identifiant=$id";
    $connexion=get_connexion();
    if($connexion){
        $result = $connexion->query($query) or die($connexion->error());
        if($result != null){
            $row = $result-> fetch_array();
            $nom = $row['Nom'];
            $prenom = $row['Prenom'];
            $ddn=$row['DDN'];
            $sexe = $row['Sexe'];
            $email = $row['Email'];
            $telephone = $row['Telephone'];
            $diplome = $row['Formation_initiale'];
        }
        $connexion->close();
    }
}
elseif(isset($_POST['update'])){
        $id=$_POST['id'];
        echo $id;
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = $_POST['sexe'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $diplome = $_POST['diplome'];
        $query ="UPDATE eleves SET Nom='$nom',  Prenom='$prenom', Sexe='$sexe', Email='$email', Telephone='$telephone', Formation_initiale='$diplome'  WHERE Identifiant=$id";
        echo $query;
        $connexion=get_connexion();
        if($connexion){
            $result = $connexion->query($query) or die($connexion->error());
        }
        $connexion->close();
        $_SESSION['message']= "Enregistrement réussi";
        $_SESSION['msg_type'] ="info";
        header("location: ../apps_list.php");
}
?>