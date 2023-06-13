<?php
    session_start();
    require "db.php";

    if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
        header("Location: login.php");
        exit();
    }
        $productId = $_GET['id'];
        if (isset($_POST["qte"])){
            $quantity = $_POST['qte'];
            $_SESSION["panier"][$productId] = $quantity;
            header("Location: panier.php");
            exit();
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier</title>
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <style>
        .centered-form {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        label {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container centered-form">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title m-3">Nouvelle quantité</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="modifierLabel" class="my-3">Quantité:</label>
                        <input type="number" class="form-control" id="modifierLabel" name="qte" value="<?= $quantity; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary my-4" name="modifier">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
