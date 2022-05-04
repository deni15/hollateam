<?php
$query1=$koneksi->query("SELECT * FROM `user` INNER JOIN user_position on user_position.pid=user.position WHERE user.id='$id'");
$fetch1=$query1->fetch_assoc();
if ( $_SESSION['level_user'] == 5 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 3 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 2) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to edit this user");
        window.location.href="index.php?page=user";   
    </script>
    <?php
}
if ($_SESSION['level_user'] == 1) {
    $query2=$koneksi->query("SELECT * FROM `user_position` WHERE `level`>='".$_SESSION['level_user']."' AND pid !=0 ORDER BY level ASC");
}elseif ($_SESSION['level_user'] == 2) {
    $query2=$koneksi->query("SELECT * FROM `user_position` WHERE `level`>='".$_SESSION['level_user']."' AND pid !=0  ORDER BY level ASC");
}elseif ($_SESSION['level_user'] == 3 || $_SESSION['level_user'] == 4) {
    $query2=$koneksi->query("SELECT * FROM `user_position` WHERE `level`>='".$_SESSION['level_user']."' AND pid !=0 ORDER BY level ASC");
}
?>
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Edit User</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=position">User List</a>
                                </li>
                                <li class="breadcrumb-item active">Edit User
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <form method="post">
                        <div class="card-content">
                            <div class="card-header">
                                <h4 class="card-title">Edit User</h4>
                            </div>
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <label for="basicinput">Name</label>
                                        <input type="text" class="form-control" id="basicInput" name="name" value="<?php echo $fetch1['name'] ?>" disabled>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Username</label>
                                        <input type="text" class="form-control" id="basicInput" name="username" value="<?php echo $fetch1['user'] ?>" disabled>
                                    </fieldset>
                                    <?php
                                        $sqlcompany = $koneksi->query("SELECT * FROM tbl_company WHERE CID='".$_SESSION['company']."'");
                                        $datacompany = $sqlcompany->fetch_assoc();
                                        ?>
                                        <fieldset class="form-group">
                                            <label for="basicinput">Company</label>
                                            <input type="text" class="form-control" id="basicInput" value="<?php echo $datacompany['company_name'] ?>" disabled>
                                            <input type="hidden" name="company" value="<?php echo $_SESSION['company'] ?>">
                                        </fieldset>
                                        <?php
                                    ?>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Position</label>
                                        <?php
                                        $fetch2=$query2->fetch_assoc();
                                        ?>
                                        <input type="text" class="form-control" value="<?php echo $fetch2['position_name']?>" disabled>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Description</label>
                                        <textarea name="description" class="form-control" cols="30" rows="5" disabled><?php echo $fetch1['description']?></textarea>
                                    </fieldset>
                                    
                                    </div>
                                </div>
                                <div class="card-footer">
                                        <a onclick="history.go(-1);" class="btn btn-default float-right" style="margin-top: -10px; margin-bottom: 10px;"><i class="la la-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
