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
// handling login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate data
    $name = sanitise_input($_POST["name"]);
    $password = sanitise_input($_POST["password"]);


    // check database for the data
    $sql = "SELECT * FROM User WHERE Username = '$name' AND Passwords = '$password'";
    $result = $conn->query($sql);


    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // save UIN in session
            $_SESSION["UIN"] = $row["UIN"];
            $_SESSION["User_Type"] = $row["User_Type"];
            $user_type = $row["User_Type"];

            // direct to correct homepage for user type
            if($row["Is_Deleted"] == FALSE){
                if($user_type !== "Admin" ){
                    header("Location: student/studentHome.php");
                }
                else{
                    header("Location: admin/adminHome.php");
                }
            }
            else{
                echo "User not found.";
            }
        }
      } else {
        echo "User not found.";
      }

}


// if correct, send to userpage
// else, give error



?>

Login: <br>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
Username: <input type="text" name="name"><br>
Password: <input type="text" name="password"><br>
<input type="submit">
</form>

or <a href="signup.php">proceed to Signup</a>
NOTE: Admin accounts can only be created by other admins.
</body>
</html> 

