<?php
    session_start();
    require "db.php";
    if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
        header("Location: login.php");
        exit();
    }
    if (!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = [];
    }
    if (isset($_POST["addToCart"])){
        $id = $_POST["id"];
        $qte = $_POST["quantitec"];
        $_SESSION["panier"][$id] = $qte;
        header("location: afficher.php");
        
    }
?>