<?php
include("db_connection.php");

// Check if form submitted
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    // Insert student into database
    $sql = "INSERT INTO student (name, email, course) VALUES ('$name', '$email', '$course')";
    
    if(mysqli_query($conn, $sql)) {
        echo "<p style='color:green'>Student registered successfully!</p>";
    } else {
        echo "<p style='color:red'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Student Registration</h2>

    <form method="post" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Course:</label><br>
        <input type="text" name="course" required><br><br>

        <input type="submit" name="submit" value="Register Student">
    </form>

    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
