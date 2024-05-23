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
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO applications (name, description, version, platform, developer_id, release_date, last_updated, download_url, rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisssd", $name, $description, $version, $platform, $developer_id, $release_date, $last_updated, $download_url, $rating);

    // Set parameters and execute
    $name = $_POST['name'];
    $description = $_POST['description'];
    $version = $_POST['version'];
    $platform = $_POST['platform']; // Assuming this field exists in your form
    $developer_id = $_POST['developer_id']; // Assuming this field exists in your form
    $release_date = $_POST['release_date']; // Assuming this field exists in your form
    $last_updated = $_POST['last_updated']; // Assuming this field exists in your form
    $download_url = $_POST['download_url']; // Assuming this field exists in your form
    $rating = $_POST['rating']; // Assuming this field exists in your form

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
