            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Position List</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item active">Position List
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
                                    <h4 class="card-title">Position List</h4>
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
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive"> 
                                                <table class="table table-striped table-bordered zero-configuration dataTable" id="dt" style="">
                                                <thead>
                                                    <tr role="row">
                                                        <th width="5">No</th>
                                                        <th>Position</th>
                                                        <th>Level</th>
                                                        <th width="150">Action</th>
                                                    </tr>   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $query = $koneksi->query("SELECT * FROM user_position WHERE company='".$_SESSION['company']."'");
                                                    while ($fetch = $query->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no++?></td>
                                                            <td><?php echo $fetch['position_name']?></td>
                                                            <td><?php
                                                                $querylevel = $koneksi->query("SELECT * FROM `level` WHERE `lid`='".$fetch['level']."'");
                                                                $fetchlevel = $querylevel->fetch_assoc();
                                                                echo $fetchlevel['level_name'];
                                                            ?></td>
                                                            <td style="text-align:center;">
                                                                <a class="btn btn-primary btn-sm"href="?page=position&action=edit&id=<?php echo base64_encode($fetch['pid']); ?>"><i class="la la-edit"></i> Edit</a>
                                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete"><i class="la la-trash"></i> Delete</a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" style="text-align:right;"><a class="btn btn-success btn-sm" href="?page=position&action=add"><i class="la la-plus"></i> Tambah Position</a></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
