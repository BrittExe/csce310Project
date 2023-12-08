<!-- Code by Ryan Kutz -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Progress Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<?php require '../databaseLoad.php'; ?>
<?php require '../databaseFunctions.php'; ?>

<?php
function console_log($output, $with_script_tags = true) {
$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
');';
if ($with_script_tags) {
$js_code = '<script>' . $js_code . '</script>';
}
echo $js_code;
}

$uin = $_GET["uin"];
$query_str = "SELECT * FROM Class_Enrollment WHERE UIN = {$uin}";
$primary_key = "CE_Num";

function dropdownFromSql($conn, $query_str, $value_col, $label_col, $selected_value) {
    $result = $conn->query($query_str);
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

// Function to get table information
function buildEditableTable($conn, $query_str, $dropdown_cols=array(), $readonly_cols=array(), $uin=-1) {
    $result = $conn->query($query_str);
    $columns = [];

    if ($result->num_rows >= 0) {
        // Get column names
        $columns = $result->fetch_fields();
        echo '<table class="table table-bordered table-striped table-hover w-auto"><tr>';
        
        // Display column names
        foreach ($columns as $column) {
            echo '<th>' . $column->name . '</th>';
        }
        echo '<th></th>';
        echo '</tr>';

        // Display data rows
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<form method="POST">';
            foreach ($row as $key => $value) {
                if (array_key_exists($key, $dropdown_cols)) {
                    echo '<td>';
                    echo '<select class="form-select" name="' . $key . '">';
                    dropdownFromSql($conn, $dropdown_cols[$key]["query_str"], $dropdown_cols[$key]["value_col"], $dropdown_cols[$key]["label_col"], $value);
                    echo '</select>';
                    echo '</td>';
                }
                else if (in_array($key, $readonly_cols)) {
                    echo '<td><input readonly class="form-control" type="text" name="' . $key . '" value="' . $value . '"></td>';
                }
                else {
                    echo '<td><input class="form-control" type="text" name="' . $key . '" value="' . $value . '"></td>';
                }
            }
            echo '<td><input class="btn btn-primary" type="submit" name="update" value="Update">';
            echo '<input type="submit" class="btn btn-danger" name="delete" value="Delete"></td>';
            echo '</form>';
            echo '</tr>';
        }

        // Add an empty row for insertion
        echo '<tr>';
        echo '<form method="POST">';
        foreach ($columns as $column) {
            $key = $column->name;
            if (array_key_exists($key, $dropdown_cols)) {
                echo '<td>';
                echo '<select class="form-select" name="' . $key . '">';
                dropdownFromSql($conn, $dropdown_cols[$key]["query_str"], $dropdown_cols[$key]["value_col"], $dropdown_cols[$key]["label_col"], null);
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
                echo '<td><input class="form-control" type="text" name="' . $key . '"></td>';
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

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    console_log($_POST);
    if (isset($_POST['update'])) {
        $updates = [];
        foreach ($_POST as $key => $value) {
            if ($key != 'update' && $key != 'delete' && $key != 'insert' && $key != $primary_key) {
                $updates[] = $conn->real_escape_string($key) . " = " . "'" . $conn->real_escape_string($value) . "'";
            }
        }
        $updates = implode(", ", $updates);
        $sql = "UPDATE Class_Enrollment SET {$updates} WHERE {$primary_key} = '{$_POST[$primary_key]}'";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $sql = "DELETE FROM Class_Enrollment WHERE {$primary_key} = '{$_POST[$primary_key]}'";
        $conn->query($sql);
    } elseif (isset($_POST['insert'])) {
        // Insert new row
        $columns = [];
        $values = [];

        foreach ($_POST as $key => $value) {
            if ($key != 'update' && $key != 'delete' && $key != 'insert' && $key != $primary_key) {
                $columns[] = $conn->real_escape_string($key);
                $values[] = "'" . $conn->real_escape_string($value) . "'";
            }
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", $values);

        $sql = "INSERT INTO Class_Enrollment ($columns) VALUES ($values)";
        $conn->query($sql);
    }
}
?>

<div class="container-fluid">
  <div class="row mt-3">
    <h4>Class Enrollments for UIN = <?= $uin ?></h4>
  </div>
  <div class="table-responsive mt-3">
    <?php
      buildEditableTable($conn, $query_str, array("Class_ID" => array("query_str" => "SELECT Class_ID, Name FROM Classes", "value_col" => "Class_ID", "label_col" => "Name")), array("CE_Num", "UIN"), $uin);
    ?>
  </div>
</div>



</body>
</html>