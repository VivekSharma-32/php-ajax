<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Using PHP & Ajax</title>
    <style>
        body {
            font-family: arial;
            background: #b2bec3;
            padding: 0;
            margin: 0;
        }

        .center {
            text-align: center;
        }

        #main {
            width: 750px;
            margin: 0 auto;
            background: white;
        }

        #header {
            background: darkslateblue;
            color: #fff;
            height: 130px;
        }

        h1 {
            line-height: 51px;
            font-size: 38px;
            text-align: center;
            margin: 0px;
            padding-top: 17px;
        }

        #content {
            min-height: 300px;
            padding: 50px;
        }

        label {
            color: crimson;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="file"] {
            font-size: 20px;
        }

        .help-block {
            color: dodgerblue;
            font-size: 15px;
            display: block;
            margin: 10px 0 20px;
        }

        #upload_btn,
        #delete_btn {
            background: darkslateblue;
            border: 0;
            outline: 0;
            padding: 5px 10px;
            color: #fff;
            font-size: 17px;
            border-radius: 3px;
            cursor: pointer;
        }

        #delete_btn {
            background: crimson;
            margin-top: 10px;
        }

        #preview {
            border: 1px solid darkslateblue;
            padding: 10px;
            display: none;
        }

        #preview img {
            width: 100%;
            height: auto;
        }

        #preview h3 {
            background: mediumseagreen;
            color: #fff;
            margin: 0 0 20px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div id="main">
        <div id="header">
            <h1>Upload & Remove Files<br> Using PHP & jQuery Ajax</h1>
        </div>
        <div id="content">
            <form id="submit_form">
                <div class="form-group">
                    <label>Select Image</label>
                    <input type="file" name="file" id="upload_file" />
                    <span class="help-block">Allowed File Type - jpg, jpeg, png, gif</span>
                </div>
                <input type="submit" name="upload_button" id="upload_btn" value="Upload" />
            </form>
            <br />
            <div id="preview">
                <h3>Image Preview</h3>
                <div id="image_preview"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#submit_form").on("submit", function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "upload.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $("#preview").show();
                        $("#image_preview").html(data);
                        $("#upload_file").val('');
                    }
                })
            });

        });

        $(document).on("click", "#delete_btn", function () {
            if (confirm("Are you sure you want to delete this image?")) {
                var path = $("#delete_btn").data("path");
                $.ajax({
                    url: "delete.php",
                    type: "POST",
                    data: { path: path },
                    success: function (data) {
                        if (data != "") {
                            $("#preview").hide();
                            $("#image_preview").html('');
                        }
                    }
                })
            }
        })
    </script>
</body>

</html>