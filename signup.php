<!-- Code by Brittain Schiller -->

<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html>
<body>

<?php require 'databaseLoad.php'; ?>
<?php require 'databaseFunctions.php'; ?>

<?php

echo "<h1> Create an account: </h1>";

createEntityTable("Total_College_Student", [], []);

?>

</body>
</html>