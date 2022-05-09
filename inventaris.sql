/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : inventaris

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 10/05/2022 07:48:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for akses
-- ----------------------------
DROP TABLE IF EXISTS `akses`;
CREATE TABLE `akses`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_menu` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 938 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of akses
-- ----------------------------
INSERT INTO `akses` VALUES (736, '200403205', 'mn1', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (737, '200403205', 'mn2', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (738, '200403205', 'mn23', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (739, '200403205', 'mn24', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (740, '200403205', 'mn4', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (741, '200403205', 'mn31', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (742, '200403205', 'mn41', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (743, '200403205', 'mn42', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (744, '200403205', 'mn5', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (745, '200403205', 'mn51', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (746, '200403205', 'mn52', '2021-08-31 02:16:09', '2021-08-31 02:16:09');
INSERT INTO `akses` VALUES (774, '200904249', 'mn1', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (775, '200904249', 'mn2', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (776, '200904249', 'mn23', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (777, '200904249', 'mn4', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (778, '200904249', 'mn31', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (779, '200904249', 'mn41', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (780, '200904249', 'mn42', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (781, '200904249', 'mn44', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (782, '200904249', 'mn5', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (783, '200904249', 'mn51', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (784, '200904249', 'mn52', '2021-09-06 01:57:20', '2021-09-06 01:57:20');
INSERT INTO `akses` VALUES (785, '201203277', 'mn1', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (786, '201203277', 'mn2', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (787, '201203277', 'mn23', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (788, '201203277', 'mn24', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (789, '201203277', 'mn4', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (790, '201203277', 'mn31', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (791, '201203277', 'mn41', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (792, '201203277', 'mn42', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (793, '201203277', 'mn44', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (794, '201203277', 'mn5', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (795, '201203277', 'mn51', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (796, '201203277', 'mn52', '2021-09-06 01:57:27', '2021-09-06 01:57:27');
INSERT INTO `akses` VALUES (797, '9804123', 'mn1', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (798, '9804123', 'mn2', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (799, '9804123', 'mn23', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (800, '9804123', 'mn24', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (801, '9804123', 'mn4', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (802, '9804123', 'mn31', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (803, '9804123', 'mn41', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (804, '9804123', 'mn42', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (805, '9804123', 'mn44', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (806, '9804123', 'mn5', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (807, '9804123', 'mn51', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (808, '9804123', 'mn52', '2021-09-14 03:28:04', '2021-09-14 03:28:04');
INSERT INTO `akses` VALUES (837, 'kise', 'mn1', '2021-11-01 01:21:14', '2021-11-01 01:21:14');
INSERT INTO `akses` VALUES (838, 'kise', 'mn2', '2021-11-01 01:21:14', '2021-11-01 01:21:14');
INSERT INTO `akses` VALUES (839, 'kise', 'mn21', '2021-11-01 01:21:14', '2021-11-01 01:21:14');
INSERT INTO `akses` VALUES (840, 'kise', 'mn23', '2021-11-01 01:21:14', '2021-11-01 01:21:14');
INSERT INTO `akses` VALUES (841, 'kise', 'mn24', '2021-11-01 01:21:14', '2021-11-01 01:21:14');
INSERT INTO `akses` VALUES (921, 'admin', 'mn1', '2022-03-31 01:38:02', '2022-03-31 01:38:02');
INSERT INTO `akses` VALUES (922, 'admin', 'mn2', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (923, 'admin', 'mn21', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (924, 'admin', 'mn23', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (925, 'admin', 'mn24', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (926, 'admin', 'mn25', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (927, 'admin', 'mn26', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (928, 'admin', 'mn4', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (929, 'admin', 'mn31', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (930, 'admin', 'mn41', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (931, 'admin', 'mn42', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (932, 'admin', 'mn5', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (933, 'admin', 'mn51', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (934, 'admin', 'mn6', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (935, 'admin', 'mn61', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (936, 'admin', 'mn62', '2022-03-31 01:38:03', '2022-03-31 01:38:03');
INSERT INTO `akses` VALUES (937, 'admin', 'mn63', '2022-03-31 01:38:03', '2022-03-31 01:38:03');

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` int(11) NOT NULL DEFAULT 0,
  `kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis` tinyint(4) NOT NULL DEFAULT 0,
  `nama` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `merk` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `satuan` tinyint(4) NULL DEFAULT NULL,
  `minimum` tinyint(4) NULL DEFAULT NULL,
  `stok` int(11) NULL DEFAULT NULL,
  `harga` int(11) NULL DEFAULT NULL,
  `ukuran` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_beli` datetime NULL DEFAULT NULL,
  `user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES (49, 1, 'INV.BRG-001', 3, 'GENSET', 'Genset Hero', 8, 1, 18, 5000000, 'TYPE 20 KVA', NULL, 'ZANUL HARIR', '2021-11-01 01:52:26', '2021-11-01 01:52:26', NULL);
INSERT INTO `barang` VALUES (50, 2, 'INV.BRG-002', 3, 'TANGKI (60 liter)', 'Tang', 9, 1, 50, 48000, '60 Liter', NULL, 'ZANUL HARIR', '2021-11-01 01:53:33', '2021-11-01 01:53:33', NULL);
INSERT INTO `barang` VALUES (51, 3, 'INV.BRG-003', 4, 'POMPA MESIN', 'PMPA', 8, 1, 25, 50000, 'PZ 74/20/4', NULL, 'ZANUL HARIR', '2021-11-01 01:58:48', '2021-11-01 01:58:48', NULL);
INSERT INTO `barang` VALUES (52, 4, 'INV.BRG-004', 4, 'POMPA MESIN', 'POMPA', 8, 1, 9, 50000, 'PZ 74/20/3', NULL, 'ZANUL HARIR', '2021-11-01 01:59:36', '2021-11-01 01:59:36', NULL);

-- ----------------------------
-- Table structure for detail_barang_keluar
-- ----------------------------
DROP TABLE IF EXISTS `detail_barang_keluar`;
CREATE TABLE `detail_barang_keluar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_kode` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `barang_id` int(11) NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `sisa` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `tgl` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 488 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detail_barang_keluar
-- ----------------------------
INSERT INTO `detail_barang_keluar` VALUES (486, '001/INV.BRG.KLR/III/2022', 49, 2, 'Bima', 18, '2022-03-31 01:07:02', '2022-03-31 01:07:02', '2022-03-15');
INSERT INTO `detail_barang_keluar` VALUES (487, '001/INV.BRG.KLR/III/2022', 52, 3, 'Bima', 9, '2022-03-31 01:07:02', '2022-03-31 01:07:02', '2022-03-15');

-- ----------------------------
-- Table structure for jabatan
-- ----------------------------
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jabatan
-- ----------------------------
INSERT INTO `jabatan` VALUES (1, 'TENAGA TETAP EDIT', 'ZANUL HARIR', '2022-03-31 01:21:06', '2022-03-31 01:22:09');

-- ----------------------------
-- Table structure for jenis
-- ----------------------------
DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis
-- ----------------------------
INSERT INTO `jenis` VALUES (3, 'MESIN', 'ZANUL HARIR', '2021-11-01 01:47:21', '2021-11-01 01:47:21');
INSERT INTO `jenis` VALUES (4, 'POMPA & RAGD', 'ZANUL HARIR', '2021-11-01 01:47:57', '2021-11-01 01:47:57');

-- ----------------------------
-- Table structure for jenis_dokumen
-- ----------------------------
DROP TABLE IF EXISTS `jenis_dokumen`;
CREATE TABLE `jenis_dokumen`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) NULL DEFAULT NULL,
  `jenis` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_dokumen
-- ----------------------------
INSERT INTO `jenis_dokumen` VALUES (2, 2, 'SKT', 'Juru Ukur', '2022-05-03', '2022-05-03 12:34:51', '2022-05-03 12:34:51');

-- ----------------------------
-- Table structure for log_barang
-- ----------------------------
DROP TABLE IF EXISTS `log_barang`;
CREATE TABLE `log_barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` int(11) NOT NULL DEFAULT 0,
  `kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `jenis` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0' COMMENT '1=masuk, 0=keluar',
  `diterima` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `barang_id` int(11) NULL DEFAULT 0,
  `jumlah` int(11) NULL DEFAULT 0,
  `stok` int(11) NULL DEFAULT 0,
  `pj` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `tgl` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 467 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of log_barang
-- ----------------------------
INSERT INTO `log_barang` VALUES (463, 1, '001/BM/RT/MESIN/2021', '1', NULL, 49, 2, 22, 'Zanul Harir', 'ket', 'ZANUL HARIR', '2021-11-01 02:11:05', '2021-11-01 02:11:05', '2021-11-01');
INSERT INTO `log_barang` VALUES (466, 1, '001/INV.BRG.KLR/III/2022', '0', 'Zanul', NULL, 3, 0, 'Zanul', 'Barang keluar', 'ZANUL HARIR', '2022-03-31 01:07:02', '2022-03-31 01:07:02', '2022-03-15');

-- ----------------------------
-- Table structure for log_peralatan
-- ----------------------------
DROP TABLE IF EXISTS `log_peralatan`;
CREATE TABLE `log_peralatan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peralatan_id` int(11) NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `pj` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ket` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl` date NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `jenis` tinyint(11) NULL DEFAULT 1 COMMENT '1 = masuk \r\n\r\n0 = rusak',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of log_peralatan
-- ----------------------------
INSERT INTO `log_peralatan` VALUES (3, 5, 20, 'ew', 'we', '2022-03-30', '2022-03-30 02:13:26', '2022-03-30 02:13:26', 1);
INSERT INTO `log_peralatan` VALUES (4, 5, 50, 'ZANUL HARIR', NULL, '2022-03-30', '2022-03-30 02:17:58', '2022-03-30 02:17:58', 0);
INSERT INTO `log_peralatan` VALUES (5, 5, 2, 'd', NULL, '2022-05-03', '2022-05-03 11:51:08', '2022-05-03 11:51:08', 1);
INSERT INTO `log_peralatan` VALUES (6, 5, 2, 'ZANUL HARIR', NULL, '2022-05-03', '2022-05-03 11:52:34', '2022-05-03 11:52:34', 0);

-- ----------------------------
-- Table structure for lokasi
-- ----------------------------
DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE `lokasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lokasi
-- ----------------------------
INSERT INTO `lokasi` VALUES (1, 'Gudang Kantor (Mataram)', 'ZANUL HARIR', '2022-03-01 00:57:51', '2022-03-01 00:58:44');
INSERT INTO `lokasi` VALUES (2, 'Gudang Baru (Mataram)', 'ZANUL HARIR', '2022-03-01 00:58:32', '2022-03-29 00:53:06');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kd_menu` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_menu` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `kd_parent` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'mn1', 'Dashboard', 1, '-', '/dashboard', 'fa fa-th-large', NULL, NULL);
INSERT INTO `menus` VALUES (2, 'mn21', 'User', 0, 'mn2', '/user', 'fa-user', NULL, NULL);
INSERT INTO `menus` VALUES (43, 'mn2', 'Setup', 1, '-', '-', 'fa fa-cog', NULL, NULL);
INSERT INTO `menus` VALUES (49, 'mn23', 'Satuan & Jenis', 0, 'mn2', '/satuan', '-', '2021-03-02 10:44:34', '2021-03-02 10:44:34');
INSERT INTO `menus` VALUES (51, 'mn31', 'Data Barang', 0, 'mn4', '/barang', '-', '2021-03-09 08:09:47', '2021-03-09 08:09:47');
INSERT INTO `menus` VALUES (52, 'mn4', 'Manajemen Barang', 1, '-', '-', 'fa fa-window-restore', '2021-03-16 09:03:22', '2021-03-16 09:03:22');
INSERT INTO `menus` VALUES (53, 'mn41', 'Barang Masuk', 0, 'mn4', '/barang_masuk', '-', '2021-03-16 09:03:48', '2021-03-16 09:03:48');
INSERT INTO `menus` VALUES (54, 'mn42', 'Barang Keluar', 0, 'mn4', '/barang_keluar', '-', '2021-03-16 09:05:22', '2021-03-16 09:05:23');
INSERT INTO `menus` VALUES (62, 'mn44', 'Laporan', 0, 'mn4', '/laporan', '-', NULL, NULL);
INSERT INTO `menus` VALUES (64, 'mn61', 'Rekap Barang', 0, 'mn6', '/laporan', '-', NULL, NULL);
INSERT INTO `menus` VALUES (65, 'mn62', 'Laporan Barang Masuk', 0, 'mn6', '/laporan-masuk', '-', NULL, NULL);
INSERT INTO `menus` VALUES (66, 'mn63', 'Laporan Barang Keluar', 0, 'mn6', '/laporan-keluar', '-', NULL, NULL);
INSERT INTO `menus` VALUES (67, 'mn24', 'Lokasi', 0, 'mn2', '/lokasi', '-', NULL, NULL);
INSERT INTO `menus` VALUES (69, 'mn5', 'Manajemen Peralatan', 1, '-', '-', 'fa-cubes', NULL, NULL);
INSERT INTO `menus` VALUES (70, 'mn51', 'Data Peralatan', 0, 'mn5', '/peralatan', '-', NULL, NULL);
INSERT INTO `menus` VALUES (71, 'mn6', 'Laporan', 1, '-', '-', 'fa-file', NULL, NULL);
INSERT INTO `menus` VALUES (72, 'mn25', 'Jabatan', 0, 'mn2', '/jabatan', '-', NULL, NULL);
INSERT INTO `menus` VALUES (73, 'mn26', 'Pegawai', 0, 'mn2', '/pegawai', '-', NULL, NULL);

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` int(11) NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan_id` int(11) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_identitas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
INSERT INTO `pegawai` VALUES (2, 1, 'PEG-001', 1, 'Arki Dikania Wisnu', '3232', 'Jln. Bukit Batulayar No 14A', '08192252', '111', '2022-04-04 03:26:02', '2022-04-04 03:26:02');

-- ----------------------------
-- Table structure for peralatan
-- ----------------------------
DROP TABLE IF EXISTS `peralatan`;
CREATE TABLE `peralatan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` int(11) NOT NULL DEFAULT 0,
  `kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_id` int(11) NULL DEFAULT NULL,
  `merk` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `satuan` tinyint(4) NULL DEFAULT NULL,
  `harga` int(11) NULL DEFAULT NULL,
  `spesifikasi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stok` int(11) NULL DEFAULT NULL,
  `stok_awal` int(11) NULL DEFAULT NULL,
  `rusak` int(11) NULL DEFAULT 0,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `lokasi_id` int(11) NULL DEFAULT NULL,
  `user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of peralatan
-- ----------------------------
INSERT INTO `peralatan` VALUES (5, 1, 'LGSTK.PRLT-001', 'Arki Dikania Wisnu', 3, 'Sidu', 8, 50000, 'Kapasitas 1000 Liter', 82, 20, 52, NULL, 2, 'ZANUL HARIR', '2022-03-30 01:38:33', '2022-05-03 11:52:34');

-- ----------------------------
-- Table structure for satuan
-- ----------------------------
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of satuan
-- ----------------------------
INSERT INTO `satuan` VALUES (8, 'UNIT', 'ZANUL HARIR', '2021-11-01 01:46:51', '2021-11-01 01:46:51');
INSERT INTO `satuan` VALUES (9, 'BUAH', 'ZANUL HARIR', '2021-11-01 01:46:56', '2021-11-01 01:46:56');
INSERT INTO `satuan` VALUES (10, 'BOX', 'ZANUL HARIR', '2021-11-01 01:47:03', '2021-11-01 01:47:03');
INSERT INTO `satuan` VALUES (11, 'SET', 'ZANUL HARIR', '2021-11-01 01:47:09', '2021-11-01 01:47:09');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_user_unique`(`user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'ZANUL HARIR', 'admin', '$2y$10$Lvlc.BBM.9I70HC4S9CVbeCZPOD4QqYlOdeHuD.rPe/ysyi4REAbe', 'mesanggok', 'admin@gmail.com', 1, 1, NULL, '2020-10-16 06:44:26', '2021-11-01 01:20:19');
INSERT INTO `users` VALUES (8, 'Kise Ryouta', 'kise', '$2y$10$wDcMc.XDpJFu45Q1PV5m.eYFrBd7TumuF/LPQjxhMEtC559ddCYoW', '-', NULL, 1, 2, NULL, '2021-11-01 01:21:14', '2021-11-01 01:21:14');

SET FOREIGN_KEY_CHECKS = 1;
