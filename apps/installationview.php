<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Installations Page</title>
  <style>
    /* CSS styles */
    body {
      font-family: Arial, sans-serif; /* Example font family */
      margin: 0; /* Remove default margin */
      padding: 0; /* Remove default padding */
      background-image: url('./Images/LECTA.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }

    header {
      background-color: darkblue; /* Example header background color */
      color: #fff; /* Example header text color */
      padding: 10px; /* Add some padding to the header */
    }

    /* Style the navigation links */
    header ul {
      margin: 0;
      padding: 0;
      list-style-type: none;
    }

    header ul li {
      display: inline;
      margin-right: 10px;
    }

    header ul li a {
      color: #fff;
      text-decoration: none;
    }

    /* Style the form */
    form {
      margin-top: 20px;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 5px;
    }

    form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    form input[type="number"],
    form input[type="text"],
    form input[type="date"] {
      width: 400px;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    form input[type="submit"] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Style the table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    table th {
      background-color: #333;
      color: #fff;
    }

    table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    /* Style footer */
    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body>

<header>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./A.jpg" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">Home</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./dashboard.php">Stock</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact us.html">Contact Us</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./About Us.html">About Us</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Account</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
    <br><br>
  </ul>
</header>

<section>
  <!-- Installations Form -->
  <h1>Installations Form</h1>

  <form id="installationsForm" method="post">
    <label for="device_id">Device ID:</label><br>
    <input type="text" id="device_id" name="device_id" required><br>
    
    <label for="application_id">Application ID:</label><br>
    <input type="text" id="application_id" name="application_id" required><br>
    
    <label for="installation_date">Installation Date:</label><br>
    <input type="date" id="installation_date" name="installation_date" required><br>
    
    <label for="status">Status:</label><br>
    <input type="text" id="status" name="status" required><br>
    
    <input type="submit" value="Insert">
  </form>

  <!-- PHP code for form submission and displaying records -->
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

// SQL query to fetch data from installations table
$sql = "SELECT * FROM installations";

// Execute query
$result = $conn->query($sql);

?>

<!-- Table to display installation records -->
<h2>Table of Installations</h2>
<table border="1">
  <tr>
    <th>Installation ID</th>
    <th>Device ID</th>
    <th>Application ID</th>
    <th>Installation Date</th>
    <th>Status</th>
    <th>Actions</th>
  </tr>
  <?php
  // Check if there are any installation records
  if ($result->num_rows > 0) {
      // Output data for each row
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . $row['installation_id'] . "</td>
                  <td>" . $row['device_id'] . "</td>
                  <td>" . $row['application_id'] . "</td>
                  <td>" . $row['installation_date'] . "</td>
                  <td>" . $row['status'] . "</td>
                  <td>
                      <a href='update.php?installation_id=" . $row['installation_id'] . "'>Update</a> | 
                      <a href='delete.php?installation_id=" . $row['installation_id'] . "' onclick='return confirmDelete();'>Delete</a>
                  </td>
                </tr>";
      }
  } else {
      echo "<tr><td colspan='6'>No data found</td></tr>";
  }
  ?>
</table>

<?php
// Close the database connection
$conn->close();
?>

<script>
  function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
  }
</script>

</section>

<footer>
  <!-- Footer content... -->
</footer>

</body>
</html>
