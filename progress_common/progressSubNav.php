<?php
// Code by Ryan Kutz
echo '
<div class="row">
<nav class="navbar navbar-expand-sm navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/csce310Project/progress_common/classEnrollment.php?uin=' . $uin . '">Class Enrollment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/csce310Project/progress_common/certEnrollment.php?uin=' . $uin . '">Cert Enrollment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/csce310Project/progress_common/internApp.php?uin=' . $uin . '">Internship Enrollment</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
';
?>