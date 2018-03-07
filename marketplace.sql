-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2017 at 01:53 
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `judul_kategori` char(50) NOT NULL,
  `slug_kat` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `judul_kategori`, `slug_kat`) VALUES
(1, 'Fashion Pria', 'fashion-pria'),
(2, 'Fashion Wanita', 'fashion-wanita'),
(3, 'Fashion Anak', 'fashion-anak'),
(4, 'Handphone & Tablet', 'handphone--tablet'),
(5, 'Elektronik', 'elektronik'),
(6, 'Kesehatan', 'kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `produk_id`, `user_id`, `isi_komentar`, `created`) VALUES
(1, 15, 7, 'test', '2017-09-29 10:01:23'),
(2, 15, 7, 'asdasd', '2017-09-29 10:02:28'),
(3, 15, 7, 'asdasdasd', '2017-09-29 10:03:09'),
(4, 15, 7, 'asdadwad', '2017-09-29 10:16:16'),
(5, 13, 7, 'test again', '2017-09-29 10:24:29'),
(6, 15, 9, 'testing komen', '2017-09-30 08:38:53'),
(7, 14, 11, 'test berikan komentar', '2017-09-30 09:25:22'),
(8, 16, 12, 'berapa harga fixnya gan?', '2017-09-30 09:56:04'),
(9, 10, 13, 'test komen', '2017-09-30 16:24:41'),
(10, 13, 14, 'coba komen gan', '2017-09-30 20:33:45'),
(11, 16, 15, 'harga nettnya berapa gan?', '2017-09-30 20:52:38'),
(12, 11, 15, 'test dengan benar', '2017-10-03 08:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '::1', 'superadmin', 1507333602);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `judul_produk` varchar(100) NOT NULL,
  `slug_produk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `kat_id` int(11) NOT NULL,
  `subkat_id` int(11) NOT NULL,
  `supersubkat_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `kondisi` char(10) NOT NULL,
  `berat` int(11) NOT NULL,
  `foto` text NOT NULL,
  `foto_type` char(10) NOT NULL,
  `uploader` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `judul_produk`, `slug_produk`, `deskripsi`, `kat_id`, `subkat_id`, `supersubkat_id`, `harga`, `kondisi`, `berat`, `foto`, `foto_type`, `uploader`, `created`, `updater`, `modified`) VALUES
(1, 'HEADSET JBL HD-MICROPHONE MS-176', 'headset-jbl-hd-microphone-ms-176', '<p>HEADSET JBL HD-MICROPHONE MS-176 HEADPHONES<br>BY HERMAN<br>HEAR THE TRUTH<br><br>SOUND STEREO FOR SMARTPHONE YOU BEST CHOICE<br><br>READY COLOUR :<br>- MERAH<br>- UNGU<br>- SILVER<br>- HITAM</p>', 5, 5, 12, 250000, 'Baru', 200, 'headset-jbl-hd-microphone-ms-176-headphones20170911004338', '.jpg', 1, '2017-08-25 10:33:39', 0, '2017-09-30 09:42:55'),
(2, 'Speaker Bluetooth JBL Micro wireless', 'speaker-bluetooth-jbl-micro-wireless', '<p>Speaker Bluetooth JBL Micro Wireless<br /><br />Ready Warna : Hitam&nbsp;<br /><br />Audio Specifications<br />Drivers 1 x 1-5/8" (40mm)<br />Input Connections 1/8" (3.5mm) mini stereo jack<br />Frequency Response 150 Hz 20 kHz<br /><br />General Specifications<br />Input Requirements 1/8" (3.5mm) stereo mini jack<br />Power 3 watts<br />Weight (Metric/English) 4.5 oz. (127g)<br />Dimensions: Subwoofer (H x W x D Metric/English) 3-1/4" x 1-9/16" (83mm x 39mm)<br />Special Features : Battery power up to 5 hours</p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: center;"><img src="http://localhost/marketplace/assets/images/upload/73035922_1f7260ef-65ec-4800-864f-7892b60c5f0d_700_519.jpg" /></p>', 5, 5, 11, 400000, 'Baru', 0, 'speaker-bluetooth-jbl-micro-wireless20170911004132', '.jpg', 2, '2017-08-26 12:30:46', 0, '2017-09-30 09:42:32'),
(3, 'Speaker bluetooth SP500', 'speaker-bluetooth-sp500', '<p>SPeaker bluetooth ORIGINAL bukan palsu<br>merek SLEC import<br><br>Speaker dengan design unik<br>memberikan kemudahan dengan <br>USB slot<br>Bluetooth connection<br>micro sd connection<br>plug in langungs<br><br>portable dibawa kemana aja<br>dimensi panjang x lebar x tinggi = 18 x 5,5 x 5</p>\r\n<p> </p>\r\n<p><img src="http://localhost/marketplace/assets/images/upload/123093_39820925-309f-473d-a553-dd0afdf9fcf3.png"></p>', 5, 5, 11, 500000, 'Seken', 110, 'speaker-aktif-bluetooth-slec-sp-500-limited20170911003713', '.jpg', 1, '2017-08-26 12:31:05', 0, '2017-09-30 09:43:01'),
(5, 'REMOTE TV POLYTRON ORI', 'remote-tv-polytron-ori', '<p>Toko kami hanya menjual remote POLYTRON Original.<br>Langsung pakai gak usah setting lagi<br><br>Ciri remot asli:<br>Dibawah tulisan POLYTRON ada no seri 81F579, 81F414, 81F414M01.<br>Yg terbaru motif permukaan hair line/bergaris.<br><br>Perbedaan permukaan :<br>81F579 -> lama, permukaan doff<br>81F579M01->baru,permukaan motif bergaris<br><br>Perbedaan tombol :<br>81F41M01->printing EFEC<br>81F579->printing SLEEP<br>secara fungsi sama hanya beda printing <br><br>Bisa dipakai di semua TV Polytron yg menggunakan remote seperti foto.<br><br>Mohon sebelum beli dipastikan receiver remote pada tv masih baik.<br><br>Cek remote lama dgn camera hp, arahkan ujung remote ( LED IR ) tekan tombol. Jika tidak terlihat kedip-kedip maka kondisi remote rusak.<br>(Catatan kondisi battery bagus ya).<br><br>Saat ini hanya keluar 81F414M01 dan bisa saling menggantikan.<br><br>100% ASLI<br>TIDAK ASLI UANG KEMBALI<br><br>Salam Hemat.</p>', 5, 6, 9, 85000, 'Seken', 5, 'remote-tv-polytron-oriasli-ledlcd20170911000741', '.jpg', 3, '2017-08-26 12:37:42', 0, '2017-09-30 09:43:39'),
(6, 'Remote TV LCD LED LG AKB', 'remote-tv-lcd-led-lg-akb', '<p>Dapat digunakan untuk semua TV LG LCD LED dengan remote kode AKB di depannya.<br>Berhubung stoknya terbatas dan ada beberapa model (bentuknya sama, tapi tombol berbeda) maka akan diberikan random sesuai stok.<br><br><br>-Bonus baterai<br>-Bonus packing menggunakan bubble wrap<br><br>Jasa pengiriman yang disarankan<br>-GO-SEND jika masih terjangkau areanya, hanya 15rb sampai dihari yang sama. (Same day). Batas order masuk jam 3 sore.<br>-JNE / TIKI (Paling banyak digunakan)<br>-WAHANA (murah, namun agak lebih lama)</p>\r\n<p> </p>\r\n<p><img src="http://localhost/marketplace/assets/images/upload/6158561_2040de33-2939-42ba-8b0c-6bd8a1111663.jpg"></p>', 5, 6, 9, 50000, 'Baru', 14, 'remot-remote-tv-lcd-led-lg-akb-original20170911000340', '.jpg', 3, '2017-08-26 12:38:12', 0, '2017-09-30 09:43:40'),
(7, 'SAMSUNG LED TV 40 INCH - 40J5000', 'samsung-led-tv-40-inch-40j5000', '<p>Barang Baru & Original 100%<br>*Jamin Bergaransi Resmi<br>*Garansi Termasuk Spare Part & Service <br>*Hanya Pengiriman Daerah bekasi utara Dikenakan Ongkir 1 Kg Jne Reg<br>*gratis ongkir jakarta bekasi depok tanggrang (tergantung lokasi paling kasih uang bensin aja gan) atau gak pake gojek aja. luar kota di sebutkan kena charge pengiriman <br>*luar jabotabek bisa via kurir expedisi lain yg murah. inbox aja buat info ongkir nya<br>*Pembayaran Ongkos Kirim Bekasi, Depok, Tangerang Di Berikan Ketika Barang Sampai tujuan (Kepada Kurir Kami)<br>*Pengiriman Hanya Jabodetabek<br>*Pengiriman Menggunakan Kurir Kami Sendiri<br>*Bila Ada Pemesanan Luar Jabodetabek Akan Kami berikan tambahan ongkir sesuai jasa expedisi yg di gunakan (tanya aja dulu untuk biayanya ke saya)<br>* bila ad pembelian di luar pulau jawa akan di cancle<br>*Kami Juga Memliki Toko Off Line Di Daerah bekasi utara dekat dengan sumaracon mall bekasi<br><br>Temukan Pengalaman Baru dengan Teknologi Full HD<br><br>Beragam Warna untuk Gambar yang Lebih Baik<br><br>Menggunakan algoritma peningkatan kualitas gambar yang canggih, Samsung Wide Color Enhancer secara drastis meningkatkan kualitas gambar dan menampilkan detail yang tersembunyi. Sekarang Anda dapat melihat warna sebagaimana warna itu dihasilkan dengan Wide Color Enhancer. <br><br>Menonton Film dari USB Anda <br><br>Dengan ConnectShare Movie, Anda langsung bisa menikmati film, foto dan musik hanya dengan menghubungkan USB memory drive atau HDD ke TV. Duduklah dengan nyaman di ruang keluarga Anda, dan nikmati beragam hiburan.<br><br>*Konten dalam format AVI, ASF, MP3, JPEG dan lainnya. Lihat manual untuk daftar lengkap format yang kompatibel<br><br>Membawa Beragam Pusat Hiburan di Ruang Keluarga Anda<br><br>Dengan input High Definition Multimedia Interface (HDMI), Samsung TV akan mengubah ruang keluarga Anda menjadi pusat hiburan. HDMI mentransfer data digital berdefinisi tinggi dari berbagai perangkat ke TV Anda dengan cepat.</p>\r\n<p><img src="https://mojito.tokopedia.com/recentview/pixel.gif?user_id=8936732&product_id=139887475&device=desktop&source=product_info"></p>', 5, 6, 8, 3999999, 'Seken', 90, 'samsung-led-tv-40-inch-40j5000-free-ongkir-bracket20170911000158', '.jpg', 3, '2017-08-26 12:41:56', 0, '2017-09-30 09:43:40'),
(8, 'SHARP LED TV 24 Inch - LC-24LE170i ASDAs asdasd', 'sharp-led-tv-24-inch-lc-24le170i-asdas-asdasd', '<p>Sharp LC24LE170I_B merupakan LED TV yang hadir dengan layar sebesar 24 inci. TV ini dirancang dengan Fitur Antenna Booster. Fitur tersebut berfungsi untuk memperkuat sinyal yang diterima oleh antena, sehingga dapat berpengaruh besar untuk memperjernihkan kualitas gambar serta menghilangkan gambar berbayang. Adanya konektor USB pada TV, sehingga Anda dapat memutar file foto dan musik yang disimpan dalam flash disk.<br><br>Detail<br>- Screen Size: 24" (60 cm)<br>- Resolution: 1.366 x 768 pixels<br>- Backlight System: AQUOS LED (Edge-Lit)<br>- TV Receiving Analog Systems: PAL: B/G, D/K, I SECAM: B/G, D/K, K/K1 NTSC: M<br>- Antenna Booster: Yes<br>- Video Colour Systems: PAL/SECAM/NTSC 3.58/NTSC 4.43<br>- Decoder: Digital<br>- Audio output: 3 watt x 2<br>- Stereo systems: NICAM / A2<br>- Surround: Original Surround<br>- 1080/24P: Yes<br>- Terminal: Video In x 1, Component In x 1, HDMI x 1<br>- Power Supply: AC 110 - 240 volt - 50/60 Hz<br>- Consumption: 35 Watt<br>- USB Player: Music (Mp3), Photo Viewer, Video Player<br>- Dimension Without Stand: 54.9 x 32.6 x 8.3 cm<br>- Dimension With Stand: 54.9 x 34.6 x 15 cm<br>- Weight Without Stand: 2.7 kg<br>- Weight With Stand: 2.9 kg</p>', 5, 6, 8, 500, 'Seken', 200, 'sharp-led-tv-24-inch-lc-24le170i20170911000046', '.jpg', 1, '2017-08-28 06:24:46', 0, '2017-09-30 09:43:09'),
(9, 'LED TV Ikedo LT-22P1U LED 22', 'led-tv-ikedo-lt-22p1u-led-22', '<p>Specification :<br>Ikedo Monitor LT-22P1U LED 22<br>LED TV Ikedo LT-22P1U tampil dengan desain yang elegan dan futuristik, TV LED dengan format 16:9 dari Ikedo ini menghadirkan berbagai fitur fungsional yang menarik dan canggih. Nikmati berbagai acara dan film bersama teman dan keluarga Anda dan rasakan kualitas gambar yang tajam dan jernih. Desain elegan dan futuristik. Ikedo tampil dengan desain yang tampak elegan. Dibalut dengan warna putih yang solid dan menawan. Bentuknya yang tipis menambah kesan mewah pada televisi ini. Layar HD. Ikedo LT-22P1U mengusung layar LED yang memiliki resolusi 1920 x 1080. Dengan format 16:10, televisi ini mampu menampilkan gambar dalam kualitas HD yang lebih jelas dan tajam sehingga Anda bisa menikmati film kesukaan dengan lebih puas. Konektivitas. Sebagai penambahan fitur multimedia, tersedia slot USB 2.0 yang dapat digunakan untuk menampilkan file multimedia Anda. Adanya slot ini memungkinkan Anda untuk menampilkan foto ataupun memutar lagu yang ada dalam USB. Terdapat pula slot HDMI, RGB dan AV PC Audio input.</p>', 5, 6, 8, 800, 'Baru', 70, 'led-tv-ikedo-lt-22p1u-led-2220170910235958', '.jpg', 1, '2017-08-28 08:32:53', 0, '2017-09-30 09:43:25'),
(10, 'CHANGHONG LED TV 32 INCH - 32E6000', 'changhong-led-tv-32-inch-32e6000', '<p>CHANGHONG LED TV 32 inch - 32E6000<br /><br /><br />HEVC<br /><br />HEVC (atau H.265) adalah standar generasi berikutnya untuk melampaui MPEG-4 / H.264. Hal ini mungkin mampu mempunyai kualitas output yang sama seperti H.264, tetapi membutuhkan setengah bandwidth.<br /><br /><br />The Ultra Clear Video Processor Engine<br /><br />Mencakup alat color-turning sukses dan sebuah multi-dimensional color/sharpening/NR formula yang dapat dengan cepat bisa mencerminkan perubahan halus dan lebih gelap, terang, atau, adegan campuran.<br /><br /><br />Triple Energy Saving<br /><br />Komponen lebih sedikit dan lebih gembira. Changhong LED TV adalah TV ramah lingkungan yang sangat berkurang komponen yang tidak perlu. Dengan teknologi canggih, hemat energi dari struktur, chipset dan mother-board, TV memberikan gambar yang menakjubkan dan suara sementara menghemat energi kurang dari yang tradisional.<br /><br /><br />HDMI<br /><br />Meningkatkan sinyal visual dan audio digital untuk menjamin gambar yang sempurna dan kualitas suara.<br /><br /><br />Narrow Bezel<br /><br />Changhong desain tipis bezel membuat bezel layar yang lebih tipis, ringkas dan modis, menjadi bagian dari rumah tangga modern.<br /><br /><br />USB 2.0<br /><br />Kebahagiaan perlu dibagikan. Dengan menghubungkan kamera digital Anda, MP3, MP4 atau kartu memori dengan TV untuk menampilkan video, musik dan gambar melalui Info Link USB 2.0, Anda dapat dengan mudah berbagi memori Anda setiap detail menyentuh dalam kehidupan sehari-hari keluarga dan teman-teman.<br /><br /><br />Eco-Friendly<br /><br />ECO-Friendly TV komponen lebih sedikit dan lebih gembira. Changhong LED TV adalah TV ramah lingkungan yang sangat berkurang komponen yang tidak perlu. Dengan teknologi canggih hemat daya, TV memberikan gambar yang menakjubkan dan suara sementara menghemat energi kurang dari yang tradisional.<br /><br /><br />Detail<br /><br />Resolution : 1366 * 768<br /><br />Audio Output : 8W x 2<br /><br />HDMI : 3<br /><br />USB : 1<br /><br />VGA : 1</p>', 5, 6, 8, 2500000, 'Seken', 60, 'changhong-led-tv-32-inch-32e600020170923041101', '.jpg', 2, '2017-09-13 05:33:27', 1, '2017-09-30 09:43:23'),
(11, 'Ransel CK 009 Super Tas Ransel Import CK 3 in 1', 'ransel-ck-009-super-tas-ransel-import-ck-3-in-1', '<p>Bahan kulit taiga<br />warna resleting sama seperti warna tas (bukan gold) <br />Dalaman kain <br />Model 3in1 : Ransel, Tenteng , Slempang</p>', 2, 4, 4, 456, 'Baru', 40, 'ransel-ck-009-super-tas-ransel-import-ck-3-in-120170923034758', '.jpg', 1, '2017-09-17 20:06:32', 0, '2017-09-30 09:43:22'),
(12, 'Sepatu Adidas Yeezy Boost PREMIUM BNIB Abu Moonrock Yezzy', 'sepatu-adidas-yeezy-boost-premium-bnib-abu-moonroc', '<p>SIZE : 36 - 46<br>MENDAPAT BOX OFFICIAL ADIDAS YEEZY (Coklat)<br><br>- Jaminan sesuai gambar (beda boleh dikembalikan)<br>- New Product, No Reject<br>- Premium Quality BNIB<br>- Harga kompetitif dengan kualitas terbaik<br><br>Sebelum order sebaiknya bertanya stok dahulu supaya menghindari Refund, soalnya sewaktu-waktu bisa habis. Harap maklum.</p>\r\n<p><img xss=removed src="http://localhost/marketplace/assets/images/upload/13231065_b032c324-6292-4fc7-88ab-e6ae551619ef_1008_756.jpg"></p>', 1, 1, 1, 950000, 'Seken', 20, 'sepatu-adidas-yeezy-boost-premium-bnib-abu-moonrock-yezzy20170923040643', '.jpg', 3, '2017-09-18 08:33:04', 1, '2017-09-30 09:43:42'),
(13, 'Sepatu Adidas Superstar Original', 'sepatu-adidas-superstar-original', '<p>Merek. :Adidas Superstar<br />Type. :casual<br />Warna :white black<br />Size. : 36,371/3, 38, 391/3 ,40,41,42,431/3,44 <br />Quality :Original 100% BNWB<br />Manufacture :indonesia</p>', 1, 1, 1, 400000, 'Baru', 10, 'sepatu-adidas-superstar-original20170930082117', '.jpg', 3, '2017-09-20 08:00:30', 1, '2017-09-30 09:43:43'),
(14, 'Dompet Wanita Import Dolly Wallet', 'dompet-wanita-import-dolly-wallet', '<p>asdasd</p>', 2, 4, 3, 150000, 'Seken', 200, 'dompet-wanita-import-dolly-wallet20170923034632', '.jpg', 1, '2017-09-20 08:10:44', 1, '2017-09-30 09:43:15'),
(15, 'Sepatu Adidas Alphabounce Vietnam', 'sepatu-adidas-alphabounce-vietnam', '<p>BIG SALE HARGA AWAL Rp, 290000<br>( TIDAK PUAS BARANG TIDAK SESUAI KEMBALI UANG 100% DAN ONGKIR KAMI GANTI )<br><br>UKURAN 39 40 41 42 43 44<br>-RESELLER<br>-DROPSHIPER<br>-GROSIR<br>-ECERAN<br><br></p>', 1, 1, 1, 340000, 'Seken', 44, 'sepatu-salecasual-adidas-alphabounce-vietnam20170923035757', '.jpg', 2, '2017-09-21 10:17:24', 1, '2017-09-30 09:43:30'),
(16, 'Tas Handbag Ashanty Abu-Abu Murah', 'tas-handbag-ashanty-abu-abu-murah', '<p>NER ARRIVAL<br><br>CK ASHANTY <br><br>Size 28x18x9cm<br>Material saffiano<br>Inner suede<br>Ada tali panjang<br>Free dustbags (kain polos)</p>', 2, 4, 3, 500000, 'Seken', 22, 'tas-handbag-ashanty-abu-abu-murah20170923034430', '.png', 1, '2017-09-21 10:39:43', 1, '2017-09-30 09:43:31'),
(17, 'Sepatu Nike Air Force One Full White', 'sepatu-nike-air-force-one-full-white', '<p>NIKE AIR FORCE full white<br><br>foto asli produk,<br>size 36 sampai 40<br>include box nike<br><br>sepatu nyaman</p>', 1, 1, 1, 250000, 'Baru', 11, 'sepatu-nike-air-force-one-full-white20170923035526', '.jpg', 2, '2017-09-21 10:41:20', 1, '2017-09-30 09:43:32'),
(18, 'Percobaan Penambahan Iklan', 'percobaan-penambahan-iklan', '<p>asdasdasdasd</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 1, 1, 1, 500000, 'Baru', 33, 'percobaan-penambahan-iklan20170930084200', '.jpg', 3, '2017-09-30 08:42:00', 0, '2017-09-30 09:43:44'),
(19, 'Coba Upload Iklan Baru', 'coba-upload-iklan-baru', '<p>ini merupakan foto tambahan dari iklan ini</p>\r\n<p><img src="https://marketplace.azmicolejr.com/assets/images/upload/0_c1363a56-8ce1-435c-a387-44a6d037da0c_720_7441.jpg" /></p>', 5, 6, 8, 600000, '', 0, 'coba-upload-iklan-baru20170930100005', '.jpg', 1, '2017-09-30 10:00:05', 0, NULL),
(21, 'Percobaan Ke Sekian Kalinyas', 'percobaan-ke-sekian-kalinyas', '<p>asdasdads</p>\r\n<p><img src="https://marketplace.azmicolejr.com/assets/images/upload/668103_8fe93780-d1bb-45af-b396-9103723a2fb0.jpg"></p>', 1, 1, 1, 250000, '', 0, 'percobaan-ke-sekian-kalinya20170930203536', '.jpg', 14, '2017-09-30 20:35:36', 2, '2017-10-04 15:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `link` text NOT NULL,
  `userfile` text NOT NULL,
  `userfile_type` char(10) NOT NULL,
  `userfile_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `no_urut`, `link`, `userfile`, `userfile_type`, `userfile_size`) VALUES
(2, 2, 'adasdasd', '220170929185757', '.jpg', 129),
(3, 3, 'asdasdasdasd', '3', '.jpg', 31),
(4, 1, 'tasdad', '320170929190034', '.jpg', 167);

-- --------------------------------------------------------

--
-- Table structure for table `subkategori`
--

CREATE TABLE `subkategori` (
  `id_subkategori` int(11) NOT NULL,
  `id_kat` int(11) NOT NULL,
  `judul_subkategori` char(50) NOT NULL,
  `slug_subkat` char(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkategori`
--

INSERT INTO `subkategori` (`id_subkategori`, `id_kat`, `judul_subkategori`, `slug_subkat`, `keterangan`) VALUES
(1, 1, 'Sepatu', 'sepatu', ''),
(2, 1, 'Jam Tangan', 'jam-tangan', ''),
(3, 2, 'Dress', 'dress', ''),
(4, 2, 'Tas', 'tas', ''),
(5, 5, 'Audio', 'audio', ''),
(6, 5, 'TV', 'tv', ''),
(7, 3, 'Tas Anak', 'tas-anak', ''),
(8, 4, 'Handphone', 'handphone', ''),
(9, 6, 'Obat-Obatan', 'obatobatan', '');

-- --------------------------------------------------------

--
-- Table structure for table `supersubkategori`
--

CREATE TABLE `supersubkategori` (
  `id_supersubkategori` int(11) NOT NULL,
  `id_subkat` int(11) NOT NULL,
  `id_kat` int(11) NOT NULL,
  `judul_supersubkategori` char(50) NOT NULL,
  `slug_supersubkat` char(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supersubkategori`
--

INSERT INTO `supersubkategori` (`id_supersubkategori`, `id_subkat`, `id_kat`, `judul_supersubkategori`, `slug_supersubkat`, `keterangan`) VALUES
(1, 1, 1, 'Sneakers', 'sneakers', 'Tampil stylish dengan koleksi sneakers pria model terbaru & terlengkap, pilih dari harga terbaik. Beli beragam sneakers dari aneka desain & warna, pilih dari berbagai bahan berkualitas dari karet, bahan sintetis, & canvas. Tampil gaya dengan sepasang trainers casual untuk menemani segala acara mu.'),
(2, 2, 1, 'Jam Tangan Analog', 'jam-tangan-analog', 'Jual Jam Tangan Pria secara online dari harga termurah dan kompilasi merk terlengkap. Hanya di Tokopedia kamu dapat menemukan beragam tipe Jam Tangan Pria, dari Jam Tangan mekanik atau Jam Tangan otomatis maupun Jam Tangan Q&Q Quartz (dengan baterai). Temukan koleksi Arloji Pria kualitas terbaik.'),
(3, 4, 2, 'Hand Bag', 'hand-bag', ''),
(4, 4, 2, 'Shoulder Bag', 'shoulder-bag', ''),
(5, 3, 2, 'Mini Dress', 'mini-dress', ''),
(6, 3, 2, 'Maxi Dress', 'maxi-dress', ''),
(7, 2, 1, 'Jam Tangan Keren', 'jam-tangan-keren', ''),
(8, 6, 5, 'LED TV', 'led-tv', ''),
(9, 6, 5, 'Remote TV', 'remote-tv', ''),
(10, 6, 5, 'Antena TV', 'antena-tv', ''),
(11, 5, 5, 'Speaker', 'speaker', ''),
(12, 5, 5, 'Headset', 'headset', ''),
(13, 7, 3, 'Tas Backpack Anak', 'tas-backpack-anak', ''),
(14, 8, 4, 'Case Handphone', 'case-handphone', ''),
(15, 9, 6, 'Obat Generik', 'obat-generik', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `alamat` text,
  `usertype` char(10) NOT NULL,
  `userfile` text NOT NULL,
  `userfile_type` char(10) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `access` tinyint(1) UNSIGNED DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` datetime DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `email`, `phone`, `alamat`, `usertype`, `userfile`, `userfile_type`, `ip_address`, `salt`, `active`, `access`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `last_login`, `created_on`) VALUES
(1, 'SuperAdmin', 'superadmin', '$2y$08$pVuK0ewbAYDUSNQ16X3bpuHJ3hS/qXiDlg53IfTWtVfpi3wJmVP9i', 'azmi@gmail.com', '081228289766', '', '1', 'superadmin20170903035045', '.jpg', '', NULL, 1, NULL, NULL, 'cFQVzZaA-QPdyo2bNpqhCuc60aa3c78676ea6863', '2017-10-04 13:31:36', NULL, '2017-10-07 06:23:30', '0000-00-00 00:00:00'),
(2, 'Administrator', 'administrator', '$2y$08$lUtBUgpk445.aveEKoxSTOX8AZM9v5Wv4fgESsC.Vy3uld8NGZy9C', 'admin@gmail.com', '', '', '2', 'administrator20170930094042', '.png', '::1', NULL, 1, NULL, NULL, NULL, NULL, NULL, '2017-10-04 14:05:33', '2017-07-14 08:51:00'),
(3, 'Coba Cobas', 'cobacoba', '$2y$08$HQSIrY8upJiwjAvH8EeaPewkIN.keEHKqBc6Cd1Hn/vnF4x6Vd16W', 'coba@gmail.com', '10940124918024', 'AKjdlajsdkl', '3', 'coba-cobas-120170903035808', '.jpg', '::1', NULL, 0, NULL, '41822f3268c262df4bc451482ba00284f5c8074d', NULL, NULL, NULL, NULL, '2017-09-02 10:27:19'),
(15, 'Muhammad Azmi', 'mazmi', '$2y$08$eIVrALBA47L4AMXfNXSeJOgsg6ZGAumMMN6D0dHOrkFvbFfNbsM5.', 'azmi2793@gmail.com', '6281421412', 'Jl. Kopral Anwar Komplek Hayyun Nasyim No.9', '3', 'muhammad-azmi20170930205333', '.jpg', '180.242.44.241', NULL, 1, NULL, NULL, NULL, NULL, NULL, '2017-10-03 11:08:30', '2017-09-30 20:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `users_group`
--

CREATE TABLE `users_group` (
  `id_group` int(11) NOT NULL,
  `name` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_group`
--

INSERT INTO `users_group` (`id_group`, `name`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `subkategori`
--
ALTER TABLE `subkategori`
  ADD PRIMARY KEY (`id_subkategori`);

--
-- Indexes for table `supersubkategori`
--
ALTER TABLE `supersubkategori`
  ADD PRIMARY KEY (`id_supersubkategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_group`
--
ALTER TABLE `users_group`
  ADD PRIMARY KEY (`id_group`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subkategori`
--
ALTER TABLE `subkategori`
  MODIFY `id_subkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `supersubkategori`
--
ALTER TABLE `supersubkategori`
  MODIFY `id_supersubkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users_group`
--
ALTER TABLE `users_group`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
