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
    $stmt = $conn->prepare("INSERT INTO devices (device_name, os_version, owner_user_id, registration_date, last_sync) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $device_name, $os_version, $owner_user_id, $registration_date, $last_sync);

    // Set parameters and execute
    $device_name = $_POST['device_name'];
    $os_version = $_POST['os_version'];
    $owner_user_id = $_POST['owner_user_id'];
    $registration_date = $_POST['registration_date'];
    $last_sync = $_POST['last_sync'];

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
