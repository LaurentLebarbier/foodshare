<?php

require_once('../bddconnect.php');

if(isset($_SESSION['admin'])){
    $user = $_SESSION['admin'];
}else{

};

?>
<?php

$id=$_GET['id'];


$sql = "SELECT * FROM recettes WHERE id = $id";
$query = $bdd->prepare($sql);
$query->execute(); 
$result = $query->fetchAll(PDO::FETCH_ASSOC); 

if ($_POST) {
    if(empty($_FILES['image']['name'])){
    
        $id = strip_tags($_GET['id']);
        $userid= strip_tags($_POST ['userid']);
        $titre = strip_tags($_POST['titre']);
        $image = strip_tags($_FILES['image']['name']);
        $nbre_personnes = strip_tags($_POST['nbre_personnes']);
        $categorie = strip_tags($_POST['categorie']);
        $temps_prepa = strip_tags($_POST['temps_prepa']);
        $pays = strip_tags($_POST['pays']);
        $description1 = strip_tags($_POST['description1']);
        $description2 = strip_tags($_POST['description2']);
        $description3 = strip_tags($_POST['description3']);

        $sql = "UPDATE recettes SET userid=:userid, titre=:titre, nbre_personnes=:nbre_personnes, categorie=:categorie, temps_prepa=:temps_prepa, pays=:pays,description1=:description1, description2=:description2, description3=:description3 WHERE id=:id";
        
    $query = $bdd->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':userid', $userid);
        $query->bindValue(':titre', $titre);
        // $query->bindValue(':image', $image);
        $query->bindValue(':nbre_personnes', $nbre_personnes);
        $query->bindValue(':categorie', $categorie);
        $query->bindValue(':temps_prepa', $temps_prepa);
        $query->bindValue(':pays', $pays);
        $query->bindValue(':description1', $description1);
        $query->bindValue(':description2', $description2);
        $query->bindValue(':description3', $description3);
        $photo=$image;

        $query->execute();
        header("Location: mes_annonces.php");
    }
    else{

    if(isset($_POST['userid']) && !empty($_POST['userid'])
    && isset($_POST['titre']) && !empty($_POST['titre'])
    && isset($_FILES['image']) && !empty($_FILES['image'])
    && isset($_POST['nbre_personnes']) && !empty($_POST['nbre_personnes'])
    && isset($_POST['categorie']) && !empty($_POST['categorie'])
    && isset($_POST['temps_prepa']) && !empty($_POST['temps_prepa'])
    && isset($_POST['pays']) && !empty($_POST['pays'])
    && isset($_POST['description1']) && !empty($_POST['description1'])
    && isset($_POST['description2']) && !empty($_POST['description2'])
    && isset($_POST['description3']) && !empty($_POST['description3'])) {
        if(isset($_FILES['image'])){
            $tmpName = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];

            move_uploaded_file($tmpName, '../uploads/'.$name);
        }

        $id = strip_tags($_GET['id']);
        $userid= strip_tags($_POST ['userid']);
        $titre = strip_tags($_POST['titre']);
        $image = strip_tags($_FILES['image']['name']);
        $nbre_personnes = strip_tags($_POST['nbre_personnes']);
        $categorie = strip_tags($_POST['categorie']);
        $temps_prepa = strip_tags($_POST['temps_prepa']);
        $pays = strip_tags($_POST['pays']);
        $description1 = strip_tags($_POST['description1']);
        $description2 = strip_tags($_POST['description2']);
        $description3 = strip_tags($_POST['description3']);



    // update
    $sql = "UPDATE recettes SET userid=:userid, titre=:titre, image=:image, nbre_personnes=:nbre_personnes, categorie=:categorie, temps_prepa=:temps_prepa, pays=:pays,description1=:description1, description2=:description2, description3=:description3 WHERE id=:id";

    $query = $bdd->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':userid', $userid);
        $query->bindValue(':titre', $titre);
        $query->bindValue(':image', $image);
        $query->bindValue(':nbre_personnes', $nbre_personnes);
        $query->bindValue(':categorie', $categorie);
        $query->bindValue(':temps_prepa', $temps_prepa);
        $query->bindValue(':pays', $pays);
        $query->bindValue(':description1', $description1);
        $query->bindValue(':description2', $description2);
        $query->bindValue(':description3', $description3);
        $photo=$image;

        $query->execute();

    header("Location: mes_annonces.php");

}else {
    echo 'Veuillez remplir tous les champs';
}}}
// récupération des données du projet
if(isset($_GET['id'])&& !empty($_GET['id'])) {

$id = strip_tags($_GET['id']);  //fonction qui permet d'enlever tous les tags html
// var_dump($id); //verification que l'on récupère bien l'ID

$sql = "SELECT * FROM recettes WHERE id=:id";  //requête préparée
$query = $bdd->prepare($sql);
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->execute();

$projet = $query->fetch();
// on verifie si le projet existe
if(!$projet){
    header("Location: index.php");
}
}else {
header("Location: index.php");
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
    <title>FOOD SHARE - Modif Annonce</title>
</head>

<body>

    <header>
        <a href="../index.php"><h1>Food Share</h1></a>
    </header>

    <div class="categories">
        <h2>Modifier une recette</h2>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">

    <div class="photo_annonce"><img src="../uploads/<?=$projet['image']?>" alt=""></div>

        <input type="hidden" name="userid" placeholder="userid" value="<?php echo $projet['userid']?>"><br>
     
        <input type="text" name ="titre" placeholder="Titre" value="<?php echo $projet['titre']?>"><br>
        <input type="hidden" name="image" placeholder="file" value="<?php echo $projet['image']?>"><br><br>
        <input type="file" name="image" placeholder="file"><br><br>
        <input type="number" name ="nbre_personnes" placeholder="nombre de personnes" value="<?php echo $projet['nbre_personnes']?>"><br>
        <select name="categorie" id="catform">
            <option value=""> -- Catégories -- </option>
            <option value="Aperitifs" <?php if($projet['categorie'] === "Aperitifs"){echo "selected";}?>>Apéritifs</option>
            <option value="Entrees" <?php if($projet['categorie'] === "Entrees"){echo "selected";}?>>Entrées</option>
            <option value="Plats" <?php if($projet['categorie'] === "Plats"){echo "selected";}?>>Plats</option>
            <option value="Desserts" <?php if($projet['categorie'] === "Desserts"){echo "selected";}?>>Desserts</option>
            <option value="Cocktails" <?php if($projet['categorie'] === "Cocktails"){echo "selected";}?>>Cocktails</option>
        </select><br>
        <input type="number" name ="temps_prepa" placeholder="temps de préparation(en min)" value="<?php echo $projet['temps_prepa']?>"><br>
        <input type="text" name="pays" placeholder="pays" value="<?php echo $projet['pays']?>"><br>
        <textarea type="text" name ="description1" placeholder="Etape 1" id="describ"><?php echo $projet['description1']?></textarea><br>
        <textarea type="text" name ="description2" placeholder="Etape 2" id="describ"><?php echo $projet['description2']?></textarea><br>
        <textarea type="text" name ="description3" placeholder="Etape 3" id="describ"><?php echo $projet['description3']?></textarea><br>

        <!-- <input type="file" placeholder="Catégorie"><br><br> -->
        <input type="submit" value="Modifier" class="submit" onclick="return confirm('Voulez-vous modifer votre recette?')">


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