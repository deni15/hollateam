<?php
error_reporting(0);
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

</html>