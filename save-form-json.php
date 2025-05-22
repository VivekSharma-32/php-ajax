<?php

if ($_POST['name'] != '' && $_POST['age'] != '') {
    if (file_exists('json/student_data')) {
        $current_data = file_get_contents("json/student_data.json");
        $arr_data = json_decode($current_data, true);
        $new_data = array(
            'name' => $_POST['name'],
            'age' => $_POST['age']
        );
        $arr_data[] = $new_data;
        $json_data = json_encode($arr_data, JSON_PRETTY_PRINT);

        if (file_put_contents("json/student_data.json", $json_data)) {
            echo "Saved data in json file";
        } else {
            echo "unable to save data in json file.";
        }
    } else {
        echo "JSON file doesn't exist";
    }

}
?>