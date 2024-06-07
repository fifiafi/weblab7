<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signup.css">
    <title>Document</title>
</head>

<body>
<?php
require('./database.php');
if (isset($_POST['signUP_button'])) {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($matric) && !empty($name) && !empty($password) && !empty($role)) {
        try {
            $pdo = weblab7::connect();
           
            $check_query = $pdo->prepare('SELECT * FROM weblab7Table WHERE matric = :m');
            $check_query->bindValue(':m', $matric);
            $check_query->execute();
            $existing_record = $check_query->fetch(PDO::FETCH_ASSOC);
            
            if ($existing_record) {
                
                $update_query = $pdo->prepare('UPDATE weblab7Table SET name=:n, password=:p, role=:r WHERE matric=:m');
                $update_query->bindValue(':m', $matric);
                $update_query->bindValue(':n', $name);
                $update_query->bindValue(':p', $password);
                $update_query->bindValue(':r', $role);
                
                if ($update_query->execute()) {
                    echo 'Update successfully!';
                } else {
                    echo 'Failed to update!';
                }
            } else {
                echo 'Record with matric ' . $matric . ' does not exist.';
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        } catch (Exception $e) {
            echo 'General error: ' . $e->getMessage();
        }
    } else {
        echo 'Please fill in all fields!';
    }
}
?>
<div class="form">
    <div class="title">
        <h2>Sign Up form</h2>
    </div>
    <form action="" method="post">
        <input type="text" name="matric" placeholder="matric" required>
        <input type="text" name="name" placeholder="name" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="role" placeholder="role" required>
        <input type="submit" value="Update" name="update_button">
        <a href="./login.php">Log In</a>
    </form>
</div>
</body>

</html>