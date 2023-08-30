<?php
// Establish database connection
$host = "localhost";
$user = "root"; // Replace with your MySQL username
$ps = "";   // Replace with your MySQL password
$project = "project"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($host, $user, $ps, $project);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedQuizId = $_POST["selected_quiz"];
    $totalQuestions = $_POST["total_questions"];
    $score = 0;

    for ($i = 1; $i <= $totalQuestions; $i++) {
        $quizQuestion = $_POST["quiz_question_{$i}"];
        $userAnswer = $_POST["answer_{$i}"];

        $sql = "SELECT answer FROM questions WHERE quizid = $selectedQuizId AND qs = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $quizQuestion);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $correctAnswer = $row['answer'];

        if ($userAnswer === $correctAnswer) {
            $score++;
        }
    }

    $percentage = ($score / $totalQuestions) * 100;

    // Retrieve the mail from the session
    $mail1 = $_POST["username"];

    // Verify that the retrieved mail is a valid student mail before inserting into the score table
    $verifyStudentQuery = "SELECT mail FROM student WHERE mail = ?";
    $stmt = $conn->prepare($verifyStudentQuery);
    $stmt->bind_param("s", $mail1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // If the mail is not found in the student table, handle the error appropriately
        die("Error: User not found or not a valid student.");
    }
    $conn->query("SET FOREIGN_KEY_CHECKS = 0");
    // Now proceed with inserting the score
    $insertScoreQuery = "INSERT INTO score (score, quizid, mail, totalscore, remark) VALUES (?, ?, ?, ?, ?)";
    $totalscore = $totalQuestions;
    $remark = ($percentage >= 60) ? "good" : "bad";

    $stmt = $conn->prepare($insertScoreQuery);
    $stmt->bind_param("iiisi", $score, $selectedQuizId, $mail1, $totalscore, $remark);
    $stmt->execute();
    $stmt->close();
   $conn->query("SET FOREIGN_KEY_CHECKS = 1");
    // ...
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
</head>
<body>

<h2>Quiz Result</h2>

<?php
if (isset($score)) {
    echo "<p>Your Score: $score out of $totalQuestions</p>";
    echo "<p>Percentage: $percentage%</p>";
    echo "<a href='homestud.php'>Back to Home</a>";
} else {
    echo "<p>Quiz not found or answers not submitted.</p>";
}
?>

</body>
</html>
