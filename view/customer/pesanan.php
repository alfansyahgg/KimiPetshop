<?php 

session_start();
include('../../action/connect.php');

$base_url = 'http://localhost/kimi-petshop/';

$code = $_GET['u'];

$decryption_iv = '1234567891011121';
$decryption_key = "gg";

$id_users = openssl_decrypt($code,"AES-128-CTR","gg",0,$decryption_iv);
if($id_users != $_SESSION['id_user']){
  echo "prohibited";exit();
}
require_once('../../plugins/Midtrans.php');
// require_once dirname(__FILE__) . './../plugins/Midtrans.php';


// echo "<pre>";print_r($snapToken);exit();


?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../../view/layout/head.php'); ?>

<style type="text/css">
  table tbody td{
    font-size: 15px!important;
  }
</style>

<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-RN-YUnJ46LDBImxv"></script>
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />

<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="header">
	<?php include('../../view/layout/header.php'); ?>				
</div>
  <!---->

  <div class="banner-top">
    <div class="container">
      <h3 >Kimi Petshop</h3>
      <h4><a href="index.html">Home</a><label>/</label>Lorem</h4>
      <div class="clearfix"> </div>
    </div>
  </div>

    <div class="single">
      <form id="payment-form" method="post" action="<?= $baseURL."action/finish_payment.php" ?>">
        <input type="hidden" name="result_type" id="result-type" value=""/>
        <input type="hidden" name="result_data" id="result-data" value=""/>
        <input type="hidden" name="no_order" id="no_order" value=""/>
      </form>
      <div class="container">
          <div class="grid_3 grid_5 wow fadeInLeft animated" data-wow-delay=".5s">
           <h3 class="bars">Tabs</h3>
             <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Home</a></li>
                <li role="presentation"><a href="#bayar" role="tab" id="bayar-tab" data-toggle="tab" aria-controls="profile">Sudah Bayar</a></li>
                <li role="presentation"><a href="#dikirim" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Dikirim</a></li>
                <li role="presentation"><a href="#diterima" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Diterima</a></li>
                

              </ul>
              <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                <div class="col-md">

                <?php
                  $queryNoOrder = "select p.id_pemesanan,p.no_order,p.status_bayar,p.tanggal_pemesanan,p.alamat_pengiriman,p.penerima,p.no_hp_penerima,p.kota_penerima,
COALESCE(t.payment_type,'') as payment_type,COALESCE(t.transaction_status,'') as transaction_status,COALESCE(t.batas_bayar,'') as batas_bayar,COALESCE(t.bank,'') as bank,COALESCE(t.va_number,0) as va_number,COALESCE(t.pdf_url,'') as pdf_url,COALESCE(t.payment_code,'') as payment_code,COALESCE(t.status,0) as status,COALESCE(t.bca_va_number,0) as bca_va_number,COALESCE(t.permata_va_number,0) as permata_va_number,COALESCE(t.bill_key,0) as bill_key,COALESCE(t.biller_code,0) as biller_code
 from tbl_pemesanan p left join tbl_transaksi t on p.no_order = t.no_order where p.id_users = $id_users and p.status_bayar = '0' group by p.no_order order by p.id_pemesanan desc ";
                  $execOrder = mysqli_query($conn,$queryNoOrder);

                  while($val = mysqli_fetch_array($execOrder)){
                ?>
                <div style="padding: 50px 20px;border: 1px solid black;margin-bottom: 50px;">
                  <div style="margin-top: 10px;margin-bottom: 10px;"><h1>Nomor Order : #<?= $val['no_order'] ?></h1></div>
                  <div class="table-responsive">
                    <a onclick="return confirm('Hapus?')"  href="<?= $baseURL."action/delete_noorder.php?no=".$val['no_order'] ?>" style="float: right;margin-bottom: 20px" href="" class="btn btn-danger btn-hapusorder"><i class="fa fa-times">&nbsp;</i>Hapus Order</a>
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width: 5%">No</th>
                          <th style="width: 15%">Gambar</th>
                          <th>Nama</th>
                          <th style="width: 5%">Jumlah</th>
                          <th>Harga Satuan</th>
                          <th>Total Harga</th>
                          <th style="width: 5%">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <input type="hidden" name="result_type" id="result-type" value=""/>
                        <input type="hidden" name="result_data" id="result-data" value=""/>
                        <?php
                        $i=1;
                        $totalHarga = 0;
                        $cNoOrder = $val['no_order'];
                        $queryPesanan = "select p.*,b.nama_barang,b.harga,g.gambar from tbl_pemesanan p inner join tbl_barang b on p.id_barang = b.id_barang inner join tbl_gambar g on b.id_barang = g.id_barang where p.id_users = $id_users and p.no_order = $cNoOrder group by p.id_barang";
                        $execPesanan = mysqli_query($conn,$queryPesanan);
                        while($row = mysqli_fetch_array($execPesanan) ){
                          if($val['no_order'] == $row['no_order']){
                            $totalHarga += ($row['jml_barang']*$row['harga']);
                        ?>
                        <tr>
                          <td><?= $i++; ?></td>
                          <td>
                            <img src="<?= $baseURL."uploads/".$row['gambar'] ?>" width="100" height="100">
                          </td>
                          <td><?= $row['nama_barang'] ?></td>
                          <td><?= $row['jml_barang'] ?></td>
                          <td><?= number_format($row['harga'],0,0,'.') ?></td>
                          <td><?=  number_format($row['jml_barang']*$row['harga'],0,0,'.') ?></td>
                          <td>
                            <a onclick="return confirm('Hapus?  ')"  href="<?= $baseURL."action/delete_pesanan.php?p=".$row['id_pemesanan'] ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
                          </td>
                        </tr>
                        <?php } } ?>
                        <tr>
                          <td colspan="5" class="text-center">Total</td>                          
                          <td><?= number_format($totalHarga,0,0,'.'); ?></td>
                          <td></td>                              
                        </tr>
                      </tbody>
                    </table>

                  </div>

                  <?php if(!empty($val['transaction_status'])): ?>
                  <div class="table-responsive mt-5 mb-5">
                    <table class="table table-bordered table-striped">
                      <tr>
                        <td colspan="3" style="border-bottom: 3px solid gray;text-align: left;font-weight: bold;">Informasi Penerima</td>
                      </tr>
                      <tr>
                        <td>Penerima</td>
                        <td  class="text-center" style="width: 2%"> : </td>
                        <td>
                          <?= ucwords(str_replace(array('[',']'), '',$val['penerima'])) ?>
                        </td>
                      </tr>
                      <tr>

                      <tr>
                        <td>Nomor HP Penerima</td>
                        <td  class="text-center" style="width: 2%"> : </td>
                        <td>
                          <?= ucwords(str_replace(array('[',']'), '',$val['no_hp_penerima'])) ?>
                        </td>
                      </tr>
                      <tr>

                      <tr>
                        <td>Alamat Penerima</td>
                        <td  class="text-center" style="width: 2%"> : </td>
                        <td>
                          <?= ucwords($val['alamat_pengiriman']."<br>".$val['kota_penerima']  ) ?>
                        </td>
                      </tr>
                      <tr>

                      <tr>
                        <td colspan="3" style="border-bottom: 3px solid gray;text-align: left;font-weight: bold;">Informasi Pembayaran</td>
                      </tr>

                      <tr>
                        <td>Jenis Pembayaran</td>
                        <td  class="text-center" style="width: 2%"> : </td>
                        <td>
                          <?= ucwords(str_replace(array('_','-'), ' ',$val['payment_type'])) ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td class="text-center"> : </td>
                        <td>Pending</td>
                      </tr>
                      <?php if(!empty($val['bank'])): ?>
                        <tr>
                          <td>Bank</td>
                          <td class="text-center"> : </td>
                          <td><?= $val['bank'] ?></td>
                        </tr>
                      <?php endif; ?>

                      <?php if(!empty($val['va_number'])): ?>
                        <tr>
                          <td>VA Number</td>
                          <td class="text-center"> : </td>
                          <td><?= $val['va_number'] ?></td>
                        </tr>
                      <?php endif; ?>

                      <?php if(!empty($val['bca_va_number'])): ?>
                        <tr>
                          <td>BCA VA Number</td>
                          <td class="text-center"> : </td>
                          <td><?= $val['bca_va_number'] ?></td>
                        </tr>
                      <?php endif; ?>

                      <?php if(!empty($val['permata_va_number'])): ?>
                        <tr>
                          <td>Permata VA Number</td>
                          <td class="text-center"> : </td>
                          <td><?= $val['permata_va_number'] ?></td>
                        </tr>
                      <?php endif; ?>

                      <?php if(!empty($val['bill_key'])): ?>
                        <tr>
                          <td>Bill Key</td>
                          <td class="text-center"> : </td>
                          <td><?= $val['bill_key'] ?></td>
                        </tr>
                      <?php endif; ?>

                      <?php if(!empty($val['biller_code'])): ?>
                        <tr>
                          <td>Biller Code</td>
                          <td class="text-center"> : </td>
                          <td><?= $val['biller_code'] ?></td>
                        </tr>
                      <?php endif; ?>

                      <?php if(!empty($val['payment_code'])): ?>
                        <tr>
                          <td>Payment Code</td>
                          <td class="text-center"> : </td>
                          <td><?= $val['payment_code'] ?></td>
                        </tr>
                      <?php endif; ?>


                      <tr>
                        <td>Panduan Pembayaran</td>
                        <td class="text-center"> : </td>
                        <td><a href="<?= $val['pdf_url'] ?>" class="btn btn-danger"><i class="fa fa-file-pdf-o">&nbsp;</i>Download</a></td>
                      </tr>
                    </table>
                  </div>
                  <?php  endif;?>
                  <span>
                    <?php if(empty($val['transaction_status'])): ?>
                    <a style="float: right;width: 15%;" data-id="<?=$val['no_order']?>" class="btn btn-success btn-bayarorder"><i class="fa fa-money">&nbsp;</i>Bayar</a>
                    <?php endif; ?>
                  </span>
                </div>

              <?php } ?>
                </div>
                </div>
                <!-- Sudah Bayar Tab -->
                <div role="tabpanel" class="tab-pane fade" id="bayar" aria-labelledby="bayar-tab">
                  <div class="col-md">
                  <?php
                    $queryNoOrder = "select p.no_order,p.status_bayar,p.tanggal_pemesanan,p.alamat_pengiriman from tbl_pemesanan p where p.id_users = $id_users and p.status_bayar='1' group by p.no_order ";
                    $execOrder = mysqli_query($conn,$queryNoOrder);

                    while($val = mysqli_fetch_array($execOrder)){
                  ?>
                  <div style="padding: 50px 20px;border: 1px solid black;margin-bottom: 50px;">
                    <div style="margin-top: 10px;margin-bottom: 10px;"><h1>Nomor Order : #<?= $val['no_order'] ?></h1></div>
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 15%">Gambar</th>
                            <th>Nama</th>
                            <th style="width: 5%">Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=1;
                          $totalHarga = 0;
                          $cNoOrder = $val['no_order'];
                          $queryPesanan = "select p.*,b.nama_barang,b.harga,g.gambar from tbl_pemesanan p inner join tbl_barang b on p.id_barang = b.id_barang inner join tbl_gambar g on b.id_barang = g.id_barang where p.id_users = $id_users and p.no_order = $cNoOrder group by p.id_barang";
                          $execPesanan = mysqli_query($conn,$queryPesanan);
                          while($row = mysqli_fetch_array($execPesanan) ){
                            if($val['no_order'] == $row['no_order']){
                              $totalHarga += ($row['jml_barang']*$row['harga']);
                          ?>
                          <tr>
                            <td><?= $i++; ?></td>
                            <td>
                              <img src="<?= $baseURL."uploads/".$row['gambar'] ?>" width="100" height="100">
                            </td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td><?= $row['jml_barang'] ?></td>
                            <td><?= number_format($row['harga'],0,0,'.') ?></td>
                            <td><?=  number_format($row['jml_barang']*$row['harga'],0,0,'.') ?></td>
                          </tr>
                          <?php } } ?>
                            <tr>
                              <td colspan="4" class="text-center">Total</td>                          
                              <td><?= number_format($totalHarga,0,0,'.'); ?></td>
                              <td></td>                              
                            </tr>
                        </tbody>
                      </table>

                    </div>
                  </div>

                  <?php } ?>
                  </div>
                  </div>
                  <!-- End Sudah Bayar Tab -->

                  <!-- Dikirim Tab -->
                  <div role="tabpanel" class="tab-pane fade" id="dikirim" aria-labelledby="dikirim-tab">
                  <div class="col-md">
                  <?php
                    $queryNoOrder = "select p.no_order,p.status_bayar,p.tanggal_pemesanan,p.alamat_pengiriman from tbl_pemesanan p where p.id_users = $id_users and p.status_bayar='2' group by p.no_order ";
                    $execOrder = mysqli_query($conn,$queryNoOrder);

                    while($val = mysqli_fetch_array($execOrder)){
                  ?>
                    <div style="padding: 50px 20px;border: 1px solid black;margin-bottom: 50px;">
                      <div style="margin-top: 10px;margin-bottom: 10px;"><h1>Nomor Order : #<?= $val['no_order'] ?></h1></div>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th style="width: 5%">No</th>
                              <th style="width: 15%">Gambar</th>
                              <th>Nama</th>
                              <th style="width: 5%">Jumlah</th>
                              <th>Harga Satuan</th>
                              <th>Total Harga</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $totalHarga = 0;
                            $cNoOrder = $val['no_order'];
                            $queryPesanan = "select p.*,b.nama_barang,b.harga,g.gambar from tbl_pemesanan p inner join tbl_barang b on p.id_barang = b.id_barang inner join tbl_gambar g on b.id_barang = g.id_barang where p.id_users = $id_users and p.no_order = $cNoOrder group by p.id_barang";
                            $execPesanan = mysqli_query($conn,$queryPesanan);
                            while($row = mysqli_fetch_array($execPesanan) ){
                              if($val['no_order'] == $row['no_order']){

                                $totalHarga += ($row['jml_barang']*$row['harga']);
                            ?>
                            <tr>
                              <td><?= $i++; ?></td>
                              <td>
                                <img src="<?= $baseURL."uploads/".$row['gambar'] ?>" width="100" height="100">
                              </td>
                              <td><?= $row['nama_barang'] ?></td>
                              <td><?= $row['jml_barang'] ?></td>
                            <td><?= number_format($row['harga'],0,0,'.') ?></td>                            
                            <td><?=  number_format($row['jml_barang']*$row['harga'],0,0,'.') ?></td>
                            </tr>
                            <?php } } ?>
                              <tr>
                                <td colspan="4" class="text-center">Total</td>                          
                                <td><?= number_format($totalHarga,0,0,'.'); ?></td>
                                <td></td>                              
                            </tr>
                          </tbody>
                        </table>
                      </div>
                        <a data-id="<?= $val['no_order']; ?>" onclick="return confirm('Yakin sudah menerima barang?')" href="" class="btn btn-success btnSudahTerima" style="float: right;">
                          <i class="fa fa-check"></i> Sudah Terima Barang Ini
                        </a>
                    </div>

                  <?php } ?>
                  </div>
                </div>
                <!-- End Dikirim Tab -->


                <!-- Diterima Tab -->
                <div role="tabpanel" class="tab-pane fade" id="diterima" aria-labelledby="diterima-tab">
                <div class="col-md">
                  <?php
                    $queryNoOrder = "select p.no_order,p.status_bayar,p.tanggal_pemesanan,p.alamat_pengiriman from tbl_pemesanan p where p.id_users = $id_users and p.status_bayar='3' group by p.no_order ";
                    $execOrder = mysqli_query($conn,$queryNoOrder);

                    while($val = mysqli_fetch_array($execOrder)){
                  ?>
                    <div style="padding: 50px 20px;border: 1px solid black;margin-bottom: 50px;">
                      <div style="margin-top: 10px;margin-bottom: 10px;"><h1>Nomor Order : #<?= $val['no_order'] ?></h1></div>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th style="width: 5%">No</th>
                              <th style="width: 15%">Gambar</th>
                              <th>Nama</th>
                              <th style="width: 5%">Jumlah</th>
                              <th>Harga Satuan</th>
                              <th>Total Harga</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $totalHarga = 0;
                            $cNoOrder = $val['no_order'];
                            $queryPesanan = "select p.*,b.nama_barang,b.harga,g.gambar from tbl_pemesanan p inner join tbl_barang b on p.id_barang = b.id_barang inner join tbl_gambar g on b.id_barang = g.id_barang where p.id_users = $id_users and p.no_order = $cNoOrder group by p.id_barang";
                            $execPesanan = mysqli_query($conn,$queryPesanan);
                            while($row = mysqli_fetch_array($execPesanan) ){
                              if($val['no_order'] == $row['no_order']){
                                $totalHarga += ($row['jml_barang']*$row['harga']);
                            ?>
                            <tr>
                              <td><?= $i++; ?></td>
                              <td>
                                <img src="<?= $baseURL."uploads/".$row['gambar'] ?>" width="100" height="100">
                              </td>
                              <td><?= $row['nama_barang'] ?></td>
                              <td><?= $row['jml_barang'] ?></td>
                            <td><?= number_format($row['harga'],0,0,'.') ?></td>                            
                            <td><?=  number_format($row['jml_barang']*$row['harga'],0,0,'.') ?></td>
                            </tr>
                            <?php } } ?>
                            <tr>
                              <td colspan="4" class="text-center">Total</td>                          
                              <td><?= number_format($totalHarga,0,0,'.'); ?></td>
                              <td></td>                              
                            </tr>
                          </tbody>
                        </table>

                      </div>
                      <?php 
                          $querySelectReview = "select * from tbl_testimoni where no_order=$cNoOrder ";
                          $result = mysqli_query($conn,$querySelectReview);
                          if(!mysqli_num_rows($result) > 0){
                      ?>
                      <span>
                        <a data-toggle="modal" data-target="#reviewModal" style="float: right;width: 15%;" data-id="<?=$val['no_order']?>" class="btn btn-success btn-review"><i class="fa fa-star">&nbsp;</i>Review</a>
                      </span>
                    <?php }else{ ?>
                      <a class="btn btn-primary btn-lihatreview" style="float: right;width: 15%;" href="" data-id="<?=$val['no_order']?>"  >Lihat Review</a>
                    <?php } ?>
                    </div>

                  <?php } ?>
                  </div>
                </div>
                <!-- End Diterima Tab -->

              </div>
         </div>
        </div> <!-- End Tabs -->
             



      </div>
    </div>

<!--content-->
<div class="content-top ">
    
</div>
<!--content-->

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
                        <label for="input-3" class="control-label">Bintang</label>
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

<!-- Modal Tambah -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarang" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Tambah Testimoni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $baseURL ?>action/tambah_testimoni.php" method="post">
                  <input class="inp_order" type="hidden" name="order" value="">
                    <div class="form-group">
                        <label for="input-1" class="control-label">Kasih Bintang</label>
                        <input id="input-1" name="bintang" class="rating rating-loading" data-show-clear="false" data-min="0" data-max="5" data-step="1">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="keterangan">Tuliskan sesuatu...</textarea>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary review-submit">Submit</button>
                
                </form>
            </div>
            </div>
        </div>
    </div>


<!--footer-->
<div class="footer">
	<?php include('../../view/layout/footer.php'); ?>				
</div>
<!-- //footer-->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>

<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
      $("#input-1").rating();
      $('#input-3').rating({displayOnly: true, step: 0.5});
      
      $(".btn-review").on('click',function(e){      
        e.preventDefault()
        var no_order = $(this).attr('data-id');
        $(".inp_order").val(no_order)

        $("#reviewModal .modal-title").text("Yuk Review #"+no_order)
      })

      $(".btn-lihatreview").on('click',function(e){      
        e.preventDefault()
        var no_order = $(this).attr('data-id');
        $.ajax({
          type: 'GET',
          data: {no: no_order},
          url: '<?= $baseURL ?>action/get_testimoni.php',
          dataType: 'json',
          success: function(res){
            console.log(res[0].bintang)

            $("#lihatReview .modal-title").text("Yuk Review #"+no_order)
            $("#lihatReview form #input-3").rating('update',res[0].bintang)
            $("#lihatReview form .lihatketerangan").text(res[0].keterangan)


            $("#lihatReview").modal('show')
          }
        })
      })

      $(".btnSudahTerima").on('click',function(e){
        e.preventDefault();

        var no_order = $(this).attr('data-id')
        
        $.ajax({
          type: 'POST',
          data: {no_order: no_order},
          dataType: 'json',
          url: '<?= $baseURL ?>action/update_sudahterima.php',
          success: function(res){
            console.log(res)
            if(res.status){
              window.location = window.location  
            }else{
              alert('Gagal Update Data')  
            }
          },
          error: function(res){
            console.log(res)
            window.location = window.location            
          }
        })
      })

      
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
<!-- for bootstrap working -->
		<script src="<?=$baseURL?>assets/assets_customer/js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<script type='text/javascript' src="<?=$baseURL?>assets/assets_customer/js/jquery.mycart.js"></script>


 
  <script type="text/javascript">

    $(document).ready(function(){

      $('.btn-bayarorder').on('click',function(e){
        e.preventDefault()

        let no_order = $(this).attr('data-id')
        let data = {no_order: no_order}

        $.ajax({
          type: 'POST',
          url: '<?= $baseURL ?>action/snapz.php',
          cache: false,
          data: data,
          success: function(data){
            console.log('token = '+data);

            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');
            var order = document.getElementById('no_order');

            function changeResult(type,data){
              $("#result-type").val(type);
              $("#result-data").val(JSON.stringify(data));
              $("#no_order").val(no_order)
              // resultType.innerHTML = type;
              // resultData.innerHTML = JSON.stringify(data);
            }
            snap.pay(data, {
          
              onSuccess: function(result){
                changeResult('success', result);
                console.log(result.status_message);
                console.log(result);
                $("#payment-form").submit();
              },
              onPending: function(result){
                changeResult('pending', result);
                console.log(result.status_message);
                $("#payment-form").submit();
              },
              onError: function(result){
                changeResult('error', result);
                console.log(result.status_message);
                $("#payment-form").submit();
              }
            });
            



          }
        })
      })


      var finish = function(){
        $.ajax({
                type: 'POST',
                url: '<?=$baseURL?>action/finish_payment.php',
                data: {result_data: JSON.stringify(data)},
                success: (res)=>{
                  console.log(res)
                }
              })
      }

    })
  </script>



  <script type="text/javascript">
  $(function () {

    $("ul.nav.tabs li").first().addClass('active')
    $("div.tab-content div.tab-pane").first().addClass('active')

    const isLogin = '<?php echo(!empty($_SESSION) && $_SESSION['is_login'] ? true : false ) ?>'

    $('.my-cart-btn').on('click',function(){
      if(!isLogin){
            window.location = "<?= $baseURL."login.php" ?>"
            localStorage.products = JSON.stringify(products);
            return;
          }
    })


    var goToCartIcon = function($addTocartBtn){
      var $cartIcon = $(".my-cart-icon");
      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
      $addTocartBtn.prepend($image);
      var position = $cartIcon.position();
      $image.animate({
        top: position.top,
        left: position.left
      }, 500 , "linear", function() {
        $image.remove();
      });
    }

    $('.my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      affixCartIcon: true,
      checkoutCart: function(products) {

		$.ajax({
			  type: 'POST',
			  url: '<?= $base_url ?>'+'action/transaction.php',
			  dataType: 'json',
			  data: {products: products},
			  success: function(res){
				  console.log(res)
			  }
		  })
        $.each(products, function(i,val){
          console.log(val);
		  
        });
      },
      clickOnAddToCart: function($addTocart){
        goToCartIcon($addTocart);
      },
      getDiscountPrice: function(products) {
        var total = 0;
        $.each(products, function(){
          total += this.quantity * this.price;
        });
        return total * 1;
      }
    });

  });
  </script>
  
</body>
</html>