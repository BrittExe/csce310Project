<!-- Code by Brittain Schiller -->
<?php
echo '<a href="../studentHome.php">Home</a> -
<a href="profileView.php">Profile</a> -
<a href="../studentDelete.php">Delete Account</a> -
<a href="/csce310Project/progress_common/classEnrollment.php?uin=' . $_SESSION["UIN"] . '">Program Progress Tracking</a> -
<a href="../../logout.php">Logout</a>
<br>
<ul>
<li> <a href="profileView.php">View</a> </li>
<li> <a href="profileUpdate.php">Update</a> </li>
</ul>';
?>
