/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50635
 Source Host           : localhost
 Source Database       : fufeng

 Target Server Type    : MySQL
 Target Server Version : 50635
 File Encoding         : utf-8

 Date: 03/24/2018 11:33:24 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ff_action`
-- ----------------------------
DROP TABLE IF EXISTS `ff_action`;
CREATE TABLE `ff_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `title` char(80) NOT NULL DEFAULT '',
  `remark` char(140) NOT NULL DEFAULT '',
  `rule` text NOT NULL,
  `log` text NOT NULL,
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_action_log`
-- ----------------------------
DROP TABLE IF EXISTS `ff_action_log`;
CREATE TABLE `ff_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `action_ip` bigint(20) NOT NULL,
  `model` varchar(50) NOT NULL DEFAULT '',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`) USING BTREE,
  KEY `action_id_ix` (`action_id`) USING BTREE,
  KEY `user_id_ix` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=575 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_admin`
-- ----------------------------
DROP TABLE IF EXISTS `ff_admin`;
CREATE TABLE `ff_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `nickname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `login` int(11) NOT NULL DEFAULT '0' COMMENT '用户登录次数',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
--  Records of `ff_admin`
-- ----------------------------
BEGIN;
INSERT INTO `ff_admin` VALUES ('1', 'admin', '97bf21e69b87454906dff353df50eee7', 'admin', 'huojx@xiaomaiquan.cn', '', '1507623805', '2130706433', '1516071242', '2130706433', '15', '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ff_auth_extend`
-- ----------------------------
DROP TABLE IF EXISTS `ff_auth_extend`;
CREATE TABLE `ff_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL,
  `extend_id` mediumint(8) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`) USING BTREE,
  KEY `uid` (`group_id`) USING BTREE,
  KEY `group_id` (`extend_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `ff_auth_group`;
CREATE TABLE `ff_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `title` char(20) NOT NULL DEFAULT '',
  `description` varchar(80) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ff_auth_group`
-- ----------------------------
BEGIN;
INSERT INTO `ff_auth_group` VALUES ('1', 'admin', '1', '管理员', '', '1', '14,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,60,61,62,63,72,73,74,75,76,77,78,79,80,83,84,85,86,89,94,95,98,100,117,123,126,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,145,146,147,148,149,150,152,153,154,155,157,158,159,161,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,201,202,203,204,205,206,207,208,210,211,212,214,215,216,217,218,219,222,223,224,225,226,227,24');
COMMIT;

-- ----------------------------
--  Table structure for `ff_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `ff_auth_group_access`;
CREATE TABLE `ff_auth_group_access` (
  `uid` int(10) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `group_id` (`group_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ff_auth_group_access`
-- ----------------------------
BEGIN;
INSERT INTO `ff_auth_group_access` VALUES ('1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ff_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `ff_auth_rule`;
CREATE TABLE `ff_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `type` tinyint(2) NOT NULL DEFAULT '1',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=265 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_config`
-- ----------------------------
DROP TABLE IF EXISTS `ff_config`;
CREATE TABLE `ff_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `extra` varchar(255) NOT NULL DEFAULT '',
  `remark` varchar(100) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `value` text NOT NULL,
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `group` (`group`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_menu`
-- ----------------------------
DROP TABLE IF EXISTS `ff_menu`;
CREATE TABLE `ff_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL DEFAULT '',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tip` varchar(255) NOT NULL DEFAULT '',
  `group` varchar(50) DEFAULT '',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=312 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ff_menu`
-- ----------------------------
BEGIN;
INSERT INTO `ff_menu` VALUES ('1', '首页', '0', '1', 'Index/index', '0', '', '', '1'), ('3', '文档列表', '2', '0', 'article/index', '1', '', '内容', '0'), ('4', '新增', '3', '0', 'article/add', '0', '', '', '0'), ('5', '编辑', '3', '0', 'article/edit', '0', '', '', '0'), ('6', '改变状态', '3', '0', 'article/setStatus', '0', '', '', '0'), ('7', '保存', '3', '0', 'article/update', '0', '', '', '0'), ('8', '保存草稿', '3', '0', 'article/autoSave', '0', '', '', '0'), ('9', '移动', '3', '0', 'article/move', '0', '', '', '0'), ('10', '复制', '3', '0', 'article/copy', '0', '', '', '0'), ('11', '粘贴', '3', '0', 'article/paste', '0', '', '', '0'), ('12', '导入', '3', '0', 'article/batchOperate', '0', '', '', '0'), ('13', '回收站', '2', '0', 'article/recycle', '1', '', '内容', '0'), ('14', '还原', '13', '0', 'article/permit', '0', '', '', '0'), ('15', '清空', '13', '0', 'article/clear', '0', '', '', '0'), ('16', '用户中心', '0', '11', 'User/index', '0', '', '', '0'), ('17', '我的信息', '16', '0', 'User/index', '0', '', '用户管理', '0'), ('18', '新增用户', '17', '0', 'User/addData', '0', '添加新用户', '', '0'), ('19', '用户行为', '16', '0', 'User/action', '1', '', '行为管理', '0'), ('20', '新增用户行为', '19', '0', 'User/addaction', '0', '', '', '0'), ('21', '编辑用户行为', '19', '0', 'User/editaction', '0', '', '', '0'), ('22', '保存用户行为', '19', '0', 'User/saveAction', '0', '\"用户->用户行为\"保存编辑和新增的用户行为', '', '0'), ('23', '变更行为状态', '19', '0', 'User/setStatus', '0', '\"用户->用户行为\"中的启用,禁用和删除权限', '', '0'), ('24', '禁用会员', '19', '0', 'User/changeStatus?method=forbidUser', '0', '\"用户->用户信息\"中的禁用', '', '0'), ('25', '启用会员', '19', '0', 'User/changeStatus?method=resumeUser', '0', '\"用户->用户信息\"中的启用', '', '0'), ('26', '删除会员', '19', '0', 'User/changeStatus?method=deleteUser', '0', '\"用户->用户信息\"中的删除', '', '0'), ('27', '权限管理', '16', '0', 'AuthManager/index', '0', '', '用户管理', '0'), ('28', '删除', '27', '0', 'AuthManager/changeStatus?method=deleteGroup', '0', '删除用户组', '', '0'), ('29', '禁用', '27', '0', 'AuthManager/changeStatus?method=forbidGroup', '0', '禁用用户组', '', '0'), ('30', '恢复', '27', '0', 'AuthManager/changeStatus?method=resumeGroup', '0', '恢复已禁用的用户组', '', '0'), ('31', '新增', '27', '0', 'AuthManager/createGroup', '0', '创建新的用户组', '', '0'), ('32', '编辑', '27', '0', 'AuthManager/editGroup', '0', '编辑用户组名称和描述', '', '0'), ('33', '保存用户组', '27', '0', 'AuthManager/writeGroup', '0', '新增和编辑用户组的\"保存\"按钮', '', '0'), ('34', '授权', '27', '0', 'AuthManager/group', '0', '\"后台 \\ 用户 \\ 用户信息\"列表页的\"授权\"操作按钮,用于设置用户所属用户组', '', '0'), ('35', '访问授权', '27', '0', 'AuthManager/access', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"访问授权\"操作按钮', '', '0'), ('36', '成员授权', '27', '0', 'AuthManager/user', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"成员授权\"操作按钮', '', '0'), ('37', '解除授权', '27', '0', 'AuthManager/removeFromGroup', '0', '\"成员授权\"列表页内的解除授权操作按钮', '', '0'), ('38', '保存成员授权', '27', '0', 'AuthManager/addToGroup', '0', '\"用户信息\"列表页\"授权\"时的\"保存\"按钮和\"成员授权\"里右上角的\"添加\"按钮)', '', '0'), ('39', '分类授权', '27', '0', 'AuthManager/category', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"分类授权\"操作按钮', '', '0'), ('40', '保存分类授权', '27', '0', 'AuthManager/addToCategory', '0', '\"分类授权\"页面的\"保存\"按钮', '', '0'), ('41', '模型授权', '27', '0', 'AuthManager/modelauth', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"模型授权\"操作按钮', '', '0'), ('42', '保存模型授权', '27', '0', 'AuthManager/addToModel', '0', '\"分类授权\"页面的\"保存\"按钮', '', '0'), ('44', '插件管理', '43', '1', 'Addons/index', '0', '', '扩展', '0'), ('45', '创建', '44', '0', 'Addons/create', '0', '服务器上创建插件结构向导', '', '0'), ('46', '检测创建', '44', '0', 'Addons/checkForm', '0', '检测插件是否可以创建', '', '0'), ('47', '预览', '44', '0', 'Addons/preview', '0', '预览插件定义类文件', '', '0'), ('48', '快速生成插件', '44', '0', 'Addons/build', '0', '开始生成插件结构', '', '0'), ('49', '设置', '44', '0', 'Addons/config', '0', '设置插件配置', '', '0'), ('50', '禁用', '44', '0', 'Addons/disable', '0', '禁用插件', '', '0'), ('51', '启用', '44', '0', 'Addons/enable', '0', '启用插件', '', '0'), ('52', '安装', '44', '0', 'Addons/install', '0', '安装插件', '', '0'), ('53', '卸载', '44', '0', 'Addons/uninstall', '0', '卸载插件', '', '0'), ('54', '更新配置', '44', '0', 'Addons/saveconfig', '0', '更新插件配置处理', '', '0'), ('55', '插件后台列表', '44', '0', 'Addons/adminList', '0', '', '', '0'), ('56', 'URL方式访问插件', '44', '0', 'Addons/execute', '0', '控制是否有权限通过url访问插件控制器方法', '', '0'), ('57', '钩子管理', '43', '2', 'Addons/hooks', '0', '', '扩展', '0'), ('59', '新增', '58', '0', 'model/add', '0', '', '', '0'), ('60', '编辑', '58', '0', 'model/edit', '0', '', '', '0'), ('61', '改变状态', '58', '0', 'model/setStatus', '0', '', '', '0'), ('62', '保存数据', '58', '0', 'model/update', '0', '', '', '0'), ('64', '新增', '63', '0', 'Attribute/add', '0', '', '', '0'), ('65', '编辑', '63', '0', 'Attribute/edit', '0', '', '', '0'), ('66', '改变状态', '63', '0', 'Attribute/setStatus', '0', '', '', '0'), ('67', '保存数据', '63', '0', 'Attribute/update', '0', '', '', '0'), ('68', '系统', '0', '12', 'Menu/index', '0', '', '', '0'), ('69', '网站设置', '68', '1', 'Config/group', '1', '', '系统设置', '0'), ('70', '配置管理', '68', '4', 'Config/index', '1', '', '系统设置', '0'), ('71', '编辑', '70', '0', 'Config/edit', '0', '新增编辑和保存配置', '', '0'), ('72', '删除', '70', '0', 'Config/del', '0', '删除配置', '', '0'), ('73', '新增', '70', '0', 'Config/add', '0', '新增配置', '', '0'), ('74', '保存', '70', '0', 'Config/save', '0', '保存配置', '', '0'), ('75', '菜单管理', '68', '5', 'Menu/index', '0', '', '系统设置', '0'), ('77', '新增', '76', '0', 'Channel/add', '0', '', '', '0'), ('78', '编辑', '76', '0', 'Channel/edit', '0', '', '', '0'), ('79', '删除', '76', '0', 'Channel/del', '0', '', '', '0'), ('81', '编辑', '80', '0', 'Category/edit', '0', '编辑和保存栏目分类', '', '0'), ('82', '新增', '80', '0', 'Category/add', '0', '新增栏目分类', '', '0'), ('83', '删除', '80', '0', 'Category/remove', '0', '删除栏目分类', '', '0'), ('84', '移动', '80', '0', 'Category/operate/type/move', '0', '移动栏目分类', '', '0'), ('85', '合并', '80', '0', 'Category/operate/type/merge', '0', '合并栏目分类', '', '0'), ('86', '备份数据库', '68', '0', 'Database/index?type=export', '1', '', '数据备份', '0'), ('87', '备份', '86', '0', 'Database/export', '0', '备份数据库', '', '0'), ('88', '优化表', '86', '0', 'Database/optimize', '0', '优化数据表', '', '0'), ('89', '修复表', '86', '0', 'Database/repair', '0', '修复数据表', '', '0'), ('90', '还原数据库', '68', '0', 'Database/index?type=import', '1', '', '数据备份', '0'), ('91', '恢复', '90', '0', 'Database/import', '0', '数据库恢复', '', '0'), ('92', '删除', '90', '0', 'Database/del', '0', '删除备份文件', '', '0'), ('96', '新增', '75', '0', 'Menu/add', '0', '', '系统设置', '0'), ('98', '编辑', '75', '0', 'Menu/edit', '0', '', '', '0'), ('104', '下载管理', '102', '0', 'Think/lists?model=download', '0', '', '', '0'), ('105', '配置管理', '102', '0', 'Think/lists?model=config', '0', '', '', '0'), ('106', '行为日志', '16', '0', 'Action/actionlog', '1', '', '行为管理', '0'), ('108', '修改密码', '16', '0', 'User/updatePassword', '1', '', '', '0'), ('109', '修改昵称', '16', '0', 'User/updateNickname', '1', '', '', '0'), ('110', '查看行为日志', '106', '0', 'action/edit', '1', '', '', '0'), ('112', '新增数据', '58', '0', 'think/add', '1', '', '', '0'), ('113', '编辑数据', '58', '0', 'think/edit', '1', '', '', '0'), ('114', '导入', '75', '0', 'Menu/import', '0', '', '', '0'), ('115', '生成', '58', '0', 'Model/generate', '0', '', '', '0'), ('116', '新增钩子', '57', '0', 'Addons/addHook', '0', '', '', '0'), ('117', '编辑钩子', '57', '0', 'Addons/edithook', '0', '', '', '0'), ('118', '排序', '3', '0', 'Article/sort', '1', '', '', '0'), ('119', '排序', '70', '0', 'Config/sort', '1', '', '', '0'), ('120', '排序', '75', '0', 'Menu/sort', '1', '', '', '0'), ('121', '排序', '76', '0', 'Channel/sort', '1', '', '', '0'), ('127', '静态列表', '122', '1', 'Statics/index', '0', '', '静态管理', '0'), ('128', '静态列表', '127', '0', 'Static/lists', '0', '', '', '0'), ('129', '行业列表', '122', '3', 'Statics/industry_list', '0', '', '静态管理', '0'), ('130', '新增行业', '129', '1', 'Statics/industry_add', '0', '', '静态管理', '0'), ('131', '地区列表', '122', '1', 'Statics/areaList', '0', '', '静态管理', '0'), ('132', '新增地区', '131', '2', 'Statics/areaAdd', '0', '', '地区管理', '0'), ('133', '编辑地区', '131', '3', 'Statics/areaEdit', '0', '', '地区管理', '0'), ('291', '是否开发模式可见', '75', '0', 'Menu/toogleDev', '1', '', '', '0'), ('306', '删除', '75', '0', 'Menu/del', '1', '', '', '0'), ('290', '是否隐藏', '75', '0', 'Menu/toogleHide', '1', '', '', '1'), ('289', '用户信息', '16', '0', 'User/mine', '0', '', '用户管理', '0'), ('301', '保存修改密码', '16', '0', 'User/submitPassword', '1', '', '', '0'), ('302', '保存修改昵称', '16', '0', 'User/submitNickname', '1', '', '', '0'), ('311', '数据分析', '0', '2', 'Visitor/index', '0', '', '', '0');
COMMIT;

-- ----------------------------
--  Table structure for `ff_scenic`
-- ----------------------------
DROP TABLE IF EXISTS `ff_scenic`;
CREATE TABLE `ff_scenic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `icon_url` varchar(100) DEFAULT NULL COMMENT '图标',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态：1上架 下架',
  `introduce` text COMMENT '介绍',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `admin_id` int(11) DEFAULT NULL COMMENT '管理员id',
  `created` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_scenic_picture`
-- ----------------------------
DROP TABLE IF EXISTS `ff_scenic_picture`;
CREATE TABLE `ff_scenic_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '景区',
  `scenic_id` int(11) NOT NULL COMMENT '景区id',
  `path` varchar(100) NOT NULL COMMENT '图片地址',
  `created` int(11) NOT NULL COMMENT '添加时间',
  `admin_id` int(11) NOT NULL COMMENT '管理员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_scenic_spot`
-- ----------------------------
DROP TABLE IF EXISTS `ff_scenic_spot`;
CREATE TABLE `ff_scenic_spot` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '景点id',
  `scenic_id` int(11) NOT NULL COMMENT '景区id',
  `name` varchar(100) NOT NULL,
  `lng` double(10,6) DEFAULT NULL,
  `lat` double(10,6) DEFAULT NULL,
  `warning_num` int(10) DEFAULT NULL COMMENT '告警人数',
  `weight_num` int(10) DEFAULT NULL COMMENT '乘载人数',
  `dmapping` varchar(20) DEFAULT NULL COMMENT '三维图',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态：1上架 0下架',
  `created` int(10) DEFAULT NULL,
  `updated` int(10) DEFAULT NULL COMMENT '更新时间',
  `admin_id` int(10) DEFAULT NULL COMMENT '管理员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_spot_picture`
-- ----------------------------
DROP TABLE IF EXISTS `ff_spot_picture`;
CREATE TABLE `ff_spot_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '景点图片关联表',
  `spot_id` int(11) NOT NULL COMMENT '景点id',
  `path` varchar(100) NOT NULL COMMENT '路径',
  `created` int(10) DEFAULT NULL,
  `admin_id` int(10) DEFAULT NULL COMMENT '管理员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ff_user`
-- ----------------------------
DROP TABLE IF EXISTS `ff_user`;
CREATE TABLE `ff_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `username` varchar(25) DEFAULT NULL COMMENT '用户名',
  `openid` char(35) DEFAULT NULL COMMENT '关联微信唯一标识',
  `mobile` char(11) NOT NULL DEFAULT '0' COMMENT '用户手机号',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 (sex, 1:男;2:女;0:保密)',
  `nickname` varchar(100) DEFAULT NULL COMMENT '微信用户昵称',
  `headimgurl` varchar(255) DEFAULT NULL COMMENT '头像',
  `country` varchar(15) DEFAULT NULL COMMENT '用户所属国家',
  `province` varchar(20) DEFAULT NULL COMMENT '用户所属省份',
  `city` varchar(20) DEFAULT NULL COMMENT '用户所属城市',
  `token` varchar(200) DEFAULT NULL,
  `refresh_token` varchar(200) NOT NULL,
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ff_user`
-- ----------------------------
BEGIN;
INSERT INTO `ff_user` VALUES ('2', null, 'o84Y-wKM0MPZZlHkZyTbwVOUcgKo', '0', '1', 'Henry', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLeuKn5vHhUicgicd6bFTOmSw6Luic1ibUxt8ryxNCSsOIolnokLUFoqehiaywWl5tMmde3nu2Y0QS5icDA/0', '中国', '北京', '海淀', '4_7V0XybIb8QAD3ImMolRpbKV9mg_QuhZ5qsQFh88QYLKfgfKhLtYDEhbSoxhLKdCZCJLPktWa5_mit_bLC7uk6g', '4_7vOU7_lQxMWPKPpK996XvfrV7spdYlUuJDP46Mxolqdus8F8b337U4zR7vew3Xm1E-_w0D5lEh0XcXMd1RMmnA', '1512978195', '1513064511'), ('3', null, 'o84Y-wKAs6T46sn5rns5Elv2P9R4', '0', '1', '生', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKHXpDBKnp0ib3MaoeQjMU93QJVkkGwrkWGTWLUQAbplic0ndcgT6HFpNrhCL2jZEJmtKicicGecS4LTQ/0', '中国', '河北', '保定', '4__RUjeQud1tJ5m5BLHWAco9rR-dy7G-I-ybLpCRdJ_9ZV_OP5Z5wiXfBQ_3RhOJ_amSAXEJredfs0F45ioobJkC47Btu9b4Pz3cqG0Bx3oAI', '4_cPx-c6_rg_yQB4T-TFUFFD9OuBBVSyPTCjpcwwJl56pA1mYnQNeenfQTnzmdZ1i_l77RdHh6EjgDV8Cr-d-KIkf98kGIx2Fd1p2Fr3dS6u4', '1513331165', '1513331165'), ('4', null, 'o84Y-wHXVzat23NQZRnKoqzuUMAc', '0', '2', '小蜜蜂', 'http://wx.qlogo.cn/mmopen/vi_32/n8g8lJoiaibia5rABxSFTzTuJXV4XuwETVkxOqtxj7j0awB1XkhfIlaQwQK0TDjZ5eKqYaJcPtW5jxrdZseD9jBIA/0', '中国', '北京', '海淀', '5_KGdWXrZFjsJk1GT9WguNRpQteDkMf3IQh4UWvtBfWxepwgY5VddBZ5XzPwMIY24fEdCI-g_vKHAAbx0j2wc6hw', '5_MdTfij6oma4GuxcooPE2KHguESOnuExVxZl_5PaYitObfeIgzEwg5bwCCg3HBPGlJ7cHZ-xSTDF6mQzzVnzpEw', '1513590698', '1513590698'), ('5', null, 'o84Y-wIqgDJZxlYJokgTrfJjLCc0', '0', '1', 'a·范禹', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erpGtTZibia3LFYvyUy0xOsVqscopvCJlSEDAdFNykDxS6QolhjIjf24aK4Sksib18lZtewqTc1xwg9A/0', '中国', '北京', '石景山', '5_i1QM471ICSLC5ACe6mO2ONeYOVF1cyubA0BSi5BzsOc34QK9yWhN4u6CzCshSV49qTX3iU50DMs_Fx87TpgFJj_pshDKkJ-23MdTxcJ75gA', '5_FfwJXgFnmu_N_GlTU4ZqUstRkk6tek6hbxXCf-_Lli_GxOgy_N7ahR9Rs9ZVNXa3wUumoxXebHhWdlmW8e1NFCalSztQjdAX6L5WypMWqKA', '1513591267', '1513591267'), ('6', null, 'o84Y-wAX0b7qPTgSPS8gKgTopsuU', '0', '1', '上善', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLTxNk8M9wEwGYYoM5xsSnttmeLrPR4HHicn699Q9jaeJGODkSpibiccicE8ecTU0kl1cd4OOhUreUO8w/0', '中国', '北京', '海淀', '5_scTx_HU67cqyHTExHgPEBLSS7jUIPnxdtD203RE_03irgwizPPsrvi9zNsNM18nXMtHOCihTEVBBI0wVAhXsDRJu--IW-7Y9L2LlKURfCxA', '5_1ZP6c6OjGyVhSlzwcFKQ9Jnev0g1QUhqqpFnqethudsXAQMrn3EbnBQXgngxXYTyrpOTvshZFeUMzE09v6xEmPHHvVa1mH0r0xdJF7PHOY8', '1513591456', '1513591456'), ('7', null, 'o84Y-wJv98Y7cJvpBD2w7bBfUfB4', '0', '2', '树林', 'http://wx.qlogo.cn/mmopen/vi_32/XwEZB36I73KFCkGealXyOgNeQXeIE7wEWbwCiaHUM90IBYxa37arvmNhUFsdPyLWbc0vibAmpnHDwYjbZF2BHnrQ/0', '法国', '巴黎', '', '5_IlsLEydwrdXPqvpxa5mDJB41YeI5p7uPi2cAXHEtfcE7oAtek8sR1CZWE5RgLwtdCQuqwhOrNAE9U-Zbnp9FIh4_zE-VeekEbk69Mv38cRM', '5_C_07LhlVq5USvEA0Kuu3eznW83eKGdB4Pq2Njvgqk7OQBk8Lb1FFooMAhPXgWBhO3d8CItRH-7smlb5Q-ci6vv6Y04TlGyL2ifI_XScYwZw', '1513591596', '1513591596'), ('8', null, 'o84Y-wG5szBNGb2kqoY4ADHWYQ3k', '0', '1', 'echo', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoHZkDvnuY17QEiape04PKZrnoEocicicetzLSUO0bsudp3k7oibicFjMaMhwicnrODUzOQex5dJ6Opw4DA/0', '中国', '湖北', '武汉', '5_cz36b9YKzOw_OKk7A_XtvAZv3yYMDkA9Rr60rhliFGal_uQyX1P9d6bEAnFyKzv0ID2t2-pHARZ-pu-PH0k3Thc00FQQDx49jiSa80h5ths', '5_-P-tisxIKlfQGN3Qj7YqvSIrUkqHTIb6Uge_9dWXyZvwvYYsVNhadA4jC9CKP86nuCUKsPT7J69e8eN4O1H-uCHpwUd1pZTLozrst9ODoHw', '1513591658', '1513591658'), ('9', null, 'o84Y-wEl9l_-uIPxVrQolK521s18', '0', '2', '小龙女', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKU4JNMOLShDjdhIsAHyUyUlXreGayNQbAASuPCoWcicnLbDKtZkscFZxjGaYT8icj6JMGweD16TYvw/0', '中国', '北京', '海淀', '5_JtSMNvDTfLE-5OH3N07c6x3N3twCokQB9O3tgzF8WjX1Drj-4xT4p1g9C8DidxbsQdggXJRUTq6kGO20IIDMAN1zav_n21awc3uuuOKJ2FA', '5_cQyhRwqFKDIqvWZQ8a-CkQvvJxAg4cJoUtoPl1s6pHGYqfFQYUTGcd5FFaG5sn0u62TBxvNcbAkxOiL1gXe1F9ma8SiDfm3z4BX0rr0K5uE', '1513591892', '1513591892'), ('10', null, 'o84Y-wAKzfPJ_ZtA08J_DWksz2Z0', '0', '1', '超越', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIrmTtgXeEDPa0Uibk2L9UbRiaGqGcdicpnhDKJsBVvKTBWovejNLT1RF3HCehqxOoA1awXKku3m69BQ/0', '中国', '北京', '朝阳', '5_elY_ZzgSxUouKpFrNfHXe1ZVJhWhdKWkhzDyQP_3XS8sW-OcAk2WBq5TPFkNUphza6730cFxTiuERa_QibybG6Xbx8i0lfDHug8zg4BeTCs', '5_HLLnb2_4N1yQE4G4SvYk3KD9stL5Bd2eb26ZtOOY0NtGmWqBAFr5vIJokJKXbfEwNEdSVUAzwkJv0O-pv6hb0Vf2naiwEJf8viUT1GPnQhg', '1513592631', '1513592631'), ('11', null, 'o84Y-wAoc8HZViEKpSf-F5B2X0Rw', '0', '1', '猫咪咪', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJD7DoibPzUAoy1NhrG1OiauPTJM7CuMFZ3Jaicl9owvw8FOBzZOIYq7ejTKa8ibYshZSRHam6rfphjIQ/0', '安道尔', '', '', '5_C-VwLSCcO67GT4vjrXZGJpsDtY-1i_Tl9SsqDQn0xUpC5X0LfIknfxe82YO2EFxoONQcI4oFvwPyVB0s0Gn2KmVmAvCqDvMSQMBSPYvGrLE', '5_lAxh1sLbJq6NZkwA-ZjW6FQNpSwrHMkDvsp9XTaVamfnMuxnjYLk4Zl9J2EICW1f34r-m9ne-SA6wuxKu38fViOmCJxQuwnO5FzipZBryCw', '1513592669', '1513592669'), ('12', null, 'o84Y-wOJDoan-hOT26JfOM6cw5rQ', '0', '1', '【期待】', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK64qFicLhuqgM6iavzQaY80aFV6e11sguZibAvza1WPCZD5ia4c8TCPc2QLk0PaMjyc1KVKjRUqOcMzg/0', '中国', '北京', '海淀', '5_qfYMw5zQlk0VeNKNrGSW5WkdMLz4rA5UrCd-79kVXXkODLdELeHbAVxCMRvnI1eLor8kKaV-dYphxAKcm-UU-mDlRRFtpVPTgDWsb44JTE4', '5_7Ujzg9yMNQRJ7X39GSM4l_cRAExYOxD28fwWSGSyF2CXWKdeg9Sj4A3aIl_vNygznAw9msKFn81fHJ3NILyqA_iHxSuoW4E8andI8Fwhaoc', '1513592820', '1513592820'), ('13', null, 'o84Y-wEyky_frAQKVx4qyZuRwFIk', '0', '1', '莫乾', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLibbVMvILCmbeziaR2KCuUaAZ7jcRsjKGL3X8ibFibI5Pprk34OHWQq3NqbhZB1gc1fJyPdth9hWiafMQ/0', '中国', '北京', '东城', '5_Dhfxgtapho4E9JmMo54SiIza2Am-O5A9IOlANESD3voii5r1hdhVzeLXU_6CKzvLWx9S535C0CYMIDZppPeW5QGeY2eaRs-WIEZ7iDVJvXY', '5_Vao5W99aUKrTkiTaFkQeEV4t6YHj0O8LSW0T_E1F3f2ykM3JDTjQ1WvMIxBYWBauJxu-2aTE8PzPA0jEwESD7NGCQXNFpiJZfI_zgq4jTyg', '1513592919', '1513592919'), ('14', null, 'o84Y-wBufp-VgA6dlaevlVFqrtlo', '0', '2', '买嘎', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epXibZror2XRW7odhKLf3DmfUkPxbAUOI6PJdc9rVtibQwxG99ia7VBtOca8s3XbxH1wl0jAibWWAtRsA/0', '中国', '北京', '', '5_9FI0WpfcizjoUg51WL2GVI4P3i1oCDYFAA7lheSwBXGU9HpZ29uEkzJi8ocup1lKXmrs2FLk5rcnfzaNQY47_srRvsndLpGpwoFOabtI89E', '5_oclW3Gs2BU76SvRJ8izWyTBvjU1CLi1yJgNZpyi1lik1h734XiZAaSzZbPak3fWGmuSm3GTzUqnOGWDeyw6C5HM2xwQxcdwV0msdXbO9g3M', '1513611886', '1513611886'), ('15', null, 'o84Y-wBePQtmrbK9ZyuPFYLrB000', '0', '2', '吴磊', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKkkiarrnhwlCEAVEHgeSn0P2lRDzcnOPV5beXcAc9EYbIgb1RspEgmQicrickj9rpZc0IdHWaTjU3vw/0', '中国', '北京', '海淀', '5_lV9e6I9VGKJVYWjh2D0Jr41bcoT4CpWkFrMWt3AH4UYL8Bq-2vpnILzzawq6173pXk8hXJMfGl0OBR706fWNdjGbHpBkbfF-riFFatOIYYc', '5_u-JgeGYMiLCq6fYWjU2z7Nz4Iwzc9D9VpnLiTuRbzev2xA1JdWo_geYSI1xOxflmLnMtS0IhITAsg3bdmy7PesHERGq4QiZOCSorWFqq7nk', '1513644913', '1513644913'), ('16', null, 'o84Y-wJX7s0zhe1gFcBxkffVx3SI', '0', '1', 'FallenArt', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoicAPB4Cb6ia6hmZfp1OxwqPUvNFzWo8TTFcyxkAPEYYq8Av9mj5pSLsfeD01HSahmDur8tArv3lXQ/0', '中国', '北京', '石景山', '5_aZ5CmU-UdckUsADs3SmLu0u3SR7FzrF9SyrJ46Au5vhGZvojTC0_O4VcclMFAC3SjT3Wp1fke5bjz_q9keCSxqsoKJmeYrJNgf_YLvI9BwY', '5_wtVXr61FtWamDDOc0w6l35kzA-RJ1snyMHaL4SsAdbL3LuCDHVDgYz8GVp9mqzNUP64sA5qZjVeoQe6wPk1CQeZRjxY3oG6RHPYD-qDiuNQ', '1513646482', '1513646482'), ('17', null, 'o84Y-wOWHzXUxjj6mTaXEDjtXlIU', '0', '2', '冠一姐姐', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKrqg7vsWXiba0FibQEMHaekicEJct8QfBTh6gl1PtHZxxJgoy1EAXKjiaj8Kmib3e2xuvSacdB2HqJfOA/0', '中国', '', '', '5_jt6ttzgtP16w-L91YCnTNQpKI-qr510uqjgxTq_t5UbgIPGRX29aMcQ7VavCGWrvGvgmZ3TIvBa0PSdNv4ecBhBtu9xkRq6fnAEZWrLOUb0', '5_4unmpCyyxhrJ_kLJ5rJLMPE-7O3z9o8guaY9SPXy-ACgNsOQL5IP7oUvZheJxEc6DTiIgFSGtim8VBKbbkIT41jJbm7lOhYKMDaX_5bIaPE', '1513647513', '1513647513'), ('18', null, 'o84Y-wHb7Tc-uYdad1YMHbwxtZsI', '0', '1', '纳闷儿', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJa5M3miabZJr71gfmLiava8RVsYSTfDhJgyibUBB3IZ76tPJlYnwA2yqZXLiaEeGFnHFLzONjrk5Fqfw/0', '中国', '北京', '海淀', '5_vzJmIi39q9szstcNlZt1SsJLA-IQvj2XhnHr_We_sBSyabx9QnkY1FUQGYZLhurZRPL02IVy7gNvTn2f1-RE_A', '5_rEAQdecjcR7J9wIyeraa_ZPpRe_HVZO5C2XHVJrfA3_0mBdmljHsUZ_o3Q7N154FkwVKWWIoh1qk2dffWSAN4w', '1513649089', '1513649089'), ('19', null, 'o84Y-wLVb852MV9GbK1GBm6ELGUo', '0', '1', '夜子', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJxuqvwAmGFH5PHVcFa9fQf8ic97Z0Lmbb90PTYFTBfO496WBz1d8YoOYaX8XSF0ibEYDBo1AaNmMHg/0', '中国', '北京', '朝阳', '5_PwMXzReaez-YdH3dqHGKaySeBvZAprvavykLBgW6UhW2POe5j4zQk4ku-avDoFzxycajXvSRTSTblCo4a4NChQ', '5_frQHdZw_7LhMfHEhvhJ8ZNbjBsc1h5CN-PPEeUqlnKc1-qPJ2Zn6ZCrCxlyXpMl-s3owvbOXTA-A-8m1KnHW7Q', '1513649142', '1513649142');
COMMIT;

-- ----------------------------
--  Table structure for `ff_user_log`
-- ----------------------------
DROP TABLE IF EXISTS `ff_user_log`;
CREATE TABLE `ff_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `ip` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `created` int(11) NOT NULL DEFAULT '0',
  `updated` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
