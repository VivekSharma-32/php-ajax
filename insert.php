<?php

$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");

$name = $_POST['name'];

$sql = "INSERT INTO students  (`name`) VALUES ('$name')";
if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}
?>