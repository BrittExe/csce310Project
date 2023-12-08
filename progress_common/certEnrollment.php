<!-- Code by Ryan Kutz -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Progress Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<?php require '../databaseLoad.php'; ?>
<?php
session_start();
// Read UIN from GET parameters
$uin = $_GET["uin"];

// Make sure user is allowed to access this information (Students can't view other students' records)
if ($uin != $_SESSION["UIN"] && $_SESSION["User_Type"] != "Admin") {
    http_response_code(401);
    die("Error: You do not have permission to view this record. ");
}

// Set table info
$table_name = "Cert_Enrollment";
$query_str = "SELECT * FROM {$table_name} WHERE UIN = {$uin}";
$primary_key = "CertE_Num";
$bit_cols = array();
// Get student name info
$result = $conn->query("SELECT First_Name, M_Initial, Last_Name FROM User WHERE UIN = {$uin}");
$name_info = null;
if ($result -> num_rows > 0) {
    $name_info = $result->fetch_assoc();
}
else {
    http_response_code(404);
    die("Error: The record could not be found.");
}
?>
<?php require 'progressUtils.php'; ?>
<?php require 'handlePostRequest.php'; ?>

<?php if ($_SESSION["User_Type"] == "Admin") {
    require "../admin/adminHeader.php";
}
else {
    require "../student/studentHeader.php";
} 
require "progressSubNav.php";
?>


<div class="container-fluid">
  <div class="row mt-3">
    <h4>Cert Enrollments for <?= $name_info["First_Name"] . " " . $name_info["M_Initial"] . " " . $name_info["Last_Name"] ?></h4>
  </div>
  <div class="table-responsive mt-3">
    <?php
      buildEditableTable($conn, $query_str, array(
      "Cert_ID" => array("query_str" => "SELECT Cert_ID, Name FROM Certification", "value_col" => "Cert_ID", "label_col" => "Name"),
      "Program_Num" => array("query_str" => "SELECT Program_Num, Name FROM Programs WHERE Program_Num IN (SELECT Program_Num FROM Track WHERE UIN = {$uin})", "value_col" => "Program_Num", "label_col" => "Name")),
      array("CertE_Num", "UIN"),
      $uin);
    ?>
  </div>
</div>



</body>
</html>