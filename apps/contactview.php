<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Page</title>
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
      background-color: darkgreen;
      border-radius: 5px;
    }

    form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    form input[type="number"],
    form input[type="text"],
    form input[type="email"] {
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
  <!-- Contact Form -->
  <h1>Contact Form</h1>

  <form id="contactsForm" method="post">
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name" required><br>
    
    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="last_name" required><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    
    <label for="phone_number">Phone Number:</label><br>
    <input type="text" id="phone_number" name="phone_number" required><br>
    
    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" required><br>
    
    <label for="city">City:</label><br>
    <input type="text" id="city" name="city" required><br>
    
    <label for="state">State:</label><br>
    <input type="text" id="state" name="state" required><br>
    
    <label for="postal_code">Postal Code:</label><br>
    <input type="text" id="postal_code" name="postal_code" required><br>
    
    <label for="country">Country:</label><br>
    <input type="text" id="country" name="country" required><br>
    
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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind parameters
      $stmt = $conn->prepare("INSERT INTO contacts (first_name, last_name, email, phone_number, address, city, state, postal_code, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssssss", $first_name, $last_name, $email, $phone_number, $address, $city, $state, $postal_code, $country);

      // Set parameters and execute
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $phone_number = $_POST['phone_number'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $postal_code = $_POST['postal_code'];
      $country = $_POST['country'];

      if ($stmt->execute()) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  // SQL query to fetch data from contacts table
  $sql = "SELECT * FROM contacts";

  // Execute query
  $result = $conn->query($sql);

  ?>

  <!-- Table to display contact records -->
  <h2>Table of Contacts</h2>
  <table border="1">
    <tr>
      <th>Contact ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Address</th>
      <th>City</th>
      <th>State</th>
      <th>Postal Code</th>
      <th>Country</th>
      <th>Actions</th>
    </tr>
    <?php
    // Check if there are any contact records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['contact_id'] . "</td>
                    <td>" . $row['first_name'] . "</td>
                    <td>" . $row['last_name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phone_number'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['city'] . "</td>
                    <td>" . $row['state'] . "</td>
                    <td>" . $row['postal_code'] . "</td>
                    <td>" . $row['country'] . "</td>
                    <td>
                        <a href='update.php?contact_id=" . $row['contact_id'] . "'>Update</a> | 
                        <a href='delete.php?contact_id=" . $row['contact_id'] . "' onclick='return confirmDelete();'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='11'>No data found</td></tr>";
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
