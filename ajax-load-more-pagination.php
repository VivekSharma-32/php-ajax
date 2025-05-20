<?php
$conn = mysqli_connect("localhost", "root", "", "php_ajax_db") or die("Connection failed");

$limit = 5;
$page = isset($_POST['page_no']) ? (int) $_POST['page_no'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM students LIMIT {$offset}, {$limit}";
$query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

if (mysqli_num_rows($query) > 0) {
    $output = "<tbody>";

    while ($row = mysqli_fetch_assoc($query)) {
        $output .= "<tr>
                        <td align='center'>{$row["id"]}</td>
                        <td>{$row["name"]}</td>
                    </tr>";
    }

    $nextPage = $page + 1;

    $output .= "</tbody>
                <tbody id='pagination'>
                    <tr>
                        <td colspan='2'>
                            <button id='ajaxbtn' data-page='{$nextPage}'>Load More</button>
                        </td>
                    </tr>
                </tbody>";

    echo $output;
} else {
    echo "";
}

mysqli_close($conn);
?>