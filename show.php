<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Quizzes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        a {
            text-decoration: none;
            color: #428bca;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quizzes List</h1>

        <?php
        // Database connection configuration
        $host = "localhost";
        $user = "root"; // Replace with your MySQL username
        $ps = "";   // Replace with your MySQL password
        $project = "project"; // Replace with your actual database name

        // Create a connection
        $conn = new mysqli($host, $user, $ps, $project);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch quizzes from the database
        $query = "SELECT * FROM quiz";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>{$row['quizname']} - Created: {$row['date_created']}</li>";
            }
            echo "</ul>";
        } else {
            echo "No quizzes found.";
        }

        // Close the connection
        $conn->close();
        ?>

        <a href="homestud.php">Back to Home</a>
    </div>
</body>
</html>
