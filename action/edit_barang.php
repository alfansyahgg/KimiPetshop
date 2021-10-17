<?php

session_start();
include '../action/connect.php';
// session_destroy();

// echo "<pre>";print_r($_SESSION);exit();
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

$idBarang = $_GET['id'];

$queryGetBarangById = "select * from tbl_barang where id_barang = $idBarang group by id_barang";
$result = mysqli_query($conn,$queryGetBarangById);

// echo "<pre>";print_r(mysqli_fetch_assoc($result));exit();
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

    <style type="text/css">
        .rowGmbr{
            display: flex
        }

        .rowGmbr img{
            margin-left: 10px
        }
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Barang</h1>
                    </div>
                    
                    <div class="row col-md-6">
                        <?php while($row = mysqli_fetch_array($result)){ ?>
                        <form action="<?= $baseURL ?>action/update_barang.php" method="post" style="width: 100%" >
                            <div class="form-group">
                                <label for="">ID Barang</label>
                                <input name="id_barang" value="<?= $row['id_barang'] ?>" type="text" readonly="" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input name="nama" value="<?= $row['nama_barang'] ?>" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Harga</label>
                                <input name="harga" value="<?= $row['harga'] ?>" type="number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Stok</label>
                                <input name="stok" value="<?= $row['stok'] ?>" type="number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" rows="10" class="form-control"><?= $row['deskripsi']; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Gambar</label>
                                <div class="rowGmbr">
                                <?php 
                                $queryGetBarangById = "select * from tbl_gambar where id_barang = $idBarang";
                                $result2 = mysqli_query($conn,$queryGetBarangById);

                                while($gmb = mysqli_fetch_assoc($result2)){
                                ?>
                                <img src="<?= $baseURL."uploads/".$gmb['gambar'] ?>" width="200" height="200" />
                                <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="kategori" id="" class="form-control">
                                <?php 
                                $query = "select * from tbl_kategori";
                                $result = mysqli_query($conn,$query);
                                while($newrow = mysqli_fetch_assoc($result)){
                                ?>
                                <option value="<?= $newrow['id_kategori']  ?>" <?php if($row['id_kategori'] == $newrow['id_kategori']){ echo "selected"; } ?> >
                                    <?=$newrow['nama_kategori']?>                          
                                </option>
                                
                                <?php } ?>
                                </select>
                            </div>


                            <button class="btn-update btn btn-success mt-5 mb-5 btn-block">Update</button>

                        </form>
                        <?php } ?>
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

    

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets_admin/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets_admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets_admin/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets_admin/') ?>js/sb-admin-2.min.js"></script>

</body>
</html>