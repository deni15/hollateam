<?php
session_start();
session_destroy();
?>
<script type="text/javascript">
alert("logout berhasil");
window.location.href="login.php"
</script>