<?php
// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $updates = [];
        foreach ($_POST as $key => $value) {
            if ($key != 'update' && $key != 'delete' && $key != 'insert' && $key != $primary_key) {
                if (!in_array($key, $bit_cols)) {
                    $updates[] = $conn->real_escape_string($key) . " = " . "'" . $conn->real_escape_string($value) . "'";
                }
                else {
                    $updates[] = $conn->real_escape_string($key) . " = " . $conn->real_escape_string($value);
                }
            }
        }
        $updates = implode(", ", $updates);
        $sql = "UPDATE {$table_name} SET {$updates} WHERE {$primary_key} = '{$_POST[$primary_key]}'";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $sql = "DELETE FROM {$table_name} WHERE {$primary_key} = '{$_POST[$primary_key]}'";
        $conn->query($sql);
    } elseif (isset($_POST['insert'])) {
        // Insert new row
        $columns = [];
        $values = [];

        foreach ($_POST as $key => $value) {
            if ($key != 'update' && $key != 'delete' && $key != 'insert' && $key != $primary_key) {
                $columns[] = $conn->real_escape_string($key);
                if (!in_array($key, $bit_cols)) {
                    $values[] = "'" . $conn->real_escape_string($value) . "'";
                }
                else {
                    $values[] = $conn->real_escape_string($value);
                }
            }
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", $values);

        $sql = "INSERT INTO {$table_name} ($columns) VALUES ($values)";
        $conn->query($sql);
    }
}
?>