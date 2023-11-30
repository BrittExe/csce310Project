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

// handle account creation
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // get all values
    $First_Name = sanitise_input($_POST["First_Name"]);
    $M_Initial = sanitise_input($_POST["M_Initial"]);
    $Last_Name = sanitise_input($_POST["Last_Name"]);
    $Username = sanitise_input($_POST["Username"]);
    $Passwords = sanitise_input($_POST["Passwords"]);
    #$User_Type = sanitise_input($_POST["User_Type"]);
    $Email = sanitise_input($_POST["Email"]);
    $Discord_Name = sanitise_input($_POST["Discord_Name"]);
    $Gender = sanitise_input($_POST["Gender"]);
    $Hispanic_Latino = sanitise_input($_POST["Hispanic_Latino"]);
    $Race = sanitise_input($_POST["Race"]);
    $US_Citizen = sanitise_input($_POST["US_Citizen"]);
    $First_Generation = sanitise_input($_POST["First_Generation"]);
    $DoB = sanitise_input($_POST["DoB"]);
    $GPA = sanitise_input($_POST["GPA"]);
    $Major = sanitise_input($_POST["Major"]);
    $Minor_1 = sanitise_input($_POST["Minor_1"]);
    $Minor_2 = sanitise_input($_POST["Minor_2"]);
    $Expected_Graduation = sanitise_input($_POST["Expected_Graduation"]);
    $School = sanitise_input($_POST["School"]);
    $Classification = sanitise_input($_POST["Classification"]);
    $Phone = sanitise_input($_POST["Phone"]);
    $Student_Type = sanitise_input($_POST["Student_Type"]);

    $College_Student_Values = array(
        "Gender" => $Gender, "Hispanic_Latino" => $Hispanic_Latino, "Race" => $Race, "US_Citizen" => $US_Citizen,
        "First_Generation" => $First_Generation, "DoB" => $DoB, "GPA" => $GPA, "Major" => $Major, "Minor_1" => $Minor_1, 
        "Minor_2" => $Minor_2, "Expected_Graduation" => $Expected_Graduation, "School" => $School, "Classification" => $Classification, 
        "Phone" => $Phone, "Student_Type" => $Student_Type,
    );


    $finishString = '';
    // check if this username and password combination already exists
    $sql = "SELECT * FROM User WHERE Username = '$Username' AND Passwords = '$Passwords'";
    $userResult = $conn->query($sql);
    if ($userResult->num_rows > 0){
        $finishString .= "That account already exists!";
    }
    else{
        // insert into User

        $userQuery = "INSERT INTO `User` (`UIN`, `First_Name`, `M_Initial`, `Last_Name`, `Username`, 
        `Passwords`, `User_Type`, `Email`, `Discord_Name`, `Is_Deleted`) VALUES 
        (NULL, '$First_Name', '$M_Initial', '$Last_Name', '$Username', '$Passwords', 'College Student', '$Email', '$Discord_Name', '0')";

        //echo $userQuery;
        $result = $conn->query($userQuery);
        
        // get UIN of the created User
        $UINsql = "SELECT * FROM User WHERE Username = '$Username' AND Passwords = '$Passwords'";
        $UINResult = $conn->query($UINsql);
        if ($UINResult->num_rows > 0){
            while ($row = $UINResult->fetch_assoc()) {
                $UIN = $row['UIN'];

            }
        }
        else{
            echo "There has been an error.";
            exit();
        }

        $updateSQL = "UPDATE Total_College_Student SET ";

        // specify the values to be updated
        foreach ($College_Student_Values as $key => $value) {
            // dont update the value if it is blank in the form
            if ($key !== 'UIN' && trim($value) !== '') {
                $isChanged = TRUE;
                $escapedValue = $conn->real_escape_string($value);
                // add to query
                $updateSQL .= "`$key` = '$escapedValue', ";
            }
        }

        $updateSQL = rtrim($updateSQL, ', ');
        // specify the specific entry to be updated
        $updateSQL .= " WHERE UIN = '$UIN'";


        //echo $updateSQL;

        $updateQuery = $conn->query($updateSQL);


        $finishString .= 'Account Created!';
    }

    echo $finishString;
}

echo "<h1> Create an account: </h1>";
echo "<h3> Entries marked with * are required. </h3>";
echo '<br> Click <a href="index.php">here</a> to return to the home page. <br>';

createEntityTable("Total_College_Student", ['UIN', 'Is_Deleted', 'User_Type'], ['First_Name', 'Username', 'Passwords', 'Phone']);

?>

</body>
</html>