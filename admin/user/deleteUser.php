<!-- Code by Brittain Schiller -->

<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php require '../../databaseLoad.php'; ?>
<?php require 'adminUserHeader.php'; ?>
<?php require '../../databaseFunctions.php'; ?>


<?php

echo "Enter the table and primary key of the entity to be deleted:";


table_select();

?>

</body>
</html>