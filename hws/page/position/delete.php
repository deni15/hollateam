<?php
session_start();
include '../../../db/conn.php';
$id = $_GET['delete'];
$query1=$koneksi->query("SELECT * FROM user_position WHERE pid='$id'");
$fetch1=$query1->fetch_assoc();
if ($fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 4 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 5) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to delete this position");
        window.location.href="../../index.php";   
    </script>
    <?php
}else{
    $delete = $koneksi->query("DELETE FROM `user_position` WHERE `pid`='$id'");
    if ($delete) {
        ?>
        <script type="text/javascript">
            alert("Successfully deleted this position");
            window.location.href="../../index.php?page=position";   
        </script>
        <?php
    }else{
        echo $koneksi->error;
    }
}
?>