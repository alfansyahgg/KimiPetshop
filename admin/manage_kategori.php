<?php

session_start();
include '../action/connect.php';


function base_url($link){
    $link = empty($link) ? "" : $link;
    return "http://localhost/olshop_petshop/".$link;
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
    <link href="<?= base_url('assets_admin/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets_admin/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets_admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>">
    <style type="text/css">

    </style>

</head>
<body id="page-top">

	<!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
        include('../view/admin/layout/sidebar.php');
        // $this->load->view('layout/admin/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php 
                include('../view/admin/layout/topbar.php');
                // $this->load->view('layout/admin/topbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Kategori</h1>
                        <a data-toggle="modal" data-target="#tambahModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori</a>
                    </div>
                    
                    <div class="row">
                        <div class="table-responsive" style="width: 100%">
                            <table class="table table-bordered table-striped table-hovered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Jumlah Data</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no=1;
                                        $query = "select ktg.*,COUNT(*) as jumlah from tbl_kategori ktg left join tbl_barang brg on ktg.id_kategori = brg.id_kategori group by brg.id_kategori";
                                        $result = mysqli_query($conn,$query);
                                        while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_kategori'] ; ?></td>
                                        <td><?= $row['jumlah']; ?></td>
                                        <td class="text-center">
                                            <a data-name="<?= $row['nama_kategori'] ?>" data-id="<?= $row['id_kategori']; ?>" href="" class="btn btn-info btn-edit" data-toggle="modal" data-target="#editModal" >Edit</a>
                                             <a href="<?= $baseURL ?>action/delete_kategori.php?id=<?=$row['id_kategori']; ?>" class="btn btn-danger btn-hapus">Hapus</a>   
                                            </td>
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
            include('../view/admin/layout/footer.php');
            // $this->load->view('layout/admin/footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarang" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="<?= $baseURL ?>action/tambah_kategori.php" method="post">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control">
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarang" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Update Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="<?= $baseURL ?>action/update_kategori.php" method="post">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control">
                        <input type="hidden" name="id_kategori" class="hidden_id_kategori">
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
    <script src="<?= base_url('assets_admin/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets_admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets_admin/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets_admin/') ?>js/sb-admin-2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".btn-edit").on('click',function(){
                var idKategori = $(this).attr('data-id')
                var namaKategori = $(this).attr('data-name')

                $(".hidden_id_kategori").val(idKategori)
                $("#editModal input[name='nama_kategori']").val(namaKategori)
            })
        })
    </script>
    <script src="<?= base_url('assets_admin/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets_admin/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("table").DataTable();
        })
    </script>
</body>
</html>