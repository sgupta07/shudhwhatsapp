<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./inc/head.php";
    if (isset($_POST['submit'])) {
        $user_id = $_SESSION['User_ID'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email  = $_POST['email'];
        $mobileno = $_POST['mobileno'];
        $password  = $_POST['password'];
        $company = $_POST['company'];
        // $profilepic=$_POST['profilepic'];

        $user_profile = '';
        // if (isset($_FILES['profilepic'])) {
        //     $user_profile = $_FILES['profilepic']['name'];
        //     $user_profile_temp = $_FILES['profilepic']['tmp_name'];
        //     move_uploaded_file($user_profile_temp, "user_profile/$user_profile");
        // }
        if (isset($_FILES['profilepic']["name"])) {
            $user_profile = $_FILES["profilepic"]["name"];
            $user_profile = preg_replace('/\\.[^.\\s]{3,4}$/', '', $user_profile);
            $ext = pathinfo($_FILES['profilepic']['name'], PATHINFO_EXTENSION);
            $user_profile =  time() . "_img_." . $ext;
            $user_profile_temp = $_FILES['profilepic']['tmp_name'];
            move_uploaded_file($user_profile_temp, "user_profile/$user_profile");
        }
        $query1 = "select * from user_details WHERE  `id`='" . $_GET['uniqueid'] . "'";
        $select_userprofile_image1 = mysqli_query($conn, $query1);
        while ($row1 = mysqli_fetch_array($select_userprofile_image1)) {
            if (empty($user_profile)) {
                $user_profile = $row1['user_profile'];
            }
        }
        $status = $_POST['status'];
        // $sql = "INSERT INTO `user_details`(`company_name`, `user_name`, `full_name`, `mobile`, `email`, `password`, `user_profile`, `status`, `creates_by`, `created`)";
        // $sql .= "VALUES ('$company','$username','$fullname','$mobileno','$email','$password','$user_profile','$status','$user_id',now())";
        $sql = "UPDATE `user_details` SET ";
        $sql .= "`company_name`='$company',";
        $sql .= "`full_name`='$fullname',";
        $sql .= "`user_name`='$username',";
        $sql .= "`mobile`='$mobileno',";
        $sql .= "`email`='$email',";
        $sql .= "`password`='$password',";
        $sql .= "`user_profile`='$user_profile',";
        $sql .= "`status`='$status' WHERE `id`='" . $_GET['uniqueid'] . "'";
        $update_user = mysqli_query($conn, $sql);
        if (!$update_user) {
            die('QUERY FAILD post' . mysqli_error($conn));
        } else {
            //window.location.href = 'dashboard.php';
            // echo "<script>alert('User Update successfully');";
            // echo "</script>";
            echo "<script>window.location.href = 'dashboard.php?msg=1';";
            echo "</script>";
        }
    } ?>
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
                                    <?php
                                    $id = $_GET['uniqueid'];
                                    $query = "SELECT * FROM `user_details` where user_type ='4' and id='$id' ";
                                    $select_data = mysqli_query($conn, $query);
                                    $count = 0;
                                    while ($row = mysqli_fetch_array($select_data)) {
                                        $row['password'];
                                        $row['user_profile'];
                                    ?>

                                        <div class="box-body ">
                                            <form id="fileinfo" method="post" name="fileinfo" autocomplete="off" enctype="multipart/form-data" class="form-horizontal">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Fullname</label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <input type="text" style="width: 100%;" required placeholder="Enter fullname" name="fullname" value="<?php echo $row['full_name']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">UserName</label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <input type="text" onkeyup="return forceLower(this);" required style="width: 100%;" placeholder="Enter userName" name="username" value="<?php echo   $row['user_name']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Email ID</label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <input type="email" onkeyup="return forceLower(this);" required style="width: 100%;" placeholder="Enter email id" name="email" value="<?php echo $row['email']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Mobile No</label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <input type="text" style="width: 100%;" required placeholder="Enter mobileno" name="mobileno" value="<?php echo $row['mobile']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Password</label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <input type="text" style="float: left; 
    width: 84%;" placeholder="Enter password" name="password" required id="pwd" value="<?php echo $row['password']; ?>">
                                                            <span class="input-group-btn"><button type="button" data-toggle="tooltip" title="Generate Password" class="btn btn-default btn-lg getNewPass"><span class="fa fa-refresh"></span></button></span>
                                                            <div id="messagePP">
                                                                <h5><strong>Password must contain the following:</strong></h5>
                                                                <p id="letter" class="messagePPinvalid">One <b>lowercase</b> letter</p>
                                                                <p id="capital" class="messagePPinvalid">One <b>capital (uppercase)</b> letter</p>
                                                                <p id="number" class="messagePPinvalid">One <b>number or special character</b></p>
                                                                <p id="length" class="messagePPinvalid">Minimum <b>8 characters</b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Company</label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <input type="text" style="    width: 100%;" placeholder="Enter company" name="company" value="<?php echo $row['company_name']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="">
                                                            <button type="submit" name="submit" class="btn btn-success div_center"><i class="fa fa-floppy-o"></i> Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group" style="background-color:#F5F5F5">
                                                        <label class="col-md-3 control-label">Profile Pic
                                                            <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Max Size
                                                                1MB</span>
                                                        </label>
                                                        <div class="col-md-9">
                                                            <input type="file" class="fileinput btn-primary" name="profilepic" id="img1" accept=".jpg,image/*" data-filename-placement="inside" title="File name goes inside">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Status</label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <select class="required" name="status">
                                                                <?php
                                                                if ($row['status'] == 1) {
                                                                    echo "<option value='1' selectd>Active</option>";
                                                                    echo "<option value='0'>Inactive</option>";
                                                                } else {
                                                                    echo "<option value='0'selectd>Inactive</option>";
                                                                    echo "<option value='1'>Active</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"></label>
                                                        <label class="col-md-3">Rollback Allow</label>
                                                        <div class="col-md-1 col-xs-12">
                                                            <input type="checkbox" checked name="rollback_allow">
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    <?php
                                    }
                                    ?>
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
            <script>
                $("#m_client").addClass('active');
                $("#user").addClass('active');
            </script>
            <script src="assets/js/password_rules.js"></script>

</body>

</html>