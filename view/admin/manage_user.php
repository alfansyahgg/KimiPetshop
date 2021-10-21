<?php

session_start();
include '../../action/connect.php';


function base_url($link){
    $link = empty($link) ? "" : $link;
    return "http://localhost/kimi-petshop/".$link;
}


if(empty($_SESSION)){
    header("Location: ".base_url(""));
}else{
    if($_SESSION['is_login'] == false){
        header("Location: ".base_url(""));
    }
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
    th, td { white-space: nowrap; }
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
                        <h1 class="h3 mb-0 text-gray-800">Manage User</h1>
                        <a data-toggle="modal" data-target="#tambahModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
                    </div>
                    
                    <div class="row">
                        <div class="table-responsive">
                            <table id="tbluser" class="table table-bordered table-striped table-hovered">
                                <thead>
                                    <tr>
                                        <th>ID Users</th>                                        
                                        <th>Hak Akses</th>
                                        <th>Action</th>
                                        <th>Nama</th>
                                        <th>Nama Belakang</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Kota</th>
                                        <th>Kode Pos</th>
                                        <th>Alamat</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no=1;
                                        $query = "select * from tbl_users";
                                        $result = mysqli_query($conn,$query);
                                        while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td><?= $row['id_users'] ; ?></td>
                                        <td><?= ($row['hak_akses'] == '1' ? 'Administrator' : 'Customer') ; ?></td>
                                        <td>
                                            <span>
                                                <a href="<?= $baseURL ?>action/edit_user.php?id=<?=$row['id_users']?>" class="btn btn-primary">Edit</a>
                                                <a onclick="return confirm('Akan menghapus seluruh data user?')" href="<?= $baseURL ?>action/delete_user.php?id=<?=$row['id_users']?>" class="btn btn-danger">Delete</a>
                                            </span>
                                        </td>
                                        <td><?= $row['nama'] ; ?></td>
                                        <td><?= $row['nama_belakang'] ; ?></td>
                                        <td><?= $row['username'] ; ?></td>
                                        <td><?= $row['email'] ; ?></td>
                                        <td><?= $row['no_hp'] ; ?></td>
                                        <td><?= $row['kota'] ; ?></td>
                                        <td><?= $row['kode_post'] ; ?></td>
                                        <td><?= $row['alamat'] ; ?></td>
                                        <td>
                                            <img src="<?= $baseURL.'uploads/'.$row['gambar'] ; ?>" width="80" height="80" >
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarang" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Tambah Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="<?= $baseURL ?>action/tambah_user.php" method="post">
                    <div class="form-group">
                        <label for="">Nama Depan</label>
                        <input type="text" name="nama" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">password</label>
                        <input type="text" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Nomor Handphone</label>
                        <input type="number" name="no_hp" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Kota</label>
                        <input type="text" name="kota" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Kode Pos</label>
                        <input type="text" name="pos" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control"></textarea>

                    </div>

                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="">Hak Akses</label>
                        <select name="hak_akses" class="form-control">
                            <option value="0">Customer</option>
                            <option value="1">Administrator</option>                            
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarang" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Update Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="<?= $baseURL ?>action/update_gambar.php" method="post">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input readonly value="" type="text" name="nama_barang" class="form-control">
                        <input type="hidden" name="nama_gambar" class="nama_gambar" >
                        <input type="hidden" name="id_gambar" class="id_gambar" >
                    </div>

                    <div class="form-group" style="display: flex;flex-direction: column;">
                        <label>Gambar</label>
                        <img width="200" height="200" src="">
                    </div>

                    <div class="form-group">
                        <label>Ubah Gambar</label>
                        <input type="file" class="form-control-file" name="gambar">
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
    <script src="<?= base_url('assets/assets_admin/') ?>js/sb-admin-2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            
        })
    </script>
    <script src="<?= base_url('assets/assets_admin/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/assets_admin/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#tbluser").DataTable({
                scrollX: true,
                paging: false,
                // scrollCollapse: true,
                fixedColumns: {
                    left: 3
                }
            });
        })
    </script>

</body>
</html>