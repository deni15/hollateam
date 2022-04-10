    <!-- BEGIN: Main Menu-->

    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="<?php if ($page =="") { echo "active"; }else{echo "nav-item";} ?>"><a href="index.php"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce">Dashboard</span></a></li>
            <!-- Anu -->
            <li class="navigation-header hover"><span>Admin Panel</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Apps"></i></li>
            <li class="<?php if ($page =="position") { echo "active"; }else{echo "nav-item";} ?>"><a href="?page=position"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="eCommerce">Position</span></a></li>
            </ul>
        </div>
    </div>

    <!-- END: Main Menu-->