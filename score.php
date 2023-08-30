<?php
// Replace these variables with your database connection details
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

// Start a session (if not already started)
session_start();

// Check if the user is logged in and their email is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare and execute the SQL query
    $sql = "SELECT q.quizname, s.score, s.totalscore, st.name, s.mail
            FROM score s
            INNER JOIN student st ON s.mail = st.mail
            INNER JOIN quiz q ON q.quizid = s.quizid
            WHERE s.mail = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Fetch results
    $result = $stmt->get_result();

    // Display student's scores for all quizzes
    while ($row = $result->fetch_assoc()) {
        echo "Quiz: " . $row["quizname"] . "<br>";
        echo "Score: " . $row["score"] . "<br>";
        echo "Total Score: " . $row["totalscore"] . "<br>";
        echo "Student Name: " . $row["name"] . "<br>";
        echo "Email: " . $row["mail"] . "<br>";
        echo "<hr>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "User is not logged in.";
}
?>
<a href="homestud.php">Back to Home</a>