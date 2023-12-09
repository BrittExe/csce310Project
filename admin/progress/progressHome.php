<!DOCTYPE html>
<html lang="en">
<!-- Code by Ryan Kutz -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Progress Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<?php require '../../databaseLoad.php'; ?>
<?php require '../../progress_common/progressUtils.php'; ?>
<?php session_start(); ?>

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
            <a class="nav-link" href="internship.php">Internships</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>


<div class="container-fluid">
  <div class="row mt-3">
    <h4>TAMCC Students</h4>
  </div>
  <form class="d-inline-flex" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <select class="form-select" name="program">
      <?php
        $selected_value = null;
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
          if (isset($_POST['program']) && $_POST['program'] != "All"){
            $selected_value = $_POST["program"];
            echo '<option value="All">All Programs</option>';
          }
          else {
            echo '<option selected value="All">All Programs</option>';
          }
        }
        else {
          echo '<option selected value="All">All Programs</option>';
        }
        dropdownFromSql($conn, "SELECT Name FROM Programs", "Name", "Name", $selected_value);
      ?>
    </select>
    <button class="btn btn-outline-success p-2" type="submit">Search</button>
  </form>
  <div class="table-responsive mt-3">
    <table class="table table-bordered table-striped table-hover w-auto">
      <thead>
        <tr>
          <th>UIN</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Classification</th>
          <th>Major</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $query = "SELECT * FROM Progress_View";
          if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (isset($_POST['program']) && $_POST['program'] != "All"){
              $query = "SELECT * FROM Progress_View WHERE UIN IN (SELECT UIN FROM Track WHERE Program_Num IN (SELECT Program_Num FROM Programs WHERE Name = '{$_POST['program']}'))";
            }
          }
          $result = $conn->query($query);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                  if ($key === "UIN") {
                    echo "<td>" . "<a href=\"../../progress_common/classEnrollment.php?uin={$value}\">" . $value . "</a>" . "</td>";
                  }
                  else {
                    echo "<td>" . $value . "</td>";
                  }
                }
                echo "</tr>";
              }
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

    
</body>
</html>