<?php
// Code by Ryan Kutz

// Function to print to the browser console for debugging purposes
// Source: https://stackify.com/how-to-log-to-console-in-php/
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
    ');';
    if ($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}


// Function to fill a dropdown and set the proper selected value
// See params below ($dropdown_cols)
function dropdownFromSql($conn, $query_str, $value_col, $label_col, $selected_value=null, $default=null) {
    $result = $conn->query($query_str);
    if (!is_null($default)) {
        echo '<option selected disabled>' . $default . '</option>';
    }
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row[$value_col] == $selected_value) {
                echo '<option selected value="' . $row[$value_col] . '">' . $row[$label_col] . '</option>';
            }
            else {
                echo '<option value="' . $row[$value_col] . '">' . $row[$label_col] . '</option>';
            }
        }
    }
}

// Function to create an editable table with Insert/Update/Delete functionality
// $conn: SQL connection
// $query_str: SELECT statement to get the table data
// $dropdown_cols: array with key = column name 
//                 value = array containing the connection, query string for the dropdown's data, column names for the value and label, the value to set as selected (if any) and the label for the default value (if any)
// $uin: value to fill the UIN column for an insert (if any)
function buildEditableTable($conn, $query_str, $dropdown_cols=array(), $readonly_cols=array(), $uin=-1) {
    $result = $conn->query($query_str);
    $columns = [];

    if ($result->num_rows >= 0) {
        // Get column names
        $columns = $result->fetch_fields();
        echo '<table class="table table-bordered table-striped table-hover w-auto"><tr>';
        
        // Display column names
        foreach ($columns as $column) {
            console_log($column);
            echo '<th>' . $column->name . '</th>';
        }
        // Empty header for buttons
        echo '<th></th>';
        echo '</tr>';

        // Display data rows
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<form method="post">';
            foreach ($row as $key => $value) {
                // Add dropdowns
                if (array_key_exists($key, $dropdown_cols)) {
                    echo '<td>';
                    echo '<select class="form-select form-select w-auto" name="' . $key . '">';
                    dropdownFromSql($conn, $dropdown_cols[$key]["query_str"], $dropdown_cols[$key]["value_col"], $dropdown_cols[$key]["label_col"], $value, null);
                    echo '</select>';
                    echo '</td>';
                }
                // Make field read-only
                else if (in_array($key, $readonly_cols)) {
                    echo '<td><input readonly class="form-control form-control" type="text" name="' . $key . '" value="' . $value . '"></td>';
                }
                // Make normal field
                else {
                    echo '<td><input class="form-control form-control" type="text" name="' . $key . '" value="' . $value . '" required></td>';
                }
            }
            echo '<td><input class="btn btn-primary" type="submit" name="update" value="Update">';
            echo '<input type="submit" class="btn btn-danger" name="delete" value="Delete"></td>';
            echo '</form>';
            echo '</tr>';
        }

        // Add an empty row for insertion
        echo '<tr>';
        echo '<form method="post">';
        foreach ($columns as $column) {
            $key = $column->name;
            if (array_key_exists($key, $dropdown_cols)) {
                echo '<td>';
                echo '<select class="form-select" name="' . $key . '">';
                dropdownFromSql($conn, $dropdown_cols[$key]["query_str"], $dropdown_cols[$key]["value_col"], $dropdown_cols[$key]["label_col"], null, null);
                echo '</select>';
                echo '</td>';
            }
            else if (in_array($key, $readonly_cols)) {
                if ($key == "UIN") {
                    echo '<td><input readonly class="form-control" type="text" name="' . $key . '" value="' . $uin . '"></td>';
                }
                else {
                    echo '<td><input readonly class="form-control" type="text" name="' . $key . '"></td>';
                }
            }
            else {
                echo '<td><input class="form-control" type="text" name="' . $key . '" required></td>';
            }
        }
        echo '<td><input class="btn btn-success" type="submit" name="insert" value="Insert"></td>';
        echo '</form>';
        echo '</tr>';

        echo '</table>';
    } else {
        echo "No results found";
    }
}

?>