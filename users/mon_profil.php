<?php
                session_start();
                require_once '../bddconnect.php';

                
               
            ?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/responsive.css">
    <link rel="stylesheet" href="../CSS/connect.css">
    <link rel="stylesheet" href="../CSS/users.css">

    <title>FOOD SHARE - Mon Profil</title>
</head>

<body>

    <header>
        <a href="../index.php"><h1>Food Share</h1></a>
    </header>
    <?php if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_destroy();
                      header("location:index.php");
                   }
                }
                else if($_SESSION['admin'] !== ""){
                    $user = $_SESSION['admin'];
                    $test="SELECT * FROM users WHERE userid=$user";
                    $query = $bdd->prepare($test);
                    $query->execute(); 
                    $result = $query->fetch(PDO::FETCH_ASSOC); 
                    // afficher un message
                    echo "<br>Bonjour ".$result['username'].", vous êtes en ligne";
                }
    ?>
    <?php
$annoncestotalesreq = $bdd->query("SELECT * from recettes WHERE userid=$user");
$annoncestotales = $annoncestotalesreq->rowCount();
?>
    <div class="categories">
        <h2>Mon Profil</h2>
    </div>
<div id="profil_board">
<img src="../IMG/userimg/<?=$result['userpic']?>" height="80px" width="80px">
    <hr>
    <div class="infos">
    <h3>Pseudo : <?=$result['username']?></h3>
    </div>
    <hr>
    <div class="infos">
    <h3>Adresse mail : <?=$result['mail']?></h3>
    </div>
    <hr>
    <div class="infos">
    <h3>Vous avez partagé <?=$annoncestotales?> recette(s)</h3>
    </div>
    <hr>
    <div class="infos">
    <h3>Nombre de favoris :</h3>
    </div>
    <hr>
    <a href="../disconnect.php"><button id="ajouter" style="background-color: red;">Déconnexion</button></a>
    </div>
    <br><br><br><br><br>

    <!-- tester si l'utilisateur est connecté -->
    
   
    <footer>
    <div class="menu">
            <div class="accueil_footer">
                <a href="../index.php">
                    <i class="fas fa-home"></i>
                </a>
            </div>
            <div class="annonces_footer">
                <a href="mes_annonces.php">
                <i class="fas fa-hand-holding"></i>
                </a>
            </div>
            <div class="favoris_footer">
                <a href="mes_favoris.php">
                <i class="far fa-heart"></i>
                </a>
            </div>
            <div class="profil_footer">
                <a href="mon_profil.php">
                    <i class="fas fa-user-alt"></i>
                </a>
            </div>
        </div>
    </footer>

    <script src="../JS/app.js"></script>
    <script src="https://kit.fontawesome.com/508ebce8fc.js"></script>
</body>
</html>