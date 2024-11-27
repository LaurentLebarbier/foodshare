<?php
session_start();
require_once('../bddconnect.php');
if(isset($_SESSION['admin'])){
    $user = $_SESSION['admin'];
}else{

};

if ($_POST) {

    if(isset($_POST['userid']) && !empty($_POST['userid'])  
    && isset($_POST['titre']) && !empty($_POST['titre'])
    && isset($_POST['nbre_personnes']) 
    && isset($_POST['categorie']) && !empty($_POST['categorie'])
    && isset($_POST['temps_prepa']) 
    && isset($_POST['pays']) && !empty($_POST['pays'])
    && isset($_POST['description1']) && !empty($_POST['description1'])
    && isset($_POST['description1']) && !empty($_POST['description2'])
    && isset($_POST['description1']) && !empty($_POST['description3'])) {
       
       if(isset($_FILES['image'])){
            $tmpName = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            if(empty($name)){
                $name = ('../IMG/pasdimage.png');
            }

            move_uploaded_file($tmpName, '../uploads/'.$name);
        }
        $userid= strip_tags($_POST ['userid']);
        $titre = strip_tags($_POST['titre']);
        $nbre_personnes = strip_tags($_POST['nbre_personnes']);
        $categorie = strip_tags($_POST['categorie']);
        $temps_prepa = strip_tags($_POST['temps_prepa']);
        $pays = strip_tags($_POST['pays']);
        $description1 = strip_tags($_POST['description1']);
        $description2 = strip_tags($_POST['description2']);
        $description3 = strip_tags($_POST['description3']);
        $image = strip_tags($_FILES['image']['name']);


        $sql = "INSERT INTO recettes(userid, titre, image, nbre_personnes, categorie, temps_prepa, pays, description1, description2, description3) VALUES (:userid, :titre, :image, :nbre_personnes, :categorie, :temps_prepa, :pays, :description1, :description2, :description3)";
        $query = $bdd->prepare($sql);
        
        $query->bindValue(':userid', $userid);
        $query->bindValue(':titre', $titre);
        $query->bindValue(':image', $name);
        $query->bindValue(':nbre_personnes', $nbre_personnes);
        $query->bindValue(':categorie', $categorie);
        $query->bindValue(':temps_prepa', $temps_prepa);
        $query->bindValue(':pays', $pays);
        $query->bindValue(':description1', $description1);
        $query->bindValue(':description2', $description2);
        $query->bindValue(':description3', $description3);
        $photo=$image;

        
        $query->execute();
        header('Location: mes_annonces.php');
        
    }
    
}

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
        <title>FOOD SHARE - Ajout Recette</title>
    </head>
    
    <body>
        
        <header>
            <a href="../index.php"><h1>Food Share</h1></a>
        </header>
        
        <div class="categories">
            <h2>Ajouter une recette</h2>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="userid" placeholder="userid" value="<?=$user?>"><br>
            
            <input type="text" name="titre" placeholder="Titre" required><br>
            <input type="file" name="image" placeholder="file"><br><br>
            <input type="number" name="nbre_personnes" placeholder="nombre de personnes" required><br>
            <select name="categorie" id="catform" required>
                <option value=""> -- Catégories -- </option>
                <option value="Aperitifs">Apéritifs</option>
                <option value="Entrees">Entrées</option>
                <option value="Plats">Plats</option>
                <option value="Desserts">Desserts</option>
                <option value="Cocktails">Cocktails</option>
            </select><br>
            <input type="number" name="temps_prepa" placeholder="temps de preparation en minutes" required><br>
            <input type="text" name="pays" placeholder="pays" required><br>
            <textarea type="text" name="description1" placeholder="Etape 1" id="describ" required></textarea><br>
            <textarea type="text" name="description2" placeholder="Etape 2" id="describ" required></textarea><br>
            <textarea type="text" name="description3" placeholder="Etape 3" id="describ" required></textarea><br>
            
                
            <input type="submit" name="submit"value="Ajouter" class="submit">
            
            
        </form>

<br>
<hr>


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