<?php
session_start();
require_once "functions.ctl.php";
$update=false;
if(isset($_POST['post_training'])){
    $intitule = $_POST['intitule'];
    $langue = $_POST['langue'];
    $duree = $_POST['duree'];
    $type_formation = $_POST['type_formation'];
    //Database connexion
    $connexion=get_connexion();
    if($connexion){
        $query="insert into formations (Intitule, Langue, Type, Duree_annee) values(?,?,?,?)";
        $statement=$connexion->prepare($query);
        $statement->bind_param("ssss",$intitule, $langue, $type_formation, $duree );
        $statement->execute();
        $statement->close();
        $connexion->close();
        $_SESSION['message']="Enregistrement réussi";
        $_SESSION['msg_type']="success";
        header("location:../training_list.php");
    }
}
elseif(isset($_GET['delete'])){
    $intitule=$_GET['delete'];
    $query= "DELETE FROM formations WHERE Intitule='$intitule'";
    echo $query;
    $connexion=get_connexion();
    if($connexion){
        $statement=$connexion->prepare($query);
        $statement->execute();
        $statement->close();
        $connexion->close();
        $_SESSION['message']= "suppression réussite";
        $_SESSION['msg_type'] ="danger";
        header("location: ../training_list.php");
    }
    else{
        header("location: ../training_list.php?error");
    }
}
elseif(isset($_GET['edit'])){
    $update=true;
    $intitule=$_GET['edit'];
    $query ="SELECT * FROM formations WHERE Intitule='$intitule'";
    echo $query;
    $connexion=get_connexion();
    if($connexion){
        $result = $connexion->query($query) or die($connexion->error());
        if($result != null){
            $row = $result-> fetch_array();
            $nom = $row['Nom'];
            $prenom = $row['Prenom'];
            $sexe = $row['Sexe'];
            $email = $row['Email'];
            $telephone = $row['Telephone'];
            $diplome = $row['Formation_initiale'];
        }
        $connexion->close();
    }
}
elseif(isset($_POST['update'])){
        $intitule = $_POST['intitule'];
        $langue = $_POST['langue'];
        $duree = $_POST['duree'];
        $type_formation = $_POST['type_formation'];
        $query ="UPDATE formations SET Langue='$langue', Duree_annee='$duree', `Type`='$type_formation'  WHERE Intitule=$intitule";
        echo $query;
        $connexion=get_connexion();
        if($connexion){
            $result = $connexion->query($query) or die($connexion->error());
        }
        $connexion->close();
        $_SESSION['message']= "Enregistrement réussi";
        $_SESSION['msg_type'] ="info";
        header("location: ../training_list.php");
}
?>