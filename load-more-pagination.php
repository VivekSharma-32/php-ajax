<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Ajax Load More Pagination</title>
    <link rel="stylesheet" href="css/style2.css"> <!-- Optional -->
</head>

<body>
    <div id="main">
        <div id="header">
            <h1>PHP & Ajax Load More Pagination</h1>
        </div>

        <div id="table-data">
            <table id="loadData" border="1" width="100%" cellspacing="0" cellpadding="10px">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
            </table>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            let currentPage = 1;

            function loadTable(page) {
                $.ajax({
                    url: "ajax-load-more-pagination.php",
                    type: "POST",
                    data: { page_no: page },
                    success: function (data) {
                        if (data) {
                            $("#pagination").remove();
                            $("#loadData").append(data);
                        } else {
                            $("#ajaxbtn").html("Finished");
                            $("#ajaxbtn").prop("disabled", true);
                        }
                    }
                });
            }

            // Load the first page initially
            loadTable(currentPage);

            // Event delegation for dynamic button
            $(document).on("click", "#ajaxbtn", function () {
                $(this).html("Loading...");
                let nextPage = $(this).data("page");
                loadTable(nextPage);
            });
        });
    </script>
</body>

</html>