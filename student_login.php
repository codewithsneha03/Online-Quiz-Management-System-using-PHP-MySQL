<?php
include("db_connection.php");

// Fetch all students for dropdown
$student_result = mysqli_query($conn, "SELECT * FROM student");

// If form submitted
if(isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    header("Location: select_quiz.php?student_id=$student_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Select Student</h2>

    <form method="post" action="">
        <label>Select Your Name:</label><br>
        <select name="student_id" required>
            <option value="">--Select Student--</option>
            <?php while($student = mysqli_fetch_assoc($student_result)) { ?>
                <option value="<?php echo $student['student_id']; ?>"><?php echo $student['name']; ?></option>
            <?php } ?>
        </select><br><br>

        <input type="submit" name="submit" value="Continue">
    </form>

    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
