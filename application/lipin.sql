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
  `logo` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'logo',
  `pic` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '相册',
  `video` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '视频',
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
  `tagid` varchar(100) NOT NULL DEFAULT '0' COMMENT 'NFC标签ID',
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
  `user_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '' COMMENT 'user_name',
  `mobile` char(15) NULL COMMENT 'mobile',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态，0-禁止，1-允许',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `active_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活跃时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `imei` (`imei`) USING BTREE,
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
  `tagid` varchar(100) NOT NULL DEFAULT '0' COMMENT 'NFC标签ID',
  `imei` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '' COMMENT '设备imei',
  `mobile` char(15) NULL COMMENT 'mobile',
  `longitude` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '' COMMENT '经度',
  `latitude` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '' COMMENT '纬度',
  `request_ip` bigint(20) NULL DEFAULT '0' COMMENT '请求IP',
  `color` varchar(20) NULL DEFAULT '0' COMMENT '请求IP',
  `result` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '' COMMENT 'result',
  `create_time` int(10) unsigned NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='请求日志表';

-- ----------------------------
-- Records of lipin_validation_log
-- ----------------------------

-- ----------------------------
-- Table structure for `lipin_release`
-- ----------------------------
DROP TABLE IF EXISTS `lipin_release`;
CREATE TABLE `lipin_release` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ver` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'ver',
  `url` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'url',
  `size` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'size',
  `md5` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'md5',
  `text` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'text',
  `type` tinyint(4) DEFAULT '0' COMMENT '类型，0-稳定版，1-测试版，2-重要版',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='软件发布表';

-- ----------------------------
-- Records of lipin_release
-- ----------------------------

