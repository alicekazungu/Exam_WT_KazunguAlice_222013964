<?php
// Establish database connection (replace with your own credentials)
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

// Retrieve form data
$names = $_POST['names'];
$username = $_POST['username'];
$email = $_POST['email'];
$tel_number = $_POST['tel_number'];
$password = $_POST['password'];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement to insert user data into the database
$sql = "INSERT INTO Users (Names, Username, Email, Tel_Number, Password)
        VALUES (?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $names, $username, $email, $tel_number, $hashed_password);

// Execute SQL statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>
