<?php
$query2=$koneksi->query("SELECT * FROM `user_position` WHERE `level`>=".$_SESSION['level_user']." ORDER BY level ASC");
if ($_SESSION['level_user'] == 4 || $_SESSION['level_user'] == 5) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to add position");
        window.location.href="index.php";   
    </script>
    <?php
}
?>
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Add User</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=position">User List</a>
                                </li>
                                <li class="breadcrumb-item active">Add User
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
                                <h4 class="card-title">Add User</h4>
                            </div>
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <label for="basicinput">Name</label>
                                        <input type="text" class="form-control" id="basicInput" name="name" value="">
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Username</label>
                                        <input type="text" class="form-control" id="basicInput" name="username" value="">
                                    </fieldset>
                                    <?php
                                    if ($_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3) {
                                        $sqlcompany = $koneksi->query("SELECT * FROM tbl_company WHERE CID='".$_SESSION['company']."'");
                                        $datacompany = $sqlcompany->fetch_assoc();
                                        ?>
                                        <fieldset class="form-group">
                                            <label for="basicinput">Company</label>
                                            <input type="text" class="form-control" id="basicInput" value="<?php echo $datacompany['company_name'] ?>" disabled>
                                            <input type="hidden" name="company" value="<?php echo $_SESSION['company'] ?>">
                                        </fieldset>
                                        <?php
                                    }else{
                                        $sqlcompany = $koneksi->query("SELECT * FROM tbl_company");
                                        ?>
                                            <fieldset class="form-group">
                                                <label for="basicinput">Company Name</label>
                                                <select name="company" id="select2" class="select2 form-control">
                                                    <?php
                                                        while ($fetch2=$sqlcompany->fetch_assoc()) {
                                                            ?><option value="<?php echo $fetch2['CID']?>"><?php echo $fetch2['company_name']?></option><?php
                                                        }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        <?php
                                    }
                                    ?>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Position</label>
                                        <select name="position" id="select1" class="select2 form-control">
                                            <?php
                                                while ($fetch2=$query2->fetch_assoc()) {
                                                    ?><option value="<?php echo $fetch2['pid']?>"><?php echo $fetch2['position_name']?></option><?php
                                                }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Description</label>
                                        <textarea name="description" id="" class="form-control" cols="30" rows="5"></textarea>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input class="form-control" type="password" name="password">
                                            <div class="input-group-addon">
                                                <a href=""><i class="la la-eye-slash" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </fieldset>
                                    </div>
                                </div>
                                <div class="card-footer">
                                        <input type="submit" value="Submit" name="add" class="btn btn-primary float-right" style="margin-top: -10px; margin-bottom: 10px;">
                                </div>
                            </div>
                        </div>
                    </form>
            </div>

<?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $company = $_POST['company'];
    $position = $_POST['position'];
    $description = $_POST['description'];
    $password = md5($_POST['password']);

$tambah = $koneksi->query("INSERT INTO `user`(`id`, `user`, `pass`, `name`, `description`, `position`, `company`, `status`) VALUES ('','$username','$password','$name','$description','$position','$company','1')");

if ($tambah) {
    ?>
        <script type="text/javascript">
            alert("Add Successful");
            window.location.href="?page=user"
        </script>
        <?php
}
}
?>