<?php
include("db_connection.php");

// Get student_id and quiz_id from URL
if(!isset($_GET['student_id']) || !isset($_GET['quiz_id'])) {
    echo "Invalid access!";
    exit();
}

$student_id = $_GET['student_id'];
$quiz_id = $_GET['quiz_id'];

// Fetch quiz questions
$questions_result = mysqli_query($conn, "SELECT * FROM question WHERE quiz_id = $quiz_id");

// If form submitted
if(isset($_POST['submit'])) {
    $score = 0;
    foreach($_POST['answers'] as $question_id => $selected_option) {
        // Fetch correct option
        $q = mysqli_query($conn, "SELECT correct_option FROM question WHERE question_id = $question_id");
        $row = mysqli_fetch_assoc($q);
        if($selected_option == $row['correct_option']) {
            $score++;
        }
    }

    // Insert result
    mysqli_query($conn, "INSERT INTO result(student_id, quiz_id, score) VALUES($student_id, $quiz_id, $score)");

    echo "<p style='color:green'>Quiz submitted successfully! Your score: $score</p>";
    echo "<a href='student_login.php'>Back to Home</a>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Take Quiz</h2>

    <form method="post" action="">
        <?php
        if(mysqli_num_rows($questions_result) > 0) {
            $q_no = 1;
            while($question = mysqli_fetch_assoc($questions_result)) { 
        ?>
            <p><b><?php echo $q_no . ". " . $question['question_text']; ?></b></p>
            <input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="1" required> <?php echo $question['option1']; ?><br>
            <input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="2"> <?php echo $question['option2']; ?><br>
            <input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="3"> <?php echo $question['option3']; ?><br>
            <input type="radio" name="answers[<?php echo $question['question_id']; ?>]" value="4"> <?php echo $question['option4']; ?><br><br>
        <?php
                $q_no++;
            }
        } else {
            echo "<p>No questions added for this quiz yet.</p>";
        }
        ?>

        <?php if(mysqli_num_rows($questions_result) > 0) { ?>
            <input type="submit" name="submit" value="Submit Quiz">
        <?php } ?>
    </form>

    <br>
    <a href="select_quiz.php?student_id=<?php echo $student_id; ?>">Back</a>
</body>
</html>
