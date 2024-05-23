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
    // Prepare and bind parameters for UPDATE query
    $stmt = $conn->prepare("UPDATE developers SET username=?, email=?, password=?, registration_date=? WHERE developer_id=?");
    $stmt->bind_param("ssssi", $username, $email, $password, $registration_date, $developer_id);

    // Set parameters from form submission
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $registration_date = $_POST['registration_date'];
    $developer_id = $_POST['developer_id']; // Hidden input field in the form containing developer_id

    // Execute the update query
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
