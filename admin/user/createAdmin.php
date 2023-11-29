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

// handle account creation
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // get all values
    $First_Name = sanitise_input($_POST["First_Name"]);
    $M_Initial = sanitise_input($_POST["M_Initial"]);
    $Last_Name = sanitise_input($_POST["Last_Name"]);
    $Username = sanitise_input($_POST["Username"]);
    $Passwords = sanitise_input($_POST["Passwords"]);
    $User_Type = sanitise_input($_POST["User_Type"]);
    $Email = sanitise_input($_POST["Email"]);
    $Discord_Name = sanitise_input($_POST["Discord_Name"]);


    $finishString = '';
    // check if this username and password combination already exists
    $sql = "SELECT * FROM User WHERE Username = '$Username' AND Passwords = '$Passwords'";
    $userResult = $conn->query($sql);
    if ($userResult->num_rows > 100){
        $finishString .= "That account already exists!";
    }
    else{
        // insert into User

        $userQuery = "INSERT INTO `User` (`UIN`, `First_Name`, `M_Initial`, `Last_Name`, `Username`, 
        `Passwords`, `User_Type`, `Email`, `Discord_Name`, `Is_Deleted`) VALUES 
        (NULL, '$First_Name', '$M_Initial', '$Last_Name', '$Username', '$Passwords', 'Admin', '$Email', '$Discord_Name', '0')";

        $result = $conn->query($userQuery);

        $finishString .= 'Account Created!';
    }

    $finishString .= '<br> Click <a href="index.php">here</a> to return to the home page.';
    echo $finishString;
}

echo "<h1> Create an admin account: </h1>";
echo "<h3> Entries marked with * are required. </h3>";

createEntityTable("User", ['UIN', 'Is_Deleted'], ['First_Name', 'Username', 'Passwords']);

?>

</body>
</html>