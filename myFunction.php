<?php
function data_list($table)
{
    require('connection.php');
    $sql = "SELECT * FROM $table";
    $query = $conn->query($sql);

    while ($data = mysqli_fetch_assoc($query)) {
        $data_id = $data[$table . '_id'];
        $data_name = $data[$table . '_name'];
        echo "<option value='$data_id'>$data_name</option>";
    }
}
