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

<?php require '../../databaseLoad.php'; ?>
<?php
session_start();

// Make sure user is allowed to access this information (Students can't view other students' records)
if ($_SESSION["User_Type"] != "Admin") {
    http_response_code(401);
    die("Error: You do not have permission to view this record. ");
}

// Set table info
$table_name = "Internship";
$query_str = "SELECT * FROM {$table_name}";
$primary_key = "Intern_ID";
$bit_cols = array("Is_Gov");
?>
<?php require '../../progress_common/progressUtils.php'; ?>
<?php require '../../progress_common/handlePostRequest.php'; ?>

<?php require "../adminHeader.php" ?>
<div class="row">
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="classes.php">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="certification.php">Certifications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="internship.php">Internships</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>

<div class="container-fluid">
  <div class="row mt-3">
    <h4>Internships</h4>
  </div>
  <div class="table-responsive mt-3">
    <?php
      buildEditableTable($conn, $query_str, array(), array("Intern_ID"));
    ?>
  </div>
</div>