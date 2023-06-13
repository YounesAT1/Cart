<?php
    $dsn = "mysql:host=localhost;dbname=ecommerce";
    $username = "root";
    $password = "root";
    $options = [];
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        // echo "Connection established";
    } catch (PDOException $e) {
        echo "Connection failed";
    }