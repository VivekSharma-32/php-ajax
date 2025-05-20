<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + AJAX CRUD</title>
    <link rel="stylesheet" href="./css/style.css">
    </style>
</head>

<body>
    <div class="header">
        <h2> PHP & AJAX CRUD</h2>


        <input type="text" placeholder="Search..." id="search" autocomplete="off" />
    </div>
    <div class="sub-header">
        <form id="formData">
            <input type="text" placeholder="Enter your name" id="name">
            <input type="submit" value="Submit" id="save-data">
        </form>
    </div>
    <div id="table-data">
    </div>

    <div id="error"></div>
    <div id="success"></div>

    <div id="modal">
        <div id="modal-form">
            <h2>Edit Form</h2>
            <table cellpadding="0" cellspacing="0 " width="100%">
            </table>
            <div id="close-btn">X</div>
        </div>
    </div>
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // load records
            function loadData(page) {
                $.ajax({
                    url: "ajax-load.php",
                    type: "POST",
                    data: { page_no: page },
                    success: function (data) {
                        $("#table-data").html(data)
                    }
                })
            }
            loadData();

            $(document).on('click', '#pagination a', function (e) {
                e.preventDefault()
                var page_id = $(this).attr('id');
                loadData(page_id);
            })

            // insert new records
            $("#save-data").on('click', function (e) {
                e.preventDefault();
                var name = $("#name").val();
                if (name === '') {
                    $("#error").html("All fields are required").slideDown();
                } else {
                    $.ajax({
                        url: 'insert.php',
                        type: "POST",
                        data: { name: name },
                        success: function (response) {
                            if (response == 1) {
                                loadData();
                                $("#formData")[0].reset(); // Clear input field
                                $("#success").html("Data inserted successfully.").slideDown();
                                setTimeout(function () {
                                    $("#success").slideUp();
                                }, 3000);
                            } else {
                                $("#error").html("Failed to insert data.").slideDown();
                                setTimeout(function () {
                                    $("#error").slideUp();
                                }, 3000);
                            }
                        },
                        error: function () {
                            $("#error").html("Server error occurred.").slideDown();
                            setTimeout(function () {
                                $("#error").slideUp();
                            }, 3000);
                        }
                    });
                }


            })

            // delete records
            $(document).on('click', '#delete-btn', function () {

                if (confirm("Are you sure you want to delete this record?")) {
                    var studentId = $(this).data('id');
                    var element = this;


                    $.ajax({
                        url: 'delete-ajax.php',
                        type: 'POST',
                        data: { id: studentId },
                        success: function (data) {
                            if (data == 1) {
                                $(element).closest('tr').fadeOut()

                            }
                            else {
                                $("#error").html("Can't delete a record.").slideDown();

                            }
                        }
                    })
                }

            })

            // Show Modal Box
            $(document).on('click', '#edit-btn', function () {
                $("#modal").show();

                var studentId = $(this).data('eid');

                $.ajax({
                    url: 'load-update-form.php',
                    type: "POST",
                    data: { id: studentId },
                    success: function (data) {
                        $("#modal-form table").html(data)
                    }

                })
            })

            // Hide modal box
            $('#close-btn').on('click', function () {
                $("#modal").hide()
            })

            //Update form
            $(document).on('click', '#edit-submit', function () {
                var studId = $("#edit-id").val();
                var name = $("#edit-name").val();

                $.ajax({
                    url: 'ajax-update-form.php',
                    type: "POST",
                    data: {
                        id: studId,
                        name: name
                    },
                    success: function (data) {
                        if (data == 1) {
                            loadData();
                            $("#modal").hide();
                            $("#success").html("Data updated successfully.").slideDown();
                            setTimeout(function () {
                                $("#success").slideUp();
                            }, 3000);
                        } else {
                            $("#error").html("Failed to update data.").slideDown();
                            setTimeout(function () {
                                $("#error").slideUp();
                            }, 3000);
                        }
                    }
                })
            })

            // Live Search

            $('#search').on('keyup', function () {
                var searchTerm = $(this).val();
                $.ajax({
                    url: "ajax-live-search.php",
                    type: "POST",
                    data: { search: searchTerm },
                    success: function (data) {
                        $("#table-data").html(data)
                    }
                })
            })

        })
    </script>
</body>

</html>