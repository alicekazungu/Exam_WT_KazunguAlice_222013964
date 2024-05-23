<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apps"; // Replace 'apps' with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if developer_id is set
if (isset($_GET['developer_id'])) {
    $developer_id = $_GET['developer_id'];

    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM developers WHERE developer_id=?");
    $stmt->bind_param("i", $developer_id);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>Record deleted successfully.</div>";
            // Redirect back to this page after deletion
            header("Location: developerview.php");
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
        <title>Delete Developer Record</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>Delete Developer</h2>
            <form method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="developer_id" value="<?php echo $developer_id; ?>">
                <input type="submit" value="Delete" class="btn btn-danger">
                <a href="developerview.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this developer?");
            }
        </script>
    </body>
    </html>
    <?php
} else {
    echo "Developer ID is not set.";
}
?>
