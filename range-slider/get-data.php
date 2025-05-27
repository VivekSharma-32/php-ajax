<?php
$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");
if (isset($_POST['range1']) && isset($_POST['range2'])) {
    $min = $_POST['range1'];
    $max = $_POST['range2'];

    $sql = "SELECT * from students where age between {$min} and {$max}";
} else {
    $min = '';
    $max = '';
    $sql = "SELECT * from students order by id asc";
}

$result = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['age']}</td>
            <td>{$row['city']}</td>
        </tr>";
    }
    echo $output;
} else {
    echo "<h2>No record found</h2>";
    exit;
}
?>