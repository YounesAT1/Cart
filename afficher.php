<?php
session_start();
require "db.php";

if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}


$sql = "SELECT * FROM produit";
$statement = $connection->prepare($sql);
$statement->execute();
$produit = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
    <div class="row">
        <div class="col">
        <h3>Bonjour <?php echo $_SESSION['client_nom']; ?></h3>
        </div>
        <div class="col-auto">
        <a class="btn btn-success" href="panier.php">Afficher panier &#8594;</a>
        </div>
    </div>
</div>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
        <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
        <style>
            body {
                background-color: #f8f9fa;
                padding: 20px;
            }
            table {
                width: 100%;
                margin-top: 20px;
                border-collapse: collapse;
            }
            th,
            td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <table >
            <thead>
                <tr>
                    <th>Libelle</th>
                    <th>PrixU</th>
                    <th>Quantite Commandée</th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produit as $p) : ?>
                    <tr>
                        <form method="post" action = 'ajouterPanier.php'>
                            <td><label name='libelle'><?= $p->libelle ?></label></td>
                            <td><label name='prixu'><?= $p->prixu ?></label></td>
                            <td><input type="number" name="quantitec" value = '1' min = 1></td>
                            <td><input type='submit'  class="btn btn-primary" name="addToCart" value = 'Ajouter &plus;'></input></td>
                            <td><input type="hidden" name="id"  value = <?= $p->idp ?>></td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
                <a class="btn btn-danger mt-5 " href="logout.php">Deconnecter &#9747;</a> 
        </div>
        <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
