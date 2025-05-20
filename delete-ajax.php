<?php

$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");

$id = $_POST['id'];

$sql = "DELETE FROM students  where `id`= $id";
if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}
?>