<?php 
if(isset($_GET['action']) && $_GET['action']=='view'){
    include "./int_cam_rept_view.php";

}
else{
    include "./admin-camp-international-list.php";
}

?>