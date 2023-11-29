<!-- Code by Brittain Schiller -->
<?php
// Start the session
session_start();

?>

<!DOCTYPE html>
<html>
<body>


<?php require '../../databaseLoad.php'; ?>
<?php require 'profileHeader.php'; ?>
<?php require '../../databaseFunctions.php'; ?>

<?php



    // get data from User and College Student
    $UIN = $_SESSION["UIN"];

    displayAttributes('Total_College_Student', 'UIN', $UIN);


   


?>

</body>
</html>