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

table_select();

// handling form selection
if ($_SERVER["REQUEST_METHOD"] == "POST"){
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
            $tableRow .= "</tr>";
            echo $tableRow;
        }
    }
    


    // display the row


    echo "</table>";
}
?>