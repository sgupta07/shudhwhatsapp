<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./inc/head.php";
   ?>
    <style>
.loading {
    display: none;
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 3;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0,0,0,.5);
}
.loading-wheel {
    width: 20px;
    height: 20px;
    margin-top: -40px;
    margin-left: -40px;

    position: absolute;
    top: 50%;
    left: 50%;

    border-width: 30px;
    border-radius: 50%;
    -webkit-animation: spin 1s linear infinite;
}
.style-2 .loading-wheel {
    border-style: double;
    border-color: #fff transparent;
}
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0);
    }
    100% {
        -webkit-transform: rotate(-360deg);
    }
}
</style>
</head>
<style>
    .RadioPdf,
    .RadioAudio,
    .RadioVideo,
    .RadioDP {
        display: none;
    }
</style>

<body class="skin-green sidebar-mini" style="height: auto;">
    <div class="wrapper" style="height: auto;">
<div id="loading" class="loading style-2"><div class="loading-wheel"></div></div>
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
                            <div class="col-12">
                                <div class="box box-body">
                                    <div class="col-md-6">
                                        <h4><i class="fa fa-pencil"></i> &nbsp; Whitelist</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div id="refresh7">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                                        <div class="info-box-content">
                                            <?php
                                            // $query = "SELECT wn,wi FROM `user_details` where id='" . $_SESSION['User_ID'] . "'";
                                            // $select_data = mysqli_query($conn, $query);
                                            // $wn = 0;
                                            // $wi = 0;
                                            // while ($row = mysqli_fetch_array($select_data)) {

                                            //     $wn = $row['wn'];
                                            //     $wi = $row['wi'];
                                            // }
                                            ?>
                                            <span class="info-box-text">Credits</span>
                                            <span class="info-box-number"><?php //echo $wn; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body ">
                                        <?php
                                        if (isset($_GET['msg'])) {
                                        ?>
                                            <div id="alert" class="alert alert-success" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>

                                                <strong>New Campaign Submitted Successfully with <span><?php echo (isset($_SESSION['count'])) ? $_SESSION['count'] : ''; ?></span> Numbers.
                                                </strong>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <form  action="./save-whitelist.php" method="post" name="fileinfo"  enctype="multipart/form-data" class="form-horizontal" >
                                            <div class="col-sm-6">
                                              
                                                <div class="form-group" style="margin-bottom:0px;">
                                                    <label class="col-md-3 control-label">Mobile Numbers
                                                    </label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <textarea class="two" onKeydown="countLines(this)" onKeyUp="countLines(this)" rows="5" name="mobileno" style="height:auto; width:100%" placeholder="Enter mobile numbers here with country code" id="res3" required></textarea>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group" id="import-group" style="margin-bottom:0px;">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <div>
                                                                    <div class="input-group"> <span class="input-group-addon" style="background: #eee;">Group Import</span>
                                                                        <select class="form-control" id="contactgroup">
                                                                            <option value="0">Select Group</option>
                                                                            <?php $query = "SELECT * FROM `contact_group` where created_by='" . $_SESSION['User_ID'] . "'  order by name desc";
                                                                            $select_data = mysqli_query($conn, $query);
                                                                            $count = 0;
                                                                            while ($row = mysqli_fetch_array($select_data)) {
                                                                                $count++;
                                                                            ?>
                                                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group" id="import-csv" style="margin-bottom:0px;">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <div>
                                                                        <div class="input-group"> <span class="input-group-addon" style="background: #eee;">CSV Import</span>
                                                                            <input type="file" style="padding-top: 3px;" accept=".csv" id="thefile" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-group" id="import-txt">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <div>
                                                                        <div class="input-group"> <span class="input-group-addon" style="background: #eee;">TXT Import</span>
                                                                            <input type="file" style="padding-top: 3px;" accept=".txt" id="thefile1" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                </div> -->

                                                <!-- <div class="form-group">
                                                    <label class="col-md-3 control-label">Message <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Max 1500 Characters</span></label>
                                                    <div class="col-md-9 col-xs-12">
                                                        <span id="msgCount"></span>
                                                        <input type="hidden" name="msgCount" value="" id="msgCountInput">
                                                        <textarea class="four" rows="4" style="height:auto; width:100%" placeholder="Enter your message here" id="myeditor" name="message"></textarea>
 <script src="./ckeditor/ckeditor.js"></script>
                        <script type="text/javascript">
                            CKEDITOR.replace('myeditor', {
                                width: "100%",
                                height: "400px"
                            }
                            );
                        </script>
                                                    </div>
                                                </div> -->


                                                <div class="form-group">
                                                    <div class="">
													
                                                            <button type="submit" name="submit" class="btn btn-success div_center"><i class="fa fa-floppy-o"></i> Submit
                                                            </button>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-sm-6">
                                                <div class="stv-radio-tabs-wrapper">
                                                    <input type="radio" class="stv-radio-tab" name="radioTabTest" value="1" id="tab1" checked />
                                                    <label for="tab1">Image</label>

                                                    <input type="radio" class="stv-radio-tab" name="radioTabTest" value="2" id="tab2" />
                                                    <label for="tab2">PDF</label>


                                                    <input type="radio" class="stv-radio-tab" name="radioTabTest" value="4" id="tab4" />
                                                    <label for="tab4">Video</label>
                                                </div>

                                                <div class="form-group RadioImage" style="background-color:#F5F5F5">
                                                    <label class="col-md-4 control-label">Upload Image 1
                                                        <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Max Size
                                                            1 MB</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="col-md-12">
                                                                <input type="file" class="fileinput btn-primary" name="wimage1" id="img1" accept=".jpg,image/*" data-filename-placement="inside" title="File name goes inside">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group RadioPdf" style="background-color:#F5F5F5">
                                                    <label class="col-md-4 control-label">
                                                        Upload PDF
                                                        <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Max Size
                                                            1 MB</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="col-md-12">
                                                                <input type="file" class="fileinput btn-primary" name="wimage2" id="img5" data-filename-placement="inside" title="File name goes inside">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group RadioVideo" style="background-color:#F5F5F5">
                                                    <label class="col-md-4 control-label">
                                                        Upload Video
                                                        <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Max Size
                                                            3 MB</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="col-md-12">
                                                                 <input type="file" class="btn-primary" name="kvf">
                                                      
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group dpimage" style="background-color:#F5F5F5">
                                                    <label class="col-md-4 control-label">
                                                        Upload DP
                                                        <br /> <span style="font-size:10px;color:#b64645;text-align:left;">Size
                                                            350x350px</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="col-md-12">
                                                                <input type="file" class="fileinput btn-primary" name="wimage5" id="img6" accept=".jpg,image/*" data-filename-placement="inside" title="File name goes inside">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div>
                                
                                </div>
                            </div>
                        </div>



                      <div class="row">

                        <!-- <div class="col-12">
                                <div class="box box-body">
                                    <div class="col-md-6">
                                        <h4><i class="fa fa-pencil"></i> &nbsp; Whitelist</h4>
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-12">
                            <div class="box box-body">

                            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Mobile number</th>
      <th scope="col">Delete</th>
   
    </tr>
  </thead>
  <tbody>

  <?php
 if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "delete from whitelist where id='$id'";
    mysqli_query($conn, $sql);
  }

  $sql="SELECT * FROM `whitelist`";
  $result=mysqli_query($conn , $sql);
  $count=0;

  while($row=mysqli_fetch_array($result))
  {
    $count++;
    // print_r($row);

    ?>

<tr>
<th scope="row"><?php echo $count; ?></th>

<td ><?php echo $row["mobile_number"] ?></td>

<td>
 <a href="whitelist.php?id=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
</td>
 <!-- <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td> -->

</tr>

    <?php
  }
?>



  
   
  </tbody>
</table>
                            </div>
                        </div>
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
                    <script type="text/javascript">
                        var uploadField = document.getElementById("img1");
                        uploadField.onchange = function() {
                            if (this.files[0].size > 1048576) {
                                alert("image 1 size should be below 1 MB!");
                                this.value = "";
                            };
                        };
                        var uploadField = document.getElementById("img2");
                        uploadField.onchange = function() {
                            if (this.files[0].size > 1048576) {
                                alert("image 2 size should be below 1 MB!");
                                this.value = "";
                            };
                        };
                        var uploadField = document.getElementById("img3");
                        uploadField.onchange = function() {
                            if (this.files[0].size > 1048576) {
                                alert("image 3 size should be below 1 MB!");
                                this.value = "";
                            };
                        };
                        var uploadField = document.getElementById("img4");
                        uploadField.onchange = function() {
                            if (this.files[0].size > 1048576) {
                                alert("image 4 size should be below 1 MB!");
                                this.value = "";
                            };
                        };
                        var uploadField = document.getElementById("img5");
                        uploadField.onchange = function() {
                            if (this.files[0].size > 1048576) {
                                alert("PDF File size should be below  1 MB!");
                                this.value = "";
                            };
                        };
                        // var uploadField = document.getElementById("audio");
                        // uploadField.onchange = function () {
                        // if (this.files[0].size > 2097152) {
                        // alert("Audio size should be below 2 MB!");
                        // this.value = "";
                        // }
                        // ;
                        // };

                        var uploadField = document.getElementById("video");
                        uploadField.onchange = function() {
                            if (this.files[0].size > 3145728) {
                                alert("Video size should be below  3 MB !");
                                this.value = "";
                            }
                        };
                    </script>


                    <script>
                        // var f_duration =0; //store duration
                        // document.getElementById('audio11').addEventListener('canplaythrough', function(e){
                        // //add duration in the input field #f_du
                        // f_duration = Math.round(e.currentTarget.duration);

                        // //f_duration

                        // document.getElementById('video_duration').value = f_duration;

                        // URL.revokeObjectURL(obUrl);
                        // //CheckVideo(f_duration);
                        // });


                        // //when select a file, create an ObjectURL with the file and add it in the #audio element
                        // var obUrl;
                        // document.getElementById('video').addEventListener('change', function(e){
                        // var file = e.currentTarget.files[0];
                        // //check file extension for audio/video type
                        // if(file.name.match(/\.(avi|mp3|mp4|mpeg|ogg)$/i)){
                        // obUrl = URL.createObjectURL(file);
                        // document.getElementById('audio11').setAttribute('src', obUrl);
                        // }
                        // });


                        countLines();

                        function countLines(theArea) {
                            var test = $('#res3').val();
                            if (test) {
                                var test1 = test.split("\n");
                                var count = test1.length;
                                $('#lineCount_set').val(count);
                                if (count < 500) {
                                    $('.dpimage').hide();
                                    $('#img6').attr('disabled', true);
                                } else {
                                    $('.dpimage').show();
                                    $('#img6').attr('disabled', false);
                                }
                            }
                        }

                        function MNumber() {
                            var yourInput = $('#res3').val();
                            re = /[abcdefghijklmnopqrstuvwxyz`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
                            var isSplChar = re.test(yourInput);
                            if (isSplChar) {
                                var no_spl_char = yourInput.replace(
                                    /[abcdefghijklmnopqrstuvwxyz`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,
                                    '');
                                $('#res3').val(no_spl_char);
                            }
                        }

                        $(function() {

                            $('#res3').click(function() {
                                $('#import-group').fadeIn();
                                $('#import-csv').fadeIn();
                                $('#import-txt').fadeIn();
                                MNumber();
                            });

                            $('#res3').keyup(function() {
                                MNumber();
                            });
                        });

                        $('#thefile').change(function(e) {
                            if (e.target.files != undefined) {
                                var reader = new FileReader();
                                var theInfo = "";
                                var file = document.getElementById('thefile').files[0];
                                reader.onload = function(e) {
                                    var lenlen = e.target.result.split('\n').length;
                                    for (i = 0; i < lenlen; i++) {
                                        theInfo += e.target.result.split('\n')[i] + "\n";
                                    }
                                    $('#res3').val('');
                                    $('#res3').val(theInfo);
                                    countLines();
                                    $('#import-txt').fadeOut();
                                    $('#import-group').fadeOut();
                                    MNumber();
                                };
                                reader.readAsText(e.target.files.item(0));
                            }
                            return false;
                        });

                        $('input[name="radioTabTest"]').change(function(e) {
                            var id = $(this).val();
                            if (id > 0) {
                                if (id == 1) {
                                    $('.RadioImage').show();
                                    $('.RadioPdf,.RadioAudio,.RadioVideo').hide();
                                    $('.RadioImage input').attr('disabled', false);
                                    $('.RadioPdf input,.RadioAudio input,.RadioVideo input').attr('disabled', true);
                                } else if (id == 2) {
                                    $('.RadioPdf').show();
                                    $('.RadioImage,.RadioAudio,.RadioVideo').hide();
                                    $('.RadioPdf input').attr('disabled', false);
                                    $('.RadioImage input,.RadioAudio input,.RadioVideo input').attr('disabled', true);
                                } else if (id == 3) {
                                    $('.RadioAudio').show();
                                    $('.RadioImage,.RadioPdf,.RadioVideo').hide();
                                    $('.RadioAudio input').attr('disabled', false);
                                    $('.RadioPdf input,.RadioImage input,.RadioVideo input').attr('disabled', true);
                                } else if (id == 4) {
                                    $('.RadioVideo').show();
                                    $('.RadioImage,.RadioPdf,.RadioAudio').hide();
                                    $('.RadioVideo input').attr('disabled', false);
                                    $('.RadioPdf input,.RadioAudio input,.RadioImage input').attr('disabled', true);
                                }
                            }
                        });


                        $('#thefile1').on('change', function() {
                            var fileName, fileExtension;
                            fileName = $(this).val();
                            fileExtension = fileName.replace(/^.*\./, '');

                            if (fileExtension == 'txt') {
                                fileChosen(this, document.getElementById('res3'));
                            } else {
                                $('#thefile1').val('');
                                alert('Only Accept txt file format.');
                            }
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
                                        $('#res3').val('');
                                        output.value = str;
                                        countLines();
                                        $('#import-csv').fadeOut();
                                        $('#import-group').fadeOut();
                                        MNumber();
                                    }
                                );
                            }
                        }

                        $('#contactgroup').change(function() {
                            $('#res3').val('');
                            gid = $(this).val();
                            //alert($gid);
                            if (gid != 0) {
                                $.ajax({
                                    url: 'getcontactgroup.php',
                                    type: 'POST',
                                    data: {
                                        gid: gid
                                    },
                                    success: function(response) {
                                        formattedString = response.split(",").join("\n");
                                        $('#res3').val(formattedString.trim());
                                        countLines();
                                        $('#import-csv').fadeOut();
                                        $('#import-txt').fadeOut();
                                        MNumber();
                                    }
                                });
                            } else {
                                $('#res3').val('');
                                $('#import-csv').fadeIn();
                                $('#import-txt').fadeIn();
                                MNumber();
                            }
                        });

                        $('#message').on("input", function() {
                            var CC = $(this).val().length;
                            if (CC > 0) {
                                $('#msgCount').fadeIn();
                                $('#msgCount').html(CC);
                                $('#msgCountInput').val(CC);
                            } else {
                                $('#msgCountInput').val(0);
                                $('#msgCount').fadeOut();
                            }
                        });

                        $("#send_w").addClass('active');
                    </script>

</body>

</html>