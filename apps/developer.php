<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apps"; // Replace 'your_database_name' with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO developers (username, email, password, registration_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $registration_date);

    // Set parameters and execute
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $registration_date = $_POST['registration_date'];

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
