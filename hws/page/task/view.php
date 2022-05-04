<?php
$sql = $koneksi->query("SELECT * FROM `task` WHERE `tid`='$id'");
$data = $sql->fetch_assoc();
$sqlpic = $koneksi->query("SELECT * FROM `user` WHERE `id`='".$data['pic']."'");
$datapic = $sqlpic->fetch_assoc();
?>
<div class="content-header row">
                
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">View Task</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="?page=task">Task</a>
                                </li>
                                <li class="breadcrumb-item active">View Task
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="zoom: 1;">
                                <div class="card-header">
                                    <h4 class="card-title">View Task</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <form method="POST">
                                    <div class="card-body card-dashboard">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Task No</label>
                                                    <input type="text" class="form-control" value="<?php echo "HTT#".$data['tid'] ?>"disabled>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Task Category</label>
                                                    <input type="text" class="form-control" value="<?php echo $data['category'] ?>"disabled>
                                                </fieldset>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Segmentation</label>
                                                    <input type="text" class="form-control" value="<?php echo $data['segmentation'] ?>"disabled>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Engineer</label>
                                                    <input type="text" class="form-control" value="<?php echo $datapic['user'] ?>"disabled>
                                                </fieldset>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Start Time</label>
                                                    <input type="text" class="form-control" value="<?php echo $data['start'] ?>"disabled>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                <label for="basicinput">End Time</label>
                                                    <input type="text" class="form-control" value="<?php 
                                                    if ($data['end'] == "0000-00-00 00:00:00") {
                                                        echo "Task Still Open";
                                                    }else{
                                                        echo $data['end'];
                                                    }
                                                    ?>"disabled>
                                                </fieldset>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Target</label>
                                                    <input type="text" class="form-control" value="<?php if ($data['target'] == "after") {
                                                                echo "> ";
                                                            }else{
                                                                echo "< ";
                                                            }
                                                             echo $data['time'];?>"disabled>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                <label for="basicinput">Target Status</label>
                                                    <input type="text" class='form-control 
                                                    <?php
                                                    $date = new DateTime($data['start']);
                                                    $now = new DateTime();
                                                    $interval = $now->diff($date);
                                                    $anu = strtotime($data['time']);
                                                    if ($data['target'] == "after"){
                                                        if($interval->h >= date('H', $anu)){
                                                            echo "bg-success white ' value='In of Target ".$interval->h ." Hours' disabled>";
                                                        }else{
                                                            echo "bg-danger white ' value='Out of Target ".$interval->h ." Hours' disabled>";
                                                        }
                                                    }elseif($data['target'] == "before"){
                                                        if($interval->h >= date('H', $anu)){
                                                            echo "bg-danger white ' value='Out of Target ".$interval->h ." Hours' disabled>";
                                                        }else{
                                                            echo "bg-success white ' value='In of Target ".$interval->h ." Hours' disabled>";
                                                        }
                                                    }
                                                    ?>
                                                    </td>
                                                </fieldset>
                                            </div>  
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="basicinput">Description</label>
                                                    <textarea class="form-control" name="description" id="" cols="30" rows="1" disabled><?php echo $data['description'] ?></textarea>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

    <?php
    include "timeline.php";
    ?>