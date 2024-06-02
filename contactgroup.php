<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./inc/head.php";
    if (isset($_POST['submit'])) {
        $user_id = $_SESSION['User_ID'];
        $groupname = $_POST['groupname'];
        $numbers = $_POST['numbers'];
        $numbercount = $_POST['numbercount'];
        $query = "INSERT INTO `contact_group`(`name`, `count`, `created_by`, `created`)";
        $query .= " VALUES ('$groupname','$numbercount','$user_id',now())";
        if ($conn->query($query) === TRUE) {
            $last_id = $conn->insert_id;
            $mobileno = preg_split('/\r\n|\n|\r/', $numbers);
            foreach ($mobileno as $no) {
                $query = mysqli_query($conn, "INSERT INTO `groups_contact_number`(`mobile_no`, `group_id`, `created_by`) VALUES ('$no','$last_id','$user_id')");
            }
            // echo "<script>alert('Contact Group Add Successfull');</script>";
        }
    }
    ?></head>

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
                                        <h4><i class="fa fa-pencil"></i> &nbsp; Contact Group</h4>
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
                                                    <label class="col-md-3 control-label">Group Name
                                                    </label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <input type="text" class="form-control" name="groupname">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Mobile Numbers
                                                    </label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <textarea class="two" onKeydown="countLines(this)" onKeyUp="countLines(this)" rows="5" name="numbers" style="height:auto; width:100%" placeholder="Enter mobile numbers here with country code" id="res3"></textarea>
                                                        <!--<button id="c">Remove blank lines</button>-->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="form-group">
                                                                <div class="col-md-10">
                                                                    <div style="width:190px">
                                                                        <div class="input-group"> <span class="input-group-addon">Count</span>
                                                                            <input name="numbercount" id="lineCount_set" type="text" width="80px" class="form-control" readonly />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="">
                                                        <button type="submit" name="submit" class="btn btn-success div_center"><i class="fa fa-floppy-o"></i> Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group" style="    height: 36px;">
                                                </div>
                                                <div class="form-group" id="import-txt" style="background-color:#F5F5F5">
                                                    <label class="col-md-4 control-label">Upload txt
                                                        <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Max Size
                                                            2MB</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="col-md-12">
                                                                <input type="file" class="fileinput btn-primary" name="txtfile" id="file" accept=".txt" data-filename-placement="inside" title="File name goes inside">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group" id="import-csv" style="background-color:#F5F5F5">
                                                    <label class="col-md-4 control-label">Upload CSV
                                                        <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Max Size
                                                            2MB</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="col-md-12">
                                                                <input type="file" class="fileinput btn-primary" accept=".csv" id="csvfile" data-filename-placement="inside" title="File name goes inside">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group" id="import-xlsx" style="background-color:#F5F5F5">
                                                    <label class="col-md-4 control-label">Upload xlsx
                                                        <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Max Size
                                                            2MB</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="col-md-12">
                                                                <input type="file" class="fileinput btn-primary" name="xlsxfile" accept=".xlsx" data-filename-placement="inside" title="File name goes inside">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box">
                                    <div class="box-body table-responsive">
                                        <table id="example1" class="table table-bordered table-striped ">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Group Name</th>
                                                    <th>Total No's.</th>
                                                    <th>Create At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $query = "SELECT * FROM `contact_group` where created_by='" . $_SESSION['User_ID'] . "'  order by id desc";
                                                $select_data = mysqli_query($conn, $query);
                                                $count = 0;
                                                while ($row = mysqli_fetch_array($select_data)) {
                                                    $count++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo $row['name'] ?></td>
                                                        <td><?php echo $row['count'] ?></td>
                                                        <td><?php echo $row['created'] ?></td>
                                                        <td class="clientList">
                                                            <a data-toggle="tooltip" title="Edit" href="#" class="btn btn-success"><i class="fa fa-download"></i></a>
                                                            <a data-toggle="tooltip" title="Credit Update" href="contactgroup.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>

                    <script type="text/javascript">
                        countLines();
                        var uploadField = document.getElementById("file");
                        uploadField.onchange = function() {
                            if (this.files[0].size > 2200000) {
                                alert("File size should be below 2 MB!");
                                this.value = "";
                            };
                        };

                        function countLines(theArea) {
                            var test = $('#res3').val();
                            if (test) {
                                var test1 = test.split("\n");
                                var count = test1.length;
                                $('#lineCount_set').val(count);
                            }
                        }

                        $(function() {
                            $('#res3').keyup(function() {
                                var yourInput = $(this).val();
                                re = /[abcdefghijklmnopqrstuvwxyz`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
                                var isSplChar = re.test(yourInput);
                                if (isSplChar) {
                                    var no_spl_char = yourInput.replace(
                                        /[abcdefghijklmnopqrstuvwxyz`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,
                                        '');
                                    $(this).val(no_spl_char);
                                }
                            });
                        });

                        $('#file').on('change', function() {
                            var fileName, fileExtension;
                            fileName = $(this).val();
                            fileExtension = fileName.replace(/^.*\./, '');

                            if (fileExtension == 'txt') {
                                fileChosen(this, document.getElementById('res3'));
                            } else {
                                $('#file').val('');
                                alert('Only Accept txt file format.');
                            }
                        });

                        $('#csvfile').change(function(e) {
                            if (e.target.files != undefined) {
                                var reader = new FileReader();
                                var theInfo = "";
                                var file = document.getElementById('csvfile').files[0];
                                reader.onload = function(e) {
                                    var lenlen = e.target.result.split('\n').length;
                                    for (i = 0; i < lenlen; i++) {
                                        theInfo += e.target.result.split('\n')[i] + "\n";
                                    }
                                    $('#res3').val('');
                                    $('#res3').val(theInfo);
                                    countLines();
                                };
                                reader.readAsText(e.target.files.item(0));
                            }
                            return false;
                        });

                        function readTextFile(file, callback, encoding) {
                            var reader = new FileReader();
                            reader.addEventListener('load', function(e) {
                                callback(this.result);
                            });
                            if (encoding) reader.readAsText(file, encoding);
                            else reader.readAsText(file);
                        }

                        function fileChosen(input, output) {
                            if (input.files && input.files[0]) {
                                readTextFile(
                                    input.files[0],
                                    function(str) {
                                        output.value = str;
                                        countLines()
                                    }
                                );
                            }
                        }
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
                    <script>
                        $("#c_group").addClass('active');
                    </script>
</body>

</html>