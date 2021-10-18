-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2021 at 08:12 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olshop_petshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_kategori` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `id_barang`, `nama_barang`, `harga`, `stok`, `deskripsi`, `id_kategori`) VALUES
(1, 1, 'Pedigree Meat Jerky', 10000, 100, 'Tes', 2),
(2, 2, 'Pure Vet Liquid Degreaser 250 ml', 50000, 15, 'Tes2', 3),
(7, 3, 'Felibite 20Kg', 20000, 22, 'Tes', 2),
(8, 4, 'Dompet Koin Karakter', 13000, 100, 'Tes1', 5),
(9, 5, 'Pedigree Puppy Pouch 130gr', 13000, 11, 'Tes1', 2),
(10, 6, 'BUNNY EARS BED - ALAS TIDUR HEWAN', 100000, 15, 'Tes1', 5),
(11, 7, 'HAPPY CAT POUCH SENSITIVE SKIN & COAT 85gr', 15000, 15, 'Tes1', 2),
(12, 8, 'Cattiee Cat Kaleng 400gr - makanan kaleng kucing', 15000, 15, 'Tess1', 2),
(13, 9, 'M-Pets SNAIL COMBI Food & Water Dispenser 2800 ml / 240 g', 200000, 15, 'Tes2', 5),
(14, 10, 'Cat Toys Bola Bulu - Mainan Kucing Interaktif', 15555, 15, 'Tes5', 5),
(15, 11, 'Gunting Kuku GK 5005L - Perawatan Kuku Kucing Anjing', 155552, 12, 'Tes2', 3),
(16, 12, 'Kandang Tingkat 3 (75x45x105 cm Tanpa Roda)', 1500000, 17, 'Tes2', 11),
(17, 13, 'Alat Pijat Hewan Rechargeable - Alat Pijat Elektrik', 544444, 15, 'Tes6', 3),
(18, 14, 'Tas Kucing Anjing Lipat - Pet Cargo Kucing Anjing PC53 - Tas Astronot', 300000, 90, 'Tes6', 11),
(19, 15, 'Kandang Alumunium Kucing 4 Kamar', 5000000, 15, 'Tes2', 11),
(20, 16, 'Kandang Alumunium Kucing 2 Kamar', 3000000, 3, 'Tes5', 11),
(21, 17, 'Grooming Set #1 - Gunting & Sisir Kucing Anjing', 105000, 5, 'Tes7', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gambar`
--

CREATE TABLE `tbl_gambar` (
  `id_gambar` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gambar`
--

INSERT INTO `tbl_gambar` (`id_gambar`, `id_barang`, `gambar`) VALUES
(1, 1, 'pedigree-meat-jerky.jpg'),
(2, 1, 'pedigree-meat-jerky-2.jpg'),
(3, 2, 'pure-vet-liquid-degreaser.jpg'),
(8, 3, 'felibite.jpg'),
(9, 4, 'b6e9dbe6-421f-4d78-bb83-d8c8e429fe32.jpg'),
(10, 5, 'e255bd7d-7dea-4dfd-9606-f1d795c34c19.jpg'),
(11, 6, '2d59029e-d247-4fb3-9168-7fb0c0c30a0b.jpg'),
(12, 7, 'bafd0f18-7b16-40a7-8365-f4c40c418470.jpg'),
(13, 8, 'ca1f7f7e-d872-4d94-b9ce-2d85c682e5b5.jpg'),
(14, 9, '7eee2568-d3da-49f1-9b27-45d0e556a25e.jpg'),
(15, 10, '0e8cc6e6-7079-4f40-8d2d-e8876cc8ead4.jpg'),
(16, 11, '864bf0fd-8fa1-4cce-a8f5-f809a827a58a.jpg'),
(17, 12, '38b63ade-970c-49c5-aad9-f56ab7a8cd5e.jpg'),
(18, 13, 'f2603826-20f3-404f-ba99-367c874e4f83.jpg'),
(19, 14, '8cc33ec2-4d16-4acc-8d21-15e00ead008b.jpg'),
(20, 15, 'a6a8c4cd-670d-4ebf-a7c0-ceb473cdf6ca.jpg'),
(21, 16, 'e329b50b-5e5f-4043-9008-d79b2c7cda8c.jpg'),
(22, 17, '1117599_96f9f32d-4660-4686-9982-d2bf94b4934e.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(2) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Snack'),
(3, 'Grooming'),
(5, 'Accessories'),
(11, 'Kandang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemesanan`
--

CREATE TABLE `tbl_pemesanan` (
  `id_pemesanan` int(5) NOT NULL,
  `id_users` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `jml_barang` int(5) NOT NULL,
  `no_order` int(10) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `status_bayar` char(2) NOT NULL COMMENT ' 0 = belum bayar, 1 = sudah bayar, 2 = sedang dikirim , 3 = diterima',
  `alamat_pengiriman` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pemesanan`
--

INSERT INTO `tbl_pemesanan` (`id_pemesanan`, `id_users`, `id_barang`, `jml_barang`, `no_order`, `tanggal_pemesanan`, `status_bayar`, `alamat_pengiriman`) VALUES
(4, 1, 2, 1, 56942, '2021-10-13 15:44:25', '1', 'Alamat'),
(5, 1, 6, 1, 56942, '2021-10-13 15:44:25', '1', 'Alamat'),
(7, 1, 3, 2, 84822, '2021-10-13 18:32:47', '3', 'Alamat'),
(8, 1, 5, 1, 84822, '2021-10-13 18:32:47', '3', 'Alamat'),
(9, 1, 4, 2, 84822, '2021-10-13 18:32:47', '3', 'Alamat'),
(10, 1, 14, 1, 82092, '2021-10-13 18:33:42', '3', 'Alamat'),
(11, 1, 15, 2, 82092, '2021-10-13 18:33:42', '3', 'Alamat'),
(38, 2, 4, 2, 18709, '2021-10-16 16:57:24', '0', 'Alamat Admin'),
(39, 2, 3, 1, 18709, '2021-10-16 16:57:24', '0', 'Alamat Admin'),
(40, 2, 6, 1, 18709, '2021-10-16 16:57:24', '0', 'Alamat Admin'),
(41, 5, 3, 1, 53573, '2021-10-16 19:19:34', '0', 'Plosokuning\r\nGantalan'),
(42, 5, 5, 1, 53573, '2021-10-16 19:19:34', '0', 'Plosokuning\r\nGantalan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `deskripsi`, `alamat`, `email`, `telp`, `facebook`, `twitter`) VALUES
(1, 'Lorem ipsum dolor sit amet', '12K Street , 45 Building Road Canada.', 'info@example1.com', '+1234 758 839', 'https://twitter.com/@dadang', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimoni`
--

CREATE TABLE `tbl_testimoni` (
  `id_testimoni` int(5) NOT NULL,
  `id_users` int(5) NOT NULL,
  `no_order` int(10) NOT NULL,
  `bintang` int(2) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_testimoni`
--

INSERT INTO `tbl_testimoni` (`id_testimoni`, `id_users`, `no_order`, `bintang`, `keterangan`) VALUES
(1, 1, 82092, 4, 'mantap');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaction` int(5) NOT NULL,
  `no_order` int(10) NOT NULL,
  `transaction_id` text NOT NULL,
  `gross_amount` double NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `batas_bayar` varchar(30) NOT NULL,
  `transaction_status` varchar(10) NOT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `va_number` varchar(15) DEFAULT NULL,
  `fraud_status` varchar(20) NOT NULL,
  `bca_va_number` varchar(20) DEFAULT NULL,
  `permata_va_number` varchar(20) DEFAULT NULL,
  `pdf_url` text NOT NULL,
  `bill_key` varchar(20) DEFAULT NULL,
  `biller_code` varchar(20) DEFAULT NULL,
  `payment_code` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaction`, `no_order`, `transaction_id`, `gross_amount`, `payment_type`, `batas_bayar`, `transaction_status`, `bank`, `va_number`, `fraud_status`, `bca_va_number`, `permata_va_number`, `pdf_url`, `bill_key`, `biller_code`, `payment_code`, `status`) VALUES
(1, 10620, '3780a8e8-9749-4fa3-84ef-efc6f51f18d2', 5068000, 'cstore', '2021-10-16 17:30:19', 'pending', '', '', 'accept', '', '', 'https://app.sandbox.midtrans.com/snap/v1/transactions/55db668f-b1b2-4995-8c6d-c0af8b4223ec/pdf', '', '', '5687491310559291', '201'),
(3, 18709, '04b27c12-bd1f-4362-a12c-bc71dc4754f9', 146000, 'bank_transfer', '2021-10-16 17:57:48', 'pending', 'bca', '57589178209', 'accept', '57589178209', '', 'https://app.sandbox.midtrans.com/snap/v1/transactions/dcf8a42f-06ab-4af5-a35a-a138c6cc4290/pdf', '', '', '', '201');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_users` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kode_post` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `hak_akses` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `nama`, `nama_belakang`, `username`, `password`, `email`, `no_hp`, `kota`, `kode_post`, `alamat`, `gambar`, `hak_akses`) VALUES
(1, 'Alfansyah', 'Pratama', 'member', '$2y$10$x6aiVJuqyJrzEueF8bWZ8...xm8KetOOaWDt7rlIjePc7l3qbfnzS', 'alfansyahpratama52@gmail.com', '081390840870', 'Yogyakarta', '55581', 'Jalan Kebangkitan', 'javascript-logo.png', '0'),
(2, 'admin', '', 'admin', '$2y$10$rCRK5k6XypVXvIK00SjBjunzi/raf3AAjIVL7ieixUBmeoPDgaN7i', 'alfansyah@gmail.com', '0813', '', '', 'Alamat Admin', 'admin.png', '1'),
(5, 'Wawan', 'Alamsyah', 'alfansyahgg', '$2y$10$ag5QtIb0b7ZVllLixq/tVONCK5PXQb1ZSt3Kea.3dW/eiEuk3tdLS', 'alfansyahpratama52@gmail.com', '81390840870', 'Yogyakarta', '55581', 'Plosokuning\r\nGantalan', 'sia.png', '0'),
(9, 'dadang', 'syah', 'dadang', '$2y$10$YHH6PCthfVUBbZp4vF17O.c5xuLCgPKNjSKV5jVLXfFjZLrgWlkl.', '', '', '', '', '', '', '0');

--
-- Triggers `tbl_users`
--
DELIMITER $$
CREATE TRIGGER `hapus_data_user` AFTER DELETE ON `tbl_users` FOR EACH ROW BEGIN
    delete from tbl_pemesanan where id_users = old.id_users;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testimoni`
--
ALTER TABLE `tbl_testimoni`
  ADD PRIMARY KEY (`id_testimoni`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaction`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_gambar`
--
ALTER TABLE `tbl_gambar`
  MODIFY `id_gambar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  MODIFY `id_pemesanan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_testimoni`
--
ALTER TABLE `tbl_testimoni`
  MODIFY `id_testimoni` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaction` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_users` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
