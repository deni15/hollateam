<?php
include '../db/conn.php';
session_start();
$title = "Login to Holla Workforce System";
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php
include '../assets/assets/php/header.php';
?>
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu horizontal-menu-padding 1-column   blank-page" data-open="click" data-menu="horizontal-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content container center-layout mt-2">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1"><img src="../assets/app-assets/images/logo/logo-dark.png" alt="branding logo"></div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login with Modern</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST" class="form-horizontal form-simple" novalidate>
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text" name="username" class="form-control" id="user-name" placeholder="Your Username" required>
                                                <div class="form-control-position">
                                                    <i class="la la-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name="password" class="form-control" id="user-password" placeholder="Enter Password" required>
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            
                                            <button type="submit" name="login" class="btn btn-info btn-block"><i class="ft-unlock"></i> Login</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="">
                                        <p class="float-xl-left text-center m-0"><a href="recover-password.html" class="card-link">Recover
                                                password</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../assets/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../assets/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../assets/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="../assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../assets/app-assets/js/core/app-menu.js"></script>
    <script src="../assets/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../assets/app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = $koneksi->query("SELECT * FROM `user` WHERE `user`='$username' AND `pass`='$password'");
    $count = mysqli_num_rows($sql);
    if ($count > 0) {
        $data = $sql->fetch_assoc();
        $_SESSION['hollauser'] = $data['user'];
        $_SESSION['company'] = $data['company'];
        $_SESSION['position'] = $data['position'];

        ?>
        <script type="text/javascript">
        alert("Login Sukses");
            window.location.href="index.php";
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
        alert("Login Gagal");
        </script>
        <?php
    }
}
?>