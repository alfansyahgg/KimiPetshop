<?php

session_start();
include '../../action/connect.php';
// session_destroy();

// echo "<pre>";print_r($_SESSION);exit();
function base_url($link){
    $link = empty($link) ? "" : $link;
    return "http://localhost/kimi-petshop/".$link;
}


if(empty($_SESSION)){
    header("Location: ".base_url(""));
}else{
    if($_SESSION['hak_akses'] != '1'){
        header("Location: ".base_url("")); 
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>

	<!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/assets_admin/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/assets_admin/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets_admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>">

    <style type="text/css">

    </style>

</head>
<body id="page-top">

	<!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
        include('../../view/admin/layout/sidebar.php');
        // $this->load->view('layout/admin/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php 
                include('../../view/admin/layout/topbar.php');
                // $this->load->view('layout/admin/topbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Barang</h1>
                        <a data-toggle="modal" data-target="#tambahBarang" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang</a>
                    </div>
                    
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no=1;
                                        $queryGetBarang = "select brg.*,ktg.*,gmb.* from tbl_barang brg inner join tbl_kategori ktg on brg.id_kategori = ktg.id_kategori inner join tbl_gambar gmb on brg.id_barang = gmb.id_barang
                                        group by brg.id_barang
                                        ";
                                        $result = mysqli_query($conn,$queryGetBarang);
                                        while($row = mysqli_fetch_array($result) ) {
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['id_barang']; ?></td>
                                        <td><?= $row['nama_barang']; ?></td>
                                        <td><?= $row['harga']; ?></td>
                                        <td><?= $row['stok']; ?></td>
                                        <td><?= $row['deskripsi']; ?></td>
                                        <td>
                                            <img src="<?= $baseURL."uploads/".$row['gambar']; ?>" alt="" width="80" height="80">
                                            
                                        </td>
                                        <td><?= $row['nama_kategori']; ?></td>
                                        <td style="width: 15%;">
                                            <a href="<?= $baseURL ?>action/edit_barang.php?id=<?= $row['id_barang']; ?>" class="btn btn-info">Edit</a>
                                            <a onclick="return confirm('Yakin ingin menghapus?')"  href="<?= $baseURL ?>action/delete_barang.php?id=<?=$row['id_barang']; ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php 
            include('../../view/admin/layout/footer.php');
            // $this->load->view('layout/admin/footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahBarang" tabindex="-1" role="dialog" aria-labelledby="tambahBarang" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="<?= $baseURL ?>action/tambah_barang.php" method="post">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Barang (Satuan)</label>
                        <input type="number" name="harga" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Stok Barang</label>
                        <input type="number" name="stok" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Barang</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar Barang</label>
                        <input type="file" multiple="multiple" name="gambar[]" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="kategori" id="" class="form-control">
                        <?php 
                        $query = "select * from tbl_kategori";
                        $result = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <option value="<?= $row['id_kategori'] ?>"><?=$row['nama_kategori']?></option>
                        
                        <?php } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/assets_admin/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/assets_admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/assets_admin/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/assets_admin/') ?>js/sb-admin-2.min.js"></script>.

    <script src="<?= base_url('assets/assets_admin/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/assets_admin/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $("table").DataTable();
        })
    </script>
</body>
</html>