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

<?php



    // get data from User and College Student
    $UIN = $_SESSION["UIN"];
    $sql = "SELECT * FROM Total_College_Student WHERE UIN = '$UIN'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $First_Name = $row["First_Name"];
        $M_Initial = $row["M_Initial"];
        $Last_Name = $row["Last_Name"];
        $Username = $row["Username"];
        $Passwords = $row["Passwords"];
        $User_Type = $row["User_Type"];
        $Email = $row["Email"];
        $Discord_Name = $row["Discord_Name"];
        $Gender = $row["Gender"];
        $Hispanic_Latino = $row["Hispanic/Latino"];
        $Race = $row["Race"];
        $US_Citizen = $row["U.S. Citizen"];
        $First_Generation = $row["First_Generation"];
        $DoB = $row["DoB"];
        $GPA = $row["GPA"];
        $Major = $row["Major"];
        $Minor1 = $row["Minor #1"];
        $Minor2 = $row["Minor #2"];
        $Expected_Graduation = $row["Expected_Graduation"];
        $School = $row["School"];
        $Classification = $row["Classification"];
        $Phone = $row["Phone"];
        $Student_Type = $row["Student_Type"];

    }


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


    
    echo "<br> UIN: $UIN <br> First Name: $First_Name <br> Middle Initial: $M_Initial 
    <br> Last Name: $Last_Name <br> Username: $Username <br> Passwords: $Passwords <br> User Type: $User_Type <br> Email: $Email <br> Discord Name: $Discord_Name";

    echo "<br> Specialized student info: <br>";

    echo "Gender: $Gender <br> Hispanic/Latino: $Hispanic_Latino <br> Race: $Race <br> US Citizenship: $US_Citizen <br> 
    First Generation Student: $First_Generation <br> Date of Birth: $DoB <br> GPA: $GPA <br> Major: $Major <br> 
    Minor 1: $Minor1 <br> Minor 2: $Minor2 <br> Expected Graduation: $Expected_Graduation <br> School: $School <br>
    Classification: $Classification <br> Phone Number: $Phone <br> Student Type: $Student_Type"


?>

</body>
</html>