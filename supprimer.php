<?php
session_start();
require "db.php";

if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $productId = $_GET["id"];
    if (isset($_SESSION["panier"][$productId])) {
        unset($_SESSION["panier"][$productId]);
        $_SESSION["success_message"] = "Le produit a été supprimé du panier.";
    } else {
        $_SESSION["error_message"] = "Produit non trouvé dans le panier.";
    }
    header("Location: panier.php");
    exit();
}
?>
