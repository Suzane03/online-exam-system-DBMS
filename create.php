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


// Get the user's mail (username) from the login session (replace this with your actual session handling)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get quiz details from the form
    $quizid = $_POST["quizid"];
    $quizname = $_POST["quizname"];
    $username = $_POST["username"];
    $date_created = date("Y-m-d H:i:s"); // Current date and time

    // Insert the quiz into the quiz table
    $insert_quiz_query = "INSERT INTO quiz (quizid, quizname, date_created, mail) VALUES ('$quizid', '$quizname', '$date_created', '$username')";
    if ($conn->query($insert_quiz_query) === TRUE) {
        echo "Quiz inserted successfully<br>";
    } else {
        echo "Error inserting quiz: " . $conn->error . "<br>";
    }

    // Insert questions
    $questions = $_POST["questions"];
    foreach ($questions as $q) {
        $question = $q["question"];
        $op1 = $q["op1"];
        $op2 = $q["op2"];
        $op3 = $q["op3"];
        $answer = $q["answer"];

        $insert_question_query = "INSERT INTO questions (qs, op1, op2, op3, answer, quizid) VALUES ('$question', '$op1', '$op2', '$op3', '$answer', '$quizid')";
        if ($conn->query($insert_question_query) === FALSE) {
            echo "Error inserting question: " . $conn->error . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Quiz</title>
</head>
<body>

<h2>Create a Quiz</h2>

<form method="post">
    Quiz ID: <input type="text" name="quizid" required><br><br>
    Quiz Name: <input type="text" name="quizname" required><br><br>
    User Mail: <input type="text" name="username" required><br><br>

    <!-- Question inputs (adjust as needed) -->
    <div id="questions">
        <div class="question">
            Question: <input type="text" name="questions[0][question]" required><br>
            Option 1: <input type="text" name="questions[0][op1]" required><br>
            Option 2: <input type="text" name="questions[0][op2]" required><br>
            Option 3: <input type="text" name="questions[0][op3]" required><br>
            Answer: <input type="text" name="questions[0][answer]" required><br>
            <hr>
        </div>
    </div>

    <input type="button" value="Add Question" onclick="addQuestion()">
    <br><br>
    <input type="submit" value="Create Quiz">
</form>

<script>
    var questionCount = 1;

    function addQuestion() {
        var questionsDiv = document.getElementById("questions");
        var questionDiv = document.createElement("div");
        questionDiv.className = "question";

        questionDiv.innerHTML =
            "Question: <input type='text' name='questions[" + questionCount + "][question]' required><br>" +
            "Option 1: <input type='text' name='questions[" + questionCount + "][op1]' required><br>" +
            "Option 2: <input type='text' name='questions[" + questionCount + "][op2]' required><br>" +
            "Option 3: <input type='text' name='questions[" + questionCount + "][op3]' required><br>" +
            "Answer: <input type='text' name='questions[" + questionCount + "][answer]' required><br>" +
            "<hr>";

        questionsDiv.appendChild(questionDiv);
        questionCount++;
    }
</script>

</body>
</html>