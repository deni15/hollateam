<?php
session_start();
include '../../../db/conn.php';
$id = $_GET['delete'];
if ($_SESSION['level_user'] != 1) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to delete this company");
        window.location.href="../../index.php";   
    </script>
    <?php
}else{
    $updateuser = $koneksi->query("UPDATE `user` SET `company`='0',`status`='0' WHERE `company`='$id'");
    if ($updateuser) {
    $delete = $koneksi->query("DELETE FROM `tbl_company` WHERE `CID`='$id'");
    if ($delete) {
        
        ?>
        <script type="text/javascript">
            alert("Successfully deleted this company");
            window.location.href="../../index.php?page=company";   
        </script>
        <?php
    }else{
        echo $koneksi->error;
    }}else{
        echo $koneksi->error;
    }
}
?>