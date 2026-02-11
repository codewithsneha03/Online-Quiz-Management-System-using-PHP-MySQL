<?php
include("db_connection.php");

$edit_mode = false;

/* CHECK EDIT MODE */
if(isset($_GET['edit_id'])){
    $edit_mode = true;
    $edit_id = $_GET['edit_id'];

    $edit_result = mysqli_query($conn,"SELECT * FROM question WHERE question_id=$edit_id");
    $edit_data = mysqli_fetch_assoc($edit_result);
}

/* FETCH QUIZ */
$quiz_result = mysqli_query($conn, "SELECT * FROM quiz");

/* SUBMIT */
if(isset($_POST['submit'])) {

    $quiz_id = $_POST['quiz_id'];
    $question_text = $_POST['question_text'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    // UPDATE
    if(isset($_POST['question_id'])){
        $id = $_POST['question_id'];

        $sql = "UPDATE question SET
                quiz_id='$quiz_id',
                question_text='$question_text',
                option1='$option1',
                option2='$option2',
                option3='$option3',
                option4='$option4',
                correct_option='$correct_option'
                WHERE question_id=$id";

        mysqli_query($conn,$sql);
        echo "<p style='color:green'>Question Updated Successfully!</p>";
        header("Location: view_question.php");
        exit();
    }
    // INSERT
    else{
        $sql = "INSERT INTO question (quiz_id, question_text, option1, option2, option3, option4, correct_option)
                VALUES ('$quiz_id', '$question_text', '$option1', '$option2', '$option3', '$option4', '$correct_option')";

        mysqli_query($conn,$sql);
        echo "<p style='color:green'>Question Added Successfully!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add Question</h2>

    <form method="post" action="">
        <?php if($edit_mode){ ?>
<input type="hidden" name="question_id" value="<?php echo $edit_data['question_id']; ?>">
<?php } ?>

        <label>Select Quiz:</label><br>
        <select name="quiz_id" required>
    <option value="">Select Quiz</option>

    <?php while($quiz = mysqli_fetch_assoc($quiz_result)) { ?>
        <option value="<?php echo $quiz['quiz_id']; ?>"
        <?php if($edit_mode && $quiz['quiz_id']==$edit_data['quiz_id']) echo "selected"; ?>>
        <?php echo $quiz['quiz_title']; ?>
        </option>
    <?php } ?>

</select>
<br><br>

        <label>Question:</label><br>
       <textarea name="question_text" required><?php echo $edit_mode?$edit_data['question_text']:'';?></textarea>
<br><br>

        <label>Option 1:</label><br>
        <input type="text" name="option1" value="<?php echo $edit_mode?$edit_data['option1']:'';?>" required>
<br><br>

        <label>Option 2:</label><br>
        <input type="text" name="option2" value="<?php echo $edit_mode?$edit_data['option2']:'';?>" required>
<br><br>

        <label>Option 3:</label><br>
        <input type="text" name="option3" value="<?php echo $edit_mode?$edit_data['option3']:'';?>" required>
<br><br>

        <label>Option 4:</label><br>
        <input type="text" name="option4" value="<?php echo $edit_mode?$edit_data['option4']:'';?>" required>
<br><br>

        <label>Correct Option (1-4):</label><br>
        <input type="number" name="correct_option" min="1" max="4"
value="<?php echo $edit_mode?$edit_data['correct_option']:'';?>" required><br><br>

        <input type="submit" name="submit" value="Add Question">
    </form>

    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>

