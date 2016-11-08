/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : lipin

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2016-10-21 01:16:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `lipin_info`
-- ----------------------------
DROP TABLE IF EXISTS `lipin_info`;
CREATE TABLE `lipin_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL COMMENT '产品名称',
  `begin` bigint(20) NOT NULL DEFAULT '0' COMMENT 'begin',
  `end` bigint(20) NOT NULL DEFAULT '0' COMMENT 'end',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'content',
  `pic` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '相册',
  `video` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '视频列表',
  `author` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'author',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='资料库表';

-- ----------------------------
-- Records of lipin_info
-- ----------------------------


-- ----------------------------
-- Table structure for `lipin_tag`
-- ----------------------------
DROP TABLE IF EXISTS `lipin_tag`;
CREATE TABLE `lipin_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属资料库ID',
  `tagid` bigint(20) NOT NULL DEFAULT '0' COMMENT 'NFC标签ID',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态，0-停用，1-启用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tagid` (`tagid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='标签库表';

-- ----------------------------
-- Records of lipin_tag
-- ----------------------------


-- ----------------------------
-- Table structure for `lipin_device`
-- ----------------------------
DROP TABLE IF EXISTS `lipin_device`;
CREATE TABLE `lipin_device` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imei` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '设备imei',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态，0-禁止，1-通过',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='设备表';

-- ----------------------------
-- Records of lipin_device
-- ----------------------------


-- ----------------------------
-- Table structure for `lipin_device`
-- ----------------------------
DROP TABLE IF EXISTS `lipin_validation_log`;
CREATE TABLE `lipin_validation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagid` int(10) unsigned NULL DEFAULT '0' COMMENT 'NFC标签ID',
  `imei` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '设备imei',
  `longitude` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '经度',
  `latitude` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '纬度',
  `request_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '请求IP',
  `result` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'result',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='请求日志表';

-- ----------------------------
-- Records of lipin_validation_log
-- ----------------------------