<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./users.css">
    <title>Document</title>
</head>
<body>
    <table>
        <br>
        <thead>
            <tr>
                <th>Matric Number</th>
                <th>Name</th>
                <th>Password</th>
                <th>Role</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
            require('database.php');
            $data = weblab7::selectData();
            if (isset($_GET['delete'])) {
                $matric = $_GET['delete'];
                $result = (new weblab7())->delete($matric);
                if ($result) {
                    echo "<script>alert('Record deleted successfully.'); windoq.location.href = 'users.php';</script>";
                } else {
                    echo "<script>alert('Error deleting record.');</script>";
                }
            }

            if (count($data) > 0) {
                foreach ($data as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['matric'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['password'] . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td><a href="?delete=' . $row['matric'] . '">Delete</a></td>';
                    echo '<td><a href="update.php?matric=' . $row['matric'] . '">Update</a></td>';
                    echo '</tr>';
                }
            }
        ?>
        </tbody>
        
    </table>
    <br>
    <a href="./login.php" class="center-logout">Log Out</a>
</body>
</html>