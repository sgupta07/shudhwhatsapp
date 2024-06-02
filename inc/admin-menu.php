<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="height: 90px;">
            <div class="pull-left image">
                <img style="height: 46px;" src="user_profile/<?php echo  $_SESSION['user_profile']; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo  $_SESSION['full_name']; ?> </p>
                <a href="javascript:void(0);"><i class="fa fa-user text-success"></i> Admin</a>
                <!-- <?php
                        $query = "SELECT wn,wi FROM `user_details` where id='" . $_SESSION['User_ID'] . "'";
                        $select_data = mysqli_query($conn, $query);
                        $wn = 0;
                        $wi = 0;
                        while ($row = mysqli_fetch_array($select_data)) {

                            $wn = $row['wn'];
                            $wi = $row['wi'];
                        }
                        ?>
                <a style="display: block;
    line-height: 14px;" href="javascript:void(0);"><i class="fa fa-paper-plane text-primary"></i> WN : <?php echo $wn; ?></a>

                <a style="display: block;
    line-height: 14px;" href="javascript:void(0);"><i class="fa fa-paper-plane text-primary"></i> WI : <?php echo $wi; ?></a> -->
            </div>
        </div>

        <ul class="sidebar-menu">
            <li id="dashboard" class="treeview">
                <a href="dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- <ul class="sidebar-menu">
            <li id="send_w" class="treeview">
                <a href="sendwhatsapp.php">
                    <i class="fa fa-whatsapp"></i> <span>Send Whatsapp</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li id="send_w_int" class="treeview">
                <a href="send-international.php">
                    <i class="fa fa-whatsapp"></i> <span>Send International</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li id="c_group" class="treeview">
                <a href="contactgroup.php">
                    <i class="fa fa-id-badge"></i> <span>Contact Group</span>
                </a>
            </li>
        </ul> -->

        <ul class="sidebar-menu">
            <li id="c_report" class="treeview">
                <a href="admin-campaign-report.php">
                    <i class="fa fa-folder"></i> <span>Campaign Report</span>
                </a>
            </li>
        </ul>

  

        <ul class="sidebar-menu">
            <li id="c_report_int" class="treeview">
                <a href="admin-camp-international.php">
                    <i class="fa fa-folder"></i> <span>International Campaign Report</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li id="c_report_button" class="treeview">
                <a href="admin-camp-button.php">
                    <i class="fa fa-folder"></i> <span>Button Campaign Report</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li id="m_client" class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Manage Clients</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li id="user"><a href="admin-user.php"><i class="fa fa-circle-o"></i>
                            User</a></li>

                    <li id="reseller"><a href="admin-reseller.php"><i class="fa fa-circle-o"></i>Reseller</a></li>
                    <li id="sub-admin"><a href="admin-sub-admin.php"><i class="fa fa-circle-o"></i>Sub Admin</a></li>

                </ul>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li id="t_logs" class="treeview">
                <a href="admincredit.php">
                    <i class="fa fa-bar-chart"></i> <span>Transaction Logs</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li id="t_logs" class="treeview">
                <a href="notes.php">
                    <i class="fa fa-bar-chart"></i> <span>Notes</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li id="t_logs" class="treeview">
                <a href="campaign-logs.php">
                    <i class="fa fa-question-circle"></i> <span>Campaign Logs</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li id="website_on_off" class="treeview">
                <a href="website_on_off.php">
                    <i class="fa fa-life-ring"></i> <span>Website On Off</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li id="support" class="treeview">
                <a href="support.php">
                    <i class="fa fa-life-ring"></i> <span>Support</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li id="support" class="treeview">
                <a href="whitelist.php">
                    <i class="fa fa-life-ring"></i> <span>Whitelist</span>
                </a>
            </li>
        </ul>
    </section>
</aside>