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
    $stmt = $conn->prepare("INSERT INTO installations (device_id, application_id, installation_date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $device_id, $application_id, $installation_date, $status);

    // Set parameters and execute
    $device_id = $_POST['device_id'];
    $application_id = $_POST['application_id'];
    $installation_date = $_POST['installation_date'];
    $status = $_POST['status'];

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
