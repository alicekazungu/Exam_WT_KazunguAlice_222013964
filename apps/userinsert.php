<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users Page</title>
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
      background-color: #333; /* Example header background color */
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
    form input[type="text"] {
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
    <li style="display: inline; margin-right: 10px;"><a href="./dashboard.php">apps</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact us.html">contact us</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./About Us.html">About Us</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
    <br><br>
  </ul>
</header>

<section>
  <!-- Users Form -->
  <h1>Users Form</h1>

  <form id="usersForm" method="post">
    <label for="userID">UserID:</label><br>
    <input type="number" id="userID" name="userID" required><br>
    
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    
    <label for="role">Role:</label><br>
    <select id="role" name="role" required>
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select><br>
    
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

// SQL query to fetch data from users table
$sql = "SELECT * FROM users";

// Execute query
$result = $conn->query($sql);

?>

<!-- Table to display user records -->
<h2>Table of Users</h2>
<table border="1">
  <tr>
    <th>User ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Password</th>
    <th>Role</th>
    <th>Actions</th>
  </tr>
  <?php
  // Check if there are any user records
  if ($result->num_rows > 0) {
      // Output data for each row
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['userID']}</td>
                  <td>{$row['username']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['password']}</td>
                  <td>{$row['role']}</td>
                  <td>
                      <a href='update.php?userID=" . $row['userID'] . "'>Update</a> | 
                      <a href='delete.php?userID=" . $row['userID'] . "' onclick='return confirmDelete(" . $row['userID'] . ");'>Delete</a>
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
    function confirmDelete(userID) {
      if (confirm("Are you sure you want to delete this record?")) {
        // Send AJAX request to delete record
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // If deletion is successful, remove the row from the table
            document.getElementById("userRow" + userID).remove();
            // Display success message
            alert("Record deleted successfully!");
          }
        };
        xhttp.open("GET", "delete.php?userID=" + userID, true);
        xhttp.send();
      }
    }
  </script>

</section>

<footer>
  <!-- Footer content... -->
</footer>

</body>
</html>
