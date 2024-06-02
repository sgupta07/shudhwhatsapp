<?php
include "./inc/db.php";

$total_user_count = 0;
$total_reseller_count = 0;
$clients_campaign = 0;
$my_campaign = 0;
$today_campaign = 0;
$today_user_count = 0;
$today_reseller_count = 0;

$query = "SELECT * FROM `user_details` where creates_by='" . $_SESSION['User_ID'] . "'  order by id desc";
$select_data = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($select_data)) {
   if ($row['user_type'] == 3) {
        $total_reseller_count++;
    } else if ($row['user_type'] == 4) {
        $total_user_count++;
    }
}
$sql="SELECT COUNT(*) as `count` FROM send_whatsapp WHERE userID='" . $_SESSION['User_ID'] . "'";
$clients_data = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($clients_data)) {
     $my_campaign++;
}

$sql="SELECT COUNT(*) as `count` FROM send_whatsapp WHERE DATE(send_delivery_dateTime) = CURDATE() and userID='" . $_SESSION['User_ID'] . "'";
$today_clients_data = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($today_clients_data)) {
     $today_campaign++;
}
?>
<div class="row">
	    <?php
    if (isset($_GET['msg']) && $_GET['msg']==1) {
    ?>
        <div id="alert" class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span></button>

            <strong> Submitted Successfully
            </strong>
        </div>
    <?php
    }else if(isset($_GET['msg']) && $_GET['msg']==2){
		?>
	     <div id="alert" class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span></button>

            <strong> Insufficient Balance
            </strong>
        </div>
	<?php
	}
    ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-info">
            <div class="info-box-text" style="
                                text-transform: none;
                                padding: 12px 20px;
                                font-size: 16px;
                                text-align: center;    white-space: unset;
                                "><b>
                    <span style="
                                font-weight: 600;
                                color: #f44336;
                            			 "><b>Please Note : </b></span>Due to high traffic, Campaign reports will be update with in 48 hours of submission. <span style="
                                 font-weight: 600;
                                color: #f44336;
                            "> <b>Please be patience.</b></span> Thankyou !</b>

                <span class="info-box-number"></span>
            </div>

        </div>
    </div>



    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number"><?php echo $total_user_count;?></span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Resellers</span>
                <span class="info-box-number"><?php echo $total_reseller_count;?></span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Clients Campaign </span>
                <span class="info-box-number"><?php echo $total_user_count;?></span>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">My Campaigns</span>
                <span class="info-box-number"><?php echo $total_user_count;?></span>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Today Users</span>
                <span class="info-box-number"><?php echo $total_user_count;?></span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Today Resellers</span>
                <span class="info-box-number"><?php echo $total_reseller_count;?></span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Today Campaign</span>
                <span class="info-box-number"><?php echo $today_campaign;?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>


    <!-- <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text plugin-clock">Today My</span>
                <span class="info-box-number">0</span>
            </div>
        </div>
    </div> -->
</div>