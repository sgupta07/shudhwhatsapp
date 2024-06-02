<?php include "./inc/db.php";
mysqli_set_charset($conn,'utf8mb4');
session_start();
if(isset($_SESSION['User_ID']) && ($_SESSION['User_ID'] != '') ){

}
else{
header('location:index.php');
}

$status = 0;
$query = "select * from website_on_off";

// print_r($query);
// die;
$select_userprofile_image1 = mysqli_query($conn, $query);
while ($row1 = mysqli_fetch_array($select_userprofile_image1)) {
    $status = $row1['status'];
}
if ($status == 1) {
    header("location:./website_under_maintenance.php");
}
?>
<meta charset="utf-8">

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

<meta name="author" content="Coderthemes">

<link rel="shortcut icon" href="assets/images/logo.png">

<title>Promo-SMS</title>

<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 

<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css?v=1646500093">
<!-- Custom CSS -->
<link rel="stylesheet" href="assets/dist/css/style.css?v=1646500093">
<link rel="stylesheet" href="assets/plugins/select2/select2.css">
<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Datatable style -->
<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
<!-- Custom CSS -->

<link rel="stylesheet" href="assets/dist/css/build/toastr.min.css">
<link rel="stylesheet" href="assets/dist/css/sweetalert.min.css">

<link href="assets/dist/css/smart_wizard.css" type="text/css"/>
<link rel="stylesheet" href="assets/dist/css/skins/skin-green.min.css?v=1646500093">
<!-- jQuery 2.2.3 -->
<!-- Validation -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.1.0/jquery.countdown.min.js"></script>

</head>