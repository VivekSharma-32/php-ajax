<?php

$conn = mysqli_connect('localhost', 'root', '', 'php_ajax_db') or die("Connection failed");

$limit_per_page = 3;

$page = "";
if (isset($_POST['page_no'])) {
    $page = $_POST['page_no'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $limit_per_page;



$sql = "SELECT * from students limit {$offset}, {$limit_per_page} ";
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
                <td width='100'>{$row['id']}</td>
                <td width='200'>{$row['name']}</td>
                <td>
                <div class='btn-cont'>
                    <button id='edit-btn' data-eid='{$row['id']}'>Edit</button>
                    <button id='delete-btn' data-id='{$row['id']}'>Delete</button>
                </div>
                </td>
            </tr>
        ";
    }
    $output .= '</table>';

    $sql_total = "SELECT * from students";
    $records = mysqli_query($conn, $sql_total) or die("SQL Query Failed");

    $total_records = mysqli_num_rows($records);
    $total_pages = ceil($total_records / $limit_per_page);

    $output .= '<div id="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $page) ? 'active' : '';
        $output .= "<a href='#' class='{$active_class}' id='{$i}'>{$i}</a>";
    }

    $output .= '</div>';

    echo $output;
    mysqli_close($conn);
} else {
    echo "<table border='1' cellspacing='0'><tr><td colspan=2><h2 style='padding:10px;'>Record not found</h2></td></tr></table>";
}
?>