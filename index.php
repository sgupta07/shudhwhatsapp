<?php
include "./inc/db.php";
$status = 0;
$query = "select * from website_on_off";
$select_userprofile_image1 = mysqli_query($conn, $query);
while ($row1 = mysqli_fetch_array($select_userprofile_image1)) {
    $status = $row1['status'];
}
if ($status == 1) {
    header("location:./website_under_maintenance.php");
}
session_start();
if (isset($_POST['submit'])) {
    if ($_POST['txtCaptcha'] == $_POST['CaptchaInput']) {
        $uemail = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $sql = "select * from user_details where email = '$uemail' and password = '$password'";

        $q = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($q);
        $count = mysqli_num_rows($q);

        if ($count > 0) {

            $chck_Active_User = $row['status'];
            if ($chck_Active_User == '0') {
                echo "<script>
          
            window.location.href = 'index.php?msg=1';
        </script>";
                //  alert('your account is currently deactivated. please contact your admin.');
            } else {
                $_SESSION['User_ID'] = $row['id'];
                $_SESSION['company_name'] = $row['company_name'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['full_name'] = $row['full_name'];
                $_SESSION['user_profile'] = $row['user_profile'];
                $_SESSION['user_type'] = $row['user_type'];
                echo "<script>window.location.href = './dashboard.php';</script>"; //
            }
        } else {
?>
            <script>
                alert('Failed to login');
                window.location.href = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
            </script>
<?php
        }
    } else {
        // echo "<script>alert('please enter valid captcha');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/logo.png">

    <title></title>

    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/dist/css/style.css">
    <!-- jQuery 2.2.3 -->
    <script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <style>
        #CaptchaDiv {
            color: #000000;
            font: normal 25px Impact, Charcoal, arial, sans-serif;
            font-style: italic;
            text-align: center;
            vertical-align: middle;
            background-color: #FFFFFF;
            user-select: none;
            padding: 6px 14px 5px 10px;
            border: 1px solid #ddd;
            box-shadow: 0 0 3px rgb(0 0 0 / 17%) inset;
        }

        .txt-cp {
            font-weight: 600;
        }

        #CaptchaInput {
            box-shadow: 0 0 3px rgb(0 0 0 / 17%) inset;
            padding: 11px 15px !important;
        }

        .capbox {
            margin-bottom: 25px;
        }

        .cap,
        .txt-cp {
            color: #fff;
        }
    </style>
</head>

<body id="login-form">
    <div class="container">
        <div class="row">

            <div class="col-md-2"></div>

            <div class="col-md-8">
                <div class="login-title">
                    <h3 style="visibility: hidden;"><span>Promo SMS</span></h3>
                </div>

                <div class="col-md-12 text-center">
                    <div class="form-box">
                        <div class="col-md-6 ssDesk">
                            <img style="width:75%;" src="img/darkk.png">
                        </div>

                        <div class="col-md-6" style="padding-top: 35px;">
                            <div class="caption">
                                <h4>Sign in to start your session</h4>
                            </div>
                            <?php
                            if (isset($_GET['msg'])) {
                            ?>
                                <div id="alert" class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>

                                    <strong>Your account is inactive. please contact admin</strong>
                                </div>
                            <?php
                            }
                            ?>
                            <form class="login-form" action="" method="post">
                                <div class="input-group">
                                    <input type="email" name="email" id="name" value="" class="form-control" placeholder="Username">

                                    <input type="password" value="" name="password" id="password" class="form-control" placeholder="Password">

                                    <div class="capbox row">
                                        <div class="col-md-6">
                                            <div class="cap">
                                                <h5 class="txt-cp">Captcha :</h5>
                                                <div id="CaptchaDiv"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="capbox-inner">
                                                <h5 class="txt-cp">Type the number:</h5>
                                                <input type="hidden" id="txtCaptcha" name="txtCaptcha">
                                                <input type="text" name="CaptchaInput" autocomplete="off" maxlength="5" id="CaptchaInput" size="15">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="submit" name="submit" id="submit" class="form-control" value="Login">

                                </div>
                            </form>

                        </div>

                        <div class="col-md-6 ssMob">
                            <img style="width:86%;    margin-bottom: 20px;
    object-fit: contain;" src="img/darkk.png">
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
</body>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>

<script>
    $(document).ready(function() {
        captcha();
    });

    function captcha() {
        var a = Math.ceil(Math.random() * 9) + '';
        var b = Math.ceil(Math.random() * 9) + '';
        var c = Math.ceil(Math.random() * 9) + '';
        var d = Math.ceil(Math.random() * 9) + '';
        var e = Math.ceil(Math.random() * 9) + '';

        var code = a + b + c + d + e;
        document.getElementById("txtCaptcha").value = code;
        document.getElementById("CaptchaDiv").innerHTML = code;
    }
</script>

</html>