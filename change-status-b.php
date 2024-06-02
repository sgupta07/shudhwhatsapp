<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./inc/head.php";
    if (isset($_POST['submit'])) {
        $user_id = $_SESSION['User_ID'];
        $status = $_GET['status'];
        $uniqueid = $_GET['uniqueid'];
        $change_status = $_POST['change_status'];
   
        $query = "UPDATE `b_send_whatsapp` SET `status`='$change_status' WHERE `msg_id`='$uniqueid'";
        $update_status = mysqli_query($conn, $query);
        $query_msg = "UPDATE `b_send_msg_details` SET `status`='$change_status' WHERE `send_id`='$uniqueid'";
        mysqli_query($conn, $query_msg);
        if (!$update_status) {
            die('QUERY FAILD post' . mysqli_error($conn));
        } else {
            echo "<script>alert('Status Change successfully');window.location.href = './dashboard.php';";
            echo "</script>";
        }
    }
    ?>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-body">
                                    <div class="col-md-6">
                                        <h4><i class="fa fa-pencil"></i> &nbsp; Change Status</h4>
                                    </div>
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

                                        <form id="fileinfo" method="post" name="fileinfo" autocomplete="off" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Status</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <select name="change_status" class="form-control">
                                                            <option value="<?php echo $_GET['status'];?>"><?php echo $_GET['status'];?></option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Process">Process</option>
                                                            <option value="Failed">Failed</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                            <option value="Completed">Completed</option>
                                                        </select>
                                                        <!-- <input type="text" style="width: 100%;" placeholder="Enter company" name="company" value="<?php echo $_SESSION['company_name']; ?>"> -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="">
                                                        <button type="submit" name="submit" class="btn btn-success div_center"><i class="fa fa-floppy-o"></i> Change Status</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </section>

            <script>
                $("#admin").addClass('active');
            </script>

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
</body>

</html>