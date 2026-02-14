<?php
include("db_connection.php");

$edit_mode = false;
$edit_data = null;

/* ================= EDIT MODE ================= */
if(isset($_GET['edit_id'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit_id'];

    $result = mysqli_query($conn,"SELECT * FROM quiz WHERE quiz_id=$edit_id");
    $edit_data = mysqli_fetch_assoc($result);
}

/* ================= INSERT ================= */
if(isset($_POST['add_quiz'])) {

    $quiz_title = $_POST['quiz_title'];
    $total_questions = $_POST['total_questions'];

    mysqli_query($conn,
        "INSERT INTO quiz (quiz_title,total_questions)
         VALUES ('$quiz_title','$total_questions')");

    header("Location: view_quiz.php");
    exit();
}

/* ================= UPDATE ================= */
if(isset($_POST['update_quiz'])) {

    $quiz_id = $_POST['quiz_id'];
    $quiz_title = $_POST['quiz_title'];
    $total_questions = $_POST['total_questions'];

    mysqli_query($conn,
        "UPDATE quiz
         SET quiz_title='$quiz_title',
             total_questions='$total_questions'
         WHERE quiz_id=$quiz_id");

    header("Location: view_quiz.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $edit_mode ? "Edit Quiz" : "Add Quiz"; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2><?php echo $edit_mode ? "Edit Quiz" : "Add Quiz"; ?></h2>

<form method="post">

<?php if($edit_mode){ ?>
<label>Quiz ID</label><br>
    <input type="hidden" name="quiz_id" value="<?php echo $edit_data['quiz_id']; ?>">
<?php } ?>

<label>Quiz Title</label><br>
<input type="text" name="quiz_title"
value="<?php echo $edit_mode ? $edit_data['quiz_title'] : ''; ?>" required><br><br>

<label>Total Questions</label><br>
<input type="number" name="total_questions"
value="<?php echo $edit_mode ? $edit_data['total_questions'] : ''; ?>" required><br><br>

<?php if($edit_mode){ ?>
    <input type="submit" name="update_quiz" value="Update Quiz">
<?php } else { ?>
    <input type="submit" name="add_quiz" value="Add Quiz">
<?php } ?>

</form>

<br>
<a href="view_quiz.php">View Quiz</a>

</body>
</html>
