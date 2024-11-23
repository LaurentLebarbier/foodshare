<?php

require_once('bddconnect.php');



if ($_POST) {
    $username = strip_tags($_POST['username']);      
    $mail= strip_tags($_POST ['mail']);
    $password= strip_tags($_POST ['password']);
    $check= strip_tags($_POST ['check-password']);
    $userpic = strip_tags($_FILES['userpic']['name']);


    $check = $bdd->prepare('SELECT mail FROM users WHERE mail = ?');
    $check->execute(array($mail));
    $data = $check->fetch();
    $row = $check->rowCount();
    if($row == 0){

        if(isset($_POST['username']) && !empty($_POST['username'])
        && isset($_POST['mail']) && !empty($_POST['mail'])
        && isset($_POST['password']) && !empty($_POST['password'])
        && ($_POST['password'] === $_POST['check-password'])){
            if(isset($_FILES['userpic'])){
                $tmpName = $_FILES['userpic']['tmp_name'];
                $name = $_FILES['userpic']['name'];
    
                move_uploaded_file($tmpName, 'IMG/userimg/'.$name);
            }
        
        $password = hash('sha256', $password);
        
        $sql = "INSERT INTO users(username, mail, password, userpic) VALUES  (:username,:mail, :password, :userpic)";
        $query = $bdd->prepare($sql);

        $query->bindValue(':username', $username);
        $query->bindValue(':mail', $mail);
        $query->bindValue(':password', $password);
        $query->bindValue(':userpic', $userpic);


        $query->execute();

    }}else {header('location:connect.php');
    }
 }

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/responsive.css">
    <link rel="stylesheet" href="CSS/connect.css">
    <title>BAD CORNER - Inscription</title>
</head>

<body>

    <header>
        <a href="index.php"><h1>BAD CORNER</h1></a>
    </header>

    <div class="categories">
        <h2>Inscription</h2>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">


        <input type="text" name="username" placeholder="Pseudo">
        <input type="text" name="mail" placeholder="Adresse mail">
        <input type="password" name="password" placeholder="Mot de passe" id="password">
        <input type="password" name="check-password" placeholder="Confirmez votre mot de passe" id="check-password"><br>
        <span id="message"></span><br>
        <input type="file" name="userpic" placeholder="file"><br><br>

        <br>
        <input type="submit" value="S'inscrire" class="submit">


    </form>
    
   <script src="JS/register.js"></script>
    <footer>
        <div class="menu">
            <h2>
                <a href="connect.php">Connexion</a>
                
            </h2>
            <h2>
                <a href="register.php">Inscription</a>
            </h2>
        </div>
    </footer>
</body>
</html>