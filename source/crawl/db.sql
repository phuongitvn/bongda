/*
Navicat MySQL Data Transfer

Source Server         : 10.0.0.89
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : yiilab

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-01-17 15:23:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_crawl_category
-- ----------------------------
DROP TABLE IF EXISTS `tbl_crawl_category`;
CREATE TABLE `tbl_crawl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url_key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `site` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0: deactive; 1:active',
  `created_datetime` datetime DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_crawl_category_url
-- ----------------------------
DROP TABLE IF EXISTS `tbl_crawl_category_url`;
CREATE TABLE `tbl_crawl_category_url` (
  `url_crawl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) NOT NULL,
  `site` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`url_crawl`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_crawl_content
-- ----------------------------
DROP TABLE IF EXISTS `tbl_crawl_content`;
CREATE TABLE `tbl_crawl_content` (
  `url_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url_key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `avatar_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_crawl_url
-- ----------------------------
DROP TABLE IF EXISTS `tbl_crawl_url`;
CREATE TABLE `tbl_crawl_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `site` varchar(255) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) DEFAULT '0',
  `created_datetime` datetime DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: not crawl; 1:crawled',
  `avatar_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
