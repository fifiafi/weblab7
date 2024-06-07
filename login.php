<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signup.css">
    <title>Log In</title>

    <style>
        .form {
            width: 230px;
            height: 280px;
        }
    </style>
</head>

<body>

<?php
session_start(); // Start the session
require('./database.php');

if (isset($_POST['login_button'])) {
    $_SESSION['validate'] = false;
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    try {
        $p = weblab7Table::connect()->prepare('SELECT * FROM weblab7Table WHERE matric = :m AND password = :p');
        $p->bindValue(':m', $matric);
        $p->bindValue(':p', $password);
        $p->execute();

        if ($p->rowCount() > 0) {
            $_SESSION['matric'] = $matric;
            $_SESSION['password'] = $password;
            $_SESSION['validate'] = true;
            header('location:users.php');
        } else {
            echo 'Please make sure you are registered!';
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        echo 'General error: ' . $e->getMessage();
    }
}
?>

<div class="form">
    <div class="title">
        <h2>Log In Form</h2>
    </div>
    <form action="" method="post">
        <input type="text" name="matric" placeholder="matric" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login" name="login_button">
        <a href="./signup.php"> </a>
    </form>
</div>

</body>
</html>