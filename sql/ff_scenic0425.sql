/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : fufeng

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2018-04-25 17:20:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ff_scenic_car`
-- ----------------------------
DROP TABLE IF EXISTS `ff_scenic_car`;
CREATE TABLE `ff_scenic_car` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `s_date` int(11) NOT NULL COMMENT '日期',
  `car_num` int(11) NOT NULL DEFAULT '0' COMMENT '当天车流量',
  `yesterday_total` int(11) NOT NULL DEFAULT '0' COMMENT '昨日车流量',
  `month_total` int(11) NOT NULL DEFAULT '0' COMMENT '本月车流量',
  `year_total` int(11) NOT NULL DEFAULT '0' COMMENT '本年度车流量',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='景区车流量汇总表（每天）';

-- ----------------------------
-- Records of ff_scenic_car
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_scenic_car_real`
-- ----------------------------
DROP TABLE IF EXISTS `ff_scenic_car_real`;
CREATE TABLE `ff_scenic_car_real` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `s_date` int(11) NOT NULL COMMENT '日期',
  `s_time` int(11) NOT NULL COMMENT '时间戳',
  `car_num` int(11) NOT NULL DEFAULT '0' COMMENT '车辆数',
  `car_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '车辆类型 1小车 2中巴车 3大巴车',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='景区车流实时表';

-- ----------------------------
-- Records of ff_scenic_car_real
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_scenic_car_stay`
-- ----------------------------
DROP TABLE IF EXISTS `ff_scenic_car_stay`;
CREATE TABLE `ff_scenic_car_stay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phase_type` tinyint(1) NOT NULL COMMENT '时间段类型ID',
  `vehicle_num` int(11) NOT NULL COMMENT '停车数量',
  `remain_time` int(11) NOT NULL DEFAULT '0' COMMENT '停车总时长',
  `s_date` int(11) NOT NULL DEFAULT '0' COMMENT '当前日期',
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='车辆停留时长汇总表（每天）';

-- ----------------------------
-- Records of ff_scenic_car_stay
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_scenic_flow_area`
-- ----------------------------
DROP TABLE IF EXISTS `ff_scenic_flow_area`;
CREATE TABLE `ff_scenic_flow_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_date` int(11) NOT NULL COMMENT '日期',
  `province_id` int(11) NOT NULL COMMENT '省份id 关联area表',
  `city_id` int(11) NOT NULL COMMENT '城市id 关联area表',
  `user_num` int(11) NOT NULL DEFAULT '0' COMMENT '景区游客数',
  `car_num` int(11) NOT NULL DEFAULT '0' COMMENT '车流量',
  `car_stay` float(3,0) NOT NULL DEFAULT '0' COMMENT '车平均停留时长',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='景区客源地、车源地表（每天）';

-- ----------------------------
-- Records of ff_scenic_flow_area
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_scenic_flow_day`
-- ----------------------------
DROP TABLE IF EXISTS `ff_scenic_flow_day`;
CREATE TABLE `ff_scenic_flow_day` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_date` int(11) NOT NULL COMMENT '日期',
  `scenic_id` int(11) NOT NULL COMMENT '景区id 关联景区表',
  `user_num` int(11) NOT NULL DEFAULT '0' COMMENT '景区游客人数',
  `car_num` int(11) NOT NULL DEFAULT '0' COMMENT '景区车流量',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='景区客流量、车流量表（每天）';

-- ----------------------------
-- Records of ff_scenic_flow_day
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_ticket_channel`
-- ----------------------------
DROP TABLE IF EXISTS `ff_ticket_channel`;
CREATE TABLE `ff_ticket_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` tinyint(4) NOT NULL COMMENT '渠道id 0、窗口 1、自助机 2、携程 3、美团 4、驴妈妈 5、其他',
  `user_num` int(11) NOT NULL DEFAULT '0' COMMENT '订票数量',
  `s_date` int(11) NOT NULL COMMENT '日期',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='票务预订渠道统计';

-- ----------------------------
-- Records of ff_ticket_channel
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_ticket_day`
-- ----------------------------
DROP TABLE IF EXISTS `ff_ticket_day`;
CREATE TABLE `ff_ticket_day` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_date` int(11) NOT NULL COMMENT '日期',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '当天售票总量',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='票务每日汇总（用于存储以往每天售票量信息）';

-- ----------------------------
-- Records of ff_ticket_day
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_ticket_pay`
-- ----------------------------
DROP TABLE IF EXISTS `ff_ticket_pay`;
CREATE TABLE `ff_ticket_pay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_date` int(11) NOT NULL COMMENT '日期',
  `alipay` int(11) NOT NULL DEFAULT '0' COMMENT '支付宝支付数量',
  `weichat` int(11) NOT NULL DEFAULT '0' COMMENT '微信支付数量',
  `cash` int(11) NOT NULL DEFAULT '0' COMMENT '现金支数量',
  `other` int(11) NOT NULL DEFAULT '0' COMMENT '其他支付方式数量',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付方式统计';

-- ----------------------------
-- Records of ff_ticket_pay
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_ticket_reservations`
-- ----------------------------
DROP TABLE IF EXISTS `ff_ticket_reservations`;
CREATE TABLE `ff_ticket_reservations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `day_phase` tinyint(4) NOT NULL COMMENT '提前天数 0、0天；1、1天;2、2天;3、3天;4、3天以上',
  `user_num` int(11) NOT NULL COMMENT '购票数',
  `s_date` int(11) NOT NULL COMMENT '日期',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提前购票天数每天统计';

-- ----------------------------
-- Records of ff_ticket_reservations
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_ticket_total`
-- ----------------------------
DROP TABLE IF EXISTS `ff_ticket_total`;
CREATE TABLE `ff_ticket_total` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_date` int(11) NOT NULL COMMENT '日期',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '当天票务总收入',
  `total` int(11) NOT NULL DEFAULT '0' COMMENT '当天销售门票总张数',
  `network_total` int(11) NOT NULL DEFAULT '0' COMMENT '当天网络销售门票总张数',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='票务每日汇总表（用于存储当天实时数据）';

-- ----------------------------
-- Records of ff_ticket_total
-- ----------------------------

-- ----------------------------
-- Table structure for `ff_ticket_type_day`
-- ----------------------------
DROP TABLE IF EXISTS `ff_ticket_type_day`;
CREATE TABLE `ff_ticket_type_day` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_date` int(11) NOT NULL COMMENT '日期',
  `total_ticket` int(11) NOT NULL DEFAULT '0' COMMENT '当天总售票量',
  `individual_num` int(11) NOT NULL DEFAULT '0' COMMENT '当天散客票售票量',
  `group_num` int(11) NOT NULL DEFAULT '0' COMMENT '当天团队票售票量',
  `activity_num` int(11) NOT NULL DEFAULT '0' COMMENT '当天活动票售票量',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='售票类型每天统计';

-- ----------------------------
-- Records of ff_ticket_type_day
-- ----------------------------
