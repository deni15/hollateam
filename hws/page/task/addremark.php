<?php
$tid = base64_decode($_GET['tid']);
$sql = $koneksi->query("SELECT * FROM `task` WHERE `tid`='$tid'");
$data = $sql->fetch_assoc();
?>

<div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="zoom: 1;">
                                <div class="card-header">
                                    <h4 class="card-title">Task Open List</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <table class="table">
                                                <tr role="row">
                                                    <th width="5">TaskID</th>
                                                    <th>Category</th>
                                                    <th>Segmentation</th>
                                                    <th>Engineer</th>
                                                    <th>Target</th>
                                                    <th>Start</th>
                                                    <th>Aging</th>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $data['tid'] ?></td>
                                                    <td><?php echo $data['category'] ?></td>
                                                    <td><?php echo $data['segmentation'] ?></td>
                                                    <td><?php 
                                                    $sqlpic = $koneksi->query("SELECT * FROM `user` WHERE `id`='".$data['pic']."'");
                                                    $datapic=$sqlpic->fetch_assoc();
                                                    echo $datapic['user'];
                                                     
                                                     ?></td>
                                                    <td>
                                                    <?php 
                                                        if ($data['target'] == "after") {
                                                            echo ">";
                                                        }else{
                                                            echo "<";
                                                        }
                                                            echo $data['time'];
                                                    ?>
                                                    </td>
                                                    <td><?php echo $data['start'] ?></td>
                                                    <?php
                                                        $date = new DateTime($data['start']);
                                                        $now = new DateTime();
                                                        $interval = $now->diff($date);
                                                        $anu = strtotime($data['time']);
                                                    ?>
                                                    
                                                    <td 
                                                    <?php
                                                    if ($data['target'] == "after"){
                                                        if($interval->h >= date('H', $anu)){
                                                            echo "class='bg-success white'";
                                                        }else{
                                                            echo "class='bg-danger white'";
                                                        }
                                                    }elseif($data['target'] == "before"){
                                                        if($interval->h >= date('H', $anu)){
                                                            echo "class='bg-danger white'";
                                                        }else{
                                                            echo "class='bg-success white'";
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                        <?php 
                                                            echo $interval->h ." Hours";
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                            <br>
                                            <div class="row">
                                                <div class="col-12">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <fieldset class="form-group">
                                                        <label for="basicinput">Action</label>
                                                        <select name="action" id="basicinput" class="form-control">
                                                            <option value="Update">Update</option>
                                                            <option value="Close">Close</option>
                                                        </select>
                                                        </fieldset> 
                                                        <fieldset class="form-group">
                                                            <label for="basicinput">Date Time</label>
                                                            <input type="datetime-local" class="form-control" id="basicinput" name="date">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicinput">Evidence</label>
                                                            <input type="file" name="berkas" class="form-control" id="basicinput" >
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicinput">Remark</label>
                                                            <textarea name="remark" name="remark" rows="3" class="form-control"></textarea>
                                                        </fieldset>
                                                        <div class="float-right">
                                                            <button type="reset" class="btn btn-danger ">
                                                                <i class="la la-refresh"></i>
                                                                Reset
                                                            </button>
                                                            <button type="submit" class="btn btn-info" name="submit">
                                                                <i class="la la-save"></i>
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

<?php
if (isset($_POST['submit'])) {
    $action = $_POST['action'];
    $date = $_POST['date'];
    $remark = $_POST['remark'];
    $namaFile = $_FILES['berkas']['name'];
    $filetype = $_FILES['berkas']['type'];
    $namaSementara = $_FILES['berkas']['tmp_name'];
    $dirUpload = "C:/xampp/htdocs/hollateam/assets/assets/evidence/";
    $newfile = rand().$_FILES['berkas']['name'];
    
    $allowed = array("image/jpeg", "image/gif", "image/png");
    if (in_array($filetype,$allowed)) {
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$newfile);
        if ($terupload) {
            $insert = $koneksi->query("INSERT INTO `task_remark`(`task_no`, `action`, `time`, `remark`, `pic`) VALUES ('$tid','$action','$date','$remark','$newfile')");
            if ($insert) {
                if ($action == "Close") {
                    $koneksi->query("UPDATE `task` SET `end`='$date',`status`='0' WHERE `tid`='$tid'");
                }
                ?>
                <script type="text/javascript">
                    alert("Update Successful");
                    window.location.href="?page=task"
                </script>
                <?php
            }else{
                ?>
                <script type="text/javascript">
                    alert("Failed to insert");
                </script>
                <?php
            }
        }else{
            ?>
                <script type="text/javascript">
                    alert("Failed to upload");
                </script>
                <?php
        }
}else{
    ?>
                <script type="text/javascript">
                    alert("Only Images Allowed");
                </script>
                <?php
}
}
?>