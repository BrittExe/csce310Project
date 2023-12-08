<!-- Code by Brittain Schiller -->
<?php
echo '
<div class="row">
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand">TAMCC</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/csce310Project/student/studentHome.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/csce310Project/student/profile/profileView.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/csce310Project/student/studentDelete.php">Delete Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/csce310Project/progress_common/classEnrollment.php?uin=' . $_SESSION["UIN"] . '">Program Progress Tracking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/csce310Project/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
'
?>

