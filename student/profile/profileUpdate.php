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

        $User_Values = array(
            "First_Name" => $First_Name, "M_Initial" => $M_Initial, "Last_Name" => $Last_Name,
            "Username" => $Username, "Passwords" => $Passwords, "Email" => $Email,
            "Discord_Name" => $Discord_Name,
        );
        

        // update User
        $userUpdate = "UPDATE User SET ";

        foreach ($User_Values as $key => $value){
            // dont update the value if it is blank in the form
            // also dont update UIN as it is autoincremented
            if ($key !== 'UIN' && trim($value) !== ''){

                $isChanged = TRUE;
                $escapedValue = $conn->real_escape_string($value);
                // add to query
                $userUpdate .= "`$key` = '$escapedValue', ";
            }
        }


        $userUpdate = rtrim($userUpdate, ', ');
        // specify the specific entry to be updated
        $userUpdate .= " WHERE UIN = '$UIN'";



        // update College_Student

        $College_Student_Update = "UPDATE College_Student SET ";

        foreach ($College_Student_Values as $key => $value){
            // dont update the value if it is blank in the form
            // also dont update UIN as it is autoincremented
            if ($key !== 'UIN' && trim($value) !== ''){

                $isChanged = TRUE;
                $escapedValue = $conn->real_escape_string($value);
                // add to query
                $College_Student_Update .= "`$key` = '$escapedValue', ";
            }
        }

        $College_Student_Update = rtrim($College_Student_Update, ', ');
        // specify the specific entry to be updated
        $College_Student_Update .= " WHERE UIN = '$UIN'";



        // starting the update query
        $updateQuery = "UPDATE Total_College_Student SET ";


        // update both
        if ($conn->query($userUpdate) == TRUE && $conn->query($College_Student_Update) === TRUE) {
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