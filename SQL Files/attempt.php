<?php
session_start();

// Include your SQL connection file
require_once 'sql.php';

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Retrieve quiz names from the database
$conn = mysqli_connect($host, $user, $ps, $project);
if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
    exit();
}

$sql = "SELECT * FROM quiz";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Quiz</title>
    <!-- Include your CSS styling here -->
</head>
<body>
    <h1>Select Quiz</h1>
    <form action="quiz_questions.php" method="post">
        <select name="selected_quiz">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['quizid']}'>{$row['quizname']}</option>";
            }
            ?>
        </select>
        <button type="submit">Start Quiz</button>
    </form>
</body>
</html>
