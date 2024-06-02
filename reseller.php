<?php 
if(isset($_GET['action']) && $_GET['action']=='add'){
    include "./add-reseller.php";
}
else if(isset($_GET['action']) && $_GET['action']=='edit'){
    include "./edit-reseller.php";
}else if(isset($_GET['action']) && $_GET['action']=='credit'){
    include "./reseller-credit.php";
}
else{
    include "./reseller-list.php";
}

?>