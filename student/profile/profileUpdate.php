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

    $isChanged = FALSE;
    $UIN = $_SESSION["UIN"];
    // handle update 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        // starting the update query
        $updateQuery = "UPDATE Total_College_Student SET ";

        // specify the values to be updated
        foreach ($_POST as $key => $value) {
            // dont update the value if it is blank in the form
            if ($key !== 'UIN' && trim($value) !== '') {
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

    updateAttributesTable('Total_College_Student', 'UIN', $UIN, []);

?>

</body>
</html>