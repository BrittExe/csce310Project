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



    // get data from User and College Student
    $UIN = $_SESSION["UIN"];

    displayAttributes('Total_College_Student', 'UIN', $UIN);


    // // Get data from College_Student
    // $sql = "SELECT * FROM College_Student WHERE UIN = '$UIN'";
    // $result = $conn->query($sql);
    // while($row = $result->fetch_assoc()) {
    //     $Gender = $row["Gender"];
    //     $Hispanic_Latino = $row["Hispanic/Latino"];
    //     $Race = $row["Race"];
    //     $US_Citizen = $row["U.S. Citizen"];
    //     $First_Generation = $row["First_Generation"];
    //     $DoB = $row["DoB"];
    //     $GPA = $row["GPA"];
    //     $Major = $row["Major"];

    // }



?>

</body>
</html>