<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./inc/head.php"; ?>
</head>

<body class="skin-green sidebar-mini" style="height: auto;">
    <div class="wrapper" style="height: auto;">

        <section id="container">
            <?php include "./inc/header.php"; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php
            if ($_SESSION['user_type'] == 1) {
                include "./inc/admin-menu.php";
            } else if ($_SESSION['user_type'] == 2) {
                include "./inc/sub-admin-menu.php";
            } else if ($_SESSION['user_type'] == 3) {
                include "./inc/menu.php";
            } else {
                include "./inc/user-menu.php";
            }
            ?>

            <section id="main-content">
                <div class="loader" style="display:none;"></div>
                <div class="content-wrapper" style="min-height: 851px; padding: 15px;">
                    <section class="content">
                        <div class="box box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4><i class="fa fa-pencil"></i> &nbsp; Manage User</h4>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:history.back()" class="btn btn-primary pull-right"><i class="fa fa-close"></i> cancel</a>
                                    <a href="user.php?action=add" style="margin-right:5px;" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New User</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body ">
                                        <div class="box-body table-responsive">
                                            <table id="example1" class="table table-bordered table-striped ">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Fullname</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Contact</th>
                                                        <th>Credit WN</th>
                                                        <th>Credit WI</th>
                                                        <th>Credit WB</th>
                                                        <th>Created By</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($_GET['uniqueid']) && $_GET['action'] == 'delete') {

                                                        $id = $_GET['uniqueid'];

                                                        $query = "delete from `user_details` WHERE `id`='$id'";
                                                        if ($conn->query($query) === TRUE) {
                                                            //                 $last_id = $conn->insert_id; window.location.href = 'user_list.php';
                                                            // echo "<script>alert ('Record Delete Successfully');</script>";
                                                        } else {
                                                            echo "Error: " . $query . "<br>" . $conn->error;
                                                        }
                                                    }

                                                    $query = "SELECT user_details.*,ud.user_name as username FROM `user_details` left join user_details as ud on ud.id=user_details.creates_by where user_details.user_type ='4' order by user_details.id desc";
                                                    $select_data = mysqli_query($conn, $query);
                                                    $count = 0;
                                                    while ($row = mysqli_fetch_array($select_data)) {
                                                        $count++;
                                                        $status = $row['status'];
                                                        $status_msg = '';
                                                        $status_color = '';
                                                        if ($status == 1) {
                                                            $status_msg = 'Active';
                                                            $status_color = 'badge-outline-success';
                                                        } else {
                                                            $status_msg = 'Inactive';
                                                            $status_color = 'badge-outline-danger';
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $count; ?></td>
                                                            <td><?php echo $row['full_name']; ?></td>
                                                            <td><?php echo $row['full_name']; ?></td>
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td><?php echo $row['mobile']; ?></td>
                                                            <td><?php echo $row['wn']; ?></td>
                                                            <td><?php echo $row['wi']; ?></td>
                                                            <td><?php echo $row['wb']; ?></td>
                                                            <td><?php echo $row['username']; ?></td>
                                                            <td><?php echo $status_msg; ?></td>
                                                            <td class="clientList">
                                                                <a data-toggle="tooltip" title="Edit" href="user.php?action=edit&uniqueid=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                                <a data-toggle="tooltip" title="Delete" href="admin-user.php?action=delete&uniqueid=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                                <a data-toggle="tooltip" title="Credit Update" href="admin-user.php?action=credit&uniqueid=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="fa fa-comment"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>

            <div class="modal fade" id="IssueReport" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <form accept="./issue.php" method="POST">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Report Issue</h4>
                            </div>
                            <div class="modal-body">
                                <label>Enter Your Issue Here</label>
                                <textarea name="problem" style="    height: 100px;" required class="form-control"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="ReportIssue" class="btn btn-info">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
            <script>
                $.widget.bridge('uibutton', $.ui.button);
            </script>
            <!-- Bootstrap 3.3.6 -->
            <script src="assets/bootstrap/js/bootstrap.min.js"></script>

            <!-- AdminLTE App -->
            <script src="assets/dist/js/app.min.js"></script>

            <!-- Date Picker -->
            <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
            <script src="assets/plugins/select2/select2.js"></script>

            <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
            <script type="text/javascript">
                function Notification(title, msg, type) {
                    test(title, msg, type, true, true);
                }

                $(".flash-msg").fadeTo(2000, 500).slideUp(500, function() {
                    $(".flash-msg").slideUp(500);
                });
                $('.modal').on('hidden.bs.modal', function(e) {
                    $(this)
                        .find("input,textarea,select")
                        .val('')
                        .end()
                        .find("input[type=checkbox], input[type=radio]")
                        .prop("checked", "")
                        .end();
                });
            </script>

            <!-- jvectormap -->

            <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

            <!-- SlimScroll 1.3.0 -->
            <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

            <!-- AdminLTE for demo purposes -->
            <script src="assets/dist/js/demo.js"></script>

            <script src="assets/plugins/notify/notify.min.js"></script>
            <script src="assets/dist/js/toastr.min.js"></script>
            <script src="assets/dist/js/toasterJS.js"></script>
            <script src="assets/dist/js/sweetalert.min.js"></script>

            <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

            <script src="assets/plugins/daterangepicker/moment.min.js"></script>
            <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>

            <script>
                $(function() {
                    $("#example1").DataTable();
                    var daterangepicker_eaf5b045 = {
                        "timePicker": true,
                        "timePickerIncrement": 1,
                        "locale": {
                            "format": "YYYY-MM-DD hh:mm A",
                            "separator": " TO "
                        },
                        "startDate": "2019-06-04 12:00 AM",
                        "endDate": "2019-07-01 12:00 AM",
                        "autoUpdateInput": false,
                        "ranges": {
                            "Today": [moment().startOf('day'), moment()],
                            "Yesterday": [moment().startOf('day').subtract(1, 'days'), moment().endOf('day').subtract(1, 'days')],
                            "Last 7 Days": [moment().startOf('day').subtract(6, 'days'), moment()],
                            "Last 30 Days": [moment().startOf('day').subtract(29, 'days'), moment()],
                            "This Month": [moment().startOf('month'), moment().endOf('month')],
                            "Last Month": [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        }
                    };
                    $("#w0-container").daterangepicker(daterangepicker_eaf5b045, function(start, end, label) {
                        var val = start.format('YYYY-MM-DD hh:mm A') + ' TO ' + end.format('YYYY-MM-DD hh:mm A');
                        $("#w0-container").find('.range-value').html(val);
                        $("#w0").val(val);
                        $("#w0").trigger('change');
                    });
                });
            </script>
            <script>
                $(function() {
                    $('#tblRep').DataTable();
                    $('#tblCamp').DataTable();
                    $("#manage_contact").DataTable({
                        dom: 'Bfrtip',
                        /*buttons: [
                         'copyHtml5',
                         'excelHtml5',
                         'csvHtml5',
                         'pdfHtml5'
                         ]*/
                        buttons: {
                            buttons: [{
                                    extend: 'excelHtml5',
                                    className: 'btn btn-success'
                                },
                                {
                                    extend: 'csvHtml5',
                                    className: 'btn btn-success'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    className: 'btn btn-success'
                                }
                            ]
                        }
                    });

                    $("#manage_grp").DataTable({
                        dom: 'Bfrtip',
                        /*buttons: [
                         'copyHtml5',
                         'excelHtml5',
                         'csvHtml5',
                         'pdfHtml5'
                         ]*/
                        buttons: {
                            buttons: [{
                                    extend: 'excelHtml5',
                                    className: 'btn btn-success'
                                },
                                {
                                    extend: 'csvHtml5',
                                    className: 'btn btn-success'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    className: 'btn btn-success'
                                }
                            ]
                        }
                    });

                });
            </script>
            <script>
                $('#credit_type').on('change', function() {
                    var type = $(this).val();
                    ChangeCreditType(type);
                });

                function ChangeCreditType(type) {
                    if (type) {
                        if (type == 'remove') {
                            $('.make_hidden').hide();
                            $('#creditsubmit').attr('name', 'removecredit')
                        } else if (type == 'add') {
                            $('.make_hidden').show();
                            $('#creditsubmit').attr('name', 'updatecred')
                        } else {
                            $('.make_hidden').show();
                            $('#creditsubmit').attr('name', 'creditsubmit')
                        }

                    }
                }
            </script>
            <script src="assets/js/password_rules.js"></script>
            <script>
                $("#m_client").addClass('active');
                $("#user").addClass('active');
            </script>
</body>

</html>