/*
 Navicat Premium Data Transfer

 Source Server         : LOCALE
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : darya-varia-test

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 12/09/2023 14:46:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for master_agama
-- ----------------------------
DROP TABLE IF EXISTS `master_agama`;
CREATE TABLE `master_agama`  (
  `agm_code` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `agm_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`agm_code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_agama
-- ----------------------------
INSERT INTO `master_agama` VALUES (001, 'Islam');
INSERT INTO `master_agama` VALUES (002, 'Kristen');

-- ----------------------------
-- Table structure for master_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `master_jabatan`;
CREATE TABLE `master_jabatan`  (
  `jbt_kode` int NOT NULL,
  `jbt_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`jbt_kode`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_jabatan
-- ----------------------------
INSERT INTO `master_jabatan` VALUES (1, 'HRIS SPV');
INSERT INTO `master_jabatan` VALUES (2, 'TR STAFF');

-- ----------------------------
-- Table structure for table_keluarga
-- ----------------------------
DROP TABLE IF EXISTS `table_keluarga`;
CREATE TABLE `table_keluarga`  (
  `kl_id` int NOT NULL AUTO_INCREMENT,
  `pgw_id` int NULL DEFAULT NULL,
  `kl_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kl_hub` enum('Ayah','Ibu','Adik','Kakak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kl_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_keluarga
-- ----------------------------
INSERT INTO `table_keluarga` VALUES (1, 1, 'Sumanto12', 'Ayah');
INSERT INTO `table_keluarga` VALUES (2, 1, 'BBB', 'Ibu');
INSERT INTO `table_keluarga` VALUES (4, 1, 'ass', 'Ibu');
INSERT INTO `table_keluarga` VALUES (5, 1, 'aaa', 'Ayah');
INSERT INTO `table_keluarga` VALUES (7, 2, 'zzzz111', 'Ibu');

-- ----------------------------
-- Table structure for table_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `table_pegawai`;
CREATE TABLE `table_pegawai`  (
  `pgw_id` int NOT NULL AUTO_INCREMENT,
  `pgw_nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pgw_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pgw_register` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `pgw_jabatan` int NOT NULL,
  `pgw_agama` int(3) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (`pgw_id`) USING BTREE,
  INDEX `agama_frgn`(`pgw_agama`) USING BTREE,
  INDEX `jabatan_frgn`(`pgw_jabatan`) USING BTREE,
  CONSTRAINT `agama_frgn` FOREIGN KEY (`pgw_agama`) REFERENCES `master_agama` (`agm_code`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `jabatan_frgn` FOREIGN KEY (`pgw_jabatan`) REFERENCES `master_jabatan` (`jbt_kode`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_pegawai
-- ----------------------------
INSERT INTO `table_pegawai` VALUES (1, 'ID0011', 'Sukma Indah', '2023-09-12 11:13:43', 1, 001);
INSERT INTO `table_pegawai` VALUES (2, 'ID002', 'Epita', '2023-09-12 11:13:45', 2, 002);

SET FOREIGN_KEY_CHECKS = 1;
