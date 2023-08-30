<?php
// Assuming you have a database connection established
$host = "localhost";
$user = "root"; // Replace with your MySQL username
$ps = "";   // Replace with your MySQL password
$project = "project"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($host, $user, $ps, $project);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quizid = $_POST["quizid"];
    
    // Delete the quiz from the quiz table
    $delete_quiz_query = "DELETE FROM quiz WHERE quizid = ?";
    
    // Prepare and bind the statement
    $stmt = $conn->prepare($delete_quiz_query);
    $stmt->bind_param("i", $quizid);

    if ($stmt->execute()) {
        echo "Quiz deleted successfully";
    } else {
        echo "Error deleting quiz: " . $stmt->error;
    }

    $stmt->close();
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
    Quiz ID: <input type="number" name="quizid" required><br><br>
    <input type="submit" value="Delete Quiz">
</form>

</body>
</html>
