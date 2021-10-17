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

$id_users =  $_GET['id'];


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
                        <h1 class="h3 mb-0 text-gray-800">Manage Website</h1>
                    </div>
                    
                    <?php 
                    $query = "select * from tbl_users where id_users = $id_users   ";
                    $result = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="col-md-6">
                        <form enctype="multipart/form-data" method="post" action="<?= $baseURL ?>action/update_user.php">
                            <div class="form-group">
                                <label>Nama Depan</label>
                                <input class="form-control" name="depan" value="<?= $row['nama'] ?>" />
                                <input type="hidden" value="<?= $row['id_users'] ?>" name="id_users">
                            </div>

                            <div class="form-group">
                                <label>Nama Belakang</label>
                                <input class="form-control" name="belakang" value="<?= $row['nama_belakang'] ?>" />
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" value="<?= $row['username'] ?>" />
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" value="" placeholder="Kosongkan jika tidak ingin ganti" />
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>" />
                            </div>

                            <div class="form-group">
                                <label>No HP</label>
                                <input type="number" class="form-control" name="no_hp" value="<?= $row['no_hp'] ?>" />
                            </div>

                            <div class="form-group">
                                <label>Kota</label>
                                <input class="form-control" name="kota" value="<?= $row['kota'] ?>" />
                            </div>

                            <div class="form-group">
                                <label>Kode Pos</label>
                                <input class="form-control" name="pos" value="<?= $row['kode_post'] ?>" />
                            </div>


                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat"><?= $row['alamat'] ?></textarea>
                            </div>

                            <img style="margin: 20px auto;" src="<?= $baseURL.'uploads/'.$row['gambar'] ?>" width="100" height="100">

                            <div class="form-group">
                              <label>Gambar Profil</label>
                              <input type="file" name="gambar" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label>Hak Akses</label>
                                <select name="hak_akses" class="form-control">
                                    <option value="0" <?= $row['hak_akses'] == '0' ? 'selected' : ''  ?>>Customer</option>
                                    <option value="1" <?= $row['hak_akses'] == '1' ? 'selected' : ''  ?>>Admin</option>
                                </select>
                            </div>

                            <button class="btn btn-primary">Update</button>
                        </form>
                    </div>
                <?php } ?>


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

    <script type="text/javascript">
        $(document).ready(function(){
            // $(".btn-edit").on('click',function(){
            //     var idKategori = $(this).attr('data-id')
            //     var namaKategori = $(this).attr('data-name')

            //     $(".hidden_id_kategori").val(idKategori)
            //     $("#editModal input[name='nama_kategori']").val(namaKategori)
            // })
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