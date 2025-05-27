<?php
$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");
if (isset($_POST['date1']) && isset($_POST['date2'])) {
    $min = $_POST['date1'];
    $max = $_POST['date2'];

    $sql = "SELECT * from students where dob between {$min} and {$max}";
} else {
    $min = '';
    $max = '';
    $sql = "SELECT * from students order by id asc";
}

$result = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dob = date('d M,Y', strtotime($row['dob']));
        $output .= "<tr>
            <td align='center'>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['age']}</td>
            <td>{$row['city']}</td>
            <td>{$dob}</td>
        </tr>";
    }
    echo $output;
} else {
    echo "<h2>No record found</h2>";
    exit;
}
?>