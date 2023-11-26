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
        
    }


// given table and the primary key name and a value, displays it
function displayAttributes($table,  $primaryKeyAttribute, $primaryKeyValue) {
    global $conn;

    // get attribute names
    $sql = "SHOW COLUMNS FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Attributes for Table '$table' and $primaryKeyAttribute '$primaryKeyValue':</h3>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $columnName = $row['Field'];
            $safeColumnName = "`$columnName`";
            // Retrieve the value for each attribute that is associated with the PK
            $valueSql = "SELECT $safeColumnName FROM $table WHERE $primaryKeyAttribute = '$primaryKeyValue'";
            $valueResult = $conn->query($valueSql);
            if ($valueResult->num_rows > 0) {
                $valueRow = $valueResult->fetch_assoc();
                $value = $valueRow[$columnName];
                echo "<li><strong>$columnName:</strong> " . htmlspecialchars($value) . "</li>";
            } else {
                echo "<li><strong>$columnName:</strong> Not found</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "No columns found for table '$table'";
    }
}
displayAttributes('Total_College_Student', 'UIN', $UIN);

?>


    // make form to fill out items

    // check items
?>


</body>
</html>