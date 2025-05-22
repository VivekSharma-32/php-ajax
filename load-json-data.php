<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Load JSON Data</h1>

    <div id="load-data"></div>
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            // $.ajax({
            //     url: "data.json",
            //     type: "GET",
            //     success: function (data) {
            //         console.log(data);
            //         $.each(data, function (key, val) {
            //             $("#load-data").append(val.id + " " + val.title + "<br/>");

            //         })
            //         // $("#load-data").append(data.id + "<br/> " + data.title + "<br/> " + data.body)

            //     }
            // })

            // function to load or get the json data
            $.getJSON(
                "fetch-json.json",
                function (data) {
                    console.log(data);
                    $.each(data, function (key, val) {
                        $("#load-data").append(val.id + " " + val.title + "<br/>");

                    })
                }
            )
        })
    </script>
</body>

</html>