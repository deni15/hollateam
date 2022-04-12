    <!-- BEGIN: Main Menu-->

    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="<?php if ($page =="") { echo "active"; }else{echo "nav-item";} ?>"><a href="index.php"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a></li>
            <!-- Anu -->
            <?php
            if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3 || $_SESSION['level_user'] == 4) {
            ?>
            <li class="navigation-header hover"><span>Admin Panel</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i></li>
            <?php }
            if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3) {
            ?>
            <li class="<?php if ($page =="position") { echo "active"; }else{echo "nav-item";} ?>"><a href="?page=position"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="eCommerce">Position</span></a></li>
            <?php } 
            if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3 || $_SESSION['level_user'] == 4) {
            ?>
            <li class="<?php if ($page =="user") { echo "active"; }else{echo "nav-item";} ?>"><a href="?page=user"><i class="la la-users"></i><span class="menu-title" data-i18n="eCommerce">User</span></a></li>
            <?php } ?>
            </ul>
        </div>
    </div>

    <!-- END: Main Menu-->