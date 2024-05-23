<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Devices Page</title>
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
  <!-- Devices Form -->
  <h1>Devices Form</h1>

  <form id="devicesForm" method="post">
    <label for="device_name">Device Name:</label><br>
    <input type="text" id="device_name" name="device_name" required><br>
    
    <label for="os_version">OS Version:</label><br>
    <input type="text" id="os_version" name="os_version" required><br>
    
    <label for="owner_user_id">Owner User ID:</label><br>
    <input type="text" id="owner_user_id" name="owner_user_id" required><br>
    
    <label for="registration_date">Registration Date:</label><br>
    <input type="date" id="registration_date" name="registration_date" required><br>
    
    <label for="last_sync">Last Sync:</label><br>
    <input type="date" id="last_sync" name="last_sync" required><br>
    
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

// SQL query to fetch data from devices table
$sql = "SELECT * FROM devices";

// Execute query
$result = $conn->query($sql);

?>

<!-- Table to display device records -->
<h2>Table of Devices</h2>
<table border="1">
  <tr>
    <th>Device ID</th>
    <th>Device Name</th>
    <th>OS Version</th>
    <th>Owner User ID</th>
    <th>Registration Date</th>
    <th>Last Sync</th>
    <th>Actions</th>
  </tr>
  <?php
  // Check if there are any device records
  if ($result->num_rows > 0) {
      // Output data for each row
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . $row['device_id'] . "</td>
                  <td>" . $row['device_name'] . "</td>
                  <td>" . $row['os_version'] . "</td>
                  <td>" . $row['owner_user_id'] . "</td>
                  <td>" . $row['registration_date'] . "</td>
                  <td>" . $row['last_sync'] . "</td>
                  <td>
                      <a href='update.php?device_id=" . $row['device_id'] . "'>Update</a> | 
                      <a href='delete.php?device_id=" . $row['device_id'] . "' onclick='return confirmDelete();'>Delete</a>
                  </td>
                </tr>";
      }
  } else {
      echo "<tr><td colspan='7'>No data found</td></tr>";
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
