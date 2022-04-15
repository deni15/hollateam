<?php
session_start();
include '../../../db/conn.php';
$id = $_GET['delete'];
$query1=$koneksi->query("SELECT * FROM `tbl_segmenation` WHERE `sid`='$id'");
$fetch1=$query1->fetch_assoc();
if ($fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 2 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 3 || $_SESSION['level_user'] == 4 || $_SESSION['level_user'] == 5) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to delete this Segmentation");
        window.location.href="../../index.php";   
    </script>
    <?php
}else{
    $delete = $koneksi->query("DELETE FROM `tbl_segmenation` WHERE `sid`='$id'");
    if ($delete) {
        ?>
        <script type="text/javascript">
            alert("Successfully deleted this Segmentation");
            window.location.href="../../index.php?page=segmentation";   
        </script>
        <?php
    }else{
        echo $koneksi->error;
    }
}
?>