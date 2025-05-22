<?php

$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");

$sql = "SELECT * from students";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed");
$output = mysqli_fetch_all($result, MYSQLI_ASSOC);

$json_data = json_encode($output, JSON_PRETTY_PRINT);
$file_name = "my-" . date("d-m-Y") . time() . ".json";
if (file_put_contents("json/{$file_name}", $json_data)) {
    echo $file_name . " file created";
} else {
    echo "Can't insert into json file";
}
?>