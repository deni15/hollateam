<?php
$query1=$koneksi->query("SELECT * FROM user_position WHERE pid='$id'");
$fetch1=$query1->fetch_assoc();
if ($fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] = 4 || $fetch1['company'] != $_SESSION['company'] && $_SESSION['level_user'] = 5) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to edit this position");
        window.location.href="index.php";   
    </script>
    <?php
}
$query2=$koneksi->query("SELECT * FROM level");
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