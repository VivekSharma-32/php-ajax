<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        .header {
            background-color: blueviolet;
            color: white;
        }

        .header h2 {
            font-size: 45px;
            text-align: center;
            padding: 25px;
        }

        .button-container {
            background-color: #4E71FF;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .button-container #load-btn {
            padding: 6px;
            width: 200px;
            font-size: 20px;
            font-weight: 500;
            background-color: white;
            border-radius: 8px;
            cursor: pointer;
        }

        table {
            width: 90%;
            margin: auto;
            text-align: center;
        }

        table tr th,
        td {
            padding: 10px;
            font-size: 18px;
            font-weight: 600;
        }

        table tr th {
            background-color: #4E71FF;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #F2F2F2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2> PHP with AJAX</h2>
        <div class="button-container">
            <input type="button" value="Load More" id="load-btn">
        </div>
    </div>
    <table cellpadding="10px" cellspacing="0">
        <tr>
            <td id="table-data">
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#load-btn").on('click', function (e) {
                $.ajax({
                    url: "ajax-load.php",
                    type: "POST",
                    success: function (data) {
                        $("#table-data").html(data)
                    }
                })
            })
        })
    </script>
</body>

</html>