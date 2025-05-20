<?php
$search_value = $_POST['search'];

$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");

$sql = "SELECT * from students where name like '%{$search_value}%'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed");
$output = "";
if (mysqli_num_rows($result) > 0) {
    $output .= "<table class='show-tbl' border='1' cellspacing='0' cellpadding='10px'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th width=100>Action</th>
        </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>
                <div class='btn-cont'>
                    <button id='edit-btn' data-eid='{$row['id']}'>Edit</button>
                    <button id='delete-btn' data-id='{$row['id']}'>Delete</button>
                </div>
                    
                </td>
            </tr>
        ";
    }
    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
} else {
    echo "<table border='1' cellspacing='0'><tr><td colspan='3'><h2 style='padding:10px;'>Record not found</h2></td></tr></table>";
}

?>