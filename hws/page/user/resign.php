<?php
include '../db/conn.php';
$id = $_GET['resign'];
$query1=$koneksi->query("SELECT * FROM `user` INNER JOIN user_position on user_position.pid=user.position WHERE user.id='$id'");
$fetch1=$query1->fetch_assoc();
if ($fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 4 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 5) {
    ?>
    <script type="text/javascript">
        alert("You cant change this user status");
        window.location.href="index.php";   
    </script>
    <?php
}elseif ($_SESSION['level_user'] > $fetch1['level']) {
    ?>
    <script type="text/javascript">
        alert("You cant change this user status");
        window.location.href="index.php?page=user";   
    </script>
    <?php
}else{
    $resign = $koneksi->query("UPDATE `user` SET `status`='0' WHERE id='$id'");
    if ($resign) {
        ?>
        <script type="text/javascript">
            alert("Successfully change status this user");
            window.location.href="index.php?page=user";   
        </script>
        <?php
    }else{
        echo $koneksi->error;
    }
}
?>