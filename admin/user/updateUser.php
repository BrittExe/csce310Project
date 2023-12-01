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

echo " <a href='selectUser.php'>Go Back</a>";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    
    // handling data coming in from selectUser
    if (isset($_POST['submit'])){
        $UIN = $_POST['backupPK'];
        $tableName = $_POST['backupTableName'];

        // starting the update query
        $updateQuery = "UPDATE $tableName SET ";

        // specify the values to be updated
        foreach ($_POST as $key => $value) {
            // dont update the value if it is blank in the form
            // also dont update UIN as it is autoincrement
            // and dont count the hidden values
            if ($key !== 'UIN' && trim($value) !== '' 
                && $key != 'backupPK' && $key != 'submit' && $key != 'backupTableName') {
                $isChanged = TRUE;
                $escapedValue = $conn->real_escape_string($value);
                // add to query
                $updateQuery .= "`$key` = '$escapedValue', ";
            }
        }

    $updateQuery = rtrim($updateQuery, ', ');
    // specify the specific entry to be updated
    $updateQuery .= " WHERE UIN = '$UIN'";

    // update the entry
    if ($isChanged === TRUE && $conn->query($updateQuery) === TRUE) {
        echo "update Successful!";
        } 
    else {
        echo "Update Failed. " . $conn->error;
        }

    }

    else{

        $UIN = $_POST['updateUIN'];
        $tableName = $_POST['tableName'];

        updateAttributesTable($tableName, 'UIN', $UIN, readOnlyAttributes: ['UIN']);
    }

}

?>


</body>
</html>