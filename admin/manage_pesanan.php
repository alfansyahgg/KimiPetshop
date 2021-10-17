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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />

    <style type="text/css">
        tr.border_bottom td {
      border-bottom: 1px solid black !important;
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
                        <h1 class="h3 mb-0 text-gray-800">Manage Gambar</h1>
                    </div>

                    <form method="get" action="<?= $baseURL ?>admin/manage_pesanan.php" style="margin-bottom: 30px">
                        <label>Cari berdasarkan tanggal</label>
                        <div class="input-group mb-3">      
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar "></i></span>
                              </div>
                            <input class="form-control col-md-4" type="text" name="datetimes" value="" />   
                        </div>
                        <button class="btn btn-warning">Cari Data</button>
                    </form>

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pending" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#sudahbayar" role="tab" aria-controls="pills-sudahbayar" aria-selected="false">Sudah Bayar</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#dikirim" role="tab" aria-controls="pills-dikirim" aria-selected="false">Dikirim</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#diterima" role="tab" aria-controls="pills-diterima" aria-selected="false">Diterima</a>
                      </li>
                    </ul>
                    

                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="col mb-5">
                            <h1 style="color: black;">Pending</h1>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pemesan</th>
                                            <th>Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>No Order</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Status Bayar</th>
                                            <th>Alamat Pengiriman</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $whereStatus = "where status_bayar='0' ";
                                        $whereSearch = '';

                                        if(!empty($_GET['datetimes'])){
                                            $range = $_GET['datetimes'];

                                            $range = explode(' - ',$range);
                                            $tanggal1 = date('Y-m-d', strtotime($range[0]));
                                            $tanggal2 = date('Y-m-d', strtotime($range[1]));
                                            $whereSearch = "and tanggal_pemesanan >= '$tanggal1' and tanggal_pemesanan <= '$tanggal2'";
                                        }

                                        $no=1;
                                            $queryGetGambar = "select p.*,b.nama_barang,b.harga,g.gambar,u.nama as pembeli from tbl_pemesanan p inner join tbl_barang b on p.id_barang = b.id_barang inner join tbl_gambar g on b.id_barang = g.id_barang inner join tbl_users u on p.id_users = u.id_users $whereStatus group by p.id_barang order by no_order asc ";
                                            // echo "<pre>";print_r($queryGetGambar);
                                            $result = mysqli_query($conn,$queryGetGambar);
                                            $arr = [];
                                            while($fetch = mysqli_fetch_assoc($result)){
                                                $arr[] = $fetch;
                                            }
                                            foreach($arr as $key => $row){
                                        ?>
                                        <tr class="<?php if($arr[$key+1]['no_order'] != $row['no_order'] ){echo "border_bottom";} ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['pembeli'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['jml_barang'] ?></td>
                                            <td class="td_noorder"><?= $row['no_order'] ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($row['tanggal_pemesanan'])) ?></td>
                                            <td>
                                                <?php 
                                                switch ($row['status_bayar']) {
                                                    case '0':
                                                        $status = "Belum Bayar";
                                                        $badge = "secondary";
                                                        break;
                                                    case '1':
                                                        $status = "Sudah Bayar";
                                                        $badge = "success";
                                                        break;
                                                    case '2':
                                                        $status = "Dikirim";
                                                        $badge = "info";
                                                        break;
                                                    case '3':
                                                        $status = "Diterima";
                                                        $badge = "primary";
                                                        break;
                                                    default:
                                                        $status = "Belum Bayar";
                                                        $badge = "secondary";
                                                        break;
                                                }
                                                $row['pembeli']
                                                 ?>
                                                    <span class="labelstatus<?=$row['no_order']?> badge badge-<?=$badge?>"><?=$status?></span></h2>
                                                </td>
                                            <td><?= $row['alamat_pengiriman'] ?></td>
                                            <td>
                                                <?php if($row['status_bayar'] == '1'): ?>
                                                <select class="status" data-order="<?=$row['no_order']?>" >
                                                    <option value="1" <?php echo($row['status_bayar'] == '1' ? 'selected disabled' : '') ?>   >Sudah Bayar</option>
                                                    <option value="2" <?php echo($row['status_bayar'] == '2' ? 'selected' : '') ?>   >Sudah Kirim</option>
                                                    <!-- <option value="3" <?php // echo($row['status_bayar'] == '3' ? 'selected' : '') ?>>Sudah Terima</option> -->
                                                </select>
                                                <?php elseif($row['status_bayar'] != '0') : ?>
                                                    <span class="labelstatus<?=$row['no_order']?> badge badge-<?=$badge?>"><?=$status?></span>
                                                <?php else: ?>                                                
                                                    <span class="badge badge-secondary">Belum Bayar</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div> <!--end pending tab -->
                      <div class="tab-pane fade" id="sudahbayar" role="tabpanel" aria-labelledby="sudahbayar-tab">
                        <div class="col mb-5">
                            <h1 style="color: black;">Sudah Bayar</h1>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pemesan</th>
                                            <th>Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>No Order</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Status Bayar</th>
                                            <th>Alamat Pengiriman</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $whereStatus = 'where status_bayar="1" ';
                                        $whereSearch = '';

                                        if(!empty($_GET['datetimes'])){
                                            $range = $_GET['datetimes'];

                                            $range = explode(' - ',$range);
                                            $tanggal1 = date('Y-m-d', strtotime($range[0]));
                                            $tanggal2 = date('Y-m-d', strtotime($range[1]));
                                            $whereSearch = "and tanggal_pemesanan >= '$tanggal1' and tanggal_pemesanan <= '$tanggal2'";
                                        }

                                        $no=1;
                                            $queryGetGambar = "select p.*,b.nama_barang,b.harga,g.gambar,u.nama as pembeli from tbl_pemesanan p inner join tbl_barang b on p.id_barang = b.id_barang inner join tbl_gambar g on b.id_barang = g.id_barang inner join tbl_users u on p.id_users = u.id_users $whereStatus group by p.id_barang order by no_order asc ";
                                            // echo "<pre>";print_r($queryGetGambar);
                                            $result = mysqli_query($conn,$queryGetGambar);
                                            $arr = [];
                                            while($fetch = mysqli_fetch_assoc($result)){
                                                $arr[] = $fetch;
                                            }
                                            foreach($arr as $key => $row){
                                        ?>
                                        <tr class="<?php if($arr[$key+1]['no_order'] != $row['no_order'] ){echo "border_bottom";} ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['pembeli'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['jml_barang'] ?></td>
                                            <td class="td_noorder"><?= $row['no_order'] ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($row['tanggal_pemesanan'])) ?></td>
                                            <td>
                                                <?php 
                                                switch ($row['status_bayar']) {
                                                    case '0':
                                                        $status = "Belum Bayar";
                                                        $badge = "secondary";
                                                        break;
                                                    case '1':
                                                        $status = "Sudah Bayar";
                                                        $badge = "success";
                                                        break;
                                                    case '2':
                                                        $status = "Dikirim";
                                                        $badge = "info";
                                                        break;
                                                    case '3':
                                                        $status = "Diterima";
                                                        $badge = "primary";
                                                        break;
                                                    default:
                                                        $status = "Belum Bayar";
                                                        $badge = "secondary";
                                                        break;
                                                }
                                                $row['pembeli']
                                                 ?>
                                                    <span class="labelstatus<?=$row['no_order']?> badge badge-<?=$badge?>"><?=$status?></span></h2>
                                                </td>
                                            <td><?= $row['alamat_pengiriman'] ?></td>
                                            <td>
                                                <?php if($row['status_bayar'] == '1'): ?>
                                                <select class="status" data-order="<?=$row['no_order']?>" >
                                                    <option value="1" <?php echo($row['status_bayar'] == '1' ? 'selected disabled' : '') ?>   >Sudah Bayar</option>
                                                    <option value="2" <?php echo($row['status_bayar'] == '2' ? 'selected' : '') ?>   >Sudah Kirim</option>
                                                    <!-- <option value="3" <?php // echo($row['status_bayar'] == '3' ? 'selected' : '') ?>>Sudah Terima</option> -->
                                                </select>
                                                <?php elseif($row['status_bayar'] != '0') : ?>
                                                    <span class="labelstatus<?=$row['no_order']?> badge badge-<?=$badge?>"><?=$status?></span>
                                                <?php else: ?>                                                
                                                    <span class="badge badge-secondary">Belum Bayar</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                        <div class="col mb-5">
                            <h1 style="color: black;">Dikirim</h1>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pemesan</th>
                                            <th>Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>No Order</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Status Bayar</th>
                                            <th>Alamat Pengiriman</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $whereStatus = 'where status_bayar="2" ';
                                        $whereSearch = '';

                                        if(!empty($_GET['datetimes'])){
                                            $range = $_GET['datetimes'];

                                            $range = explode(' - ',$range);
                                            $tanggal1 = date('Y-m-d', strtotime($range[0]));
                                            $tanggal2 = date('Y-m-d', strtotime($range[1]));
                                            $whereSearch = "and tanggal_pemesanan >= '$tanggal1' and tanggal_pemesanan <= '$tanggal2'";
                                        }

                                        $no=1;
                                            $queryGetGambar = "select p.*,b.nama_barang,b.harga,g.gambar,u.nama as pembeli from tbl_pemesanan p inner join tbl_barang b on p.id_barang = b.id_barang inner join tbl_gambar g on b.id_barang = g.id_barang inner join tbl_users u on p.id_users = u.id_users $whereStatus group by p.id_barang order by no_order asc ";
                                            // echo "<pre>";print_r($queryGetGambar);
                                            $result = mysqli_query($conn,$queryGetGambar);
                                            $arr = [];
                                            while($fetch = mysqli_fetch_assoc($result)){
                                                $arr[] = $fetch;
                                            }
                                            foreach($arr as $key => $row){
                                        ?>
                                        <tr class="<?php if($arr[$key+1]['no_order'] != $row['no_order'] ){echo "border_bottom";} ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['pembeli'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['jml_barang'] ?></td>
                                            <td class="td_noorder"><?= $row['no_order'] ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($row['tanggal_pemesanan'])) ?></td>
                                            <td>
                                                <?php 
                                                switch ($row['status_bayar']) {
                                                    case '0':
                                                        $status = "Belum Bayar";
                                                        $badge = "secondary";
                                                        break;
                                                    case '1':
                                                        $status = "Sudah Bayar";
                                                        $badge = "success";
                                                        break;
                                                    case '2':
                                                        $status = "Dikirim";
                                                        $badge = "info";
                                                        break;
                                                    case '3':
                                                        $status = "Diterima";
                                                        $badge = "primary";
                                                        break;
                                                    default:
                                                        $status = "Belum Bayar";
                                                        $badge = "secondary";
                                                        break;
                                                }
                                                $row['pembeli']
                                                 ?>
                                                    <span class="labelstatus<?=$row['no_order']?> badge badge-<?=$badge?>"><?=$status?></span></h2>
                                                </td>
                                            <td><?= $row['alamat_pengiriman'] ?></td>
                                            <td>
                                                <?php if($row['status_bayar'] == '1'): ?>
                                                <select class="status" data-order="<?=$row['no_order']?>" >
                                                    <option value="1" <?php echo($row['status_bayar'] == '1' ? 'selected disabled' : '') ?>   >Sudah Bayar</option>
                                                    <option value="2" <?php echo($row['status_bayar'] == '2' ? 'selected' : '') ?>   >Sudah Kirim</option>
                                                    <!-- <option value="3" <?php // echo($row['status_bayar'] == '3' ? 'selected' : '') ?>>Sudah Terima</option> -->
                                                </select>
                                                <?php elseif($row['status_bayar'] != '0') : ?>
                                                    <span class="labelstatus<?=$row['no_order']?> badge badge-<?=$badge?>"><?=$status?></span>
                                                <?php else: ?>                                                
                                                    <span class="badge badge-secondary">Belum Bayar</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="diterima" role="tabpanel" aria-labelledby="diterima-tab">
                        <div class="col mb-5">
                            <h1 style="color: black;">Diterima</h1>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pemesan</th>
                                            <th>Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>No Order</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Status Bayar</th>
                                            <th>Alamat Pengiriman</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $whereStatus = "where status_bayar='3' ";
                                        $whereSearch = '';

                                        if(!empty($_GET['datetimes'])){
                                            $range = $_GET['datetimes'];

                                            $range = explode(' - ',$range);
                                            $tanggal1 = date('Y-m-d', strtotime($range[0]));
                                            $tanggal2 = date('Y-m-d', strtotime($range[1]));
                                            $whereSearch = "and tanggal_pemesanan >= '$tanggal1' and tanggal_pemesanan <= '$tanggal2'";
                                        }

                                        $no=1;
                                            $queryGetGambar = "select p.*,b.nama_barang,b.harga,g.gambar,u.nama as pembeli from tbl_pemesanan p inner join tbl_barang b on p.id_barang = b.id_barang inner join tbl_gambar g on b.id_barang = g.id_barang inner join tbl_users u on p.id_users = u.id_users $whereStatus group by p.id_barang order by no_order asc ";
                                            // echo "<pre>";print_r($queryGetGambar);
                                            $result = mysqli_query($conn,$queryGetGambar);
                                            $arr = [];
                                            while($fetch = mysqli_fetch_assoc($result)){
                                                $arr[] = $fetch;
                                            }
                                            foreach($arr as $key => $row){
                                        ?>
                                        <tr class="<?php if($arr[$key+1]['no_order'] != $row['no_order'] ){echo "border_bottom";} ?>">
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['pembeli'] ?></td>
                                            <td><?= $row['nama_barang'] ?></td>
                                            <td><?= $row['jml_barang'] ?></td>
                                            <td class="td_noorder"><?= $row['no_order'] ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($row['tanggal_pemesanan'])) ?></td>
                                            <td>
                                                <?php 
                                                switch ($row['status_bayar']) {
                                                    case '0':
                                                        $status = "Belum Bayar";
                                                        $badge = "secondary";
                                                        break;
                                                    case '1':
                                                        $status = "Sudah Bayar";
                                                        $badge = "success";
                                                        break;
                                                    case '2':
                                                        $status = "Dikirim";
                                                        $badge = "info";
                                                        break;
                                                    case '3':
                                                        $status = "Diterima";
                                                        $badge = "primary";
                                                        break;
                                                    default:
                                                        $status = "Belum Bayar";
                                                        $badge = "secondary";
                                                        break;
                                                }
                                                $row['pembeli']
                                                 ?>
                                                    <span class="labelstatus<?=$row['no_order']?> badge badge-<?=$badge?>"><?=$status?></span></h2>
                                                </td>
                                            <td><?= $row['alamat_pengiriman'] ?></td>
                                            <td style="width: 15%;">
                                                <?php if($row['status_bayar'] == '1'): ?>
                                                <select class="status" data-order="<?=$row['no_order']?>" >
                                                    <option value="1" <?php echo($row['status_bayar'] == '1' ? 'selected disabled' : '') ?>   >Sudah Bayar</option>
                                                    <option value="2" <?php echo($row['status_bayar'] == '2' ? 'selected' : '') ?>   >Sudah Kirim</option>
                                                    <!-- <option value="3" <?php // echo($row['status_bayar'] == '3' ? 'selected' : '') ?>>Sudah Terima</option> -->
                                                </select>
                                                <?php elseif($row['status_bayar'] == '3') : ?>
                                                <a href=""  data-id="<?= $row['no_order'] ?>" data-toggle="modal" data-target="#lihatReview" class="btn btn-info btn-lihatreview">Detail Review</a>

                                                <?php elseif($row['status_bayar'] != '0') : ?>
                                                    <span class="labelstatus<?=$row['no_order']?> badge badge-<?=$badge?>"><?=$status?></span>

                                                <?php else: ?>                                                
                                                    <span class="badge badge-secondary">Belum Bayar</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

        <!-- Modal Lihat Review -->
        <div class="modal fade" id="lihatReview" tabindex="-1" role="dialog" aria-labelledby="tambahBarang" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBarangLabel">Lihat Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                      <input class="inp_order" type="hidden" name="order" value="">
                        <div class="form-group">
                            <label for="input-1" class="control-label">Bintang</label>
                            <input id="input-3" name="input-3" value="" class="rating-loading">
                        </div>

                        <div class="form-group">
                            <textarea readonly="" class="form-control lihatketerangan" name="keterangan"></textarea>
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    </form>
                </div>
                </div>
            </div>
        </div>

    </div>

    

    

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets_admin/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets_admin/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets_admin/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets_admin/') ?>js/sb-admin-2.min.js"></script>

    <script src="<?= base_url('assets_admin/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets_admin/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $("table").DataTable({
                paging: false,
            });

            // $('table > tbody  > tr > td.td_noorder').each(function(index, tr) { 
            //    console.log(index);
            // });

            $('input[name="datetimes"]').daterangepicker({
                endDate:moment().add(1,'days'),
                locale: {
                  format: 'DD-MM-YYYY'
                }
              });

            $("td select.status").on('change',function(e){
                var stts = $(this).val()
                var no_order = $(this).attr('data-order')

                $.ajax({
                    type: 'POST',
                    data: {status_bayar: stts,no_order:no_order},
                    dataType: 'json',
                    url: '<?=$baseURL?>action/update_statusbayar.php',
                    success: function(res){
                        console.log(res)
                        location.reload()
                    }
                })
            })

             $(".btn-lihatreview").on('click',function(){        
                var no_order = $(this).attr('data-id');
                $.ajax({
                  type: 'GET',
                  data: {no: no_order},
                  url: '<?= $baseURL ?>action/get_testimoni.php',
                  dataType: 'json',
                  success: function(res){
                    console.log(res[0])

                    $("#lihatReview .modal-title").text("Yuk Review #"+no_order)
                    
                    $("#lihatReview form #input-3").rating('update',res[0].bintang)
                    $("#lihatReview form .lihatketerangan").text(res[0].keterangan)
                  }
                })
              })


        })
    </script>
</body>
</html>