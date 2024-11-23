<?php
session_start();
?>
<?php

require_once('bddconnect.php');

$sql="SELECT * from recettes WHERE categorie='Cocktails' ORDER BY id DESC";
$query = $bdd->prepare($sql);
$query->execute(); 
$result = $query->fetchAll(PDO::FETCH_ASSOC); 

// var_dump($result);
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/responsive.css">
    <title>FOOD SHARE - COCKTAILS</title>
</head>
<body>
    <header>
        <a href="index.php"><h1>Food Share</h1></a>
    </header>
    
   <div class="bulles">
        <div class="bulle5">
            <div class="content">
        
                <div class="text">
                    Cocktails
                </div>
            </div>
        </div>
   </div>
   <hr>

   <!-- Annonces -->

   <div class="titre_annonces">      
        <h2>Les Cocktails</h2>
    </div>

    <div class="annonces">
    <?php
        foreach ($result as $projet) {
        ?>
        <div class="cartes">

            <div class="photo_annonce"><a href="view_annonce.php?id=<?= $projet['id']?>"><img src="uploads/<?=$projet['image']?>" alt=""></a></div>
            <div class="texte_annonce">
                <h3><?= $projet['titre']?></h3>
                <h4><?= $projet['categorie']?></h4>
                <h5><?= $projet['pays']?></h5>
            </div>

        </div>
        
    
        
        <?php
    }
    ?>
    </div>

    <hr>
    

   <hr>
   <?php
   if(isset($_SESSION['admin'])){
      include 'footer2.php';
      
       
    }else {
      include 'footer1.php';
    }
    ?>
</body>
</html>