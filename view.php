<?php
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


$message = "";
$quizDetails = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quizid = $_POST["quizid"];

    // Retrieve quiz details from the quiz table
    $get_quiz_query = "SELECT * FROM quiz WHERE quizid = ?";
    
    // Prepare and bind the statement
    $stmt = $conn->prepare($get_quiz_query);
    $stmt->bind_param("i", $quizid);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $quizDetails = $result->fetch_assoc();
        
        if (empty($quizDetails)) {
            $message = "Quiz not found";
        }
    } else {
        $message = "Error retrieving quiz details: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Quiz</title>
</head>
<body>

<h2>View Quiz Details</h2>

<form method="post">
    Quiz ID: <input type="number" name="quizid" required><br><br>
    <input type="submit" value="View Quiz">
</form>

<?php if (!empty($quizDetails)): ?>
    <h3>Quiz Details:</h3>
    <p>Quiz ID: <?php echo $quizDetails["quizid"]; ?></p>
    <p>Quiz Name: <?php echo $quizDetails["quizname"]; ?></p>
    <p>Date Created: <?php echo $quizDetails["date_created"]; ?></p>
    <p>Mail: <?php echo $quizDetails["mail"]; ?></p>
<?php endif; ?>

<p><?php echo $message; ?></p>

</body>
</html>
