<!DOCTYPE html>
<html>
<head>
    <title>Staff Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            outline: none;
            height: 100%;
            min-height: 100%;
            color: #042A38 !important;
            font-family: 'Courier New', Courier, monospace;
            background-color: #F4F4F4;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
            background-color: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #042A38;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #042A38;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease-in-out;
        }

        a.button:hover {
            background-color: #024268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Staff Home Page</h1>
        <ul>
            <li><a href="create.php" class="button">Create Quiz</a></li>
            <li><a href="delete.php" class="button">Delete Quiz</a></li>
            <li><a href="view.php" class="button">View Quiz</a></li>
            <li><a href="score1.php" class="button">View Scores</a></li>
            <li><a href="leader.php" class="button">Leaderboard</a></li>
        </ul>
    </div>
</body>
</html>
