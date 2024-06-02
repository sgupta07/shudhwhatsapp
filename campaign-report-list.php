<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./inc/head.php"; ?></head>

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
                                    <div class="col-md-4">
                                        <h4><i class="fa fa-list"></i> &nbsp; Campaign Reports </h4>
                                    </div>
                                    <div class="col-md-8">
                                        <form action="exportreport.php" class="pull-right new_d_show" method="post">
                                            <input type="date" name="startdate1">
                                            <input type="date" name="enddate1">
                                            <button type="submit" class="btn btn-success" value="Download Excel"><i class="fa fa-download"></i> Download
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box">

                            <!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>UniqueID</th>
                                            <th>Numbers</th>
                                            <th>Create By</th>
                                            <th>Create At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT sw.*,ud.user_name as user_name FROM `send_whatsapp` AS sw LEFT JOIN user_details  AS ud ON ud.id=sw.userID where sw.userID='" . $_SESSION['User_ID'] . "' order by sw.msg_id DESC";
                                        $select_data = mysqli_query($conn, $query);
                                        $count = 0;
                                        while ($row = mysqli_fetch_array($select_data)) {
                                            $count++;
                                        ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['msg_id']; ?></td>

                                                <td><?php echo $row['numbarCount']; ?></td>
                                                <td><?php echo $row['user_name']; ?>
                                                </td>
                                                <td><?php echo $row['send_delivery_dateTime']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td class="NewCReport">
                                                    <a data-toggle="tooltip" title="View More" href="campaign-report.php?action=view&uniqueid=<?php echo $row['msg_id']; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                                    <a data-toggle="tooltip" title="Report Download" href="exportcourse.php?uniqueid=<?php echo $row['msg_id']; ?>&username=<?php echo $_SESSION['user_name']; ?>" class="btn btn-success"><i class="fa fa-download"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box -->
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
                        $("#c_report").addClass('active');
                    </script>
                    <script>
                        if ($('.timer-field').length != 0) {
                            var x = setInterval(function() {
                                $('.timer-field').each(function(key, val) {
                                    var end_time = $(this).attr('data-end-time');

                                    var countDownDate = new Date(end_time).getTime();
                                    var now = new Date().getTime();
                                    var diff = countDownDate - now;
                                    var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                                    var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((diff % (1000 * 60)) / 1000);

                                    if (hours > 4 && minutes > 30) {
                                        //$(this).removeClass('.timer-field');
                                        //$(this).html('');
                                    } else {
                                        $(this).html(hours + ":" + minutes + ":" + seconds);
                                    }
                                });
                            }, 1000);
                        }

                        $(document).ready(function() {

                            $(".data_search_sub").click(function(e) {
                                e.preventDefault();
                                //Assigning search box value to javascript variable named as "name".
                                var name = $('.new_show_search #data_search').val();
                                if (name != '') {
                                    $.ajax({
                                        //AJAX type is "Post".
                                        type: "POST",
                                        //Data will be sent to "ajax.php".
                                        url: "filter-data-campaign.php",
                                        //Data, that will be sent to "ajax.php".
                                        data: {
                                            //Assigning value of "name" into "search" variable.
                                            search: name,
                                            type: 'small',
                                            uniqueid: ''
                                        },
                                        //If result found, this funtion will be called.
                                        success: function(html) {
                                            //Assigning result to "display" div in "search.php" file.
                                            $('.newfilter_table tbody').empty();
                                            $('.newfilter_table tbody').html(html);
                                            return false;
                                        }
                                    });
                                } else {
                                    location.reload();
                                }

                                return false;
                            });

                        });
                    </script>

</body>

</html>