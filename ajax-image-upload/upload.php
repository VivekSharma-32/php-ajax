<?php
if ($_FILES['file']['name'] != "") {
    $fileName = $_FILES['file']['name'];
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
    if (in_array($extension, $valid_extensions)) {
        $new_name = rand() . "." . $extension;
        $path = "images/" . $new_name;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            echo '<img src="' . $path . '"/> <br /><br />
            <button data-path="' . $path . '" id="delete_btn">Delete</button>';
        }
    } else {
        echo '<script>alert("Invalid File Format.")</script>';
    }
} else {
    echo '<script>alert("Please select a file")</script>';
}

?>