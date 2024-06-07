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
                $p = weblab7::connect()->prepare('UPDATE weblab7Table SET matric=:m, name=:n, password=:p, role=:r');
                $p->bindValue(':m', $matric);
                $p->bindValue(':n', $name);
                $p->bindValue(':p', $password);
                $p->bindValue(':r', $role);
                if ($p->execute()) {
                    echo 'Update successfully!';
                } else {
                    echo 'Failed to sign up!';
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
            <input type="submit" value="Update" name="signUP_button">
        </form>
    </div>
</body>

</html>