    <!-- BEGIN: Main Menu-->

    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="<?php if ($page =="") { echo "active"; }else{echo "menu-item";} ?>"><a href="index.php"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a></li>
                    <!-- Anu -->
                    <?php
                    if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3 || $_SESSION['level_user'] == 4) {
                    ?>
                        <li class="nav-item has-sub"><a href="#"><i class="la la-toolbox"></i><span class="menu-title" data-i18n="Admin Panels">Admin Panels</span></a>
                            <ul class="menu-content">
                            <?php
                    if ($_SESSION['level_user'] == 1) {
                        ?>
                        <li class="<?php if ($page =="company") { echo "active"; }else{echo "menu-item";} ?>"><a href="?page=company"><i class="la la-building"></i><span class="menu-title" data-i18n="eCommerce">Company</span></a></li>
                    <?php
                    }
                    if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3) {
                    ?>
                    <li class="<?php if ($page =="position") { echo "active"; }else{echo "menu-item";} ?> "><a href="?page=position"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="eCommerce">Position</span></a></li>
                    <?php } 
                    if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3 || $_SESSION['level_user'] == 4) {
                    ?>
                    <li class="<?php if ($page =="user") { echo "active"; }else{echo "menu-item";} ?>"><a href="?page=user"><i class="la la-users"></i><span class="menu-title" data-i18n="eCommerce">User</span></a></li>
                    <?php } 
                    if ($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3) {
                    ?>
                    <li class="<?php if ($page =="segmentation") { echo "active"; }else{echo "menu-item";} ?>"><a href="?page=segmentation"><i class="la la-map-marked-alt"></i><span class="menu-title" data-i18n="eCommerce">Segmentation</span></a></li>
                    <?php 
                    }
                    ?>
            </ul>
        </li>
    <?php }
    ?>
            
                

            <li class="<?php if ($page =="task") { echo "active"; }else{echo "menu-item";} ?>"><a href="?page=task"><i class="la la-clipboard-list"></i><span class="menu-title" data-i18n="eCommerce">Task</span></a></li>
            </ul>
        </div>
    </div>

    <!-- END: Main Menu-->