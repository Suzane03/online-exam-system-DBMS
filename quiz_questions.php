<?php
session_start();

// Include your SQL connection file
require_once 'sql.php';

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

if (!isset($_POST['selected_quiz'])) {
    header("Location: quiz.php"); // Redirect if quiz is not selected
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedQuizId = $_POST['selected_quiz'];
    $username = $_POST['username'];

// Retrieve quiz questions based on the selected quiz
$conn = mysqli_connect($host, $user, $ps, $project);
if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
    exit();
}

$sql = "SELECT * FROM questions WHERE quizid = $selectedQuizId";
$result = mysqli_query($conn, $sql);
$totalQuestions = mysqli_num_rows($result);}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Questions</title>
    <!-- Include your CSS styling here -->
</head>
<body>
    <h1>Quiz Questions</h1>
    <form action="submit_quiz.php" method="post">
        <?php
        $questionNumber = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<p>{$row['qs']}</p>";
            echo "<input type='hidden' name='quiz_question_{$questionNumber}' value='{$row['qs']}'>";
            echo "<input type='radio' name='answer_{$questionNumber}' value='{$row['op1']}' required>{$row['op1']}<br>";
            echo "<input type='radio' name='answer_{$questionNumber}' value='{$row['op2']}' required>{$row['op2']}<br>";
            echo "<input type='radio' name='answer_{$questionNumber}' value='{$row['op3']}' required>{$row['op3']}<br>";
            
            echo "</div>";
            $questionNumber++;
        }
        ?>
        <input type="hidden" name="selected_quiz" value="<?php echo $selectedQuizId; ?>">
        <input type="hidden" name="total_questions" value="<?php echo $questionNumber - 1; ?>">
        <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">

        <button type="submit">Submit Answers</button>
    </form>
</body>
</html>
