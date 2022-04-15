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
        alert("You don't have access to add Segmentation");
        window.location.href="index.php";   
    </script>
    <?php
}
?>
<div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Add Segmentation</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=segmentation">Segmentation List</a>
                                </li>
                                <li class="breadcrumb-item active">Add Segmentation
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
                                <h4 class="card-title">Add Segmentation</h4>
                            </div>
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <label for="basicinput">Segmentation ID</label>
                                        <input type="text" class="form-control" id="basicInput" name="sid" value="" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Segmentation Name</label>
                                        <input type="text" class="form-control" id="basicInput" name="name" value="">
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Address</label>
                                        <textarea name="address" class="form-control" cols="30" rows="5"></textarea>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">longitude</label>
                                        <input type="text" class="form-control" id="basicInput" name="long" value="">
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">latitude</label>
                                        <input type="text" class="form-control" id="basicInput" name="lat" value="">
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
                                        <label for="basicinput">Description</label>
                                        <input type="text" class="form-control" id="basicInput" name="description" value="">
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
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $long = $_POST['long'];
    $lat = $_POST['lat'];
    $company = $_POST['company'];
    $description = $_POST['description'];

    $insert = $koneksi->query("INSERT INTO `tbl_segmenation`(`sid`, `s_name`, `s_address`, `s_long`, `s_lat`, `company`, `s_description`) VALUES ('$sid','$name','$address','$long','$lat','$company','$description')");
    if ($insert) {
        ?>
        <script type="text/javascript">
            alert("Add Successful");
            window.location.href="?page=segmentation"
        </script>
        <?php
    }
}
?>