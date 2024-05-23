<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Applications Page</title>
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
    form textarea,
    form input[type="number"],
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
    <li style="display: inline; margin-right: 10px;"><a href="./dashboard.php">apps</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">Contact</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./About .html">About </a></li>
     <li style="display: inline; margin-right: 10px;"><a href="./Categoriesri.html">Categories</a></li>
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
  <!-- Applications Form -->
  <h1>Applications Form</h1>

  <form id="applicationsForm" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    
    <label for="description">Description:</label><br>
    <textarea id="description" name="description" rows="4" required></textarea><br>
    
    <label for="version">Version:</label><br>
    <input type="text" id="version" name="version" required><br>
    
    <label for="platform">Platform:</label><br>
    <input type="text" id="platform" name="platform" required><br>
    
    <label for="developer_id">Developer ID:</label><br>
    <input type="number" id="developer_id" name="developer_id" required><br>
    
    <label for="release_date">Release Date:</label><br>
    <input type="date" id="release_date" name="release_date" required><br>
    
    <label for="last_updated">Last Updated:</label><br>
    <input type="date" id="last_updated" name="last_updated" required><br>
    
    <label for="download_url">Download URL:</label><br>
    <input type="text" id="download_url" name="download_url" required><br>
    
    <label for="rating">Rating:</label><br>
    <input type="number" id="rating" name="rating" step="0.1" min="0" max="10" required><br>
    
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
      $stmt = $conn->prepare("INSERT INTO applications (name, description, version, platform, developer_id, release_date, last_updated, download_url, rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssisssd", $name, $description, $version, $platform, $developer_id, $release_date, $last_updated, $download_url, $rating);

      // Set parameters and execute
      $name = $_POST['name'];
      $description = $_POST['description'];
      $version = $_POST['version'];
      $platform = $_POST['platform'];
      $developer_id = $_POST['developer_id'];
      $release_date = $_POST['release_date'];
      $last_updated = $_POST['last_updated'];
      $download_url = $_POST['download_url'];
      $rating = $_POST['rating'];

      if ($stmt->execute()) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $stmt->error;
      }

      $stmt->close();
  }

  // SQL query to fetch data from applications table
  $sql = "SELECT * FROM applications";

  // Execute query
  $result = $conn->query($sql);

  ?>

  <!-- Table to display application records -->
  <h2>Table of Applications</h2>
  <table border="1">
    <tr>
      <th>Application ID</th>
      <th>Name</th>
      <th>Description</th>
      <th>Version</th>
      <th>Platform</th>
      <th>Developer ID</th>
      <th>Release Date</th>
      <th>Last Updated</th>
      <th>Download URL</th>
      <th>Rating</th>
      <th>Actions</th>
    </tr>
    <?php
    // Check if there are any application records
    if ($result->num_rows > 0) {
        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['application_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['version'] . "</td>
                    <td>" . $row['platform'] . "</td>
                    <td>" . $row['developer_id'] . "</td>
                    <td>" . $row['release_date'] . "</td>
                    <td>" . $row['last_updated'] . "</td>
                    <td>" . $row['download_url'] . "</td>
                    <td>" . $row['rating'] . "</td>
                    <td>
                        <a href='updateApplication.php?application_id=" . $row['application_id'] . "'>Update</a> | 
                        <a href='appdelete.php?application_id=" . $row['application_id'] . "' onclick='return confirmDelete();'>Delete</a>
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
