<?php
include("db_connection.php");

// Fetch results with student name and quiz title
$result = mysqli_query($conn, 
    "SELECT r.result_id, s.name AS student_name, s.email, z.quiz_title, r.score
     FROM result r
     JOIN student s ON r.student_id = s.student_id
     JOIN quiz z ON r.quiz_id = z.quiz_id
     ORDER BY r.result_id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>All Student Results</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Quiz Title</th>
            <th>Score</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['result_id']; ?></td>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['quiz_title']; ?></td>
            <td><?php echo $row['score']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="index.php">Back to Home</a>
</body>
</html>
