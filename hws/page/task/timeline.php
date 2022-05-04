<?php
$sqlremark = $koneksi->query("SELECT * FROM `task_remark` WHERE `task_no`='$id' ORDER BY time DESC");
?>

<section id="timeline" class="timeline-left timeline-wrapper">
        <h3 class="page-title text-center text-lg-left">Work Flow</h3>
        <ul class="timeline">
            <li class="timeline-line"></li>
        </ul>
        <ul class="timeline">
            <li class="timeline-line"></li>

            <?php
            while ($dataremark = $sqlremark->fetch_assoc()) {
            ?>
            <li class="timeline-item mt-1">
                <div class="timeline-card card border-grey border-lighten-2">
                    <div class="card-header">
                        <h4 class="card-title"><a href="#"><?php echo $dataremark['remark'] ?></a></h4>
                        <p class="card-subtitle text-muted pt-1">
                            <span class="font-small-3"><?php echo $dataremark['time'] ?></span>
                        </p>
                        <a class="heading-elements-toggle"><i class="la la-check font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse">
                        <div class="card-body row">
                            <div class="col-lg-6 col-12">
                                <div class="">
                                    <img src="../assets/assets/evidence/<?php echo $dataremark['pic'] ?>" alt="<?php echo $dataremark['description'] ?>" class="img-fluid" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card-content">
                                    <h3><?php echo $dataremark['remark'] ?></h3>
                                    <p><?php echo $dataremark['description'] ?></p>
                                </div>
                                <div class="card-footer px-0 py-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php } ?>
            <li class="timeline-item mt-1">
                <div class="timeline-card card border-grey border-lighten-2">
                    <div class="card-header">
                        <h4 class="card-title"><a href="#">Task Start</a></h4>
                        <p class="card-subtitle text-muted pt-1">
                            <span class="font-small-3"><?php echo $data['start'] ?></span>
                        </p>
                        <a class="heading-elements-toggle"><i class="la la-check font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse">
                        <div class="card-body row">
                            <div class="col-12">
                            <table class="table">
                                <tr role="row">
                                    <th width="5">TaskID</th>
                                    <th>Category</th>
                                    <th>Segmentation</th>
                                    <th>Engineer</th>
                                    <th>Target</th>
                                    <th>Description</th>
                                </tr>
                                <tr>
                                    <td><?php echo "HTT#".$data['tid'] ?></td>
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
                                    <td><?php echo $data['description'] ?></td>

                                </tr>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </li>