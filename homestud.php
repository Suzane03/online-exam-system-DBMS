<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            background-color: #428bca;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Quiz Portal</h1>
        <button class="button" onclick="showQuizzes()">Show Quizzes</button>
        <button class="button" onclick="attemptQuiz()">Attempt Quiz</button>
        <button class="button" onclick="showScores()">Show Scores</button>
        <button class="button" onclick="showLeaderboards()">Show Leaderboards</button>
    </div>
    <a href="index.php">Back to Login</a>
    <script>
        function showQuizzes() {
            window.location.href = "show.php"; // Replace with the actual URL to show quizzes page
        }

        function attemptQuiz() {
            window.location.href = "quiz.php"; // Replace with the actual URL to attempt quiz page
        }

        function showScores() {
            window.location.href = "score.php"; // Replace with the actual URL to show scores page
        }

        function showLeaderboards() {
            window.location.href = "leader.php"; // Replace with the actual URL to show leaderboards page
        }
    
    </script>
</body>
</html>
