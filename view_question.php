<?php
include("db_connection.php");

// Delete question if delete_id is set
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM question WHERE question_id = $delete_id";
    if(mysqli_query($conn, $delete_sql)) {
        echo "<p style='color:green'>Question deleted successfully!</p>";
    } else {
        echo "<p style='color:red'>Error: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch all questions along with quiz title
$result = mysqli_query($conn, 
    "SELECT q.question_id, q.question_text, q.option1, q.option2, q.option3, q.option4, q.correct_option, z.quiz_title 
     FROM question q
     JOIN quiz z ON q.quiz_id = z.quiz_id
     ORDER BY q.quiz_id"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Questions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>All Questions</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Quiz</th>
            <th>Question</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Correct Option</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['question_id']; ?></td>
            <td><?php echo $row['quiz_title']; ?></td>
            <td><?php echo $row['question_text']; ?></td>
            <td><?php echo $row['option1']; ?></td>
            <td><?php echo $row['option2']; ?></td>
            <td><?php echo $row['option3']; ?></td>
            <td><?php echo $row['option4']; ?></td>
            <td><?php echo $row['correct_option']; ?></td>
            <td>

    
                
<a href="add_question.php?edit_id=<?php echo $row['question_id']; ?>">Edit</a> | 
<a href="view_question.php?delete_id=<?php echo $row['question_id']; ?>" 
onclick="return confirm('Are you sure to delete?')">Delete</a>


            </td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
