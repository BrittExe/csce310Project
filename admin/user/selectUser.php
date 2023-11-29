<!-- Code by Brittain Schiller -->

<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>

<?php require '../../databaseLoad.php'; ?>
<?php require 'adminUserHeader.php'; ?>
<?php require '../../databaseFunctions.php'; ?>

<?php

table_select(['User', 'College_Student']);


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // handling form selection
    if (isset($_POST['submit'])){
        $chosenTable = sanitise_input($_POST["table"]);

        $tableOpening = "<table><tr>";

        // get list of all attributes in table for making html table
        $sql = "SHOW COLUMNS FROM $chosenTable";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $columnname = sanitise_input($row['Field']);
                $tableOpening .= "<th>" . $columnname . "</th>";
            }
        }

        $tableOpening .= "</tr>";
        echo $tableOpening;


        // select * from the table
        $sql = "SELECT * FROM $chosenTable";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            // make a row for each entry
            while ($row = $result->fetch_assoc()) {

                
                $tableRow = "<tr>";
                foreach ($row as $key => $value){
                    $tableRow .="<td>" . $value . "</td>";
                }
                if ($chosenTable === "User"){
                    // get UIN
                    $uin = $row['UIN'];
                    $tableRow .= "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>";

                    $tableRow .= "<td><button name='partialDelete' value='$uin'>Partial Delete</button></td>";
                    $tableRow .= "<td><button name='fullDelete' value='$uin'>Full Delete</button></td>";
                    $tableRow .= "</form>";
                }   
                $tableRow .= "</tr>";
                echo $tableRow;
            }
        }
        echo "</table>";
    }

    // handle partial delete
    else if (isset($_POST['partialDelete'])){
        // get the user with that UIN and set Is_Deleted to True
        $selectedUIN = $_POST['partialDelete'];
        $sql = "UPDATE User SET Is_Deleted=1 WHERE UIN = $selectedUIN";
        $result = $conn->query($sql);
        echo "Deletion complete!";
    }



    // handle full delete
    else if (isset($_POST['fullDelete'])){
        // get the user with that UIN and delete it
        $selectedUIN = $_POST['fullDelete'];
        $sql = "DELETE FROM User WHERE UIN = $selectedUIN";
        $result = $conn->query($sql);
        echo "Deletion complete!";
    }

}
?>

</body>
</html>