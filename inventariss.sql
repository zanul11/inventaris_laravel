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

 Date: 20/05/2022 10:08:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for absen
-- ----------------------------
DROP TABLE IF EXISTS `absen`;
CREATE TABLE `absen`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) NULL DEFAULT NULL,
  `tgl` datetime NULL DEFAULT NULL,
  `jenis` tinyint(4) NULL DEFAULT NULL COMMENT '1=masuk, 0=pulang',
  `ket` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of absen
-- ----------------------------
INSERT INTO `absen` VALUES (1, 2, '2022-05-17 11:11:44', 1, NULL, '2022-05-17 11:11:44', '2022-05-17 11:11:44');
INSERT INTO `absen` VALUES (2, 2, '2022-05-19 08:19:47', 1, NULL, '2022-05-19 08:19:47', '2022-05-19 08:19:47');
INSERT INTO `absen` VALUES (5, 2, '2022-05-16 11:06:00', 1, 'tes', '2022-05-19 11:06:56', '2022-05-19 11:06:56');
INSERT INTO `absen` VALUES (6, 2, '2022-05-16 16:07:00', 0, 'apa ya', '2022-05-19 11:07:51', '2022-05-19 11:07:51');
INSERT INTO `absen` VALUES (7, 2, '2022-05-17 16:08:00', 0, 'tes', '2022-05-19 11:08:09', '2022-05-19 11:08:09');
INSERT INTO `absen` VALUES (8, 2, '1970-01-01 08:00:00', 2, 'sakit DBD', '2022-05-19 11:21:35', '2022-05-19 11:21:35');
INSERT INTO `absen` VALUES (9, 3, '2022-05-16 07:48:00', 1, 'tes', '2022-05-19 14:48:57', '2022-05-19 14:48:57');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1154 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `akses` VALUES (1124, 'admin', 'mn1', '2022-05-19 15:04:12', '2022-05-19 15:04:12');
INSERT INTO `akses` VALUES (1125, 'admin', 'mn2', '2022-05-19 15:04:12', '2022-05-19 15:04:12');
INSERT INTO `akses` VALUES (1126, 'admin', 'mn21', '2022-05-19 15:04:12', '2022-05-19 15:04:12');
INSERT INTO `akses` VALUES (1127, 'admin', 'mn23', '2022-05-19 15:04:12', '2022-05-19 15:04:12');
INSERT INTO `akses` VALUES (1128, 'admin', 'mn24', '2022-05-19 15:04:12', '2022-05-19 15:04:12');
INSERT INTO `akses` VALUES (1129, 'admin', 'mn25', '2022-05-19 15:04:12', '2022-05-19 15:04:12');
INSERT INTO `akses` VALUES (1130, 'admin', 'mn26', '2022-05-19 15:04:12', '2022-05-19 15:04:12');
INSERT INTO `akses` VALUES (1131, 'admin', 'mn4', '2022-05-19 15:04:12', '2022-05-19 15:04:12');
INSERT INTO `akses` VALUES (1132, 'admin', 'mn31', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1133, 'admin', 'mn41', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1134, 'admin', 'mn42', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1135, 'admin', 'mn5', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1136, 'admin', 'mn51', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1137, 'admin', 'mn52', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1138, 'admin', 'mn6', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1139, 'admin', 'mn61', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1140, 'admin', 'mn62', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1141, 'admin', 'mn63', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1142, 'admin', 'mn7', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1143, 'admin', 'mn71', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1144, 'admin', 'mn8', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1145, 'admin', 'mn81', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1146, 'admin', 'mn82', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1147, 'admin', 'mn83', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1148, 'admin', 'mn84', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1149, 'admin', 'mn85', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1150, 'admin', 'mn86', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1151, 'admin', 'mn9', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1152, 'admin', 'mn91', '2022-05-19 15:04:13', '2022-05-19 15:04:13');
INSERT INTO `akses` VALUES (1153, 'admin', 'mn92', '2022-05-19 15:04:13', '2022-05-19 15:04:13');

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
INSERT INTO `barang` VALUES (49, 1, 'INV.BRG-001', 3, 'GENSET', 'Genset Hero', 8, 1, 15, 5000000, 'TYPE 20 KVA', NULL, 'ZANUL HARIR', '2021-11-01 01:52:26', '2021-11-01 01:52:26', NULL);
INSERT INTO `barang` VALUES (50, 2, 'INV.BRG-002', 3, 'TANGKI (60 liter)', 'Tang', 9, 1, 49, 48000, '60 Liter', NULL, 'ZANUL HARIR', '2021-11-01 01:53:33', '2021-11-01 01:53:33', NULL);
INSERT INTO `barang` VALUES (51, 3, 'INV.BRG-003', 4, 'POMPA MESIN', 'PMPA', 8, 1, 25, 50000, 'PZ 74/20/4', NULL, 'ZANUL HARIR', '2021-11-01 01:58:48', '2021-11-01 01:58:48', NULL);
INSERT INTO `barang` VALUES (52, 4, 'INV.BRG-004', 4, 'POMPA MESIN', 'POMPA', 8, 1, 8, 50000, 'PZ 74/20/3', NULL, 'ZANUL HARIR', '2021-11-01 01:59:36', '2021-11-01 01:59:36', NULL);

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
  `tgl` date NULL DEFAULT NULL,
  `proyek_id` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 496 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detail_barang_keluar
-- ----------------------------
INSERT INTO `detail_barang_keluar` VALUES (486, '001/INV.BRG.KLR/III/2022', 49, 2, 'Bima', 18, '2022-03-15', NULL, '2022-03-31 01:07:02', '2022-03-31 01:07:02');
INSERT INTO `detail_barang_keluar` VALUES (487, '001/INV.BRG.KLR/III/2022', 52, 3, 'Bima', 9, '2022-03-15', NULL, '2022-03-31 01:07:02', '2022-03-31 01:07:02');
INSERT INTO `detail_barang_keluar` VALUES (490, '003/INV.BRG.KLR/V/2022', 52, 1, 'aasas', 8, '2022-05-16', NULL, '2022-05-12 00:47:35', '2022-05-12 00:47:35');
INSERT INTO `detail_barang_keluar` VALUES (494, '004/INV.BRG.KLR/V/2022', 50, 1, 'Gerung Mesanggok', 49, '2022-05-11', 1, '2022-05-12 02:32:24', '2022-05-12 02:32:24');
INSERT INTO `detail_barang_keluar` VALUES (495, '004/INV.BRG.KLR/V/2022', 49, 3, 'Gerung Mesanggok', 15, '2022-05-11', 1, '2022-05-12 02:32:24', '2022-05-12 02:32:24');

-- ----------------------------
-- Table structure for detail_log_pinjam
-- ----------------------------
DROP TABLE IF EXISTS `detail_log_pinjam`;
CREATE TABLE `detail_log_pinjam`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `peralatan_id` int(11) NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 0 COMMENT '1=sudah, 0=belum',
  `ket` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'kete pengembalian',
  `rusak` int(11) NULL DEFAULT 0,
  `proyek_id` int(11) NULL DEFAULT NULL COMMENT 'proyek id jika untuk proyek',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_log_pinjam
-- ----------------------------
INSERT INTO `detail_log_pinjam` VALUES (8, '001/LGSTK.PRLT.PJM/V/2022', 7, 2, 1, NULL, 0, NULL, '2022-05-11 01:44:57', '2022-05-11 07:35:11');
INSERT INTO `detail_log_pinjam` VALUES (9, '001/LGSTK.PRLT.PJM/V/2022', 8, 4, 1, NULL, 0, NULL, '2022-05-11 01:44:57', '2022-05-11 07:35:38');
INSERT INTO `detail_log_pinjam` VALUES (11, '002/LGSTK.PRLT.PJM/V/2022', 8, 2, 0, NULL, 0, 1, '2022-05-12 02:46:09', '2022-05-12 02:46:09');
INSERT INTO `detail_log_pinjam` VALUES (12, '002/LGSTK.PRLT.PJM/V/2022', 7, 5, 0, NULL, 0, 1, '2022-05-12 02:46:09', '2022-05-12 02:46:09');

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
-- Table structure for jam_kerja
-- ----------------------------
DROP TABLE IF EXISTS `jam_kerja`;
CREATE TABLE `jam_kerja`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari` tinyint(1) NOT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `masuk` time NOT NULL,
  `pulang` time NOT NULL,
  `toleransi_masuk` int(11) NULL DEFAULT NULL,
  `toleransi_pulang` int(11) NULL DEFAULT NULL,
  `jam_masuk` time NULL DEFAULT NULL,
  `jam_pulang` time NULL DEFAULT NULL,
  `user` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jam_kerja
-- ----------------------------
INSERT INTO `jam_kerja` VALUES (1, 0, 'Tidak', '08:00:00', '15:00:00', 10, 10, '08:10:00', '14:50:00', NULL, '2022-05-17 02:36:02', '2022-05-17 02:36:02');
INSERT INTO `jam_kerja` VALUES (2, 1, 'Ya', '09:00:00', '15:00:00', 10, 10, '09:10:00', '14:50:00', NULL, '2022-05-17 02:36:02', '2022-05-17 02:36:02');
INSERT INTO `jam_kerja` VALUES (3, 2, 'Ya', '08:00:00', '15:00:00', 10, 10, '08:10:00', '14:50:00', NULL, '2022-05-17 02:36:02', '2022-05-17 02:36:02');
INSERT INTO `jam_kerja` VALUES (4, 3, 'Ya', '08:00:00', '15:00:00', 10, 10, '08:10:00', '14:50:00', NULL, '2022-05-17 02:36:02', '2022-05-17 02:36:02');
INSERT INTO `jam_kerja` VALUES (5, 4, 'Ya', '08:00:00', '15:00:00', 10, 10, '08:10:00', '14:50:00', NULL, '2022-05-17 02:36:02', '2022-05-17 02:36:02');
INSERT INTO `jam_kerja` VALUES (6, 5, 'Ya', '08:00:00', '15:00:00', 10, 10, '08:10:00', '14:50:00', NULL, '2022-05-17 02:36:02', '2022-05-17 02:36:02');
INSERT INTO `jam_kerja` VALUES (7, 6, 'Tidak', '08:00:00', '15:00:00', 10, 10, '08:10:00', '14:50:00', NULL, '2022-05-17 02:36:02', '2022-05-17 02:36:02');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jenis_dokumen
-- ----------------------------
INSERT INTO `jenis_dokumen` VALUES (2, 2, 'SKT', 'Juru Ukur', '2022-05-03', '2022-05-03 12:34:51', '2022-05-03 12:34:51');

-- ----------------------------
-- Table structure for jenis_izin
-- ----------------------------
DROP TABLE IF EXISTS `jenis_izin`;
CREATE TABLE `jenis_izin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_izin
-- ----------------------------
INSERT INTO `jenis_izin` VALUES (2, 'Sakit', 'Tidak', '2022-04-18 01:34:59', '2022-04-18 01:34:59');
INSERT INTO `jenis_izin` VALUES (7, 'Cuti', 'Ya', '2022-05-19 15:15:25', '2022-05-19 15:15:25');

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
  `proyek_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 471 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of log_barang
-- ----------------------------
INSERT INTO `log_barang` VALUES (463, 1, '001/BM/RT/MESIN/2021', '1', NULL, 49, 2, 22, 'Zanul Harir', 'ket', 'ZANUL HARIR', '2021-11-01 02:11:05', '2021-11-01 02:11:05', '2021-11-01', NULL);
INSERT INTO `log_barang` VALUES (466, 1, '001/INV.BRG.KLR/III/2022', '0', 'Zanul', NULL, 3, 0, 'Zanul', 'Barang keluar', 'ZANUL HARIR', '2022-03-31 01:07:02', '2022-03-31 01:07:02', '2022-03-15', NULL);
INSERT INTO `log_barang` VALUES (468, 3, '003/INV.BRG.KLR/V/2022', '0', 'Zanul', NULL, 1, 0, 'Zanul', 'Barang keluar', 'ZANUL HARIR', '2022-05-12 00:47:35', '2022-05-12 00:47:35', '2022-05-16', NULL);
INSERT INTO `log_barang` VALUES (470, 4, '004/INV.BRG.KLR/V/2022', '0', 'Zanul edir', NULL, 3, 0, 'Zanul edir', 'Barang keluar', 'ZANUL HARIR', '2022-05-12 02:29:16', '2022-05-12 02:32:24', '2022-05-11', 1);

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
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'kode pengembalian jika dari peminjaman',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of log_peralatan
-- ----------------------------
INSERT INTO `log_peralatan` VALUES (2, 7, 3, 'ZANUL HARIR', 'rusak dipinjam nih', '2022-05-11', '2022-05-11 01:15:02', '2022-05-11 01:15:02', 0, NULL);
INSERT INTO `log_peralatan` VALUES (4, 7, 1, 'Zanul', 'tes lagi sekali', '2022-05-11', '2022-05-11 07:12:14', '2022-05-11 07:12:14', 0, '001/LGSTK.PRLT.PJM/V/2022');
INSERT INTO `log_peralatan` VALUES (5, 7, 1, 'Zanul', NULL, '2022-05-11', '2022-05-11 07:28:59', '2022-05-11 07:28:59', 0, '001/LGSTK.PRLT.PJM/V/2022');
INSERT INTO `log_peralatan` VALUES (6, 7, 1, 'Zanul', NULL, '2022-05-11', '2022-05-11 07:29:18', '2022-05-11 07:29:18', 0, '001/LGSTK.PRLT.PJM/V/2022');
INSERT INTO `log_peralatan` VALUES (7, 8, 2, 'Zanul', NULL, '2022-05-11', '2022-05-11 07:29:22', '2022-05-11 07:29:22', 0, '001/LGSTK.PRLT.PJM/V/2022');

-- ----------------------------
-- Table structure for log_pinjam
-- ----------------------------
DROP TABLE IF EXISTS `log_pinjam`;
CREATE TABLE `log_pinjam`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` int(11) NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pj` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 0 COMMENT '1 = sudah dikembalikan, 0 = masih pinjam',
  `lokasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_batas` date NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `proyek_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_pinjam
-- ----------------------------
INSERT INTO `log_pinjam` VALUES (3, 1, '001/LGSTK.PRLT.PJM/V/2022', 'Zanul', 1, 'Gerung', '2022-05-25', '2022-05-11 01:17:23', '2022-05-11 07:35:38', NULL);
INSERT INTO `log_pinjam` VALUES (4, 2, '002/LGSTK.PRLT.PJM/V/2022', 'Zanul edir', 0, 'Gerung Mesanggok', '2022-05-12', '2022-05-12 02:44:30', '2022-05-12 02:46:09', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 87 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `menus` VALUES (74, 'mn7', 'Proyek', 1, '-', '-', 'fa-building', NULL, NULL);
INSERT INTO `menus` VALUES (75, 'mn71', 'Data Proyek', 0, 'mn7', '/proyek', '-', NULL, NULL);
INSERT INTO `menus` VALUES (76, 'mn52', 'Peminjaman', 0, 'mn5', '/pinjam', '-', NULL, NULL);
INSERT INTO `menus` VALUES (77, 'mn8', 'Absen', 1, '-', '-', 'fa-clock', NULL, NULL);
INSERT INTO `menus` VALUES (78, 'mn81', 'Jam Kerja', 0, 'mn8', '/jam-kerja', '-', NULL, NULL);
INSERT INTO `menus` VALUES (79, 'mn82', 'Jenis Izin', 0, 'mn8', '/jenis-izin', '-', NULL, NULL);
INSERT INTO `menus` VALUES (80, 'mn83', 'Tanggal Libur', 0, 'mn8', '/libur', '-', NULL, NULL);
INSERT INTO `menus` VALUES (81, 'mn84', 'Kehadiran', 0, 'mn8', '/kehadiran', '-', NULL, NULL);
INSERT INTO `menus` VALUES (82, 'mn85', 'Tidak Hadir', 0, 'mn8', '/tidak_hadir', '-', NULL, NULL);
INSERT INTO `menus` VALUES (83, 'mn86', 'Posting Absen', 0, 'mn9', '/posting', '-', NULL, NULL);
INSERT INTO `menus` VALUES (84, 'mn9', 'Laporan Absen', 1, '-', '-', 'fa-print', NULL, NULL);
INSERT INTO `menus` VALUES (85, 'mn91', 'Rekap Absensi', 0, 'mn9', '/rekap', '-', NULL, NULL);
INSERT INTO `menus` VALUES (86, 'mn92', 'Rincian Absen', 0, 'mn9', '/rincian', '-', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
INSERT INTO `pegawai` VALUES (2, 1, 'PEG-001', 1, 'Arki Dikania Wisnu', '3232', 'Jln. Bukit Batulayar No 14A', '08192252', '111', '2022-04-04 03:26:02', '2022-04-04 03:26:02');
INSERT INTO `pegawai` VALUES (3, 2, 'PEG-002', 1, 'Zanul Harir', '3232ddsds', 'Jln. Bukit Batulayar No 14A', '081939477455', '1111', '2022-05-19 14:48:30', '2022-05-19 14:48:30');

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
  `stok_aktif` int(11) NULL DEFAULT NULL,
  `rusak` int(11) NULL DEFAULT 0,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `lokasi_id` int(11) NULL DEFAULT NULL,
  `user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of peralatan
-- ----------------------------
INSERT INTO `peralatan` VALUES (7, 1, 'LGSTK.PRLT-001', 'Tang', 3, 'Sidu edit', 9, 25000, 'fgfgfg', 20, 20, 12, 3, NULL, 1, 'ZANUL HARIR', '2022-05-10 01:35:34', '2022-05-11 07:35:11');
INSERT INTO `peralatan` VALUES (8, 2, 'LGSTK.PRLT-002', 'Mesin Bor', 3, 'Sidu edit', 9, 50000, 'Kapasitas 1000 Liter', 12, 12, 10, 0, NULL, 1, 'ZANUL HARIR', '2022-05-11 01:44:44', '2022-05-11 07:35:38');

-- ----------------------------
-- Table structure for posting_absen
-- ----------------------------
DROP TABLE IF EXISTS `posting_absen`;
CREATE TABLE `posting_absen`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) NULL DEFAULT NULL,
  `tgl` date NULL DEFAULT NULL,
  `hari` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jam_masuk` time NULL DEFAULT NULL,
  `jam_pulang` time NULL DEFAULT NULL,
  `absen_masuk` time NULL DEFAULT NULL,
  `absen_pulang` time NULL DEFAULT NULL,
  `tidak_masuk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'keterangan tidak masuk',
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_masuk` tinyint(4) NULL DEFAULT NULL COMMENT '1=masuk, 0=libur, 2=izin, 3=tanpa keterangan',
  `telat` tinyint(255) NULL DEFAULT NULL,
  `pulang_cepat` tinyint(4) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 116 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of posting_absen
-- ----------------------------
INSERT INTO `posting_absen` VALUES (78, 2, '2022-05-01', 'Minggu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Minggu', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (79, 3, '2022-05-01', 'Minggu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Minggu', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (80, 2, '2022-05-02', 'Senin', '09:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (81, 3, '2022-05-02', 'Senin', '09:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (82, 2, '2022-05-03', 'Selasa', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (83, 3, '2022-05-03', 'Selasa', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (84, 2, '2022-05-04', 'Rabu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (85, 3, '2022-05-04', 'Rabu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (86, 2, '2022-05-05', 'Kamis', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (87, 3, '2022-05-05', 'Kamis', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (88, 2, '2022-05-06', 'Jumat', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (89, 3, '2022-05-06', 'Jumat', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Cuti Lebaran', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (90, 2, '2022-05-07', 'Sabtu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Sabtu', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (91, 3, '2022-05-07', 'Sabtu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Sabtu', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (92, 2, '2022-05-08', 'Minggu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Minggu', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (93, 3, '2022-05-08', 'Minggu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Minggu', 0, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (94, 2, '2022-05-09', 'Senin', '09:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (95, 3, '2022-05-09', 'Senin', '09:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (96, 2, '2022-05-10', 'Selasa', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:46', '2022-05-19 15:15:46');
INSERT INTO `posting_absen` VALUES (97, 3, '2022-05-10', 'Selasa', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (98, 2, '2022-05-11', 'Rabu', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (99, 3, '2022-05-11', 'Rabu', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (100, 2, '2022-05-12', 'Kamis', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (101, 3, '2022-05-12', 'Kamis', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (102, 2, '2022-05-13', 'Jumat', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (103, 3, '2022-05-13', 'Jumat', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (104, 2, '2022-05-14', 'Sabtu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Sabtu', 0, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (105, 3, '2022-05-14', 'Sabtu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Sabtu', 0, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (106, 2, '2022-05-15', 'Minggu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Minggu', 0, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (107, 3, '2022-05-15', 'Minggu', '08:10:00', '14:50:00', NULL, NULL, 'Hari Libur', 'Minggu', 0, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (108, 2, '2022-05-16', 'Senin', '09:10:00', '14:50:00', '11:06:00', '16:07:00', NULL, NULL, 1, 1, 0, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (109, 3, '2022-05-16', 'Senin', '09:10:00', '14:50:00', '07:48:00', NULL, NULL, NULL, 1, 0, 1, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (110, 2, '2022-05-17', 'Selasa', '08:10:00', '14:50:00', '11:11:44', '16:08:00', NULL, NULL, 1, 1, 0, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (111, 3, '2022-05-17', 'Selasa', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (112, 2, '2022-05-18', 'Rabu', '08:10:00', '14:50:00', NULL, NULL, 'Tidak Absen', 'Tanpa Keterangan', 3, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (113, 3, '2022-05-18', 'Rabu', '08:10:00', '14:50:00', '08:10:00', '14:50:00', 'Cuti', 'cuti', 1, NULL, NULL, '2022-05-19 15:15:47', '2022-05-19 15:15:47');
INSERT INTO `posting_absen` VALUES (114, 2, '2022-05-19', 'Kamis', '08:10:00', '14:50:00', NULL, NULL, 'Sakit', 'koorona', 2, NULL, NULL, '2022-05-19 15:15:48', '2022-05-19 15:15:48');
INSERT INTO `posting_absen` VALUES (115, 3, '2022-05-19', 'Kamis', '08:10:00', '14:50:00', '08:10:00', '14:50:00', 'Cuti', 'cuti', 1, NULL, NULL, '2022-05-19 15:15:48', '2022-05-19 15:15:48');

-- ----------------------------
-- Table structure for proyek
-- ----------------------------
DROP TABLE IF EXISTS `proyek`;
CREATE TABLE `proyek`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pj` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proyek
-- ----------------------------
INSERT INTO `proyek` VALUES (1, 'Pembangunan RUmah Zanul', 'Zanul edir', 'Gerung Mesanggok', 'Keterangan ni yeeeee', '2022-05-10 00:26:10', '2022-05-10 00:31:43');

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
-- Table structure for tanggal_libur
-- ----------------------------
DROP TABLE IF EXISTS `tanggal_libur`;
CREATE TABLE `tanggal_libur`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_mulai` date NULL DEFAULT NULL,
  `tgl_akhir` date NULL DEFAULT NULL,
  `ket` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tanggal_libur
-- ----------------------------
INSERT INTO `tanggal_libur` VALUES (2, '2022-05-02', '2022-05-06', 'Cuti Lebaran', '2022-04-18 05:41:11', '2022-04-18 05:41:11');

-- ----------------------------
-- Table structure for tidak_masuk
-- ----------------------------
DROP TABLE IF EXISTS `tidak_masuk`;
CREATE TABLE `tidak_masuk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) NULL DEFAULT NULL,
  `tgl_mulai` date NULL DEFAULT NULL,
  `tgl_akhir` date NULL DEFAULT NULL,
  `jenis_id` int(11) NULL DEFAULT NULL,
  `ket` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tidak_masuk
-- ----------------------------
INSERT INTO `tidak_masuk` VALUES (3, 2, '2022-05-19', '2022-05-20', 2, 'koorona', '2022-05-19 11:25:12', '2022-05-19 11:25:12');
INSERT INTO `tidak_masuk` VALUES (4, 3, '2022-05-18', '2022-05-19', 7, 'cuti', '2022-05-19 15:15:42', '2022-05-19 15:15:42');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'ZANUL HARIR', 'admin', '$2y$10$Lvlc.BBM.9I70HC4S9CVbeCZPOD4QqYlOdeHuD.rPe/ysyi4REAbe', 'mesanggok', 'admin@gmail.com', 1, 1, NULL, '2020-10-16 06:44:26', '2021-11-01 01:20:19');

SET FOREIGN_KEY_CHECKS = 1;
