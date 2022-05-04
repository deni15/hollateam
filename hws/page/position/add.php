<?php
if ($_SESSION['level_user'] == 1) {
    $query2=$koneksi->query("SELECT * FROM level");
}elseif ($_SESSION['level_user'] == 2) {
    $query2=$koneksi->query("SELECT * FROM level WHERE priority != '1'");
}elseif ($_SESSION['level_user'] == 3) {
    $query2=$koneksi->query("SELECT * FROM level WHERE priority != '1' AND priority != '2'");
}

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
                    <h3 class="content-header-title">Add Position</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=position">Position List</a>
                                </li>
                                <li class="breadcrumb-item active">Add Position
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
                                <h4 class="card-title">Add Position</h4>
                            </div>
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <label for="basicinput">Position Name</label>
                                        <input type="text" class="form-control" id="basicInput" name="name" value="">
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
                                        $sqlcompany = $koneksi->query("SELECT * FROM tbl_company WHERE CID!=0");
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
                                        <label for="basicinput">Level</label>
                                        <select name="level" id="select1" class="select2 form-control">
                                            <?php
                                                while ($fetch2=$query2->fetch_assoc()) {
                                                    ?><option value="<?php echo $fetch2['lid']?>"><?php echo $fetch2['level_name']?></option><?php
                                                }
                                            ?>
                                        </select>
                                    </fieldset>
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
    $level = $_POST['level'];
    $company = $_POST['company'];
    $update = $koneksi->query("INSERT INTO `user_position`(`position_name`, `company`, `level`) VALUES ('$name','$company','$level')");

    if ($update) {
        ?>
        <script type="text/javascript">
            alert("Add Successful");
            window.location.href="?page=position"
        </script>
        <?php
    }
}
?>