<?php

$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");

$id = $_POST['id'];
$name = $_POST['name'];

$sql = "UPDATE students set name='{$name}'  where `id`= $id";
if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}
?>