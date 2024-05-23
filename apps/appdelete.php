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

// Check if application_id is set
if (isset($_GET['application_id'])) {
    $application_id = $_GET['application_id'];

    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM applications WHERE application_id=?");
    $stmt->bind_param("i", $application_id);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>Record deleted successfully.</div>";
            // Redirect back to this page after deletion
            header("Location: applicationview.php");
            exit(); // Ensure script stops execution after redirection
        } else {
            echo "<div class='alert alert-danger mt-3'>Error deleting data: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    // Display the delete confirmation form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Application Record</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>Delete Application</h2>
            <form method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="application_id" value="<?php echo $application_id; ?>">
                <input type="submit" value="Delete" class="btn btn-danger">
                <a href="applicationview.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this application?");
            }
        </script>
    </body>
    </html>
    <?php
} else {
    echo "Application ID is not set.";
}
?>
