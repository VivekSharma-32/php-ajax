<?php
$json_string = 'data.json';
$jsonData = file_get_contents($json_string);
$arr = json_decode($jsonData, true);

// echo "<pre>";
// print_r($arr);
echo '<table border=1 cellpadding=10 cellspacing=0>';
foreach ($arr as list("id" => $id, "title" => $title)) {
    echo "<tr>
        <td>{$id}</td>
        <td>{$title}</td>
    </tr>";
}
echo '</table>';
?>