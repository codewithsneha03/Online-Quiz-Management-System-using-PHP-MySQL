<?php
include("db_connection.php");

/* ============== DELETE ============== */
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    mysqli_query($conn,"DELETE FROM quiz WHERE quiz_id=$delete_id");
    header("Location: view_quiz.php");
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM quiz");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>All Quizzes</h2>

<a href="add_quiz.php">+ Add New Quiz</a>
<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Total Questions</th>
    <th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
    <td><?php echo $row['quiz_id']; ?></td>
    <td><?php echo $row['quiz_title']; ?></td>
    <td><?php echo $row['total_questions']; ?></td>
    <td>
        <a href="add_quiz.php?edit_id=<?php echo $row['quiz_id']; ?>">Edit</a> |
        <a href="view_quiz.php?delete_id=<?php echo $row['quiz_id']; ?>"
        onclick="return confirm('Delete this quiz?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
