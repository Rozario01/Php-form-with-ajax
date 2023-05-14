<!DOCTYPE html>
<html>

<head>
    <title>MYFirst jquery and Ajax Project</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-4">

        <div class="row">
            <div class="col-md-6">
                <h2 style="text-decoration: underline;">Create new user record</h2>
                <form id="create_form" method="post">
                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone number:</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                    </div>
                    <button type="submit" class="btn btn-primary" name="create" id="save">Create</button>
                    <button type="reset" class="btn btn-secondary" name="reset">Reset</button>

                </form>
            </div>

            <div class="col-md-6">
                <h2 style="text-decoration: underline;">Update or delete user record</h2>
                <form id="update_form" method="post">
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone number:</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                    </div>
                    <button type="submit" class="btn btn-primary" name="update" id="edit">Update</button>
                    <button type="reset" class="btn btn-secondary" name="reset">Reset</button>

                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <button type='submit' class='btn btn-danger align-center' name='delete' id='deleteall' value='Delete'>
                        Delete All queries
                    </button>
                </div>
                <div style="margin-bottom: 20">
                    <p id="status" class=" text-center "></p>
                </div>
                <h2 class="text-center mb-5">User Records</h2>
                <div class="table-responsive">
                    <table id="user-table" class="table   table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script>
        function refreshTable() {
            $.ajax({
                url: "./Routes/get_users.php",
                dataType: "json",
                success: function(data) {
                    var html = "";
                    $.each(data, function(index, user) {
                        html += "<tr>";
                        html += "<td>" + user.id + "</td>";
                        html += "<td>" + user.username + "</td>";
                        html += "<td>" + user.email + "</td>";
                        html += "<td>" + user.phone_number + "</td>";
                        html += "<td>";
                        html += "<form method='post'>";
                        html += "<input type='hidden'  name='id' value='" + user.id + "'>";
                        html += "<input type='submit' class='btn btn-danger' name='delete' id='del' value='Delete'>";
                        html += "</form>";
                        html += "</td>";
                        html += "</tr>";
                    });
                    $("#user-table tbody").html(html);
                }
            });
        }


        // Inserting the datas into database 
        // with ajax and jQuery

        $(document).ready(function() {
            // Handle create form submission
            $("#save").click(function(event) {
                event.preventDefault();
                var formData = $("#create_form").serialize();

                $.ajax({
                    url: "./Routes/create.php",
                    type: "post",
                    data: formData,
                    success: function(response) {
                        $("#status").html(response);
                        refreshTable();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });


            // editng the datas using id 

            $(document).ready(function() {
                // Handle Update form submission
                $("#edit").click(function(event) {
                    event.preventDefault();
                    var formData = $("#update_form").serialize();

                    $.ajax({
                        url: "./Routes/edit.php",
                        type: "post",
                        data: formData,
                        success: function(response) {
                            $("#status").html(response);
                            refreshTable();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });

            });

            // this Deletes an data from database using the id //

            $(document).on("click", "#del", function(e) {
                e.preventDefault();
                // get it name id value //
                var id = $(this).closest("form").find("input[name='id']").val();
                $.ajax({
                    url: "./Routes/delete.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#status").html(response);
                        refreshTable();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
            //delete all queries
            $(document).on("click", "#deleteall", function(e) {
                e.preventDefault();
                // get table values//
                var prm = confirm("Do you want to deleteAll records")
                if (prm == true) {
                    var tabledata = $('user-table').serialize
                    $.ajax({
                        url: "./Routes/deleteall.php",
                        type: "POST",
                        data: tabledata,
                        success: function(response) {
                            $("#status").html(response);
                            refreshTable();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });




            // Refresh table every 2 seconds
            setInterval(refreshTable, 2000);
        })
    </script>
    </table>