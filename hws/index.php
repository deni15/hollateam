<?php
session_start();
if (!isset($_SESSION['hollauser'])) {
    ?>
    <script type="text/javascript">
        window.location.href="login.php"
    </script>
    <?php
}
?>
