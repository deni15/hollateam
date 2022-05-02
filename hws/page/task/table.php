<?php

$selectuser = $koneksi->query("SELECT * FROM `user` INNER JOIN user_position ON user_position.pid=user.position WHERE user_position.level=5 AND user.company='".$_SESSION['company']."'");
$selectsegment = $koneksi->query("SELECT * FROM `tbl_segmenation` WHERE `company`='".$_SESSION['company']."'");
?>
<div class="content-header row">
                
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="zoom: 1;">
                                <div class="card-header">
                                    <h4 class="card-title">Add Task</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse">
                                    <form method="POST">
                                    <div class="card-body card-dashboard">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Start Time</label>
                                                    <input type="datetime-local" class="form-control" name="starttime">
                                                </fieldset>
                                            </div>
                                            <div class="col-md-4">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Segmentation ID</label>
                                                <select class="form-control" style="width:100%;" name="segment" id="select1" >
                                                        <?php
                                                        while ($datasegment = $selectsegment->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $datasegment['sid'] ?>"><?php echo $datasegment['sid'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-4">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Target</label>
                                                <select name="target" id="" class="form-control">
                                                    <option value="Normal">Before</option>
                                                    <option value="Corrective">After</option>
                                                </select>
                                                </fieldset>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Category</label>
                                                    <select name="category" id="" class="form-control">
                                                        <option value="Normal">Normal</option>
                                                        <option value="Corrective">Corrective Maintenance</option>
                                                        <option value="Preventive">Preventive Maintenance</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-4">
                                            <label for="basicinput">Engineer</label>
                                                <fieldset class="form-group">
                                                <select class="form-control" style="width:100%;" name="engineer" id="select2" >
                                                        <?php
                                                        while ($datauser = $selectuser->fetch_assoc()) {
                                                            ?>
                                                            <option value="<?php echo $datauser['id'] ?>"><?php echo $datauser['user'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-4">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Target Time</label>
                                                    <input type="time" name="targettime" class="form-control">
                                                </fieldset>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="basicinput">Description</label>
                                                    <textarea class="form-control" name="description" id="" cols="30" rows="5" ></textarea>
                                            </div>
                                            </div>
                                        </div>
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
                                                    <br>
                                                    <br>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
<?php
if (isset($_POST['submit'])) {
    $starttime = $_POST['starttime'];
    $category = $_POST['category'];
    $segment = $_POST['segment'];
    $engineer = $_POST['engineer'];
    $target = $_POST['target'];
    $targettime = $_POST['targettime'];
    $description = $_POST['description'];

    $insert = $koneksi->query("INSERT INTO `task`(`category`, `segmentation`, `pic`, `target`, `time`, `start`, `end`, `description`, `status`) VALUES ('$category','$segment','$engineer','$target','$targettime','$starttime','','$description','1')");

    if ($insert) {
        ?>
        <script type="text/javascript">
            alert("Add Task Successfully");
            window.location.href="?page=task"
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
            alert("Add Task Failed");
            window.location.href="?page=task"
        </script>
        <?php
    }
}
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
                                <?php
                                if ($_SESSION['level_user'] != 5 ) {
                                ?>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive"> 
                                                <table class="table table-striped table-bordered zero-configuration dataTable" id="dt" style="">
                                                <thead>
                                                    <tr role="row">
                                                        <th width="5">TaskID</th>
                                                        <th>Category</th>
                                                        <th>Segmentation</th>
                                                        <th>Engineer</th>
                                                        <th>Target</th>
                                                        <th>Start</th>
                                                        <th>Last Update</th>
                                                        <th>Action</th>
                                                    </tr>   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                        $query = $koneksi->query("SELECT * FROM `task` WHERE `status`!='0' ORDER BY tid DESC");
                                                    while ($fetch = $query->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo "HTT#"; echo $fetch['tid']?></td>
                                                            <td><?php 
                                                            if ($fetch['category'] == "Corrective") {
                                                                echo "CM";
                                                            }elseif ($fetch['category'] == "Preventive") {
                                                                Echo "PM";
                                                            }else{
                                                                echo "NORM";
                                                            }
                                                            ?></td>
                                                            <td><?php echo $fetch['segmentation'] ?></td>
                                                            <td><?php
                                                            $sqlpic = $koneksi->query("SELECT * FROM user WHERE id='".$fetch['pic']."'");
                                                            $datapic = $sqlpic->fetch_assoc();
                                                            echo $datapic['user'];
                                                            ?></td>
                                                            <td><?php 
                                                            if ($fetch['target'] == "after") {
                                                                echo ">";
                                                            }else{
                                                                echo "<";
                                                            }
                                                             echo $fetch['time'];
                                                            ?></td>
                                                            <td><?php echo $fetch['start'] ?></td>
                                                            <td><?php 
                                                            $sqlupdate = $koneksi->query("SELECT * FROM `task_remark` WHERE `task_no`='".$fetch['tid']."' ORDER BY `id` DESC LIMIT 1");
                                                            $dataupdate = $sqlupdate->fetch_assoc();
                                                            if (isset($dataupdate['remark'])) {
                                                                echo $dataupdate['time']. " ".$dataupdate['remark'];
                                                            }else{
                                                                "";
                                                            }
                                                            ?> <a class="btn btn-sm btn-info" href="?page=task&action=remark&tid=<?php echo base64_encode($fetch['tid']) ?>" target="_blank"><i class="la la-plus"></i></a></td>
                                                            <td>
                                                            <div class="dropdown">
                                                                <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="la la-cogs"></i>
                                                                Action
                                                                </a>

                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item"href="?page=task&action=view&id=<?php echo base64_encode($fetch['tid']); ?>"><i class="la la-eye"></i> View</a>
                                                                    <a class="dropdown-item delete" data-toggle="modal" data-id="<?php echo $fetch['tid']; ?>"><i class="la la-trash"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                       <th></th> 
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
