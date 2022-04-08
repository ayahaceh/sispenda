-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 09:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earsipvl`
--

-- --------------------------------------------------------

--
-- Table structure for table `desas`
--

CREATE TABLE `desas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_desa` int(10) UNSIGNED NOT NULL,
  `id_kec` int(10) UNSIGNED NOT NULL,
  `nama_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_surat_masuk` int(11) NOT NULL,
  `ke_bagian` int(11) NOT NULL,
  `id_sifat` int(11) DEFAULT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `isi_disposisi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan_disposisi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_disposisi` datetime DEFAULT NULL,
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berkas_tindak_lanjut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_tindak_lanjut` int(11) DEFAULT NULL,
  `tgl_tindak_lanjut` datetime DEFAULT NULL,
  `cat_pimpinan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_cat_pimpinan` int(11) DEFAULT NULL,
  `tgl_cat_pimpinan` datetime DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `id_proses` int(11) DEFAULT NULL,
  `insert_by` int(11) NOT NULL,
  `update_by` int(11) DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id`, `id_surat_masuk`, `ke_bagian`, `id_sifat`, `batas_waktu`, `isi_disposisi`, `catatan_disposisi`, `tgl_disposisi`, `qr_code`, `tindak_lanjut`, `berkas_tindak_lanjut`, `user_tindak_lanjut`, `tgl_tindak_lanjut`, `cat_pimpinan`, `user_cat_pimpinan`, `tgl_cat_pimpinan`, `id_status`, `id_proses`, `insert_by`, `update_by`, `delete_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 2, 1, '2021-03-28 00:00:00', 'Ini Isi Disposisi', 'Ini Catatan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-03-28 06:45:48', '2021-03-28 06:45:48', NULL),
(2, 6, 2, 1, '2021-03-29 00:00:00', 'isi untuk admin', 'Catattata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-03-28 06:46:37', '2021-03-28 06:46:37', NULL),
(3, 7, 2, 3, '2021-04-03 00:00:00', 'Isi Disposisi ini', 'Sifatnya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-02 13:40:18', '2021-04-02 13:40:18', NULL),
(4, 7, 2, 1, '2021-04-03 00:00:00', 'Merdeka', 'Catatan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-02 13:40:40', '2021-04-02 13:40:40', NULL),
(5, 7, 2, 1, '2021-04-03 00:00:00', 'Isi saja', 'Catatan', '2021-04-03 11:23:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-03 04:23:01', '2021-04-03 04:23:01', NULL),
(6, 7, 5, 4, '2021-04-03 00:00:00', 'Ini Isi Disposisi', 'Ini Catatan Disposisi', '2021-04-03 11:38:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-03 04:38:38', '2021-04-03 04:38:38', NULL),
(7, 7, 6, 1, '2021-04-03 00:00:00', 'Isi kepada Pembaca', 'Catatan yang tak pantas', '2021-04-03 11:44:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-03 04:44:08', '2021-04-03 04:44:08', NULL),
(8, 8, 2, 1, '2021-04-04 00:00:00', 'Isi Disposisi', 'Sifatnya saja', '2021-04-04 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-03 21:54:56', '2021-04-03 21:54:56', NULL),
(9, 8, 2, 1, '2021-04-13 00:00:00', 'thaer', 'agrawerg', '2021-04-04 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-03 21:59:16', '2021-04-03 21:59:16', NULL),
(10, 8, 2, 1, '2021-04-04 00:00:00', 'GAD', 'AG', '2021-04-04 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-03 22:00:50', '2021-04-03 22:00:50', NULL),
(11, 19, 2, 1, '2021-04-04 00:00:00', 'Isinya', 'Sifatnya', '2021-04-04 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2021-04-03 23:14:54', '2021-04-03 23:14:54', NULL);

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
-- Stand-in structure for view `jl_disp`
-- (See below for the actual view)
--
CREATE TABLE `jl_disp` (
`ke_bagian` int(11)
,`id_prosessatu` bigint(21)
,`id_prosesdua` bigint(21)
,`id_prosestiga` bigint(21)
,`id_prosesempat` bigint(21)
,`id_proseslima` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kec` int(10) UNSIGNED NOT NULL,
  `nama_kec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_log` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_status` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_users`
--

CREATE TABLE `log_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_log` int(10) UNSIGNED NOT NULL,
  `kegiatan` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_users_refs`
--

CREATE TABLE `log_users_refs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_keg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_keg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_users_refs`
--

INSERT INTO `log_users_refs` (`id`, `nama_keg`, `deskripsi_keg`) VALUES
(1, 'login', 'Login kedalam aplikasi'),
(2, 'Input', 'Insert data'),
(3, 'Edit', 'Edit data'),
(4, 'Hapus', 'Hapus data'),
(5, 'Lihat', 'Lihat data');

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
(1, '2021_02_10_210920_create_satkers', 1),
(2, '2021_02_11_080000_create_user_groups', 1),
(3, '2021_02_11_090000_create_status', 1),
(4, '2021_02_12_090000_create_users_table', 1),
(5, '2021_02_12_100000_create_password_resets_table', 1),
(6, '2021_03_08_080000_create_log_user_refs', 1),
(7, '2021_03_09_000000_create_failed_jobs_table', 1),
(8, '2021_03_09_160200_create_proses_surat_keluar', 1),
(9, '2021_03_09_160300_create_proses_surat_masuk', 1),
(10, '2021_03_09_160400_create_proses_disposisi', 1),
(11, '2021_03_09_170000_create_surat_masuk', 1),
(12, '2021_03_09_180000_create_surat_keluar', 1),
(13, '2021_03_09_190000_create_disposisi', 1),
(14, '2021_03_12_090443_create_log_users', 1),
(15, '2021_03_15_210755_create_ref_logs', 1),
(16, '2021_03_15_211615_create_logs', 1),
(17, '2021_03_18_221156_create_kecamatans', 1),
(18, '2021_03_18_221220_create_desas', 1),
(19, '2021_03_18_235654_create_pemilihs', 1),
(20, '2021_03_23_150136_add_timestamps_to_proses_surat_masuk', 1),
(21, '2021_03_27_132208_add_timestamps_to_proses_disposisi', 1),
(22, '2021_03_28_122614_create_ref_sifat', 1),
(23, '2021_04_02_171617_add_field_to_users', 2),
(24, '2021_04_05_132056_create_v_jumlah_disposisi_groupby', 3),
(25, '2021_04_05_160726_add_nip_to_user', 4);

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
-- Table structure for table `pemilihs`
--

CREATE TABLE `pemilihs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kec` int(11) NOT NULL,
  `id_desa` int(10) UNSIGNED NOT NULL,
  `no_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` datetime DEFAULT NULL,
  `kawin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disabilitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proses_disposisi`
--

CREATE TABLE `proses_disposisi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_proses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_proses` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proses_disposisi`
--

INSERT INTO `proses_disposisi` (`id`, `nama_proses`, `deskripsi_proses`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Belum Diproses,belum dibaca', 'Disposisi Belum Diproses', NULL, NULL, NULL),
(2, 'Belum Diproses,sudah dibaca', 'Disposisi Sudah Dibaca oleh ybs.', NULL, NULL, NULL),
(3, 'Sedang Diproses', 'Disposisi Sedang Diproses', NULL, NULL, NULL),
(4, 'Selesai Diproses', 'Disposisi Selesai Diproses', NULL, NULL, NULL),
(5, 'Arsip Disposisi', 'Disposisi Telah Disetujui dan telah Diarsipkan', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proses_surat_keluar`
--

CREATE TABLE `proses_surat_keluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_proses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_proses` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proses_surat_keluar`
--

INSERT INTO `proses_surat_keluar` (`id`, `nama_proses`, `deskripsi_proses`) VALUES
(1, 'Belum Diarsipkan', 'Surat Keluar Belum Diarsipkan'),
(2, 'Sudah Diarsipkan', 'Surat Keluar sudah diarsipkan');

-- --------------------------------------------------------

--
-- Table structure for table `proses_surat_masuk`
--

CREATE TABLE `proses_surat_masuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_proses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_proses` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proses_surat_masuk`
--

INSERT INTO `proses_surat_masuk` (`id`, `nama_proses`, `deskripsi_proses`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Belum di Disposisi', 'Surat Masuk belum di Disposisi', NULL, '2021-04-02 07:37:23', NULL),
(2, 'Sudah di Disposisiiii', 'Surat Masuk Sudah di Disposisi', NULL, '2021-04-02 07:43:39', NULL),
(3, 'Sudah Diarsipkan', 'Surat Masuk Sudah Diarsipkan', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_logs`
--

CREATE TABLE `ref_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_log` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_log` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_sifat`
--

CREATE TABLE `ref_sifat` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_sifat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_sifat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ref_sifat`
--

INSERT INTO `ref_sifat` (`id`, `nama_sifat`, `deskripsi_sifat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Biasa', NULL, NULL, NULL, NULL),
(2, 'Segera', NULL, NULL, NULL, NULL),
(3, 'Perlu Perhatian Khusus', NULL, NULL, NULL, NULL),
(4, 'Perhatian Batas Waktu', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `satkers`
--

CREATE TABLE `satkers` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode_satker` int(11) NOT NULL,
  `nama_satker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_satker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_satker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_satker` int(11) DEFAULT NULL,
  `nama_satkera` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_satkerb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_satker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prov_satker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_satker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kepala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip_kepala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jab_kepala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satkers`
--

INSERT INTO `satkers` (`id`, `kode_satker`, `nama_satker`, `alamat_satker`, `ket_satker`, `status_satker`, `nama_satkera`, `nama_satkerb`, `kota_satker`, `prov_satker`, `logo_satker`, `nama_kepala`, `nip_kepala`, `jab_kepala`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'BPKK Aceh Singkil', NULL, 'Keterangan satker disini', 1, 'Badan Pengelolaan Keuangan', 'Kabupaten Aceh Singkil', 'Aceh Singkil', 'Aceh', 'default.jpg', 'T. Joan Virgianshah', '198606152010121002', 'Sekretaris', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `nama_status`, `deskripsi_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Aktif', 'Record Aktif', NULL, NULL, NULL),
(2, 'Dihapus', 'Record telah dihapus', NULL, NULL, NULL),
(3, 'Sampah', 'Record dihapus selamanya', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_surat` timestamp NULL DEFAULT NULL,
  `klasifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_ringkas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` int(11) DEFAULT NULL,
  `ikon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_status` int(10) UNSIGNED NOT NULL,
  `id_proses` int(10) UNSIGNED DEFAULT NULL,
  `insert_by` int(10) UNSIGNED NOT NULL,
  `update_by` int(10) UNSIGNED DEFAULT NULL,
  `delete_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `no_surat`, `tgl_surat`, `klasifikasi`, `kepada`, `perihal`, `isi_ringkas`, `berkas`, `ukuran`, `ikon`, `mime_berkas`, `id_status`, `id_proses`, `insert_by`, `update_by`, `delete_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '100', '2021-04-01 17:00:00', 'KLA', 'Dinas Perindustrian', 'Pengembangan Industri Bunga Mawar', 'Ajakan untuk pembuatan Bunga Mawar', '210402_103509_STRUKTUR_BPKK_2020.pdf', 48038, 'file-pdf', 'pdf', 1, 1, 1, NULL, 1, '2021-04-02 03:35:10', '2021-04-02 05:02:37', NULL),
(2, '222', '2021-04-02 17:00:00', 'KLC', 'Dinas Perdagangan', 'Penyempurnaan Sistem Perdagangan', 'Pemandu perdagangan bursa efek', 'default.jpg', 100, 'file-pdf', 'jpg', 1, 1, 1, 1, NULL, '2021-04-02 04:56:57', '2021-04-02 13:33:00', NULL),
(3, '770', '2021-04-06 17:00:00', 'KLC', 'Dinas Perindustrian', 'fdabWG', 'SDGFsef', 'default.jpg', 100, 'file-pdf', 'jpg', 1, 1, 1, 1, NULL, '2021-04-06 00:28:09', '2021-04-06 00:28:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_agenda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_surat` datetime DEFAULT NULL,
  `tgl_agenda` datetime DEFAULT NULL,
  `klasifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_ringkas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ukuran` int(11) DEFAULT NULL,
  `ikon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_status` int(10) UNSIGNED NOT NULL,
  `id_proses` int(10) UNSIGNED NOT NULL,
  `insert_by` int(10) UNSIGNED NOT NULL,
  `update_by` int(10) UNSIGNED DEFAULT NULL,
  `delete_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `no_surat`, `no_agenda`, `tgl_surat`, `tgl_agenda`, `klasifikasi`, `pengirim`, `perihal`, `isi_ringkas`, `berkas`, `ukuran`, `ikon`, `mime_berkas`, `id_status`, `id_proses`, `insert_by`, `update_by`, `delete_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '100', '10', '2021-03-28 13:45:10', '2021-03-28 13:45:10', 'KEU', 'Dinas Perhubungan', 'Pemetaan Aset Dinas Perhubungan', 'Tolong dipetakan seluruh aset kami agar kami tidak repot lagi', 'default.jpg', 1280, 'fa-file-pdf', 'Documents', 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(2, '200', '20', '2021-03-28 13:45:10', '2021-03-28 13:45:10', 'ADM', 'Dinas Pariwisata', 'Objek Wisata terbaru dikota kita', 'Mari ramaikan objek wisata baru agar pedagang disana sejahtera', 'default.jpg', 1630, 'fa-file-pdf', 'Documents', 2, 1, 2, 2, NULL, NULL, NULL, NULL),
(3, '300', '30', '2021-03-28 13:45:10', '2021-03-28 13:45:10', 'HKM', 'Dinas Perdagangan Industri', 'Ajakan berdagang disetiap ruas jalan nasional', 'Mari berdagang beramai-ramai di ruas Jalan Nasional agar jalanan macet', 'default.jpg', 2490, 'fa-file-pdf', 'Documents', 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(4, '400', '40', '2021-03-28 13:45:10', '2021-03-28 13:45:10', 'TKN', 'Gubernur DKI', 'Banjir Jakarta', 'Agar Tidak banjir lagi, mari pindah ke Bogor semua', 'default.jpg', 4280, 'fa-file-pdf', 'Documents', 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(5, '500', '50', '2021-03-28 13:45:10', '2021-03-28 13:45:10', 'ADM', 'DPRK Aceh', 'Tidur adalah ibadah', 'Jika kami tidur, berarti kami sedang beribadah', 'default.jpg', 3540, 'fa-file-pdf', 'Documents', 2, 1, 2, 2, NULL, NULL, NULL, NULL),
(6, '666', '60', '2021-04-03 00:00:00', '2021-04-03 00:00:00', 'UM', 'Bupati Aceh', 'Hari Kejepit Nasional', 'Harusnya Harpitnas itu cuti bersama saja', 'default.jpg', 100, 'file-pdf', 'jpg', 1, 1, 1, 1, NULL, '2021-04-02 10:59:48', '2021-04-02 10:59:48', NULL),
(7, '1870', '1700', '2021-04-03 00:00:00', '2021-04-03 00:00:00', 'KLB', 'Pengiriman Paket', 'Perihalan Halaman', 'Ringkasan Sangat', '210403_081424.Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-02 11:47:20', '2021-04-03 01:14:45', NULL),
(8, '2770', '2700', '2021-04-03 00:00:00', '2021-04-03 00:00:00', 'KJB', 'bupati', 'Perihal Bupati Singkil', 'isi ringkas pubati', '210403_081833.Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 01:17:53', '2021-04-03 01:43:55', NULL),
(9, '1112', '1123', '2021-04-04 00:00:00', '2021-04-05 00:00:00', 'KLD', 'Pengiriman', 'Perihalan', 'ringkasan', '210404_050758_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:07:58', '2021-04-03 22:07:58', NULL),
(10, '11234', '11235', '2021-04-04 00:00:00', '2021-04-04 00:00:00', 'KLD', 'Dinas', 'Lampi', 'isi Ringkasaasssa', '210404_051520_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:15:20', '2021-04-03 22:15:20', NULL),
(11, '770', '770', '2021-04-04 00:00:00', '2021-04-28 00:00:00', 'KLC', 'Pengiriman Paket', 'ewwe', 'wefwqr', '210404_051648_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:16:48', '2021-04-03 22:16:48', NULL),
(12, '770', '770', '2021-04-04 00:00:00', '2021-04-28 00:00:00', 'KLC', 'Pengiriman Paket', 'ewwe', 'wefwqr', '210404_051733_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:17:33', '2021-04-03 22:17:33', NULL),
(13, '770', '770', '2021-04-04 00:00:00', '2021-04-28 00:00:00', 'KLC', 'Pengiriman Paket', 'ewwe', 'wefwqr', '210404_053113_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:31:13', '2021-04-03 22:31:13', NULL),
(14, '770', '770', '2021-04-04 00:00:00', '2021-04-28 00:00:00', 'KLC', 'Pengiriman Paket', 'ewwe', 'wefwqr', '210404_054740_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:47:40', '2021-04-03 22:47:40', NULL),
(15, '770', '770', '2021-04-04 00:00:00', '2021-04-28 00:00:00', 'KLC', 'Pengiriman Paket', 'ewwe', 'wefwqr', '210404_054918_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:49:18', '2021-04-03 22:49:18', NULL),
(16, '770', '770', '2021-04-04 00:00:00', '2021-04-28 00:00:00', 'KLC', 'Pengiriman Paket', 'ewwe', 'wefwqr', '210404_055024_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:50:24', '2021-04-03 22:50:24', NULL),
(17, '770', '770', '2021-04-04 00:00:00', '2021-04-30 00:00:00', 'KLXS', 'Pengiriman Paket', 'sdv', 'asdfa', '210404_055137_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:51:37', '2021-04-03 22:51:37', NULL),
(18, '770', '770', '2021-04-04 00:00:00', '2021-04-23 00:00:00', 'sa', 'as', 'asd', 'asd', '210404_055630_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:56:30', '2021-04-03 22:56:30', NULL),
(19, '770', '770', '2021-04-04 00:00:00', '2021-04-23 00:00:00', 'sa', 'as', 'asd', 'asd', '210404_055841_Slide8.PNG', 133178, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 22:58:41', '2021-04-03 22:58:41', NULL),
(20, '770', '700', '2021-04-08 00:00:00', '2021-04-04 00:00:00', 'KLB', 'Pengiriman Paket', 'sdfds', 'asdfas', '210404_061914_Slide1.PNG', 834, 'file-pdf', 'png', 1, 1, 1, 1, NULL, '2021-04-03 23:19:14', '2021-04-03 23:19:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_group` int(10) UNSIGNED NOT NULL,
  `tg` int(11) DEFAULT NULL,
  `wa` int(11) DEFAULT NULL,
  `terakhir` datetime DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_satker` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nip`, `username`, `email`, `email_verified_at`, `password`, `foto`, `user_group`, `tg`, `wa`, `terakhir`, `token`, `deskripsi`, `id_satker`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', NULL, 'superadmin', 'razali.adam@gmail.com', '2021-03-28 06:45:10', '$2y$10$gZ3Y1H2RjQ4/E9l9JsVDtOAC.Ot0PCgdFQrjyFuXHQOkR5DOhGxbW', 'default.jpg', 3, 547288630, NULL, '2021-04-06 07:36:31', 'xjX7RnwgBO', 'Super Admin Description', 1, NULL, '2021-04-06 00:36:31', NULL),
(2, 'Sekretaris', NULL, 'sekretaris', 'razali.kpu@gmail.com', '2021-03-28 06:45:10', '$2y$10$gZ3Y1H2RjQ4/E9l9JsVDtOAC.Ot0PCgdFQrjyFuXHQOkR5DOhGxbW', 'default.jpg', 3, 547288630, NULL, '2021-03-28 13:45:10', 'G9V3h7zKLu', 'Sekretaris Description', 1, NULL, NULL, NULL),
(3, 'Bagian', NULL, 'bagian', 'bagian@ayahaceh.com', '2021-03-28 06:45:10', '$2y$10$gZ3Y1H2RjQ4/E9l9JsVDtOAC.Ot0PCgdFQrjyFuXHQOkR5DOhGxbW', 'default.jpg', 3, 547288630, NULL, '2021-03-28 13:45:10', 'ZAzLa41c2f', 'Bagian Description', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `nama_group`, `deskripsi_group`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'Administrator Super Aplikasi', NULL, NULL, NULL),
(2, 'Admin', 'Administrator Aplikasi', NULL, NULL, NULL),
(3, 'Kepala', 'Pimpinan Kantor', NULL, NULL, NULL),
(4, 'Bidang', 'Bagian / Sub Bagian', NULL, NULL, NULL),
(5, 'Operator Bidang', 'Operator Bagian / Sub Bagian', NULL, NULL, NULL),
(6, 'Operator Umum', 'User hanya dapat melihat2 data arsip saja', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure for view `jl_disp`
--
DROP TABLE IF EXISTS `jl_disp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jl_disp`  AS  (select `disposisi`.`ke_bagian` AS `ke_bagian`,count(if(`disposisi`.`deleted_at` is null and `disposisi`.`id_proses` = 1,`disposisi`.`id_proses`,NULL)) AS `id_prosessatu`,count(if(`disposisi`.`deleted_at` is null and `disposisi`.`id_proses` = 2,`disposisi`.`id_proses`,NULL)) AS `id_prosesdua`,count(if(`disposisi`.`deleted_at` is null and `disposisi`.`id_proses` = 3,`disposisi`.`id_proses`,NULL)) AS `id_prosestiga`,count(if(`disposisi`.`deleted_at` is null and `disposisi`.`id_proses` = 4,`disposisi`.`id_proses`,NULL)) AS `id_prosesempat`,count(if(`disposisi`.`deleted_at` is null and `disposisi`.`id_proses` = 5,`disposisi`.`id_proses`,NULL)) AS `id_proseslima` from `disposisi` group by `disposisi`.`ke_bagian`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `desas`
--
ALTER TABLE `desas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_users`
--
ALTER TABLE `log_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_users_refs`
--
ALTER TABLE `log_users_refs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemilihs`
--
ALTER TABLE `pemilihs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proses_disposisi`
--
ALTER TABLE `proses_disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proses_surat_keluar`
--
ALTER TABLE `proses_surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proses_surat_masuk`
--
ALTER TABLE `proses_surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_logs`
--
ALTER TABLE `ref_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_sifat`
--
ALTER TABLE `ref_sifat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satkers`
--
ALTER TABLE `satkers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `desas`
--
ALTER TABLE `desas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_users`
--
ALTER TABLE `log_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_users_refs`
--
ALTER TABLE `log_users_refs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pemilihs`
--
ALTER TABLE `pemilihs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proses_disposisi`
--
ALTER TABLE `proses_disposisi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `proses_surat_keluar`
--
ALTER TABLE `proses_surat_keluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proses_surat_masuk`
--
ALTER TABLE `proses_surat_masuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ref_logs`
--
ALTER TABLE `ref_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_sifat`
--
ALTER TABLE `ref_sifat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `satkers`
--
ALTER TABLE `satkers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
