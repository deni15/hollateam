<?php
include '../db/conn.php';
session_start();
if (!isset($_SESSION['hollauser'])) {
    ?>
    <script type="text/javascript">
        window.location.href="login.php"
    </script>
    <?php
    
}

$sql1 = $koneksi->query("SELECT * FROM `user_position` WHERE pid='".$_SESSION['position']."'");

$data2 = $sql1->fetch_assoc();
$_SESSION['level_user'] = $data2['level'];

$sql2 =$koneksi->query("SELECT * FROM `level` WHERE lid='".$_SESSION['level_user']."'");
$data3 = $sql2->fetch_assoc();
$_SESSION['priority'] = $data3['priority'];

$page = $_GET['page'];
$action = $_GET['action'];
if (!$page) {
    $title = "Home Page Holla Workforce System";
}else{
    $title = "HWS - ".ucfirst($page);
}
$id=base64_decode($_GET['id']);
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<?php
include '../assets/assets/php/header.php';
?>
<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

<?php
include '../assets/assets/php/top-nav.php';
include '../assets/assets/php/left-menu.php';
?>


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <?php
            if ($page == "position") {
                if ($action =="") {
                    include "page/position/table.php";
                }elseif($action == "edit"){
                    include "page/position/edit.php";
                }elseif($action == "add"){
                    include "page/position/add.php";
                }
            }elseif($page == "user"){
                if ($action == "") {
                    include "page/user/table.php";
                }
            }
            ?>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
<?php
include '../assets/assets/php/footer.php';
?>
</body>
<!-- END: Body-->


<div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="page/position/delete.php" method="get">
        <div class="modal-content">
            <div class="modal-header bg-danger white">
                <h4 class="modal-title white" id="myModalLabel10">are you sure you want to delete this position ?</h4>
                <input type="hidden" id="delete" name="id" value="">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>by deleting this position, the user in that position will also be deleted.</p>
                <input type="hidden" name="delete" value="" id="id">
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-outline-danger" value="Delete">
            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).on("click", ".delete", function () {
     var id = $(this).data('id');
     $(".modal-body #id").val(id);
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     $('#delete').modal('show');
});
</script>
</html>