/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : lao_z

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-09-28 00:07:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_fy_flag
-- ----------------------------
DROP TABLE IF EXISTS `t_fy_flag`;
CREATE TABLE `t_fy_flag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flag` varchar(8) CHARACTER SET utf8 NOT NULL COMMENT '标签',
  PRIMARY KEY (`id`,`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_fy_flag
-- ----------------------------

-- ----------------------------
-- Table structure for t_fy_info
-- ----------------------------
DROP TABLE IF EXISTS `t_fy_info`;
CREATE TABLE `t_fy_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `real_estate_name` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '楼盘名称',
  `province` smallint(6) DEFAULT NULL COMMENT '省',
  `city` smallint(6) DEFAULT NULL COMMENT '市',
  `area` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '区域',
  `business_scope` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '商圈',
  `shop_type` tinyint(4) DEFAULT NULL COMMENT '商铺类型',
  `office_buildings_type` tinyint(4) DEFAULT NULL COMMENT '写字楼类型',
  `property_level` tinyint(4) DEFAULT NULL COMMENT '物业评级',
  `usage_type` tinyint(4) DEFAULT NULL COMMENT '规划用途',
  `address` varchar(128) CHARACTER SET utf8 DEFAULT NULL COMMENT '地址',
  `hao_wei` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '号位',
  `suggest_management` varchar(128) CHARACTER SET utf8 DEFAULT NULL COMMENT '适合经营',
  `property_fee` int(11) DEFAULT NULL COMMENT '物业费，单位角',
  `building_pos_type` tinyint(4) DEFAULT NULL COMMENT '房源位置类型',
  `uint_no` smallint(6) DEFAULT NULL COMMENT '单元/号',
  `floor_no` smallint(6) DEFAULT NULL COMMENT '几楼',
  `room_no` smallint(6) DEFAULT NULL COMMENT '几室',
  `villa_type` tinyint(4) DEFAULT NULL COMMENT '别墅建筑类型',
  `residence_type` tinyint(4) DEFAULT NULL COMMENT '住宅建筑类型',
  `hx_room_count` tinyint(4) DEFAULT NULL COMMENT '(数量)几室',
  `hx_ting_count` tinyint(4) DEFAULT NULL COMMENT '(数量)几厅',
  `hx_wei_count` tinyint(4) DEFAULT NULL COMMENT '(数量)几卫',
  `hx_yangtai_count` tinyint(4) DEFAULT NULL COMMENT '(数量)几阳台',
  `building_areas` int(11) DEFAULT NULL COMMENT '建筑面积，单位平方厘米',
  `basement_areas` int(11) DEFAULT NULL COMMENT '地下面积，单位平方厘米',
  `garden_areas` int(11) DEFAULT NULL COMMENT '花园面积，单位平方厘米',
  `sunshine_type` tinyint(4) DEFAULT NULL COMMENT '全明,半明,暗',
  `chewei_count` tinyint(4) DEFAULT NULL COMMENT '车位数量',
  `sell` int(11) DEFAULT NULL COMMENT '售价，单位角',
  `floor_price` int(11) DEFAULT NULL COMMENT '底价，单位角',
  `building_valid_date` datetime DEFAULT NULL,
  `zhuangxiu_type` tinyint(4) DEFAULT NULL COMMENT '装修情况',
  `at_floor_no` smallint(6) DEFAULT NULL COMMENT '所在楼层',
  `total_floors` smallint(6) DEFAULT NULL COMMENT '总共层数',
  `one_floor_ti` tinyint(4) DEFAULT NULL COMMENT '单层户数:梯',
  `one_floor_hu` tinyint(4) DEFAULT NULL COMMENT '单层户数:户',
  `ting_structure` tinyint(4) DEFAULT NULL COMMENT '厅结构',
  `building_own_type` tinyint(4) DEFAULT NULL COMMENT '房屋权属',
  `got_certificate_date` datetime DEFAULT NULL COMMENT '出证日期',
  `building_direction` tinyint(4) DEFAULT NULL COMMENT '朝向',
  `is_linjie` tinyint(4) DEFAULT NULL COMMENT '是否临街',
  `building_year` date DEFAULT NULL COMMENT '建筑年代',
  `building_structure` tinyint(4) DEFAULT NULL COMMENT '建筑结构',
  `getout_date` datetime DEFAULT NULL COMMENT '腾房日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_fy_info
-- ----------------------------

-- ----------------------------
-- Table structure for t_fy_manager_info
-- ----------------------------
DROP TABLE IF EXISTS `t_fy_manager_info`;
CREATE TABLE `t_fy_manager_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_channel` tinyint(4) NOT NULL COMMENT '来源渠道',
  `level` tinyint(4) NOT NULL COMMENT '级别',
  `plate_type` tinyint(4) NOT NULL COMMENT '盘别',
  `pos_type` tinyint(4) NOT NULL COMMENT '收款方式',
  `gei_yong` tinyint(4) NOT NULL COMMENT '是否给佣',
  `des` varchar(256) CHARACTER SET utf8 DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_fy_manager_info
-- ----------------------------

-- ----------------------------
-- Table structure for t_fy_onwer_info
-- ----------------------------
DROP TABLE IF EXISTS `t_fy_onwer_info`;
CREATE TABLE `t_fy_onwer_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) CHARACTER SET utf8 NOT NULL COMMENT '业主姓名',
  `gender` tinyint(4) NOT NULL COMMENT '~性别',
  `card` varchar(18) NOT NULL COMMENT '~身份证',
  `tel_type` tinyint(4) DEFAULT NULL COMMENT '电话类型',
  `tel` varchar(32) DEFAULT NULL COMMENT '电话',
  `standby_tel_type` tinyint(4) DEFAULT NULL COMMENT '备用~',
  `standby_tel` varchar(32) DEFAULT NULL COMMENT '备用~',
  `share_name` varchar(16) CHARACTER SET utf8 DEFAULT NULL COMMENT '共有人~',
  `share_gender` tinyint(4) DEFAULT NULL COMMENT '共有人~',
  `share_card` varchar(18) DEFAULT NULL COMMENT '共有人~',
  `share_tel_type` tinyint(4) DEFAULT NULL COMMENT '共有人~',
  `share_tel` varchar(32) DEFAULT NULL COMMENT '共有人~',
  `owner_type` tinyint(4) DEFAULT NULL COMMENT '业主类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_fy_onwer_info
-- ----------------------------

-- ----------------------------
-- Table structure for t_fy_publish_info
-- ----------------------------
DROP TABLE IF EXISTS `t_fy_publish_info`;
CREATE TABLE `t_fy_publish_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) CHARACTER SET utf8 NOT NULL,
  `des` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `flag` varchar(128) NOT NULL DEFAULT '' COMMENT '不能有中文',
  `indoor_pics` varchar(512) NOT NULL DEFAULT '' COMMENT '不能有中文',
  `consist_pics` varchar(128) NOT NULL DEFAULT '' COMMENT '不能有中文',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_fy_publish_info
-- ----------------------------

-- ----------------------------
-- Table structure for t_fy_validation_info
-- ----------------------------
DROP TABLE IF EXISTS `t_fy_validation_info`;
CREATE TABLE `t_fy_validation_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property_card` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT '产权证号',
  `validation_no` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT '核验编号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_fy_validation_info
-- ----------------------------
