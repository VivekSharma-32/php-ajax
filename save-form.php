<?php
$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");

$name = $_POST['fullname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$country = $_POST['country'];

$sql = "INSERT INTO `students`(`name`, `age`, `gender`, `country`) VALUES ('{$name}','$age','{$gender}','{$country}')";

if (mysqli_query($conn, $sql)) {
    echo "Hello {$name} your record is saved.";
} else {
    echo "Can't save your data";
}
?>