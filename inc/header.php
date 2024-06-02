<header class="header white-bg">

    <header class="main-header">
        <a href="dashboard.php" class="logo">

            <span class="logo-mini"><b>Promo-SMS</b></span>

            <span class="logo-lg"><b>Promo-SMS</b></span>
        </a>

        <nav class="navbar navbar-static-top">

            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="nav_offer">
                <marquee width="100%" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">.NOTE = 
                  <?php
                                                 
                                                    $query = "SELECT * FROM `notice`  order by id desc";
                                                    $select_data = mysqli_query($conn, $query);
                                                    $count = 0;
                                                    while ($row = mysqli_fetch_array($select_data)) {
                                                        $count++;
                                                    echo $row['title']. "&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;";
                                                    }?>
            </marquee>
            </div>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class=" messages-menu">
                        <button type="button" class="btn btn-danger btn-sm mg-t-9" data-toggle="modal" data-target="#IssueReport">Report New Issue ?
                        </button>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <img src="user_profile/<?php echo  $_SESSION['user_profile']; ?>" class="user-image" alt="User Image">

                            <span class="hidden-xs"><?php echo  $_SESSION['full_name']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="user_profile/<?php echo  $_SESSION['user_profile']; ?>" class="user-image" alt="User Image">
                                <p>
                                    <?php echo  $_SESSION['full_name']; ?> <small>Reseller</small>
                                    <?php
                                    $query = "SELECT * FROM `user_details` where id='" . $_SESSION['User_ID'] . "'";
                                    $select_data = mysqli_query($conn, $query);
                                    $wn = 0;
                                    $wi = 0;
                                    $wb=0;
                                    while ($row = mysqli_fetch_array($select_data)) {

                                        $wn = $row['wn'];
                                        $wi = $row['wi'];
                                        $wb = $row['wb'];
                                    }
                                    ?>
                                    <small><b>WN : <?php $wn; ?></b></small>
                                    <small><b>WI : <?php $wi; ?></b></small>
                                    <small><b>WB : <?php $wb; ?></b></small>
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
                                </div>
                                <div class="pull-right" style="margin-right: 12px;">
                                    <a href="login_pass.php" class="btn btn-default btn-flat">Password</a>
                                </div>
                                <div class="pull-left">
                                    <a href="login_profile.php" class="btn btn-default btn-flat">profile</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li style="display:none;">
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

</header>