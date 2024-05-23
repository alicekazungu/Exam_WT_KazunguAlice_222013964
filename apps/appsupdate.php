<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apps";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters for UPDATE query
    $stmt = $conn->prepare("UPDATE applications SET name=?, description=?, version=?, platform=?, developerview_id=?, release_date=?, last_updated=?, download_url=?, rating=? WHERE application_id=?");
    $stmt->bind_param("ssssisssdi", $name, $description, $version, $platform, $developer_id, $release_date, $last_updated, $download_url, $rating, $application_id);

    // Set parameters from form submission
    $name = $_POST['name'];
    $description = $_POST['description'];
    $version = $_POST['version'];
    $platform = $_POST['platform'];
    $developer_id = $_POST['developer_id'];
    $release_date = $_POST['release_date'];
    $last_updated = $_POST['last_updated'];
    $download_url = $_POST['download_url'];
    $rating = $_POST['rating'];
    $application_id = $_POST['application_id']; // Hidden input field in the form containing application_id

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
