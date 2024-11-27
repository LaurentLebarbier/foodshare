<?php
session_start();
require_once('../bddconnect.php');
if(isset($_SESSION['admin'])){
    $user = $_SESSION['admin'];
}else{

};


$sql="SELECT * from recettes INNER JOIN users ON recettes.userid=users.userid WHERE users.userid = $user";
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
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/responsive.css">
    <link rel="stylesheet" href="../CSS/connect.css">
    <link rel="stylesheet" href="../CSS/users.css">

    <title>FOOD SHARE - Mes Recettes</title>
</head>

<body>

    <header>
        <a href="../index.php"><h1>Food Share</h1></a>
    </header>

    <div class="categories">
        <h2>Mes Recettes</h2>
    </div>
    <a href="add_annonce.php"><button id="ajouter">Ajouter une recette</button></a>
    <br><br>


    <hr>

    <?php
        foreach ($result as $projet) {
        ?>

    <div class="annonces">
        <div class="photo_annonce"><img src="../uploads/<?=$projet['image']?>" alt=""></div>
        <div class="descript">
            <h2><?= $projet['titre']?></h2><br>
            <h2><?= $projet['categorie']?></h2><br>
            <h2><?= $projet['pays']?></h2><br>
        </div>
        <div class="buttons">
            <a href="modif_annonce.php?id=<?= $projet['id']?>"><button onclick="return confirm('Voulez-vous modifier cette recette?')" id="modif">Modifier</button></a>
            <a href="delete.php?id=<?= $projet['id']?>"><button onclick="return confirm('Voulez-vous supprimer cette recette?')" id="delete">Supprimer</button></a>
        </div>
        
    </div>

    <hr>
    <?php
    }
    ?>
<br><br><br><br><br>
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

    <script src="https://kit.fontawesome.com/508ebce8fc.js"></script>
</body>
</html>