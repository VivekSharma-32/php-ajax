<?php

$id = $_POST['id'];

$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");


$sql = "SELECT * from students where id =$id";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed");
$output = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
                    <td>Name</td>
                    <td>
                        <input type='text' id='edit-name' value='{$row["name"]}'>
                        <input type='text' hidden id='edit-id' value='{$row["id"]}'>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type='submit' id='edit-submit' value='Save'>
                    </td>
                </tr>";
    }
    mysqli_close($conn);
    echo $output;
} else {
    echo "<table border='1' cellspacing='0'><tr><td colspan=2><h2 style='padding:10px;'>Record not found</h2></td></tr></table>";
}
?>