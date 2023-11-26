<!-- Creator: Brittain Schiller
Sets up database; meant to be imported into other files for ease of access -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = 'Cybersecurity'; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?> 