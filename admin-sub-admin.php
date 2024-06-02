<?php 
if(isset($_GET['action']) && $_GET['action']=='add'){
    include "./add-sub-admin.php";
}
else if(isset($_GET['action']) && $_GET['action']=='edit'){
    include "./edit-sub-admin.php";
}else if(isset($_GET['action']) && $_GET['action']=='credit'){
    include "./admin-sub-admin-credit.php";
}
else{
    include "./admin-sub-admin-list.php";
}

?>