<?php
include("db_connection.php");

// Get student ID from URL
if(!isset($_GET['student_id'])) {
    echo "Invalid access!";
    exit();
}
$student_id = $_GET['student_id'];

// Fetch all quizzes
$quiz_result = mysqli_query($conn, "SELECT * FROM quiz");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Select a Quiz</h2>

    <?php if(mysqli_num_rows($quiz_result) > 0) { ?>
        <ul>
        <?php while($quiz = mysqli_fetch_assoc($quiz_result)) { ?>
            <li>
                <?php echo $quiz['quiz_title']; ?> 
                - <a href="take_quiz.php?student_id=<?php echo $student_id; ?>&quiz_id=<?php echo $quiz['quiz_id']; ?>">Take Quiz</a>
            </li>
        <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No quizzes available at the moment.</p>
    <?php } ?>

    <br>
    <a href="student_login.php">Back</a>
</body>
</html>
