<?php
session_start();
require "db.php";

if (isset($_POST["login"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $errorMessage = "Please enter all the information.";
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM client WHERE login = :login AND psw = :password";
        $statement = $connection->prepare($sql);
        $statement->execute([":login" => $username, ":password" => $password]);
        if ($statement->rowCount() === 1) {
            $client = $statement->fetch();
            $_SESSION['client_nom'] = $client['nom'];
            $_SESSION["login"] = $client['login'];
            header("location: afficher.php");
            exit();
        } else {
            $errorMessage = "Incorrect login or password.";
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
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-container {
            max-width: 400px;
            padding: 40px 20px;
            width:600px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-heading {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: bold;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="login-heading">Login</h2>
        <form method="post">
            <?php if (isset($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" >
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </div>
        </form>
    </div>
    <script src="../bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
