<?php
include("db_connection.php");


if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if(mysqli_query($conn, $sql)){
        $msg = "Admin added successfully!";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add Admin</h2>
    <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
    <form method="post" action="">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Add Admin">
    </form>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
