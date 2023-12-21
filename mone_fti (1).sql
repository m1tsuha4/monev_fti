-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 03:31 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mone_fti`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkasdokumens`
--

CREATE TABLE `berkasdokumens` (
  `id_kelas_perkuliahan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori_berkas` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_berkas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_upload` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `keterangan` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berkasdokumens`
--

INSERT INTO `berkasdokumens` (`id_kelas_perkuliahan`, `id_kategori_berkas`, `file_berkas`, `tanggal_upload`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
('K0003', 'B01', 'public/dokumen/671FvsMhPCGvA6aMTBPaFsFZtU4QUqHY3Q9f4u8f.pdf', '2022-11-22', 2, NULL, NULL, NULL),
('K0003', 'B02', 'public/dokumen/2WvYwgyMK5wpK8stosW3837bDOVYtg5sHqeEwCkZ.pdf', '2022-11-22', 2, NULL, NULL, NULL),
('K0003', 'B03', 'public/dokumen/HP67eS53kqfZoi2UCLIzj9DUyik2Yrhg9992EAhR.pdf', '2022-11-22', 2, NULL, NULL, NULL),
('K0003', 'B04', 'public/dokumen/qdt9p3r2TD8xyX24RIiJO21vNrH0NspEPEbNV5S1.pdf', '2022-11-22', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detailhasilverifikators`
--

CREATE TABLE `detailhasilverifikators` (
  `id_hasil_verifikasi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_jenis_kelengkapan_dokumen` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penilaian` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detailhasilverifikators`
--

INSERT INTO `detailhasilverifikators` (`id_hasil_verifikasi`, `id_jenis_kelengkapan_dokumen`, `penilaian`, `keterangan`, `created_at`, `updated_at`) VALUES
('V000000001', 'P01', 'Ada', 'tes 01', NULL, NULL),
('V000000001', 'P02', 'Cukup', NULL, NULL, NULL),
('V000000001', 'P03', 'Ada', NULL, NULL, NULL),
('V000000001', 'P04', 'Ada', NULL, NULL, NULL),
('V000000001', 'P05', 'Ada', NULL, NULL, NULL),
('V000000001', 'P06', 'Ada', NULL, NULL, NULL),
('V000000001', 'P07', 'Ada', NULL, NULL, NULL),
('V000000001', 'P08', 'Ada', NULL, NULL, NULL),
('V000000001', 'P09', 'Ada', NULL, NULL, NULL),
('V000000001', 'P10', 'Ada', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasilverifikasis`
--

CREATE TABLE `hasilverifikasis` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dosen_verifikator` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas_perkuliahan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeline_perkuliahan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tanggal_verifikasi` date DEFAULT NULL,
  `tanda_tangan_verifikator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanda_tangan_gkm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasilverifikasis`
--

INSERT INTO `hasilverifikasis` (`id`, `id_dosen_verifikator`, `id_kelas_perkuliahan`, `timeline_perkuliahan`, `status`, `tanggal_verifikasi`, `tanda_tangan_verifikator`, `tanda_tangan_gkm`, `catatan`, `created_at`, `updated_at`) VALUES
('V000000001', '198410062012121001', 'K0003', '1', 2, '2022-11-22', 'public/ttd/vov17VIymbavZ0ueGFiCN1OAtDKkgfof5v6D6n4a.png', 'public/ttd/45Up4nRv5U8ohI10naFX96CV5E8nnr1L4TYEXZGB.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jeniskelengkapandokumens`
--

CREATE TABLE `jeniskelengkapandokumens` (
  `id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelengkapan_dokumen` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_penilaian` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jeniskelengkapandokumens`
--

INSERT INTO `jeniskelengkapandokumens` (`id`, `kelengkapan_dokumen`, `tipe_penilaian`, `created_at`, `updated_at`) VALUES
('P01', 'Capaian Pembelajaran mata kuliah memuat aspek sikap, pengetahuan, dan keterampilan', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P02', 'Kemampuan akhir yang direncankan pada tiap tahap pembelajaran untuk memenuhi capaian pembelajaran lulusan', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P03', 'Perumusan tujuan/indicator mendukung capaian pembelajaran', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P04', 'Bahan kajian terkait dengan kemampuan yang akan dicapai', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P05', 'Kesesuaian pemilihan strategi pembelajaran dengan indikator', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P06', 'Kesesuaian sumber belajar/media dengan  indikator', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P07', 'Kesesuaian perencanaan waktu dengan  materi pembelajaran', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P08', 'Kesesuaian pengalaman belajar dengan  indicator', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P09', 'Butir-butir penilaian sesuai dengan  indicator', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P10', 'Keterkinian referensi', 'Kelengkapan Dokumen RPS', NULL, NULL),
('P11', 'Nama mata kuliah', 'Format Penulisan Soal', NULL, NULL),
('P12', 'SMS/Semester', 'Format Penulisan Soal', NULL, NULL),
('P13', 'Prodi', 'Format Penulisan Soal', NULL, NULL),
('P14', 'Waktu pelaksanaan ujian', 'Format Penulisan Soal', NULL, NULL),
('P15', 'Nama dosen pengampu', 'Format Penulisan Soal', NULL, NULL),
('P16', 'Kertas soal menggunakan kop Universitas / Fakultas /  Jurusan', 'Format Penulisan Soal', NULL, NULL),
('P17', 'Bentuk ujian (terbuka / tertutup)', 'Format Penulisan Soal', NULL, NULL),
('P18', 'Cara mengerjakan soal (boleh tidak berurut nomor atau tidak)', 'Format Penulisan Soal', NULL, NULL),
('P19', 'Sanksi', 'Format Penulisan Soal', NULL, NULL),
('P20', 'Penggunaan telepon cellular, serta alat lain pada saat ujian (boleh atau tidak)', 'Format Penulisan Soal', NULL, NULL),
('P21', 'Pada penutup, terdapat himbauan moral, seperti:  memberikan semangat untuk berlaku jujur dll', 'Format Penulisan Soal', NULL, NULL),
('P22', 'Kesuaian materi soal dengan RPS', 'Materi Soal', NULL, NULL),
('P23', 'Nomor urut soal berdasarkan tingkat kesulitas', 'Materi Soal', NULL, NULL),
('P24', 'Soal ujian mencakup kompetensi/learning outcome yang tercantum di dalam RPS', 'Materi Soal', NULL, NULL),
('P25', 'Materi soal yang diujikan sesuai dengan periode ujian  (UTS/UAS)', 'Materi Soal', NULL, NULL),
('P26', 'Setiap soal mencantumkan bobot nilai', 'Materi Soal', NULL, NULL),
('P27', 'Bobot nilai sesuai dengan tingkat kesulitas soal', 'Materi Soal', NULL, NULL),
('P28', 'Kesesuaian soal dengan CPMK', 'Materi Soal', NULL, NULL),
('P29', 'Memiliki Grading  Checklist', 'Materi Soal', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategoriberkas`
--

CREATE TABLE `kategoriberkas` (
  `id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_berkas` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoriberkas`
--

INSERT INTO `kategoriberkas` (`id`, `nama_berkas`, `kategori`, `created_at`, `updated_at`) VALUES
('B01', 'RPS', 1, NULL, NULL),
('B02', 'RTM', 1, NULL, NULL),
('B03', 'Kontrak Perkuliahan', 1, NULL, NULL),
('B04', 'BAP', 1, NULL, NULL),
('B05', 'Form Naskah Soal UTS', 2, NULL, NULL),
('B06', 'Form Naskah Soal UAS', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelasperkuliahans`
--

CREATE TABLE `kelasperkuliahans` (
  `id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dosen_pengampu` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_matakuliah` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_akademik` int(11) NOT NULL,
  `kurikulum` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelasperkuliahans`
--

INSERT INTO `kelasperkuliahans` (`id`, `id_dosen_pengampu`, `id_matakuliah`, `keterangan`, `tahun_akademik`, `kurikulum`, `status`, `created_at`, `updated_at`) VALUES
('K0002', '196603091986031001', 'M0004', NULL, 2022, 2004, 1, NULL, NULL),
('K0003', '197503232012121001', 'M0008', NULL, 2022, 2017, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliahs`
--

CREATE TABLE `matakuliahs` (
  `id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prodi` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_matakuliah` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_matakuliah` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bentuk_matakuliah` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuota` int(11) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matakuliahs`
--

INSERT INTO `matakuliahs` (`id`, `id_prodi`, `nama_matakuliah`, `kategori_matakuliah`, `bentuk_matakuliah`, `kuota`, `sks`, `semester`, `created_at`, `updated_at`) VALUES
('M0001', 'P01', 'Dasar Pemrograman', 'Teori', 'wajib', 45, 3, 1, NULL, NULL),
('M0002', 'P01', 'APSI', 'Teori', 'wajib', 40, 4, 4, NULL, NULL),
('M0004', 'P02', 'Kalkulus', 'Teori', 'wajib', 40, 3, 1, NULL, NULL),
('M0005', 'P01', 'Pemograman Mobile', 'Teori', 'pilihan', 35, 3, 6, NULL, NULL),
('M0006', 'P03', 'Dasar Prmograman', 'Teori', 'wajib', 30, 3, 1, NULL, NULL),
('M0007', 'P02', 'Komputer Dasar', 'Teori', 'Wajib', 40, 3, 6, NULL, NULL),
('M0008', 'P01', 'GIS', 'Teori', 'Wajib', 40, 3, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_09_12_164420_create_prodis_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_09_12_164446_create_kategoriberkas_table', 1),
(7, '2022_09_12_164523_create_jeniskelengkapandokumens_table', 1),
(8, '2022_09_12_164550_create_matakuliahs_table', 1),
(9, '2022_09_12_164609_create_kelasperkuliahans_table', 1),
(10, '2022_09_12_164650_create_hasilverifikasis_table', 1),
(11, '2022_09_12_164710_create_detailhasilverifikators_table', 1),
(12, '2022_09_12_164726_create_berkasdokumens_table', 1),
(13, '2022_09_12_164741_create_monitorings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monitorings`
--

CREATE TABLE `monitorings` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil_verifikasi_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_mahasiswa` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `materi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertemuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monitorings`
--

INSERT INTO `monitorings` (`id`, `hasil_verifikasi_id`, `jumlah_mahasiswa`, `tanggal`, `materi`, `pertemuan`, `jam_mulai`, `jam_selesai`, `bukti`, `created_at`, `updated_at`) VALUES
('M000000001', 'V000000001', 40, '2022-11-22', 'pembahasan 1', '1', '07:15:00', '09:20:00', 'public/bukti/rokvmaLcvz03xfDJvIpNZ09h45oAeDZc6irViDx0.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_prodi` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_fakultas` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenjang_pendidikan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `nama_prodi`, `nama_fakultas`, `jenjang_pendidikan`, `created_at`, `updated_at`) VALUES
('P01', 'Sistem Informasi', 'Teknologi Informasi', 'S1', NULL, NULL),
('P02', 'Teknik Komputer', 'Teknologi Informasi', 'S1', NULL, NULL),
('P03', 'Teknik Informatika', 'Teknologi Informasi', 'S1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prodi` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nip`, `id_prodi`, `nama`, `jabatan`, `foto`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
('195709071992031001', 'P02', 'Ir. Werman Kasoep, M.Kom', 'Lektor Kepala', NULL, 'werman@gmail.com', NULL, '$2y$10$MIz.yM9JgwRjDwZKm.5mG.CoXXDyeZ75CZY9SJKNruyctAnxmkYHq', 3, NULL, NULL, NULL),
('196211221989031', 'P01', 'Husnil Kamil, MT .', 'Ketua Departemen', NULL, 'admin@gmail.com', '2022-09-14 14:45:22', '$2y$10$MlcnSkxSxQnQEexV99N8kuWX1FydOJjaJ/sQsFnw5d5/NEwhncj4C', 1, NULL, NULL, NULL),
('196211221989035100', 'P02', 'Dr. Eng Rian Ferdian MT', 'Ketua Department', NULL, 'rian@gmail.com', '2022-10-19 18:43:59', '$2y$10$1mz.pwAQ0Yx3ok8gqrD9iuJtyOnHbTA0eIm.abjW6gLF3oVbHUS4e', 1, NULL, NULL, NULL),
('196211221989035112', 'P01', 'Kak Nindy', 'Tata Usaha', NULL, 'nindy@gmail.com', '2022-10-19 12:45:48', '$2y$10$Hdry6eWjlfhJauFVzUzZmur32B0usI6vl1ZrVieyWxfURv/wXmDj2', 0, NULL, NULL, NULL),
('196404091995121001', 'P01', 'Prof. Surya Afnarius. Ph.D', 'Professor', NULL, 'surya@gmail.com', NULL, '$2y$10$GPm6q8heHEbfOxdIu9JVoe79Ud1qYiOVDUGBwrx1nuDcuoS6.Otx.', 3, NULL, NULL, NULL),
('196603091986031001', 'P01', 'Dodon Yendri, M.Kom', 'Lektor', NULL, 'dy@gmail.com', NULL, '$2y$10$Tv70ICeXkrCgvLIcSGwwb.VPOw9EmHQmn644oCnWdzPx84DemT5ie', 3, NULL, NULL, NULL),
('197503232012121001', 'P01', 'Haris Suryamen, M.Sc', 'Asisten Ahli', NULL, 'haris@gmail.com', NULL, '$2y$10$rbTlg28eiKKyFiy59d0IzeYyBWsZLW5883wO/zQT8AKlScyX5HXe2', 3, NULL, NULL, NULL),
('197804142002122003', 'P02', 'Dr. Eng Tati Erlina', 'Lektor', NULL, 'tati@gmail.com', NULL, '$2y$10$tAnEXJQfKjFdSovJe.NKSOasaKETQYnEyaEpgTNUvITo..1vSatFi', 3, NULL, NULL, NULL),
('198001102008121002', 'P01', 'Fajril Akbar, M.Sc', 'Lektor', NULL, 'fajril@gmail.com', NULL, '$2y$10$Y5vG8cyCBmziHojg2nSkPuD5E9p0vBnjG6t4xVj7JAyFKtrm8lOMy', 3, NULL, NULL, NULL),
('198103252008122003', 'P01', 'Meza Silvana, MT', 'Lektor', NULL, 'meza@gmail.com', NULL, '$2y$10$8D1M/zdGc.3FP47j0FQNR.taFUOS.lkQ4AV48joHe5vRKQhr0weUi', 3, NULL, NULL, NULL),
('198105052014041001', 'P03', 'Dr. Wahyudi, S.T, M.T', 'Ketua Department', NULL, 'wahyu@gmail.com', NULL, '$2y$10$ghHbZYhSLP4HX1533QwAu.QXUqZS3bPTVzGnZxiZuFSgmbGJSpgv.', 1, NULL, NULL, NULL),
('198109122014042001', 'P02', 'Lathifah Arief, MT', 'Asisten Ahli', NULL, 'latifah@gmail.com', NULL, '$2y$10$z/74RlmGcKr1vT6nYY4QhuXtqvXErVMJK51U5TJRdNOCfrDGONIq6', 3, NULL, NULL, NULL),
('198112222008121004', 'P02', 'Dr. Eng Budi Rahmadya', 'Lektor', NULL, 'engbudi@gmail.com', NULL, '$2y$10$sMMvpL6z.BM4KPTjbFQRDut9wcLma7V8a3VaJeHHhLhtFiO1OEolm', 3, NULL, NULL, NULL),
('198201182008121002', 'P01', 'Husnil Kamil, MT', 'Lektor', NULL, 'pakhusnil@gmail.com', NULL, '$2y$10$tmLv.4GRFyWmDJoOm1Eig.ER6zHE.E.bhwCc3.o4Q0nxDfKomh4ZW', 3, NULL, NULL, NULL),
('198204192010122001', 'P02', 'Derisma, MT', 'Lektor', NULL, 'derisma@gmail.com', NULL, '$2y$10$ZUKCHSReskTCR0YR2.gJpeIbQ/53XopoeTWWlDAy.FoHn8ERlWFOK', 3, NULL, NULL, NULL),
('198307272008121003', 'P01', 'Hasdi Putra, MT', 'Lektor', NULL, 'hasdi12@gmail.com', NULL, '$2y$10$RRstJazjJELgDpEnEZxwfOhIOGvGM07RIYfC5adpPIh14m5ydOeNO', 3, NULL, NULL, NULL),
('198407232008012001', 'P02', 'Rahmi Eka Putri, MT', 'Lektor', NULL, 'rahmi@gmail.com', NULL, '$2y$10$6kTgdonGi96m75ZBZxaekO0HGQzGG4QjFoQkNlrHR1EbjzpbWyIEe', 3, NULL, NULL, NULL),
('198410062012121001', 'P01', 'Ricky Akbar, M.Kom', 'Lektor', NULL, 'ricky@gmail.com', NULL, '$2y$10$aj9lapdJFGF7LdXViQi5B.ANrnb5oOzYvfp/fFnJAGdx3NZ64RmDu', 3, NULL, NULL, NULL),
('198410302008122002', 'P02', 'Ratna Aisuwarya, M.Eng', 'Lektor', NULL, 'ratna@gmail.com', NULL, '$2y$10$0q65o8kNGhZ1IvGXjTNyruDPIxHP8au0SArTwjEc1w4//jgDQtxu2', 3, NULL, NULL, NULL),
('198502112008011003', 'P02', 'Mohammad Hafiz Hersyah, MT', 'Lektor', NULL, 'hafiz@gmail.com', NULL, '$2y$10$9cCDHBIF.Ft96Ih7dYqL/OSECh0P5dOco8zq3CS2wrx7pXd/qO9Ou', 2, NULL, NULL, NULL),
('198611072015041001', 'P02', 'Dody Ichwana Putra, MT', 'Lektor', NULL, 'dody@gmail.com', NULL, '$2y$10$8sZE04an5UKn8VxsclaC..IBu2XXvuc7ZiYo4qUoxqRIhwZnOGaLi', 3, NULL, NULL, NULL),
('198904152019031009', 'P01', 'Jefril Rahmadoni, M.Kom', 'Asisten Ahli', NULL, 'jefril@gmail.com', NULL, '$2y$10$0ssSDLIAgXFAdQVNlEBquO9qEkz9k6H/XDUiHASWg7WiK/ud7nLCe', 3, NULL, NULL, NULL),
('198904212019032024', 'P01', 'Afriyanti Dwi Kartika, MT', 'Fungsional Umum', NULL, 'AfriyantiDwi@gmail.com', NULL, '$2y$10$/zL1xYAKvpFbuNOzfqf6cu04Aow/1RgKykFHwA1lf.Bd6EXhNeMJa', 3, NULL, NULL, NULL),
('199011032019032008', 'P01', 'Ullya Mega Wahyuni, M.Kom', 'Asisten Ahli', NULL, 'ullie@gmail.com', NULL, '$2y$10$w3gm7z42t8ZGGfXZDcQ88ulLlJX0vDT5sLoxozmx25RIZWleZOg9G', 2, NULL, NULL, NULL),
('199104172022031007', 'P02', 'Febby Apri Wenando, M.Eng', 'Fungsional Umum', NULL, 'febby@gmail.com', NULL, '$2y$10$cWj1OmoWs.0s9O9LmrQ9quo6i1znwvpwrT8wCInEPv1RwpWqtnqcy', 3, NULL, NULL, NULL),
('199108122019032018', 'P01', 'Dwi Welly Sukma Nirad, MT', 'Asisten Ahli', NULL, 'dwiw@gmail.com', NULL, '$2y$10$qG.WaXFLnzIW7Sx0kyQLz.ly2Jv89YXo4xWq5kLhZ.dop3O9TSqSC', 3, NULL, NULL, NULL),
('199111192018032001', 'P02', 'Nefy Puteri Novani, MT', 'Asisten Ahli', NULL, 'nefy@gmail.com', NULL, '$2y$10$MzI2akYigprj1JcIsNSWquR.e5kHiD.58GmwYBC5WUiCgUzYc68Gm', 3, NULL, NULL, NULL),
('199308152022032017', 'P01', 'Rahmatika Pratama Santi, MT', 'Fungsional Umum', NULL, 'rahmatika@gmail.com', NULL, '$2y$10$XHTQ7Pm3eFfgaNRf5Ihycu0vzaLhZIj4cQH0J2dA1TAiEgwRpCRUG', 3, NULL, NULL, NULL),
('199309292019032022', 'P01', 'Hafizah Hanim, M.Kom', 'Asisten Ahli', NULL, 'hafizah@gmail.com', NULL, '$2y$10$pM2cqDmyG0WgmxG9AL1QCubMmN7UW9l2k.rdKlNO3pu6D1Aap8apS', 3, NULL, NULL, NULL),
('199402062022031004', 'P02', 'Rifki Suwandi, MT', 'Fungsional Umum', NULL, 'rifki@gmail.com', NULL, '$2y$10$zbEGymuZwvzQjh/DpROXi.NEz5OBrZj1l/Xe9KuJksn/OOF5wECh6', 3, NULL, NULL, NULL),
('199404292022032014', 'P02', 'Rizka Hadelina, M.T', 'Fungsional Umum', NULL, 'rizka@gmail.com', NULL, '$2y$10$P9Tj90Q9m.eg9mfWV.6x7eXqiQyTNC8qikZN6wEUUbL8aZ.d7KxWa', 3, NULL, NULL, NULL),
('199504302022032013', 'P01', 'Aina Hubby Aziira, M.Eng', 'Fungsional Umum', NULL, 'aina@gmail.com', NULL, '$2y$10$.2hLZ5eRKISfGLKuN.DFz.dC5uubZ0u.VmEijwHFue0Jf/jjNdFHO', 3, NULL, NULL, NULL),
('199506232022031014', 'P02', 'Arrya Anandika, M.T', 'Fungsional Umum', NULL, 'arrya@gmail.com', NULL, '$2y$10$JxTd8DUXVjXIzdKHmkhLf.EFMU25KsaUyayBJHfRIcAkWJp48pCIy', 3, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkasdokumens`
--
ALTER TABLE `berkasdokumens`
  ADD KEY `berkasdokumens_id_kelas_perkuliahan_foreign` (`id_kelas_perkuliahan`),
  ADD KEY `berkasdokumens_id_kategori_berkas_foreign` (`id_kategori_berkas`);

--
-- Indexes for table `detailhasilverifikators`
--
ALTER TABLE `detailhasilverifikators`
  ADD KEY `detailhasilverifikators_id_hasil_verifikasi_foreign` (`id_hasil_verifikasi`),
  ADD KEY `detailhasilverifikators_id_jenis_kelengkapan_dokumen_foreign` (`id_jenis_kelengkapan_dokumen`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasilverifikasis`
--
ALTER TABLE `hasilverifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasilverifikasis_id_dosen_verifikator_foreign` (`id_dosen_verifikator`),
  ADD KEY `hasilverifikasis_id_kelas_perkuliahan_foreign` (`id_kelas_perkuliahan`);

--
-- Indexes for table `jeniskelengkapandokumens`
--
ALTER TABLE `jeniskelengkapandokumens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoriberkas`
--
ALTER TABLE `kategoriberkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelasperkuliahans`
--
ALTER TABLE `kelasperkuliahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelasperkuliahans_id_dosen_pengampu_foreign` (`id_dosen_pengampu`),
  ADD KEY `kelasperkuliahans_id_matakuliah_foreign` (`id_matakuliah`);

--
-- Indexes for table `matakuliahs`
--
ALTER TABLE `matakuliahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matakuliahs_id_prodi_foreign` (`id_prodi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitorings`
--
ALTER TABLE `monitorings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monitorings_id_hasil_verifikasi_foreign` (`hasil_verifikasi_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_prodi_foreign` (`id_prodi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berkasdokumens`
--
ALTER TABLE `berkasdokumens`
  ADD CONSTRAINT `berkasdokumens_id_kategori_berkas_foreign` FOREIGN KEY (`id_kategori_berkas`) REFERENCES `kategoriberkas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `berkasdokumens_id_kelas_perkuliahan_foreign` FOREIGN KEY (`id_kelas_perkuliahan`) REFERENCES `kelasperkuliahans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailhasilverifikators`
--
ALTER TABLE `detailhasilverifikators`
  ADD CONSTRAINT `detailhasilverifikators_id_hasil_verifikasi_foreign` FOREIGN KEY (`id_hasil_verifikasi`) REFERENCES `hasilverifikasis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailhasilverifikators_id_jenis_kelengkapan_dokumen_foreign` FOREIGN KEY (`id_jenis_kelengkapan_dokumen`) REFERENCES `jeniskelengkapandokumens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasilverifikasis`
--
ALTER TABLE `hasilverifikasis`
  ADD CONSTRAINT `hasilverifikasis_id_dosen_verifikator_foreign` FOREIGN KEY (`id_dosen_verifikator`) REFERENCES `users` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasilverifikasis_id_kelas_perkuliahan_foreign` FOREIGN KEY (`id_kelas_perkuliahan`) REFERENCES `kelasperkuliahans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelasperkuliahans`
--
ALTER TABLE `kelasperkuliahans`
  ADD CONSTRAINT `kelasperkuliahans_id_dosen_pengampu_foreign` FOREIGN KEY (`id_dosen_pengampu`) REFERENCES `users` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelasperkuliahans_id_matakuliah_foreign` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliahs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matakuliahs`
--
ALTER TABLE `matakuliahs`
  ADD CONSTRAINT `matakuliahs_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `prodis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitorings`
--
ALTER TABLE `monitorings`
  ADD CONSTRAINT `monitorings_id_hasil_verifikasi_foreign` FOREIGN KEY (`hasil_verifikasi_id`) REFERENCES `hasilverifikasis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `prodis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
