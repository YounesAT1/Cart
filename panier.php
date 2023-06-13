<?php
    session_start();
    require "db.php";

    if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
        header("Location: login.php");
        exit();
    }

    $mess = '';
    if (isset($_POST["commander"])){
        if (empty($_SESSION["panier"])){
            $mess = "<p class='alert alert-danger text-center'>Veuillez ajouter des produits au panier avant de commander.</p>";
        }else{
            $outOfStock = false;
            foreach($_SESSION["panier"] as  $id => $qte){
                $sql = "SELECT qtestock FROM produit WHERE idp = :id";
                $statement = $connection->prepare($sql);
                $statement->execute([":id" => $id]);
                $produit = $statement->fetch(PDO::FETCH_OBJ);
                if ($qte > $produit->qtestock){
                    $outOfStock = true;
                    break;
                }
            }
            if ($outOfStock){
                $mess = "<p class='alert alert-danger text-center'>Certains produits sont en rupture de stock.</p>";
            }else{
                foreach ($_SESSION["panier"] as $id => $qte) {
                    $sql = "SELECT qtestock FROM produit WHERE idp = :id";
                    $statement = $connection->prepare($sql);
                    $statement->execute([":id" => $id]);
                    $produit = $statement->fetch(PDO::FETCH_OBJ);
                    
                    $newQuantity = $produit->qtestock - $qte;
                    $updateSql = "UPDATE produit SET qtestock = :newQuantity WHERE idp = :id";
                    $updateStatement = $connection->prepare($updateSql);
                    $updateStatement->execute([
                        ":newQuantity" => $newQuantity,
                        ":id" => $id
                    ]);
                }
                $_SESSION["panier"] = [];
                $mess = "<p class='alert alert-success text-center'>Commande effectuée avec succès.</p>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <a class="btn btn-primary m-5" href="afficher.php"> &#8592; Produits</a>
        <h3 class="m-3">Liste des produits dans le panier</h3>
        <?php if (!empty($mess)) :?>
            <?= $mess; ?>
        <?php endif ;?>
        <?php
        if (isset($_SESSION["panier"]) && is_array($_SESSION["panier"]) && count($_SESSION["panier"]) != 0) {
            $sum = 0;
            echo "<table class='table text-center'>
                <thead >
                    <th>Libelle</th>
                    <th>Prix</th>
                    <th>Quantite</th>
                    <th colspan = '2'>Action</th>
                    
                </thead>
                <tbody>";
            foreach ($_SESSION["panier"] as $id => $qte) {
                $sql = "SELECT * FROM produit WHERE idp = :id";
                $statement = $connection->prepare($sql);
                $statement->execute([":id" => $id]);
                $produit = $statement->fetch(PDO::FETCH_OBJ);
                $sum += $produit->prixu * $qte;
                echo "<tr>
                        <td>$produit->libelle</td>
                        <td>$produit->prixu</td>
                        <td>$qte</td>
                        <td><a class='btn btn-danger' href='supprimer.php?id=$produit->idp'>Supprimer &#10005;</a></td>
                        <td><a  class='btn btn-primary' href='modifier.php?id=$produit->idp&qte=$qte''>modifier &#9998;</a></td>
                    </tr>";
            }
            echo "</tbody>
                    </table>";
            echo "<h5 class='m-5'>Total: " . $sum . " DHS </h5>";
        } else {
            echo "<p class='m-5'>Votre panier est vide.</p>";
        }
        ?>
        <form method="post">
            <input type="submit" class="btn btn-success my-5" name="commander" value="Commander &#10004;">
        </form>
    </div>
    <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.js.map"></script>
</body>
</html>
