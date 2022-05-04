<?php
error_reporting(0);
include '../db/conn.php';
date_default_timezone_set("Asia/Bangkok");
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
<body class="vertical-layout vertical-compact-menu 2-columns   fixed-navbar " data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

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
                }elseif ($action == "add") {
                    include "page/user/add.php";
                }elseif ($action == "resign") {
                    include "page/user/resign.php";
                }elseif ($action == "reactive") {
                    include "page/user/reactive.php";
                }elseif ($action == "edit") {
                    include "page/user/edit.php";
                }elseif ($action == "view") {
                    include "page/user/view.php";
                }
            }elseif ($page == "segmentation") {
                if ($action == "") {
                    include "page/segmentation/table.php";
                }elseif ($action == "add") {
                    include "page/segmentation/add.php";
                }elseif ($action == "edit") {
                    include "page/segmentation/edit.php";
                }elseif ($action == "view") {
                    include "page/segmentation/view.php";
                }
            }elseif ($page == "company") {
                if ($action == "") {
                    include "page/company/table.php";
                }elseif ($action == "add") {
                    include "page/company/add.php";
                }elseif ($action == "edit") {
                    include "page/company/edit.php";
                }elseif ($action == "view") {
                    include "page/company/view.php";
                }
            }elseif ($page == "task") {
                if ($action == "") {
                    include "page/task/table.php";
                }elseif ($action == "remark") {
                    include "page/task/addremark.php";
                }elseif ($action == "view") {
                    include "page/task/view.php";
                }
            }
            elseif($page== ""){
                
            }else{
                ?>
                    <script type="text/javascript">
                        window.location.href="index.php"
                    </script>
                <?php
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

<?php
if ($page == "position") {
    include "page/position/modal.php";
}elseif ($page == "user"){
    include "page/user/modal.php";
}elseif ($page == "segmentation"){
    include "page/segmentation/modal.php";
}elseif ($page == "company"){
    include "page/company/modal.php";
}elseif ($page == "task"){
    include "page/task/modal.php";
}
?>
<script type="text/javascript">
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "la-eye-slash" );
            $('#show_hide_password i').removeClass( "la-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "la-eye-slash" );
            $('#show_hide_password i').addClass( "la-eye" );
        }
    });
});</script>
</html>