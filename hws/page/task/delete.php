<?php
session_start();
include '../../../db/conn.php';
$id = $_GET['delete'];
if ($_SESSION['level_user'] != 4) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to delete this task");
        window.location.href="../../index.php";   
    </script>
    <?php
}else{
    $delete = $koneksi->query("DELETE FROM `task`  WHERE `tid`='$id'");
    if ($delete) {
        
        ?>
        <script type="text/javascript">
            alert("Successfully deleted this task");
            window.location.href="../../index.php?page=task";   
        </script>
        <?php
    }else{
        echo $koneksi->error;
    }
}
?>