<?php
session_start();
require_once('bddconnect.php');
if(isset($_SESSION['admin'])){
    $user = $_SESSION['admin'];
}else{

};

// test
$annoncesparpage = 10;
$annoncestotalesreq = $bdd->query('SELECT id from recettes');
$annoncestotales = $annoncestotalesreq->rowCount();
$pagestotales = ceil($annoncestotales/$annoncesparpage);

if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagestotales){
    $_GET['page'] = intval($_GET['page']);
    $pagecourante = $_GET['page'];
}else {
    $pagecourante = 1;
}

$depart = ($pagecourante-1)*$annoncesparpage;
    ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="IMG/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/responsive.css">
    <title>FOOD SHARE - Accueil</title>
</head>
<body>
    <header>
        <a href="index.php"><h1>Food Share</h1></a>
        <p>Partagez vos recettes en toute simplicité</p>
    </header>
    
<br><br>
    <div class="accueil">
        <form method="GET">
            <input type="search" name = "s" placeholder="Rechercher..." style="border-radius: 5px; background-color: #27bbb4; color:black;">
            <button type="submit" style="border-radius: 5px; background-color: #27bbb4;"><img src="IMG/loupe.png" width="20px" height="20px" alt=""></button>
        </form>
            
    </div>

    <div class="categories">
        <h2>Catégories</h2>
    </div>
    
    <div class="bulles">
        <div class="bulle1"><div class="content">
            <div class="text">
                <a href="categ_aperitifs.php">
                Apéritifs</a>
            </div>
        </div>
        </div>

        <div class="bulle2"><div class="content">
            <div class="text">
                <a href="categ_entrees.php">
                Entrées</a>
            </div>
        </div>
        </div>

        <div class="bulle3"><div class="content">
            <div class="text">
                <a href="categ_plats.php">
                Plats</a>
            </div>
        </div>
        </div>

        <div class="bulle4"><div class="content">
            <div class="text">
                <a href="categ_desserts.php">
                Desserts</a>
            </div>
        </div>
        </div>

        <div class="bulle5"><div class="content">
            <div class="text">
                <a href="categ_cocktails.php">
                Cocktails</a>
            </div>
        </div>
        </div>

   </div>

   <hr>

   <!-- Annonces -->

   <div class="titre_annonces">      
        <h2>Dernières Recettes</h2>
    </div>
<section id="results">

           <?php
            
            if (isset($_GET['s'])){
                $s= htmlspecialchars($_GET['s']);
                $annonces = $bdd->query('SELECT * FROM recettes Where titre LIKE "%'.$s.'%" ORDER BY id DESC ');
            
            
                foreach ($annonces as $projet) {
                    ?>

                <div id="recette">

                    <div id="photo">
                        <img src="uploads/<?=$projet['image']?>" alt="">
                    </div>
                    <div id="description">
                        <div id="infos">
                            <div id="titre"><h3><?= $projet['titre']?></h3></div>
                            <div id="categorie"><h4><?= $projet['categorie']?></h4></div>
                        </div>
                        <button id="view"><a href="view_annonce.php?id=<?= $projet['id']?>">Voir la recette</a></button>
                    </div>



                </div>
                
            
                
                <?php
            }}else{
                $sql='SELECT * from recettes ORDER BY id DESC LIMIT '.$depart.','.$annoncesparpage;
                $query = $bdd->prepare($sql);
                $query->execute(); 
                $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                
                foreach ($result as $projet) {
                ?>
                
                <div id="recette">

                    <div id="photo">
                        <img src="uploads/<?=$projet['image']?>" alt="">
                    </div>
                    <div id="description">
                        <div id="infos">
                            <div id="titre"><h3><?= $projet['titre']?></h3></div>
                            <div id="categorie"><h4><?= $projet['categorie']?></h4></div>
                        </div>
                        <button id="view"><a href="view_annonce.php?id=<?= $projet['id']?>">Voir la recette</a></button>
                    </div>



                </div>


            <?php
            }}
            ?>
     
       
       </section> 
        <div class="pagination">
            <?php
            if (isset($_GET['s'])){
                "";
            }else{


            for ($i=1;$i<=$pagestotales;$i++) {
                if($i==$pagecourante){
                    // echo $i. ' ';
                    echo '<span id="span_pagination"><span id="page_select">'.$i. '</span> ';
                }else{
                    echo '<a href="index.php?page='.$i.'" id="page_no_select">'.$i.'</a></span> ';
                    // echo '<a href="index.php?page='.$i.'">'.$i.'</a> &nbsp';
                }
            }}

            ?>
   <br><br><br><br>

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