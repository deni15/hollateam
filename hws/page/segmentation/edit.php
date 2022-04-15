<?php
$query1=$koneksi->query("SELECT * FROM `tbl_segmenation` WHERE `sid`='$id'");
$fetch1=$query1->fetch_assoc();
if ($_SESSION['level_user'] == 4 || $_SESSION['level_user'] == 5 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 3 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 2) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to edit this position");
        window.location.href="index.php";   
    </script>
    <?php
}

?>
<div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Edit Segmentation</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=segmentation">Segmentation List</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Segmentation
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
                                <h4 class="card-title">Edit Segmentation</h4>
                            </div>
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <label for="basicinput">Segmentation ID</label>
                                        <input type="text" class="form-control" id="basicInput" name="sid" value="<?php echo $fetch1['sid'] ?>" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Segmentation Name</label>
                                        <input type="text" class="form-control" id="basicInput" name="name" value="<?php echo $fetch1['s_name'] ?>">
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Address</label>
                                        <textarea name="address" class="form-control" cols="30" rows="5"><?php echo $fetch1['s_address'] ?></textarea>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">longitude</label>
                                        <input type="text" class="form-control" id="basicInput" name="long" value="<?php echo $fetch1['s_long'] ?>">
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">latitude</label>
                                        <input type="text" class="form-control" id="basicInput" name="lat" value="<?php echo $fetch1['s_lat'] ?>">
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
                                                            ?><option value="<?php echo $fetch2['CID']?>"<?php if($fetch1['company']==$fetch2['CID']){echo"selected";}?>><?php echo $fetch2['company_name']?></option><?php
                                                        }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        <?php
                                    }
                                    ?>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Description</label>
                                        <input type="text" class="form-control" id="basicInput" name="description" value="<?php echo $fetch1['s_description'] ?>">
                                    </fieldset>
                                </div>
                                <div class="card-footer">
                                        <input type="submit" value="Submit" name="edit" class="btn btn-primary float-right" style="margin-top: -10px; margin-bottom: 10px;">
                                </div>
                            </div>
                        </div>
                    </form>
            </div>

<?php
if (isset($_POST['edit'])) {
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $long = $_POST['long'];
    $lat = $_POST['lat'];
    $company = $_POST['company'];
    $description = $_POST['description'];

    $update = $koneksi->query("UPDATE `tbl_segmenation` SET `sid`='$sid',`s_name`='$name',`s_address`='$address',`s_long`='$long',`s_lat`='$lat',`company`='$company',`s_description`='$description' WHERE sid='$id'");

    if ($update) {
        ?>
        <script type="text/javascript">
            alert("Update Successful");
            window.location.href="?page=segmentation"
        </script>
        <?php
    }
}
?>