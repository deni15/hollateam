<?php
$query1=$koneksi->query("SELECT * FROM user_position WHERE pid='$id'");
$fetch1=$query1->fetch_assoc();
if ($_SESSION['level_user'] == 4 || $_SESSION['level_user'] == 5 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 3 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] == 2) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to edit this position");
        window.location.href="index.php";   
    </script>
    <?php
}
if ($_SESSION['level_user'] > $fetch1['level']) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to edit this position");
        window.location.href="index.php?page=position";   
    </script>
    <?php
}
if ($_SESSION['level_user'] == 1) {
    $query2=$koneksi->query("SELECT * FROM level");
}elseif ($_SESSION['level_user'] == 2) {
    $query2=$koneksi->query("SELECT * FROM level WHERE priority != '1'");
}elseif ($_SESSION['level_user'] == 3) {
    $query2=$koneksi->query("SELECT * FROM level WHERE priority != '1' AND priority != '2'");
}
?>
<div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Edit Position</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=position">Position List</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Position
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
                                <h4 class="card-title">Edit Position</h4>
                            </div>
                                <div class="card-body">
                                    <fieldset class="form-group">
                                        <label for="basicinput">Position Name</label>
                                        <input type="text" class="form-control" id="basicInput" name="name" value="<?php echo $fetch1['position_name']?>">
                                    </fieldset>
                                    <fieldset class="form-group">
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
                                                <select name="company" id="select1" class="select2 form-control">
                                                    <?php
                                                    echo $fetch1['company'];
                                                        while ($fetch2=$sqlcompany->fetch_assoc()) {
                                                            ?><option value="<?php echo $fetch2['CID']?>" <?php if($fetch1['company']==$fetch2['CID']){echo"selected";}?>><?php echo $fetch2['company_name']?></option><?php
                                                        }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        <?php
                                    }
                                    ?>
                                        <label for="basicinput">Level</label>
                                        <select name="level" id="select2" class="select2 form-control">
                                            <?php
                                                while ($fetch2=$query2->fetch_assoc()) {
                                                    ?><option value="<?php echo $fetch2['lid']?>" <?php if($fetch1['level']==$fetch2['lid']){echo"selected";}echo ">".$fetch2['level_name']?></option><?php
                                                }
                                            ?>
                                        </select>
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
    $level = $_POST['level'];
    $company = $_POST['company'];
    $update = $koneksi->query("UPDATE `user_position` SET `position_name`='$name',`level`='$level' WHERE pid='$id'");

    if ($update) {
        ?>
        <script type="text/javascript">
            alert("Update Successful");
            window.location.href="?page=position"
        </script>
        <?php
    }
}
?>