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
<?php require '../../databaseFunctions.php'; ?>

<div class="row">
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand">TAMCC</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="../adminHome.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user/createAdmin.php">Account Management</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="progressHome.php">Program Progress Tracking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../logout.php">Logout</a>
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
      <option selected disabled>Filter by program</option>
      <?php
        $query = "SELECT Program_Num, Name FROM Programs";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["Program_Num"] . '">' . $row["Name"] . '</option>';
            }
        }
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
            if (isset($_POST['program'])){
              $query = "SELECT * FROM Progress_View WHERE UIN IN (SELECT UIN FROM Track WHERE Program_Num = {$_POST['program']})";
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