<?php
session_start();
if(isset($_POST['submit'])){
 if(isset($_POST['username']) and !empty($_POST['username'])){
  
   if(isset($_POST['password']) and !empty($_POST['password'])){

        require "bddconnect.php";

        $password =hash('sha256',$_POST['password']);

        $getdata = $bdd->prepare("SELECT userid, username FROM users WHERE username=? and password = ?");
        $getdata->execute(array($_POST['username'], $password));

        $rows = $getdata->rowCount();
        $row = $getdata->fetch(PDO::FETCH_ASSOC);
 
        if($rows==true){

            $_SESSION['admin']=$row['userid'];
            
            header("Location:index.php");

        }else{
            $erreur = "Pseudo ou mot de passe inconnus";
        }

        }else{
            $erreur = "Veuillez saisir votre mot de passe";
        }

        }else{
            $erreur = "Veuillez saisir un pseudo valide";
        }    
}
