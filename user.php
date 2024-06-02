<?php
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    include "./add-user.php";
} else if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    include "./edit-user.php";
} else if (isset($_GET['action']) && $_GET['action'] == 'credit') {

    include "./user-credit.php";
} else {
    include "./user-list.php";
}

?>
<script>
    $("#user").addClass('active');
</script>