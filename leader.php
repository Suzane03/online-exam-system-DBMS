<?php
// Start a session (if not already started)
session_start();

// Database configuration
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

// Fetch top 3 leaderboard
$sql = "SELECT q.quizname, s.score, s.totalscore, st.name, st.mail, s.remark
        FROM score s
        INNER JOIN student st ON s.mail = st.mail
        INNER JOIN quiz q ON s.quizid = q.quizid
        ORDER BY s.score DESC
        LIMIT 3";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Top 3 Leaderboard</title>
</head>
<body>

<h1>Top 3 Leaderboard</h1>

<?php
if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
    <th>Quiz Name</th>
    <th>Student Name</th>
    <th>Student Email</th>
    <th>Score</th>
    <th>Total Score</th>
    <th>Remark</th>
    </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['quizname'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['mail'] . "</td>";
        echo "<td>" . $row['score'] . "</td>";
        echo "<td>" . $row['totalscore'] . "</td>";
        echo "<td>" . $row['remark'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No leaderboard data available.";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
