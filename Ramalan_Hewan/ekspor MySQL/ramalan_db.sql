-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2026 pada 10.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ramalan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ramalan`
--

CREATE TABLE `ramalan` (
  `id` int(11) NOT NULL,
  `hewan` varchar(20) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `isi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ramalan`
--

INSERT INTO `ramalan` (`id`, `hewan`, `judul`, `isi`) VALUES
(1, 'fox', 'Ramalan Rubah', 'Di tepi rimba yang jarang disinggahi matahari, seekor rubah berkulit kelabu tembaga menapaki jejak yang bahkan ia sendiri tak ingat kapan mulai diikutinya. Hutan itu bernafas dalam diam, menyembunyikan sesuatu yang tak segera menyatakan wujudnya. Semilir angin membawa anyir samar, seolah mengabarkan peringatan yang tertahan di antara lumut dan akar tua.\r\n\r\nRubah itu—yang oleh kawanan lain dikenal karena kecermatan nalurinya—mendadak merasakan keganjilan. Tanah bergetar halus, tidak oleh makhluk hidup, melainkan oleh kehampaan yang mencurigakan. Ketika ia membungkuk untuk menelisik buah merah yang menggantung rendah dari dahan bengkok, guratan kawat tipis kilas-mengilas di sudut pandangnya. Jebakan, terpasang dengan kecermatan yang nyaris artistik.\r\n\r\nIa terhenti, jantungnya mengeras seperti batu yang dilemparkan ke sumur dalam. Sesuatu—entah kebodohan, entah keinginan—telah menuntunnya ke ambang yang rapuh. Dalam sekejap ia memahami: bukan bahaya besar yang menakutkan, melainkan kesembronoan kecil yang luput dari pikirannya.'),
(2, 'dove', 'Ramalan Merpati', 'Di atas kota tua yang berselimut perunggu senja, seekor merpati putih kusam mengepakkan sayapnya dengan keanggunan aneh—seolah setiap kepakan adalah doa yang tidak pernah selesai. Angin sore mengangkat tubuhnya lebih tinggi, dan dari ketinggian itu ia melihat sesuatu yang tak lazim: kilau lembut dari retakan genteng yang telah lama lapuk.\r\n\r\nDigerakkan rasa ingin tahu yang hampir menyerupai takdir, merpati itu menukik perlahan. Di sela pecahan keramik yang digerogoti waktu, tersembunyi seutas pita emas kusut—barang yang pasti terjatuh dari seseorang yang pernah lewat, seseorang yang menyimpannya dekat hati. Ketika merpati itu memungutnya, angin berubah hangat, seperti mengusap punggung dengan sentuhan yang membawa makna tersembunyi.\r\n\r\nTak lama kemudian, seorang anak kecil yang kehilangan pita itu menyaksikan merpati turun di hadapannya. Sorot matanya yang sumringah, tawa kecil yang pecah tanpa beban, dan rasa lega yang memancar dari tubuh mungilnya seolah mengembalikan cahaya pada kota yang meredup.\r\n\r\nDi momen itu, merpati menyadari: kehadirannya, tanpa ia rencanakan, telah menjadi pertanda dari sesuatu yang membaik.'),
(3, 'fly', 'Ramalan Lalat', 'Di sebuah ruangan tua yang lembap, seekor lalat hitam berkilau kehijauan berputar-putar, terpikat oleh nyala lampu tunggal yang menyala remang—seakan cahaya itu memancarkan semacam janji. Ruangan itu teramat sunyi, tetapi keheningannya bukanlah kedamaian; ia seperti keheningan yang menyimpan amarah yang enggan disebutkan.\r\n\r\nLalat itu, makhluk kecil yang biasanya tak memikirkan apa pun selain aroma manis atau busuk, kali ini diliputi kegelisahan samar. Ia melayang mendekati jendela yang tertutup debu, namun setiap kali mencapai kaca, tubuhnya seperti ditarik kembali oleh sesuatu yang tidak terlihat. Lampu itu, dengan cahaya kuning yang mengeriput, memanggilnya seperti lubang yang menelan.\r\n\r\nKetika ia semakin mendekat, udara menghangat secara berlebihan. Tanpa peringatan, nyala lampu meledak kecil—sebuah kilat cahaya putih yang merobek ruang gelap. Lalat itu terhempas, sayapnya mengeluarkan suara retak halus yang hanya bisa dirasakan, bukan didengar. Dalam kesadarannya yang ompong, ia mengerti: nalurinya telah dikhianati oleh rasa ingin tahu yang keliru.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tambah_ramalan`
--

CREATE TABLE `tambah_ramalan` (
  `id` int(11) NOT NULL,
  `hewan` enum('fox','dove','fly') NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tambah_ramalan`
--

INSERT INTO `tambah_ramalan` (`id`, `hewan`, `judul`, `isi`) VALUES
(3, 'fox', 'Ramalan Rubah', 'Di tepi rimba yang jarang disinggahi matahari, seekor rubah berkulit kelabu tembaga menapaki jejak yang bahkan ia sendiri tak ingat kapan mulai diikutinya. Hutan itu bernafas dalam diam, menyembunyikan sesuatu yang tak segera menyatakan wujudnya. Semilir angin membawa anyir samar, seolah mengabarkan peringatan yang tertahan di antara lumut dan akar tua.\r\n\r\nRubah itu—yang oleh kawanan lain dikenal karena kecermatan nalurinya—mendadak merasakan keganjilan. Tanah bergetar halus, tidak oleh makhluk hidup, melainkan oleh kehampaan yang mencurigakan. Ketika ia membungkuk untuk menelisik buah merah yang menggantung rendah dari dahan bengkok, guratan kawat tipis kilas-mengilas di sudut pandangnya. Jebakan, terpasang dengan kecermatan yang nyaris artistik.\r\n\r\nIa terhenti, jantungnya mengeras seperti batu yang dilemparkan ke sumur dalam. Sesuatu—entah kebodohan, entah keinginan—telah menuntunnya ke ambang yang rapuh. Dalam sekejap ia memahami: bukan bahaya besar yang menakutkan, melainkan kesembronoan kecil yang luput dari pikirannya.'),
(4, 'dove', 'Ramalan Merpati', 'Di atas kota tua yang berselimut perunggu senja, seekor merpati putih kusam mengepakkan sayapnya dengan keanggunan aneh—seolah setiap kepakan adalah doa yang tidak pernah selesai. Angin sore mengangkat tubuhnya lebih tinggi, dan dari ketinggian itu ia melihat sesuatu yang tak lazim: kilau lembut dari retakan genteng yang telah lama lapuk.\r\n\r\nDigerakkan rasa ingin tahu yang hampir menyerupai takdir, merpati itu menukik perlahan. Di sela pecahan keramik yang digerogoti waktu, tersembunyi seutas pita emas kusut—barang yang pasti terjatuh dari seseorang yang pernah lewat, seseorang yang menyimpannya dekat hati. Ketika merpati itu memungutnya, angin berubah hangat, seperti mengusap punggung dengan sentuhan yang membawa makna tersembunyi.\r\n\r\nTak lama kemudian, seorang anak kecil yang kehilangan pita itu menyaksikan merpati turun di hadapannya. Sorot matanya yang sumringah, tawa kecil yang pecah tanpa beban, dan rasa lega yang memancar dari tubuh mungilnya seolah mengembalikan cahaya pada kota yang meredup.\r\n\r\nDi momen itu, merpati menyadari: kehadirannya, tanpa ia rencanakan, telah menjadi pertanda dari sesuatu yang membaik.'),
(5, 'fly', 'Ramalan Lalat', 'Di sebuah ruangan tua yang lembap, seekor lalat hitam berkilau kehijauan berputar-putar, terpikat oleh nyala lampu tunggal yang menyala remang—seakan cahaya itu memancarkan semacam janji. Ruangan itu teramat sunyi, tetapi keheningannya bukanlah kedamaian; ia seperti keheningan yang menyimpan amarah yang enggan disebutkan.\r\n\r\nLalat itu, makhluk kecil yang biasanya tak memikirkan apa pun selain aroma manis atau busuk, kali ini diliputi kegelisahan samar. Ia melayang mendekati jendela yang tertutup debu, namun setiap kali mencapai kaca, tubuhnya seperti ditarik kembali oleh sesuatu yang tidak terlihat. Lampu itu, dengan cahaya kuning yang mengeriput, memanggilnya seperti lubang yang menelan.\r\n\r\nKetika ia semakin mendekat, udara menghangat secara berlebihan. Tanpa peringatan, nyala lampu meledak kecil—sebuah kilat cahaya putih yang merobek ruang gelap. Lalat itu terhempas, sayapnya mengeluarkan suara retak halus yang hanya bisa dirasakan, bukan didengar. Dalam kesadarannya yang ompong, ia mengerti: nalurinya telah dikhianati oleh rasa ingin tahu yang keliru.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ramalan`
--
ALTER TABLE `ramalan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tambah_ramalan`
--
ALTER TABLE `tambah_ramalan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ramalan`
--
ALTER TABLE `ramalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tambah_ramalan`
--
ALTER TABLE `tambah_ramalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
