<!-- Code by Brittain Schiller -->
<?php
// Start the session
session_start();

?>


<!DOCTYPE html>
<html>
<body>

<?php require '../databaseLoad.php'; ?>
<?php require 'studentHeader.php'; ?>

<?php

// handling deletion
if(array_key_exists('deleteAccount', $_POST)) { 
   deleteAccount(); 
} 
function deleteAccount(){
    global $conn;

    $UIN = $_SESSION["UIN"];
    // note that we do not do a "true" delete here; we just set "is_deleted" to True
    $sql = "UPDATE Total_College_Student SET Is_Deleted = '1' WHERE UIN = '$UIN'";
    $result = $conn->query($sql);
}

?>
<h1> Pressing this button will delete your account: Only do this if you are certain!</h1>
<!-- button to delete account -->
<form method="post"> 
        <input type="submit" name="deleteAccount"
                class="button" value="Delete Account" /> 
    </form> 

</body>
</html>