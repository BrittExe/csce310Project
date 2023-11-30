<!-- code by Brittain Schiller -->

<?php
// given table and the primary key name and a value, displays it
function displayAttributes($table,  $primaryKeyAttribute, $primaryKeyValue) {
    global $conn;

    // get attribute names
    $sql = "SHOW COLUMNS FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
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

?>


<?php
// given table and the primary key name and a value, makes a form that can be used to take in inputs for those values
// ignoreAttributes is an array with the names of all attributes that should not be allowed to be updated
//  - example: ["UIN"]
// buttonName is the internal name of the button used for submission
function updateAttributesTable($table,  $primaryKeyAttribute, $primaryKeyValue, $ignoreAttributes=[], $buttonName='submit') {
    global $conn;

    // get attribute names
    $sql = "SHOW COLUMNS FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        // make a form
        echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>";
        echo "<input type='hidden' name='$primaryKeyAttribute' value='$primaryKeyValue'>";
        echo "<h3>Edit Attributes for $primaryKeyAttribute = $primaryKeyValue:</h3>";
        while ($row = $result->fetch_assoc()) {
            $columnName = $row['Field'];
            $safeColumnName = "`$columnName`";

            // Retrieve the value for each attribute that is associated with the PK
            $valueSql = "SELECT $safeColumnName FROM $table WHERE $primaryKeyAttribute = '$primaryKeyValue'";
            $valueResult = $conn->query($valueSql);
            if ($valueResult->num_rows > 0) {
                $valueRow = $valueResult->fetch_assoc();
                $value = $valueRow[$columnName];
            }
            else{
                $value = '';
            }

            # exclude attributes in ignoreAttributes
            if (!in_array($columnName, $ignoreAttributes)){
                echo "<label for='$columnName'>$columnName:</label>";
                echo "<input type='text' name='$columnName' id='$columnName' value='$value'><br>";
            }
        }
        echo "<input type='submit' name='$buttonName' value='Submit'>";
        echo "<input type='hidden' id='backupPK' name='backupPK' value='$primaryKeyValue' />";
        echo "<input type='hidden' id='backupTableName' name='backupTableName' value='$table' />";
        echo "</form>";
    }
     else {
        echo "No columns found for table '$table'";
    }
}

?>


<?php
// given table, creates a form to create a new entity for that form. 
// ignoreAttributes is an array with the names of attruibutes that should not be displayed for input. 
// requireAttruibutes are attributes that are required to be filled before the entity can be created.
function createEntityTable($table, $ignoreAttributes, $requireAttributes) {
    global $conn;

    // get attribute names
    $sql = "SHOW COLUMNS FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        // make a form
        echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>";
        while ($row = $result->fetch_assoc()) {
            $columnName = $row['Field'];
            $safeColumnName = "`$columnName`";
            # exclude attributes in ignoreAttributes
            if (!in_array($columnName, $ignoreAttributes)){
                echo "<label for='$columnName'>$columnName:</label>";
                # if required, make required and add a *
                if(in_array($columnName, $requireAttributes)){
                    echo "<input type='text' name='$columnName' id='$columnName' required>";
                    echo " <sup>*</sup><br>";
                }
                else{
                    echo "<input type='text' name='$columnName' id='$columnName'><br>";
                }
            }
        }
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
    }
     else {
        echo "No columns found for table '$table'";
    }
}

?>

<?php

function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<?php
    // creates a drop-down list as a form that enables selection
    // from tables specified in $tables
    function table_select($tables=""){
        global $conn;
        // get list of tables
        $tableSQL = "SHOW FULL TABLES WHERE Table_Type != 'VIEW'";
        $tableResult = $conn->query($tableSQL);
        
        // start form
        echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>";

        // start select
        echo 'Table: <select name="table" id="table">';

        // for each table
        while($row = $tableResult->fetch_assoc()) {
            $tableName = $row['Tables_in_Cybersecurity'];
            // add that table to select if in list
            if ( in_array($tableName, $tables)){
                echo "<option value='$tableName'>$tableName</option>";
            }

        }

        // end select
        echo '</select>';


        // make a submit button
        echo"<br><button type='submit' name='submit'>Select</button>";


        // end form
        echo "</form>";
    }


?>


<?php
    // creates a drop-down list as a form that enables selection
    // from every table in the database
    // gives options to delete these entries
    function table_select_delete(){
        global $conn;
        // get list of tables
        $tableSQL = "SHOW FULL TABLES WHERE Table_Type != 'VIEW'";
        $tableResult = $conn->query($tableSQL);
        
        // start form
        echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>";

        // start select
        echo 'Table: <select name="table" id="table">';

        // for each table
        while($row = $tableResult->fetch_assoc()) {
            $tableName = $row['Tables_in_Cybersecurity'];
            // add that table to select
            echo "<option value='$tableName'>$tableName</option>";

        }

        // end select
        echo '</select>';


        // add PK text box
        echo "<br>Primary Key: <input type='text' id='PK' name='PK' value=''>";

        // temp and perma delete buttons
        echo"<br><button type='submit'>Select</button>";


        // end form
        echo "</form>";
    }


?>


<!-- End of Brittain Schiller code -->