<?php
if ($_SESSION['level_user'] == 5) {
    ?>
    <script type="text/javascript">
        alert("You don't have access to  this page");
        window.location.href="index.php";   
    </script>
    <?php
}
?>
            <div class="content-header row">
                
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">User List</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item active">User List
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
                                    <h4 class="card-title">User List</h4>
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
                                                        <th>Name</th>
                                                        <th>Username</th>
                                                        <th>Description</th>
                                                        <th>Position</th>
                                                        <?php
                                                        if ($_SESSION['level_user']==1) {
                                                        echo"<th>Company</th>";
                                                        }
                                                        ?>
                                                        <th>Status</th>
                                                        <th width="150">Action</th>
                                                    </tr>   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    if ($_SESSION['level_user'] == 1) {
                                                        $query = $koneksi->query("SELECT * FROM user ORDER BY `status` ASC");
                                                    }elseif ($_SESSION['level_user'] == 4) {
                                                        $query = $koneksi->query("SELECT * FROM `user` INNER JOIN user_position ON user.position = user_position.pid WHERE (user_position.level=5) AND user.company='".$_SESSION['company']."' ORDER BY `status` ASC,position");
                                                    }else {
                                                        $query = $koneksi->query("SELECT * FROM `user` INNER JOIN user_position ON user.position = user_position.pid WHERE (user_position.level!=1) AND user.company='".$_SESSION['company']."' ORDER BY `status` ASC,position");
                                                    }
                                                    
                                                    while ($fetch = $query->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no++?></td>
                                                            <td><?php echo $fetch['name']?></td>
                                                            <td><?php echo $fetch['user'] ?></td>
                                                            <td><?php echo $fetch['description'] ?></td>
                                                            <td><?php 
                                                            $sqlposition = $koneksi->query("SELECT * FROM `user_position` WHERE `pid`='".$fetch['position']."'");
                                                            $fetchposition = $sqlposition->fetch_assoc();
                                                            echo $fetchposition['position_name'];
                                                            ?></td>
                                                            <?php
                                                            if ($_SESSION['level_user']==1) {
                                                            ?>
                                                            <td>
                                                            <?php
                                                            $sqlcompany = $koneksi->query("SELECT * FROM `tbl_company` WHERE `CID`='".$fetch['company']."'");
                                                            $fetchcompany = $sqlcompany->fetch_assoc();
                                                            echo $fetchcompany['company_name'];
                                                            ?></td>
                                                                <?php }
                                                                if ($fetch['status']==1) {
                                                                    echo"<td class='bg-success white'>";
                                                                    Echo "Aktif";
                                                                    echo "</td>";
                                                                }else{
                                                                    echo"<td class='bg-danger white'>";
                                                                    Echo "Tidak Aktif";
                                                                    echo "</td>";
                                                                }
                                                                ?>
                                                            <td style="text-align:center;">
                                                            <?php
                                                            if ($_SESSION['level_user'] != 4) {
                                                            ?>
                                                                <a class="btn btn-primary btn-sm white"href="?page=user&action=edit&id=<?php echo base64_encode($fetch['id']); ?>"><i class="la la-edit"></i> Edit</a>
                                                                <?php
                                                                    if ($fetch['status']==1) {
                                                                ?>
                                                                    <a href="?page=user&action=resign&resign=<?php echo $fetch['id']; ?>" class="btn btn-danger btn-sm deleteuser white" onclick="return confirm('Are you sure?');"><i class="la la-remove"></i> Resign</a>
                                                                <?php
                                                                    }else{
                                                                ?>

                                                                        <a href="?page=user&action=reactive&reactive=<?php echo $fetch['id']; ?>" class="btn btn-warning btn-sm deleteuser white" onclick="return confirm('Are you sure?');"><i class="la la-check"></i> Reactive</a>
                                                                <?php
                                                                    }
                                                            }
                                                            ?>
                                                                <a class="btn btn-default btn-sm"href="?page=user&action=view&id=<?php echo base64_encode($fetch['id']); ?>"><i class="la la-eye"></i> View</a>
                                                                <a class="btn btn-success btn-sm white resetuser" data-toggle="modal" data-id="<?php echo $fetch['id']; ?>"><i class="la la-refresh"></i> Reset</a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <?php
                                                        if ($_SESSION['level_user']==1) {
                                                        echo"<th colspan='8' style='text-align:right;'>";
                                                        }else{
                                                        echo "<th colspan='7' style='text-align:right;'>";
                                                        }
                                                        ?>
                                                        
                                                        <?php
                                                        if ($_SESSION['level_user'] != 4) {
                                                        ?>
                                                        <a class="btn btn-success btn-sm" href="?page=user&action=add"><i class="la la-plus"></i> Add Position</a></th>
                                                        <?php
                                                        }?>
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
