-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2012 at 12:31 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pend.bio_web`
--
CREATE DATABASE `pend.bio_web` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pend.bio_web`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_album_galeri`
--

CREATE TABLE IF NOT EXISTS `tbl_album_galeri` (
  `id_album` int(10) NOT NULL AUTO_INCREMENT,
  `nama_album` varchar(100) NOT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_album_galeri`
--

INSERT INTO `tbl_album_galeri` (`id_album`, `nama_album`) VALUES
(6, 'Outbond BEM PS PBIO 10 juli 2011 lereng merapi'),
(7, 'Kunjungan BEM PS PBIO Malang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artikel`
--

CREATE TABLE IF NOT EXISTS `tbl_artikel` (
  `id_artikel` int(5) NOT NULL AUTO_INCREMENT,
  `tipe_artikel` varchar(50) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `id_penulis` int(10) NOT NULL,
  PRIMARY KEY (`id_artikel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_artikel`
--

INSERT INTO `tbl_artikel` (`id_artikel`, `tipe_artikel`, `id_kategori`, `judul`, `isi`, `gambar`, `tanggal`, `waktu`, `id_penulis`) VALUES
(8, 'berita', 5, 'BioEnter Membuka Pendaftaran Anggota Baru 2012', '<p style="text-align: justify;">Regenerasi merupakan langkah penting untuk menjaga eksistensi suatu kelompok studi atau organisasi mahasiswa. Regenerasi sejak awal perlu adanya untuk melakukan penyegaran di dalam suatu kelompok studi. Selain itu, anggota baru diharapkan membawa semangat yang baru dan perubahan-perubahan bagi suatu kelompok studi. Begitu juga yang dilakukan teman-teman dari Biologi Entrepreneur atau BioEnter UIN Sunan Kalijaga Yogyakarta. Mereka membuka kesempatan bagi teman-teman lain untuk bergabung dengan BioEnter.</p>\r\n<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bagi siapa pun yang tertarik dapat mendaftarkan diri segera. Adapun syarat dan ketentuannya cukup mudah diantaranya:</p>\r\n<ol style="text-align: justify;">\r\n<li>Fotocopy KTM </li>\r\n<li>Mengisi Formulir pendaftaran </li>\r\n<li>Membayar pendaftaran Rp 5.000,- </li>\r\n<li>Pas Photo berwarna 2 lbr </li>\r\n<li>Mengumpulkan persyaratan ADM ke:</li>\r\n</ol>\r\n<p style="text-align: justify;">Putra&nbsp;&nbsp;&nbsp; : Hanif/085229602058</p>\r\n<p style="text-align: justify;">Putri&nbsp;&nbsp;&nbsp;&nbsp; : Mustini/083867769881&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<ol>\r\n<li style="text-align: justify;">Mengikuti mentoring bisnis BioEnter (untuk pemaparan cara pembuatan bisnis plan pada tanggal 31 Maret 2012, jam 15.00 di Fakultas Sains &amp; Teknologi UIN Sunan Kalijaga)</li>\r\n</ol>', 'intermezo.png', '2011-01-03', '10:00:18', 1),
(19, 'berita', 1, 'Mahasiswa Biologi Menangkan Lomba Kewirausahaan', '<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Tepuk tangan kembali membahana &nbsp;di dalam Ballroom The Rich Jogja Hotel&nbsp; di Jalan Magelang, KM. 6 no. 18 ketika satu persatu pemenang Kompetisi Wirausaha &ldquo;Adu Bussines Plan Paling Joss!&rdquo; dipanggil ke atas panggung. Acara kompetisi ini merupakan salah satu rangkaian acara dari Festival Wirausaha Mahasiswa yang diadakan Program Studi Ilmu Komunikasi UIN Sunan Kalijaga Yogyakarta bekerja sama dengan Muncul Group.</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Acara yang bertujuan untuk menumbuhkan semangat berwirausaha di kalangan mahasiswa ini, kembali mahasiswaprogram studi Biologi UIN Sunan Kalijaga ambil bagian sebagai peserta kompetisi.&nbsp; <strong>Tim Stuner Jaya</strong>, yang terdiri dari Afrizka Premana Sari, Mustini, dan Edy Firdaus ini berhasil meraih juara pertama setelah menyisihkan semua peserta lainnya.&nbsp; Dengan mengangkat konsep bisnis <strong>DOCMA Copy Centre</strong>, tim yang juga semua anggotanya dari Kelompok Studi Wirausaha <strong>Bioenter</strong> ini membuktikan bahwa mahasiswa fakultas Sains dan tekonologi memiliki kemampuan pada bisnis yang mumpuni.</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Acara kompetisi ini terdiri dari pengumpulan proposal bisnis plan dari tanggal 16&ndash;23 Februari 2012 dan diikuti dengan presentasi&nbsp;<em>bussines plan</em>&nbsp;oleh 10 tim terbaik pada tanggal 25 Februari 2012. Dalam kompetisi ini yang menjadi kompetitor tim manajemen dari Muncul Group. &ldquo;Alhamdulillah tidak disangka bisa dapat juara I, padahal pas presentasi &ldquo;dibantai&rdquo; oleh Juri,&rdquo; ujar Mustini, salah satu anggota tim Stuner Jaya. Selain tim Stuner Jaya dari Prodi Biologi memborong juara II, yaitu oleh tim DIGITAL BRAIN dari prodi Teknik Informatika.</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; Acara ini ditutup dengan Seminar motivasi &ldquo;Menjadi Pengusaha sejak Mahasiswa&rdquo; oleh James Gwee, trainer dan motivator bisnis terfavorit di Indonesia yang memberi motivasi kepada sekitar 600 mahasiswa&nbsp; Yogyakarta, khususnya mahasiswa UIN Sunan Kalijaga Yogyakarta.</p>', '28mw1.gif', ' 2012-04-18', '02:10:pm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data`
--

CREATE TABLE IF NOT EXISTS `tbl_data` (
  `id_data` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `data_id` varchar(10) NOT NULL,
  `author` varchar(20) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbl_data`
--

INSERT INTO `tbl_data` (`id_data`, `title`, `content`, `data_id`, `author`) VALUES
(30, 'Profil Prodi', '<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Kemajuan teknologi berbasis biologi berkembang pesat dan menimbulkan kontrovesi di masyarakat seperti kloning atau bayi tabung yang sempat menjadi pro kontra, hal ini terjadi karena berkembangnya ilmu biologi melalui rekayasa genetika. Integrasi dan interkoneksitas ilmu biologi terutama rekayasa genetika dengan keislaman merupakan keunggulan program studi biologi di UIN Sunan Kalijaga yang dilengkapi dengan fasilitas laboratorium yang lengkap dengan peralatan terkini, antara lain laboratorium biologi dasar, zoologi, botani, embriologi, kultur jaringan, mikrobiologi serta laboratorium lain yang terpadu.</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp;Guru biologi mempunyai peranan penting sebagai mediator ilmu biologi ke generasi penerus secara benar untuk menghindari terjadinya miskonsepsi, maka program studi ini berusaha menjadikan guru sebagai sosok yang menguasai ilmu biologi (scientis) secara benar; mudah dipahami dan mampu menumbuhkan kesadaran lingkungan, hal ini juga ditunjang dengan adanya kerjasama CIDA dan UIN serta dosen yang berlatar belakang pendidikan S2 dan S3 dari dalam maupun luar negeri.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>', '1.1', 'admin'),
(2, 'Kompetensi Lulusan', '<p>Memiliki kemampuan :</p>\r\n<ul style="padding-left: 60px;">\r\n<li>Tenaga Pengajar Biologi</li>\r\n<li>Pengelola pendidikan</li>\r\n<li>Peneliti</li>\r\n<li>Konsultan</li>\r\n<li>Penulis/Editor buku pendidikan</li>\r\n</ul>', '1.3', 'admin'),
(3, 'BIOLASKA', '<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Biolaska resmi didirikan pada tanggal 19 Juni 2004 dengan disyahkannya AD/ART dan dibentuknya Dewan Pengurus. Tokoh-tokoh yang membidani lahirnya organisasi ini antara lain : Mufid Ahsan Rofiqi, S.Pd, Zaki Alfauri, S.Pd.I, Widada,S.Pd.I, dan Umdah Mustarohah, S.Pd.I. Dua landasan pokok yang dipakai &nbsp;Biolaska dalam menjalankan organisasi adalah Tri Dharma Perguruan Tinggi dan Pancasila. Biolaska memiliki motto organisasi yaitu &nbsp;&ldquo;Exploratum in de Universum&rdquo; yang artinya Ekplorasi Alam. Masa bakti kepengurusan Biolaska adalah 1 tahun dan rekrutmen anggota setiap 1 tahun sekali.</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Kegiatan Biolaska mempunyai sasaran khusus menjaga kelestarian alam sesuai dengan ilmu yang dikajinya. Organisasi ini dituntut untuk menghasilkan mahasiswa-mahasiswa yang tidak hanya menguasai teori di bangku kuliah dan terampil di laboratorium, namun lebih dari itu adalah pemahaman terhadap fenomena alam, pendataan keanekaragaman hayati, dan penerapan ilmu biologi di alam bebas. Karena dalam kegiatannya biolaska mengarah pada penerapan ilmu biologi di alam. Sehingga diharapkan dalam kegiatannya itu, Biolaska mampu membentuk seorang biolog dan kader konservasi yang profesional.</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Dasar Pembentukan Anggota biolaska Sesuai dengan AD/ART yang berhak menjadi anggota biolaska &nbsp;adalah mahasiswa Biologi dan Pendidikan Biologi Fak. Saintek UIN Sunan Kalijaga Yogyakarta yang dengan sukarela dan penuh kesadaran akan cinta alam dengan prosedur mendaftarkan diri sebagai anggota Biolaska. Syarat utama untuk diterimanya menjadi anggota biolaska adalah mahasiswa jurusan Biologi yang sehat jasmani dan rohani, yang telah diseleksi melalui pendidikan dasar (DIKSAR) yang telah ditentukan waktunya. Hak dan kewajiban anggota Biolaska adalah berhak mengikuti setiap kegiatan sesuai dengan ketentuan, serta berkewajiban menjunjung tinggi nama baik dan citra Biolaska.</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sebagai hasil akhir diharapkan setiap anggota Biolaska dapat meningkatkan kualitas keanggotaan dan meningkatkan kemampuan dalam melaksanakan kegiatan ilmiah maupun kepecintaalaman. Diharapkan pula bagi setiap anggota Biolaska untuk bisa menjalin hubungan kerjasama dan membina komunikasi dengan instansi lain seperti pecinta alam berbasis penelitian, LSM, Lembaga Kemahasiswaaan lain dan instansi pemerintah. Misal; BKSDA Yogyakarta, Yayasan KANOPI Indonesia, Yayasan Kutilan Indonesia, Yayasan Konservasi Alam Yogyakarta, Pusat Penyelamatan Satwa Liar Jogyakarta (PPSJ),Raptor Indonesia (RAIN), KP3 &nbsp;Faklutas kehutanan UGM, Matalabiogama fakultas Biologi UGM, BIONIC UNY, KSSL Faklutas kedokteran hewan UGM dan lain-lain</p>', '4.2', 'admin'),
(4, 'Counter Pengunjung', '3317', 'counter', 'admin'),
(5, 'Hubungi Kami', '<p>Telp. +62-274-512474, +62-274-589621<br /> Fax. +62-274-586117<br /> Email : humas@uin-suka.ac.id&nbsp;</p>', '6.1', 'admin'),
(6, 'Visi dan Misi', '<div><span style="font-size: small;"><strong>Vision</strong></span></div>\r\n<div style="padding-left: 30px;">\r\n<ul>\r\n<li>Unggul dan terkemuka dalam pemaduan dan pengembangan studi keislaman dan pendidikan biologi bagi peradaban</li>\r\n</ul>\r\n<span>&nbsp;</span></div>\r\n<div><strong><span style="font-size: small;">Mission</span></strong></div>\r\n<div class="O1" style="padding-left: 30px;">\r\n<ul style="list-style-type: square;">\r\n<li><span style="white-space: pre;"> </span>Mengembangkan pendidikan dan pengajaran dalam bidang pendidikan biologi yang integratif dan interkonektif yang<span style="white-space: pre;"> </span>berkepribadian ZIKR (Zero based, Imani, Konsisten, dan Result Oriented)</li>\r\n<li><span style="white-space: pre;"> </span>Mengembangkan penelitian yang berkualitas dalam bidang pendidikan biologi</li>\r\n<li><span style="white-space: pre;"> </span>Memberikan pelayanan kepada masyarakat dalam bidang pendidikan biologi</li>\r\n<li><span style="white-space: pre;"> </span>Mengembangkan kerja sama dengan berbagai phak dalam rangka mewujudkan tridarma PT, terutama bidang<span style="white-space: pre;"> </span>pendidikan biologi</li>\r\n</ul>\r\n</div>', '1.2', 'admin'),
(9, 'Peraturan Akademik', 'Data masih kosong', '2.1', 'admin'),
(10, 'Kalender Akademik', 'Data masih kosong', '2.2', 'admin'),
(11, 'Dosen Pengajar', '<table style="border-image: initial; border: 1px solid #7d8679;" border="1" width="100%" align="center">\r\n<tbody>\r\n<tr>\r\n<td style="background-color: #1de1d5; text-align: center;"><strong><span style="font-size: small;">No</span></strong></td>\r\n<td style="background-color: #1de1d5; text-align: center;" width="205px"><strong><span style="font-size: small;">Dosen Pengajar</span></strong></td>\r\n<td style="background-color: #1de1d5; text-align: center;"><strong><span style="font-size: small;">Strata&nbsp;</span></strong></td>\r\n<td style="background-color: #1de1d5; text-align: center;" width="215px"><span style="font-size: small;"><strong>Latar Belakang Pendidikan</strong></span></td>\r\n</tr>\r\n<tr style="height: 20px;">\r\n<td style="text-align: center; width: 25px;">1</td>\r\n<td>\r\n<p>Eka Sulistiyowati, S.Si., MA</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n<td style="text-align: center;">S2</td>\r\n<td style="width: 65px;">S1 Biologi UGM, S2 Science Education McGill Canada<br /></td>\r\n</tr>\r\n<tr style="height: 20px;">\r\n<td style="text-align: center; width: 25px; height: 15px;">2</td>\r\n<td>\r\n<p>Runtut Prih Utami, M.Pd.</p>\r\n<p><span>19830116-200801-2-013</span></p>\r\n</td>\r\n<td style="text-align: center;">S2</td>\r\n<td style="width: 45px;">S1 Pendidikan Biologi UNS, S2 Pendidikan Sains UNS</td>\r\n</tr>\r\n<tr style="height: 20px;">\r\n<td style="width: 25px; text-align: center;">3</td>\r\n<td>\r\n<p>Widodo, M.Pd</p>\r\n<p><span>132168403</span></p>\r\n</td>\r\n<td style="text-align: center;">S2</td>\r\n<td style="width: 45px;">S2 Pendidikan Sains UNY</td>\r\n</tr>\r\n<tr style="height: 20px;">\r\n<td style="width: 25px; text-align: center;">4</td>\r\n<td>\r\n<p>Lela Susilawati, S.Pd, M.Si</p>\r\n<p><span>19790127-200901-2-004</span></p>\r\n</td>\r\n<td style="text-align: center;">S3</td>\r\n<td style="width: 45px;">S2 Mikrobiologi UGM<br /></td>\r\n</tr>\r\n<tr style="height: 20px;">\r\n<td style="width: 25px; text-align: center;">5</td>\r\n<td>\r\n<p>Dian Noviar, M.Pd</p>\r\n<p><span>19841117-200912-2-002</span></p>\r\n</td>\r\n<td style="text-align: center;">&nbsp;</td>\r\n<td style="width: 45px;">&nbsp;</td>\r\n</tr>\r\n<tr style="height: 20px;">\r\n<td style="width: 25px; text-align: center;">6</td>\r\n<td>Sulistyawati, M.Si</td>\r\n<td style="text-align: center;">S2</td>\r\n<td style="width: 45px;">S1 Tadris UIN, S2 Biologi UGM</td>\r\n</tr>\r\n<tr style="height: 20px;">\r\n<td style="width: 25px; text-align: center;">7</td>\r\n<td>\r\n<p>Dias Idha Pramesti, M.Si</p>\r\n<p><span>19820928-200912-2-002</span></p>\r\n</td>\r\n<td style="text-align: center;">&nbsp;</td>\r\n<td style="width: 45px;">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-size: small;"><br /></span></p>', '2.3', 'admin'),
(14, 'Jurnal Penelitian', '<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><strong>DAFTAR KARYA ILMIAH/BUKU/DIKTAT DOSEN TETAP</strong></p>\r\n<p style="text-align: center;"><strong>PRODI PENDIDIKAN BIOLOGI</strong></p>\r\n<p style="text-align: center;"><strong>SELAMA TIGA TAHUN TERAKHIR</strong></p>\r\n<p style="text-align: center;"><span style="font-size: x-small;"><strong><br /></strong></span></p>\r\n<ol style="margin-left: 45px;">\r\n<li><span style="font-size: x-small;">Judul &nbsp; &nbsp;: Memperbincangkan Jilbab (antara Tuntutan Syariah dan Tuntutan Mode) .&nbsp;</span><br /><span style="font-size: x-small;">Penulis :&nbsp;Dra. Maizer Said Nahdi, M.Si .</span><br /><span style="font-size: x-small;"> Tahun &nbsp;:&nbsp;2004.</span></li>\r\n<li><span style="font-size: x-small;">Judul &nbsp; &nbsp;:&nbsp;Penurunan Resiko Arteriosklerosis Tikus Putih akibat diet lemak tinggi dengan Pemberian Tepung Koro Putih</span><br /><span style="font-size: x-small;">Penulis :&nbsp;Arifah Khusnuryani, M.Si.</span><br /><span style="font-size: x-small;">Tahun &nbsp;:&nbsp;2004.</span></li>\r\n<li><span style="font-size: x-small;">Judul &nbsp; &nbsp;:&nbsp;Makanan Halal dan Haram dalam Tinjauan Islam dan Ilmu Kesehatan</span><br /><span style="font-size: x-small;">Penulis :&nbsp;Arifah Khusnuryani, M.Si.</span><br /><span style="font-size: x-small;">Tahun &nbsp;:&nbsp;2004.</span></li>\r\n<li><span style="font-size: x-small;">Judul &nbsp; &nbsp;:&nbsp;Agama dan Evolusi: Konflik atau Kompromi?</span><br /><span style="font-size: x-small;">Penulis :&nbsp;Arifah Khusnuryani, M.Si.</span><br /><span style="font-size: x-small;">Tahun &nbsp;:&nbsp;2005.</span></li>\r\n<li><span style="font-size: x-small;">Judul &nbsp; &nbsp;:&nbsp;Etika Lingkungan da Perspektif Yusuf al-Qaradawy</span><br /><span style="font-size: x-small;">Penulis :&nbsp;Dra. Maizer Said Nahdi, M.Si dan Aziz Gufron</span><br /><span style="font-size: x-small;">Tahun &nbsp;:&nbsp;2006.</span></li>\r\n</ol>', '3.1', 'admin'),
(16, 'Badan Eksekutif Mahasiswa Jurusan (BEMJ)', '<p><span style="font-size: medium;"><strong>VISI</strong></span></p>\r\n<p><span style="font-size: medium;"><strong><br /></strong></span></p>\r\n<p style="padding-left: 30px; text-align: justify;">Optimalisasi BEM PS PBIO Sebagai Wadah Berkreasi dan Berkarya serta rumah komunikasi kultural bagi seluruh elemen mahasiswa Pendidikan Biologi</p>\r\n<p style="padding-left: 30px;">&nbsp;</p>\r\n<p><strong><span style="font-size: medium;">MISI</span></strong>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style="padding-left: 30px; text-align: justify;">Mewadahi aspirasi mahasiswa</p>\r\n<p style="padding-left: 30px; text-align: justify;">Wadah intelektual dan religius mahasiswa PS PBIO</p>\r\n<p style="padding-left: 30px; text-align: justify;">Menjadikan BEM PS PBIO sebagai Jembatan penghubung antara mahasiswa dengan Birokrasi</p>\r\n<p style="padding-left: 30px; text-align: justify;">Controling terhadap kebijakan birokrasi yang tidak berpihak pada&nbsp;mahasiswa</p>\r\n<p style="padding-left: 30px;">&nbsp;</p>\r\n<ol> </ol>\r\n<p><strong><span style="font-size: medium;">KARAKTERISTIK</span></strong></p>\r\n<p><strong><span style="font-size: medium;"><br /></span></strong></p>\r\n<p style="padding-left: 30px; text-align: justify;">Lembaga Kemahasiswaan intra kampus di tingkat program studi Pendidikan Biologi</p>\r\n<p style="padding-left: 30px; text-align: justify;">Secara struktural di bawah BEM-FST</p>\r\n<p style="padding-left: 30px; text-align: justify;">Ketua &amp; Wakil dipilih melalui undang-undang PEMILWA</p>\r\n<p style="padding-left: 30px; text-align: justify;">Bersifat kekeluargaan</p>\r\n<ol> </ol>', '4.1', 'admin'),
(18, 'Bioenter', '<p style="padding-left: 30px;"><span style="font-size: x-small;"><strong>VISI</strong></span></p>\r\n<p style="padding-left: 30px;">&nbsp;</p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;"><em>Menjadi wadah untuk mengembangkan kre</em><em>atifitas mahasiswa dalam bidang kewirausahaan yang berbasis biologi dengan berlandaskan hukum-hukum </em><em>Syariah</em>.</span></p>\r\n<p style="padding-left: 30px;">&nbsp;</p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;"><strong>MISI</strong></span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">1. Menampung dan mengembangkan ide-ide mahasiswa dalam menciptakan inovasi-inovasi baru terkait wirausaha yang berbasis Biologi</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">2. Melatih dan mengasah mental wirausaha bagi mahasiswa Biologi</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">3. Menciptakan inovasi-inovasi baru dalam pembuatan pangan dengan teknologi tepat guna.</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">4. Menerapkan hukum ekonomi islam dalam mengatur keuangan</span></p>\r\n<p style="padding-left: 30px;">&nbsp;</p>\r\n<p style="padding-left: 30px;">&nbsp;</p>\r\n<p style="padding-left: 30px;">&nbsp;</p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;"><strong>Tujuan :</strong></span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">1. Menyediakan wadah untuk menampung dan mengembangkan bakat wirausaha bagi mahasiswa Bologi UIN Sunan Kalijaga yogyakarta.</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">2.&nbsp; Membentuk kepribadian wirausaha mahasiswa Biologi UIN Sunan Kalijaga</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">3. Melatih dan mengasah mental wirausaha bagi mahasiswa Biologi yang mencakup kepercayaan diri, sadar akan jati diri, motivasi meraih cita-cita, pantang menyerah, mampu bekerja keras, kreatif, inovatif, berani mengambil resiko dengan penuh perhitungan, berperilaku pemimpin dan memiliki visi kedepan, tanggap terhadap saran dan kritik, serta memiliki kemampuan empati dan tanggap sosial.</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">4. Menyiapkan wirausaha-wirausaha baru yang berpendidikan tinggi.</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">5. Menciptakan unit bisnis baru yang berbasis ilmiah dengan sistem ekonomi syariah di lingkungan Fakultas Sains dan Teknologi UIN Sunan Kalijaga Yogyakarta.</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">6. Membangun jaringan bisnis antarpelaku bisnis, yakni hubungan antara pelaku bisnis pemula dengan pelaku bisnis yang telah mapan.</span></p>\r\n<p style="padding-left: 30px;"><span style="font-size: x-small;">7. Menerapkan prinsip ekonomi syariah dalam berwirausaha.</span></p>', '4.4', 'admin'),
(20, 'Laboratorium', '<p>Laboratorium merupakan sarana untuk meningkatkan kemampuan mahasiswa sesuai dengan program studi yang diambil mahasiswa, maka lembaga menyediakan beberapa laboratorium yang digunakan untuk praktikum dan riset mahasiswa S1 dan D3. Semua laboratorium dilengkapi dengan AC dan terhubung dengan network (internet), LCD proyektor akan disediakan jika diperlukan. Laboratorium yang tersedia meliputi:</p>\r\n<ul>\r\n<li>Laboratorium Instalasi</li>\r\n<li>Laboratorium Jaringan</li>\r\n<li>Laboratorium Rekayasa Perangkat Lunak</li>\r\n<li>Laboratorium Pemrograman</li>\r\n<li>Laboratorium Multimedia</li>\r\n<li>Laboratorium Ai dan Citra<br /><br /><br />Keadaan Laboratorium Dasar</li>\r\n</ul>\r\n<p><span style="white-space: pre;"> </span></p>\r\n<table border="0">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;No.&nbsp;</td>\r\n<td>&nbsp;Nama Laboratorium&nbsp;</td>\r\n<td>&nbsp;Kapasitas (orang)&nbsp;</td>\r\n<td>&nbsp;Luas (m<sup>2</sup>)</td>\r\n<td>&nbsp;&nbsp;Frekuensi Pemakaian (Rombongan/Minggu)&nbsp;</td>\r\n<td>&nbsp;Lama Pemakaian (jam/hari)</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;1.</td>\r\n<td>&nbsp;Biologi Dasar / Integrated&nbsp;</td>\r\n<td style="text-align: center;">40</td>\r\n<td style="text-align: center;">108</td>\r\n<td style="text-align: center;">20*</td>\r\n<td style="text-align: center;">\r\n<p>9</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<ol style="list-style-type: upper-alpha;">\r\n<li>*Catt: 1 rombongan= 1 kelas (maksimal 10 kelompok, @ 5-7 orang)<br /><br />Keadaan Laboratorium Lanjut<br /><br />\r\n<table border="0">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;No.&nbsp;</td>\r\n<td>&nbsp;Nama Laboratorium&nbsp;</td>\r\n<td>&nbsp;Kapasitas (orang)&nbsp;</td>\r\n<td>&nbsp;Luas (m2)&nbsp;</td>\r\n<td>&nbsp;Frekuensi Pemakaian (Rombongan/Minggu)&nbsp;</td>\r\n<td>&nbsp;Lama Pemakaian (jam/hari)&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="text-align: left;">1.</td>\r\n<td>Mikrobiologi</td>\r\n<td>16</td>\r\n<td>49</td>\r\n<td>2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>2.</td>\r\n<td>Fisiologi Tumbuhan</td>\r\n<td>16</td>\r\n<td>49</td>\r\n<td>2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>3.</td>\r\n<td>Zoologi dan Fisiologi Hewan&nbsp;</td>\r\n<td>16</td>\r\n<td>49</td>\r\n<td>2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>4.</td>\r\n<td>Botani dan Ekologi</td>\r\n<td>16</td>\r\n<td>49</td>\r\n<td>2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>5.</td>\r\n<td>Embriologi</td>\r\n<td>16</td>\r\n<td>49</td>\r\n<td>2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>6.</td>\r\n<td>Genetika</td>\r\n<td>16</td>\r\n<td>49</td>\r\n<td>2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>7.</td>\r\n<td>Microteaching</td>\r\n<td>12</td>\r\n<td>24.5</td>\r\n<td>2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<br />Keadaan Laboratorium Penelitian</li>\r\n</ol>\r\n<ul>\r\n</ul>', '5.2', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `posting_date` date NOT NULL,
  `id_penulis` int(10) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`id`, `title`, `posting_date`, `id_penulis`, `content`, `type`) VALUES
(18, 'Pekan Biodiversitas INDONESIA', '2012-05-11', 1, '<p style="padding-left: 30px;">Deskripsi &nbsp; &nbsp; &nbsp;: Mempertemukan pengamat burung se Indonesia dan mensosialisasikan pentinganya konservasi BIODIVERSITAS pada publik</p>\r\n<p style="padding-left: 30px;">Tanggal &nbsp; &nbsp; &nbsp; &nbsp;: 5 Juni 2012 sampai 10 Juni 2012</p>\r\n<p style="padding-left: 30px;">Tempat &nbsp; &nbsp; &nbsp; &nbsp; : Treatikal Saintek dan Bukit Plawangan Merapi</p>\r\n<p style="padding-left: 30px;">Pendaftran &nbsp; &nbsp;: 085712691138 (Nurdin) HTM : Rp 100.000,00</p>', 'pengumuman');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galeri`
--

CREATE TABLE IF NOT EXISTS `tbl_galeri` (
  `id_foto` int(10) NOT NULL AUTO_INCREMENT,
  `id_album` int(10) NOT NULL,
  `foto_kecil` varchar(100) NOT NULL,
  `foto_besar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_foto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `tbl_galeri`
--

INSERT INTO `tbl_galeri` (`id_foto`, `id_album`, `foto_kecil`, `foto_besar`) VALUES
(80, 7, 'kecil-603127064-foto0041.jpg', '603127064-foto0041.jpg'),
(79, 6, 'kecil-665458109-foto0028.jpg', '665458109-foto0028.jpg'),
(78, 6, 'kecil-685493087-foto0026.jpg', '685493087-foto0026.jpg'),
(75, 7, 'kecil-588917069-foto0025.jpg', '588917069-foto0025.jpg'),
(74, 6, 'kecil-1028017020-foto0016.jpg', '1028017020-foto0016.jpg'),
(73, 6, 'kecil-945984913-foto0011.jpg', '945984913-foto0011.jpg'),
(72, 6, 'kecil-764965170-foto0025_001.jpg', '764965170-foto0025_001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guestbook`
--

CREATE TABLE IF NOT EXISTS `tbl_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pesan` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'N',
  `posted_date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_guestbook`
--

INSERT INTO `tbl_guestbook` (`id`, `nama`, `email`, `pesan`, `status`, `posted_date`) VALUES
(17, 'Ikhsan', 'ikhsan@ikhsan.com', '<p>Sudah Lumayan</p>', 'Y', '01-06-2012 | 06:52 am');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_artikel`
--

CREATE TABLE IF NOT EXISTS `tbl_kategori_artikel` (
  `id_kat` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kat` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_kategori_artikel`
--

INSERT INTO `tbl_kategori_artikel` (`id_kat`, `nama_kat`, `type`) VALUES
(1, 'Akademik', 'berita'),
(3, 'Mikrobiologi', 'tutorial'),
(4, 'Bioteknologi Lingkungan', 'tutorial'),
(5, 'Kegiatan', 'berita'),
(7, 'Biological Science', 'tutorial');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_media`
--

CREATE TABLE IF NOT EXISTS `tbl_media` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_description` varchar(100) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `file_type` varchar(10) NOT NULL,
  `uploaded_date` varchar(20) NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tbl_media`
--

INSERT INTO `tbl_media` (`id_file`, `title`, `image_description`, `image_url`, `file_type`, `uploaded_date`) VALUES
(44, 'Identifikasi Model Pembelajaran', 'Judul Skripsi', 'media/file/identifikasi_model_pembelajaran_pada_lks_mata_pelajaran_biologi.pdf', 'pdf', '2012-06-01 07:06:52'),
(45, 'Metode Guided Inquiry', 'Judul Skripsi', 'media/file/metode_guided_inquiry_sebagai_upaya_peningkatan_kemandirian_dan_hasil_belajar_kognitif_biologi_pada_materi_pencemaran_lingkungan_dan_pengelolaan_limbah_siswa_kelas_x_ma_wahid_hasyim_yogyaka', 'pdf', '2012-06-01 07:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` char(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `id_parent` char(10) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `title`, `id_parent`, `level`) VALUES
('1', 'Kampus', '0', 0),
('1.1', 'Profil Prodi', '1', 1),
('1.2', 'Visi dan Misi', '1', 1),
('1.3', 'Kompetensi Lulusan', '1', 1),
('2', 'Akademik', '0', 0),
('2.1', 'Peraturan Akademik', '2', 1),
('2.2', 'Kalender Akademik', '2', 1),
('2.3', 'Dosen Pengajar', '2', 1),
('3', 'Penelitian', '0', 0),
('3.1', 'Jurnal Penelitian', '3', 1),
('4', 'Organisasi Mahasiswa', '0', 0),
('4.1', 'Badan Eksekutif Mahasiswa Jurusan (BEMJ)', '4', 1),
('4.2', 'BIOLASKA', '4', 1),
('4.4', 'Bioenter', '4', 1),
('5', 'Sarana Prasarana', '0', 0),
('5.2', 'Laboratorium', '5', 1),
('6', 'Berita', '0', 10),
('7', 'Agenda', '0', 10),
('8', 'Pengumuman', '0', 10),
('10', 'Galeri', '0', 10),
('11', 'Download', '0', 10),
('12', 'Guestbook', '0', 10),
('6.1', 'Kontak', '0', 10),
('9', 'Tutorial', '0', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pollingjawaban`
--

CREATE TABLE IF NOT EXISTS `tbl_pollingjawaban` (
  `id_jawaban` int(11) NOT NULL AUTO_INCREMENT,
  `id_soal` int(11) NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`id_jawaban`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_pollingjawaban`
--

INSERT INTO `tbl_pollingjawaban` (`id_jawaban`, `id_soal`, `jawaban`, `counter`) VALUES
(2, 5, 'Cukup Bagus', 22),
(3, 5, 'Sangat Bagus', 40),
(6, 5, 'Cukup', 2),
(7, 5, 'Kurang', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pollingsoal`
--

CREATE TABLE IF NOT EXISTS `tbl_pollingsoal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soal` varchar(100) NOT NULL,
  `status` char(1) NOT NULL,
  `dislike` int(11) NOT NULL,
  `liked` int(11) NOT NULL,
  `average` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_pollingsoal`
--

INSERT INTO `tbl_pollingsoal` (`id`, `soal`, `status`, `dislike`, `liked`, `average`) VALUES
(5, 'Bagaimana pelaksanaan proses akademik di semester genap ini?', 'Y', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `pass`, `nama`, `email`, `status`) VALUES
(1, 'admin', '*6A35CFBE63473EFD04B0FDFDBE07C949E24C368F', 'Fadli Ikhsan Pratama', 'fadli@surgailmu.com', 'administrator');
