<?php
session_start();
include '../../../db/conn.php';
$id = $_GET['reset'];
$query1=$koneksi->query("SELECT * FROM user WHERE id='$id'");
$fetch1=$query1->fetch_assoc();
if ($_SESSION['level_user'] == 5 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 4 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 3 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 2) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to reset password this user");
        window.location.href="../../index.php";   
    </script>
    <?php
}elseif ($_SESSION['level_user'] > $fetch1['level']) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to reset password this user");
        window.location.href="../../index.php?page=user";   
    </script>
    <?php
}else{
    $reset = $koneksi->query("UPDATE `user` SET `pass`='".md5("Holla*123!")."' WHERE `id`='$id'");
    if ($reset) {
        ?>
        <script type="text/javascript">
            alert("Successfully Reset Password this User");
            window.location.href="../../index.php?page=user";   
        </script>
        <?php
    }else{
        echo $koneksi->error;
    }
}
?>