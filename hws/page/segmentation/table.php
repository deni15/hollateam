<?php
if ($_SESSION['level_user'] == 4 || $_SESSION['level_user'] == 5) {
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
                    <h3 class="content-header-title">Segmenation List</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Admin Panel</a>
                                </li>
                                <li class="breadcrumb-item active">Segmenation List
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
                                    <h4 class="card-title">Segmentation List</h4>
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
                                                        <th>Segment</th>
                                                        <th>Segment Name</th>
                                                        <?php
                                                        if ($_SESSION['level_user']==1) {
                                                        ?>
                                                        <th>Company</th>
                                                        <?php
                                                    }
                                                    ?>
                                                        <th>Address</th>
                                                        <th width="150">Action</th>
                                                    </tr>   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    if ($_SESSION['level_user'] == 2 || $_SESSION['level_user'] == 3 ) {
                                                        $query = $koneksi->query("SELECT * FROM `tbl_segmenation` WHERE  company='".$_SESSION['company']."'");
                                                    }else{
                                                        $query = $koneksi->query("SELECT * FROM `tbl_segmenation`");
                                                    }
                                                    while ($fetch = $query->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no++?></td>
                                                            <td><?php echo $fetch['sid']?></td>
                                                            <td><?php echo $fetch['s_name']?></td>
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
                                                        ?>
                                                            <td><?php echo $fetch['s_address']?></td>
                                                            <td style="text-align:center;">
                                                                <a class="btn btn-primary btn-sm white"href="?page=segmentation&action=edit&id=<?php echo base64_encode($fetch['sid']); ?>"><i class="la la-edit"></i> Edit</a>
                                                                <a class="btn btn-success btn-sm"href="?page=segmentation&action=view&id=<?php echo base64_encode($fetch['sid']); ?>"><i class="la la-eye"></i> View</a>
                                                                <a class="btn btn-danger btn-sm delete white" data-toggle="modal" data-id="<?php echo $fetch['sid']; ?>"><i class="la la-trash"></i> Delete</a>
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
                                                            ?>
                                                            <th colspan="6" style="text-align:right;"><a class="btn btn-success btn-sm" href="?page=segmentation&action=add"><i class="la la-plus"></i> Add Segmentation</a></th>
                                                            <?php
                                                        }else{
                                                        ?>
                                                        <th colspan="5" style="text-align:right;"><a class="btn btn-success btn-sm" href="?page=segmentation&action=add"><i class="la la-plus"></i> Add Segmentation</a></th>
                                                            <?php
                                                        }
                                                        ?>
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
