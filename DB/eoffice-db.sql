/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : theyangeoffice

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-06-17 08:20:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for agency
-- ----------------------------
DROP TABLE IF EXISTS `agency`;
CREATE TABLE `agency` (
  `agency_id_pri` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agency_id` varchar(20) DEFAULT NULL,
  `agency_name` varchar(255) DEFAULT NULL,
  `agency_name_short` varchar(100) DEFAULT NULL,
  `agency_description` varchar(255) DEFAULT NULL,
  `agency_tel` varchar(50) DEFAULT NULL,
  `agency_email` varchar(100) DEFAULT NULL,
  `dep_status_id` int(11) NOT NULL,
  `agency_create` datetime DEFAULT NULL,
  `agency_update` datetime DEFAULT NULL,
  PRIMARY KEY (`agency_id_pri`),
  KEY `fk_department_ref_department_status1_idx` (`dep_status_id`),
  CONSTRAINT `fk_department_ref_department_status10` FOREIGN KEY (`dep_status_id`) REFERENCES `ref_department_status` (`dep_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='หน่วยงานภายนอก';

-- ----------------------------
-- Records of agency
-- ----------------------------

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `dep_id_pri` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dep_id` varchar(20) DEFAULT NULL,
  `dep_name` varchar(255) DEFAULT NULL,
  `dep_name_short` varchar(100) DEFAULT NULL,
  `dep_description` varchar(255) DEFAULT NULL,
  `dep_tel` varchar(50) DEFAULT NULL,
  `dep_prefix_within` varchar(50) DEFAULT NULL,
  `dep_prefix_without` varchar(50) DEFAULT NULL,
  `dep_without_active_id` tinyint(4) DEFAULT '0' COMMENT '0 = ไมให้ส่งออก ,1 = ให้ส่งออก',
  `org_id_pri` int(10) unsigned NOT NULL,
  `place_id` int(10) unsigned NOT NULL,
  `dep_status_id` int(11) NOT NULL,
  `dep_create` datetime DEFAULT NULL,
  `dep_update` datetime DEFAULT NULL,
  PRIMARY KEY (`dep_id_pri`),
  KEY `fk_department_organization1_idx` (`org_id_pri`),
  KEY `fk_department_place1_idx` (`place_id`),
  KEY `fk_department_ref_department_status1_idx` (`dep_status_id`),
  CONSTRAINT `fk_department_organization1` FOREIGN KEY (`org_id_pri`) REFERENCES `organization` (`org_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_department_place1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_department_ref_department_status1` FOREIGN KEY (`dep_status_id`) REFERENCES `ref_department_status` (`dep_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='หน่วยงาน';

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('1', '00', 'สารบรรณกลาง', '-', '-', '-', 'ชม500/', 'ชม500/', '1', '1', '1', '1', '2021-06-16 13:06:54', '2021-06-16 13:06:54');

-- ----------------------------
-- Table structure for department_year
-- ----------------------------
DROP TABLE IF EXISTS `department_year`;
CREATE TABLE `department_year` (
  `dep_year_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dep_id_pri` int(10) unsigned NOT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `year` varchar(10) DEFAULT NULL,
  `dep_year_number_last` int(11) DEFAULT '1' COMMENT 'เลขที่เอกสาร ถัดไป',
  `dep_year_receive_last` int(11) DEFAULT '1' COMMENT 'เลขทะเบียนรับ ถัดไป',
  `dep_year_send_last` int(11) DEFAULT '1' COMMENT 'เลขทะเบียนส่ง ถัดไป',
  `dep_year_send_out_last` int(11) DEFAULT '1',
  `dep_year_send_command_last` int(11) DEFAULT '1',
  `dep_year_send_publish_last` int(11) DEFAULT '1',
  `dep_year_create` datetime DEFAULT NULL,
  `dep_year_update` datetime DEFAULT NULL,
  PRIMARY KEY (`dep_year_id`),
  KEY `fk_department_year_department1_idx` (`dep_id_pri`),
  KEY `fk_department_year_year1_idx` (`year_id`),
  CONSTRAINT `fk_department_year_department1` FOREIGN KEY (`dep_id_pri`) REFERENCES `department` (`dep_id_pri`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_department_year_year1` FOREIGN KEY (`year_id`) REFERENCES `year` (`year_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of department_year
-- ----------------------------
INSERT INTO `department_year` VALUES ('1', '1', '1', '2564', '22', '19', '22', '8', '11', '10', '2021-04-26 13:59:01', '2021-06-09 14:43:25');
INSERT INTO `department_year` VALUES ('33', '1', '2', '2565', '1', '1', '1', '1', '1', '1', '2021-05-21 16:02:16', '2021-05-21 16:02:16');

-- ----------------------------
-- Table structure for dep_off
-- ----------------------------
DROP TABLE IF EXISTS `dep_off`;
CREATE TABLE `dep_off` (
  `dep_off_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dep_id_pri` int(10) unsigned NOT NULL,
  `officer_id` int(10) unsigned NOT NULL,
  `dep_off_status_id` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`dep_off_id`),
  KEY `fk_dep_off_department1_idx` (`dep_id_pri`),
  KEY `fk_dep_off_officer1_idx` (`officer_id`),
  CONSTRAINT `fk_dep_off_department1` FOREIGN KEY (`dep_id_pri`) REFERENCES `department` (`dep_id_pri`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dep_off
-- ----------------------------
INSERT INTO `dep_off` VALUES ('1', '1', '20', '1');

-- ----------------------------
-- Table structure for eoffice_session
-- ----------------------------
DROP TABLE IF EXISTS `eoffice_session`;
CREATE TABLE `eoffice_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of eoffice_session
-- ----------------------------
INSERT INTO `eoffice_session` VALUES ('kjipf5qf5u9lssn7tikfruvfvfbl36gc', '::1', '1623836364', 0x5F5F63695F6C6173745F726567656E65726174657C693A313632333833363333313B6C6F67696E5F746F6B656E7C693A3936383333313B69736C6F67696E7C693A313B757365725F69647C733A313A2231223B757365725F6465705F6F66665F69647C733A313A2237223B6465705F6F66665F69647C733A313A2231223B6465705F69645F7072697C733A313A2231223B726F6C655F69647C733A313A2235223B796561725F69647C733A313A2231223B796561727C733A343A2232353634223B726567656E65726174655F6C6F67696E7C693A3933383830363B);

-- ----------------------------
-- Table structure for groupdep
-- ----------------------------
DROP TABLE IF EXISTS `groupdep`;
CREATE TABLE `groupdep` (
  `groupdep_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupdep_name` varchar(255) DEFAULT NULL,
  `dep_id_pri` int(10) unsigned NOT NULL,
  `groupdep_status_id` tinyint(4) DEFAULT NULL,
  `groupdep_modify` datetime DEFAULT NULL,
  PRIMARY KEY (`groupdep_id`),
  KEY `fk_groupdep_department1_idx` (`dep_id_pri`),
  CONSTRAINT `fk_groupdep_department1` FOREIGN KEY (`dep_id_pri`) REFERENCES `department` (`dep_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groupdep
-- ----------------------------

-- ----------------------------
-- Table structure for groupdep_process
-- ----------------------------
DROP TABLE IF EXISTS `groupdep_process`;
CREATE TABLE `groupdep_process` (
  `groupdep_process_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupdep_id` int(10) unsigned NOT NULL,
  `dep_off_id` int(10) unsigned NOT NULL,
  `groupdep_process_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupdep_process_id`),
  KEY `fk_groupdep_process_dep_off1_idx` (`dep_off_id`),
  KEY `fk_groupdep_process_groupdep1_idx` (`groupdep_id`),
  CONSTRAINT `fk_groupdep_process_dep_off1` FOREIGN KEY (`dep_off_id`) REFERENCES `dep_off` (`dep_off_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_groupdep_process_groupdep1` FOREIGN KEY (`groupdep_id`) REFERENCES `groupdep` (`groupdep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groupdep_process
-- ----------------------------

-- ----------------------------
-- Table structure for group_menu
-- ----------------------------
DROP TABLE IF EXISTS `group_menu`;
CREATE TABLE `group_menu` (
  `group_menu_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `group_menu_name` varchar(100) DEFAULT NULL,
  `group_menu_icon` varchar(50) DEFAULT NULL,
  `group_menu_sort` tinyint(3) unsigned DEFAULT NULL,
  `group_menu_update` datetime DEFAULT NULL,
  PRIMARY KEY (`group_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group_menu
-- ----------------------------
INSERT INTO `group_menu` VALUES ('1', 'หนังสือส่งภายใน', 'fa fa-telegram', '3', '2018-10-12 11:21:57');
INSERT INTO `group_menu` VALUES ('3', 'หนังสือส่ง/คำสั่ง/ประกาศ', 'fa fa-paper-plane-o', '4', '2021-05-20 10:28:08');
INSERT INTO `group_menu` VALUES ('5', 'รายงานข้อมูล', 'fa fa-bar-chart ', '12', '2018-10-12 11:25:24');
INSERT INTO `group_menu` VALUES ('7', 'ตั้งค่าหน่วยงาน', 'fa fa-cog', '13', '2018-05-31 11:05:54');
INSERT INTO `group_menu` VALUES ('8', 'ควบคุมระบบ', 'fa fa-cog', '14', '2021-03-17 12:11:26');
INSERT INTO `group_menu` VALUES ('9', 'ประวัติการใช้งาน', 'fa fa-navicon', '16', '2018-05-31 11:05:54');
INSERT INTO `group_menu` VALUES ('10', 'หนังสือรับ(ภายนอก/ภายใน)', 'fa fa-envelope-open-o', '6', '2021-03-01 10:56:34');
INSERT INTO `group_menu` VALUES ('11', 'ข้อมูลอ้างอิงระบบ', 'fa fa-table', '15', '2019-02-06 12:06:36');
INSERT INTO `group_menu` VALUES ('12', 'บุคลากรในสังกัด', 'fa fa-user', '1', '2021-02-10 10:14:51');
INSERT INTO `group_menu` VALUES ('13', 'รายการมอบหมายงาน', 'fa fa-user-circle', '2', '2021-05-21 15:23:04');
INSERT INTO `group_menu` VALUES ('15', 'ลงรับหนังสือ(ภายใน)', 'fa fa-envelope', '5', '2021-03-01 10:56:52');
INSERT INTO `group_menu` VALUES ('17', 'ประกาศแจ้งเตือนผ่าน Line', 'fa fa-bell', '11', '2019-06-12 10:37:05');
INSERT INTO `group_menu` VALUES ('22', 'ตรวจลายเซ็นต์', 'fa fa-search', '10', '2021-03-17 14:07:38');
INSERT INTO `group_menu` VALUES ('23', 'หนังสือย้อนหลัง', 'fa fa-history', '9', '2021-04-20 10:33:33');

-- ----------------------------
-- Table structure for log_check_signature
-- ----------------------------
DROP TABLE IF EXISTS `log_check_signature`;
CREATE TABLE `log_check_signature` (
  `log_check_signature_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `signature_key` varchar(255) DEFAULT NULL,
  `check_text` varchar(255) DEFAULT NULL,
  `log_check_signature_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_check_signature_id`),
  KEY `fk_signature_user1_idx` (`user_id`) USING BTREE,
  CONSTRAINT `log_check_signature_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_check_signature
-- ----------------------------

-- ----------------------------
-- Table structure for log_file
-- ----------------------------
DROP TABLE IF EXISTS `log_file`;
CREATE TABLE `log_file` (
  `log_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `log_type_id` tinyint(4) DEFAULT NULL COMMENT '1 info 2 process 3 user',
  `work_info_file_id` bigint(20) unsigned DEFAULT NULL,
  `work_process_file_id` bigint(20) unsigned DEFAULT NULL,
  `work_user_file_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `log_text` text,
  `log_status_id` tinyint(4) DEFAULT NULL COMMENT '1 สร้าง 2 ลบ 3 เปิด',
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_log_file_user1_idx` (`user_id`),
  CONSTRAINT `fk_log_file_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_file
-- ----------------------------

-- ----------------------------
-- Table structure for log_news
-- ----------------------------
DROP TABLE IF EXISTS `log_news`;
CREATE TABLE `log_news` (
  `log_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `work_info_id_pri` bigint(20) unsigned DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_log_news_user1_idx` (`user_id`),
  KEY `fk_log_news_work_info1_idx` (`work_info_id_pri`),
  CONSTRAINT `fk_log_news_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_news_work_info1` FOREIGN KEY (`work_info_id_pri`) REFERENCES `work_info` (`work_info_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_news
-- ----------------------------

-- ----------------------------
-- Table structure for log_send_line
-- ----------------------------
DROP TABLE IF EXISTS `log_send_line`;
CREATE TABLE `log_send_line` (
  `log_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `log_text` text,
  `log_line_token` varchar(255) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_log_send_line_user1_idx` (`user_id`),
  CONSTRAINT `fk_log_send_line_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_send_line
-- ----------------------------

-- ----------------------------
-- Table structure for log_user
-- ----------------------------
DROP TABLE IF EXISTS `log_user`;
CREATE TABLE `log_user` (
  `log_user` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `log_text` varchar(45) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_citizen` varchar(20) DEFAULT NULL,
  `user_fullname` varchar(100) DEFAULT NULL,
  `user_address` text,
  `user_tel` varchar(20) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT 'none.png',
  `role_id` tinyint(3) unsigned DEFAULT NULL,
  `user_style` varchar(20) DEFAULT 'blue' COMMENT 'ใช้สำหรับเก็บชื่อไฟล์ CSS สำหรับสีทีม',
  `user_status_id` tinyint(4) DEFAULT NULL,
  `user_activate` tinyint(4) DEFAULT '1',
  `user_activate_code` varchar(255) DEFAULT NULL,
  `user_line_token` varchar(100) DEFAULT NULL,
  `user_signature_path` varchar(255) DEFAULT 'none.png',
  `public_key` varchar(255) DEFAULT NULL,
  `private_key` varchar(255) DEFAULT NULL,
  `pin_key` varchar(255) DEFAULT NULL,
  `log_ip_address` varchar(255) DEFAULT NULL,
  `log_browser` varchar(255) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_user`),
  KEY `fk_log_user_role1_idx` (`role_id`) USING BTREE,
  KEY `fk_log_user_ref_user_status1_idx` (`user_status_id`) USING BTREE,
  CONSTRAINT `log_user_ibfk_1` FOREIGN KEY (`user_status_id`) REFERENCES `ref_user_status` (`user_status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `log_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_user
-- ----------------------------

-- ----------------------------
-- Table structure for log_user_login
-- ----------------------------
DROP TABLE IF EXISTS `log_user_login`;
CREATE TABLE `log_user_login` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `log_text` varchar(255) DEFAULT NULL,
  `log_ip_address` varchar(255) DEFAULT NULL,
  `log_browser` varchar(255) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_log_user_login_user1_idx` (`user_id`),
  CONSTRAINT `fk_log_user_login_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_user_login
-- ----------------------------
INSERT INTO `log_user_login` VALUES ('1', '1', 'Login', '::1', 'Chrome/91.0.4472.106 Windows 10 ', '2021-06-16 16:33:16');
INSERT INTO `log_user_login` VALUES ('2', '1', 'Login', '::1', 'Chrome/91.0.4472.106 Windows 10 ', '2021-06-16 16:38:55');

-- ----------------------------
-- Table structure for log_work_info
-- ----------------------------
DROP TABLE IF EXISTS `log_work_info`;
CREATE TABLE `log_work_info` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `work_info_id_pri` bigint(20) unsigned DEFAULT NULL,
  `log_text` text,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_log_user_login_user1_idx` (`user_id`),
  KEY `fk_log_work_info_work_info1_idx` (`work_info_id_pri`),
  CONSTRAINT `fk_log_user_login_user100` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_log_work_info_work_info1` FOREIGN KEY (`work_info_id_pri`) REFERENCES `work_info` (`work_info_id_pri`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_work_info
-- ----------------------------

-- ----------------------------
-- Table structure for log_work_info_edit
-- ----------------------------
DROP TABLE IF EXISTS `log_work_info_edit`;
CREATE TABLE `log_work_info_edit` (
  `log_work_info_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_info_id_pri` bigint(20) unsigned DEFAULT NULL,
  `work_info_code` varchar(50) DEFAULT NULL,
  `work_info_id` int(11) DEFAULT NULL COMMENT 'เลขทะเบียนส่ง',
  `work_info_no` varchar(50) DEFAULT NULL COMMENT 'เลขที่เอกสาร',
  `work_info_no_2` varchar(50) DEFAULT NULL,
  `work_info_no_3` int(11) DEFAULT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `work_type_id` int(11) NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'ผู้สร้าง+ส่ง',
  `dep_id_pri` int(10) unsigned DEFAULT NULL COMMENT 'หน่วยงานที่ส่ง',
  `dep_off_id` int(10) unsigned DEFAULT NULL COMMENT 'ตำแหน่งที่ส่ง',
  `work_info_date` date DEFAULT NULL COMMENT 'ลงวันที่',
  `work_info_from_position` varchar(255) DEFAULT NULL,
  `work_info_from` varchar(255) DEFAULT NULL COMMENT 'จาก',
  `work_info_to_position` varchar(255) DEFAULT NULL,
  `work_info_to` varchar(255) DEFAULT NULL COMMENT 'ถึง',
  `work_info_subject` varchar(255) DEFAULT NULL COMMENT 'เรื่อง',
  `work_info_detail` longtext COMMENT 'รายละเอียด',
  `work_info_comment` text,
  `work_info_refer` varchar(255) DEFAULT NULL COMMENT 'อ้างถึง',
  `work_info_other_attach` varchar(255) DEFAULT NULL COMMENT 'สิ่งที่ส่งมาด้วย',
  `work_info_complete` datetime DEFAULT NULL COMMENT 'กำหนดวันให้ดำเนินการแล้วเสร็จ',
  `work_info_expire` datetime DEFAULT NULL COMMENT 'กำหนดวันหมดอายุ',
  `work_info_follow` tinyint(4) DEFAULT '0' COMMENT 'ติดตามผลการทำงาน',
  `work_info_store` varchar(255) DEFAULT NULL,
  `secret_level_id` int(10) unsigned NOT NULL DEFAULT '1',
  `priority_info_id` int(11) NOT NULL DEFAULT '1',
  `action_info_id` int(10) unsigned NOT NULL DEFAULT '1',
  `state_info_id` int(11) NOT NULL DEFAULT '1',
  `doc_type_id` int(10) unsigned DEFAULT '1',
  `book_group_id` int(10) unsigned NOT NULL DEFAULT '1',
  `internal_action_id` int(11) DEFAULT NULL,
  `internal_action_name` varchar(255) DEFAULT NULL,
  `attach_original` int(11) DEFAULT '0' COMMENT '0 =ไม่ส่งต้นฉบับ , 1 = พร้อมส่งต้นฉบับ',
  `work_info_signature` text,
  `log_user_id` int(10) DEFAULT NULL,
  `log_text` varchar(255) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  PRIMARY KEY (`log_work_info_id`),
  KEY `fk_work_info_id_pri_work` (`work_info_id_pri`),
  CONSTRAINT `fk_work_info_id_pri_work` FOREIGN KEY (`work_info_id_pri`) REFERENCES `work_info` (`work_info_id_pri`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_work_info_edit
-- ----------------------------

-- ----------------------------
-- Table structure for log_work_process
-- ----------------------------
DROP TABLE IF EXISTS `log_work_process`;
CREATE TABLE `log_work_process` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `work_process_id_pri` bigint(20) unsigned DEFAULT NULL,
  `log_text` text,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_log_user_login_user1_idx` (`user_id`),
  KEY `fk_log_work_process_work_process1_idx` (`work_process_id_pri`),
  CONSTRAINT `fk_log_user_login_user1000` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_log_work_process_work_process1` FOREIGN KEY (`work_process_id_pri`) REFERENCES `work_process` (`work_process_id_pri`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_work_process
-- ----------------------------

-- ----------------------------
-- Table structure for log_work_user
-- ----------------------------
DROP TABLE IF EXISTS `log_work_user`;
CREATE TABLE `log_work_user` (
  `log_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `work_user_id` bigint(20) unsigned DEFAULT NULL,
  `log_text` text,
  `log_time` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_log_work_user_work_user1_idx` (`work_user_id`),
  KEY `fk_log_work_user_user1_idx` (`user_id`),
  CONSTRAINT `fk_log_work_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_work_user_work_user1` FOREIGN KEY (`work_user_id`) REFERENCES `work_user` (`work_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_work_user
-- ----------------------------

-- ----------------------------
-- Table structure for map_menu_role
-- ----------------------------
DROP TABLE IF EXISTS `map_menu_role`;
CREATE TABLE `map_menu_role` (
  `map_role_menu_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `role_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`map_role_menu_id`),
  KEY `fk_map_role_menu_menu1_idx` (`menu_id`),
  KEY `fk_map_role_menu_role1_idx` (`role_id`),
  CONSTRAINT `fk_map_role_menu_menu1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_map_role_menu_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=613 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of map_menu_role
-- ----------------------------
INSERT INTO `map_menu_role` VALUES ('99', '42', '2');
INSERT INTO `map_menu_role` VALUES ('100', '35', '2');
INSERT INTO `map_menu_role` VALUES ('101', '1', '2');
INSERT INTO `map_menu_role` VALUES ('102', '2', '2');
INSERT INTO `map_menu_role` VALUES ('103', '36', '2');
INSERT INTO `map_menu_role` VALUES ('104', '3', '2');
INSERT INTO `map_menu_role` VALUES ('105', '6', '2');
INSERT INTO `map_menu_role` VALUES ('106', '9', '2');
INSERT INTO `map_menu_role` VALUES ('107', '38', '2');
INSERT INTO `map_menu_role` VALUES ('108', '39', '2');
INSERT INTO `map_menu_role` VALUES ('109', '10', '2');
INSERT INTO `map_menu_role` VALUES ('112', '13', '2');
INSERT INTO `map_menu_role` VALUES ('262', '34', '5');
INSERT INTO `map_menu_role` VALUES ('263', '33', '5');
INSERT INTO `map_menu_role` VALUES ('264', '32', '5');
INSERT INTO `map_menu_role` VALUES ('265', '31', '5');
INSERT INTO `map_menu_role` VALUES ('266', '30', '5');
INSERT INTO `map_menu_role` VALUES ('267', '29', '5');
INSERT INTO `map_menu_role` VALUES ('268', '27', '5');
INSERT INTO `map_menu_role` VALUES ('269', '28', '5');
INSERT INTO `map_menu_role` VALUES ('270', '26', '5');
INSERT INTO `map_menu_role` VALUES ('271', '25', '5');
INSERT INTO `map_menu_role` VALUES ('272', '24', '5');
INSERT INTO `map_menu_role` VALUES ('273', '23', '5');
INSERT INTO `map_menu_role` VALUES ('274', '22', '5');
INSERT INTO `map_menu_role` VALUES ('275', '40', '5');
INSERT INTO `map_menu_role` VALUES ('276', '21', '5');
INSERT INTO `map_menu_role` VALUES ('277', '20', '5');
INSERT INTO `map_menu_role` VALUES ('278', '44', '5');
INSERT INTO `map_menu_role` VALUES ('302', '44', '4');
INSERT INTO `map_menu_role` VALUES ('311', '38', '4');
INSERT INTO `map_menu_role` VALUES ('312', '39', '4');
INSERT INTO `map_menu_role` VALUES ('314', '42', '4');
INSERT INTO `map_menu_role` VALUES ('318', '13', '4');
INSERT INTO `map_menu_role` VALUES ('347', '44', '3');
INSERT INTO `map_menu_role` VALUES ('350', '44', '2');
INSERT INTO `map_menu_role` VALUES ('354', '42', '3');
INSERT INTO `map_menu_role` VALUES ('394', '42', '5');
INSERT INTO `map_menu_role` VALUES ('399', '49', '2');
INSERT INTO `map_menu_role` VALUES ('405', '50', '2');
INSERT INTO `map_menu_role` VALUES ('408', '51', '2');
INSERT INTO `map_menu_role` VALUES ('414', '53', '2');
INSERT INTO `map_menu_role` VALUES ('415', '52', '2');
INSERT INTO `map_menu_role` VALUES ('477', '50', '4');
INSERT INTO `map_menu_role` VALUES ('478', '51', '4');
INSERT INTO `map_menu_role` VALUES ('479', '53', '4');
INSERT INTO `map_menu_role` VALUES ('480', '52', '4');
INSERT INTO `map_menu_role` VALUES ('504', '19', '4');
INSERT INTO `map_menu_role` VALUES ('505', '18', '4');
INSERT INTO `map_menu_role` VALUES ('526', '76', '5');
INSERT INTO `map_menu_role` VALUES ('529', '77', '5');
INSERT INTO `map_menu_role` VALUES ('530', '44', '1');
INSERT INTO `map_menu_role` VALUES ('531', '42', '1');
INSERT INTO `map_menu_role` VALUES ('532', '77', '1');
INSERT INTO `map_menu_role` VALUES ('533', '77', '2');
INSERT INTO `map_menu_role` VALUES ('539', '80', '4');
INSERT INTO `map_menu_role` VALUES ('540', '80', '2');
INSERT INTO `map_menu_role` VALUES ('542', '35', '5');
INSERT INTO `map_menu_role` VALUES ('543', '1', '5');
INSERT INTO `map_menu_role` VALUES ('544', '2', '5');
INSERT INTO `map_menu_role` VALUES ('545', '36', '5');
INSERT INTO `map_menu_role` VALUES ('546', '3', '5');
INSERT INTO `map_menu_role` VALUES ('547', '10', '5');
INSERT INTO `map_menu_role` VALUES ('548', '6', '5');
INSERT INTO `map_menu_role` VALUES ('549', '9', '5');
INSERT INTO `map_menu_role` VALUES ('550', '49', '5');
INSERT INTO `map_menu_role` VALUES ('551', '38', '5');
INSERT INTO `map_menu_role` VALUES ('552', '50', '5');
INSERT INTO `map_menu_role` VALUES ('553', '51', '5');
INSERT INTO `map_menu_role` VALUES ('554', '39', '5');
INSERT INTO `map_menu_role` VALUES ('555', '52', '5');
INSERT INTO `map_menu_role` VALUES ('556', '53', '5');
INSERT INTO `map_menu_role` VALUES ('557', '57', '5');
INSERT INTO `map_menu_role` VALUES ('558', '58', '5');
INSERT INTO `map_menu_role` VALUES ('559', '59', '5');
INSERT INTO `map_menu_role` VALUES ('560', '13', '5');
INSERT INTO `map_menu_role` VALUES ('561', '80', '5');
INSERT INTO `map_menu_role` VALUES ('562', '18', '5');
INSERT INTO `map_menu_role` VALUES ('563', '19', '5');
INSERT INTO `map_menu_role` VALUES ('564', '74', '5');
INSERT INTO `map_menu_role` VALUES ('565', '41', '5');
INSERT INTO `map_menu_role` VALUES ('566', '75', '5');
INSERT INTO `map_menu_role` VALUES ('567', '78', '5');
INSERT INTO `map_menu_role` VALUES ('568', '79', '5');
INSERT INTO `map_menu_role` VALUES ('569', '81', '5');
INSERT INTO `map_menu_role` VALUES ('570', '82', '5');
INSERT INTO `map_menu_role` VALUES ('573', '18', '2');
INSERT INTO `map_menu_role` VALUES ('574', '19', '2');
INSERT INTO `map_menu_role` VALUES ('575', '41', '2');
INSERT INTO `map_menu_role` VALUES ('576', '74', '2');
INSERT INTO `map_menu_role` VALUES ('579', '77', '3');
INSERT INTO `map_menu_role` VALUES ('580', '57', '2');
INSERT INTO `map_menu_role` VALUES ('581', '58', '2');
INSERT INTO `map_menu_role` VALUES ('582', '57', '3');
INSERT INTO `map_menu_role` VALUES ('583', '58', '3');
INSERT INTO `map_menu_role` VALUES ('585', '49', '4');
INSERT INTO `map_menu_role` VALUES ('586', '77', '4');
INSERT INTO `map_menu_role` VALUES ('587', '57', '4');
INSERT INTO `map_menu_role` VALUES ('588', '58', '4');
INSERT INTO `map_menu_role` VALUES ('593', '74', '4');
INSERT INTO `map_menu_role` VALUES ('596', '49', '3');
INSERT INTO `map_menu_role` VALUES ('597', '81', '2');
INSERT INTO `map_menu_role` VALUES ('598', '82', '2');
INSERT INTO `map_menu_role` VALUES ('599', '83', '5');
INSERT INTO `map_menu_role` VALUES ('600', '84', '5');
INSERT INTO `map_menu_role` VALUES ('601', '83', '3');
INSERT INTO `map_menu_role` VALUES ('602', '35', '1');
INSERT INTO `map_menu_role` VALUES ('603', '1', '1');
INSERT INTO `map_menu_role` VALUES ('604', '2', '1');
INSERT INTO `map_menu_role` VALUES ('605', '36', '1');
INSERT INTO `map_menu_role` VALUES ('606', '10', '1');
INSERT INTO `map_menu_role` VALUES ('607', '3', '1');
INSERT INTO `map_menu_role` VALUES ('608', '49', '1');
INSERT INTO `map_menu_role` VALUES ('609', '85', '5');
INSERT INTO `map_menu_role` VALUES ('610', '85', '2');
INSERT INTO `map_menu_role` VALUES ('611', '86', '5');
INSERT INTO `map_menu_role` VALUES ('612', '86', '2');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_menu_id` tinyint(3) unsigned NOT NULL,
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_link` varchar(100) DEFAULT NULL,
  `menu_status_id` tinyint(4) DEFAULT NULL COMMENT '1=เปิด,   2=ปิด,  3=แสดงไม่ให้คลิก',
  `menu_openlink` tinyint(4) DEFAULT NULL COMMENT '0= หน้าเดิม , 1= หน้าใหม่',
  `menu_sort` int(10) unsigned DEFAULT NULL,
  `menu_update` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `fk_menu_group_menu1_idx` (`group_menu_id`),
  CONSTRAINT `fk_menu_group_menu1` FOREIGN KEY (`group_menu_id`) REFERENCES `group_menu` (`group_menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '1', 'หนังสือรอดำเนินการ', 'withinwaiting', '1', '0', '2', '2018-10-12 11:32:18');
INSERT INTO `menu` VALUES ('2', '1', 'หนังสือระหว่างดำเนินการ', 'withinprocess', '1', '0', '3', '2018-10-12 11:32:23');
INSERT INTO `menu` VALUES ('3', '1', 'หนังสือตีกลับ', 'withinbounce', '1', '0', '6', '2018-10-12 11:32:35');
INSERT INTO `menu` VALUES ('6', '3', 'บันทึกหนังสือส่งภายนอก', 'without', '1', '0', '1', '2021-02-23 15:07:48');
INSERT INTO `menu` VALUES ('9', '3', 'รายการหนังสือส่งภายนอก', 'withoutlist', '1', '0', '4', '2021-02-23 15:07:51');
INSERT INTO `menu` VALUES ('10', '1', 'หนังสือที่ต้องติดตาม', 'followme', '1', '0', '5', '2018-10-12 11:35:57');
INSERT INTO `menu` VALUES ('13', '5', 'รายงานหนังสือส่ง', 'reportwithindep', '1', '0', '1', '2021-03-19 10:39:11');
INSERT INTO `menu` VALUES ('18', '7', 'ตั้งค่าหน่วยงาน', 'setting', '1', '0', '1', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('19', '7', 'ผู้ใช้งานหน่วยงาน', 'userdep', '1', '0', '2', '2018-11-30 10:49:47');
INSERT INTO `menu` VALUES ('20', '8', 'หน่วยธุรกิจ', 'organization', '1', '0', '1', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('21', '8', 'หน่วยงาน', 'department', '1', '0', '2', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('22', '8', 'ปีงานสารบรรณ', 'year', '1', '0', '4', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('23', '8', 'ผู้ใช้งานระบบ', 'user', '1', '0', '5', '2021-05-07 11:21:36');
INSERT INTO `menu` VALUES ('24', '8', 'สิทธิ์การใช้งาน', 'role', '1', '0', '6', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('25', '8', 'กลุ่มเมนู', 'groupmenu', '1', '0', '7', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('26', '11', 'ประเภทหนังสือ', 'worktype', '1', '0', '1', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('27', '11', 'วัตถุประสงค์', 'actioninfo', '1', '0', '3', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('28', '11', 'หมวดหนังสือ', 'bookgroup', '1', '0', '2', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('29', '11', 'คำสั่งพิเศษ', 'specialcommand', '1', '0', '4', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('30', '11', 'วิธีการรับ-ส่ง', 'doctype', '1', '0', '5', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('31', '11', 'หน่วยงานภายนอก', 'agency', '1', '0', '6', '2018-06-05 11:15:31');
INSERT INTO `menu` VALUES ('32', '9', 'ประวัติใช้งานระบบ', 'loguserlogin', '1', '0', '32', '2018-05-31 12:16:29');
INSERT INTO `menu` VALUES ('33', '9', 'ประวัติการดำเนินงาน', 'logworkprocess', '1', '0', '33', '2021-03-15 15:41:35');
INSERT INTO `menu` VALUES ('34', '9', 'ประวัติงานที่รับมอบหมาย', 'logworkuser', '1', '0', '34', '2021-03-16 10:09:32');
INSERT INTO `menu` VALUES ('35', '1', 'สร้างหนังสือส่งภายใน', 'within', '1', '0', '1', '2021-01-19 15:41:15');
INSERT INTO `menu` VALUES ('36', '1', 'รายการหนังสือส่งภายใน', 'withinlist', '1', '0', '4', '2018-12-13 11:57:01');
INSERT INTO `menu` VALUES ('38', '10', 'สร้างหนังสือรับ', 'getwithin', '1', '0', '1', '2021-05-01 22:00:48');
INSERT INTO `menu` VALUES ('39', '10', 'รายการหนังสือรับเข้า', 'getwithinlist', '1', '0', '4', '2019-03-15 13:28:22');
INSERT INTO `menu` VALUES ('40', '8', 'ตำแหน่งงาน', 'officer', '1', '0', '3', '2018-12-04 10:22:30');
INSERT INTO `menu` VALUES ('41', '7', 'เส้นทางหนังสือ', 'routes', '1', '0', '3', '2019-01-07 10:44:16');
INSERT INTO `menu` VALUES ('42', '12', 'งานที่รับมอบหมาย', 'receivework', '1', '0', '2', '2019-01-17 15:33:34');
INSERT INTO `menu` VALUES ('44', '12', 'ภาพรวม', 'main', '1', '0', '1', '2019-02-07 14:48:11');
INSERT INTO `menu` VALUES ('49', '15', 'ลงรับหนังสือ (ภายใน)', 'receivelist', '1', '0', '1', '2021-03-01 10:55:16');
INSERT INTO `menu` VALUES ('50', '10', 'หนังสือรอดำเนินการ', 'getwithinwaiting', '1', '0', '2', '2019-05-07 15:16:19');
INSERT INTO `menu` VALUES ('51', '10', 'หนังสือระหว่างดำเนินการ', 'getwithinprocess', '1', '0', '3', '2019-05-13 09:09:45');
INSERT INTO `menu` VALUES ('52', '10', 'หนังสือที่ต้องติดตาม', 'getwithinfollowme', '1', '0', '5', '2019-05-15 10:15:44');
INSERT INTO `menu` VALUES ('53', '10', 'หนังสือตีกลับ', 'getwithinbounce', '1', '0', '6', '2019-05-15 10:16:22');
INSERT INTO `menu` VALUES ('57', '17', 'บันทึกประกาศแจ้งเตือน', 'notify', '1', '0', '1', '2019-06-12 10:46:59');
INSERT INTO `menu` VALUES ('58', '17', 'รายการประกาศแจ้งเตือน', 'notifylist', '1', '0', '2', '2019-06-12 10:46:55');
INSERT INTO `menu` VALUES ('59', '17', 'ตรวจสอบ LINE TOKEN', 'notifytoken', '1', '0', '3', '2019-06-12 10:48:09');
INSERT INTO `menu` VALUES ('74', '7', 'กลุ่มหน่วยงานส่งหนังสือ', 'groupdep', '1', '0', '4', '2021-02-25 10:04:07');
INSERT INTO `menu` VALUES ('75', '9', 'ประวัติลายเซ็นต์', 'logsignature', '1', '0', '35', '2021-04-09 11:34:02');
INSERT INTO `menu` VALUES ('76', '8', 'สำรองข้อมูล', 'backup', '1', '0', '8', '2021-03-17 12:12:16');
INSERT INTO `menu` VALUES ('77', '22', 'ตรวจลายเซ็นต์', 'checksignature', '1', '0', '1', '2021-03-17 14:08:59');
INSERT INTO `menu` VALUES ('78', '9', 'ประวัติตรวจสอบลายเซ็นต์', 'logsignaturecheck', '1', '0', '36', '2021-04-09 11:34:08');
INSERT INTO `menu` VALUES ('79', '9', 'ประวัติการจัดการเอกสาร', 'logworkinfomanage', '1', '0', '37', '2021-03-18 14:58:19');
INSERT INTO `menu` VALUES ('80', '5', 'รายงานลงรับหนังสือ', 'reportreceivelistdep', '1', '0', '2', '2021-03-19 10:38:43');
INSERT INTO `menu` VALUES ('81', '23', 'บันทึกหนังสือย้อนหลัง', 'retrospect', '1', '0', '1', '2021-04-20 10:32:56');
INSERT INTO `menu` VALUES ('82', '23', 'รายการหนังสือย้อนหลัง', 'retrospectlist', '1', '0', '2', '2021-04-20 10:33:20');
INSERT INTO `menu` VALUES ('83', '13', 'รายการมอบหมายงาน', 'assignments', '1', '0', '1', '2021-05-21 15:22:40');
INSERT INTO `menu` VALUES ('84', '11', 'คำบันทึกงาน', 'wordcomment', '1', '0', '7', '2021-05-23 20:34:21');
INSERT INTO `menu` VALUES ('85', '5', 'รายงานลงรับหนังสือทั้งหน่วยงาน', 'reportreceivelistalldep', '1', '0', '3', '2021-06-09 09:51:17');
INSERT INTO `menu` VALUES ('86', '5', 'รายงานหนังสือส่งทั้งหน่วยงาน', 'reportwithinalldep', '1', '0', '4', '2021-06-09 09:51:17');

-- ----------------------------
-- Table structure for notification
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notify_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `line_token` varchar(255) DEFAULT NULL,
  `notification_status_id` tinyint(4) DEFAULT NULL,
  `notification_modify` datetime DEFAULT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `fk_notification_notify1_idx` (`notify_id`),
  KEY `fk_notification_user1_idx` (`user_id`),
  CONSTRAINT `fk_notification_notify1` FOREIGN KEY (`notify_id`) REFERENCES `notify` (`notify_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notification_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notification
-- ----------------------------

-- ----------------------------
-- Table structure for notify
-- ----------------------------
DROP TABLE IF EXISTS `notify`;
CREATE TABLE `notify` (
  `notify_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `notify_message` text,
  `notify_image` text,
  `notify_fileimage` varchar(255) DEFAULT NULL,
  `notify_create` datetime DEFAULT NULL,
  `notify_update` datetime DEFAULT NULL,
  PRIMARY KEY (`notify_id`),
  KEY `fk_notify_user1_idx` (`user_id`),
  CONSTRAINT `fk_notify_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notify
-- ----------------------------

-- ----------------------------
-- Table structure for officer
-- ----------------------------
DROP TABLE IF EXISTS `officer`;
CREATE TABLE `officer` (
  `officer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `officer_name` varchar(255) DEFAULT NULL,
  `officer_name_display` varchar(255) DEFAULT NULL,
  `officer_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`officer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of officer
-- ----------------------------
INSERT INTO `officer` VALUES ('1', 'นายกเทศมนตรี', 'นายกเทศมนตรี', '1');
INSERT INTO `officer` VALUES ('2', 'รองนายกเทศมนตรี 1', 'รองนายกเทศมนตรี 1', '2');
INSERT INTO `officer` VALUES ('3', 'รองนายกเทศมนตรี 2', 'รองนายกเทศมนตรี 2', '3');
INSERT INTO `officer` VALUES ('4', 'เลขานุการนายกเทศมนตรี', 'เลขานุการนายกเทศมนตรี', '4');
INSERT INTO `officer` VALUES ('5', 'ประธานสภา', 'ประธานสภา', '5');
INSERT INTO `officer` VALUES ('6', 'รองประธานสภา', 'รองประธานสภา', '6');
INSERT INTO `officer` VALUES ('7', 'ปลัดเทศบาล', 'ปลัดเทศบาล', '7');
INSERT INTO `officer` VALUES ('8', 'รองผู้อำนวยการ', 'รองผู้อำนวยการ', '8');
INSERT INTO `officer` VALUES ('9', 'หัวหน้าสำนักปลัด', 'หัวหน้าสำนักปลัด', '9');
INSERT INTO `officer` VALUES ('10', 'หัวหน้าฝ่ายปกครอง', 'หัวหน้าฝ่ายปกครอง', '10');
INSERT INTO `officer` VALUES ('11', 'หัวหน้าฝ่ายอำนวยการ', 'หัวหน้าฝ่ายอำนวยการ', '11');
INSERT INTO `officer` VALUES ('12', 'ผู้อำนวยการกองคลัง', 'ผู้อำนวยการกองคลัง', '12');
INSERT INTO `officer` VALUES ('13', 'หัวหน้าฝ่ายการคลัง', 'หัวหน้าฝ่ายการคลัง', '13');
INSERT INTO `officer` VALUES ('14', 'หัวหน้าฝ่ายพัฒนารายได้', 'หัวหน้าฝ่ายพัฒนารายได้', '14');
INSERT INTO `officer` VALUES ('15', 'ผู้อำนวยการกองช่าง', 'ผู้อำนวยการกองช่าง', '15');
INSERT INTO `officer` VALUES ('16', 'หัวหน้าฝ่ายแบบแผนและก่อสร้าง', 'หัวหน้าฝ่ายแบบแผนและก่อสร้าง', '16');
INSERT INTO `officer` VALUES ('17', 'ผู้อำนวยการกองการศึกษา', 'ผู้อำนวยการกองการศึกษา', '17');
INSERT INTO `officer` VALUES ('18', 'หัวหน้าฝ่ายบริหารการศึกษา', 'หัวหน้าฝ่ายบริหารการศึกษา', '18');
INSERT INTO `officer` VALUES ('19', 'ผู้จัดการสถานธนานุบาล', 'ผู้จัดการสถานธนานุบาล', '19');
INSERT INTO `officer` VALUES ('20', 'งานสารบรรณ', 'งานสารบรรณ', '20');

-- ----------------------------
-- Table structure for organization
-- ----------------------------
DROP TABLE IF EXISTS `organization`;
CREATE TABLE `organization` (
  `org_id_pri` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `org_id` varchar(20) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `org_name_short` varchar(100) DEFAULT NULL,
  `org_number` int(11) DEFAULT '0',
  `org_prefix` varchar(50) DEFAULT NULL,
  `org_create` datetime DEFAULT NULL,
  `org_update` datetime DEFAULT NULL,
  PRIMARY KEY (`org_id_pri`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='หน่วยธุรกิจ';

-- ----------------------------
-- Records of organization
-- ----------------------------
INSERT INTO `organization` VALUES ('1', '00', 'สารบรรณ', 'สารบรรณ', '1', 'สารบรรณ', '2021-06-16 10:53:05', '2021-06-16 10:53:05');

-- ----------------------------
-- Table structure for place
-- ----------------------------
DROP TABLE IF EXISTS `place`;
CREATE TABLE `place` (
  `place_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_name` varchar(100) DEFAULT NULL,
  `place_create` datetime DEFAULT NULL,
  `place_update` datetime DEFAULT NULL,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of place
-- ----------------------------
INSERT INTO `place` VALUES ('1', 'จังหวัดเชียงใหม่ 50000', '2021-06-16 15:02:19', '2021-06-16 15:02:19');

-- ----------------------------
-- Table structure for ref_action_info
-- ----------------------------
DROP TABLE IF EXISTS `ref_action_info`;
CREATE TABLE `ref_action_info` (
  `action_info_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_info_name` varchar(100) DEFAULT NULL,
  `action_info_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`action_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_action_info
-- ----------------------------
INSERT INTO `ref_action_info` VALUES ('1', 'เพื่อดำเนินการ', '1');
INSERT INTO `ref_action_info` VALUES ('2', 'สำเนาเพื่อทราบ', '2');
INSERT INTO `ref_action_info` VALUES ('3', 'เพื่ออนุมัติ', '3');
INSERT INTO `ref_action_info` VALUES ('4', 'เพื่อพิจารณา', '4');
INSERT INTO `ref_action_info` VALUES ('5', 'เพื่อทราบและพิจารณา', '5');
INSERT INTO `ref_action_info` VALUES ('6', 'เพื่อทราบและพิจารณาอนุมัติ', '6');
INSERT INTO `ref_action_info` VALUES ('7', 'เพื่อทราบและพิจารณาสั่งการ', '7');
INSERT INTO `ref_action_info` VALUES ('8', 'เพื่อทราบและพิจารณาดำเนินการ', '8');
INSERT INTO `ref_action_info` VALUES ('9', 'เพื่อพิจารณาและรายงานผลการดำเนินงาน', '9');
INSERT INTO `ref_action_info` VALUES ('10', 'เพื่อพิจารณาให้ความเห็นชอบ', '10');
INSERT INTO `ref_action_info` VALUES ('11', 'เพื่อลงนาม', '11');
INSERT INTO `ref_action_info` VALUES ('12', 'เพื่อพิจารณาอนุมัติและลงนาม', '12');
INSERT INTO `ref_action_info` VALUES ('13', 'เพื่อวินิจฉัยและตีความ', '13');
INSERT INTO `ref_action_info` VALUES ('14', 'เพื่อพิจารณาและชี้แนะแนวทาง', '14');
INSERT INTO `ref_action_info` VALUES ('15', 'เพื่อถือปฏิบัติ', '15');
INSERT INTO `ref_action_info` VALUES ('16', 'เพื่อทราบ', '16');

-- ----------------------------
-- Table structure for ref_book_group
-- ----------------------------
DROP TABLE IF EXISTS `ref_book_group`;
CREATE TABLE `ref_book_group` (
  `book_group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_group_name` varchar(100) DEFAULT NULL,
  `book_group_sort` int(11) DEFAULT NULL,
  `book_group_type` tinyint(4) DEFAULT '1' COMMENT '1 ภายใน 2 ภายนอก',
  PRIMARY KEY (`book_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_book_group
-- ----------------------------
INSERT INTO `ref_book_group` VALUES ('1', 'หนังสือทั่วไป', '1', '1');
INSERT INTO `ref_book_group` VALUES ('2', 'ส่งเอกสาร/หนังสือ/สิ่งตีพิมพ์', '2', '1');
INSERT INTO `ref_book_group` VALUES ('3', 'ขอหารือ', '3', '1');
INSERT INTO `ref_book_group` VALUES ('4', 'ทราบ', '4', '1');
INSERT INTO `ref_book_group` VALUES ('5', 'มติคณะรัฐมนตรี', '5', '1');
INSERT INTO `ref_book_group` VALUES ('6', 'ระเบียบสำนักนายกและกฏหมายอื่น', '6', '1');
INSERT INTO `ref_book_group` VALUES ('7', 'หนังสือโต้ตอบ', '7', '1');
INSERT INTO `ref_book_group` VALUES ('8', 'หนังสือเชิญประชุม', '8', '1');
INSERT INTO `ref_book_group` VALUES ('9', 'หนังสือเวียน', '9', '1');
INSERT INTO `ref_book_group` VALUES ('10', 'หนังสือจากจว.และส่วนราชการในจว.', '10', '1');
INSERT INTO `ref_book_group` VALUES ('11', 'ขอความอนุเคราะห์', '11', '1');
INSERT INTO `ref_book_group` VALUES ('12', 'ตอบขอบคุณ', '12', '1');
INSERT INTO `ref_book_group` VALUES ('13', 'ขอข้อมูล/เอกสาร', '13', '1');

-- ----------------------------
-- Table structure for ref_department_status
-- ----------------------------
DROP TABLE IF EXISTS `ref_department_status`;
CREATE TABLE `ref_department_status` (
  `dep_status_id` int(11) NOT NULL,
  `dep_status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`dep_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_department_status
-- ----------------------------
INSERT INTO `ref_department_status` VALUES ('1', 'ปกติ');
INSERT INTO `ref_department_status` VALUES ('2', 'ระงับ');

-- ----------------------------
-- Table structure for ref_doc_type
-- ----------------------------
DROP TABLE IF EXISTS `ref_doc_type`;
CREATE TABLE `ref_doc_type` (
  `doc_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `doc_type_name` varchar(100) DEFAULT NULL,
  `doc_type_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`doc_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_doc_type
-- ----------------------------
INSERT INTO `ref_doc_type` VALUES ('1', 'รับไปดำเนินการ', '1');
INSERT INTO `ref_doc_type` VALUES ('2', 'โทรสาร', '2');
INSERT INTO `ref_doc_type` VALUES ('3', 'สายการบิน', '3');
INSERT INTO `ref_doc_type` VALUES ('4', 'รับรอง', '4');
INSERT INTO `ref_doc_type` VALUES ('5', 'ลงทะเบียน', '5');
INSERT INTO `ref_doc_type` VALUES ('6', 'ลงทะเบียนตอบรับ', '6');
INSERT INTO `ref_doc_type` VALUES ('7', 'EMS', '7');
INSERT INTO `ref_doc_type` VALUES ('8', 'EMS ตอบรับ', '8');
INSERT INTO `ref_doc_type` VALUES ('9', 'นำส่ง', '9');
INSERT INTO `ref_doc_type` VALUES ('10', 'Email', '11');

-- ----------------------------
-- Table structure for ref_file_type
-- ----------------------------
DROP TABLE IF EXISTS `ref_file_type`;
CREATE TABLE `ref_file_type` (
  `file_type_id` int(11) NOT NULL,
  `file_type_name` varchar(50) DEFAULT NULL,
  `file_type_icon` varchar(50) DEFAULT NULL,
  `file_type_check` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`file_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_file_type
-- ----------------------------
INSERT INTO `ref_file_type` VALUES ('1', 'pdf', 'pdf.png', '1');
INSERT INTO `ref_file_type` VALUES ('2', 'doc', 'word.png', '2');
INSERT INTO `ref_file_type` VALUES ('3', 'docx', 'word.png', '2');
INSERT INTO `ref_file_type` VALUES ('4', 'xls', 'excel.png', '2');
INSERT INTO `ref_file_type` VALUES ('5', 'xlsx', 'excel.png', '2');
INSERT INTO `ref_file_type` VALUES ('6', 'ppt', 'ppt.png', '2');
INSERT INTO `ref_file_type` VALUES ('7', 'pptx', 'ppt.png', '2');
INSERT INTO `ref_file_type` VALUES ('8', 'txt', 'txt.png', '2');
INSERT INTO `ref_file_type` VALUES ('9', 'zip', 'zip.png', '2');
INSERT INTO `ref_file_type` VALUES ('10', 'rar', 'rar.png', '2');
INSERT INTO `ref_file_type` VALUES ('11', 'jpg', 'jpg.png', '3');
INSERT INTO `ref_file_type` VALUES ('12', 'jpeg', 'jpg.png', '3');
INSERT INTO `ref_file_type` VALUES ('13', 'png', 'png.png', '3');
INSERT INTO `ref_file_type` VALUES ('14', 'gif', 'gif.png', '3');
INSERT INTO `ref_file_type` VALUES ('15', 'csv', 'csv.png', '2');

-- ----------------------------
-- Table structure for ref_internal_action
-- ----------------------------
DROP TABLE IF EXISTS `ref_internal_action`;
CREATE TABLE `ref_internal_action` (
  `internal_action_id` int(11) NOT NULL,
  `internal_action_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`internal_action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_internal_action
-- ----------------------------
INSERT INTO `ref_internal_action` VALUES ('1', 'ปกติ');
INSERT INTO `ref_internal_action` VALUES ('2', 'ลงนาม');
INSERT INTO `ref_internal_action` VALUES ('3', 'รักษาการแทน');

-- ----------------------------
-- Table structure for ref_parcel_group
-- ----------------------------
DROP TABLE IF EXISTS `ref_parcel_group`;
CREATE TABLE `ref_parcel_group` (
  `parcel_group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parcel_group_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`parcel_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_parcel_group
-- ----------------------------
INSERT INTO `ref_parcel_group` VALUES ('1', 'บุคลากร');
INSERT INTO `ref_parcel_group` VALUES ('2', 'นักศึกษา');
INSERT INTO `ref_parcel_group` VALUES ('3', 'ไม่ระบุ');

-- ----------------------------
-- Table structure for ref_parcel_status
-- ----------------------------
DROP TABLE IF EXISTS `ref_parcel_status`;
CREATE TABLE `ref_parcel_status` (
  `parcel_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parcel_status_name` varchar(100) DEFAULT NULL,
  `parcel_status_label` varchar(45) DEFAULT NULL,
  `parcel_status_icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`parcel_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_parcel_status
-- ----------------------------
INSERT INTO `ref_parcel_status` VALUES ('1', 'พัสดุรอรับ', 'badge badge-info', 'fa fa-cube');
INSERT INTO `ref_parcel_status` VALUES ('2', 'พัสดุรับแล้ว', 'badge badge-success', 'fa fa-dropbox');

-- ----------------------------
-- Table structure for ref_parcel_tran
-- ----------------------------
DROP TABLE IF EXISTS `ref_parcel_tran`;
CREATE TABLE `ref_parcel_tran` (
  `parcel_tran_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parcel_tran_name` varchar(100) DEFAULT NULL,
  `parcel_tran_sort` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`parcel_tran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_parcel_tran
-- ----------------------------
INSERT INTO `ref_parcel_tran` VALUES ('1', 'EMS', '1');
INSERT INTO `ref_parcel_tran` VALUES ('2', 'Kerry', '3');
INSERT INTO `ref_parcel_tran` VALUES ('3', 'ไปรษณีย์ไทย(ธรรมดา)', '2');
INSERT INTO `ref_parcel_tran` VALUES ('4', 'Lazada express', '4');

-- ----------------------------
-- Table structure for ref_parcel_type
-- ----------------------------
DROP TABLE IF EXISTS `ref_parcel_type`;
CREATE TABLE `ref_parcel_type` (
  `parcel_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parcel_type_name` varchar(100) DEFAULT NULL,
  `parcel_type_sort` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`parcel_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_parcel_type
-- ----------------------------
INSERT INTO `ref_parcel_type` VALUES ('1', 'พัสดุ', '2');
INSERT INTO `ref_parcel_type` VALUES ('2', 'จดหมาย', '1');
INSERT INTO `ref_parcel_type` VALUES ('4', 'ทดสอบเพิ่ม', null);

-- ----------------------------
-- Table structure for ref_position
-- ----------------------------
DROP TABLE IF EXISTS `ref_position`;
CREATE TABLE `ref_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_position
-- ----------------------------
INSERT INTO `ref_position` VALUES ('1', 'นายกเทศมนตรี');
INSERT INTO `ref_position` VALUES ('2', 'รองนายกเทศมนตรี');
INSERT INTO `ref_position` VALUES ('3', 'ประธานสภา');
INSERT INTO `ref_position` VALUES ('4', 'ปลัดเทศบาล');
INSERT INTO `ref_position` VALUES ('5', 'หัวหน้าสำนักปลัด');
INSERT INTO `ref_position` VALUES ('6', 'ผู้อำนวยการ');
INSERT INTO `ref_position` VALUES ('7', 'รองผู้อำนวยการ');
INSERT INTO `ref_position` VALUES ('8', 'หัวหน้าฝ่าย');

-- ----------------------------
-- Table structure for ref_priority_info
-- ----------------------------
DROP TABLE IF EXISTS `ref_priority_info`;
CREATE TABLE `ref_priority_info` (
  `priority_info_id` int(11) NOT NULL,
  `priority_info_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`priority_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_priority_info
-- ----------------------------
INSERT INTO `ref_priority_info` VALUES ('1', 'ปกติ');
INSERT INTO `ref_priority_info` VALUES ('2', 'ด่วน');
INSERT INTO `ref_priority_info` VALUES ('3', 'ด่วนมาก');
INSERT INTO `ref_priority_info` VALUES ('4', 'ด่วนที่สุด');

-- ----------------------------
-- Table structure for ref_secret_level
-- ----------------------------
DROP TABLE IF EXISTS `ref_secret_level`;
CREATE TABLE `ref_secret_level` (
  `secret_level_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `secret_level_name` varchar(100) DEFAULT NULL,
  `secret_level_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`secret_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_secret_level
-- ----------------------------
INSERT INTO `ref_secret_level` VALUES ('1', 'ปกติ', '1');
INSERT INTO `ref_secret_level` VALUES ('2', 'ปกปิด', '2');
INSERT INTO `ref_secret_level` VALUES ('3', 'ลับ', '3');
INSERT INTO `ref_secret_level` VALUES ('4', 'ลับมาก', '4');
INSERT INTO `ref_secret_level` VALUES ('5', 'ลับที่สุด', '5');
INSERT INTO `ref_secret_level` VALUES ('6', 'ประกาศทั้งองค์กร', '6');

-- ----------------------------
-- Table structure for ref_service_status
-- ----------------------------
DROP TABLE IF EXISTS `ref_service_status`;
CREATE TABLE `ref_service_status` (
  `service_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`service_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_service_status
-- ----------------------------
INSERT INTO `ref_service_status` VALUES ('1', 'รอการตอบกลับ');
INSERT INTO `ref_service_status` VALUES ('2', 'ตอบกลับแล้ว');
INSERT INTO `ref_service_status` VALUES ('3', 'กำลังดำเนินการ');
INSERT INTO `ref_service_status` VALUES ('4', 'ปิดงานเสร็จสิ้น');
INSERT INTO `ref_service_status` VALUES ('6', 'ยกเลิกงานแล้ว');

-- ----------------------------
-- Table structure for ref_special_command
-- ----------------------------
DROP TABLE IF EXISTS `ref_special_command`;
CREATE TABLE `ref_special_command` (
  `special_command_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `special_command_name` varchar(100) DEFAULT NULL,
  `special_command_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`special_command_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_special_command
-- ----------------------------
INSERT INTO `ref_special_command` VALUES ('1', 'รอตอบรับ', '2');
INSERT INTO `ref_special_command` VALUES ('2', 'บันทึก', '3');
INSERT INTO `ref_special_command` VALUES ('3', 'อนุมัติดำเนินการ', '4');
INSERT INTO `ref_special_command` VALUES ('4', 'ไม่อนุมัติ', '5');
INSERT INTO `ref_special_command` VALUES ('5', 'สั่งการ', '6');
INSERT INTO `ref_special_command` VALUES ('6', 'ขอรายละเอียดเพิ่ม', '7');
INSERT INTO `ref_special_command` VALUES ('7', 'เห็นควรมอบ', '1');
INSERT INTO `ref_special_command` VALUES ('8', 'รายงานผล', '8');

-- ----------------------------
-- Table structure for ref_state_info
-- ----------------------------
DROP TABLE IF EXISTS `ref_state_info`;
CREATE TABLE `ref_state_info` (
  `state_info_id` int(11) NOT NULL,
  `state_info_name` varchar(50) DEFAULT NULL,
  `state_info_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`state_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_state_info
-- ----------------------------
INSERT INTO `ref_state_info` VALUES ('1', 'รอดำเนินการ', '1');
INSERT INTO `ref_state_info` VALUES ('2', 'ลงทะเบียน', '2');
INSERT INTO `ref_state_info` VALUES ('3', 'เตรียมส่ง', '3');
INSERT INTO `ref_state_info` VALUES ('4', 'กำลังดำเนินการ', '4');
INSERT INTO `ref_state_info` VALUES ('5', 'เสร็จแล้ว', '5');
INSERT INTO `ref_state_info` VALUES ('6', 'ปิดงานแล้ว', '6');
INSERT INTO `ref_state_info` VALUES ('7', 'ดึงกลับ', '7');
INSERT INTO `ref_state_info` VALUES ('8', 'ตีกลับ', '8');
INSERT INTO `ref_state_info` VALUES ('9', 'ยกเลิก', '9');
INSERT INTO `ref_state_info` VALUES ('10', 'ถูกลบทิ้ง', '10');
INSERT INTO `ref_state_info` VALUES ('11', 'เอกสารหมดอายุ', '11');
INSERT INTO `ref_state_info` VALUES ('12', 'เอกสารถูกยืม', '12');
INSERT INTO `ref_state_info` VALUES ('13', 'เก็บลงแฟ้มเลข 18 หลัก', '13');
INSERT INTO `ref_state_info` VALUES ('14', 'โอนเอกสารข้ามปี', '14');
INSERT INTO `ref_state_info` VALUES ('15', 'จัดเก็บแล้ว', '15');

-- ----------------------------
-- Table structure for ref_user_status
-- ----------------------------
DROP TABLE IF EXISTS `ref_user_status`;
CREATE TABLE `ref_user_status` (
  `user_status_id` tinyint(4) NOT NULL,
  `user_status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_user_status
-- ----------------------------
INSERT INTO `ref_user_status` VALUES ('1', 'ปกติ');
INSERT INTO `ref_user_status` VALUES ('2', 'ถูกระงับ');

-- ----------------------------
-- Table structure for ref_work_type
-- ----------------------------
DROP TABLE IF EXISTS `ref_work_type`;
CREATE TABLE `ref_work_type` (
  `work_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `work_type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`work_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_work_type
-- ----------------------------
INSERT INTO `ref_work_type` VALUES ('1', 'ลงรับภายนอก');
INSERT INTO `ref_work_type` VALUES ('2', 'หนังสือส่งภายใน');
INSERT INTO `ref_work_type` VALUES ('3', 'หนังสือส่ง');
INSERT INTO `ref_work_type` VALUES ('4', 'คำสั่ง');
INSERT INTO `ref_work_type` VALUES ('5', 'ประกาศ');
INSERT INTO `ref_work_type` VALUES ('6', 'ลงรับภายใน');

-- ----------------------------
-- Table structure for ref_work_user_status
-- ----------------------------
DROP TABLE IF EXISTS `ref_work_user_status`;
CREATE TABLE `ref_work_user_status` (
  `work_user_status_id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `work_user_status_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`work_user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_work_user_status
-- ----------------------------
INSERT INTO `ref_work_user_status` VALUES ('1', 'รอดำเนินการ');
INSERT INTO `ref_work_user_status` VALUES ('2', 'ดำเนินการ');
INSERT INTO `ref_work_user_status` VALUES ('3', 'เสร็จสิ้น');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  `role_sort` tinyint(3) unsigned DEFAULT NULL,
  `role_update` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'ผู้ปฏิบัติงาน', '5', '2018-05-24 14:43:30');
INSERT INTO `role` VALUES ('2', 'งานสารบรรณ', '2', '2018-05-24 14:43:30');
INSERT INTO `role` VALUES ('3', 'ผู้บริหาร', '3', '2018-05-24 14:43:30');
INSERT INTO `role` VALUES ('4', 'สารบรรณหน่วยงานย่อย', '4', '2019-01-31 11:49:54');
INSERT INTO `role` VALUES ('5', 'ผู้ดูแลระบบ', '1', '2019-01-31 11:49:54');

-- ----------------------------
-- Table structure for routes
-- ----------------------------
DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `routes_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `routes_name` varchar(255) DEFAULT NULL,
  `dep_id_pri` int(10) unsigned NOT NULL,
  `routes_status_id` tinyint(4) DEFAULT NULL,
  `routes_modify` datetime DEFAULT NULL,
  PRIMARY KEY (`routes_id`),
  KEY `fk_routes_department1_idx` (`dep_id_pri`),
  CONSTRAINT `fk_routes_department1` FOREIGN KEY (`dep_id_pri`) REFERENCES `department` (`dep_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of routes
-- ----------------------------

-- ----------------------------
-- Table structure for routes_process
-- ----------------------------
DROP TABLE IF EXISTS `routes_process`;
CREATE TABLE `routes_process` (
  `routes_process_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `routes_id` int(10) unsigned NOT NULL,
  `dep_off_id` int(10) unsigned NOT NULL,
  `routes_process_sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`routes_process_id`),
  KEY `fk_routes_process_routes1_idx` (`routes_id`),
  KEY `fk_routes_process_dep_off1_idx` (`dep_off_id`),
  CONSTRAINT `fk_routes_process_dep_off1` FOREIGN KEY (`dep_off_id`) REFERENCES `dep_off` (`dep_off_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_routes_process_routes1` FOREIGN KEY (`routes_id`) REFERENCES `routes` (`routes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of routes_process
-- ----------------------------

-- ----------------------------
-- Table structure for signature
-- ----------------------------
DROP TABLE IF EXISTS `signature`;
CREATE TABLE `signature` (
  `signature_id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `year_id` int(10) unsigned DEFAULT NULL,
  `work_info_id_pri` bigint(20) unsigned DEFAULT NULL,
  `work_process_id_pri` bigint(20) unsigned DEFAULT NULL,
  `work_user_id` bigint(20) unsigned DEFAULT NULL,
  `signature_type_id` tinyint(4) DEFAULT '1' COMMENT '1 work_info_id_pri,2 work_process_id_pri,3 work_user_id',
  `signature_work_no` varchar(255) DEFAULT NULL,
  `signature_image` varchar(255) DEFAULT NULL,
  `signature_name` varchar(255) DEFAULT NULL,
  `signature_date` datetime DEFAULT NULL,
  `signature_key` varchar(255) DEFAULT NULL,
  `signaturec_modify` datetime DEFAULT NULL,
  PRIMARY KEY (`signature_id`),
  KEY `fk_signature_user1_idx` (`user_id`) USING BTREE,
  KEY `fk_signature_year1_idx` (`year_id`) USING BTREE,
  KEY `fk_signature_work_info1_idx` (`work_info_id_pri`) USING BTREE,
  KEY `fk_signature_work_process1_idx` (`work_process_id_pri`) USING BTREE,
  KEY `fk_signature_work_user1_idx` (`work_user_id`) USING BTREE,
  CONSTRAINT `signature_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `signature_ibfk_2` FOREIGN KEY (`work_info_id_pri`) REFERENCES `work_info` (`work_info_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `signature_ibfk_3` FOREIGN KEY (`work_process_id_pri`) REFERENCES `work_process` (`work_process_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `signature_ibfk_4` FOREIGN KEY (`work_user_id`) REFERENCES `work_user` (`work_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `signature_ibfk_5` FOREIGN KEY (`year_id`) REFERENCES `year` (`year_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of signature
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_citizen` varchar(20) DEFAULT NULL,
  `user_fullname` varchar(100) DEFAULT NULL,
  `user_address` text,
  `user_tel` varchar(20) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT 'none.png',
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `user_style` varchar(20) DEFAULT 'blue' COMMENT 'ใช้สำหรับเก็บชื่อไฟล์ CSS สำหรับสีทีม',
  `user_status_id` tinyint(4) NOT NULL DEFAULT '1',
  `user_activate` tinyint(4) DEFAULT '1',
  `user_activate_code` varchar(255) DEFAULT NULL,
  `user_line_token` varchar(100) DEFAULT NULL,
  `user_signature_path` varchar(255) DEFAULT 'none.png',
  `public_key` varchar(255) DEFAULT NULL,
  `private_key` varchar(255) DEFAULT NULL,
  `pin_key` varchar(255) DEFAULT NULL,
  `user_expire` date DEFAULT NULL,
  `user_create` datetime DEFAULT NULL,
  `user_update` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_ref_user_status1_idx` (`user_status_id`),
  KEY `fk_user_role1_idx` (`role_id`),
  CONSTRAINT `fk_user_ref_user_status1` FOREIGN KEY (`user_status_id`) REFERENCES `ref_user_status` (`user_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'd82494f05d6917ba02f7aaa29689ccb444bb73f20380876cb05d1f37537b7892', 'admin@mail.com', null, 'Admin', '-', '-', 'none.png', '5', 'green', '1', '1', null, null, 'signature_7_20210524074341.png', '7DKSSXAZ66520210312', 'ri8KRve9vDsY32giKyDIix2kVOrJlJ202103121358367', null, null, '2021-03-12 13:58:36', '2021-06-16 16:30:15');

-- ----------------------------
-- Table structure for user_check_login
-- ----------------------------
DROP TABLE IF EXISTS `user_check_login`;
CREATE TABLE `user_check_login` (
  `login_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `regenerate_login` varchar(255) DEFAULT NULL,
  `login_last_time` datetime DEFAULT NULL,
  PRIMARY KEY (`login_id`),
  KEY `fk_login_check_user1_idx` (`user_id`),
  CONSTRAINT `fk_login_check_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_check_login
-- ----------------------------
INSERT INTO `user_check_login` VALUES ('1', '1', '::1', '938806', '2021-06-16 16:38:55');

-- ----------------------------
-- Table structure for user_dep_off
-- ----------------------------
DROP TABLE IF EXISTS `user_dep_off`;
CREATE TABLE `user_dep_off` (
  `user_dep_off_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `dep_off_id` int(10) unsigned NOT NULL,
  `user_dep_off_status_id` tinyint(3) unsigned DEFAULT '1' COMMENT '1 หลัก',
  `user_dep_off_active_id` tinyint(3) unsigned DEFAULT '0' COMMENT '1 หลัก',
  PRIMARY KEY (`user_dep_off_id`),
  KEY `fk_user_dep_off_user1_idx` (`user_id`),
  KEY `fk_user_dep_off_dep_off1_idx` (`dep_off_id`),
  CONSTRAINT `fk_user_dep_off_dep_off1` FOREIGN KEY (`dep_off_id`) REFERENCES `dep_off` (`dep_off_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_dep_off_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_dep_off
-- ----------------------------
INSERT INTO `user_dep_off` VALUES ('7', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for word_comment
-- ----------------------------
DROP TABLE IF EXISTS `word_comment`;
CREATE TABLE `word_comment` (
  `word_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `word_comment` varchar(255) DEFAULT NULL,
  `word_sort` int(11) DEFAULT '0',
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of word_comment
-- ----------------------------
INSERT INTO `word_comment` VALUES ('1', 'มอบดังเสนอ', '1');

-- ----------------------------
-- Table structure for work_info
-- ----------------------------
DROP TABLE IF EXISTS `work_info`;
CREATE TABLE `work_info` (
  `work_info_id_pri` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_info_code` varchar(50) DEFAULT NULL,
  `work_info_id` int(11) DEFAULT NULL COMMENT 'เลขทะเบียนส่ง',
  `work_info_no` varchar(50) DEFAULT NULL COMMENT 'เลขที่เอกสาร',
  `work_info_no_2` varchar(50) DEFAULT NULL,
  `work_info_no_3` int(11) DEFAULT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `work_type_id` int(11) NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'ผู้สร้าง+ส่ง',
  `dep_id_pri` int(10) unsigned DEFAULT NULL COMMENT 'หน่วยงานที่ส่ง',
  `dep_off_id` int(10) unsigned DEFAULT NULL COMMENT 'ตำแหน่งที่ส่ง',
  `work_info_date` date DEFAULT NULL COMMENT 'ลงวันที่',
  `work_info_from_position` varchar(255) DEFAULT NULL,
  `work_info_from` varchar(255) DEFAULT NULL COMMENT 'จาก',
  `work_info_to_position` varchar(255) DEFAULT NULL,
  `work_info_to` varchar(255) DEFAULT NULL COMMENT 'ถึง',
  `work_info_subject` varchar(255) DEFAULT NULL COMMENT 'เรื่อง',
  `work_info_detail` longtext COMMENT 'รายละเอียด',
  `work_info_comment` text,
  `work_info_refer` varchar(255) DEFAULT NULL COMMENT 'อ้างถึง',
  `work_info_other_attach` varchar(255) DEFAULT NULL COMMENT 'สิ่งที่ส่งมาด้วย',
  `work_info_complete` datetime DEFAULT NULL COMMENT 'กำหนดวันให้ดำเนินการแล้วเสร็จ',
  `work_info_expire` datetime DEFAULT NULL COMMENT 'กำหนดวันหมดอายุ',
  `work_info_follow` tinyint(4) DEFAULT '0' COMMENT 'ติดตามผลการทำงาน',
  `work_info_store` varchar(255) DEFAULT NULL,
  `secret_level_id` int(10) unsigned NOT NULL DEFAULT '1',
  `priority_info_id` int(11) NOT NULL DEFAULT '1',
  `action_info_id` int(10) unsigned NOT NULL DEFAULT '1',
  `state_info_id` int(11) NOT NULL DEFAULT '1',
  `doc_type_id` int(10) unsigned DEFAULT '1',
  `book_group_id` int(10) unsigned NOT NULL DEFAULT '1',
  `internal_action_id` int(11) DEFAULT NULL,
  `internal_action_name` varchar(255) DEFAULT NULL,
  `attach_original` int(11) DEFAULT '0' COMMENT '0 =ไม่ส่งต้นฉบับ , 1 = พร้อมส่งต้นฉบับ',
  `work_info_retrospect` tinyint(4) DEFAULT '0' COMMENT '0 ปกติ 1 ย้อยหลัง',
  `work_info_signature` text,
  `work_info_create` datetime DEFAULT NULL COMMENT 'วันที่สร้าง',
  `work_info_update` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  PRIMARY KEY (`work_info_id_pri`),
  KEY `fk_work_info_ref_work_type1_idx` (`work_type_id`),
  KEY `fk_work_info_department1_idx` (`dep_id_pri`),
  KEY `fk_work_info_year1_idx` (`year_id`),
  KEY `fk_work_info_user1_idx` (`user_id`),
  KEY `fk_work_info_ref_secret_level1_idx` (`secret_level_id`),
  KEY `fk_work_info_ref_priority_info1_idx` (`priority_info_id`),
  KEY `fk_work_info_ref_doc_type1_idx` (`doc_type_id`),
  KEY `fk_work_info_ref_book_group1_idx` (`book_group_id`),
  KEY `fk_work_info_ref_action_info1_idx` (`action_info_id`),
  KEY `fk_work_info_ref_state_info1_idx` (`state_info_id`),
  KEY `fk_work_info_ref_internal_action1_idx` (`internal_action_id`),
  KEY `fk_work_info_dep_off1_idx` (`dep_off_id`),
  CONSTRAINT `fk_work_info_dep_off1` FOREIGN KEY (`dep_off_id`) REFERENCES `dep_off` (`dep_off_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_department1` FOREIGN KEY (`dep_id_pri`) REFERENCES `department` (`dep_id_pri`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_work_info_ref_action_info1` FOREIGN KEY (`action_info_id`) REFERENCES `ref_action_info` (`action_info_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_ref_book_group1` FOREIGN KEY (`book_group_id`) REFERENCES `ref_book_group` (`book_group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_ref_doc_type1` FOREIGN KEY (`doc_type_id`) REFERENCES `ref_doc_type` (`doc_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_ref_internal_action1` FOREIGN KEY (`internal_action_id`) REFERENCES `ref_internal_action` (`internal_action_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_ref_priority_info1` FOREIGN KEY (`priority_info_id`) REFERENCES `ref_priority_info` (`priority_info_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_ref_secret_level1` FOREIGN KEY (`secret_level_id`) REFERENCES `ref_secret_level` (`secret_level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_ref_state_info1` FOREIGN KEY (`state_info_id`) REFERENCES `ref_state_info` (`state_info_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_ref_work_type1` FOREIGN KEY (`work_type_id`) REFERENCES `ref_work_type` (`work_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_work_info_year1` FOREIGN KEY (`year_id`) REFERENCES `year` (`year_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_info
-- ----------------------------

-- ----------------------------
-- Table structure for work_info_file
-- ----------------------------
DROP TABLE IF EXISTS `work_info_file`;
CREATE TABLE `work_info_file` (
  `work_info_file_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_info_id_pri` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `work_info_file_path` varchar(255) DEFAULT NULL,
  `work_info_file_oldname` varchar(255) DEFAULT NULL,
  `work_info_file_name` varchar(255) DEFAULT NULL,
  `file_type_id` int(11) NOT NULL,
  `work_info_file_active` tinyint(4) DEFAULT '1' COMMENT '0 = ไม่ใช้งาน, 1 = ใช้งาน',
  `work_info_file_create` datetime DEFAULT NULL,
  `work_info_file_update` datetime DEFAULT NULL,
  PRIMARY KEY (`work_info_file_id`),
  KEY `fk_work_info_file_work_info1_idx` (`work_info_id_pri`),
  KEY `fk_work_info_file_user1_idx` (`user_id`),
  KEY `fk_work_info_file_ref_file_type1_idx` (`file_type_id`),
  CONSTRAINT `fk_work_info_file_ref_file_type1` FOREIGN KEY (`file_type_id`) REFERENCES `ref_file_type` (`file_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_file_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_info_file_work_info1` FOREIGN KEY (`work_info_id_pri`) REFERENCES `work_info` (`work_info_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_info_file
-- ----------------------------

-- ----------------------------
-- Table structure for work_process
-- ----------------------------
DROP TABLE IF EXISTS `work_process`;
CREATE TABLE `work_process` (
  `work_process_id_pri` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_info_id_pri` bigint(20) unsigned NOT NULL,
  `work_process_id` varchar(50) DEFAULT NULL,
  `work_process_no` varchar(50) DEFAULT NULL,
  `work_process_no_2` varchar(50) DEFAULT NULL,
  `work_process_no_3` int(11) DEFAULT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL COMMENT 'ผู้ส่ง',
  `dep_id_pri` int(10) unsigned NOT NULL COMMENT 'หน่วยงานที่ส่ง',
  `dep_off_id` int(10) unsigned DEFAULT NULL COMMENT 'ส่งถึงตำแหน่ง',
  `work_process_id_to` int(11) DEFAULT NULL COMMENT 'ที่ส่งต่อ',
  `work_process_date` date DEFAULT NULL COMMENT 'work_info_date วันที่ส่งหนังสือ หลัก',
  `special_command_id` int(10) unsigned DEFAULT '1',
  `work_process_receive_id` int(11) DEFAULT NULL COMMENT 'เลขทะเบียนรับ',
  `work_process_receive_date` datetime DEFAULT NULL,
  `work_process_receive` tinyint(4) DEFAULT NULL COMMENT '0 = ยังไม่รับ, 1 = รับแล้ว, 2 = รอเปิด(ส่งหน่วยงานเดียวกัน)',
  `work_process_receive_user_id` int(11) DEFAULT NULL,
  `work_process_receive_name` varchar(100) DEFAULT NULL COMMENT 'ชื่อผู้รับ',
  `work_process_receive_comment` text,
  `work_process_sendtype` tinyint(4) DEFAULT '1' COMMENT '1 ส่งปกติ 2 ส่งแบบจัดเรียง',
  `work_process_sendstatus` tinyint(4) DEFAULT '0' COMMENT '0 = รอส่งต่อ , 1 = ส่งต่อ , 2 = ยังไม่ได้ส่ง (ไม่เห็นเรื่อง)',
  `work_process_sort` int(11) DEFAULT '0' COMMENT 'ลำดับการส่ง',
  `work_process_receive_signature` varchar(255) DEFAULT NULL,
  `work_process_receive_signature_name` varchar(255) DEFAULT NULL,
  `work_process_receive_signature_date` datetime DEFAULT NULL,
  `work_process_receive_signature_key` varchar(255) DEFAULT NULL,
  `work_process_receive_commentback` varchar(255) DEFAULT NULL,
  `work_process_status_id` tinyint(4) DEFAULT '1' COMMENT '0 ดึงเรื่องกลับ 1 ปกติ 2 ส่งตีกลับ || 3 รับตีกลับ',
  `work_process_act_for_flag` tinyint(4) DEFAULT '0',
  `work_process_act_for_position` varchar(255) DEFAULT NULL,
  `work_process_active_id` tinyint(4) DEFAULT '1' COMMENT '0 สร้างจากหนังสือรับ ภายใน ภายนอก',
  `work_user_id` bigint(20) unsigned DEFAULT NULL,
  `work_process_create` datetime DEFAULT NULL,
  `work_process_update` datetime DEFAULT NULL,
  PRIMARY KEY (`work_process_id_pri`),
  KEY `fk_work_process_work_info1_idx` (`work_info_id_pri`),
  KEY `fk_work_process_year1_idx` (`year_id`),
  KEY `fk_work_process_dep_off1_idx` (`dep_off_id`),
  KEY `fk_work_process_department1_idx` (`dep_id_pri`),
  KEY `fk_work_process_user1_idx` (`user_id`),
  KEY `fk_special_command_id1` (`special_command_id`),
  CONSTRAINT `fk_special_command_id1` FOREIGN KEY (`special_command_id`) REFERENCES `ref_special_command` (`special_command_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_work_process_dep_off1` FOREIGN KEY (`dep_off_id`) REFERENCES `dep_off` (`dep_off_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_work_process_department1` FOREIGN KEY (`dep_id_pri`) REFERENCES `department` (`dep_id_pri`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_work_process_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_work_process_work_info1` FOREIGN KEY (`work_info_id_pri`) REFERENCES `work_info` (`work_info_id_pri`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_work_process_year1` FOREIGN KEY (`year_id`) REFERENCES `year` (`year_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_process
-- ----------------------------

-- ----------------------------
-- Table structure for work_process_file
-- ----------------------------
DROP TABLE IF EXISTS `work_process_file`;
CREATE TABLE `work_process_file` (
  `work_process_file_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_process_id_pri` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `work_process_file_send` tinyint(4) DEFAULT NULL COMMENT '1 ต้นทางอัพเพิ่ม 2 ปลายทางอัพเพิ่ม',
  `work_process_file_path` varchar(255) DEFAULT NULL,
  `work_process_file_oldname` varchar(255) DEFAULT NULL,
  `work_process_file_name` varchar(255) DEFAULT NULL,
  `file_type_id` int(11) NOT NULL,
  `work_process_file_active` tinyint(4) DEFAULT '1' COMMENT '0 = ไม่ใช้งาน, 1 = ใช้งาน',
  `work_process_file_create` datetime DEFAULT NULL,
  `work_process_file_update` datetime DEFAULT NULL,
  PRIMARY KEY (`work_process_file_id`),
  KEY `fk_work_process_file_work_process1_idx` (`work_process_id_pri`),
  KEY `fk_work_process_file_ref_file_type1_idx` (`file_type_id`),
  KEY `fk_work_process_file_user1_idx` (`user_id`),
  CONSTRAINT `fk_work_process_file_ref_file_type1` FOREIGN KEY (`file_type_id`) REFERENCES `ref_file_type` (`file_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_process_file_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_process_file_work_process1` FOREIGN KEY (`work_process_id_pri`) REFERENCES `work_process` (`work_process_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_process_file
-- ----------------------------

-- ----------------------------
-- Table structure for work_user
-- ----------------------------
DROP TABLE IF EXISTS `work_user`;
CREATE TABLE `work_user` (
  `work_user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_info_id_pri` bigint(20) unsigned NOT NULL,
  `work_process_id_pri` bigint(20) unsigned NOT NULL,
  `work_user_giver_id` int(10) DEFAULT NULL,
  `year_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL COMMENT 'ผู้รับการมอบหมาย',
  `work_user_status_id` tinyint(4) unsigned DEFAULT NULL COMMENT '1 รอดำเนินการ 2 เปิดแล้ว 3 เสร็จสิ้น',
  `work_user_comment` text,
  `work_user_report` text,
  `work_user_signature` varchar(255) DEFAULT NULL,
  `work_user_signature_name` varchar(255) DEFAULT NULL,
  `work_user_signature_date` datetime DEFAULT NULL,
  `work_user_signature_key` varchar(255) DEFAULT NULL,
  `work_user_startdate` datetime DEFAULT NULL,
  `work_user_enddate` datetime DEFAULT NULL,
  `work_user_create` datetime DEFAULT NULL,
  `work_user_update` datetime DEFAULT NULL,
  PRIMARY KEY (`work_user_id`),
  KEY `fk_work_user_work_process1_idx` (`work_process_id_pri`),
  KEY `fk_work_user_work_info1_idx` (`work_info_id_pri`),
  KEY `fk_work_user_year1_idx` (`year_id`),
  KEY `fk_work_user_user1_idx` (`user_id`),
  KEY `fk_work_user_status_id1` (`work_user_status_id`),
  CONSTRAINT `fk_work_user_status_id1` FOREIGN KEY (`work_user_status_id`) REFERENCES `ref_work_user_status` (`work_user_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_user_work_info1` FOREIGN KEY (`work_info_id_pri`) REFERENCES `work_info` (`work_info_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_user_work_process1` FOREIGN KEY (`work_process_id_pri`) REFERENCES `work_process` (`work_process_id_pri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_user_year1` FOREIGN KEY (`year_id`) REFERENCES `year` (`year_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_user
-- ----------------------------

-- ----------------------------
-- Table structure for work_user_file
-- ----------------------------
DROP TABLE IF EXISTS `work_user_file`;
CREATE TABLE `work_user_file` (
  `work_user_file_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `work_user_id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `work_user_file_path` varchar(255) DEFAULT NULL,
  `work_user_file_oldname` varchar(255) DEFAULT NULL,
  `work_user_file_name` varchar(255) DEFAULT NULL,
  `file_type_id` int(11) NOT NULL,
  `work_user_file_active` tinyint(4) DEFAULT '1' COMMENT '0 = ไม่ใช้งาน, 1 = ใช้งาน',
  `work_user_file_create` datetime DEFAULT NULL,
  `work_user_file_update` datetime DEFAULT NULL,
  PRIMARY KEY (`work_user_file_id`),
  KEY `fk_work_user_file_work_user1_idx` (`work_user_id`),
  KEY `fk_work_user_file_user1_idx` (`user_id`),
  KEY `fk_work_user_file_ref_file_type1_idx` (`file_type_id`),
  CONSTRAINT `fk_work_user_file_ref_file_type1` FOREIGN KEY (`file_type_id`) REFERENCES `ref_file_type` (`file_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_user_file_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_user_file_work_user1` FOREIGN KEY (`work_user_id`) REFERENCES `work_user` (`work_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of work_user_file
-- ----------------------------

-- ----------------------------
-- Table structure for year
-- ----------------------------
DROP TABLE IF EXISTS `year`;
CREATE TABLE `year` (
  `year_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` varchar(10) DEFAULT NULL,
  `year_th` varchar(20) DEFAULT NULL,
  `year_en` varchar(20) DEFAULT NULL,
  `year_start` date DEFAULT NULL,
  `year_end` date DEFAULT NULL,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of year
-- ----------------------------
INSERT INTO `year` VALUES ('1', '2564', 'พศ.2564', 'คศ.2021', '2021-01-01', '2021-12-31');
INSERT INTO `year` VALUES ('2', '2565', 'พศ.2565', 'คศ.2022', '2022-01-01', '2022-12-31');
