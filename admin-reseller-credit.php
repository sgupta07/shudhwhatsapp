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
                                    <h4><i class="fa fa-pencil"></i> &nbsp; Reseller User</h4>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:history.back()" class="btn btn-primary pull-right"><i class="fa fa-close"></i> cancel</a>
                                    <a href="reseller.php?action=add" style="margin-right:5px;" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New User</a>
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
                                    <form id="fileinfo" action="./admin_credit.php" method="post" name="fileinfo" autocomplete="off" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Credit Type
                                                    </label>
                                                    <div class="col-md-9">
                                                        <select name="credit_type" required id="credit_type">
                                                            <option value="">Select Credit Type</option>
                                                            <option value="add">Add</option>
                                                            <option value="remove">Remove</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">No of SMS *</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <input type="text" style="width: 100%;" required placeholder="Enter no of sms" name="no_of_sms" value="">
                                                    </div>
                                                </div>

                                                <div class="form-group credType">
                                                    <label class="col-md-3 control-label">
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="radio" style="width: auto;margin-right: 4px;" name="credit_type_nota" checked value="1">National
                                                        <input type="radio" style="width: auto;margin-right: 4px;margin-left: 35px;" name="credit_type_nota" value="2">International
                                                        <input type="radio" style="width: auto;margin-right: 4px;margin-left: 35px;" name="credit_type_nota" value="3">Button 

                                                    </div>
                                                </div>

                                                <div class="form-group make_hidden">
                                                    <label class="col-md-3 control-label">Per SMS price*</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <input type="text" style="width: 100%;" name="per_sms_price" value="">
                                                        <input type="hidden" name="uniqueid" value="<?php echo $_GET['uniqueid'];?>">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Description *</label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <textarea name="description"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group make_hidden">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="form-group">
                                                                <div class="col-md-10">
                                                                    <div style="width:190px">
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon" style="border: 1px solid #d2d6de;"><span>Tax Included</span>
                                                                                <input name="is_tax" value="1" type="checkbox" class="form-checkbox" style="width: 30px;height: 17px;" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="">
                                                        <input type="submit" name="creditsubmit" id="creditsubmit" class="btn btn-success div_center" value="Submit"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

</body>

</html>