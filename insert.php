<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quizid = $_POST["quizid"];

    // Delete the quiz from the quiz table
    $delete_quiz_query = "DELETE FROM quiz WHERE quizid = '$quizid'";
    if ($conn->query($delete_quiz_query) === TRUE) {
        echo "Quiz deleted successfully";
    } else {
        echo "Error deleting quiz: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Quiz</title>
</head>
<body>

<h2>Delete a Quiz</h2>

<form method="post">
    Quiz ID: <input type="text" name="quizid" required><br><br>
    <input type="submit" value="Delete Quiz">
</form>

</body>
</html>
