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
                                        <input type="text" class="form-control" id="basicInput" name="sid" value="<?php echo $fetch1['sid'] ?>" disabled>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Segmentation Name</label>
                                        <input type="text" class="form-control" id="basicInput" name="name" value="<?php echo $fetch1['s_name'] ?>" disabled>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">Address</label>
                                        <textarea name="address" class="form-control" cols="30" rows="5" disabled><?php echo $fetch1['s_address'] ?></textarea>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">longitude</label>
                                        <input type="text" class="form-control" id="basicInput" name="long" value="<?php echo $fetch1['s_long'] ?>" disabled>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="basicinput">latitude</label>
                                        <input type="text" class="form-control" id="basicInput" name="lat" value="<?php echo $fetch1['s_lat'] ?>" disabled>
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
                                        <label for="basicinput">Description</label>
                                        <input type="text" class="form-control" id="basicInput" name="description" value="<?php echo $fetch1['s_description'] ?>" disabled>
                                    </fieldset>
                                </div>
                                <div class="card-footer">
                                        <a onclick="history.go(-1);" class="btn btn-default float-right" style="margin-top: -10px; margin-bottom: 10px;"><i class="la la-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
