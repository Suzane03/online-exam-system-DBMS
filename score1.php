<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";   // Replace with your MySQL password
$dbname = "project"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SESSION["type"] !== "staff") {
    die("Access denied. You must be a staff member to view scores.");
}

// Query to retrieve scores, remarks, and other details
$query = "SELECT s.name AS student_name, q.quizname AS quiz_name, sc.score, sc.totalscore, sc.remark
          FROM score sc
          INNER JOIN student s ON sc.mail = s.mail
          INNER JOIN quiz q ON sc.quizid = q.quizid";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Scores</title>
</head>
<body>

<h2>View Scores</h2>

<?php
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Student Name</th>
                <th>Quiz Name</th>
                <th>Score</th>
                <th>Total Score</th>
                <th>Remark</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['student_name']}</td>
                <td>{$row['quiz_name']}</td>
                <td>{$row['score']}</td>
                <td>{$row['totalscore']}</td>
                <td>{$row['remark']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No scores found.</p>";
}

echo "<a href='homestaff.php'>Back to Staff Home</a>";
?>

</body>
</html>
