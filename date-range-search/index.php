<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP & Ajax</title>
    <!-- jquery ui css -->
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <!-- style.css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="main">
        <div id="header">
            <h1>Search in Date Range <br>using PHP & Ajax</h1>
        </div>
        <div id="date-wrap">
            <label for="from">From</label>
            <input type="text" id="from" autocomplete="off">
            <label for="to">to</label>
            <input type="text" id="to" autocomplete="off">
        </div>
        <div id="content">
            <table id="table-data" border="0" width="100%" cellpadding="10px">
                <thead>
                    <th width="50px">Id</th>
                    <th>Name</th>
                    <th width="90px">Age</th>
                    <th width="130px">City</th>
                    <th width="130px">DOB</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <!-- jquery -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <!-- jquery ui -->
    <script src="js/jquery-ui-1.12.1.min.js"></script>
    <script>
        $(function () {
            var minD;
            var maxD;
            var dateFormat = "mm/dd/yy",
                from = $("#from") // Date1
                    .datepicker({
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1,
                        yearRange: "1990:2005"
                    })
                    .on("change", function () {
                        to.datepicker("option", "minDate", getDate(this));
                        minD = $(this).val();
                        if (minD !== '' && maxD !== '') {
                            loadTable(minD, maxD);
                        }
                    }),
                to = $("#to").datepicker({ // Date2
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1,
                    yearRange: "1025:2030"
                })
                    .on("change", function () {
                        from.datepicker("option", "maxDate", getDate(this));
                        maxD = $(this).val();
                        if (minD !== '' && maxD !== '') {
                            loadTable(minD, maxD);
                        }
                    });

            // change date format
            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }

            // // load table
            function loadTable(date1, date2) {
                $.ajax({
                    url: "get-data.php",
                    type: "POST",
                    data: { date1: date1, date2: date2 },
                    success: function (response) {
                        $("#table-data tbody").html(response);
                    }
                });
            }

            loadTable(minD, maxD);
        });
    </script>

</body>

</html>