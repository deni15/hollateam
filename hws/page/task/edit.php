<?php
$query1=$koneksi->query("SELECT * FROM `tbl_company` WHERE `CID`='$id'");
$fetch1=$query1->fetch_assoc();
if ($_SESSION['level_user'] != 1) {
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
                    <h3 class="content-header-title">Edit Company</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=position">Position List</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Company
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
                                <h4 class="card-title">Edit Company</h4>
                            </div>
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <label for="basicinput">Company Name</label>
                                        <input type="text" class="form-control" id="basicInput" name="name" value="<?php echo $fetch1['company_name']?>">
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
    $name = $_POST['name'];
    $update = $koneksi->query("UPDATE `tbl_company` SET `company_name`='$name' WHERE `CID`='$id'");

    if ($update) {
        ?>
        <script type="text/javascript">
            alert("Update Successful");
            window.location.href="?page=company"
        </script>
        <?php
    }
}
?>