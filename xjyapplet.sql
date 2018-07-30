/*
Navicat MySQL Data Transfer

Source Server         : diancan
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : xjyapplet

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-06-29 15:08:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xjy_admin
-- ----------------------------
DROP TABLE IF EXISTS `xjy_admin`;
CREATE TABLE `xjy_admin` (
  `id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `admin_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员名字',
  `lv` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '管理员权限等级',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xjy_admin
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `xjy_admin_menu`;
CREATE TABLE `xjy_admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父菜单id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '菜单类型;1:有界面可访问菜单,2:无界面可访问菜单,0:只作为菜单',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态;1:显示,0:不显示',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `app` varchar(15) NOT NULL DEFAULT '' COMMENT '应用名',
  `controller` varchar(30) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action` varchar(30) NOT NULL DEFAULT '' COMMENT '操作名称',
  `param` varchar(50) NOT NULL DEFAULT '' COMMENT '额外参数',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parent_id`),
  KEY `model` (`controller`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
-- Records of xjy_admin_menu
-- ----------------------------
INSERT INTO `xjy_admin_menu` VALUES ('1', '0', '0', '0', '20', 'admin', 'Plugin', 'default', '', '插件管理', 'cloud', '插件管理');
INSERT INTO `xjy_admin_menu` VALUES ('2', '1', '1', '1', '10000', 'admin', 'Hook', 'index', '', '钩子管理', '', '钩子管理');
INSERT INTO `xjy_admin_menu` VALUES ('3', '2', '1', '0', '10000', 'admin', 'Hook', 'plugins', '', '钩子插件管理', '', '钩子插件管理');
INSERT INTO `xjy_admin_menu` VALUES ('4', '2', '2', '0', '10000', 'admin', 'Hook', 'pluginListOrder', '', '钩子插件排序', '', '钩子插件排序');
INSERT INTO `xjy_admin_menu` VALUES ('5', '2', '1', '0', '10000', 'admin', 'Hook', 'sync', '', '同步钩子', '', '同步钩子');
INSERT INTO `xjy_admin_menu` VALUES ('6', '0', '0', '1', '0', 'admin', 'Setting', 'default', '', '设置', 'cogs', '系统设置入口');
INSERT INTO `xjy_admin_menu` VALUES ('7', '6', '1', '0', '50', 'admin', 'Link', 'index', '', '友情链接', '', '友情链接管理');
INSERT INTO `xjy_admin_menu` VALUES ('8', '7', '1', '0', '10000', 'admin', 'Link', 'add', '', '添加友情链接', '', '添加友情链接');
INSERT INTO `xjy_admin_menu` VALUES ('9', '7', '2', '0', '10000', 'admin', 'Link', 'addPost', '', '添加友情链接提交保存', '', '添加友情链接提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('10', '7', '1', '0', '10000', 'admin', 'Link', 'edit', '', '编辑友情链接', '', '编辑友情链接');
INSERT INTO `xjy_admin_menu` VALUES ('11', '7', '2', '0', '10000', 'admin', 'Link', 'editPost', '', '编辑友情链接提交保存', '', '编辑友情链接提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('12', '7', '2', '0', '10000', 'admin', 'Link', 'delete', '', '删除友情链接', '', '删除友情链接');
INSERT INTO `xjy_admin_menu` VALUES ('13', '7', '2', '0', '10000', 'admin', 'Link', 'listOrder', '', '友情链接排序', '', '友情链接排序');
INSERT INTO `xjy_admin_menu` VALUES ('14', '7', '2', '0', '10000', 'admin', 'Link', 'toggle', '', '友情链接显示隐藏', '', '友情链接显示隐藏');
INSERT INTO `xjy_admin_menu` VALUES ('15', '6', '1', '1', '10', 'admin', 'Mailer', 'index', '', '邮箱配置', '', '邮箱配置');
INSERT INTO `xjy_admin_menu` VALUES ('16', '15', '2', '0', '10000', 'admin', 'Mailer', 'indexPost', '', '邮箱配置提交保存', '', '邮箱配置提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('17', '15', '1', '0', '10000', 'admin', 'Mailer', 'template', '', '邮件模板', '', '邮件模板');
INSERT INTO `xjy_admin_menu` VALUES ('18', '15', '2', '0', '10000', 'admin', 'Mailer', 'templatePost', '', '邮件模板提交', '', '邮件模板提交');
INSERT INTO `xjy_admin_menu` VALUES ('19', '15', '1', '0', '10000', 'admin', 'Mailer', 'test', '', '邮件发送测试', '', '邮件发送测试');
INSERT INTO `xjy_admin_menu` VALUES ('20', '6', '1', '0', '10000', 'admin', 'Menu', 'index', '', '后台菜单', '', '后台菜单管理');
INSERT INTO `xjy_admin_menu` VALUES ('21', '20', '1', '0', '10000', 'admin', 'Menu', 'lists', '', '所有菜单', '', '后台所有菜单列表');
INSERT INTO `xjy_admin_menu` VALUES ('22', '20', '1', '0', '10000', 'admin', 'Menu', 'add', '', '后台菜单添加', '', '后台菜单添加');
INSERT INTO `xjy_admin_menu` VALUES ('23', '20', '2', '0', '10000', 'admin', 'Menu', 'addPost', '', '后台菜单添加提交保存', '', '后台菜单添加提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('24', '20', '1', '0', '10000', 'admin', 'Menu', 'edit', '', '后台菜单编辑', '', '后台菜单编辑');
INSERT INTO `xjy_admin_menu` VALUES ('25', '20', '2', '0', '10000', 'admin', 'Menu', 'editPost', '', '后台菜单编辑提交保存', '', '后台菜单编辑提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('26', '20', '2', '0', '10000', 'admin', 'Menu', 'delete', '', '后台菜单删除', '', '后台菜单删除');
INSERT INTO `xjy_admin_menu` VALUES ('27', '20', '2', '0', '10000', 'admin', 'Menu', 'listOrder', '', '后台菜单排序', '', '后台菜单排序');
INSERT INTO `xjy_admin_menu` VALUES ('28', '20', '1', '0', '10000', 'admin', 'Menu', 'getActions', '', '导入新后台菜单', '', '导入新后台菜单');
INSERT INTO `xjy_admin_menu` VALUES ('29', '6', '1', '0', '30', 'admin', 'Nav', 'index', '', '导航管理', '', '导航管理');
INSERT INTO `xjy_admin_menu` VALUES ('30', '29', '1', '0', '10000', 'admin', 'Nav', 'add', '', '添加导航', '', '添加导航');
INSERT INTO `xjy_admin_menu` VALUES ('31', '29', '2', '0', '10000', 'admin', 'Nav', 'addPost', '', '添加导航提交保存', '', '添加导航提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('32', '29', '1', '0', '10000', 'admin', 'Nav', 'edit', '', '编辑导航', '', '编辑导航');
INSERT INTO `xjy_admin_menu` VALUES ('33', '29', '2', '0', '10000', 'admin', 'Nav', 'editPost', '', '编辑导航提交保存', '', '编辑导航提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('34', '29', '2', '0', '10000', 'admin', 'Nav', 'delete', '', '删除导航', '', '删除导航');
INSERT INTO `xjy_admin_menu` VALUES ('35', '29', '1', '0', '10000', 'admin', 'NavMenu', 'index', '', '导航菜单', '', '导航菜单');
INSERT INTO `xjy_admin_menu` VALUES ('36', '35', '1', '0', '10000', 'admin', 'NavMenu', 'add', '', '添加导航菜单', '', '添加导航菜单');
INSERT INTO `xjy_admin_menu` VALUES ('37', '35', '2', '0', '10000', 'admin', 'NavMenu', 'addPost', '', '添加导航菜单提交保存', '', '添加导航菜单提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('38', '35', '1', '0', '10000', 'admin', 'NavMenu', 'edit', '', '编辑导航菜单', '', '编辑导航菜单');
INSERT INTO `xjy_admin_menu` VALUES ('39', '35', '2', '0', '10000', 'admin', 'NavMenu', 'editPost', '', '编辑导航菜单提交保存', '', '编辑导航菜单提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('40', '35', '2', '0', '10000', 'admin', 'NavMenu', 'delete', '', '删除导航菜单', '', '删除导航菜单');
INSERT INTO `xjy_admin_menu` VALUES ('41', '35', '2', '0', '10000', 'admin', 'NavMenu', 'listOrder', '', '导航菜单排序', '', '导航菜单排序');
INSERT INTO `xjy_admin_menu` VALUES ('42', '1', '1', '1', '10000', 'admin', 'Plugin', 'index', '', '插件列表', '', '插件列表');
INSERT INTO `xjy_admin_menu` VALUES ('43', '42', '2', '0', '10000', 'admin', 'Plugin', 'toggle', '', '插件启用禁用', '', '插件启用禁用');
INSERT INTO `xjy_admin_menu` VALUES ('44', '42', '1', '0', '10000', 'admin', 'Plugin', 'setting', '', '插件设置', '', '插件设置');
INSERT INTO `xjy_admin_menu` VALUES ('45', '42', '2', '0', '10000', 'admin', 'Plugin', 'settingPost', '', '插件设置提交', '', '插件设置提交');
INSERT INTO `xjy_admin_menu` VALUES ('46', '42', '2', '0', '10000', 'admin', 'Plugin', 'install', '', '插件安装', '', '插件安装');
INSERT INTO `xjy_admin_menu` VALUES ('47', '42', '2', '0', '10000', 'admin', 'Plugin', 'update', '', '插件更新', '', '插件更新');
INSERT INTO `xjy_admin_menu` VALUES ('48', '42', '2', '0', '10000', 'admin', 'Plugin', 'uninstall', '', '卸载插件', '', '卸载插件');
INSERT INTO `xjy_admin_menu` VALUES ('49', '109', '0', '1', '10000', 'admin', 'User', 'default', '', '管理组', '', '管理组');
INSERT INTO `xjy_admin_menu` VALUES ('50', '49', '1', '1', '10000', 'admin', 'Rbac', 'index', '', '角色管理', '', '角色管理');
INSERT INTO `xjy_admin_menu` VALUES ('51', '50', '1', '0', '10000', 'admin', 'Rbac', 'roleAdd', '', '添加角色', '', '添加角色');
INSERT INTO `xjy_admin_menu` VALUES ('52', '50', '2', '0', '10000', 'admin', 'Rbac', 'roleAddPost', '', '添加角色提交', '', '添加角色提交');
INSERT INTO `xjy_admin_menu` VALUES ('53', '50', '1', '0', '10000', 'admin', 'Rbac', 'roleEdit', '', '编辑角色', '', '编辑角色');
INSERT INTO `xjy_admin_menu` VALUES ('54', '50', '2', '0', '10000', 'admin', 'Rbac', 'roleEditPost', '', '编辑角色提交', '', '编辑角色提交');
INSERT INTO `xjy_admin_menu` VALUES ('55', '50', '2', '0', '10000', 'admin', 'Rbac', 'roleDelete', '', '删除角色', '', '删除角色');
INSERT INTO `xjy_admin_menu` VALUES ('56', '50', '1', '0', '10000', 'admin', 'Rbac', 'authorize', '', '设置角色权限', '', '设置角色权限');
INSERT INTO `xjy_admin_menu` VALUES ('57', '50', '2', '0', '10000', 'admin', 'Rbac', 'authorizePost', '', '角色授权提交', '', '角色授权提交');
INSERT INTO `xjy_admin_menu` VALUES ('58', '0', '1', '1', '1000000', 'admin', 'RecycleBin', 'index', '', '回收站', 'recycle', '回收站');
INSERT INTO `xjy_admin_menu` VALUES ('59', '58', '2', '0', '10000', 'admin', 'RecycleBin', 'restore', '', '回收站还原', '', '回收站还原');
INSERT INTO `xjy_admin_menu` VALUES ('60', '58', '2', '0', '10000', 'admin', 'RecycleBin', 'delete', '', '回收站彻底删除', '', '回收站彻底删除');
INSERT INTO `xjy_admin_menu` VALUES ('61', '6', '1', '0', '10000', 'admin', 'Route', 'index', '', 'URL美化', '', 'URL规则管理');
INSERT INTO `xjy_admin_menu` VALUES ('62', '61', '1', '0', '10000', 'admin', 'Route', 'add', '', '添加路由规则', '', '添加路由规则');
INSERT INTO `xjy_admin_menu` VALUES ('63', '61', '2', '0', '10000', 'admin', 'Route', 'addPost', '', '添加路由规则提交', '', '添加路由规则提交');
INSERT INTO `xjy_admin_menu` VALUES ('64', '61', '1', '0', '10000', 'admin', 'Route', 'edit', '', '路由规则编辑', '', '路由规则编辑');
INSERT INTO `xjy_admin_menu` VALUES ('65', '61', '2', '0', '10000', 'admin', 'Route', 'editPost', '', '路由规则编辑提交', '', '路由规则编辑提交');
INSERT INTO `xjy_admin_menu` VALUES ('66', '61', '2', '0', '10000', 'admin', 'Route', 'delete', '', '路由规则删除', '', '路由规则删除');
INSERT INTO `xjy_admin_menu` VALUES ('67', '61', '2', '0', '10000', 'admin', 'Route', 'ban', '', '路由规则禁用', '', '路由规则禁用');
INSERT INTO `xjy_admin_menu` VALUES ('68', '61', '2', '0', '10000', 'admin', 'Route', 'open', '', '路由规则启用', '', '路由规则启用');
INSERT INTO `xjy_admin_menu` VALUES ('69', '61', '2', '0', '10000', 'admin', 'Route', 'listOrder', '', '路由规则排序', '', '路由规则排序');
INSERT INTO `xjy_admin_menu` VALUES ('70', '61', '1', '0', '10000', 'admin', 'Route', 'select', '', '选择URL', '', '选择URL');
INSERT INTO `xjy_admin_menu` VALUES ('71', '6', '1', '1', '0', 'admin', 'Setting', 'site', '', '网站信息', '', '网站信息');
INSERT INTO `xjy_admin_menu` VALUES ('72', '71', '2', '0', '10000', 'admin', 'Setting', 'sitePost', '', '网站信息设置提交', '', '网站信息设置提交');
INSERT INTO `xjy_admin_menu` VALUES ('73', '186', '1', '1', '10000', 'admin', 'Setting', 'password', '', '密码修改', '', '密码修改');
INSERT INTO `xjy_admin_menu` VALUES ('74', '73', '2', '0', '10000', 'admin', 'Setting', 'passwordPost', '', '密码修改提交', '', '密码修改提交');
INSERT INTO `xjy_admin_menu` VALUES ('75', '6', '1', '1', '10000', 'admin', 'Setting', 'upload', '', '上传设置', '', '上传设置');
INSERT INTO `xjy_admin_menu` VALUES ('76', '75', '2', '0', '10000', 'admin', 'Setting', 'uploadPost', '', '上传设置提交', '', '上传设置提交');
INSERT INTO `xjy_admin_menu` VALUES ('77', '6', '1', '0', '10000', 'admin', 'Setting', 'clearCache', '', '清除缓存', '', '清除缓存');
INSERT INTO `xjy_admin_menu` VALUES ('78', '6', '1', '0', '40', 'admin', 'Slide', 'index', '', '幻灯片管理', '', '幻灯片管理');
INSERT INTO `xjy_admin_menu` VALUES ('79', '78', '1', '0', '10000', 'admin', 'Slide', 'add', '', '添加幻灯片', '', '添加幻灯片');
INSERT INTO `xjy_admin_menu` VALUES ('80', '78', '2', '0', '10000', 'admin', 'Slide', 'addPost', '', '添加幻灯片提交', '', '添加幻灯片提交');
INSERT INTO `xjy_admin_menu` VALUES ('81', '78', '1', '0', '10000', 'admin', 'Slide', 'edit', '', '编辑幻灯片', '', '编辑幻灯片');
INSERT INTO `xjy_admin_menu` VALUES ('82', '78', '2', '0', '10000', 'admin', 'Slide', 'editPost', '', '编辑幻灯片提交', '', '编辑幻灯片提交');
INSERT INTO `xjy_admin_menu` VALUES ('83', '78', '2', '0', '10000', 'admin', 'Slide', 'delete', '', '删除幻灯片', '', '删除幻灯片');
INSERT INTO `xjy_admin_menu` VALUES ('84', '78', '1', '0', '10000', 'admin', 'SlideItem', 'index', '', '幻灯片页面列表', '', '幻灯片页面列表');
INSERT INTO `xjy_admin_menu` VALUES ('85', '84', '1', '0', '10000', 'admin', 'SlideItem', 'add', '', '幻灯片页面添加', '', '幻灯片页面添加');
INSERT INTO `xjy_admin_menu` VALUES ('86', '84', '2', '0', '10000', 'admin', 'SlideItem', 'addPost', '', '幻灯片页面添加提交', '', '幻灯片页面添加提交');
INSERT INTO `xjy_admin_menu` VALUES ('87', '84', '1', '0', '10000', 'admin', 'SlideItem', 'edit', '', '幻灯片页面编辑', '', '幻灯片页面编辑');
INSERT INTO `xjy_admin_menu` VALUES ('88', '84', '2', '0', '10000', 'admin', 'SlideItem', 'editPost', '', '幻灯片页面编辑提交', '', '幻灯片页面编辑提交');
INSERT INTO `xjy_admin_menu` VALUES ('89', '84', '2', '0', '10000', 'admin', 'SlideItem', 'delete', '', '幻灯片页面删除', '', '幻灯片页面删除');
INSERT INTO `xjy_admin_menu` VALUES ('90', '84', '2', '0', '10000', 'admin', 'SlideItem', 'ban', '', '幻灯片页面隐藏', '', '幻灯片页面隐藏');
INSERT INTO `xjy_admin_menu` VALUES ('91', '84', '2', '0', '10000', 'admin', 'SlideItem', 'cancelBan', '', '幻灯片页面显示', '', '幻灯片页面显示');
INSERT INTO `xjy_admin_menu` VALUES ('92', '84', '2', '0', '10000', 'admin', 'SlideItem', 'listOrder', '', '幻灯片页面排序', '', '幻灯片页面排序');
INSERT INTO `xjy_admin_menu` VALUES ('93', '6', '1', '1', '10000', 'admin', 'Storage', 'index', '', '文件存储', '', '文件存储');
INSERT INTO `xjy_admin_menu` VALUES ('94', '93', '2', '0', '10000', 'admin', 'Storage', 'settingPost', '', '文件存储设置提交', '', '文件存储设置提交');
INSERT INTO `xjy_admin_menu` VALUES ('95', '6', '1', '0', '20', 'admin', 'Theme', 'index', '', '模板管理', '', '模板管理');
INSERT INTO `xjy_admin_menu` VALUES ('96', '95', '1', '0', '10000', 'admin', 'Theme', 'install', '', '安装模板', '', '安装模板');
INSERT INTO `xjy_admin_menu` VALUES ('97', '95', '2', '0', '10000', 'admin', 'Theme', 'uninstall', '', '卸载模板', '', '卸载模板');
INSERT INTO `xjy_admin_menu` VALUES ('98', '95', '2', '0', '10000', 'admin', 'Theme', 'installTheme', '', '模板安装', '', '模板安装');
INSERT INTO `xjy_admin_menu` VALUES ('99', '95', '2', '0', '10000', 'admin', 'Theme', 'update', '', '模板更新', '', '模板更新');
INSERT INTO `xjy_admin_menu` VALUES ('100', '6', '2', '0', '10000', 'admin', 'Theme', 'active', '', '模板显示', '', '启用模板');
INSERT INTO `xjy_admin_menu` VALUES ('101', '95', '1', '0', '10000', 'admin', 'Theme', 'files', '', '模板文件列表', '', '启用模板');
INSERT INTO `xjy_admin_menu` VALUES ('102', '95', '1', '0', '10000', 'admin', 'Theme', 'fileSetting', '', '模板文件设置', '', '模板文件设置');
INSERT INTO `xjy_admin_menu` VALUES ('103', '95', '1', '0', '10000', 'admin', 'Theme', 'fileArrayData', '', '模板文件数组数据列表', '', '模板文件数组数据列表');
INSERT INTO `xjy_admin_menu` VALUES ('104', '95', '2', '0', '10000', 'admin', 'Theme', 'fileArrayDataEdit', '', '模板文件数组数据添加编辑', '', '模板文件数组数据添加编辑');
INSERT INTO `xjy_admin_menu` VALUES ('105', '95', '2', '0', '10000', 'admin', 'Theme', 'fileArrayDataEditPost', '', '模板文件数组数据添加编辑提交保存', '', '模板文件数组数据添加编辑提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('106', '95', '2', '0', '10000', 'admin', 'Theme', 'fileArrayDataDelete', '', '模板文件数组数据删除', '', '模板文件数组数据删除');
INSERT INTO `xjy_admin_menu` VALUES ('107', '95', '2', '0', '10000', 'admin', 'Theme', 'settingPost', '', '模板文件编辑提交保存', '', '模板文件编辑提交保存');
INSERT INTO `xjy_admin_menu` VALUES ('108', '95', '1', '0', '10000', 'admin', 'Theme', 'dataSource', '', '模板文件设置数据源', '', '模板文件设置数据源');
INSERT INTO `xjy_admin_menu` VALUES ('109', '0', '0', '1', '10', 'user', 'AdminIndex', 'default', '', '用户管理', 'group', '用户管理');
INSERT INTO `xjy_admin_menu` VALUES ('110', '49', '1', '1', '10000', 'admin', 'User', 'index', '', '管理员', '', '管理员管理');
INSERT INTO `xjy_admin_menu` VALUES ('111', '110', '1', '1', '10000', 'admin', 'User', 'add', '', '管理员添加', '', '管理员添加');
INSERT INTO `xjy_admin_menu` VALUES ('112', '110', '2', '0', '10000', 'admin', 'User', 'addPost', '', '管理员添加提交', '', '管理员添加提交');
INSERT INTO `xjy_admin_menu` VALUES ('113', '110', '1', '1', '10000', 'admin', 'User', 'edit', '', '管理员编辑', '', '管理员编辑');
INSERT INTO `xjy_admin_menu` VALUES ('114', '110', '2', '0', '10000', 'admin', 'User', 'editPost', '', '管理员编辑提交', '', '管理员编辑提交');
INSERT INTO `xjy_admin_menu` VALUES ('115', '186', '1', '1', '8000', 'admin', 'User', 'userInfo', '', '个人信息', '', '管理员个人信息修改');
INSERT INTO `xjy_admin_menu` VALUES ('116', '186', '2', '0', '10000', 'admin', 'User', 'userInfoPost', '', '管理员个人信息修改提交', '', '管理员个人信息修改提交');
INSERT INTO `xjy_admin_menu` VALUES ('117', '110', '2', '0', '10000', 'admin', 'User', 'delete', '', '管理员删除', '', '管理员删除');
INSERT INTO `xjy_admin_menu` VALUES ('118', '110', '2', '0', '10000', 'admin', 'User', 'ban', '', '停用管理员', '', '停用管理员');
INSERT INTO `xjy_admin_menu` VALUES ('119', '110', '2', '0', '10000', 'admin', 'User', 'cancelBan', '', '启用管理员', '', '启用管理员');
INSERT INTO `xjy_admin_menu` VALUES ('150', '0', '1', '1', '31', 'user', 'AdminAsset', 'index', '', '资源管理', 'file', '资源管理列表');
INSERT INTO `xjy_admin_menu` VALUES ('151', '150', '2', '0', '10000', 'user', 'AdminAsset', 'delete', '', '删除文件', '', '删除文件');
INSERT INTO `xjy_admin_menu` VALUES ('152', '109', '0', '1', '10000', 'user', 'AdminIndex', 'default1', '', '会员', '', '用户组');
INSERT INTO `xjy_admin_menu` VALUES ('153', '152', '1', '1', '10000', 'user', 'AdminIndex', 'index', '', '本站用户', '', '本站用户');
INSERT INTO `xjy_admin_menu` VALUES ('154', '153', '2', '0', '10000', 'user', 'AdminIndex', 'ban', '', '本站用户拉黑', '', '本站用户拉黑');
INSERT INTO `xjy_admin_menu` VALUES ('155', '153', '2', '0', '10000', 'user', 'AdminIndex', 'cancelBan', '', '本站用户启用', '', '本站用户启用');
INSERT INTO `xjy_admin_menu` VALUES ('156', '152', '1', '1', '10000', 'user', 'AdminOauth', 'index', '', '会员管理', '', '第三方用户');
INSERT INTO `xjy_admin_menu` VALUES ('157', '156', '2', '0', '10000', 'user', 'AdminOauth', 'delete', '', '删除第三方用户绑定', '', '删除第三方用户绑定');
INSERT INTO `xjy_admin_menu` VALUES ('158', '6', '1', '1', '10000', 'user', 'AdminUserAction', 'index', '', '用户操作管理', '', '用户操作管理');
INSERT INTO `xjy_admin_menu` VALUES ('159', '158', '1', '0', '10000', 'user', 'AdminUserAction', 'edit', '', '编辑用户操作', '', '编辑用户操作');
INSERT INTO `xjy_admin_menu` VALUES ('160', '158', '2', '0', '10000', 'user', 'AdminUserAction', 'editPost', '', '编辑用户操作提交', '', '编辑用户操作提交');
INSERT INTO `xjy_admin_menu` VALUES ('161', '158', '1', '0', '10000', 'user', 'AdminUserAction', 'sync', '', '同步用户操作', '', '同步用户操作');
INSERT INTO `xjy_admin_menu` VALUES ('176', '0', '0', '1', '10000', 'admin', 'seller', 'default', '', '门店管理', 'microchip', '');
INSERT INTO `xjy_admin_menu` VALUES ('177', '176', '1', '1', '177', 'admin', 'seller', 'index', '', '门店信息', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('179', '0', '0', '1', '10000', 'admin', 'order', 'default', '', ' 订单信息', 'file-o', '');
INSERT INTO `xjy_admin_menu` VALUES ('180', '179', '1', '1', '10000', 'admin', 'order', 'index', '', '订单列表', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('181', '179', '2', '0', '10000', 'admin', 'order', 'orderAddList', '', '消费下单', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('182', '176', '1', '1', '10000', 'admin', 'Classification', 'index', '', '分类管理', 'book', '');
INSERT INTO `xjy_admin_menu` VALUES ('184', '176', '1', '1', '188', 'admin', 'Foodmenu', 'index', '', '菜品管理', '', '商家菜单表');
INSERT INTO `xjy_admin_menu` VALUES ('185', '0', '1', '0', '10000', 'admin', 'Address', 'index', '', '收货地址', 'truck', '收货地址管理');
INSERT INTO `xjy_admin_menu` VALUES ('186', '0', '0', '1', '10000', 'admin', 'user', 'manage', '', '信息管理', 'shield', '个人信息管理');
INSERT INTO `xjy_admin_menu` VALUES ('187', '196', '1', '1', '10000', 'admin', 'report', 'index', '', '报表统计', 'line-chart', '商家报表统计');
INSERT INTO `xjy_admin_menu` VALUES ('188', '179', '1', '1', '10000', 'admin', 'order', 'printindex', 'class=2', '销量排行榜', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('189', '179', '1', '1', '10000', 'admin', 'order', 'reserveOrder', '', '预约信息', '', '商家预约信息');
INSERT INTO `xjy_admin_menu` VALUES ('190', '176', '1', '1', '10000', 'admin', 'seller', 'sellerTable', '', '餐桌管理', '', '商家对餐桌信息的操作');
INSERT INTO `xjy_admin_menu` VALUES ('191', '196', '1', '1', '10000', 'admin', 'seller', 'withdrawals', '', '提现', '', '商家提现操作');
INSERT INTO `xjy_admin_menu` VALUES ('192', '0', '1', '1', '10000', 'admin', 'cashier', 'index', '', '收银台', 'jpy', '收银管理');
INSERT INTO `xjy_admin_menu` VALUES ('193', '0', '1', '1', '10000', 'admin', 'Kitchen', 'index', '', '后厨', 'cutlery', '');
INSERT INTO `xjy_admin_menu` VALUES ('194', '0', '1', '1', '10000', 'admin', 'Marketplace', 'index', '', '应用市场', 'cubes', '');
INSERT INTO `xjy_admin_menu` VALUES ('195', '0', '1', '1', '10000', 'admin', 'Printer', 'index', '', '设备管理', 'align-justify', '');
INSERT INTO `xjy_admin_menu` VALUES ('196', '0', '1', '1', '10000', 'admin', '#', '#', '', '财务管理', 'money', '财务管理');
INSERT INTO `xjy_admin_menu` VALUES ('197', '0', '1', '1', '10000', 'admin', '#', 'default', '', '货流', 'truck', '');
INSERT INTO `xjy_admin_menu` VALUES ('198', '197', '1', '1', '198', 'admin', 'Traffic', 'index', '', '商品管理', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('199', '197', '1', '1', '200', 'admin', 'Traffic', 'purchase', '', '采购', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('200', '197', '1', '1', '10000', 'admin', 'Traffic', 'apply', '', '申请列表', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('201', '152', '1', '1', '10000', 'user', 'AdminOauth', 'levelIndex', '', '会员等级', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('202', '152', '1', '1', '10000', 'user', 'AdminOauth', 'recharge', '', '充值记录', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('203', '197', '1', '1', '199', 'admin', 'TrafficCategory', 'index', '', '商品分类', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('204', '197', '1', '1', '201', 'admin', 'TrafficCategory', 'purchase_index', '', '采购分类', 'type=9', '采购分类  type 字段为 ‘9’');
INSERT INTO `xjy_admin_menu` VALUES ('205', '197', '1', '1', '10000', 'admin', 'TrafficReport', 'index', '', ' 报表统计', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('206', '197', '1', '1', '10000', 'admin', 'TrafficReport', 'lossIndex', '', '商品报损', '', '');
INSERT INTO `xjy_admin_menu` VALUES ('207', '197', '1', '1', '10000', 'admin', 'Inventory', 'index', '', '盘点', '', '');

-- ----------------------------
-- Table structure for xjy_asset
-- ----------------------------
DROP TABLE IF EXISTS `xjy_asset`;
CREATE TABLE `xjy_asset` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `file_size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小,单位B',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:可用,0:不可用',
  `download_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `file_key` varchar(64) NOT NULL DEFAULT '' COMMENT '文件惟一码',
  `filename` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名',
  `file_path` varchar(100) NOT NULL DEFAULT '' COMMENT '文件路径,相对于upload目录,可以为url',
  `file_md5` varchar(32) NOT NULL DEFAULT '' COMMENT '文件md5值',
  `file_sha1` varchar(40) NOT NULL DEFAULT '',
  `suffix` varchar(10) NOT NULL DEFAULT '' COMMENT '文件后缀名,不包括点',
  `more` text COMMENT '其它详细信息,JSON格式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 COMMENT='资源表';

-- ----------------------------
-- Records of xjy_asset
-- ----------------------------
INSERT INTO `xjy_asset` VALUES ('1', '1', '1063470', '1507825874', '1', '0', '1d88e0287994d66a7fee9adb085d985700a242b219a4016140372ad270cfea89', 'img010.jpg', 'video/20171013/7ed3f37227d5709c2529e844c1a9df1a.jpg', '1d88e0287994d66a7fee9adb085d9857', '3dc5bbc74eaa7d0ac1f7240262a03fb924d5cf8b', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('2', '1', '5855', '1509679094', '1', '0', '535584f7c875e423cfee482bea65e0b8241f04db7dd40e2d639afcdf0a599090', 'default-thumbnail.png', 'admin/20171103/d91bbac5d31a523c4024eeadabf4b561.png', '535584f7c875e423cfee482bea65e0b8', '776e757a2c2eecad8a0de36aa3e2d77c2a78fd14', 'png', null);
INSERT INTO `xjy_asset` VALUES ('3', '1', '2530', '1509679250', '1', '0', '9a8269421303631316be4ab5e34870e1c3afadabdb7f62bc6ed2e86755a9c28b', 'loading.gif', 'admin/20171103/d0450b308495ef8e3db75f1310bfd0e3.gif', '9a8269421303631316be4ab5e34870e1', '0473950c2457562e341e0e76ad01865c9e225087', 'gif', null);
INSERT INTO `xjy_asset` VALUES ('4', '1', '843', '1509679270', '1', '0', '4e346b17023019fe5ec855f0955ace8cb6c0d95d9f91acce170ecbb8262782e9', 'upload_pic.jpg', 'admin/20171103/86cc0033e0309a18c099d96813e08b2a.jpg', '4e346b17023019fe5ec855f0955ace8c', '8cfe8d66b99910104c079ccc78848536581d2ce3', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('5', '1', '3429', '1510109299', '1', '0', '416d21e3bd67369190017626279560b6712c400074701aaf5d8236b1e4ab83db', 'asd.jpg', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '416d21e3bd67369190017626279560b6', '46a1144f4138864c524cb6499f13683493353b0c', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('6', '1', '4111', '1510394965', '1', '0', 'e2cf78b9c74f2d82053afd2b842ad7a71057ecc388da0e61ad31137fdec70f2c', 'headicon.png', 'admin/20171111/f3ebb95a4d8ecb2d3c520e29ef6fc2e7.png', 'e2cf78b9c74f2d82053afd2b842ad7a7', '2cb944149ce01aed05428b1860c0d420f3951764', 'png', null);
INSERT INTO `xjy_asset` VALUES ('7', '1', '387172', '1510648815', '1', '0', 'd2962058b08cafecdd34973b7115289b9eb6e29f2fb344a31f35222f440355c1', '全部订单＿点餐基础版.jpg', 'admin/20171114/ffd9af1a778b03cbdfce96751bd54247.jpg', 'd2962058b08cafecdd34973b7115289b', 'b5a6a4b4e3556757879145a6c504686d3df7757c', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('8', '1', '495054', '1510648817', '1', '0', '6f1fd32d01d67d96589cb84f25988ae4904773314e114920907b655cac79bbb5', '扫码点餐3＿点餐基础版.jpg', 'admin/20171114/d14c3dd7ebd504be21cfbd16bfdbd8cb.jpg', '6f1fd32d01d67d96589cb84f25988ae4', '15bef0e9f945cf412c43d7b652e06ee87395e760', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('9', '1', '388113', '1510648819', '1', '0', '6786aaf5671bd78044b0ba5efadbfff06000a3d170ee95a876d982454930bbe5', '扫码支付＿点餐基础版.jpg', 'admin/20171114/20becb8ca5005deb0055244fec57c5c3.jpg', '6786aaf5671bd78044b0ba5efadbfff0', 'b720161a3be90dca136d261f8bf461741321e55f', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('10', '1', '279330', '1510648821', '1', '0', '0c11d420f8849242aa2a5ce1e2bc303fc1761a2526a8f92d808409b6485ed151', '头像＿点餐基础版.jpg', 'admin/20171114/846853214d39977bc7734783a565f946.jpg', '0c11d420f8849242aa2a5ce1e2bc303f', '6efbbd561aad4c3268f2337fd6b6c817c342a089', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('11', '1', '314224', '1510648835', '1', '0', '0fa1755e275cd26a933a1a838221ee12e24933ddea1fd7332a9f2ae4f641277c', '支付＿点餐基础版.jpg', 'admin/20171114/660ae728dd41b9ba64a13b8c38030b7c.jpg', '0fa1755e275cd26a933a1a838221ee12', 'e5961b58e5eed6805f8bf42e14d1a676d2db6335', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('12', '10', '511857', '1510742707', '1', '0', '4f21b3b3728e683bbe5328fcbd633c80286db0436109d0c503afc0fc9f2c53d2', '外卖点餐＿点餐基础版.jpg', 'admin/20171115/87212c293f9c24e427091394cd391667.jpg', '4f21b3b3728e683bbe5328fcbd633c80', '33fc514214024b239e5e92c6cf273a54d14daa1f', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('13', '10', '251806', '1510742859', '1', '0', '865b720c15fcf73fc7733647bd37a6177eb8bb3f2e69eae5a2af28f4e72a5e2d', '扫码点餐＿点餐基础版.jpg', 'admin/20171115/4bd94a588e076f05767b1283293a7b25.jpg', '865b720c15fcf73fc7733647bd37a617', 'b103f817c6e6e148ac31aa80fc6a6bbcb2469223', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('14', '10', '279330', '1510743019', '1', '0', '0c11d420f8849242aa2a5ce1e2bc303fc1761a2526a8f92d808409b6485ed151', '头像＿点餐基础版.jpg', 'admin/20171115/68cb24b97db4892a6f0e0f8b909a4a6e.jpg', '0c11d420f8849242aa2a5ce1e2bc303f', '6efbbd561aad4c3268f2337fd6b6c817c342a089', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('15', '1', '23692', '1511252385', '1', '0', '65a6e07d3ef87c8065371e49db3fd07a3536144cc663cc32ace8486fcab6311d', 'solutions01.png', 'admin/20171121/10a5b98ff94afa911a87fa56125a4003.png', '65a6e07d3ef87c8065371e49db3fd07a', 'a5c85815e18f77fac84bd9afd9134c0257788d86', 'png', null);
INSERT INTO `xjy_asset` VALUES ('16', '1', '951417', '1511252409', '1', '0', '8d738879e872584ed70606f52812869b995a7e5a0a2140f2e5fde0b799323628', '视频欣赏.jpg', 'admin/20171121/befdd80fe66993c1de470c3a79902832.jpg', '8d738879e872584ed70606f52812869b', '9b8bfe6cf2b84327cb9cd53eb63b293949cccfb0', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('17', '1', '121767', '1511335752', '1', '0', 'aad659bb144ea44b70479f6f864a8e9a95f375f43152f9d9d70865d536b20915', '汽车网站首页_04.png', 'admin/20171122/d6f724d82434e83c22f59c5fe285dd6c.png', 'aad659bb144ea44b70479f6f864a8e9a', '188dbb0a53d35e95b04c128972431ee140cba93d', 'png', null);
INSERT INTO `xjy_asset` VALUES ('18', '1', '595284', '1511778536', '1', '0', 'bdf3bf1da3405725be763540d6601144626863c89f9df456fcdad064b8608d13', 'Hydrangeas.jpg', 'admin/20171127/00844f3b53e584df35967a57744e38ba.jpg', 'bdf3bf1da3405725be763540d6601144', 'd997e1c37edc05ad87d03603e32ad495ee2cfce1', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('19', '1', '845941', '1511778633', '1', '0', 'ba45c8f60456a672e003a875e469d0eba118a509fc3b269e5e76cc913ecfa96d', 'Desert.jpg', 'admin/20171127/6c42578fd7756e96031b4286488b0867.jpg', 'ba45c8f60456a672e003a875e469d0eb', '30420d1a9afb2bcb60335812569af4435a59ce17', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('20', '1', '777835', '1511778652', '1', '0', '9d377b10ce778c4938b3c7e2c63a229ae9ac65c5d7d2a9fab8d55e48b03f8304', 'Penguins.jpg', 'admin/20171127/e19630412abdfdd39489c2ff2acc7bb1.jpg', '9d377b10ce778c4938b3c7e2c63a229a', 'df7be9dc4f467187783aca68c7ce98e4df2172d0', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('21', '1', '561276', '1511778722', '1', '0', '8969288f4245120e7c3870287cce0ff3f7d51bb925fe6e8387923d3a96b99a9d', 'Lighthouse.jpg', 'admin/20171127/28d694b2ab0d1fc9e29ff2fe29367b40.jpg', '8969288f4245120e7c3870287cce0ff3', '1b4605b0e20ceccf91aa278d10e81fad64e24e27', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('22', '10', '561276', '1511779474', '1', '0', '8969288f4245120e7c3870287cce0ff3f7d51bb925fe6e8387923d3a96b99a9d', 'Lighthouse.jpg', 'admin/20171127/8c4f0562c9938e7eb2af0a16e2d3872b.jpg', '8969288f4245120e7c3870287cce0ff3', '1b4605b0e20ceccf91aa278d10e81fad64e24e27', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('23', '10', '777835', '1511779495', '1', '0', '9d377b10ce778c4938b3c7e2c63a229ae9ac65c5d7d2a9fab8d55e48b03f8304', 'Penguins.jpg', 'admin/20171127/736b0efc77cf5cc5298fe0e2192c9451.jpg', '9d377b10ce778c4938b3c7e2c63a229a', 'df7be9dc4f467187783aca68c7ce98e4df2172d0', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('24', '1', '620888', '1513306211', '1', '0', 'fafa5efeaf3cbe3b23b2748d13e629a1ab74ae38b5499915e0c35613f8b67656', 'Tulips.jpg', 'admin/20171215/fc8b7dde98424c9fe8403a210a4aaeb3.jpg', 'fafa5efeaf3cbe3b23b2748d13e629a1', '54c2f1a1eb6f12d681a5c7078421a5500cee02ad', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('25', '1', '84156', '1515405890', '1', '0', '9f93c85496047ccac31a68819092d6bb7029590f437b4670a4f17fdc7dd12b96', '239ce672b74c11e6947d0242ac110002_1280w_1280h.jpg', 'admin/20180108/59b8be9c5f4053880749f9f657b6c014.jpg', '9f93c85496047ccac31a68819092d6bb', '154664b547ddb3ef32b219e668faef56a3190064', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('26', '10', '201040', '1524292448', '1', '0', 'ad7c06c5e8744412e60fb5c75431fe410909169bc53c87841d635c7fa9fee083', 'logo.png', 'admin/20180421/d31f4e9994ecc6742af502e9667104b6.png', 'ad7c06c5e8744412e60fb5c75431fe41', '533c069ee78f0ab103395c84b02c34831e00aca5', 'png', null);
INSERT INTO `xjy_asset` VALUES ('27', '10', '192173', '1524292459', '1', '0', 'e03534ff7137ed2f91eef277f2fdd6b2311e45153e3ccef53c89706a29286f0f', 'Slide1.jpg', 'admin/20180421/bb57bfac1bee15b84da6ff235a164a55.jpg', 'e03534ff7137ed2f91eef277f2fdd6b2', 'cce495fe08beb5d5aa09f5e687265d90e533f9d3', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('28', '10', '124161', '1524292725', '1', '0', '7689581a38fdebd7baa01f5f33bdfc20ed9a13e366cf8437b31e2d0d6060977d', 'seller2.png', 'admin/20180421/580d0fd14561589def147f6a72e7e7f1.png', '7689581a38fdebd7baa01f5f33bdfc20', 'f4bc0abecfff478c16ea929caf8569d7cb04b207', 'png', null);
INSERT INTO `xjy_asset` VALUES ('29', '10', '178499', '1524303734', '1', '0', '5df3cf0e41babdf56083060da2fc6ad0452ab30a3ebb840537aea2bdcc39758b', '201112191743419.png', 'admin/20180421/b2f5bd94428705e45a04b225918531c1.png', '5df3cf0e41babdf56083060da2fc6ad0', '5214a80584430d821b33e920ce6b7e58217992c0', 'png', null);
INSERT INTO `xjy_asset` VALUES ('30', '10', '688273', '1524304034', '1', '0', '7c246d2927c65edc10a453bb4d47cc0acf0e2a5b74eb2464b80bce55c02da810', 'ca1349540923dd54fbfa79c5db09b3de9d824896.png', 'admin/20180421/7eb25e0063d8b13ea1865481bc920e34.png', '7c246d2927c65edc10a453bb4d47cc0a', '47a62a8a6b77439453e268d08b0cfca2a39acfa2', 'png', null);
INSERT INTO `xjy_asset` VALUES ('31', '10', '4762', '1524304084', '1', '0', 'd0ed0f4b72385344ee9a757d0d53655faa8446212df4ec71cde6ae280e79661e', 'u=2271382880,1768913126&fm=85&s=632CB70FE2F81380010B8D740300A079.png', 'admin/20180421/df03de7b60724fc33ed16bddff39e0f7.png', 'd0ed0f4b72385344ee9a757d0d53655f', 'a74a1e1dbf9e975d7b60b993f1223d7552e27ecc', 'png', null);
INSERT INTO `xjy_asset` VALUES ('32', '10', '11496', '1524304117', '1', '0', '16ec27d5d1ffd9d185a3b18be0590f0f1449fa5d9085ad75c1e00012fc372499', 'u=3310484668,2985889182&fm=58&bpow=1080&bpoh=974.png', 'admin/20180421/75e2debbc82e99d34b11fa37dbf7837b.png', '16ec27d5d1ffd9d185a3b18be0590f0f', 'c66e402f3514a0a7c596c7e6470580dedd2900f8', 'png', null);
INSERT INTO `xjy_asset` VALUES ('33', '10', '8266', '1524304158', '1', '0', '9853d657ec3e8418af52436f00b086465b8acfb21a6eeb0a0f6fae8b019487f2', 'u=267594754,3630081179&fm=58.png', 'admin/20180421/5594879d30275fe21a958cb5531c92d7.png', '9853d657ec3e8418af52436f00b08646', 'be0f6aa199cbe46c9c45ce8c63d6f6435279c10d', 'png', null);
INSERT INTO `xjy_asset` VALUES ('34', '10', '8907', '1524304201', '1', '0', '97e47c9e96e7ec27608d09cf988ea820d4918a60486de5e2241fc45d62341141', 'u=1429554231,3993708108&fm=58.png', 'admin/20180421/eb817bd0abbfa458abbf64dc9460fe01.png', '97e47c9e96e7ec27608d09cf988ea820', '8709cf243cf275fc6237295e52b34d041756c287', 'png', null);
INSERT INTO `xjy_asset` VALUES ('35', '10', '14639', '1524649429', '1', '0', '04c0197228258c22c46c9e00ecdcbbe973f2364c85a88fbd57f69eaa1394b896', 'logo.png', 'admin/20180425/011c7fd50007f693e55dba071448f1f1.png', '04c0197228258c22c46c9e00ecdcbbe9', '94da233be722a6f893f114c93bdf6c1d001f586a', 'png', null);
INSERT INTO `xjy_asset` VALUES ('36', '10', '83666', '1524649525', '1', '0', '58502028c27a4bc38f923b9e8cd22e6168bfc478aabe1123eb6f7aee6b3cdd54', 'bingfeng.jpg', 'admin/20180425/0e73435329aa4132fc1fb4e45f1edc05.jpg', '58502028c27a4bc38f923b9e8cd22e61', '6aad30f4e6608babe9c4cbb31303b3f57ca41255', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('37', '32', '42847', '1527747688', '1', '0', '61a53388cd134266cc8e1a317c254dda1b7b24478892edf6a966dfa01e2ce53e', 'u=1802870730,914366982&fm=27&gp=0.jpg', 'admin/20180531/1cb61222698ce06e503634fb02f86d0f.jpg', '61a53388cd134266cc8e1a317c254dda', '5c05c9170cb5dec230f5b32cb6170cda260dbabf', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('38', '33', '42847', '1527751898', '1', '0', '61a53388cd134266cc8e1a317c254dda1b7b24478892edf6a966dfa01e2ce53e', 'u=1802870730,914366982&fm=27&gp=0.jpg', 'admin/20180531/1fa3d4ece071b839e6dacb0f46ab00d2.jpg', '61a53388cd134266cc8e1a317c254dda', '5c05c9170cb5dec230f5b32cb6170cda260dbabf', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('39', '32', '68474', '1527758972', '1', '0', '3c3dfbebdd77d5619244b7f202bafd545ccca619273d8671c028028893216764', '141208ee7t3ewz4i37ul3t.jpg', 'admin/20180531/c184b25e14629c91597927e2eaaf719c.jpg', '3c3dfbebdd77d5619244b7f202bafd54', 'f5c19a84a9f060cf5b6f54585d315540e7f446ee', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('40', '32', '20317', '1527759135', '1', '0', '44ba553e41df86963ba5ada5536dd1f738c4aef30e0add8e6734736b8afbc6bb', '0.jpg', 'admin/20180531/d16079a9ec1f34eb9e78f3d90dbc0088.jpg', '44ba553e41df86963ba5ada5536dd1f7', '4e4763430f99074e99054600158c202a4f40f6db', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('41', '32', '3695', '1527759340', '1', '0', '29f4a467576415758934a65c097a798d9ec13fdd1b847bb3bf3e1d6b604cdef8', '下载.jpg', 'admin/20180531/b401d7542e1368677e955ae88384df10.jpg', '29f4a467576415758934a65c097a798d', '0c0ba567072dad83816b2f8daacca42602e1fd12', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('42', '32', '35847', '1527760197', '1', '0', '77abb4278cbccd8eddc96ca5147dd1380fa662f498dec9bb4acea8580efdc100', 'TB2stGGhFXXXXbNXpXXXXXXXXXX_!!52642096-0-saturn_solar.jpg_220x220.jpg', 'admin/20180531/a09cf7d78b63dc4c16d97898047e3666.jpg', '77abb4278cbccd8eddc96ca5147dd138', '05fd6cd1a7cd0ef12fe76e0d938a94209c99bcbe', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('43', '32', '142905', '1527760573', '1', '0', '3df842c1d1ee72f8f66d84ccc44223239d90b555ebf50f9f02ca78efbf38a44a', 'TB27M1Na4UaBuNjt_iGXXXlkFXa_!!720366107.jpg_400x400.jpg', 'admin/20180531/0048450136cb40a7b4c9dbfc1f50599a.jpg', '3df842c1d1ee72f8f66d84ccc4422323', '6a370998bb54a192c4f639e0fc4fd958ff935efe', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('44', '32', '14594', '1527760923', '1', '0', '4143a2c6a004f26f398fe2f348c64f8c025da85e8c417f9905fcc8a6f2a4bb29', 'link.jpg', 'admin/20180531/db77105b76d82f2146b260a95d7df2e2.jpg', '4143a2c6a004f26f398fe2f348c64f8c', 'd4a7e6fd1644ca628a392231f006dbacf7812e22', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('45', '32', '18771', '1527841147', '1', '0', 'ace94cf61ad08a60f7f183fd9f9225121a4e302e850a71cae2f6a19bfb3d7c46', 'link.jpg', 'admin/20180601/17cd5411da06630f14e27250ea917bb9.jpg', 'ace94cf61ad08a60f7f183fd9f922512', '25e9a007b8da39f807b1b91323c1a0dce7a4a2fb', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('46', '32', '18801', '1527841376', '1', '0', '1691c6db9f030f2aea65f99876ce78b10099db9433dbd36951bd614d776b1499', 'link (1).jpg', 'admin/20180601/35a19b7b9274fe20559b0f171ad564d0.jpg', '1691c6db9f030f2aea65f99876ce78b1', '96f81b98a8b96a7c351fe76e77815dfdae8d8b3b', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('47', '32', '9084', '1527841632', '1', '0', '3c8aeaa3598aa64b05c8f233d1364b7ece6b526f488243f141e6218e657c2985', 'link.jpg', 'admin/20180601/518b839e173be927c2ffa15cb64351cf.jpg', '3c8aeaa3598aa64b05c8f233d1364b7e', 'e8f32e2a0274bcfd6aa76990dd502b15f960744d', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('48', '32', '54011', '1527841661', '1', '0', '328c68027c6ab7652c4e4a08e57f89da6277272e20b02ed05b0006d4f04b03d5', '5788a62c695a3.jpg', 'admin/20180601/d9bab142b16f3d50eb2afcbf8b63e026.jpg', '328c68027c6ab7652c4e4a08e57f89da', 'a5c748dbdbe8989f77566fae898899a3f845cdf6', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('49', '32', '10632', '1527842033', '1', '0', '7975190b05f47ab2dc3fe84dc5261b9ff75b94d7ceb18d10d8ae548c92e58f15', 'link (1).jpg', 'admin/20180601/1f60a323ba83bf9df4379a2b411bc133.jpg', '7975190b05f47ab2dc3fe84dc5261b9f', 'dcc5ed7ad92bc8e6f6ff72d526ae3a6b699a4e70', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('50', '32', '8966', '1527842130', '1', '0', '8012616829e38b5874df09d6a83cce2ec5d03e60cb413c69f2eb7115ea798c27', 'link (2).jpg', 'admin/20180601/f716a87b720cac43b37779e914cb5a71.jpg', '8012616829e38b5874df09d6a83cce2e', 'cbecf64dc9dc7fc5c4248cb7796f3e329cb9998d', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('51', '10', '15559', '1528098017', '1', '0', 'a1f470fc112e1ef64ae2d128966ba219db41a645fc1a2884ca607af5de2d0f4f', '112x92.png', 'admin/20180604/e9a216ee22ba5919aea13fb144fea421.png', 'a1f470fc112e1ef64ae2d128966ba219', 'adb34e93ec11e63dd48fe89d8c6f1cda3b38d70c', 'png', null);
INSERT INTO `xjy_asset` VALUES ('52', '10', '64283', '1528098183', '1', '0', '29ec08adba4fa8e0bdcff801c09f3c96086e2b591a5b2e5926760dceda283e9f', '0{AL8A@U(5V7CSOO2XM]5HK.png', 'admin/20180604/c7836b0e00154bc1d52da3870bb706dc.png', '29ec08adba4fa8e0bdcff801c09f3c96', '03ca736890fc9593fa26061dc185e8652aad3552', 'png', null);
INSERT INTO `xjy_asset` VALUES ('53', '34', '28988', '1529136443', '1', '0', '5a5a1419a406ccf6c243536ac25e889981990f581aaa8c76da5b2cf74c805503', '1_meitu_1.jpg', 'admin/20180616/d3d065c9ea913a1348b90e26667248cb.jpg', '5a5a1419a406ccf6c243536ac25e8899', '666a12123a427416ee6842a47796b8f22556c3ea', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('54', '34', '121844', '1529136736', '1', '0', 'b7833cc45bdfa953ad7926aea8a8d37590ef3afbec961ad58f84c3a5dc5855c4', 'timg (1)_meitu_3.jpg', 'admin/20180616/76d9034961c97f243a7edaa1a30f556f.jpg', 'b7833cc45bdfa953ad7926aea8a8d375', '606843466e52229a77a1a716808af68a09ab5ee5', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('55', '34', '47280', '1529137857', '1', '0', '1be0553d7b81ca59b96def0458fa83676a1f3339c449d966faa1f6cb5394729d', 'timg.jpg', 'admin/20180616/2066dccebaa2c700233a7354f505c922.jpg', '1be0553d7b81ca59b96def0458fa8367', 'bac1c5811b1b0594d34ad88d2db688d0d1beef81', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('56', '34', '22566', '1529138018', '1', '0', '5571fcecbefec9bd02e7f0060c30638c0f7af2a7b6ef87321a4f15d6c91b7ac9', 'u=2537784822,2662307164&fm=27&gp=0.jpg', 'admin/20180616/5181135e34ac7c4ae87284662d1aa2c0.jpg', '5571fcecbefec9bd02e7f0060c30638c', '506c3231ca6f791a92ecb29e9f701eb4bfeb9d16', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('57', '34', '20207', '1529141489', '1', '0', 'a651cc3a9ae3ecc9682a0e8258edae15e63ffe14e332f10e648b8d14de329142', '花毛峰.jpg', 'admin/20180616/8dd5e6b7259a18e4aa752ed70025bf06.jpg', 'a651cc3a9ae3ecc9682a0e8258edae15', '773c85456fe9cdc68b3b1b78e6e49e261c842b7b', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('58', '34', '33377', '1529141532', '1', '0', 'aa7baa7c18fd755b3c45c4630d935c2bf30b74d101387629cc803b50e428b5cd', '素毛峰.jpg', 'admin/20180616/12c1b196586d57e06291dc8201faaf39.jpg', 'aa7baa7c18fd755b3c45c4630d935c2b', '799b65ba594e275a517d561a277a85ca85b4c27e', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('59', '34', '60782', '1529141561', '1', '0', '30f583f30e3fe346bb6e00677aadcdfed096e09ef65d12ef668518efeebfa6fc', '铁观音1.jpg', 'admin/20180616/e3a8acff149ce147a18d0de01f31055c.jpg', '30f583f30e3fe346bb6e00677aadcdfe', 'b0d0e64074cf692723051cc6ff35fc07b4aae4ec', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('60', '34', '26816', '1529141582', '1', '0', 'b5f19c5ce65c01ef06746215caeda2588677da677d9702e5b6620f405a4c93f0', '金骏眉2.jpg', 'admin/20180616/ce7ea6328a3156ed9b4e3e049f19fd44.jpg', 'b5f19c5ce65c01ef06746215caeda258', 'd84f1da909e7a3cc272e3d64f1ad81ee44ca2e29', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('61', '34', '65503', '1529141605', '1', '0', '7a6cf4d85d1111aae5bc1ece558819fa3e1780b9c58fe5a92b648da1a114aaf2', '飘雪.jpg', 'admin/20180616/8a3efd61cfc960b5ea8cd8df0bd6c0f0.jpg', '7a6cf4d85d1111aae5bc1ece558819fa', '510629a7bfbfc11b8b4f2ad45d7a7fbbd3ba1487', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('62', '34', '220077', '1529141635', '1', '0', '1450b2a6e3d329312f22cf2610c9933e2eaaa2217f85f98921fa614e4a99944a', '竹叶青.jpg', 'admin/20180616/f367111aa162b43563189e0c0b326e13.jpg', '1450b2a6e3d329312f22cf2610c9933e', 'e6640f0c211b2233d7eddd9e94aa8480e8761de7', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('63', '34', '53243', '1529141657', '1', '0', 'de71061b9fcc223422c25dfd840a83e0c7b5b41ded53c81534d2942b50144be2', '铁观音2.jpg', 'admin/20180616/b754571e68bbbf8994c676bc0b12198b.jpg', 'de71061b9fcc223422c25dfd840a83e0', '9d7eb137113eb3d6477aa04b78ad6c6252c57a06', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('64', '34', '31690', '1529141688', '1', '0', '1cf215b69cfac54288f250439474ebdab2276dc47b86617a9eba4c8fb9859af6', '金骏眉1.jpg', 'admin/20180616/680a4869d5dcb577de8e1c86b5050895.jpg', '1cf215b69cfac54288f250439474ebda', '5490e376c4bbf3f8dbe22cb93cc7978f492a1600', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('65', '34', '34281', '1529141718', '1', '0', '919c1c9cf33d157746d0b1b2e397e1ded9536c6718e74e9d167d7aae798346d3', '祁门红茶.jpg', 'admin/20180616/10efdcb11c6a4cf7491f41eaade2c296.jpg', '919c1c9cf33d157746d0b1b2e397e1de', 'd4e5173dfa615e38646dc7bfdf40d996f98d9c96', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('66', '34', '169346', '1529141740', '1', '0', '3123bf28d4668d6c1408fca3ee45b6fbe59187e4dd8b63cf0d16884e7e6ef2d0', '贡菊.jpg', 'admin/20180616/a5381b770570e3fa3755ffe036d7ce63.jpg', '3123bf28d4668d6c1408fca3ee45b6fb', '376ee33c501b97ffb78da4ca3b9c38bed25d6bdb', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('67', '34', '102586', '1529141764', '1', '0', '4b5d4da5cb6288196a325bda784d12e5503a08391951e6bf6f379e7dc41446a8', '苦荞.jpg', 'admin/20180616/37a2841b6170c1cd8dd167784e3be638.jpg', '4b5d4da5cb6288196a325bda784d12e5', 'de858eaeb8741c45ed441392f7c1bf990d63350b', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('68', '34', '33018', '1529141792', '1', '0', 'c90d4e1dd1d8bc05d7c71fcd247ab2fbce036d742e04d78cbea69af606bc83e0', '银花.jpg', 'admin/20180616/2ad1e38da7d5205bc83d4c6f723f3471.jpg', 'c90d4e1dd1d8bc05d7c71fcd247ab2fb', 'a2e44295c670a31e9fb90960e1705733ca9f2807', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('69', '34', '128312', '1529141814', '1', '0', '8a1bcdfe2ea21ae7a7e6e846e02c13c6e18272830f03061908479468577e5f10', '陈年普洱.jpg', 'admin/20180616/bf1227eaeb4d32e964c1a6d023c1948f.jpg', '8a1bcdfe2ea21ae7a7e6e846e02c13c6', '070001cc23dcdeb5e350f49e375555b0dcf75be4', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('70', '34', '15306', '1529208140', '1', '0', '43bfa4c2ac472b53ed9fc15041e55ef14d82da42bc688995f4d54dc0687f1ee2', 'timg.jpg', 'admin/20180617/c66ac80c14824e01cc75bffaf13e50af.jpg', '43bfa4c2ac472b53ed9fc15041e55ef1', '0e55ddea99b9d00b896130f7624e9304e072f10e', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('71', '34', '13221', '1529208208', '1', '0', '8c39f0bde4dfbcbe6b7600f1e09a011b96e7cb9fd19eda6d9b16ab69d5043da9', 'timgQ22LOD06.jpg', 'admin/20180617/1013d3d1b3f9c164fd9148bb9651842f.jpg', '8c39f0bde4dfbcbe6b7600f1e09a011b', '5d6cbf68d2be95731cd22b9c78bf5621c3722742', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('72', '34', '21349', '1529208232', '1', '0', 'a4c9c891e09d2c5d93300691fb0278ba984cc32b5cc3532cbfd581c3a26260d6', 'timg89YIGXX0.jpg', 'admin/20180617/2485b0f1a34e2537533d64841a328271.jpg', 'a4c9c891e09d2c5d93300691fb0278ba', 'ad2e87b65996d6de3f40e83c5a86b194c619fce5', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('73', '34', '26868', '1529208248', '1', '0', '9e0912ae04384efed5368195c965ea41625d6a7f445376eb1e20673d720c508d', 'u=2928215776,383962315&fm=27&gp=0.jpg', 'admin/20180617/f7aa31392c5513a9c7c38741e0fcc187.jpg', '9e0912ae04384efed5368195c965ea41', 'd7b0aa6d3b111f05964ca0a7556ac20787382684', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('74', '34', '10212', '1529208298', '1', '0', 'c7908341a1ef3e77b5d6eb1a0bba6776f5021110c08bb60d3fad62eb4329e45b', 'timg38FMGKCH.jpg', 'admin/20180617/a8ffe704e375878f0b88c87ae0ca1115.jpg', 'c7908341a1ef3e77b5d6eb1a0bba6776', '208d367ab9a600d24c6281c082009e8a7bba27fa', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('75', '34', '40666', '1529208410', '1', '0', 'abe16d84f8f2d95fcdadf55666d456456300ba586cbe8060eeb4f59c80086383', 'timgOG4682GK.jpg', 'admin/20180617/ba29e11750d0ca72fabfab3eae717375.jpg', 'abe16d84f8f2d95fcdadf55666d45645', '1cd307a5b0f83ce103d82124db1be255c2d0eaca', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('76', '34', '35975', '1529208434', '1', '0', '1d3e59818c5cb477972d7a6b27df389e0c18b24c2ac7df6df542a067e45e995e', 'timgQ6ODFXQ9.jpg', 'admin/20180617/723bcba5351e5e8ead55783e70687708.jpg', '1d3e59818c5cb477972d7a6b27df389e', 'c115cf3cf7afa23d9544edcdc519db859533ec50', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('77', '34', '22600', '1529208459', '1', '0', '595303024eab1f1f78748258c31c32adbc44a83b78fed091ad2fc97d2663895d', 'timgJZRLV6AZ.jpg', 'admin/20180617/49a46eb494301b717536011e147b7344.jpg', '595303024eab1f1f78748258c31c32ad', '145082c221313addc751e1c8b5915f9c97f91d2b', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('78', '34', '26752', '1529208480', '1', '0', 'a5b14fbbc7add5bf7dc4e3fce84a420b5ea059f8297a65d7ef043746de7bfe76', 'u=101751335,3336184003&fm=27&gp=0.jpg', 'admin/20180617/92f4d0274cb4d59dbd7760460a1a6b04.jpg', 'a5b14fbbc7add5bf7dc4e3fce84a420b', '8856928d3eaf6f704b2f21853df3f3ab8621a212', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('79', '34', '20046', '1529208499', '1', '0', '2588f220792fff5e4392c92ad02036974406bd8fc3f279e69922c3559937ae1b', 'timgBO0JKU8O.jpg', 'admin/20180617/dea3ade6bf6240dcde6c7227dd48ec52.jpg', '2588f220792fff5e4392c92ad0203697', 'a59a59925c9c2b3874852345856ed4c52edcfde9', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('80', '34', '55360', '1529208528', '1', '0', 'a69c148b3c088a35e255d7fca34f99ff8c6a61bc1f59954402010a1a33c69c14', 'timgEKPF301Q.jpg', 'admin/20180617/5b3f6750149c21bef039afa7126f5a05.jpg', 'a69c148b3c088a35e255d7fca34f99ff', 'ef94cb09ab8de33409f2fa3a6de7d6817e3d135c', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('81', '34', '27925', '1529208566', '1', '0', '85d14b690371c4b2eee4405c41a528fedccac8c6dfab186c89c9c3d155d7174e', 'timg9Z1NLB9S.jpg', 'admin/20180617/ba9a1cac7392abdfffbac14f657f022c.jpg', '85d14b690371c4b2eee4405c41a528fe', '4808705fc463f3f95b8ac2d7c23837f88f3a25d9', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('82', '34', '35597', '1529208607', '1', '0', '60acf03d80c301ea052e928dd1143bdbffb140d028916bb339729cb1ab4e06fd', 'timgB8MRSEVV.jpg', 'admin/20180617/bb08650794aece2899be1d8ad4b0a709.jpg', '60acf03d80c301ea052e928dd1143bdb', 'ef88d2d9a2469c2acb51903fc4facc0316b90f1f', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('83', '34', '31381', '1529208643', '1', '0', '3e40dae89ce83b910bec20b854698854b8e9cad83a0c1a3de38f2fb764f9fdd2', 'timgHIW8Y34J.jpg', 'admin/20180617/eccc6df776ae80fcf2130540e357e6b2.jpg', '3e40dae89ce83b910bec20b854698854', 'fa870dab925a7124a493da745e7f9ccec1456cf1', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('84', '34', '26551', '1529208670', '1', '0', 'a024bfdb1f73c9cbbea98e29451db0a2e349ba4f06f16cf46cb452de43e308ad', 'timgZV6J39BQ.jpg', 'admin/20180617/1c98e3f63627e0d06587e405f7c83aa7.jpg', 'a024bfdb1f73c9cbbea98e29451db0a2', 'bd8282f5e02bb4981eb7731c52cc5c761e01b6de', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('85', '34', '29549', '1529208691', '1', '0', '6693ed78b1fcf30b32095c5cea83ea4974e375a0d2f7aa1cd13664f649f99df2', 'timgP1HV05AU.jpg', 'admin/20180617/e1ac3962415b3b9a475bfa816cd58435.jpg', '6693ed78b1fcf30b32095c5cea83ea49', 'a37f0df727b4825f7af22092f50f16298b96dab1', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('86', '34', '26490', '1529208877', '1', '0', '176b4723e1e279748ba082816d8a19f7e6c304710f5470a3d945ff50554a31b8', 'timgIVOPKDYU.jpg', 'admin/20180617/f028237ed9e0d5d166986c5fed59d554.jpg', '176b4723e1e279748ba082816d8a19f7', 'd8feedc7fdb13818dfeeba99afc9d2ac5c9ebdc4', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('87', '34', '64190', '1529208904', '1', '0', 'd8f8cd1b0888350f6a66d94cb0832778baeddb05405660a223afd43096c589a7', 'timgVQPJ88JY.jpg', 'admin/20180617/b20962d8074ad84570c8b46840c1d82e.jpg', 'd8f8cd1b0888350f6a66d94cb0832778', '50cf2cddc0bf5cd0ded6bb41dbd05c746d771f08', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('88', '34', '47422', '1529208924', '1', '0', 'd4c97777fa925b97b8ca0fabb8c9dec356d918da19378d55059cd9596251017d', 'timg7VD0PETD.jpg', 'admin/20180617/897006d4e907f2297a768063e35b443b.jpg', 'd4c97777fa925b97b8ca0fabb8c9dec3', '20ec7d91ab885b0ae8999d29959132e310f3f90f', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('89', '34', '85719', '1529209156', '1', '0', 'ce376a6a267b01df4ac9544f6c534c71b00e761d69e5e70fc26db673f0428d9a', 'timgLZHJC7KR.jpg', 'admin/20180617/3445c6eec76ced271ac3e35e4a5b219b.jpg', 'ce376a6a267b01df4ac9544f6c534c71', 'e7dc228dcce68c428d6406dfc43ac28dac55810a', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('90', '34', '33960', '1529209186', '1', '0', '3998925815957fd5d8f363132a368f5fa64b91ecda9406107bb9e42d03a10b9a', 'timgVZKUY25F.jpg', 'admin/20180617/f85a1caa4b49d26e44c85fe1527ed76e.jpg', '3998925815957fd5d8f363132a368f5f', 'dff452eadc8b6b48349c4aed21e227fc4a7e589d', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('91', '34', '47128', '1529209223', '1', '0', '5863331dfe4f5b5d463eb74afe67fe7c01a423e87e3b42c2ed07879c11b30ebf', 'timgSRA3R55M.jpg', 'admin/20180617/f4b7733ef227415fa7d3ecc5a2f6009f.jpg', '5863331dfe4f5b5d463eb74afe67fe7c', '28499d7135616c8561d083cba3228b71141bf075', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('92', '34', '38681', '1529209242', '1', '0', 'a2361de45dc2db563d7edfa9dce4b56d0bf967b0d9cf18c5e38c114713ba79c9', 'timgVG7XCIE5.jpg', 'admin/20180617/714b60b0f6d295de4fba419a5b7d9639.jpg', 'a2361de45dc2db563d7edfa9dce4b56d', 'e37514593b2d6dda62b5f4d0ac367ce70b38a6b3', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('93', '34', '37023', '1529209270', '1', '0', '06ee3ec0c9080312b5d455b41294295db96c5ef329d06b4ccd3038421e8f925a', 'timgCIADNERC.jpg', 'admin/20180617/720a6b7520b4378f388257d199669b9c.jpg', '06ee3ec0c9080312b5d455b41294295d', 'a85d261c3827ea16ff2d0748e55439a642764861', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('94', '34', '29941', '1529209299', '1', '0', '28d8da9edd71a029e1f71b38d08abc71bdb66b4f138c2df94e2f7c6d009faa4f', 'timgFKVQYE6H.jpg', 'admin/20180617/d096a74cc6a743b6bcfe183a1b08abb4.jpg', '28d8da9edd71a029e1f71b38d08abc71', '3f74ccb85aa8e6b3473fd3d5ed07c0123b1bd4ba', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('95', '34', '18889', '1529209319', '1', '0', '8038d613b888af8de203b248f1ad51acc5a0da9d31f71941ca2d431c8852395c', 'timgUIRVQPWF.jpg', 'admin/20180617/65523740828beeaa22dcedd64d7b555f.jpg', '8038d613b888af8de203b248f1ad51ac', '871980d408e6ef353ee0463c6fd37554518f1c3f', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('96', '34', '82896', '1529209338', '1', '0', 'fcd406b753b180858d3db0a95733fae305b114999e084a69ccdb7c141be97256', 'timgOCUXZP6Y.jpg', 'admin/20180617/b4a4032a89a6019696b8cf51f4007b5e.jpg', 'fcd406b753b180858d3db0a95733fae3', '7dbcdff8e0b2636a8c96361327c554d8d63d2ce2', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('97', '34', '73607', '1529209358', '1', '0', '8b43ae2728ba5ca9eab14aaff673b7317a4e60d4f0fdae98a08e14be39d74bb6', 'timgVEYX9COK.jpg', 'admin/20180617/6d4f80213423c54c980f6bfdf4be6b91.jpg', '8b43ae2728ba5ca9eab14aaff673b731', '13662a065db06c3be5a9142cbc5ea075125d4c4a', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('98', '34', '38298', '1529209380', '1', '0', '74cc612b7dc64bc35d3e5137805a52c37965bd1ded0ebfb611883890f8d63f6d', 'timgP33WIN8J.jpg', 'admin/20180617/803d863345b49368e9f39d74d5cfd975.jpg', '74cc612b7dc64bc35d3e5137805a52c3', '669d5ec6955d22a5378dc93f556bbbb3fc426751', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('99', '34', '18068', '1529209448', '1', '0', 'd09c6cd66127416f2f7d0117e9e99ef8542638e1d958bc48d439bacb978224d7', 'timg.jpg', 'admin/20180617/5d321b0ffc721e58133906d89e268039.jpg', 'd09c6cd66127416f2f7d0117e9e99ef8', 'd3660007b41ecb39f0f1b192d3be296fdfae76aa', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('100', '34', '195508', '1529209497', '1', '0', '886f645e4a2f7e180098d8bdfd51fd1125aefee73a780d13362bfeb695653871', 'timg (2).jpg', 'admin/20180617/695cb0ba9880a1c6b1d508d508f03344.jpg', '886f645e4a2f7e180098d8bdfd51fd11', '04ad0c561be236f66a319818acce034209994a88', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('101', '34', '38683', '1529209570', '1', '0', 'f207362e6d8a21378223f34385b6c423b78cf1d6521cde8508db26c1b34fcfaa', 'u=2357717431,1408078400&fm=27&gp=0.jpg', 'admin/20180617/7f4e9219ef8e9ad5b48d9e5a6122c632.jpg', 'f207362e6d8a21378223f34385b6c423', 'f1c9d80b6382de968829a0acc6a45921197a41af', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('102', '34', '146942', '1529209663', '1', '0', 'd5bd5e5d86038da9bf398449eaede1f5de3e086c31c88c89a43af8e9dedd3663', 'timg.jpg', 'admin/20180617/82e826d415e32aaf236bd3248ed94944.jpg', 'd5bd5e5d86038da9bf398449eaede1f5', '69b7329cff75282b142248711e9dbfcd2fbd956d', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('103', '34', '52271', '1529209729', '1', '0', '59d0b15a29b22a8a7f2f365c3b3931b340dace39a751ab29873f5717c85d7f61', 'timgKKFFCCZR.jpg', 'admin/20180617/7c1e825a95bd1cb9b91e7687f61634fc.jpg', '59d0b15a29b22a8a7f2f365c3b3931b3', '74f810e7fee9f428573e1e8579d886b45be007c1', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('104', '34', '31755', '1529209816', '1', '0', '54421dfa99579bf0b9383b90fbd91ba4998ec0e7b80e1cbf90562c7a0f7e9d86', 'timgJF3F1MN2.jpg', 'admin/20180617/2b384efc56d831df53b3e9ae586df757.jpg', '54421dfa99579bf0b9383b90fbd91ba4', 'a8e96e47d47b8e05f7f6d28c28b8579d9209435f', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('105', '34', '138142', '1529209852', '1', '0', '92c044e4e55ed793cfc89e5210271a008eaf44136b9505157966517686c2fad3', 'timgYCQE7686.jpg', 'admin/20180617/4eb049b628acfdbcfe2f7330186bc032.jpg', '92c044e4e55ed793cfc89e5210271a00', 'd233de2b3c4fe3435a58dfdaec543adda49dec99', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('106', '34', '79181', '1529210014', '1', '0', '241e2c0c2f9f5b6a26cd575cba48d17b5a0bf181546cafd14fe61424ffdf6905', 'timgQTOX49U3.jpg', 'admin/20180617/b06c1585e848b102fe9e07a1a54fd00d.jpg', '241e2c0c2f9f5b6a26cd575cba48d17b', '243dbbf8307562dc9d3485ebc1d36c88f654ef04', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('107', '34', '31940', '1529210045', '1', '0', 'b203daadba5f56da6b3ba00ab619623ad674547f0f89420f2ba7f3cfa90ff5c1', 'timgZHB07T23.jpg', 'admin/20180617/71ebd98c7539f1891052ceab49459c0b.jpg', 'b203daadba5f56da6b3ba00ab619623a', 'c4de98221df91717b667c3a9deac2887d7da7c70', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('108', '34', '13946', '1529210068', '1', '0', '6776f4c4767e9f34e65fe44339a007a139becdc271d2aaf5313bb9a8dd6712e1', 'timgDTWH45HM.jpg', 'admin/20180617/9e68af8ec3423d9a528b894d9aabaae4.jpg', '6776f4c4767e9f34e65fe44339a007a1', '5d5995178414ed74664da4c9bf3b67724a43d833', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('109', '34', '126298', '1529210152', '1', '0', '9a9a44d00a940d405b2f6c42fdcfb6490e04a13a33393b3e50e8c6863884846b', 'timgX66V9S33.jpg', 'admin/20180617/7b27cae869eab3672c4faad977e145a7.jpg', '9a9a44d00a940d405b2f6c42fdcfb649', 'de4cfcb438bd45885026dc8fad4b970278d87e39', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('110', '34', '17526', '1529210189', '1', '0', '02d2c166a21baf00f155bfdc07a93ce6e405e56e1e1d983732421ff6a9f158b2', 'timgKP7ZN7AS.jpg', 'admin/20180617/d1147361c5dfecdac069bd29d3ecdeff.jpg', '02d2c166a21baf00f155bfdc07a93ce6', '86ac0ddc1edd79f5c1ff78baf0a636f0068a5b19', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('111', '34', '99096', '1529210320', '1', '0', '20db2dbeb55f71205fc9685c4a2e38a9ecb4a2a54ff40367ead16ae066ba275e', 'timgGKJKBKPH.jpg', 'admin/20180617/3675c60503763ebd1763e5eae34ce143.jpg', '20db2dbeb55f71205fc9685c4a2e38a9', '4185f1e06b6300e0bce564a535adfd34d958a51f', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('112', '34', '35785', '1529210343', '1', '0', 'ad43f7a78251244affee832344b66cde50b04290ac2d562e30cd8b84fba0f7cc', 'timgM90Z9MPL.jpg', 'admin/20180617/0caec52ff6fa66fcb4f0e38021f467b1.jpg', 'ad43f7a78251244affee832344b66cde', 'c1d4b0388b915089e1dd0844efa3cbfe13302ca4', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('113', '34', '73358', '1529210415', '1', '0', 'ddec38ad16f453dfc4c8868e272731eb814cbd4c8d4563058f95b03a7d6afdbc', 'timg1DDUR9MN.jpg', 'admin/20180617/ab65af53f886741527794e2bc0ebf372.jpg', 'ddec38ad16f453dfc4c8868e272731eb', '951b631db965c76806f1803bd425eefc3643b255', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('114', '34', '67755', '1529210501', '1', '0', '1aa9b8755a9b9c0558c4f96eaf0f9bba7864be8398f07eade81750ad959e14dd', 'timg.jpg', 'admin/20180617/b30de60b189e4f2c4695059e2de26078.jpg', '1aa9b8755a9b9c0558c4f96eaf0f9bba', 'c874dce5bd4744f459d5ca5627fe67582c5a712a', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('115', '34', '148131', '1529210534', '1', '0', '3c7cbf309236304783172f125d3d93cd6a7763df119796cea71d230cf9c6648b', 'timg5LK3NVRM.jpg', 'admin/20180617/900f16c722ee234f6c43574538cb1a53.jpg', '3c7cbf309236304783172f125d3d93cd', '75cf00c0a7ecb27ba70faa0cfb636787302b02a0', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('116', '34', '116144', '1529210586', '1', '0', '4b964642a2454d18f33bab987d16ab4ab34cd3c5d544fcb37bd07ebcff5e4583', 'timgO3KZZF1Y.jpg', 'admin/20180617/ed65a71d4326a90f3ccb7be4e360063c.jpg', '4b964642a2454d18f33bab987d16ab4a', '972ca8e95bc6419fdccf9fddcb6eb82620ea6970', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('117', '34', '43428', '1529210719', '1', '0', '5f6dce76e9b536cfe8b5eb2c375863a5d79d9df18ce566cc30898584a93dab9f', 'timgZB3PMIAF.jpg', 'admin/20180617/0b6ab12ad12743a247faeb8e07338870.jpg', '5f6dce76e9b536cfe8b5eb2c375863a5', 'b993998fbfcf6f7e6cfbf66e61910a72c2ec3bea', 'jpg', null);
INSERT INTO `xjy_asset` VALUES ('118', '34', '176688', '1529212265', '1', '0', 'dce4e0d70f74245d502358bff3ce21da56ac145bc7b9c1952a855256fab99513', '184800018766506_1_o.jpg', 'admin/20180617/33a180b3ab5302668e50e629eef73ffd.jpg', 'dce4e0d70f74245d502358bff3ce21da', '94e4f1a67793c8b65afbcd45da02edf72213a136', 'jpg', null);

-- ----------------------------
-- Table structure for xjy_auth_access
-- ----------------------------
DROP TABLE IF EXISTS `xjy_auth_access`;
CREATE TABLE `xjy_auth_access` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL COMMENT '角色',
  `rule_name` varchar(100) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `type` varchar(30) NOT NULL DEFAULT '' COMMENT '权限规则分类,请加应用前缀,如admin_',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `rule_name` (`rule_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1530 DEFAULT CHARSET=utf8 COMMENT='权限授权表';

-- ----------------------------
-- Records of xjy_auth_access
-- ----------------------------
INSERT INTO `xjy_auth_access` VALUES ('1017', '5', 'admin/kitchen/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1018', '5', 'admin/#/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1019', '5', 'admin/traffic/purchase', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1034', '7', 'admin/#/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1035', '7', 'admin/traffic/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1036', '7', 'admin/traffic/apply', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1353', '4', 'admin/seller/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1354', '4', 'admin/seller/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1355', '4', 'admin/foodmenu/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1356', '4', 'admin/classification/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1357', '4', 'admin/order/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1358', '4', 'admin/order/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1359', '4', 'admin/order/orderaddlist', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1360', '4', 'admin/order/printindex', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1361', '4', 'admin/order/reserveorder', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1362', '4', 'admin/cashier/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1363', '4', 'admin/kitchen/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1364', '4', 'admin/#/#', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1365', '4', 'admin/report/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1366', '4', 'admin/seller/withdrawals', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1367', '4', 'admin/#/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1368', '4', 'admin/traffic/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1369', '4', 'admin/traffic/apply', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1449', '3', 'user/adminindex/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1450', '3', 'admin/user/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1451', '3', 'admin/rbac/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1452', '3', 'admin/rbac/roleadd', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1453', '3', 'admin/rbac/roleaddpost', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1454', '3', 'admin/rbac/roleedit', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1455', '3', 'admin/rbac/roleeditpost', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1456', '3', 'admin/rbac/roledelete', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1457', '3', 'admin/rbac/authorize', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1458', '3', 'admin/rbac/authorizepost', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1459', '3', 'admin/user/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1460', '3', 'admin/user/add', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1461', '3', 'admin/user/addpost', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1462', '3', 'admin/user/edit', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1463', '3', 'admin/user/editpost', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1464', '3', 'admin/user/delete', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1465', '3', 'admin/user/ban', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1466', '3', 'admin/user/cancelban', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1467', '3', 'user/adminindex/default1', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1468', '3', 'user/adminoauth/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1469', '3', 'user/adminoauth/delete', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1470', '3', 'user/adminoauth/levelindex', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1471', '3', 'user/adminoauth/recharge', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1472', '3', 'admin/seller/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1473', '3', 'admin/seller/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1474', '3', 'admin/foodmenu/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1475', '3', 'admin/classification/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1476', '3', 'admin/seller/sellertable', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1477', '3', 'admin/order/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1478', '3', 'admin/order/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1479', '3', 'admin/order/orderaddlist', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1480', '3', 'admin/order/printindex', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1481', '3', 'admin/order/reserveorder', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1482', '3', 'admin/address/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1483', '3', 'admin/user/manage', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1484', '3', 'admin/user/userinfo', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1485', '3', 'admin/setting/password', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1486', '3', 'admin/setting/passwordpost', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1487', '3', 'admin/user/userinfopost', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1488', '3', 'admin/cashier/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1489', '3', 'admin/kitchen/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1490', '3', 'admin/marketplace/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1491', '3', 'admin/printer/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1492', '3', 'admin/#/#', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1493', '3', 'admin/report/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1494', '3', 'admin/seller/withdrawals', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1495', '3', 'admin/#/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1496', '3', 'admin/traffic/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1497', '3', 'admin/trafficcategory/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1498', '3', 'admin/traffic/purchase', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1499', '3', 'admin/trafficcategory/purchase_index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1500', '3', 'admin/traffic/apply', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1501', '3', 'admin/trafficreport/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1502', '3', 'admin/trafficreport/lossindex', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1503', '3', 'admin/inventory/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1504', '3', 'admin/recyclebin/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1505', '3', 'admin/recyclebin/restore', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1506', '3', 'admin/recyclebin/delete', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1507', '6', 'user/adminindex/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1508', '6', 'user/adminindex/default1', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1509', '6', 'user/adminindex/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1510', '6', 'user/adminindex/ban', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1511', '6', 'user/adminindex/cancelban', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1512', '6', 'user/adminoauth/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1513', '6', 'user/adminoauth/delete', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1514', '6', 'user/adminoauth/levelindex', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1515', '6', 'user/adminoauth/recharge', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1516', '6', 'admin/seller/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1517', '6', 'admin/seller/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1518', '6', 'admin/foodmenu/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1519', '6', 'admin/classification/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1520', '6', 'admin/order/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1521', '6', 'admin/order/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1522', '6', 'admin/order/orderaddlist', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1523', '6', 'admin/order/printindex', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1524', '6', 'admin/order/reserveorder', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1525', '6', 'admin/cashier/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1526', '6', 'admin/kitchen/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1527', '6', 'admin/#/default', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1528', '6', 'admin/traffic/index', 'admin_url');
INSERT INTO `xjy_auth_access` VALUES ('1529', '6', 'admin/traffic/apply', 'admin_url');

-- ----------------------------
-- Table structure for xjy_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `xjy_auth_rule`;
CREATE TABLE `xjy_auth_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `app` varchar(15) NOT NULL COMMENT '规则所属module',
  `type` varchar(30) NOT NULL DEFAULT '' COMMENT '权限规则分类，请加应用前缀,如admin_',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识,全小写',
  `param` varchar(100) NOT NULL DEFAULT '' COMMENT '额外url参数',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '规则描述',
  `condition` varchar(200) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `module` (`app`,`status`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8 COMMENT='权限规则表';

-- ----------------------------
-- Records of xjy_auth_rule
-- ----------------------------
INSERT INTO `xjy_auth_rule` VALUES ('1', '1', 'admin', 'admin_url', 'admin/Hook/index', '', '钩子管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('2', '1', 'admin', 'admin_url', 'admin/Hook/plugins', '', '钩子插件管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('3', '1', 'admin', 'admin_url', 'admin/Hook/pluginListOrder', '', '钩子插件排序', '');
INSERT INTO `xjy_auth_rule` VALUES ('4', '1', 'admin', 'admin_url', 'admin/Hook/sync', '', '同步钩子', '');
INSERT INTO `xjy_auth_rule` VALUES ('5', '1', 'admin', 'admin_url', 'admin/Link/index', '', '友情链接', '');
INSERT INTO `xjy_auth_rule` VALUES ('6', '1', 'admin', 'admin_url', 'admin/Link/add', '', '添加友情链接', '');
INSERT INTO `xjy_auth_rule` VALUES ('7', '1', 'admin', 'admin_url', 'admin/Link/addPost', '', '添加友情链接提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('8', '1', 'admin', 'admin_url', 'admin/Link/edit', '', '编辑友情链接', '');
INSERT INTO `xjy_auth_rule` VALUES ('9', '1', 'admin', 'admin_url', 'admin/Link/editPost', '', '编辑友情链接提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('10', '1', 'admin', 'admin_url', 'admin/Link/delete', '', '删除友情链接', '');
INSERT INTO `xjy_auth_rule` VALUES ('11', '1', 'admin', 'admin_url', 'admin/Link/listOrder', '', '友情链接排序', '');
INSERT INTO `xjy_auth_rule` VALUES ('12', '1', 'admin', 'admin_url', 'admin/Link/toggle', '', '友情链接显示隐藏', '');
INSERT INTO `xjy_auth_rule` VALUES ('13', '1', 'admin', 'admin_url', 'admin/Mailer/index', '', '邮箱配置', '');
INSERT INTO `xjy_auth_rule` VALUES ('14', '1', 'admin', 'admin_url', 'admin/Mailer/indexPost', '', '邮箱配置提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('15', '1', 'admin', 'admin_url', 'admin/Mailer/template', '', '邮件模板', '');
INSERT INTO `xjy_auth_rule` VALUES ('16', '1', 'admin', 'admin_url', 'admin/Mailer/templatePost', '', '邮件模板提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('17', '1', 'admin', 'admin_url', 'admin/Mailer/test', '', '邮件发送测试', '');
INSERT INTO `xjy_auth_rule` VALUES ('18', '1', 'admin', 'admin_url', 'admin/Menu/index', '', '后台菜单', '');
INSERT INTO `xjy_auth_rule` VALUES ('19', '1', 'admin', 'admin_url', 'admin/Menu/lists', '', '所有菜单', '');
INSERT INTO `xjy_auth_rule` VALUES ('20', '1', 'admin', 'admin_url', 'admin/Menu/add', '', '后台菜单添加', '');
INSERT INTO `xjy_auth_rule` VALUES ('21', '1', 'admin', 'admin_url', 'admin/Menu/addPost', '', '后台菜单添加提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('22', '1', 'admin', 'admin_url', 'admin/Menu/edit', '', '后台菜单编辑', '');
INSERT INTO `xjy_auth_rule` VALUES ('23', '1', 'admin', 'admin_url', 'admin/Menu/editPost', '', '后台菜单编辑提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('24', '1', 'admin', 'admin_url', 'admin/Menu/delete', '', '后台菜单删除', '');
INSERT INTO `xjy_auth_rule` VALUES ('25', '1', 'admin', 'admin_url', 'admin/Menu/listOrder', '', '后台菜单排序', '');
INSERT INTO `xjy_auth_rule` VALUES ('26', '1', 'admin', 'admin_url', 'admin/Menu/getActions', '', '导入新后台菜单', '');
INSERT INTO `xjy_auth_rule` VALUES ('27', '1', 'admin', 'admin_url', 'admin/Nav/index', '', '导航管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('28', '1', 'admin', 'admin_url', 'admin/Nav/add', '', '添加导航', '');
INSERT INTO `xjy_auth_rule` VALUES ('29', '1', 'admin', 'admin_url', 'admin/Nav/addPost', '', '添加导航提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('30', '1', 'admin', 'admin_url', 'admin/Nav/edit', '', '编辑导航', '');
INSERT INTO `xjy_auth_rule` VALUES ('31', '1', 'admin', 'admin_url', 'admin/Nav/editPost', '', '编辑导航提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('32', '1', 'admin', 'admin_url', 'admin/Nav/delete', '', '删除导航', '');
INSERT INTO `xjy_auth_rule` VALUES ('33', '1', 'admin', 'admin_url', 'admin/NavMenu/index', '', '导航菜单', '');
INSERT INTO `xjy_auth_rule` VALUES ('34', '1', 'admin', 'admin_url', 'admin/NavMenu/add', '', '添加导航菜单', '');
INSERT INTO `xjy_auth_rule` VALUES ('35', '1', 'admin', 'admin_url', 'admin/NavMenu/addPost', '', '添加导航菜单提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('36', '1', 'admin', 'admin_url', 'admin/NavMenu/edit', '', '编辑导航菜单', '');
INSERT INTO `xjy_auth_rule` VALUES ('37', '1', 'admin', 'admin_url', 'admin/NavMenu/editPost', '', '编辑导航菜单提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('38', '1', 'admin', 'admin_url', 'admin/NavMenu/delete', '', '删除导航菜单', '');
INSERT INTO `xjy_auth_rule` VALUES ('39', '1', 'admin', 'admin_url', 'admin/NavMenu/listOrder', '', '导航菜单排序', '');
INSERT INTO `xjy_auth_rule` VALUES ('40', '1', 'admin', 'admin_url', 'admin/Plugin/default', '', '插件管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('41', '1', 'admin', 'admin_url', 'admin/Plugin/index', '', '插件列表', '');
INSERT INTO `xjy_auth_rule` VALUES ('42', '1', 'admin', 'admin_url', 'admin/Plugin/toggle', '', '插件启用禁用', '');
INSERT INTO `xjy_auth_rule` VALUES ('43', '1', 'admin', 'admin_url', 'admin/Plugin/setting', '', '插件设置', '');
INSERT INTO `xjy_auth_rule` VALUES ('44', '1', 'admin', 'admin_url', 'admin/Plugin/settingPost', '', '插件设置提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('45', '1', 'admin', 'admin_url', 'admin/Plugin/install', '', '插件安装', '');
INSERT INTO `xjy_auth_rule` VALUES ('46', '1', 'admin', 'admin_url', 'admin/Plugin/update', '', '插件更新', '');
INSERT INTO `xjy_auth_rule` VALUES ('47', '1', 'admin', 'admin_url', 'admin/Plugin/uninstall', '', '卸载插件', '');
INSERT INTO `xjy_auth_rule` VALUES ('48', '1', 'admin', 'admin_url', 'admin/Rbac/index', '', '角色管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('49', '1', 'admin', 'admin_url', 'admin/Rbac/roleAdd', '', '添加角色', '');
INSERT INTO `xjy_auth_rule` VALUES ('50', '1', 'admin', 'admin_url', 'admin/Rbac/roleAddPost', '', '添加角色提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('51', '1', 'admin', 'admin_url', 'admin/Rbac/roleEdit', '', '编辑角色', '');
INSERT INTO `xjy_auth_rule` VALUES ('52', '1', 'admin', 'admin_url', 'admin/Rbac/roleEditPost', '', '编辑角色提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('53', '1', 'admin', 'admin_url', 'admin/Rbac/roleDelete', '', '删除角色', '');
INSERT INTO `xjy_auth_rule` VALUES ('54', '1', 'admin', 'admin_url', 'admin/Rbac/authorize', '', '设置角色权限', '');
INSERT INTO `xjy_auth_rule` VALUES ('55', '1', 'admin', 'admin_url', 'admin/Rbac/authorizePost', '', '角色授权提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('56', '1', 'admin', 'admin_url', 'admin/RecycleBin/index', '', '回收站', '');
INSERT INTO `xjy_auth_rule` VALUES ('57', '1', 'admin', 'admin_url', 'admin/RecycleBin/restore', '', '回收站还原', '');
INSERT INTO `xjy_auth_rule` VALUES ('58', '1', 'admin', 'admin_url', 'admin/RecycleBin/delete', '', '回收站彻底删除', '');
INSERT INTO `xjy_auth_rule` VALUES ('59', '1', 'admin', 'admin_url', 'admin/Route/index', '', 'URL美化', '');
INSERT INTO `xjy_auth_rule` VALUES ('60', '1', 'admin', 'admin_url', 'admin/Route/add', '', '添加路由规则', '');
INSERT INTO `xjy_auth_rule` VALUES ('61', '1', 'admin', 'admin_url', 'admin/Route/addPost', '', '添加路由规则提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('62', '1', 'admin', 'admin_url', 'admin/Route/edit', '', '路由规则编辑', '');
INSERT INTO `xjy_auth_rule` VALUES ('63', '1', 'admin', 'admin_url', 'admin/Route/editPost', '', '路由规则编辑提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('64', '1', 'admin', 'admin_url', 'admin/Route/delete', '', '路由规则删除', '');
INSERT INTO `xjy_auth_rule` VALUES ('65', '1', 'admin', 'admin_url', 'admin/Route/ban', '', '路由规则禁用', '');
INSERT INTO `xjy_auth_rule` VALUES ('66', '1', 'admin', 'admin_url', 'admin/Route/open', '', '路由规则启用', '');
INSERT INTO `xjy_auth_rule` VALUES ('67', '1', 'admin', 'admin_url', 'admin/Route/listOrder', '', '路由规则排序', '');
INSERT INTO `xjy_auth_rule` VALUES ('68', '1', 'admin', 'admin_url', 'admin/Route/select', '', '选择URL', '');
INSERT INTO `xjy_auth_rule` VALUES ('69', '1', 'admin', 'admin_url', 'admin/Setting/default', '', '设置', '');
INSERT INTO `xjy_auth_rule` VALUES ('70', '1', 'admin', 'admin_url', 'admin/Setting/site', '', '网站信息', '');
INSERT INTO `xjy_auth_rule` VALUES ('71', '1', 'admin', 'admin_url', 'admin/Setting/sitePost', '', '网站信息设置提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('72', '1', 'admin', 'admin_url', 'admin/Setting/password', '', '密码修改', '');
INSERT INTO `xjy_auth_rule` VALUES ('73', '1', 'admin', 'admin_url', 'admin/Setting/passwordPost', '', '密码修改提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('74', '1', 'admin', 'admin_url', 'admin/Setting/upload', '', '上传设置', '');
INSERT INTO `xjy_auth_rule` VALUES ('75', '1', 'admin', 'admin_url', 'admin/Setting/uploadPost', '', '上传设置提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('76', '1', 'admin', 'admin_url', 'admin/Setting/clearCache', '', '清除缓存', '');
INSERT INTO `xjy_auth_rule` VALUES ('77', '1', 'admin', 'admin_url', 'admin/Slide/index', '', '幻灯片管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('78', '1', 'admin', 'admin_url', 'admin/Slide/add', '', '添加幻灯片', '');
INSERT INTO `xjy_auth_rule` VALUES ('79', '1', 'admin', 'admin_url', 'admin/Slide/addPost', '', '添加幻灯片提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('80', '1', 'admin', 'admin_url', 'admin/Slide/edit', '', '编辑幻灯片', '');
INSERT INTO `xjy_auth_rule` VALUES ('81', '1', 'admin', 'admin_url', 'admin/Slide/editPost', '', '编辑幻灯片提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('82', '1', 'admin', 'admin_url', 'admin/Slide/delete', '', '删除幻灯片', '');
INSERT INTO `xjy_auth_rule` VALUES ('83', '1', 'admin', 'admin_url', 'admin/SlideItem/index', '', '幻灯片页面列表', '');
INSERT INTO `xjy_auth_rule` VALUES ('84', '1', 'admin', 'admin_url', 'admin/SlideItem/add', '', '幻灯片页面添加', '');
INSERT INTO `xjy_auth_rule` VALUES ('85', '1', 'admin', 'admin_url', 'admin/SlideItem/addPost', '', '幻灯片页面添加提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('86', '1', 'admin', 'admin_url', 'admin/SlideItem/edit', '', '幻灯片页面编辑', '');
INSERT INTO `xjy_auth_rule` VALUES ('87', '1', 'admin', 'admin_url', 'admin/SlideItem/editPost', '', '幻灯片页面编辑提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('88', '1', 'admin', 'admin_url', 'admin/SlideItem/delete', '', '幻灯片页面删除', '');
INSERT INTO `xjy_auth_rule` VALUES ('89', '1', 'admin', 'admin_url', 'admin/SlideItem/ban', '', '幻灯片页面隐藏', '');
INSERT INTO `xjy_auth_rule` VALUES ('90', '1', 'admin', 'admin_url', 'admin/SlideItem/cancelBan', '', '幻灯片页面显示', '');
INSERT INTO `xjy_auth_rule` VALUES ('91', '1', 'admin', 'admin_url', 'admin/SlideItem/listOrder', '', '幻灯片页面排序', '');
INSERT INTO `xjy_auth_rule` VALUES ('92', '1', 'admin', 'admin_url', 'admin/Storage/index', '', '文件存储', '');
INSERT INTO `xjy_auth_rule` VALUES ('93', '1', 'admin', 'admin_url', 'admin/Storage/settingPost', '', '文件存储设置提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('94', '1', 'admin', 'admin_url', 'admin/Theme/index', '', '模板管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('95', '1', 'admin', 'admin_url', 'admin/Theme/install', '', '安装模板', '');
INSERT INTO `xjy_auth_rule` VALUES ('96', '1', 'admin', 'admin_url', 'admin/Theme/uninstall', '', '卸载模板', '');
INSERT INTO `xjy_auth_rule` VALUES ('97', '1', 'admin', 'admin_url', 'admin/Theme/installTheme', '', '模板安装', '');
INSERT INTO `xjy_auth_rule` VALUES ('98', '1', 'admin', 'admin_url', 'admin/Theme/update', '', '模板更新', '');
INSERT INTO `xjy_auth_rule` VALUES ('99', '1', 'admin', 'admin_url', 'admin/Theme/active', '', '模板显示', '');
INSERT INTO `xjy_auth_rule` VALUES ('100', '1', 'admin', 'admin_url', 'admin/Theme/files', '', '模板文件列表', '');
INSERT INTO `xjy_auth_rule` VALUES ('101', '1', 'admin', 'admin_url', 'admin/Theme/fileSetting', '', '模板文件设置', '');
INSERT INTO `xjy_auth_rule` VALUES ('102', '1', 'admin', 'admin_url', 'admin/Theme/fileArrayData', '', '模板文件数组数据列表', '');
INSERT INTO `xjy_auth_rule` VALUES ('103', '1', 'admin', 'admin_url', 'admin/Theme/fileArrayDataEdit', '', '模板文件数组数据添加编辑', '');
INSERT INTO `xjy_auth_rule` VALUES ('104', '1', 'admin', 'admin_url', 'admin/Theme/fileArrayDataEditPost', '', '模板文件数组数据添加编辑提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('105', '1', 'admin', 'admin_url', 'admin/Theme/fileArrayDataDelete', '', '模板文件数组数据删除', '');
INSERT INTO `xjy_auth_rule` VALUES ('106', '1', 'admin', 'admin_url', 'admin/Theme/settingPost', '', '模板文件编辑提交保存', '');
INSERT INTO `xjy_auth_rule` VALUES ('107', '1', 'admin', 'admin_url', 'admin/Theme/dataSource', '', '模板文件设置数据源', '');
INSERT INTO `xjy_auth_rule` VALUES ('108', '1', 'admin', 'admin_url', 'admin/User/default', '', '管理组', '');
INSERT INTO `xjy_auth_rule` VALUES ('109', '1', 'admin', 'admin_url', 'admin/User/index', '', '管理员', '');
INSERT INTO `xjy_auth_rule` VALUES ('110', '1', 'admin', 'admin_url', 'admin/User/add', '', '管理员添加', '');
INSERT INTO `xjy_auth_rule` VALUES ('111', '1', 'admin', 'admin_url', 'admin/User/addPost', '', '管理员添加提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('112', '1', 'admin', 'admin_url', 'admin/User/edit', '', '管理员编辑', '');
INSERT INTO `xjy_auth_rule` VALUES ('113', '1', 'admin', 'admin_url', 'admin/User/editPost', '', '管理员编辑提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('114', '1', 'admin', 'admin_url', 'admin/User/userInfo', '', '个人信息', '');
INSERT INTO `xjy_auth_rule` VALUES ('115', '1', 'admin', 'admin_url', 'admin/User/userInfoPost', '', '管理员个人信息修改提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('116', '1', 'admin', 'admin_url', 'admin/User/delete', '', '管理员删除', '');
INSERT INTO `xjy_auth_rule` VALUES ('117', '1', 'admin', 'admin_url', 'admin/User/ban', '', '停用管理员', '');
INSERT INTO `xjy_auth_rule` VALUES ('118', '1', 'admin', 'admin_url', 'admin/User/cancelBan', '', '启用管理员', '');
INSERT INTO `xjy_auth_rule` VALUES ('119', '1', 'portal', 'admin_url', 'portal/AdminArticle/index', '', '文章管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('120', '1', 'portal', 'admin_url', 'portal/AdminArticle/add', '', '添加文章', '');
INSERT INTO `xjy_auth_rule` VALUES ('121', '1', 'portal', 'admin_url', 'portal/AdminArticle/addPost', '', '添加文章提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('122', '1', 'portal', 'admin_url', 'portal/AdminArticle/edit', '', '编辑文章', '');
INSERT INTO `xjy_auth_rule` VALUES ('123', '1', 'portal', 'admin_url', 'portal/AdminArticle/editPost', '', '编辑文章提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('124', '1', 'portal', 'admin_url', 'portal/AdminArticle/delete', '', '文章删除', '');
INSERT INTO `xjy_auth_rule` VALUES ('125', '1', 'portal', 'admin_url', 'portal/AdminArticle/publish', '', '文章发布', '');
INSERT INTO `xjy_auth_rule` VALUES ('126', '1', 'portal', 'admin_url', 'portal/AdminArticle/top', '', '文章置顶', '');
INSERT INTO `xjy_auth_rule` VALUES ('127', '1', 'portal', 'admin_url', 'portal/AdminArticle/recommend', '', '文章推荐', '');
INSERT INTO `xjy_auth_rule` VALUES ('128', '1', 'portal', 'admin_url', 'portal/AdminArticle/listOrder', '', '文章排序', '');
INSERT INTO `xjy_auth_rule` VALUES ('129', '1', 'portal', 'admin_url', 'portal/AdminCategory/index', '', '分类管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('130', '1', 'portal', 'admin_url', 'portal/AdminCategory/add', '', '添加文章分类', '');
INSERT INTO `xjy_auth_rule` VALUES ('131', '1', 'portal', 'admin_url', 'portal/AdminCategory/addPost', '', '添加文章分类提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('132', '1', 'portal', 'admin_url', 'portal/AdminCategory/edit', '', '编辑文章分类', '');
INSERT INTO `xjy_auth_rule` VALUES ('133', '1', 'portal', 'admin_url', 'portal/AdminCategory/editPost', '', '编辑文章分类提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('134', '1', 'portal', 'admin_url', 'portal/AdminCategory/select', '', '文章分类选择对话框', '');
INSERT INTO `xjy_auth_rule` VALUES ('135', '1', 'portal', 'admin_url', 'portal/AdminCategory/listOrder', '', '文章分类排序', '');
INSERT INTO `xjy_auth_rule` VALUES ('136', '1', 'portal', 'admin_url', 'portal/AdminCategory/delete', '', '删除文章分类', '');
INSERT INTO `xjy_auth_rule` VALUES ('137', '1', 'portal', 'admin_url', 'portal/AdminIndex/default', '', '内容管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('138', '1', 'portal', 'admin_url', 'portal/AdminPage/index', '', '页面管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('139', '1', 'portal', 'admin_url', 'portal/AdminPage/add', '', '添加页面', '');
INSERT INTO `xjy_auth_rule` VALUES ('140', '1', 'portal', 'admin_url', 'portal/AdminPage/addPost', '', '添加页面提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('141', '1', 'portal', 'admin_url', 'portal/AdminPage/edit', '', '编辑页面', '');
INSERT INTO `xjy_auth_rule` VALUES ('142', '1', 'portal', 'admin_url', 'portal/AdminPage/editPost', '', '编辑页面提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('143', '1', 'portal', 'admin_url', 'portal/AdminPage/delete', '', '删除页面', '');
INSERT INTO `xjy_auth_rule` VALUES ('144', '1', 'portal', 'admin_url', 'portal/AdminTag/index', '', '文章标签', '');
INSERT INTO `xjy_auth_rule` VALUES ('145', '1', 'portal', 'admin_url', 'portal/AdminTag/add', '', '添加文章标签', '');
INSERT INTO `xjy_auth_rule` VALUES ('146', '1', 'portal', 'admin_url', 'portal/AdminTag/addPost', '', '添加文章标签提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('147', '1', 'portal', 'admin_url', 'portal/AdminTag/upStatus', '', '更新标签状态', '');
INSERT INTO `xjy_auth_rule` VALUES ('148', '1', 'portal', 'admin_url', 'portal/AdminTag/delete', '', '删除文章标签', '');
INSERT INTO `xjy_auth_rule` VALUES ('149', '1', 'user', 'admin_url', 'user/AdminAsset/index', '', '资源管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('150', '1', 'user', 'admin_url', 'user/AdminAsset/delete', '', '删除文件', '');
INSERT INTO `xjy_auth_rule` VALUES ('151', '1', 'user', 'admin_url', 'user/AdminIndex/default', '', '用户管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('152', '1', 'user', 'admin_url', 'user/AdminIndex/default1', '', '会员', '');
INSERT INTO `xjy_auth_rule` VALUES ('153', '1', 'user', 'admin_url', 'user/AdminIndex/index', '', '本站用户', '');
INSERT INTO `xjy_auth_rule` VALUES ('154', '1', 'user', 'admin_url', 'user/AdminIndex/ban', '', '本站用户拉黑', '');
INSERT INTO `xjy_auth_rule` VALUES ('155', '1', 'user', 'admin_url', 'user/AdminIndex/cancelBan', '', '本站用户启用', '');
INSERT INTO `xjy_auth_rule` VALUES ('156', '1', 'user', 'admin_url', 'user/AdminOauth/index', '', '会员管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('157', '1', 'user', 'admin_url', 'user/AdminOauth/delete', '', '删除第三方用户绑定', '');
INSERT INTO `xjy_auth_rule` VALUES ('158', '1', 'user', 'admin_url', 'user/AdminUserAction/index', '', '用户操作管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('159', '1', 'user', 'admin_url', 'user/AdminUserAction/edit', '', '编辑用户操作', '');
INSERT INTO `xjy_auth_rule` VALUES ('160', '1', 'user', 'admin_url', 'user/AdminUserAction/editPost', '', '编辑用户操作提交', '');
INSERT INTO `xjy_auth_rule` VALUES ('161', '1', 'user', 'admin_url', 'user/AdminUserAction/sync', '', '同步用户操作', '');
INSERT INTO `xjy_auth_rule` VALUES ('162', '1', 'video', 'admin_url', 'video/AdminIndex/default', '', '视频管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('163', '1', 'video', 'admin_url', 'video/AdminCategory/index', '', '视频分类', '');
INSERT INTO `xjy_auth_rule` VALUES ('164', '1', 'video', 'admin_url', 'video/AdminClass/index', '', '属性类别', '');
INSERT INTO `xjy_auth_rule` VALUES ('165', '1', 'video', 'admin_url', 'video/AdminVideo/index', '', '视频数据', '');
INSERT INTO `xjy_auth_rule` VALUES ('166', '1', 'video', 'admin_url', 'video/AdminVideo/add', '', '添加视频', '');
INSERT INTO `xjy_auth_rule` VALUES ('181', '1', 'admin', 'admin_url', 'admin/seller/default', '', '门店管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('182', '1', 'admin', 'admin_url', 'admin/seller/index', '', '门店信息', '');
INSERT INTO `xjy_auth_rule` VALUES ('183', '1', 'admin', 'admin_url', 'admin/seller/sellerList', '', '商家添加', '');
INSERT INTO `xjy_auth_rule` VALUES ('184', '1', 'admin', 'admin_url', 'admin/seller/password', '', '密码管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('185', '1', 'admin', 'admin_url', 'admin/order/default', '', ' 订单信息', '');
INSERT INTO `xjy_auth_rule` VALUES ('186', '1', 'admin', 'admin_url', 'admin/order/index', '', '订单列表', '');
INSERT INTO `xjy_auth_rule` VALUES ('187', '1', 'admin', 'admin_url', 'admin/order/orderAddList', '', '消费下单', '');
INSERT INTO `xjy_auth_rule` VALUES ('188', '1', 'admin', 'admin_url', 'admin/Classification/index', '', '分类管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('189', '1', 'admin', 'admin_url', 'admin/seller/sellerdetailed', '', '商店信息', '');
INSERT INTO `xjy_auth_rule` VALUES ('190', '1', 'admin', 'admin_url', 'admin/Foodmenu/index', '', '菜品管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('191', '1', 'admin', 'admin_url', 'admin/Address/index', '', '收货地址', '');
INSERT INTO `xjy_auth_rule` VALUES ('192', '1', 'admin', 'admin_url', 'admin/user/manage', '', '信息管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('193', '1', 'admin', 'admin_url', 'admin/report/index', '', '报表统计', '');
INSERT INTO `xjy_auth_rule` VALUES ('194', '1', 'admin', 'admin_url', 'admin/order/printindex', 'class=2', '销量排行榜', '');
INSERT INTO `xjy_auth_rule` VALUES ('195', '1', 'admin', 'admin_url', 'admin/order/reserveOrder', '', '预约信息', '');
INSERT INTO `xjy_auth_rule` VALUES ('196', '1', 'admin', 'admin_url', 'admin/seller/sellerTable', '', '餐桌管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('197', '1', 'admin', 'admin_url', 'admin/seller/withdrawals', '', '提现', '');
INSERT INTO `xjy_auth_rule` VALUES ('198', '1', 'admin', 'admin_url', 'admin/Cashier/index', '', '收银台', '');
INSERT INTO `xjy_auth_rule` VALUES ('199', '1', 'admin', 'admin_url', 'admin/Kitchen/index', '', '后厨', '');
INSERT INTO `xjy_auth_rule` VALUES ('200', '1', 'admin', 'admin_url', 'admin/Marketplace/index', '', '应用市场', '');
INSERT INTO `xjy_auth_rule` VALUES ('201', '1', 'admin', 'admin_url', 'admin/Printer/index', '', '设备管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('202', '1', 'admin', 'admin_url', 'admin/#/#', '', '财务管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('203', '1', 'admin', 'admin_url', 'admin/#/default', '', '货流', '');
INSERT INTO `xjy_auth_rule` VALUES ('204', '1', 'admin', 'admin_url', 'admin/Traffic/index', '', '商品管理', '');
INSERT INTO `xjy_auth_rule` VALUES ('205', '1', 'admin', 'admin_url', 'admin/Traffic/purchase', '', '采购', '');
INSERT INTO `xjy_auth_rule` VALUES ('206', '1', 'admin', 'admin_url', 'admin/Traffic/apply', '', '申请列表', '');
INSERT INTO `xjy_auth_rule` VALUES ('207', '1', 'user', 'admin_url', 'user/AdminOauth/levelIndex', '', '会员等级', '');
INSERT INTO `xjy_auth_rule` VALUES ('208', '1', 'user', 'admin_url', 'user/AdminOauth/recharge', '', '充值记录', '');
INSERT INTO `xjy_auth_rule` VALUES ('209', '1', 'admin', 'admin_url', 'admin/TrafficReport/index', '', ' 报表统计', '');
INSERT INTO `xjy_auth_rule` VALUES ('210', '1', 'admin', 'admin_url', 'admin/TrafficReport/lossIndex', '', '商品报损', '');
INSERT INTO `xjy_auth_rule` VALUES ('211', '1', 'admin', 'admin_url', 'admin/Inventory/index', '', '盘点', '');

-- ----------------------------
-- Table structure for xjy_comment
-- ----------------------------
DROP TABLE IF EXISTS `xjy_comment`;
CREATE TABLE `xjy_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '被回复的评论id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表评论的用户id',
  `to_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被评论的用户id',
  `object_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论内容 id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论时间',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:已审核,0:未审核',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '评论类型；1实名评论',
  `table_name` varchar(64) NOT NULL DEFAULT '' COMMENT '评论内容所在表，不带表前缀',
  `full_name` varchar(50) NOT NULL DEFAULT '' COMMENT '评论者昵称',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '评论者邮箱',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '层级关系',
  `url` text COMMENT '原文地址',
  `content` text COMMENT '评论内容',
  `more` text COMMENT '扩展属性',
  PRIMARY KEY (`id`),
  KEY `comment_post_ID` (`object_id`),
  KEY `comment_approved_date_gmt` (`status`),
  KEY `comment_parent` (`parent_id`),
  KEY `table_id_status` (`table_name`,`object_id`,`status`),
  KEY `createtime` (`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Records of xjy_comment
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_coupon
-- ----------------------------
DROP TABLE IF EXISTS `xjy_coupon`;
CREATE TABLE `xjy_coupon` (
  `coupon_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户所持优惠劵ID',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '本站用户ID',
  `coupon_type_id` tinyint(5) unsigned NOT NULL DEFAULT '0' COMMENT '优惠劵类型',
  `coupon_expired` int(11) NOT NULL DEFAULT '1' COMMENT '过期时间',
  `coupon_use` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否使用 1:使用 2:未使用',
  `coupon_use_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '优惠劵使用时间（前提已使用）',
  PRIMARY KEY (`coupon_id`),
  KEY `user` (`user_id`) USING BTREE,
  KEY `user+coupon_use` (`user_id`,`coupon_use`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户持有优惠劵信息';

-- ----------------------------
-- Records of xjy_coupon
-- ----------------------------
INSERT INTO `xjy_coupon` VALUES ('1', '0', '1', '1', '1', '0');

-- ----------------------------
-- Table structure for xjy_coupon_type
-- ----------------------------
DROP TABLE IF EXISTS `xjy_coupon_type`;
CREATE TABLE `xjy_coupon_type` (
  `coupon_type_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '优惠劵类型自增ID',
  `coupon_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '优惠劵的描述',
  `coupon_full` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '消费满额',
  `coupon_cut` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '优惠价格',
  `coupon_end` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否过期 1:未过期;2:过期',
  PRIMARY KEY (`coupon_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='优惠劵类型';

-- ----------------------------
-- Records of xjy_coupon_type
-- ----------------------------
INSERT INTO `xjy_coupon_type` VALUES ('1', '打折扣', '233', '233', '1');

-- ----------------------------
-- Table structure for xjy_delivery_type
-- ----------------------------
DROP TABLE IF EXISTS `xjy_delivery_type`;
CREATE TABLE `xjy_delivery_type` (
  `delivery_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '外卖配送方ID',
  `delivery_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '外卖配送方名称',
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='外卖配送方信息';

-- ----------------------------
-- Records of xjy_delivery_type
-- ----------------------------
INSERT INTO `xjy_delivery_type` VALUES ('1', '商家配送');
INSERT INTO `xjy_delivery_type` VALUES ('2', '蜂鸟快送');
INSERT INTO `xjy_delivery_type` VALUES ('3', '达达快送');
INSERT INTO `xjy_delivery_type` VALUES ('4', '宅急送');

-- ----------------------------
-- Table structure for xjy_food_menu
-- ----------------------------
DROP TABLE IF EXISTS `xjy_food_menu`;
CREATE TABLE `xjy_food_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父菜单id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态;1:显示,0:不显示',
  `list_order` int(5) NOT NULL DEFAULT '10000' COMMENT '排序',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `seller_id` smallint(20) NOT NULL COMMENT '商家id',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- ----------------------------
-- Records of xjy_food_menu
-- ----------------------------
INSERT INTO `xjy_food_menu` VALUES ('179', '0', '1', '1', '中餐', 'zhongcan', '中餐厅', '10');
INSERT INTO `xjy_food_menu` VALUES ('180', '0', '1', '10', '海味', 'haixian', '风味小吃，没有你想不到，只有你没吃过', '10');
INSERT INTO `xjy_food_menu` VALUES ('181', '179', '1', '10000', '凉菜类', '', '麻辣诱惑', '10');
INSERT INTO `xjy_food_menu` VALUES ('182', '179', '1', '10000', '精品类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('184', '0', '1', '9', '山珍', 'shucai', '四川传统美食', '10');
INSERT INTO `xjy_food_menu` VALUES ('187', '179', '1', '10000', '畅销类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('188', '179', '1', '10000', '蒸菜', '', '清蒸', '10');
INSERT INTO `xjy_food_menu` VALUES ('189', '179', '1', '10000', '肉食', '', '', '0');
INSERT INTO `xjy_food_menu` VALUES ('190', '0', '1', '10000', '中餐', '', '传统中式点餐', '19');
INSERT INTO `xjy_food_menu` VALUES ('191', '0', '1', '10000', '素菜', '', '', '1');
INSERT INTO `xjy_food_menu` VALUES ('192', '191', '1', '10000', '小吃', '', '', '1');
INSERT INTO `xjy_food_menu` VALUES ('193', '184', '1', '10000', '菌类', 'huoguo', '新鲜羊肉，美味可口', '10');
INSERT INTO `xjy_food_menu` VALUES ('194', '180', '1', '10000', '海鲜类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('195', '0', '1', '8', '汤锅', 'tangguo', '茶水，麻将，瓜子，花生', '10');
INSERT INTO `xjy_food_menu` VALUES ('197', '195', '1', '10000', '汤锅锅底', '', '玫瑰，茉莉，菊花.....想你所想', '10');
INSERT INTO `xjy_food_menu` VALUES ('198', '0', '1', '7', '干锅', 'ganguo', '海鱼，海虾，海螺......地道正宗', '10');
INSERT INTO `xjy_food_menu` VALUES ('200', '0', '1', '2', '火锅', 'huoguo', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('201', '200', '1', '10000', '荤菜类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('202', '200', '1', '10000', '蔬菜类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('203', '0', '1', '3', '串串', 'chuanchuanwanzi', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('204', '0', '1', '5', '烧烤', 'zizhushaokao', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('205', '0', '1', '6', '小吃', 'xiaochi', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('206', '0', '1', '11', '果饮', 'guoyin', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('207', '0', '1', '4', '茶楼', 'chalou0101', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('208', '0', '1', '10000', '推荐', '', '', '32');
INSERT INTO `xjy_food_menu` VALUES ('209', '207', '1', '10000', '推荐茶', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('210', '203', '1', '10000', '荤菜', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('211', '204', '1', '10000', '烧烤类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('212', '205', '1', '10000', '老四川传统小吃', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('213', '206', '1', '10000', '果饮', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('214', '179', '1', '10000', '川菜四宝', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('215', '179', '1', '10000', '川香鲜卤', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('235', '179', '1', '10000', '家常素菜类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('236', '195', '1', '10000', '现切鲜牛肉', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('237', '195', '1', '10000', '蔬菜', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('238', '195', '1', '10000', '精品肥牛肉', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('239', '200', '1', '10000', '锅底', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('240', '200', '1', '10000', '特色直供菜品', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('241', '200', '1', '10000', '现制特色菜品', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('242', '200', '1', '10000', '精品肥牛肉', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('243', '200', '1', '10000', '现切鲜牛肉', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('244', '200', '1', '10000', '油碟', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('246', '0', '1', '12', '酒水类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('247', '180', '1', '10000', '蔬菜类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('248', '184', '1', '10000', '蔬菜', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('249', '179', '1', '10000', '河鲜类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('250', '246', '1', '10000', '雪花啤酒', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('251', '246', '1', '10000', '饮料', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('252', '206', '1', '10000', '雪绒系列', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('253', '246', '1', '10000', '白酒', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('254', '246', '1', '10000', '红酒', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('255', '206', '1', '10000', '水果茶系列', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('256', '206', '1', '10000', '奶盖茶系列', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('257', '206', '1', '10000', '汽泡水', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('258', '206', '1', '10000', '美式冰茶', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('259', '206', '1', '10000', '畅饮系列', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('260', '206', '1', '10000', '奶茶', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('261', '184', '1', '10000', '精品肥牛', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('262', '180', '1', '10000', '精品肥牛肉', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('263', '184', '1', '10000', '特色直供菜品', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('264', '180', '1', '10000', '特色直供菜品', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('265', '184', '1', '10000', '现制特色菜品', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('266', '180', '1', '10000', '现制特色菜品', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('267', '180', '1', '10000', '菌类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('268', '200', '1', '10000', '菌类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('269', '195', '1', '10000', '菌类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('270', '179', '1', '10000', '土家特色菜', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('272', '0', '1', '14', '白米饭', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('273', '0', '1', '13', '套餐一', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('274', '0', '1', '15', '其它', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('275', '273', '1', '10000', '套餐', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('276', '274', '1', '10000', '补差价', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('277', '198', '1', '10000', '干锅类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('278', '184', '1', '10000', '锅底', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('279', '180', '1', '10000', '锅底', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('280', '274', '1', '10000', '湿巾纸', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('281', '274', '1', '10000', '筷子', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('282', '272', '1', '10000', '米饭', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('283', '179', '1', '10000', '锦绣刺身', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('284', '179', '1', '10000', '汤品类', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('285', '0', '1', '10000', '套餐二', '', '', '10');
INSERT INTO `xjy_food_menu` VALUES ('286', '285', '1', '10000', '欠账套餐', '', '', '10');

-- ----------------------------
-- Table structure for xjy_food_primary_classification
-- ----------------------------
DROP TABLE IF EXISTS `xjy_food_primary_classification`;
CREATE TABLE `xjy_food_primary_classification` (
  `primary_classification_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜品一级分类ID',
  `class_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '一级分类名称',
  `secondary_classification_id` bigint(20) unsigned NOT NULL COMMENT '菜品二级分类ID',
  PRIMARY KEY (`primary_classification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜品一级分类表';

-- ----------------------------
-- Records of xjy_food_primary_classification
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_food_secondary_classification
-- ----------------------------
DROP TABLE IF EXISTS `xjy_food_secondary_classification`;
CREATE TABLE `xjy_food_secondary_classification` (
  `secondary_classification_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜品二级分类',
  `class_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '二级分类名称',
  PRIMARY KEY (`secondary_classification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜品二级分类表';

-- ----------------------------
-- Records of xjy_food_secondary_classification
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_hook
-- ----------------------------
DROP TABLE IF EXISTS `xjy_hook`;
CREATE TABLE `xjy_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '钩子类型(1:系统钩子;2:应用钩子;3:模板钩子)',
  `once` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否只允许一个插件运行(0:多个;1:一个)',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `hook` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子',
  `app` varchar(15) NOT NULL DEFAULT '' COMMENT '应用名(只有应用钩子才用)',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='系统钩子表';

-- ----------------------------
-- Records of xjy_hook
-- ----------------------------
INSERT INTO `xjy_hook` VALUES ('1', '1', '0', '应用初始化', 'app_init', 'cmf', '应用初始化');
INSERT INTO `xjy_hook` VALUES ('2', '1', '0', '应用开始', 'app_begin', 'cmf', '应用开始');
INSERT INTO `xjy_hook` VALUES ('3', '1', '0', '模块初始化', 'module_init', 'cmf', '模块初始化');
INSERT INTO `xjy_hook` VALUES ('4', '1', '0', '控制器开始', 'action_begin', 'cmf', '控制器开始');
INSERT INTO `xjy_hook` VALUES ('5', '1', '0', '视图输出过滤', 'view_filter', 'cmf', '视图输出过滤');
INSERT INTO `xjy_hook` VALUES ('6', '1', '0', '应用结束', 'app_end', 'cmf', '应用结束');
INSERT INTO `xjy_hook` VALUES ('7', '1', '0', '日志write方法', 'log_write', 'cmf', '日志write方法');
INSERT INTO `xjy_hook` VALUES ('8', '1', '0', '输出结束', 'response_end', 'cmf', '输出结束');
INSERT INTO `xjy_hook` VALUES ('9', '1', '0', '后台控制器初始化', 'admin_init', 'cmf', '后台控制器初始化');
INSERT INTO `xjy_hook` VALUES ('10', '1', '0', '前台控制器初始化', 'home_init', 'cmf', '前台控制器初始化');
INSERT INTO `xjy_hook` VALUES ('11', '1', '1', '发送手机验证码', 'send_mobile_verification_code', 'cmf', '发送手机验证码');
INSERT INTO `xjy_hook` VALUES ('12', '3', '0', '模板 body标签开始', 'body_start', '', '模板 body标签开始');
INSERT INTO `xjy_hook` VALUES ('13', '3', '0', '模板 head标签结束前', 'before_head_end', '', '模板 head标签结束前');
INSERT INTO `xjy_hook` VALUES ('14', '3', '0', '模板底部开始', 'footer_start', '', '模板底部开始');
INSERT INTO `xjy_hook` VALUES ('15', '3', '0', '模板底部开始之前', 'before_footer', '', '模板底部开始之前');
INSERT INTO `xjy_hook` VALUES ('16', '3', '0', '模板底部结束之前', 'before_footer_end', '', '模板底部结束之前');
INSERT INTO `xjy_hook` VALUES ('17', '3', '0', '模板 body 标签结束之前', 'before_body_end', '', '模板 body 标签结束之前');
INSERT INTO `xjy_hook` VALUES ('18', '3', '0', '模板左边栏开始', 'left_sidebar_start', '', '模板左边栏开始');
INSERT INTO `xjy_hook` VALUES ('19', '3', '0', '模板左边栏结束之前', 'before_left_sidebar_end', '', '模板左边栏结束之前');
INSERT INTO `xjy_hook` VALUES ('20', '3', '0', '模板右边栏开始', 'right_sidebar_start', '', '模板右边栏开始');
INSERT INTO `xjy_hook` VALUES ('21', '3', '0', '模板右边栏结束之前', 'before_right_sidebar_end', '', '模板右边栏结束之前');
INSERT INTO `xjy_hook` VALUES ('22', '3', '1', '评论区', 'comment', '', '评论区');
INSERT INTO `xjy_hook` VALUES ('23', '3', '1', '留言区', 'guestbook', '', '留言区');
INSERT INTO `xjy_hook` VALUES ('24', '2', '0', '后台首页仪表盘', 'admin_dashboard', 'admin', '后台首页仪表盘');
INSERT INTO `xjy_hook` VALUES ('25', '4', '0', '后台模板 head标签结束前', 'admin_before_head_end', '', '后台模板 head标签结束前');
INSERT INTO `xjy_hook` VALUES ('26', '4', '0', '后台模板 body 标签结束之前', 'admin_before_body_end', '', '后台模板 body 标签结束之前');
INSERT INTO `xjy_hook` VALUES ('27', '2', '0', '后台登录页面', 'admin_login', 'admin', '后台登录页面');
INSERT INTO `xjy_hook` VALUES ('28', '1', '1', '前台模板切换', 'switch_theme', 'cmf', '前台模板切换');
INSERT INTO `xjy_hook` VALUES ('29', '3', '0', '主要内容之后', 'after_content', '', '主要内容之后');
INSERT INTO `xjy_hook` VALUES ('30', '2', '0', '文章显示之前', 'portal_before_assign_article', 'portal', '文章显示之前');
INSERT INTO `xjy_hook` VALUES ('31', '2', '0', '后台文章保存之后', 'portal_admin_after_save_article', 'portal', '后台文章保存之后');
INSERT INTO `xjy_hook` VALUES ('32', '2', '0', '文章显示之前', 'video_before_assign_article', 'video', '文章显示之前');
INSERT INTO `xjy_hook` VALUES ('33', '2', '0', '后台文章保存之后', 'video_admin_after_save_article', 'video', '后台文章保存之后');

-- ----------------------------
-- Table structure for xjy_hook_plugin
-- ----------------------------
DROP TABLE IF EXISTS `xjy_hook_plugin`;
CREATE TABLE `xjy_hook_plugin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `hook` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子名',
  `plugin` varchar(30) NOT NULL DEFAULT '' COMMENT '插件',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='系统钩子插件表';

-- ----------------------------
-- Records of xjy_hook_plugin
-- ----------------------------
INSERT INTO `xjy_hook_plugin` VALUES ('1', '10000', '1', 'admin_login', 'CustomAdminLogin');
INSERT INTO `xjy_hook_plugin` VALUES ('2', '10000', '1', 'admin_dashboard', 'SystemInfo');
INSERT INTO `xjy_hook_plugin` VALUES ('3', '10000', '1', 'send_mobile_verification_code', 'MobileCodeDemo');
INSERT INTO `xjy_hook_plugin` VALUES ('4', '10000', '1', 'switch_theme', 'SwitchThemeDemo');
INSERT INTO `xjy_hook_plugin` VALUES ('5', '10000', '1', 'footer_start', 'Demo');

-- ----------------------------
-- Table structure for xjy_link
-- ----------------------------
DROP TABLE IF EXISTS `xjy_link`;
CREATE TABLE `xjy_link` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:显示;0:不显示',
  `rating` int(11) NOT NULL DEFAULT '0' COMMENT '友情链接评级',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '友情链接描述',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '友情链接地址',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '友情链接名称',
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '友情链接图标',
  `target` varchar(10) NOT NULL DEFAULT '' COMMENT '友情链接打开方式',
  `rel` varchar(50) NOT NULL DEFAULT '' COMMENT '链接与网站的关系',
  PRIMARY KEY (`id`),
  KEY `link_visible` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Records of xjy_link
-- ----------------------------
INSERT INTO `xjy_link` VALUES ('1', '1', '1', '8', 'thinkphp官网', 'http://www.thinkphp.cn/', 'thinkphp', '', '_blank', '');
INSERT INTO `xjy_link` VALUES ('2', '1', '0', '10000', '云九科技软件开发公司', 'http://www.ccapp.com.cn/', '成都APP开发公司', '', '_blank', '');

-- ----------------------------
-- Table structure for xjy_nav
-- ----------------------------
DROP TABLE IF EXISTS `xjy_nav`;
CREATE TABLE `xjy_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_main` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否为主导航;1:是;0:不是',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '导航位置名称',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='前台导航位置表';

-- ----------------------------
-- Records of xjy_nav
-- ----------------------------
INSERT INTO `xjy_nav` VALUES ('1', '1', '主导航', '主导航');
INSERT INTO `xjy_nav` VALUES ('2', '0', '底部导航', '');

-- ----------------------------
-- Table structure for xjy_nav_menu
-- ----------------------------
DROP TABLE IF EXISTS `xjy_nav_menu`;
CREATE TABLE `xjy_nav_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_id` int(11) NOT NULL COMMENT '导航 id',
  `parent_id` int(11) NOT NULL COMMENT '父 id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:显示;0:隐藏',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `target` varchar(10) NOT NULL DEFAULT '' COMMENT '打开方式',
  `href` varchar(100) NOT NULL DEFAULT '' COMMENT '链接',
  `icon` varchar(20) NOT NULL DEFAULT '' COMMENT '图标',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '层级关系',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='前台导航菜单表';

-- ----------------------------
-- Records of xjy_nav_menu
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_notice
-- ----------------------------
DROP TABLE IF EXISTS `xjy_notice`;
CREATE TABLE `xjy_notice` (
  `notice_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '消息通知ID',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户ID',
  `seller_id` bigint(20) unsigned NOT NULL COMMENT '商家ID',
  `send_time` int(11) unsigned NOT NULL COMMENT '发送时间',
  `send_class` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '消息推送类型 1:模块化通知;2:邮件通知;3:短信通知',
  `send_state` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '推送状态 1:发送成功;2:发送失败',
  `notice_text` varchar(255) NOT NULL DEFAULT '' COMMENT '消息内容',
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='消息推送表';

-- ----------------------------
-- Records of xjy_notice
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_option
-- ----------------------------
DROP TABLE IF EXISTS `xjy_option`;
CREATE TABLE `xjy_option` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `autoload` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否自动加载;1:自动加载;0:不自动加载',
  `option_name` varchar(64) NOT NULL DEFAULT '' COMMENT '配置名',
  `option_value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='全站配置表';

-- ----------------------------
-- Records of xjy_option
-- ----------------------------
INSERT INTO `xjy_option` VALUES ('7', '1', 'site_info', '{\"site_name\":\"\\u5c0f\\u4e5d\\u4e91\\u5546\\u52a1\\u7ba1\\u7406\\u4e2d\\u5fc3\",\"site_seo_title\":\"YunJunCMF-\\u4e91\\u4e5d\\u79d1\\u6280\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6ttttt\",\"site_seo_keywords\":\"YunJunCMF-\\u4e91\\u4e5d\\u79d1\\u6280\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6\",\"site_seo_description\":\"YunJunCMF-\\u4e91\\u4e5d\\u79d1\\u6280\\u5185\\u5bb9\\u7ba1\\u7406\\u6846\\u67b6\",\"site_icp\":\"Copyright 2012-2018 www.cloudcooer.com Inc. All Rights Reserved.\",\"site_admin_email\":\"admin@98bs.com\",\"site_analytics\":\"\",\"urlmode\":\"1\",\"html_suffix\":\"\",\"comment_time_interval\":\"60\"}');
INSERT INTO `xjy_option` VALUES ('8', '1', 'smtp_setting', '{\"from_name\":\"sanzwangljx@foxmail.com\",\"from\":\"sanzwangljx@foxmail.com\",\"host\":\"sanzwangljx@foxmail.com\",\"smtp_secure\":\"\",\"port\":\"25\",\"username\":\"sanzwangljx@foxmail.com\",\"password\":\"132222?Penlin\"}');
INSERT INTO `xjy_option` VALUES ('9', '1', 'cmf_settings', '{\"open_registration\":\"0\",\"banned_usernames\":\"\"}');
INSERT INTO `xjy_option` VALUES ('10', '1', 'cdn_settings', '{\"cdn_static_root\":\"\"}');
INSERT INTO `xjy_option` VALUES ('11', '1', 'admin_settings', '{\"admin_password\":\"YunJiuMin\",\"admin_style\":\"flatadmin\"}');
INSERT INTO `xjy_option` VALUES ('12', '1', 'upload_setting', '{\"max_files\":\"4\",\"chunk_size\":\"512\",\"file_types\":{\"image\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"jpg,jpeg,png,gif,bmp4\"},\"video\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"mp4,avi,wmv,rm,rmvb,mkv\"},\"audio\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"mp3,wma,wav\"},\"file\":{\"upload_max_filesize\":\"102400\",\"extensions\":\"txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar\"}}}');
INSERT INTO `xjy_option` VALUES ('13', '1', 'storage', '{\"storages\":{\"Qiniu\":{\"name\":\"\\u4e03\\u725b\\u4e91\\u5b58\\u50a8\",\"driver\":\"\\\\plugins\\\\qiniu\\\\lib\\\\Qiniu\"}}}');
INSERT INTO `xjy_option` VALUES ('14', '1', 'admin_dashboard_widgets', '[{\"name\":\"CmfHub\",\"is_system\":1},{\"name\":\"MainContributors\",\"is_system\":1},{\"name\":\"Contributors\",\"is_system\":1},{\"name\":\"Custom3\",\"is_system\":1},{\"name\":\"Custom2\",\"is_system\":1},{\"name\":\"Custom5\",\"is_system\":1},{\"name\":\"Custom4\",\"is_system\":1},{\"name\":\"SystemInfo\",\"is_system\":0},{\"name\":\"Custom1\",\"is_system\":1}]');

-- ----------------------------
-- Table structure for xjy_order
-- ----------------------------
DROP TABLE IF EXISTS `xjy_order`;
CREATE TABLE `xjy_order` (
  `order_id` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `seller_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  `user_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '第三方用户OpenID',
  `food_type` smallint(2) NOT NULL DEFAULT '0' COMMENT '出菜状态  0:未出菜；1:正在出菜;2:全部出菜',
  `food` varchar(255) NOT NULL DEFAULT '' COMMENT '购买菜品（菜品ID*数量；分割）',
  `order_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下单时间',
  `order_price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单价格（原价）',
  `discount_price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠后的金额',
  `coupon_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '使用优惠劵ID',
  `pay` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否支付 1:未支付;2:确认订单;3:拒绝订单;4:已支付;5:未评价;6:已评价',
  `pay_class` tinyint(2) NOT NULL DEFAULT '2' COMMENT '支付类型 1:支付宝;2:微信;3:银联;4:现金;5:vip卡',
  `order_complete` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '订单是否完成 1:未确认;2:确认;3:拒绝;4:完成',
  `order_delivery` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '订单配送情况 1:未接单;2:配送中;3:配送完成;4:系统接单;5:分配骑手;6:骑手到店;',
  `order_class` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '订单类型 1:餐桌消费;2:外卖订单;3:预约订单;4:直接收银',
  `delivery_type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '配送类型',
  `delivery_evaluate` tinyint(2) unsigned NOT NULL DEFAULT '5' COMMENT '配送评价（1~5）',
  `food_evaluate` varchar(255) NOT NULL DEFAULT '' COMMENT '菜品评价（菜品*评价；分割）',
  `user_evaluate` varchar(255) NOT NULL DEFAULT '' COMMENT '用户对本次购物评论',
  `user_address` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户收货地址ID',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标记删除字段',
  `order_icon` varchar(255) NOT NULL DEFAULT '' COMMENT '用户对订单的评价图片',
  `remarks` varchar(255) NOT NULL DEFAULT '' COMMENT '用户对订单的备注',
  `delivery` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '配送费',
  `table_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'rest表中的餐桌id',
  `token` varchar(40) NOT NULL DEFAULT '' COMMENT '订单token',
  `carrier_driver_name` varchar(50) NOT NULL DEFAULT '' COMMENT '配送员名字',
  `carrier_driver_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '配送员电话',
  `order_info` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '订单推送信息标记 0~5：未推送；6~：已经推送；',
  `order_num` char(20) NOT NULL DEFAULT '' COMMENT '订单号，用于在支付接口查询账单信息',
  `end_time` int(20) NOT NULL COMMENT '结束时间',
  `cashier` int(20) NOT NULL COMMENT '收银员id',
  `price_receipts` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '实收金额',
  `price_discount` float(5,2) NOT NULL DEFAULT '0.00' COMMENT '折扣',
  `price_number` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `coupon` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '优惠卷金额',
  PRIMARY KEY (`order_id`),
  KEY `seller_id` (`seller_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单信息';

-- ----------------------------
-- Records of xjy_order
-- ----------------------------
INSERT INTO `xjy_order` VALUES ('2018062711311854501019', '10', '97', '1', '179*1;207*3;227*1;', '1530070278', '42.00', '66.00', '0', '1', '2', '2', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '78', '', '', '', '0', '', '1530075547', '97', '66.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062711593555535698', '10', '118', '1', '179*2;207*2;229*2;', '1530071975', '36.00', '172.00', '0', '2', '2', '2', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '120', '', '', '', '0', '', '1530076022', '98', '156.52', '57.00', '15.48', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712164710210054', '10', '98', '1', '146*1;172*1;212*1;', '1530073007', '106.00', '106.00', '0', '2', '2', '1', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '68', '', '', '', '0', '', '1530088064', '98', '71.60', '57.00', '34.40', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712172250565455', '10', '123', '1', '179*2;203*1;207*2;229*1;', '1530073042', '36.00', '36.00', '0', '4', '4', '4', '1', '1', '1', '5', '', '', '0', '0', '', '该订单没有备注！', '0.00', '126', '', '', '', '0', '', '1530075634', '98', '20.52', '57.00', '15.48', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712222448100101', '10', '98', '1', '145*1;726*1;735*1;739*1;754*1;805*1;', '1530073344', '243.00', '259.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '130', '', '', '', '0', '', '1530076622', '98', '154.51', '57.00', '104.49', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712252755541025', '10', '121', '1', '185*1;215*1;768*1;', '1530073527', '62.00', '62.00', '0', '1', '3', '1', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '0', '', '', '', '0', '', '0', '0', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712271010148529', '10', '125', '1', '750*1;815*1;228*1;779*1;', '1530073630', '116.00', '116.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '该订单没有备注！', '0.00', '75', '', '', '', '0', '', '1530087968', '98', '66.12', '57.00', '49.88', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712390557975210', '10', '128', '1', '185*1;207*2;212*1;228*1;229*1;769*1;', '1530074345', '106.00', '182.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '129', '', '', '', '0', '', '1530088182', '98', '136.42', '57.00', '45.58', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712391450545250', '10', '22', '1', '783*1;788*1;', '1530074354', '214.00', '214.00', '0', '1', '2', '1', '1', '1', '1', '5', '', '', '0', '0', '', '该订单没有备注！', '0.00', '1', '', '', '', '0', '', '0', '0', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712462953100975', '10', '98', '1', '207*1;229*1;', '1530074789', '12.00', '0.00', '0', '4', '3', '4', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '122', '', '', '', '0', '', '1530088160', '98', '6.84', '57.00', '-6.84', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062712565897995156', '10', '98', '1', '116*1;172*1;177*1;727*1;739*1;207*2;768*1;', '1530075418', '177.00', '177.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '66', '', '', '', '0', '', '1530087923', '98', '100.89', '57.00', '76.11', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062713011598571005', '10', '97', '1', '34*1;47*1;51*1;', '1530075675', '40.00', '0.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '85', '', '', '', '0', '', '1530098176', '97', '40.00', '0.00', '-40.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062713030355975699', '10', '98', '2', '178*2;203*1;207*1;215*3;769*4;', '1530075783', '66.00', '0.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '124', '', '', '', '0', '', '1530088367', '98', '37.62', '57.00', '-37.62', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062713240755525052', '10', '22', '1', '34*2;', '1530077047', '30.00', '30.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '', '0', '0', '', '该订单没有备注！', '0.00', '78', '', '', '', '0', '', '1530098208', '97', '29.70', '99.00', '0.30', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062713251810154489', '10', '97', '1', '36*0;207*0;', '1530077118', '0.00', '0.00', '0', '4', '4', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '80', '', '', '', '0', '', '1530081772', '97', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062713364610149489', '10', '98', '1', '141*1;171*1;734*1;769*1;779*1;', '1530077806', '180.00', '188.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '121', '', '', '', '0', '', '1530088134', '98', '127.80', '57.00', '60.20', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062713394549995110', '10', '98', '1', '205*1;', '1530077985', '8.00', '0.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '126', '', '', '', '0', '', '1530088102', '98', '4.56', '57.00', '-4.56', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062713504452495653', '10', '97', '1', '36*1;46*2;', '1530078644', '45.00', '0.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '139', '', '', '', '0', '', '1530098339', '97', '45.00', '0.00', '-45.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062714012856509854', '10', '98', '1', '200*1;229*1;752*1;769*1;779*1;', '1530079288', '96.00', '0.00', '0', '4', '5', '4', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '127', '', '', '', '0', '', '1530079392', '98', '96.00', '100.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062714093510257545', '10', '97', '1', '36*2;179*2;', '1530079775', '42.00', '42.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '84', '', '', '', '0', '', '1530098233', '97', '41.80', '0.00', '0.20', '0.20');
INSERT INTO `xjy_order` VALUES ('2018062715351955544899', '10', '97', '1', '207*4;', '1530084919', '24.00', '0.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '305', '', '', '', '0', '', '1530098390', '97', '24.00', '0.00', '-24.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062716443551484848', '10', '23', '1', '783*1;138*1;151*1;123*1;136*1;130*1;727*1;515*1;722*1;787*1;796*1;', '1530089074', '847.00', '847.00', '0', '4', '4', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试，', '0.00', '1', '', '', '', '0', '', '1530094163', '98', '482.79', '57.00', '364.21', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062716580610198554', '10', '23', '1', '781*1;754*1;765*1;', '1530089886', '304.00', '304.00', '0', '4', '3', '4', '1', '1', '1', '5', '', '', '0', '0', '', '该订单没有备注！', '0.00', '17', '', '', '', '0', '', '1530094283', '98', '173.28', '57.00', '130.72', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062717044848561005', '10', '23', '1', '256*1;793*1;262*1;291*1;278*1;309*1;330*1;669*1;674*1;', '1530090288', '240.00', '240.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试，', '0.00', '90', '', '', '', '0', '', '1530093952', '98', '136.80', '57.00', '103.20', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062717080250515751', '10', '23', '1', '768*1;179*1;', '1530090482', '24.00', '24.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试', '0.00', '120', '', '', '', '0', '', '1530094119', '98', '13.68', '57.00', '10.32', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062717134910010156', '10', '23', '0', '184*1;232*1;257*1;272*1;299*1;368*1;383*1;430*1;447*1;567*1;582*1;590*1;621*1;631*1;653*1;695*1;698*1;770*1;779*1;789*1;791*1;', '1530090829', '768.00', '768.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试', '0.00', '66', '', '', '', '0', '', '1530094235', '98', '437.76', '57.00', '330.24', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062717231551559749', '10', '22', '1', '756*1;', '1530091395', '38.00', '38.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '该订单没有备注！', '0.00', '67', '', '', '', '0', '', '1530094403', '98', '21.66', '57.00', '16.34', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062717231753491015', '10', '112', '2', '108*1;171*1;726*1;733*1;567*3;', '1530091397', '160.00', '160.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '该订单没有备注！', '0.00', '127', '', '', '', '0', '', '1530093666', '98', '101.52', '57.00', '58.48', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062718282254525655', '10', '98', '1', '179*1;207*1;567*1;750*1;754*1;', '1530095302', '156.00', '0.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试', '0.00', '49', '', '', '', '0', '', '1530097069', '98', '88.92', '57.00', '-88.92', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062718360957971025', '10', '98', '1', '106*1;134*1;136*1;145*1;179*9;726*1;739*1;752*1;804*1;', '1530095769', '359.00', '359.00', '0', '1', '2', '1', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '测试    测试', '0.00', '8', '', '', '', '0', '', '0', '0', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062718364297565356', '10', '20', '0', '130*1;136*1;151*1;750*1;781*1;783*1;373*1;', '1530095802', '629.00', '629.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试', '0.00', '1', '', '', '', '0', '', '1530095952', '98', '563.00', '50.00', '66.00', '50.00');
INSERT INTO `xjy_order` VALUES ('2018062718404610149514', '10', '20', '0', '184*1;186*1;769*1;', '1530096046', '12.00', '12.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试测试', '0.00', '74', '', '', '', '0', '', '1530096133', '98', '6.76', '73.00', '5.24', '2.00');
INSERT INTO `xjy_order` VALUES ('2018062718415753499798', '10', '98', '0', '229*1;815*1;', '1530096117', '24.00', '24.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '测试  测试', '0.00', '127', '', '', '', '0', '', '1530099237', '98', '13.68', '57.00', '10.32', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062718434110010248', '10', '98', '1', '544*1;754*1;', '1530096221', '78.00', '0.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '测试   测试', '0.00', '28', '', '', '', '0', '', '1530099032', '98', '78.00', '0.00', '-78.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062718465648489855', '10', '98', '0', '107*1;134*1;151*1;158*1;561*4;740*1;779*1;', '1530096416', '241.00', '241.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试  测试', '0.00', '10', '', '', '', '0', '', '1530097932', '98', '149.41', '57.00', '91.59', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062718523110253985', '10', '98', '0', '90*1;123*1;177*1;739*1;804*1;815*1;144*1;113*1;', '1530096751', '331.00', '331.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试  测试 ', '0.00', '147', '', '', '', '0', '', '1530102401', '98', '188.67', '57.00', '142.33', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062718585510298971', '10', '98', '0', '212*1;750*1;769*1;', '1530097135', '96.00', '0.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试  测试', '0.00', '30', '', '', '', '0', '', '1530099695', '98', '54.72', '57.00', '-54.72', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062719041510249541', '10', '98', '1', '212*1;229*1;770*2;383*1;384*1;389*1;403*1;605*1;481*1;752*1;', '1530097455', '284.00', '284.00', '0', '4', '4', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试 测试', '0.00', '51', '', '', '', '0', '', '1530102491', '98', '161.88', '57.00', '122.12', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062719170549100100', '10', '112', '0', '34*2;', '1530098225', '30.00', '30.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '该订单没有备注！', '0.00', '78', '', '', '', '0', '', '1530098310', '97', '30.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062719281097499798', '10', '20', '0', '127*1;138*1;186*1;230*1;231*1;258*1;373*1;384*2;431*1;750*3;756*1;769*1;818*1;788*1;', '1530098890', '982.00', '982.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试', '0.00', '1', '', '', '', '0', '', '1530098972', '98', '491.00', '50.00', '491.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062719485998985549', '10', '82', '1', '143*1;172*1;215*2;722*1;799*1;779*1;', '1530100139', '160.00', '160.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试，测试', '0.00', '4', '', '', '', '0', '', '1530102605', '98', '91.20', '57.00', '68.80', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062719535450499798', '10', '82', '1', '134*1;146*1;156*1;171*1;217*1;554*1;779*1;828*1;', '1530100434', '283.00', '293.00', '0', '4', '5', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '测试，测试', '0.00', '5', '', '', '', '0', '', '1530102770', '98', '321.00', '100.00', '-10.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062720344351100499', '10', '98', '0', '554*1;', '1530102883', '10.00', '0.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '90', '', '', '', '0', '', '1530102931', '98', '10.00', '0.00', '-10.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062720393454535598', '10', '98', '0', '90*1;106*1;107*1;108*1;110*1;111*1;', '1530103174', '249.00', '0.00', '0', '4', '5', '4', '1', '1', '1', '5', '', '', '0', '0', '', '测试，测试，', '0.00', '120', '', '', '', '0', '', '1530103229', '98', '249.00', '100.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062720404848484848', '10', '98', '1', '90*1;106*1;107*1;111*1;112*1;113*1;', '1530103248', '259.00', '0.00', '0', '4', '5', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '120', '', '', '', '0', '', '1530103312', '98', '259.00', '100.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062720421252575657', '10', '98', '1', '90*1;95*1;106*1;108*1;110*1;', '1530103332', '252.00', '0.00', '0', '4', '5', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '1', '', '', '', '0', '', '1530103399', '98', '252.00', '100.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062720434751534849', '10', '98', '0', '90*1;95*1;108*1;110*1;', '1530103427', '209.00', '249.00', '0', '4', '5', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '1', '', '', '', '0', '', '1530103632', '98', '249.00', '100.00', '-40.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062720482899485597', '10', '98', '0', '90*1;95*1;106*1;107*1;', '1530103708', '209.00', '0.00', '0', '4', '4', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '1', '', '', '', '0', '', '1530103778', '98', '209.00', '0.00', '-209.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062721114549514957', '10', '10', '0', '116*1;117*1;', '1530105105', '46.00', '0.00', '0', '4', '4', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '1', '', '', '', '0', '', '1530194922', '10', '31.40', '80.00', '14.60', '10.00');
INSERT INTO `xjy_order` VALUES ('2018062810185299565753', '10', '47', '0', '783*1;788*1;818*1;', '1530152332', '215.00', '215.00', '0', '1', '2', '1', '1', '3', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '129', '', '', '', '0', '', '0', '0', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062820402798549856', '10', '10', '0', '184*1;777*1;', '1530189627', '3.00', '4.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '90', '', '', '', '0', '', '1530191494', '10', '1.20', '10.00', '2.80', '1.00');
INSERT INTO `xjy_order` VALUES ('2018062820445050975557', '10', '10', '0', '777*1;', '1530189890', '1.00', '0.00', '0', '1', '2', '2', '1', '1', '1', '5', '', '', '0', '0', '', '', '0.00', '57', '', '', '', '0', '', '0', '0', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062820471955991004', '10', '10', '0', '818*1;', '1530190039', '1.00', '0.00', '0', '1', '2', '2', '1', '3', '1', '5', '', '该用户尚未评价！', '0', '0', '', '', '0.00', '57', '', '', '', '0', '', '0', '0', '0.00', '0.00', '0.00', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062820544755555510', '10', '10', '0', '179*1;235*1;236*1;', '1530190487', '23.00', '0.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '32', '', '', '', '0', '', '1530190988', '10', '3.00', '0.00', '20.00', '20.00');
INSERT INTO `xjy_order` VALUES ('2018062821515497975550', '10', '10', '0', '35*1;36*1;37*1;', '1530193914', '63.00', '85.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '90', '', '', '', '0', '', '1530194525', '10', '68.70', '90.00', '16.30', '10.00');
INSERT INTO `xjy_order` VALUES ('2018062822150798984954', '10', '1', '0', '179*1;762*1;830*1;', '1530195307', '62.00', '230.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '83', '', '', '', '0', '', '1530195770', '10', '212.40', '80.00', '17.60', '10.00');
INSERT INTO `xjy_order` VALUES ('2018062822371910297575', '10', '10', '0', '36*1;37*1;38*1;179*1;', '1530196639', '84.00', '84.00', '0', '4', '2', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '140', '', '', '', '0', '', '1530197145', '10', '65.60', '90.00', '18.40', '10.00');
INSERT INTO `xjy_order` VALUES ('2018062822575551555749', '10', '10', '0', '90*1;95*1;179*1;180*1;', '1530197875', '152.00', '152.00', '0', '4', '1', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '120', '', '', '', '0', '', '1530198435', '10', '66.00', '50.00', '86.00', '10.00');
INSERT INTO `xjy_order` VALUES ('2018062822594099555257', '10', '10', '0', '106*1;107*1;182*1;', '1530197980', '83.00', '83.00', '0', '4', '3', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '1', '', '', '', '0', '', '1530198532', '10', '31.50', '50.00', '51.50', '10.00');
INSERT INTO `xjy_order` VALUES ('2018062823014910098519', '10', '10', '0', '108*1;110*1;179*1;180*1;', '1530198109', '93.00', '0.00', '0', '4', '4', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '', '0.00', '2', '', '', '', '0', '', '1530198947', '10', '63.70', '90.00', '29.30', '20.00');
INSERT INTO `xjy_order` VALUES ('2018062823162557551001', '10', '10', '0', '34*1;179*1;235*1;383*1;521*2;756*1;', '1530198985', '149.00', '149.00', '0', '4', '3', '4', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '该订单没有备注！', '0.00', '17', '', '', '', '0', '', '1530199154', '10', '84.93', '57.00', '64.07', '0.00');
INSERT INTO `xjy_order` VALUES ('2018062823280149999750', '10', '10', '1', '35*1;36*1;', '1530199681', '37.00', '37.00', '0', '1', '2', '2', '1', '1', '1', '5', '', '该用户尚未评价！', '0', '0', '', '加辣', '0.00', '17', '', '', '', '0', '', '0', '0', '0.00', '0.00', '0.00', '0.00');

-- ----------------------------
-- Table structure for xjy_order_food
-- ----------------------------
DROP TABLE IF EXISTS `xjy_order_food`;
CREATE TABLE `xjy_order_food` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(30) NOT NULL DEFAULT '' COMMENT '订单ID',
  `food_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '菜品ID',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  `come_out_num` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '出菜数量',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '出菜状态  0:未出菜；1:正在出菜 ; 2:全部出菜；',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='订单菜品及数量信息表';

-- ----------------------------
-- Records of xjy_order_food
-- ----------------------------
INSERT INTO `xjy_order_food` VALUES ('1', '2018062712565897995156', '116', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('2', '2018062712565897995156', '739', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('3', '2018062712565897995156', '177', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('4', '2018062712565897995156', '172', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('5', '2018062712565897995156', '727', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('6', '2018062713030355975699', '178', '2', '2', '2');
INSERT INTO `xjy_order_food` VALUES ('7', '2018062713030355975699', '203', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('8', '2018062713030355975699', '207', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('9', '2018062713030355975699', '215', '3', '3', '2');
INSERT INTO `xjy_order_food` VALUES ('10', '2018062713030355975699', '769', '4', '4', '2');
INSERT INTO `xjy_order_food` VALUES ('11', '2018062717231753491015', '108', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('12', '2018062717231753491015', '171', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('13', '2018062717231753491015', '726', '1', '1', '2');
INSERT INTO `xjy_order_food` VALUES ('14', '2018062719535450499798', '554', '1', '1', '2');

-- ----------------------------
-- Table structure for xjy_order_pay_class
-- ----------------------------
DROP TABLE IF EXISTS `xjy_order_pay_class`;
CREATE TABLE `xjy_order_pay_class` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '支付名称',
  `icon` varchar(20) NOT NULL DEFAULT '' COMMENT '图标',
  `delete_time` smallint(2) NOT NULL DEFAULT '1' COMMENT '删除标识 1:正常',
  `seller_id` int(20) NOT NULL DEFAULT '0' COMMENT '商家id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='支付方式表';

-- ----------------------------
-- Records of xjy_order_pay_class
-- ----------------------------
INSERT INTO `xjy_order_pay_class` VALUES ('1', '支付宝', '', '1', '10');
INSERT INTO `xjy_order_pay_class` VALUES ('2', '微信', '', '1', '10');
INSERT INTO `xjy_order_pay_class` VALUES ('3', '银联', '', '1', '10');
INSERT INTO `xjy_order_pay_class` VALUES ('4', '现金', '', '1', '10');
INSERT INTO `xjy_order_pay_class` VALUES ('5', 'VIP卡', '', '1', '10');

-- ----------------------------
-- Table structure for xjy_order_pay_price
-- ----------------------------
DROP TABLE IF EXISTS `xjy_order_pay_price`;
CREATE TABLE `xjy_order_pay_price` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` char(22) NOT NULL DEFAULT '' COMMENT '订单id',
  `pay_class_id` int(20) NOT NULL DEFAULT '0' COMMENT '支付方式id',
  `price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='订单对应支付方式的支付金额';

-- ----------------------------
-- Records of xjy_order_pay_price
-- ----------------------------
INSERT INTO `xjy_order_pay_price` VALUES ('1', '2018062823280149999750', '1', '20.00');

-- ----------------------------
-- Table structure for xjy_plugin
-- ----------------------------
DROP TABLE IF EXISTS `xjy_plugin`;
CREATE TABLE `xjy_plugin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '插件类型;1:网站;8:微信',
  `has_admin` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台管理,0:没有;1:有',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:开启;0:禁用',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '插件安装时间',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '插件标识名,英文字母(惟一)',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '插件名称',
  `demo_url` varchar(50) NOT NULL DEFAULT '' COMMENT '演示地址，带协议',
  `hooks` varchar(255) NOT NULL DEFAULT '' COMMENT '实现的钩子;以“,”分隔',
  `author` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '插件作者',
  `author_url` varchar(50) NOT NULL DEFAULT '' COMMENT '作者网站链接',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '插件版本号',
  `description` varchar(255) NOT NULL COMMENT '插件描述',
  `config` text COMMENT '插件配置',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- ----------------------------
-- Records of xjy_plugin
-- ----------------------------
INSERT INTO `xjy_plugin` VALUES ('1', '1', '0', '1', '0', 'CustomAdminLogin', '自定义后台登录页', '', '', 'ThinkCMF', '', '1.0', '自定义后台登录页', '[]');
INSERT INTO `xjy_plugin` VALUES ('2', '1', '0', '1', '0', 'Qiniu', '七牛云存储', '', '', 'ThinkCMF', '', '1.0', '七牛云存储', '{\"accessKey\":\"\",\"secretKey\":\"\",\"protocol\":\"http\",\"domain\":\"\",\"bucket\":\"\",\"style_separator\":\"!\",\"styles_watermark\":\"watermark\",\"styles_avatar\":\"avatar\",\"styles_thumbnail120x120\":\"thumbnail120x120\",\"styles_thumbnail300x300\":\"thumbnail300x300\",\"styles_thumbnail640x640\":\"thumbnail640x640\",\"styles_thumbnail1080x1080\":\"thumbnail1080x1080\"}');
INSERT INTO `xjy_plugin` VALUES ('3', '1', '0', '1', '0', 'SystemInfo', '系统信息', '', '', 'ThinkCMF', '', '1.0', '系统信息', '[]');
INSERT INTO `xjy_plugin` VALUES ('4', '1', '0', '1', '0', 'MobileCodeDemo', '手机验证码演示插件', '', '', 'ThinkCMF', '', '1.0', '手机验证码演示插件', '{\"account_sid\":\"\",\"auth_token\":\"\",\"app_id\":\"\",\"template_id\":\"\",\"expire_minute\":\"30\"}');
INSERT INTO `xjy_plugin` VALUES ('5', '1', '0', '1', '0', 'SwitchThemeDemo', '模板切换演示', 'http://demo.thinkcmf.com', '', 'ThinkCMF', 'http://www.thinkcmf.com', '1.0', '模板切换演示', '[]');
INSERT INTO `xjy_plugin` VALUES ('6', '1', '1', '1', '0', 'Demo', '插件演示', 'http://demo.thinkcmf.com', '', 'ThinkCMF', 'http://www.thinkcmf.com', '1.0', '插件演示', '{\"text\":\"hello,ThinkCMF!\",\"password\":\"\",\"number\":\"1.0\",\"select\":\"1\",\"checkbox\":1,\"radio\":\"1\",\"radio2\":\"1\",\"textarea\":\"\\u8fd9\\u91cc\\u662f\\u4f60\\u8981\\u586b\\u5199\\u7684\\u5185\\u5bb9\",\"date\":\"2017-05-20\",\"datetime\":\"2017-05-20\",\"color\":\"#103633\",\"image\":\"\",\"location\":\"\"}');

-- ----------------------------
-- Table structure for xjy_portal_category
-- ----------------------------
DROP TABLE IF EXISTS `xjy_portal_category`;
CREATE TABLE `xjy_portal_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类父id',
  `post_count` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类文章数',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:发布,0:不发布',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `description` varchar(255) NOT NULL COMMENT '分类描述',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '分类层级关系路径',
  `seo_title` varchar(100) NOT NULL DEFAULT '',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '',
  `seo_description` varchar(255) NOT NULL DEFAULT '',
  `list_tpl` varchar(50) NOT NULL DEFAULT '' COMMENT '分类列表模板',
  `one_tpl` varchar(50) NOT NULL DEFAULT '' COMMENT '分类文章页模板',
  `more` text COMMENT '扩展属性',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='portal应用 文章分类表';

-- ----------------------------
-- Records of xjy_portal_category
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_portal_category_post
-- ----------------------------
DROP TABLE IF EXISTS `xjy_portal_category_post`;
CREATE TABLE `xjy_portal_category_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文章id',
  `category_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:发布;0:不发布',
  PRIMARY KEY (`id`),
  KEY `term_taxonomy_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='portal应用 分类文章对应表';

-- ----------------------------
-- Records of xjy_portal_category_post
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_portal_post
-- ----------------------------
DROP TABLE IF EXISTS `xjy_portal_post`;
CREATE TABLE `xjy_portal_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `post_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型,1:文章;2:页面',
  `post_format` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '内容格式;1:html;2:md',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '发表者用户id',
  `post_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:已发布;0:未发布;',
  `comment_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '评论状态;1:允许;0:不允许',
  `is_top` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶;1:置顶;0:不置顶',
  `recommended` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐;1:推荐;0:不推荐',
  `post_hits` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '查看数',
  `post_like` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数',
  `comment_count` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `published_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `post_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'post标题',
  `post_keywords` varchar(150) NOT NULL DEFAULT '' COMMENT 'seo keywords',
  `post_excerpt` varchar(500) NOT NULL DEFAULT '' COMMENT 'post摘要',
  `post_source` varchar(150) NOT NULL DEFAULT '' COMMENT '转载文章的来源',
  `post_content` text COMMENT '文章内容',
  `post_content_filtered` text COMMENT '处理过的文章内容',
  `more` text COMMENT '扩展属性,如缩略图;格式为json',
  PRIMARY KEY (`id`),
  KEY `type_status_date` (`post_type`,`post_status`,`create_time`,`id`),
  KEY `post_parent` (`parent_id`),
  KEY `post_author` (`user_id`),
  KEY `post_date` (`create_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='portal应用 文章表';

-- ----------------------------
-- Records of xjy_portal_post
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_portal_tag
-- ----------------------------
DROP TABLE IF EXISTS `xjy_portal_tag`;
CREATE TABLE `xjy_portal_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:发布,0:不发布',
  `recommended` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐;1:推荐;0:不推荐',
  `post_count` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '标签文章数',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '标签名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='portal应用 文章标签表';

-- ----------------------------
-- Records of xjy_portal_tag
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_portal_tag_post
-- ----------------------------
DROP TABLE IF EXISTS `xjy_portal_tag_post`;
CREATE TABLE `xjy_portal_tag_post` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '标签 id',
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文章 id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:发布;0:不发布',
  PRIMARY KEY (`id`),
  KEY `term_taxonomy_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='portal应用 标签文章对应表';

-- ----------------------------
-- Records of xjy_portal_tag_post
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_printer
-- ----------------------------
DROP TABLE IF EXISTS `xjy_printer`;
CREATE TABLE `xjy_printer` (
  `printer_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '打印机编号',
  `seller_id` bigint(20) unsigned NOT NULL COMMENT '店家id',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `type` int(5) unsigned NOT NULL DEFAULT '1' COMMENT '状态  0:停用;1:启用',
  `secret_key` varchar(20) NOT NULL COMMENT '秘钥',
  `voice` smallint(20) unsigned NOT NULL DEFAULT '0' COMMENT '声音管理  0:关闭；1：滴滴声；2、3、4：真人语音（小、中、大）；',
  `position` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '''打印机的位置  0:前台；1:后厨;2:收银统计打印''',
  PRIMARY KEY (`printer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='打印机';

-- ----------------------------
-- Records of xjy_printer
-- ----------------------------
INSERT INTO `xjy_printer` VALUES ('617501619', '10', '																																																																																																																																												2																																																																																																																		', '1', 'd4pzuqhg', '1', '2');
INSERT INTO `xjy_printer` VALUES ('718500854', '10', '															12号 -》收银台 -》茶坊厅																																																	', '0', 'mzrke7pp', '3', '0');
INSERT INTO `xjy_printer` VALUES ('718500855', '10', '																														14号 -》传菜位 -》火锅、山蒸、海味、油碟（火锅）类 ( 2号点位 )																							', '0', '82vhnqds', '2', '1');
INSERT INTO `xjy_printer` VALUES ('918504505', '10', '										13号 -》收银台 -》果饮区																																																																																				', '0', 'ezzn2uaq', '3', '0');
INSERT INTO `xjy_printer` VALUES ('918504506', '10', '																																																																	11号 -》收银台 -》中餐、干锅、汤锅、小吃、烧烤、串串、山珍、海味； 1号点位																																																																																																		', '0', 'wjgtmj3v', '2', '0');
INSERT INTO `xjy_printer` VALUES ('918512499', '10', '																				4号 -》后厨 -》小吃、烧烤、串串类 2号点位																			', '0', 'bd69quk3', '2', '1');
INSERT INTO `xjy_printer` VALUES ('918512500', '10', '																				7号 -》后厨 -》火锅 -》 现切鲜牛肉（火锅类）、现切牛肉（汤锅类）、荤菜（火锅类）、现制特色菜品（火锅、山珍、海味类）、特色直供菜品（火锅、山珍、海味类）、海鱼（干锅类）、以及干锅大类																', '0', 'nvz8kw5n', '2', '1');
INSERT INTO `xjy_printer` VALUES ('918512501', '10', '																				1号 -》后厨 -》中餐 -》凉菜																', '0', '6wdqr6tm', '1', '1');
INSERT INTO `xjy_printer` VALUES ('918512502', '10', '																																								10号 -》收银台 -》火锅厅																																		', '0', 'c7ew64m5', '1', '0');
INSERT INTO `xjy_printer` VALUES ('918512503', '10', '																																								8号 -》后厨 -》精品肥牛肉（火锅、汤锅、山珍、海味类）、海鲜类（海味）																										', '0', 'j4ada2p7', '1', '1');
INSERT INTO `xjy_printer` VALUES ('918512504', '10', '															9号 -》后厨 -》小吃、烧烤、串串				', '0', 'wupfqzjp', '2', '1');
INSERT INTO `xjy_printer` VALUES ('918512505', '10', '																																								2号 -》传菜台 -》中餐、干锅、汤锅、米饭、套餐一、套餐二   1号点位																																									', '0', 'szunzgq3', '2', '1');
INSERT INTO `xjy_printer` VALUES ('918512506', '10', '																																								5号 -》后厨 -》火锅、海味锅底、汤锅 （ 每人每）、山珍 、锅底、海味、（ 海味）、																													', '0', 'wtusgppu', '2', '1');
INSERT INTO `xjy_printer` VALUES ('918512507', '10', '																																								3号 -》后厨 -》中餐 -》（ 出凉菜、川香鲜卤类之外的菜品类别）、套餐一	、套餐二																										', '0', 'nctacd38', '1', '1');
INSERT INTO `xjy_printer` VALUES ('918512508', '10', '								6号 -》后厨 -》蔬菜类、菌类（火锅、汤锅、山珍、海味类）、共用																								', '0', 'cu2s6ptm', '2', '1');

-- ----------------------------
-- Table structure for xjy_printer_menu
-- ----------------------------
DROP TABLE IF EXISTS `xjy_printer_menu`;
CREATE TABLE `xjy_printer_menu` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `print_id` int(20) NOT NULL COMMENT '打印机id',
  `menu_id` int(20) NOT NULL COMMENT '菜系id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=659 DEFAULT CHARSET=utf8 COMMENT='打印机关联菜系id';

-- ----------------------------
-- Records of xjy_printer_menu
-- ----------------------------
INSERT INTO `xjy_printer_menu` VALUES ('28', '918504506', '179');
INSERT INTO `xjy_printer_menu` VALUES ('29', '918504506', '181');
INSERT INTO `xjy_printer_menu` VALUES ('30', '918504506', '182');
INSERT INTO `xjy_printer_menu` VALUES ('31', '918504506', '187');
INSERT INTO `xjy_printer_menu` VALUES ('32', '918504506', '188');
INSERT INTO `xjy_printer_menu` VALUES ('95', '918504505', '206');
INSERT INTO `xjy_printer_menu` VALUES ('96', '918504505', '213');
INSERT INTO `xjy_printer_menu` VALUES ('174', '918512502', '200');
INSERT INTO `xjy_printer_menu` VALUES ('175', '918512502', '244');
INSERT INTO `xjy_printer_menu` VALUES ('176', '918512502', '243');
INSERT INTO `xjy_printer_menu` VALUES ('177', '918512502', '242');
INSERT INTO `xjy_printer_menu` VALUES ('178', '918512502', '268');
INSERT INTO `xjy_printer_menu` VALUES ('179', '918512502', '241');
INSERT INTO `xjy_printer_menu` VALUES ('180', '918512502', '240');
INSERT INTO `xjy_printer_menu` VALUES ('181', '918512502', '239');
INSERT INTO `xjy_printer_menu` VALUES ('182', '918512502', '201');
INSERT INTO `xjy_printer_menu` VALUES ('183', '918512502', '202');
INSERT INTO `xjy_printer_menu` VALUES ('196', '918512500', '243');
INSERT INTO `xjy_printer_menu` VALUES ('199', '918512500', '241');
INSERT INTO `xjy_printer_menu` VALUES ('200', '918512500', '240');
INSERT INTO `xjy_printer_menu` VALUES ('202', '918512500', '201');
INSERT INTO `xjy_printer_menu` VALUES ('213', '918512501', '179');
INSERT INTO `xjy_printer_menu` VALUES ('214', '918512501', '181');
INSERT INTO `xjy_printer_menu` VALUES ('215', '918512505', '249');
INSERT INTO `xjy_printer_menu` VALUES ('216', '918512505', '270');
INSERT INTO `xjy_printer_menu` VALUES ('217', '918512505', '187');
INSERT INTO `xjy_printer_menu` VALUES ('218', '918512505', '182');
INSERT INTO `xjy_printer_menu` VALUES ('219', '918512505', '235');
INSERT INTO `xjy_printer_menu` VALUES ('220', '918512505', '214');
INSERT INTO `xjy_printer_menu` VALUES ('221', '918512507', '188');
INSERT INTO `xjy_printer_menu` VALUES ('260', '918504506', '249');
INSERT INTO `xjy_printer_menu` VALUES ('261', '918504506', '270');
INSERT INTO `xjy_printer_menu` VALUES ('262', '918504506', '235');
INSERT INTO `xjy_printer_menu` VALUES ('263', '918504506', '215');
INSERT INTO `xjy_printer_menu` VALUES ('264', '918504506', '214');
INSERT INTO `xjy_printer_menu` VALUES ('265', '718500854', '207');
INSERT INTO `xjy_printer_menu` VALUES ('266', '718500854', '209');
INSERT INTO `xjy_printer_menu` VALUES ('267', '918504505', '252');
INSERT INTO `xjy_printer_menu` VALUES ('268', '918504505', '255');
INSERT INTO `xjy_printer_menu` VALUES ('269', '918504505', '260');
INSERT INTO `xjy_printer_menu` VALUES ('270', '918504505', '259');
INSERT INTO `xjy_printer_menu` VALUES ('271', '918504505', '258');
INSERT INTO `xjy_printer_menu` VALUES ('272', '918504505', '257');
INSERT INTO `xjy_printer_menu` VALUES ('273', '918504505', '256');
INSERT INTO `xjy_printer_menu` VALUES ('284', '718500855', '200');
INSERT INTO `xjy_printer_menu` VALUES ('285', '718500855', '244');
INSERT INTO `xjy_printer_menu` VALUES ('286', '718500855', '243');
INSERT INTO `xjy_printer_menu` VALUES ('287', '718500855', '242');
INSERT INTO `xjy_printer_menu` VALUES ('288', '718500855', '268');
INSERT INTO `xjy_printer_menu` VALUES ('289', '718500855', '241');
INSERT INTO `xjy_printer_menu` VALUES ('290', '718500855', '240');
INSERT INTO `xjy_printer_menu` VALUES ('291', '718500855', '239');
INSERT INTO `xjy_printer_menu` VALUES ('292', '718500855', '201');
INSERT INTO `xjy_printer_menu` VALUES ('293', '718500855', '202');
INSERT INTO `xjy_printer_menu` VALUES ('303', '718500855', '184');
INSERT INTO `xjy_printer_menu` VALUES ('304', '718500855', '248');
INSERT INTO `xjy_printer_menu` VALUES ('305', '718500855', '265');
INSERT INTO `xjy_printer_menu` VALUES ('306', '718500855', '263');
INSERT INTO `xjy_printer_menu` VALUES ('307', '718500855', '261');
INSERT INTO `xjy_printer_menu` VALUES ('308', '718500855', '193');
INSERT INTO `xjy_printer_menu` VALUES ('309', '718500855', '180');
INSERT INTO `xjy_printer_menu` VALUES ('310', '718500855', '247');
INSERT INTO `xjy_printer_menu` VALUES ('311', '718500855', '267');
INSERT INTO `xjy_printer_menu` VALUES ('312', '718500855', '266');
INSERT INTO `xjy_printer_menu` VALUES ('313', '718500855', '264');
INSERT INTO `xjy_printer_menu` VALUES ('314', '718500855', '262');
INSERT INTO `xjy_printer_menu` VALUES ('315', '718500855', '194');
INSERT INTO `xjy_printer_menu` VALUES ('318', '918504506', '204');
INSERT INTO `xjy_printer_menu` VALUES ('319', '918504506', '211');
INSERT INTO `xjy_printer_menu` VALUES ('320', '918504506', '246');
INSERT INTO `xjy_printer_menu` VALUES ('321', '918504506', '254');
INSERT INTO `xjy_printer_menu` VALUES ('322', '918504506', '253');
INSERT INTO `xjy_printer_menu` VALUES ('323', '918504506', '251');
INSERT INTO `xjy_printer_menu` VALUES ('324', '918504506', '250');
INSERT INTO `xjy_printer_menu` VALUES ('325', '918504506', '198');
INSERT INTO `xjy_printer_menu` VALUES ('327', '918504506', '195');
INSERT INTO `xjy_printer_menu` VALUES ('328', '918504506', '269');
INSERT INTO `xjy_printer_menu` VALUES ('329', '918504506', '197');
INSERT INTO `xjy_printer_menu` VALUES ('331', '918504506', '238');
INSERT INTO `xjy_printer_menu` VALUES ('332', '918504506', '237');
INSERT INTO `xjy_printer_menu` VALUES ('333', '918504506', '236');
INSERT INTO `xjy_printer_menu` VALUES ('334', '918504506', '184');
INSERT INTO `xjy_printer_menu` VALUES ('335', '918504506', '248');
INSERT INTO `xjy_printer_menu` VALUES ('336', '918504506', '265');
INSERT INTO `xjy_printer_menu` VALUES ('337', '918504506', '263');
INSERT INTO `xjy_printer_menu` VALUES ('338', '918504506', '261');
INSERT INTO `xjy_printer_menu` VALUES ('339', '918504506', '193');
INSERT INTO `xjy_printer_menu` VALUES ('340', '918504506', '205');
INSERT INTO `xjy_printer_menu` VALUES ('341', '918504506', '212');
INSERT INTO `xjy_printer_menu` VALUES ('342', '918504506', '180');
INSERT INTO `xjy_printer_menu` VALUES ('343', '918504506', '247');
INSERT INTO `xjy_printer_menu` VALUES ('344', '918504506', '266');
INSERT INTO `xjy_printer_menu` VALUES ('345', '918504506', '264');
INSERT INTO `xjy_printer_menu` VALUES ('346', '918504506', '262');
INSERT INTO `xjy_printer_menu` VALUES ('347', '918504506', '194');
INSERT INTO `xjy_printer_menu` VALUES ('348', '918512505', '179');
INSERT INTO `xjy_printer_menu` VALUES ('349', '918512505', '188');
INSERT INTO `xjy_printer_menu` VALUES ('350', '918512505', '181');
INSERT INTO `xjy_printer_menu` VALUES ('351', '918512505', '215');
INSERT INTO `xjy_printer_menu` VALUES ('361', '918512505', '198');
INSERT INTO `xjy_printer_menu` VALUES ('363', '918512505', '195');
INSERT INTO `xjy_printer_menu` VALUES ('364', '918512505', '269');
INSERT INTO `xjy_printer_menu` VALUES ('365', '918512505', '197');
INSERT INTO `xjy_printer_menu` VALUES ('367', '918512505', '238');
INSERT INTO `xjy_printer_menu` VALUES ('368', '918512505', '237');
INSERT INTO `xjy_printer_menu` VALUES ('369', '918512505', '236');
INSERT INTO `xjy_printer_menu` VALUES ('385', '918512499', '203');
INSERT INTO `xjy_printer_menu` VALUES ('386', '918512499', '210');
INSERT INTO `xjy_printer_menu` VALUES ('387', '918512499', '204');
INSERT INTO `xjy_printer_menu` VALUES ('388', '918512499', '211');
INSERT INTO `xjy_printer_menu` VALUES ('389', '918512499', '205');
INSERT INTO `xjy_printer_menu` VALUES ('390', '918512499', '212');
INSERT INTO `xjy_printer_menu` VALUES ('392', '918512507', '270');
INSERT INTO `xjy_printer_menu` VALUES ('393', '918512507', '187');
INSERT INTO `xjy_printer_menu` VALUES ('394', '918512507', '182');
INSERT INTO `xjy_printer_menu` VALUES ('395', '918512507', '235');
INSERT INTO `xjy_printer_menu` VALUES ('396', '918512507', '214');
INSERT INTO `xjy_printer_menu` VALUES ('397', '918512501', '215');
INSERT INTO `xjy_printer_menu` VALUES ('399', '918512503', '242');
INSERT INTO `xjy_printer_menu` VALUES ('402', '918512504', '203');
INSERT INTO `xjy_printer_menu` VALUES ('403', '918512504', '210');
INSERT INTO `xjy_printer_menu` VALUES ('404', '918512504', '204');
INSERT INTO `xjy_printer_menu` VALUES ('405', '918512504', '211');
INSERT INTO `xjy_printer_menu` VALUES ('406', '918512504', '205');
INSERT INTO `xjy_printer_menu` VALUES ('407', '918512504', '212');
INSERT INTO `xjy_printer_menu` VALUES ('408', '918512503', '180');
INSERT INTO `xjy_printer_menu` VALUES ('412', '918512503', '262');
INSERT INTO `xjy_printer_menu` VALUES ('413', '918512503', '194');
INSERT INTO `xjy_printer_menu` VALUES ('414', '918512506', '239');
INSERT INTO `xjy_printer_menu` VALUES ('415', '918512506', '197');
INSERT INTO `xjy_printer_menu` VALUES ('416', '918512507', '179');
INSERT INTO `xjy_printer_menu` VALUES ('422', '918504506', '267');
INSERT INTO `xjy_printer_menu` VALUES ('423', '918512500', '200');
INSERT INTO `xjy_printer_menu` VALUES ('424', '918512503', '200');
INSERT INTO `xjy_printer_menu` VALUES ('425', '918512506', '200');
INSERT INTO `xjy_printer_menu` VALUES ('426', '918512506', '195');
INSERT INTO `xjy_printer_menu` VALUES ('427', '918512508', '200');
INSERT INTO `xjy_printer_menu` VALUES ('428', '918512508', '202');
INSERT INTO `xjy_printer_menu` VALUES ('429', '918512508', '195');
INSERT INTO `xjy_printer_menu` VALUES ('430', '918512508', '237');
INSERT INTO `xjy_printer_menu` VALUES ('431', '918512508', '184');
INSERT INTO `xjy_printer_menu` VALUES ('432', '918512508', '248');
INSERT INTO `xjy_printer_menu` VALUES ('433', '918512508', '180');
INSERT INTO `xjy_printer_menu` VALUES ('434', '918512508', '247');
INSERT INTO `xjy_printer_menu` VALUES ('436', '918512505', '272');
INSERT INTO `xjy_printer_menu` VALUES ('437', '918512505', '273');
INSERT INTO `xjy_printer_menu` VALUES ('438', '918512505', '275');
INSERT INTO `xjy_printer_menu` VALUES ('439', '918512502', '272');
INSERT INTO `xjy_printer_menu` VALUES ('440', '918504506', '272');
INSERT INTO `xjy_printer_menu` VALUES ('441', '918504506', '273');
INSERT INTO `xjy_printer_menu` VALUES ('442', '918504506', '275');
INSERT INTO `xjy_printer_menu` VALUES ('443', '918504506', '274');
INSERT INTO `xjy_printer_menu` VALUES ('444', '918504506', '276');
INSERT INTO `xjy_printer_menu` VALUES ('445', '918512502', '274');
INSERT INTO `xjy_printer_menu` VALUES ('446', '918512502', '276');
INSERT INTO `xjy_printer_menu` VALUES ('447', '718500855', '272');
INSERT INTO `xjy_printer_menu` VALUES ('448', '918512507', '273');
INSERT INTO `xjy_printer_menu` VALUES ('449', '918512507', '275');
INSERT INTO `xjy_printer_menu` VALUES ('451', '918512500', '198');
INSERT INTO `xjy_printer_menu` VALUES ('453', '918512500', '236');
INSERT INTO `xjy_printer_menu` VALUES ('454', '918512500', '265');
INSERT INTO `xjy_printer_menu` VALUES ('455', '918512500', '263');
INSERT INTO `xjy_printer_menu` VALUES ('456', '918512500', '266');
INSERT INTO `xjy_printer_menu` VALUES ('457', '918512500', '264');
INSERT INTO `xjy_printer_menu` VALUES ('460', '918512503', '238');
INSERT INTO `xjy_printer_menu` VALUES ('461', '918512503', '261');
INSERT INTO `xjy_printer_menu` VALUES ('463', '918512508', '268');
INSERT INTO `xjy_printer_menu` VALUES ('464', '918512508', '269');
INSERT INTO `xjy_printer_menu` VALUES ('465', '918512508', '193');
INSERT INTO `xjy_printer_menu` VALUES ('466', '918512508', '267');
INSERT INTO `xjy_printer_menu` VALUES ('467', '918512506', '278');
INSERT INTO `xjy_printer_menu` VALUES ('468', '918512506', '279');
INSERT INTO `xjy_printer_menu` VALUES ('471', '918512505', '277');
INSERT INTO `xjy_printer_menu` VALUES ('472', '918504506', '283');
INSERT INTO `xjy_printer_menu` VALUES ('473', '918504506', '284');
INSERT INTO `xjy_printer_menu` VALUES ('474', '918504506', '277');
INSERT INTO `xjy_printer_menu` VALUES ('475', '918504506', '278');
INSERT INTO `xjy_printer_menu` VALUES ('476', '918504506', '279');
INSERT INTO `xjy_printer_menu` VALUES ('477', '918504506', '282');
INSERT INTO `xjy_printer_menu` VALUES ('478', '918504506', '281');
INSERT INTO `xjy_printer_menu` VALUES ('479', '918504506', '280');
INSERT INTO `xjy_printer_menu` VALUES ('480', '718500855', '278');
INSERT INTO `xjy_printer_menu` VALUES ('481', '718500855', '279');
INSERT INTO `xjy_printer_menu` VALUES ('482', '718500855', '282');
INSERT INTO `xjy_printer_menu` VALUES ('483', '918512500', '277');
INSERT INTO `xjy_printer_menu` VALUES ('484', '918512502', '282');
INSERT INTO `xjy_printer_menu` VALUES ('485', '918512502', '281');
INSERT INTO `xjy_printer_menu` VALUES ('486', '918512502', '280');
INSERT INTO `xjy_printer_menu` VALUES ('487', '918512505', '283');
INSERT INTO `xjy_printer_menu` VALUES ('488', '918512505', '284');
INSERT INTO `xjy_printer_menu` VALUES ('489', '918512505', '282');
INSERT INTO `xjy_printer_menu` VALUES ('490', '918512506', '184');
INSERT INTO `xjy_printer_menu` VALUES ('491', '918512506', '180');
INSERT INTO `xjy_printer_menu` VALUES ('493', '918512507', '284');
INSERT INTO `xjy_printer_menu` VALUES ('494', '918512501', '283');
INSERT INTO `xjy_printer_menu` VALUES ('496', '918512503', '179');
INSERT INTO `xjy_printer_menu` VALUES ('497', '918512503', '249');
INSERT INTO `xjy_printer_menu` VALUES ('498', '718500855', '203');
INSERT INTO `xjy_printer_menu` VALUES ('499', '718500855', '210');
INSERT INTO `xjy_printer_menu` VALUES ('500', '918504506', '285');
INSERT INTO `xjy_printer_menu` VALUES ('501', '918504506', '286');
INSERT INTO `xjy_printer_menu` VALUES ('502', '918512505', '285');
INSERT INTO `xjy_printer_menu` VALUES ('503', '918512505', '286');
INSERT INTO `xjy_printer_menu` VALUES ('504', '918512507', '285');
INSERT INTO `xjy_printer_menu` VALUES ('505', '918512507', '286');
INSERT INTO `xjy_printer_menu` VALUES ('582', '617501619', '205');
INSERT INTO `xjy_printer_menu` VALUES ('583', '617501619', '212');
INSERT INTO `xjy_printer_menu` VALUES ('584', '617501619', '179');
INSERT INTO `xjy_printer_menu` VALUES ('585', '617501619', '284');
INSERT INTO `xjy_printer_menu` VALUES ('586', '617501619', '283');
INSERT INTO `xjy_printer_menu` VALUES ('587', '617501619', '270');
INSERT INTO `xjy_printer_menu` VALUES ('588', '617501619', '214');
INSERT INTO `xjy_printer_menu` VALUES ('589', '617501619', '188');
INSERT INTO `xjy_printer_menu` VALUES ('590', '617501619', '187');
INSERT INTO `xjy_printer_menu` VALUES ('591', '617501619', '182');
INSERT INTO `xjy_printer_menu` VALUES ('592', '617501619', '215');
INSERT INTO `xjy_printer_menu` VALUES ('593', '617501619', '235');
INSERT INTO `xjy_printer_menu` VALUES ('594', '617501619', '249');
INSERT INTO `xjy_printer_menu` VALUES ('595', '617501619', '181');
INSERT INTO `xjy_printer_menu` VALUES ('596', '617501619', '200');
INSERT INTO `xjy_printer_menu` VALUES ('597', '617501619', '268');
INSERT INTO `xjy_printer_menu` VALUES ('598', '617501619', '202');
INSERT INTO `xjy_printer_menu` VALUES ('599', '617501619', '201');
INSERT INTO `xjy_printer_menu` VALUES ('600', '617501619', '244');
INSERT INTO `xjy_printer_menu` VALUES ('601', '617501619', '243');
INSERT INTO `xjy_printer_menu` VALUES ('602', '617501619', '242');
INSERT INTO `xjy_printer_menu` VALUES ('603', '617501619', '241');
INSERT INTO `xjy_printer_menu` VALUES ('604', '617501619', '240');
INSERT INTO `xjy_printer_menu` VALUES ('605', '617501619', '239');
INSERT INTO `xjy_printer_menu` VALUES ('606', '617501619', '203');
INSERT INTO `xjy_printer_menu` VALUES ('607', '617501619', '210');
INSERT INTO `xjy_printer_menu` VALUES ('608', '617501619', '207');
INSERT INTO `xjy_printer_menu` VALUES ('609', '617501619', '209');
INSERT INTO `xjy_printer_menu` VALUES ('610', '617501619', '204');
INSERT INTO `xjy_printer_menu` VALUES ('611', '617501619', '211');
INSERT INTO `xjy_printer_menu` VALUES ('612', '617501619', '198');
INSERT INTO `xjy_printer_menu` VALUES ('613', '617501619', '277');
INSERT INTO `xjy_printer_menu` VALUES ('614', '617501619', '195');
INSERT INTO `xjy_printer_menu` VALUES ('615', '617501619', '269');
INSERT INTO `xjy_printer_menu` VALUES ('616', '617501619', '197');
INSERT INTO `xjy_printer_menu` VALUES ('617', '617501619', '238');
INSERT INTO `xjy_printer_menu` VALUES ('618', '617501619', '237');
INSERT INTO `xjy_printer_menu` VALUES ('619', '617501619', '236');
INSERT INTO `xjy_printer_menu` VALUES ('620', '617501619', '184');
INSERT INTO `xjy_printer_menu` VALUES ('621', '617501619', '265');
INSERT INTO `xjy_printer_menu` VALUES ('622', '617501619', '263');
INSERT INTO `xjy_printer_menu` VALUES ('623', '617501619', '261');
INSERT INTO `xjy_printer_menu` VALUES ('624', '617501619', '278');
INSERT INTO `xjy_printer_menu` VALUES ('625', '617501619', '193');
INSERT INTO `xjy_printer_menu` VALUES ('626', '617501619', '248');
INSERT INTO `xjy_printer_menu` VALUES ('627', '617501619', '180');
INSERT INTO `xjy_printer_menu` VALUES ('628', '617501619', '262');
INSERT INTO `xjy_printer_menu` VALUES ('629', '617501619', '264');
INSERT INTO `xjy_printer_menu` VALUES ('630', '617501619', '266');
INSERT INTO `xjy_printer_menu` VALUES ('631', '617501619', '267');
INSERT INTO `xjy_printer_menu` VALUES ('632', '617501619', '279');
INSERT INTO `xjy_printer_menu` VALUES ('633', '617501619', '194');
INSERT INTO `xjy_printer_menu` VALUES ('634', '617501619', '247');
INSERT INTO `xjy_printer_menu` VALUES ('635', '617501619', '206');
INSERT INTO `xjy_printer_menu` VALUES ('636', '617501619', '260');
INSERT INTO `xjy_printer_menu` VALUES ('637', '617501619', '259');
INSERT INTO `xjy_printer_menu` VALUES ('638', '617501619', '258');
INSERT INTO `xjy_printer_menu` VALUES ('639', '617501619', '257');
INSERT INTO `xjy_printer_menu` VALUES ('640', '617501619', '256');
INSERT INTO `xjy_printer_menu` VALUES ('641', '617501619', '255');
INSERT INTO `xjy_printer_menu` VALUES ('642', '617501619', '252');
INSERT INTO `xjy_printer_menu` VALUES ('643', '617501619', '213');
INSERT INTO `xjy_printer_menu` VALUES ('644', '617501619', '246');
INSERT INTO `xjy_printer_menu` VALUES ('645', '617501619', '254');
INSERT INTO `xjy_printer_menu` VALUES ('646', '617501619', '253');
INSERT INTO `xjy_printer_menu` VALUES ('647', '617501619', '251');
INSERT INTO `xjy_printer_menu` VALUES ('648', '617501619', '250');
INSERT INTO `xjy_printer_menu` VALUES ('649', '617501619', '273');
INSERT INTO `xjy_printer_menu` VALUES ('650', '617501619', '275');
INSERT INTO `xjy_printer_menu` VALUES ('651', '617501619', '272');
INSERT INTO `xjy_printer_menu` VALUES ('652', '617501619', '282');
INSERT INTO `xjy_printer_menu` VALUES ('653', '617501619', '274');
INSERT INTO `xjy_printer_menu` VALUES ('654', '617501619', '281');
INSERT INTO `xjy_printer_menu` VALUES ('655', '617501619', '280');
INSERT INTO `xjy_printer_menu` VALUES ('656', '617501619', '276');
INSERT INTO `xjy_printer_menu` VALUES ('657', '617501619', '285');
INSERT INTO `xjy_printer_menu` VALUES ('658', '617501619', '286');

-- ----------------------------
-- Table structure for xjy_printer_position
-- ----------------------------
DROP TABLE IF EXISTS `xjy_printer_position`;
CREATE TABLE `xjy_printer_position` (
  `posit_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '位置名称',
  `seller_id` int(20) unsigned NOT NULL COMMENT '商家id',
  `delete_time` int(5) unsigned NOT NULL DEFAULT '1' COMMENT '删除标识 1:正常',
  PRIMARY KEY (`posit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='打印机位置名称';

-- ----------------------------
-- Records of xjy_printer_position
-- ----------------------------
INSERT INTO `xjy_printer_position` VALUES ('1', '前台', '10', '1');
INSERT INTO `xjy_printer_position` VALUES ('2', '后厨', '10', '1');
INSERT INTO `xjy_printer_position` VALUES ('3', '收银统计打印', '10', '1');

-- ----------------------------
-- Table structure for xjy_printer_to_position
-- ----------------------------
DROP TABLE IF EXISTS `xjy_printer_to_position`;
CREATE TABLE `xjy_printer_to_position` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `printer_id` int(20) unsigned NOT NULL COMMENT '打印机id',
  `posit_id` int(20) unsigned NOT NULL COMMENT '位置名称id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='打印机位置关联表';

-- ----------------------------
-- Records of xjy_printer_to_position
-- ----------------------------
INSERT INTO `xjy_printer_to_position` VALUES ('1', '718500854', '1');
INSERT INTO `xjy_printer_to_position` VALUES ('2', '718500854', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('3', '718500854', '3');
INSERT INTO `xjy_printer_to_position` VALUES ('4', '718500855', '1');
INSERT INTO `xjy_printer_to_position` VALUES ('5', '918504505', '1');
INSERT INTO `xjy_printer_to_position` VALUES ('6', '918504505', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('7', '918504505', '3');
INSERT INTO `xjy_printer_to_position` VALUES ('8', '918504506', '3');
INSERT INTO `xjy_printer_to_position` VALUES ('12', '918512501', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('10', '918512500', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('11', '918512499', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('13', '918512502', '3');
INSERT INTO `xjy_printer_to_position` VALUES ('14', '918512503', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('15', '918512504', '1');
INSERT INTO `xjy_printer_to_position` VALUES ('16', '918512505', '1');
INSERT INTO `xjy_printer_to_position` VALUES ('17', '918512506', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('18', '918512507', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('19', '918512508', '2');
INSERT INTO `xjy_printer_to_position` VALUES ('30', '617501619', '3');

-- ----------------------------
-- Table structure for xjy_recharge_record
-- ----------------------------
DROP TABLE IF EXISTS `xjy_recharge_record`;
CREATE TABLE `xjy_recharge_record` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL COMMENT '操作人id',
  `men_id` int(20) NOT NULL COMMENT '客户id',
  `time` int(20) NOT NULL COMMENT '记录时间',
  `before` decimal(20,2) NOT NULL COMMENT '充值前的金额',
  `amount` decimal(20,2) NOT NULL COMMENT '充值金额',
  `seller_id` int(20) NOT NULL COMMENT '商户id',
  `card_id` int(20) NOT NULL COMMENT '卡片id',
  `type` smallint(5) NOT NULL DEFAULT '1' COMMENT '记录状态 1:正常;2:回退;',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='充值记录表';

-- ----------------------------
-- Records of xjy_recharge_record
-- ----------------------------
INSERT INTO `xjy_recharge_record` VALUES ('1', '10', '21', '1527688631', '9940.27', '200.00', '10', '0', '1');
INSERT INTO `xjy_recharge_record` VALUES ('2', '10', '40', '1527735893', '0.00', '17777.00', '10', '0', '1');
INSERT INTO `xjy_recharge_record` VALUES ('3', '10', '55', '1527750807', '0.00', '17777.00', '10', '0', '1');
INSERT INTO `xjy_recharge_record` VALUES ('4', '10', '55', '1527750807', '17777.00', '17777.00', '10', '0', '1');
INSERT INTO `xjy_recharge_record` VALUES ('5', '10', '55', '1527750808', '35554.00', '17777.00', '10', '0', '1');
INSERT INTO `xjy_recharge_record` VALUES ('6', '10', '55', '1527750808', '53331.00', '17777.00', '10', '0', '1');
INSERT INTO `xjy_recharge_record` VALUES ('7', '10', '55', '1527751718', '71108.00', '10000.00', '10', '0', '1');
INSERT INTO `xjy_recharge_record` VALUES ('8', '10', '55', '1527751861', '81108.00', '10000.00', '10', '0', '1');
INSERT INTO `xjy_recharge_record` VALUES ('9', '10', '22', '1528098297', '0.00', '40000.00', '10', '1', '2');
INSERT INTO `xjy_recharge_record` VALUES ('10', '10', '22', '1528139670', '0.00', '41242.00', '10', '4', '1');
INSERT INTO `xjy_recharge_record` VALUES ('11', '10', '21', '1528189675', '0.00', '5000.00', '10', '5', '1');
INSERT INTO `xjy_recharge_record` VALUES ('12', '10', '55', '1528700755', '0.00', '17777.00', '10', '6', '1');
INSERT INTO `xjy_recharge_record` VALUES ('13', '10', '40', '1528701446', '0.00', '17777.00', '10', '7', '1');
INSERT INTO `xjy_recharge_record` VALUES ('14', '10', '40', '1528701476', '0.00', '17777.00', '10', '8', '1');
INSERT INTO `xjy_recharge_record` VALUES ('15', '10', '94', '1529828904', '0.00', '5000.00', '10', '9', '1');
INSERT INTO `xjy_recharge_record` VALUES ('16', '10', '94', '1529828940', '5000.00', '2777.00', '10', '9', '1');
INSERT INTO `xjy_recharge_record` VALUES ('17', '98', '102', '1529925364', '0.00', '1377.00', '10', '11', '1');
INSERT INTO `xjy_recharge_record` VALUES ('18', '97', '43', '1529994056', '0.00', '1377.00', '10', '12', '1');
INSERT INTO `xjy_recharge_record` VALUES ('19', '97', '54', '1529994131', '0.00', '1377.00', '10', '13', '1');
INSERT INTO `xjy_recharge_record` VALUES ('20', '97', '37', '1529994689', '0.00', '1377.00', '10', '14', '1');
INSERT INTO `xjy_recharge_record` VALUES ('21', '98', '117', '1530071188', '0.00', '7777.00', '10', '15', '1');

-- ----------------------------
-- Table structure for xjy_recycle_bin
-- ----------------------------
DROP TABLE IF EXISTS `xjy_recycle_bin`;
CREATE TABLE `xjy_recycle_bin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT '0' COMMENT '删除内容 id',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `table_name` varchar(60) DEFAULT '' COMMENT '删除内容所在表名',
  `name` varchar(255) DEFAULT '' COMMENT '删除内容名称',
  `uid` bigint(20) unsigned NOT NULL COMMENT '删除者ID，对应user表',
  `seller_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '商家id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=932 DEFAULT CHARSET=utf8 COMMENT=' 回收站';

-- ----------------------------
-- Records of xjy_recycle_bin
-- ----------------------------
INSERT INTO `xjy_recycle_bin` VALUES ('4', '4', '1510310482', 'order', '订单信息', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('5', '4', '1510310603', 'order', '订单信息', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('7', '3', '1510310967', 'order', '订单信息', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('9', '24', '1510311474', 'seller_menu', '菜单信息', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('10', '17', '1510314486', 'seller_menu', '菜单信息', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('11', '17', '1510314570', 'seller_menu', '菜单信息', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('12', '17', '1510314720', 'seller_menu', '菜单信息', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('13', '8', '1510383319', 'user_address', '收货地址', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('14', '9', '1510383490', 'user_address', '收货地址', '0', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('16', '1', '1527238033', 'rest', '餐桌信息', '10', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('44', '8', '1527760094', 'traffic', '采购信息', '10', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('45', '7', '1527760100', 'traffic', '采购信息', '10', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('46', '192', '1527842164', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('47', '191', '1527842165', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('48', '190', '1527842181', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('49', '195', '1527842201', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('50', '196', '1527842211', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('51', '197', '1527842218', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('52', '198', '1527842225', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('53', '217', '1527842290', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('54', '216', '1527842300', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('55', '215', '1527842316', 'rest', '餐桌信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('56', '49', '1527842644', 'seller_menu', '菜单信息', '32', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('57', '43', '1528351986', 'seller_menu', '菜单信息', '10', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('58', '88', '1528705322', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('59', '69', '1528705329', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('60', '86', '1528705380', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('61', '68', '1528705387', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('62', '87', '1528705392', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('63', '18', '1528705398', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('64', '11', '1528705404', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('65', '20', '1528705410', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('66', '67', '1528705415', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('67', '10', '1528705421', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('68', '12', '1528705426', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('69', '12', '1528705427', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('70', '0', '1528705430', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('71', '15', '1528705432', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('72', '12', '1528705434', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('73', '66', '1528705438', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('74', '0', '1528705438', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('75', '12', '1528705442', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('76', '89', '1528705444', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('77', '0', '1528705446', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('78', '12', '1528705450', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('79', '70', '1528705454', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('80', '0', '1528705454', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('81', '12', '1528705458', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('82', '71', '1528705461', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('83', '0', '1528705462', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('84', '72', '1528705465', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('85', '12', '1528705466', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('86', '0', '1528705470', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('87', '73', '1528705472', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('88', '12', '1528705474', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('89', '74', '1528705477', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('90', '0', '1528705478', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('91', '12', '1528705482', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('92', '77', '1528705482', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('93', '0', '1528705486', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('94', '75', '1528705486', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('95', '12', '1528705490', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('96', '76', '1528705491', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('97', '0', '1528705494', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('98', '78', '1528705496', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('99', '12', '1528705498', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('100', '79', '1528705501', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('101', '0', '1528705502', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('102', '12', '1528705506', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('103', '80', '1528705507', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('104', '0', '1528705510', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('105', '81', '1528705511', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('106', '12', '1528705514', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('107', '82', '1528705517', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('108', '0', '1528705518', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('109', '12', '1528705522', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('110', '83', '1528705522', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('111', '0', '1528705526', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('112', '64', '1528705528', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('113', '84', '1528705528', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('114', '12', '1528705530', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('115', '85', '1528705534', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('116', '0', '1528705534', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('117', '12', '1528705538', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('118', '0', '1528705542', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('119', '12', '1528705546', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('120', '0', '1528705550', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('121', '12', '1528705554', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('122', '0', '1528705558', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('123', '12', '1528705562', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('124', '0', '1528705566', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('125', '12', '1528705570', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('126', '0', '1528705574', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('127', '12', '1528705578', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('128', '0', '1528705582', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('129', '12', '1528705586', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('130', '0', '1528705590', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('131', '12', '1528705594', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('132', '0', '1528705598', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('133', '12', '1528705602', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('134', '0', '1528705606', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('135', '12', '1528705610', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('136', '0', '1528705614', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('137', '12', '1528705618', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('138', '0', '1528705622', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('139', '12', '1528705626', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('140', '0', '1528705630', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('141', '12', '1528705634', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('142', '0', '1528705638', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('143', '12', '1528705642', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('144', '0', '1528705646', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('145', '12', '1528705650', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('146', '0', '1528705654', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('147', '12', '1528705658', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('148', '0', '1528705662', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('149', '12', '1528705666', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('150', '0', '1528705670', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('151', '12', '1528705674', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('152', '0', '1528705678', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('153', '12', '1528705682', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('154', '0', '1528705686', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('155', '12', '1528705690', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('156', '0', '1528705694', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('157', '12', '1528705698', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('158', '0', '1528705702', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('159', '12', '1528705706', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('160', '0', '1528705710', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('161', '12', '1528705714', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('162', '92', '1528705716', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('163', '0', '1528705718', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('164', '12', '1528705722', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('165', '91', '1528705722', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('166', '0', '1528705726', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('167', '12', '1528705730', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('168', '0', '1528705734', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('169', '12', '1528705738', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('170', '0', '1528705742', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('171', '12', '1528705746', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('172', '0', '1528705750', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('173', '12', '1528705754', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('174', '0', '1528705758', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('175', '12', '1528705762', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('176', '0', '1528705766', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('177', '12', '1528705770', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('178', '0', '1528705774', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('179', '12', '1528705778', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('180', '0', '1528705782', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('181', '12', '1528705786', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('182', '0', '1528705790', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('183', '12', '1528705794', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('184', '0', '1528705799', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('185', '12', '1528705803', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('186', '0', '1528705807', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('187', '12', '1528705811', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('188', '0', '1528705815', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('189', '12', '1528705819', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('190', '0', '1528705823', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('191', '12', '1528705827', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('192', '0', '1528705831', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('193', '12', '1528705835', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('194', '0', '1528705839', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('195', '12', '1528705843', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('196', '0', '1528705847', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('197', '12', '1528705856', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('198', '0', '1528705863', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('199', '12', '1528705867', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('200', '0', '1528705871', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('201', '12', '1528705875', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('202', '0', '1528705880', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('203', '12', '1528705884', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('204', '0', '1528705888', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('205', '12', '1528705892', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('206', '0', '1528705896', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('207', '12', '1528705900', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('208', '0', '1528705904', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('209', '98', '1528705905', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('210', '12', '1528705908', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('211', '0', '1528705912', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('212', '12', '1528705916', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('213', '0', '1528705921', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('214', '12', '1528705925', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('215', '0', '1528705929', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('216', '12', '1528705933', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('217', '0', '1528705937', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('218', '12', '1528705941', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('219', '0', '1528705947', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('220', '12', '1528705952', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('221', '0', '1528705956', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('222', '12', '1528705960', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('223', '0', '1528705964', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('224', '12', '1528705968', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('225', '0', '1528705972', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('226', '12', '1528705976', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('227', '0', '1528705981', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('228', '12', '1528705985', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('229', '0', '1528705989', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('230', '12', '1528705993', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('231', '0', '1528705997', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('232', '12', '1528706001', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('233', '0', '1528706005', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('234', '12', '1528706009', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('235', '0', '1528706013', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('236', '12', '1528706017', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('237', '0', '1528706021', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('238', '12', '1528706025', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('239', '0', '1528706029', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('240', '12', '1528706033', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('241', '0', '1528706037', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('242', '12', '1528706041', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('243', '0', '1528706045', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('244', '12', '1528706049', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('245', '0', '1528706053', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('246', '12', '1528706057', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('247', '0', '1528706061', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('248', '12', '1528706065', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('249', '0', '1528706069', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('250', '12', '1528706073', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('251', '0', '1528706077', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('252', '12', '1528706081', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('253', '0', '1528706085', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('254', '12', '1528706089', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('255', '0', '1528706093', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('256', '12', '1528706097', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('257', '0', '1528706101', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('258', '12', '1528706105', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('259', '0', '1528706109', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('260', '12', '1528706113', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('261', '0', '1528706117', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('262', '12', '1528706121', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('263', '0', '1528706125', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('264', '12', '1528706129', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('265', '104', '1528706133', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('266', '0', '1528706134', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('267', '12', '1528706138', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('268', '105', '1528706140', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('269', '0', '1528706142', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('270', '12', '1528706146', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('271', '0', '1528706150', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('272', '12', '1528706154', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('273', '0', '1528706158', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('274', '12', '1528706162', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('275', '0', '1528706166', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('276', '12', '1528706170', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('277', '0', '1528706174', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('278', '12', '1528706178', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('279', '0', '1528706182', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('280', '12', '1528706186', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('281', '0', '1528706198', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('282', '12', '1528706202', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('283', '0', '1528706207', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('284', '12', '1528706211', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('285', '0', '1528706215', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('286', '12', '1528706219', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('287', '0', '1528706223', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('288', '12', '1528706227', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('289', '0', '1528706231', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('290', '12', '1528706235', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('291', '0', '1528706239', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('292', '12', '1528706243', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('293', '0', '1528706247', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('294', '12', '1528706251', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('295', '0', '1528706255', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('296', '12', '1528706259', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('297', '0', '1528706263', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('298', '12', '1528706267', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('299', '0', '1528706271', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('300', '12', '1528706275', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('301', '0', '1528706279', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('302', '12', '1528706283', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('303', '0', '1528706287', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('304', '12', '1528706291', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('305', '0', '1528706296', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('306', '12', '1528706300', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('307', '0', '1528706304', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('308', '12', '1528706308', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('309', '0', '1528706312', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('310', '12', '1528706316', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('311', '0', '1528706320', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('312', '12', '1528706324', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('313', '0', '1528706328', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('314', '12', '1528706332', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('315', '0', '1528706336', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('316', '12', '1528706340', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('317', '0', '1528706344', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('318', '12', '1528706348', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('319', '0', '1528706352', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('320', '12', '1528706356', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('321', '0', '1528706360', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('322', '12', '1528706364', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('323', '0', '1528706368', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('324', '12', '1528706372', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('325', '0', '1528706376', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('326', '12', '1528706380', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('327', '0', '1528706384', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('328', '12', '1528706388', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('329', '0', '1528706392', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('330', '12', '1528706396', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('331', '0', '1528706400', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('332', '12', '1528706404', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('333', '0', '1528706409', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('334', '12', '1528706413', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('335', '0', '1528706417', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('336', '12', '1528706421', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('337', '0', '1528706425', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('338', '12', '1528706429', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('339', '0', '1528706433', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('340', '12', '1528706438', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('341', '0', '1528706442', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('342', '12', '1528706446', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('343', '0', '1528706450', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('344', '12', '1528706454', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('345', '0', '1528706458', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('346', '12', '1528706462', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('347', '0', '1528706466', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('348', '12', '1528706470', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('349', '0', '1528706474', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('350', '12', '1528706478', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('351', '0', '1528706482', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('352', '12', '1528706486', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('353', '0', '1528706490', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('354', '12', '1528706494', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('355', '0', '1528706498', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('356', '12', '1528706503', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('357', '0', '1528706507', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('358', '12', '1528706511', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('359', '0', '1528706515', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('360', '12', '1528706519', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('361', '0', '1528706523', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('362', '12', '1528706527', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('363', '0', '1528706531', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('364', '12', '1528706535', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('365', '0', '1528706539', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('366', '12', '1528706543', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('367', '0', '1528706547', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('368', '12', '1528706551', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('369', '0', '1528706555', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('370', '12', '1528706559', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('371', '0', '1528706563', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('372', '12', '1528706567', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('373', '0', '1528706571', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('374', '12', '1528706575', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('375', '0', '1528706579', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('376', '12', '1528706583', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('377', '0', '1528706587', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('378', '12', '1528706591', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('379', '0', '1528706595', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('380', '12', '1528706599', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('381', '0', '1528706603', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('382', '12', '1528706607', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('383', '0', '1528706611', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('384', '12', '1528706615', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('385', '0', '1528706619', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('386', '12', '1528706623', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('387', '0', '1528706627', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('388', '12', '1528706631', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('389', '0', '1528706635', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('390', '12', '1528706639', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('391', '0', '1528706643', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('392', '12', '1528706647', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('393', '0', '1528706651', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('394', '12', '1528706655', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('395', '0', '1528706659', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('396', '12', '1528706663', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('397', '0', '1528706667', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('398', '12', '1528706671', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('399', '0', '1528706675', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('400', '12', '1528706679', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('401', '0', '1528706684', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('402', '12', '1528706688', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('403', '0', '1528706692', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('404', '12', '1528706696', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('405', '0', '1528706700', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('406', '12', '1528706704', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('407', '0', '1528706708', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('408', '12', '1528706712', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('409', '0', '1528706716', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('410', '12', '1528706720', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('411', '0', '1528706724', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('412', '12', '1528706728', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('413', '0', '1528706732', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('414', '12', '1528706736', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('415', '0', '1528706740', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('416', '12', '1528706744', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('417', '0', '1528706748', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('418', '12', '1528706752', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('419', '0', '1528706756', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('420', '12', '1528706760', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('421', '0', '1528706764', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('422', '12', '1528706768', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('423', '0', '1528706772', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('424', '12', '1528706776', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('425', '0', '1528706780', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('426', '12', '1528706784', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('427', '0', '1528706788', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('428', '12', '1528706792', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('429', '0', '1528706796', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('430', '12', '1528706800', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('431', '0', '1528706804', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('432', '12', '1528706808', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('433', '0', '1528706812', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('434', '12', '1528706816', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('435', '0', '1528706820', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('436', '12', '1528706824', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('437', '0', '1528706829', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('438', '12', '1528706834', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('439', '0', '1528706839', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('440', '12', '1528706846', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('441', '0', '1528706850', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('442', '12', '1528706854', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('443', '0', '1528706858', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('444', '12', '1528706862', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('445', '0', '1528706866', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('446', '12', '1528706870', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('447', '0', '1528706874', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('448', '12', '1528706878', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('449', '0', '1528706883', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('450', '12', '1528706887', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('451', '0', '1528706891', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('452', '12', '1528706895', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('453', '0', '1528706899', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('454', '12', '1528706903', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('455', '0', '1528706907', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('456', '12', '1528706911', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('457', '0', '1528706915', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('458', '12', '1528706919', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('459', '0', '1528706923', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('460', '12', '1528706927', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('461', '0', '1528706931', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('462', '12', '1528706935', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('463', '0', '1528706939', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('464', '12', '1528706943', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('465', '0', '1528706947', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('466', '12', '1528706951', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('467', '0', '1528706956', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('468', '12', '1528706960', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('469', '0', '1528706964', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('470', '12', '1528706968', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('471', '0', '1528706972', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('472', '12', '1528706976', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('473', '0', '1528706981', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('474', '12', '1528706985', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('475', '0', '1528706989', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('476', '12', '1528706993', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('477', '0', '1528706997', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('478', '12', '1528707001', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('479', '0', '1528707005', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('480', '12', '1528707009', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('481', '0', '1528707013', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('482', '12', '1528707017', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('483', '0', '1528707021', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('484', '12', '1528707025', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('485', '0', '1528707029', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('486', '12', '1528707033', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('487', '0', '1528707037', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('488', '12', '1528707041', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('489', '0', '1528707045', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('490', '12', '1528707050', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('491', '0', '1528707076', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('492', '12', '1528707089', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('493', '0', '1528707093', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('494', '12', '1528707097', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('495', '0', '1528707101', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('496', '12', '1528707105', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('497', '0', '1528707110', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('498', '12', '1528707114', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('499', '0', '1528707118', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('500', '12', '1528707122', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('501', '0', '1528707126', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('502', '12', '1528707130', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('503', '0', '1528707134', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('504', '12', '1528707139', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('505', '0', '1528707143', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('506', '12', '1528707147', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('507', '0', '1528707154', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('508', '12', '1528707158', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('509', '0', '1528707162', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('510', '12', '1528707166', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('511', '0', '1528707170', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('512', '12', '1528707174', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('513', '0', '1528707178', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('514', '12', '1528707182', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('515', '0', '1528707186', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('516', '12', '1528707190', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('517', '0', '1528707194', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('518', '12', '1528707198', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('519', '0', '1528707202', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('520', '12', '1528707206', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('521', '0', '1528707210', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('522', '12', '1528707214', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('523', '0', '1528707218', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('524', '12', '1528707222', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('525', '0', '1528707226', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('526', '12', '1528707230', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('527', '0', '1528707236', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('528', '12', '1528707240', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('529', '0', '1528707245', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('530', '12', '1528707249', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('531', '0', '1528707253', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('532', '12', '1528707257', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('533', '0', '1528707267', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('534', '12', '1528707271', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('535', '0', '1528707276', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('536', '12', '1528707280', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('537', '0', '1528707284', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('538', '12', '1528707291', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('539', '0', '1528707298', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('540', '12', '1528707301', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('541', '0', '1528707305', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('542', '12', '1528707309', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('543', '0', '1528707314', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('544', '12', '1528707338', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('545', '0', '1528707342', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('546', '12', '1528707346', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('547', '0', '1528707350', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('548', '12', '1528707354', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('549', '0', '1528707358', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('550', '12', '1528707362', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('551', '0', '1528707374', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('552', '12', '1528707531', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('553', '135', '1528707532', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('554', '0', '1528707535', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('555', '12', '1528707539', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('556', '0', '1528707543', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('557', '12', '1528707547', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('558', '0', '1528707551', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('559', '12', '1528707555', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('560', '0', '1528707559', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('561', '12', '1528707563', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('562', '0', '1528707567', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('563', '12', '1528707571', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('564', '0', '1528707575', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('565', '12', '1528707579', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('566', '0', '1528707583', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('567', '12', '1528707587', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('568', '0', '1528707591', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('569', '12', '1528707595', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('570', '0', '1528707599', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('571', '12', '1528707603', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('572', '0', '1528707607', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('573', '12', '1528707611', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('574', '0', '1528707615', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('575', '12', '1528707619', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('576', '0', '1528707623', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('577', '12', '1528707628', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('578', '0', '1528707632', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('579', '12', '1528707636', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('580', '0', '1528707640', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('581', '12', '1528707644', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('582', '0', '1528707648', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('583', '12', '1528707652', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('584', '0', '1528707656', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('585', '12', '1528707660', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('586', '0', '1528707667', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('587', '12', '1528707672', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('588', '0', '1528707676', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('589', '12', '1528707680', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('590', '0', '1528707684', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('591', '12', '1528707688', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('592', '0', '1528707692', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('593', '12', '1528707696', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('594', '0', '1528707700', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('595', '12', '1528707704', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('596', '0', '1528707708', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('597', '12', '1528707712', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('598', '0', '1528707716', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('599', '12', '1528707720', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('600', '0', '1528707724', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('601', '12', '1528707728', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('602', '0', '1528707732', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('603', '12', '1528707736', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('604', '0', '1528707740', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('605', '12', '1528707744', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('606', '0', '1528707748', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('607', '12', '1528707752', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('608', '0', '1528707756', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('609', '12', '1528707761', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('610', '0', '1528707765', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('611', '12', '1528707769', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('612', '0', '1528707773', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('613', '12', '1528707777', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('614', '0', '1528707781', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('615', '12', '1528707785', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('616', '0', '1528707789', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('617', '12', '1528707793', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('618', '0', '1528707797', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('619', '12', '1528707802', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('620', '0', '1528707807', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('621', '12', '1528707812', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('622', '0', '1528707819', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('623', '12', '1528707823', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('624', '0', '1528707827', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('625', '12', '1528707832', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('626', '0', '1528707836', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('627', '12', '1528707840', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('628', '0', '1528707845', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('629', '12', '1528707849', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('630', '0', '1528707853', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('631', '12', '1528707857', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('632', '0', '1528707861', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('633', '12', '1528707865', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('634', '0', '1528707870', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('635', '12', '1528707874', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('636', '0', '1528707878', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('637', '12', '1528707882', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('638', '0', '1528707886', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('639', '12', '1528707892', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('640', '0', '1528707902', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('641', '12', '1528707906', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('642', '0', '1528707910', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('643', '12', '1528707914', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('644', '0', '1528707918', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('645', '12', '1528707922', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('646', '0', '1528707926', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('647', '12', '1528707930', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('648', '0', '1528707934', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('649', '12', '1528707940', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('650', '0', '1528707944', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('651', '12', '1528707948', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('652', '0', '1528707953', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('653', '12', '1528707958', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('654', '0', '1528707962', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('655', '12', '1528707966', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('656', '0', '1528707971', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('657', '12', '1528707975', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('658', '0', '1528707979', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('659', '12', '1528707983', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('660', '0', '1528707987', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('661', '12', '1528707991', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('662', '0', '1528707995', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('663', '12', '1528708000', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('664', '0', '1528708004', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('665', '12', '1528708008', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('666', '0', '1528708012', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('667', '12', '1528708022', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('668', '0', '1528708026', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('669', '12', '1528708030', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('670', '0', '1528708034', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('671', '12', '1528708038', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('672', '0', '1528708042', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('673', '12', '1528708046', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('674', '0', '1528708050', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('675', '12', '1528708054', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('676', '0', '1528708058', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('677', '12', '1528708062', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('678', '0', '1528708066', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('679', '12', '1528708070', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('680', '0', '1528708074', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('681', '12', '1528708078', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('682', '0', '1528708082', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('683', '12', '1528708086', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('684', '0', '1528708090', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('685', '12', '1528708094', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('686', '0', '1528708098', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('687', '12', '1528708102', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('688', '0', '1528708106', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('689', '12', '1528708110', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('690', '0', '1528708114', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('691', '12', '1528708118', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('692', '0', '1528708122', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('693', '12', '1528708126', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('694', '0', '1528708130', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('695', '12', '1528708134', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('696', '0', '1528708138', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('697', '12', '1528708142', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('698', '0', '1528708146', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('699', '12', '1528708150', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('700', '0', '1528708154', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('701', '12', '1528708158', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('702', '0', '1528708162', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('703', '12', '1528708166', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('704', '0', '1528708170', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('705', '12', '1528708174', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('706', '0', '1528708178', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('707', '12', '1528708182', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('708', '0', '1528708186', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('709', '12', '1528708190', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('710', '0', '1528708194', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('711', '12', '1528708198', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('712', '0', '1528708202', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('713', '12', '1528708206', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('714', '0', '1528708210', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('715', '12', '1528708214', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('716', '0', '1528708218', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('717', '12', '1528708222', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('718', '0', '1528708226', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('719', '12', '1528708230', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('720', '0', '1528708234', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('721', '12', '1528708238', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('722', '0', '1528708242', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('723', '12', '1528708246', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('724', '0', '1528708250', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('725', '12', '1528708254', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('726', '0', '1528708258', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('727', '12', '1528708262', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('728', '0', '1528708266', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('729', '12', '1528708270', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('730', '0', '1528708274', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('731', '12', '1528708278', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('732', '0', '1528708282', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('733', '12', '1528708286', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('734', '0', '1528708290', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('735', '12', '1528708294', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('736', '0', '1528708298', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('737', '12', '1528708302', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('738', '0', '1528708307', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('739', '12', '1528708311', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('740', '0', '1528708315', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('741', '12', '1528708319', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('742', '0', '1528708323', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('743', '12', '1528708327', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('744', '0', '1528708331', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('745', '12', '1528708335', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('746', '0', '1528708339', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('747', '12', '1528708343', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('748', '0', '1528708347', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('749', '12', '1528708351', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('750', '0', '1528708356', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('751', '12', '1528708360', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('752', '0', '1528708364', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('753', '12', '1528708369', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('754', '0', '1528708373', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('755', '12', '1528708377', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('756', '0', '1528708381', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('757', '12', '1528708385', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('758', '0', '1528708389', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('759', '12', '1528708393', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('760', '0', '1528708397', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('761', '12', '1528708401', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('762', '0', '1528708405', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('763', '12', '1528708409', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('764', '0', '1528708413', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('765', '12', '1528708417', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('766', '0', '1528708421', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('767', '12', '1528708425', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('768', '0', '1528708429', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('769', '12', '1528708433', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('770', '0', '1528708437', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('771', '12', '1528708441', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('772', '0', '1528708445', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('773', '12', '1528708449', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('774', '0', '1528708453', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('775', '12', '1528708457', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('776', '0', '1528708461', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('777', '12', '1528708465', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('778', '0', '1528708469', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('779', '12', '1528708473', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('780', '0', '1528708477', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('781', '12', '1528708481', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('782', '0', '1528708485', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('783', '12', '1528708489', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('784', '0', '1528708493', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('785', '12', '1528708497', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('786', '0', '1528708501', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('787', '12', '1528708505', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('788', '0', '1528708509', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('789', '12', '1528708514', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('790', '0', '1528708518', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('791', '12', '1528708522', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('792', '0', '1528708526', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('793', '12', '1528708530', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('794', '0', '1528708534', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('795', '12', '1528708538', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('796', '0', '1528708542', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('797', '12', '1528708546', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('798', '0', '1528708550', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('799', '12', '1528708554', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('800', '0', '1528708558', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('801', '12', '1528708562', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('802', '0', '1528708566', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('803', '12', '1528708570', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('804', '0', '1528708574', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('805', '12', '1528708578', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('806', '164', '1528708580', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('807', '0', '1528708582', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('808', '12', '1528708586', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('809', '0', '1528708590', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('810', '12', '1528708594', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('811', '0', '1528708598', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('812', '12', '1528708602', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('813', '0', '1528708606', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('814', '12', '1528708610', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('815', '0', '1528708614', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('816', '12', '1528708618', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('817', '0', '1528708622', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('818', '12', '1528708626', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('819', '0', '1528708630', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('820', '12', '1528708634', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('821', '0', '1528708638', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('822', '12', '1528708642', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('823', '0', '1528708646', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('824', '12', '1528708650', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('825', '0', '1528708654', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('826', '12', '1528708658', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('827', '0', '1528708662', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('828', '12', '1528708666', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('829', '0', '1528708670', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('830', '12', '1528708674', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('831', '0', '1528708678', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('832', '12', '1528708682', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('833', '0', '1528708686', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('834', '12', '1528708690', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('835', '0', '1528708694', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('836', '12', '1528708698', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('837', '0', '1528708702', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('838', '12', '1528708708', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('839', '0', '1528708712', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('840', '12', '1528708720', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('841', '0', '1528708738', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('842', '12', '1528708742', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('843', '58', '1528709851', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('844', '33', '1528710517', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('845', '59', '1528710874', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('846', '192', '1528710999', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('847', '60', '1528788092', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('848', '50', '1528788104', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('849', '62', '1528788114', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('850', '63', '1528788120', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('851', '274', '1528792688', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('852', '366', '1528794497', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('860', '429', '1528860435', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('861', '133', '1528863620', 'rest', '餐桌信息', '10', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('862', '137', '1528863626', 'rest', '餐桌信息', '10', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('863', '136', '1528863632', 'rest', '餐桌信息', '10', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('864', '583', '1528965367', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('865', '598', '1528965390', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('866', '643', '1528967175', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('867', '419', '1528967735', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('868', '421', '1528967743', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('869', '420', '1528967751', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('870', '382', '1528967764', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('871', '422', '1528967773', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('872', '423', '1528967780', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('873', '426', '1528967788', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('874', '427', '1528967794', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('875', '428', '1528967803', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('876', '424', '1528967810', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('877', '425', '1528967816', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('878', '434', '1528967832', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('879', '436', '1528967838', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('880', '438', '1528967843', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('881', '672', '1528967876', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('882', '443', '1528967943', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('883', '444', '1528967952', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('884', '441', '1528967959', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('885', '445', '1528967968', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('886', '446', '1528967977', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('887', '61', '1529986135', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('888', '57', '1529986576', 'seller_menu', '菜单信息', '34', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('889', '209', '1529987066', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('890', '388', '1530009002', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('891', '390', '1530009008', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('892', '393', '1530009014', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('893', '395', '1530009020', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('894', '397', '1530009025', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('895', '399', '1530009032', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('896', '401', '1530009037', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('897', '404', '1530009043', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('898', '406', '1530009049', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('899', '408', '1530009056', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('900', '409', '1530009063', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('901', '410', '1530009072', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('902', '411', '1530009078', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('903', '413', '1530009082', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('904', '415', '1530009094', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('905', '417', '1530009106', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('906', '418', '1530009114', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('907', '385', '1530009128', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('908', '742', '1530009162', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('909', '587', '1530010133', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('910', '613', '1530010150', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('911', '331', '1530010443', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('912', '333', '1530010449', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('913', '336', '1530010461', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('914', '338', '1530010466', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('915', '340', '1530010473', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('916', '341', '1530010481', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('917', '345', '1530010487', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('918', '348', '1530010494', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('919', '350', '1530010499', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('920', '351', '1530010505', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('921', '342', '1530010509', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('922', '343', '1530010513', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('923', '353', '1530010518', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('924', '356', '1530010524', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('925', '358', '1530010529', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('926', '360', '1530010536', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('927', '362', '1530010541', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('928', '364', '1530010546', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('929', '367', '1530010551', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('930', '379', '1530011262', 'seller_menu', '菜单信息', '98', '10');
INSERT INTO `xjy_recycle_bin` VALUES ('931', '741', '1530011662', 'seller_menu', '菜单信息', '98', '10');

-- ----------------------------
-- Table structure for xjy_rest
-- ----------------------------
DROP TABLE IF EXISTS `xjy_rest`;
CREATE TABLE `xjy_rest` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `table_id` bigint(20) unsigned NOT NULL COMMENT '关联餐桌类型的id',
  `tb_id` bigint(20) unsigned NOT NULL COMMENT '当前厅的座号',
  `menu_id` bigint(20) unsigned NOT NULL COMMENT '服务厅id',
  `seller_id` bigint(20) unsigned NOT NULL COMMENT '商家id',
  `delete_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态',
  `type` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '餐桌状态 1:空闲;2:待确认;3:使用中;4:已经预定;5:停止使用;',
  `order_id` varchar(30) DEFAULT NULL COMMENT '订单ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8 COMMENT='对应服务厅，对应餐桌类型，下面排练的餐桌号码';

-- ----------------------------
-- Records of xjy_rest
-- ----------------------------
INSERT INTO `xjy_rest` VALUES ('1', '1', '1', '179', '10', '0', '1', '2018062822594099555257');
INSERT INTO `xjy_rest` VALUES ('2', '1', '2', '179', '10', '0', '1', '2018062823014910098519');
INSERT INTO `xjy_rest` VALUES ('3', '1', '3', '179', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('4', '1', '13', '179', '10', '0', '1', '2018062719485998985549');
INSERT INTO `xjy_rest` VALUES ('5', '1', '5', '179', '10', '0', '1', '2018062719535450499798');
INSERT INTO `xjy_rest` VALUES ('6', '2', '6', '179', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('7', '2', '7', '179', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('8', '2', '8', '179', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('9', '2', '9', '179', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('10', '2', '10', '179', '10', '0', '1', '2018062718465648489855');
INSERT INTO `xjy_rest` VALUES ('11', '2', '11', '179', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('12', '2', '12', '179', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('17', '7', '1', '198', '10', '0', '3', '2018062823280149999750');
INSERT INTO `xjy_rest` VALUES ('18', '7', '2', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('19', '7', '3', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('20', '9', '9', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('21', '8', '5', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('22', '8', '6', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('23', '8', '7', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('24', '8', '8', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('25', '9', '10', '198', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('26', '9', '11', '198', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('27', '9', '12', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('28', '9', '13', '198', '10', '0', '1', '2018062718434110010248');
INSERT INTO `xjy_rest` VALUES ('29', '9', '17', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('30', '9', '15', '198', '10', '0', '1', '2018062718585510298971');
INSERT INTO `xjy_rest` VALUES ('31', '9', '16', '198', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('32', '10', '1', '195', '10', '0', '1', '2018062820544755555510');
INSERT INTO `xjy_rest` VALUES ('33', '10', '2', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('34', '10', '3', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('35', '10', '21', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('36', '10', '5', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('37', '10', '6', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('38', '11', '7', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('39', '11', '8', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('40', '12', '9', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('41', '12', '10', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('42', '12', '11', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('43', '12', '12', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('44', '12', '13', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('45', '12', '22', '195', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('46', '12', '15', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('47', '12', '16', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('48', '12', '17', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('49', '12', '18', '195', '10', '0', '1', '2018062718282254525655');
INSERT INTO `xjy_rest` VALUES ('50', '13', '1', '184', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('51', '13', '2', '184', '10', '0', '1', '2018062719041510249541');
INSERT INTO `xjy_rest` VALUES ('52', '13', '3', '184', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('53', '14', '8', '184', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('54', '14', '5', '184', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('55', '15', '6', '184', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('56', '15', '7', '184', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('57', '16', '1', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('58', '16', '2', '180', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('59', '16', '3', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('60', '16', '12', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('61', '16', '5', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('62', '16', '6', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('63', '17', '7', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('64', '17', '8', '180', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('65', '17', '9', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('66', '18', '1', '203', '10', '0', '1', '2018062717134910010156');
INSERT INTO `xjy_rest` VALUES ('67', '18', '2', '203', '10', '0', '1', '2018062717231551559749');
INSERT INTO `xjy_rest` VALUES ('68', '18', '3', '203', '10', '0', '1', '2018062712164710210054');
INSERT INTO `xjy_rest` VALUES ('69', '18', '9', '203', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('70', '18', '5', '203', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('71', '18', '6', '203', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('72', '18', '7', '203', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('73', '18', '8', '203', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('74', '19', '1', '204', '10', '0', '1', '2018062718404610149514');
INSERT INTO `xjy_rest` VALUES ('75', '19', '2', '204', '10', '0', '1', '2018062712271010148529');
INSERT INTO `xjy_rest` VALUES ('76', '19', '3', '204', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('77', '19', '8', '204', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('78', '20', '1', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('79', '20', '2', '207', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('80', '20', '3', '207', '10', '0', '1', '2018062713251810154489');
INSERT INTO `xjy_rest` VALUES ('81', '20', '18', '207', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('82', '20', '5', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('83', '20', '6', '207', '10', '0', '1', '2018062822150798984954');
INSERT INTO `xjy_rest` VALUES ('84', '20', '7', '207', '10', '0', '1', '2018062714093510257545');
INSERT INTO `xjy_rest` VALUES ('85', '20', '8', '207', '10', '0', '1', '2018062713011598571005');
INSERT INTO `xjy_rest` VALUES ('86', '20', '9', '207', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('87', '20', '10', '207', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('88', '21', '16', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('89', '21', '17', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('90', '24', '1', '200', '10', '0', '1', '2018062821515497975550');
INSERT INTO `xjy_rest` VALUES ('91', '24', '2', '200', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('92', '24', '3', '200', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('93', '24', '25', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('94', '24', '5', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('95', '24', '6', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('96', '24', '7', '200', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('97', '23', '8', '200', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('98', '23', '9', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('99', '24', '10', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('100', '24', '11', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('101', '24', '12', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('102', '24', '13', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('103', '24', '26', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('104', '24', '15', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('105', '24', '16', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('106', '25', '17', '200', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('107', '25', '18', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('108', '25', '19', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('109', '25', '20', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('110', '25', '21', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('111', '25', '22', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('117', '19', '5', '204', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('118', '19', '6', '204', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('119', '19', '7', '204', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('120', '31', '1', '205', '10', '0', '1', '2018062822575551555749');
INSERT INTO `xjy_rest` VALUES ('121', '31', '2', '205', '10', '0', '1', '2018062713364610149489');
INSERT INTO `xjy_rest` VALUES ('122', '31', '3', '205', '10', '0', '1', '2018062712462953100975');
INSERT INTO `xjy_rest` VALUES ('123', '31', '5', '205', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('124', '32', '6', '205', '10', '0', '1', '2018062713030355975699');
INSERT INTO `xjy_rest` VALUES ('125', '32', '7', '205', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('126', '32', '8', '205', '10', '0', '1', '2018062713394549995110');
INSERT INTO `xjy_rest` VALUES ('127', '32', '9', '205', '10', '0', '1', '2018062718415753499798');
INSERT INTO `xjy_rest` VALUES ('128', '32', '10', '205', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('129', '32', '11', '205', '10', '0', '1', '2018062810185299565753');
INSERT INTO `xjy_rest` VALUES ('130', '32', '12', '205', '10', '0', '1', '2018062712222448100101');
INSERT INTO `xjy_rest` VALUES ('131', '32', '13', '205', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('132', '32', '15', '205', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('133', '21', '100', '207', '10', '1', '1', null);
INSERT INTO `xjy_rest` VALUES ('134', '21', '13', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('135', '21', '15', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('136', '21', '103', '207', '10', '1', '1', null);
INSERT INTO `xjy_rest` VALUES ('137', '21', '104', '207', '10', '1', '1', null);
INSERT INTO `xjy_rest` VALUES ('138', '20', '11', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('139', '20', '12', '207', '10', '0', '1', '2018062713504452495653');
INSERT INTO `xjy_rest` VALUES ('140', '33', '1', '206', '10', '0', '1', '2018062822371910297575');
INSERT INTO `xjy_rest` VALUES ('141', '19', '9', '204', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('142', '19', '10', '204', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('143', '18', '10', '203', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('144', '18', '11', '203', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('145', '25', '23', '200', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('146', '25', '27', '200', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('147', '11', '19', '195', '10', '0', '1', '2018062718523110253985');
INSERT INTO `xjy_rest` VALUES ('148', '11', '20', '195', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('149', '13', '9', '184', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('150', '13', '10', '184', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('151', '16', '10', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('152', '16', '11', '180', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('153', '2', '15', '179', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('154', '2', '16', '179', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('301', '3', '66', '179', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('302', '4', '77', '179', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('303', '5', '88', '179', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('304', '6', '99', '179', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('305', '26', '55', '207', '10', '0', '1', '2018062715351955544899');
INSERT INTO `xjy_rest` VALUES ('306', '27', '66', '207', '10', '0', '1', '');
INSERT INTO `xjy_rest` VALUES ('307', '28', '77', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('308', '29', '88', '207', '10', '0', '1', null);
INSERT INTO `xjy_rest` VALUES ('309', '30', '99', '207', '10', '0', '1', null);

-- ----------------------------
-- Table structure for xjy_role
-- ----------------------------
DROP TABLE IF EXISTS `xjy_role`;
CREATE TABLE `xjy_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父角色ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态;0:禁用;1:正常',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `list_order` float NOT NULL DEFAULT '0' COMMENT '排序',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parent_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of xjy_role
-- ----------------------------
INSERT INTO `xjy_role` VALUES ('1', '0', '1', '1329633709', '1329633709', '0', '超级管理员', '拥有网站最高管理员权限！');
INSERT INTO `xjy_role` VALUES ('2', '0', '1', '1329633709', '1329633709', '0', '普通管理员', '权限由最高管理员分配！');
INSERT INTO `xjy_role` VALUES ('3', '0', '1', '0', '0', '0', '商家', '使用商家');
INSERT INTO `xjy_role` VALUES ('4', '0', '1', '0', '0', '0', '管理员', '公司员工');
INSERT INTO `xjy_role` VALUES ('5', '0', '1', '0', '0', '0', '后厨', '');
INSERT INTO `xjy_role` VALUES ('6', '0', '1', '0', '0', '0', '收银员', '');
INSERT INTO `xjy_role` VALUES ('7', '0', '1', '0', '0', '0', '超市', '第三方超市');

-- ----------------------------
-- Table structure for xjy_role_user
-- ----------------------------
DROP TABLE IF EXISTS `xjy_role_user`;
CREATE TABLE `xjy_role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色 id',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='用户角色对应表';

-- ----------------------------
-- Records of xjy_role_user
-- ----------------------------
INSERT INTO `xjy_role_user` VALUES ('2', '3', '3');
INSERT INTO `xjy_role_user` VALUES ('3', '3', '4');
INSERT INTO `xjy_role_user` VALUES ('4', '3', '5');
INSERT INTO `xjy_role_user` VALUES ('5', '3', '6');
INSERT INTO `xjy_role_user` VALUES ('6', '3', '11');
INSERT INTO `xjy_role_user` VALUES ('7', '3', '12');
INSERT INTO `xjy_role_user` VALUES ('8', '3', '10');
INSERT INTO `xjy_role_user` VALUES ('9', '1', '13');
INSERT INTO `xjy_role_user` VALUES ('10', '3', '14');
INSERT INTO `xjy_role_user` VALUES ('11', '3', '15');
INSERT INTO `xjy_role_user` VALUES ('12', '3', '16');
INSERT INTO `xjy_role_user` VALUES ('13', '3', '17');
INSERT INTO `xjy_role_user` VALUES ('14', '4', '18');
INSERT INTO `xjy_role_user` VALUES ('15', '3', '19');
INSERT INTO `xjy_role_user` VALUES ('16', '6', '24');
INSERT INTO `xjy_role_user` VALUES ('17', '5', '25');
INSERT INTO `xjy_role_user` VALUES ('18', '6', '27');
INSERT INTO `xjy_role_user` VALUES ('19', '6', '28');
INSERT INTO `xjy_role_user` VALUES ('20', '5', '28');
INSERT INTO `xjy_role_user` VALUES ('21', '6', '29');
INSERT INTO `xjy_role_user` VALUES ('22', '2', '30');
INSERT INTO `xjy_role_user` VALUES ('23', '6', '31');
INSERT INTO `xjy_role_user` VALUES ('30', '5', '33');
INSERT INTO `xjy_role_user` VALUES ('36', '7', '35');
INSERT INTO `xjy_role_user` VALUES ('43', '6', '97');
INSERT INTO `xjy_role_user` VALUES ('44', '6', '32');
INSERT INTO `xjy_role_user` VALUES ('45', '5', '32');
INSERT INTO `xjy_role_user` VALUES ('46', '4', '32');
INSERT INTO `xjy_role_user` VALUES ('47', '6', '34');
INSERT INTO `xjy_role_user` VALUES ('48', '6', '98');
INSERT INTO `xjy_role_user` VALUES ('49', '6', '99');

-- ----------------------------
-- Table structure for xjy_route
-- ----------------------------
DROP TABLE IF EXISTS `xjy_route`;
CREATE TABLE `xjy_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '路由id',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态;1:启用,0:不启用',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'URL规则类型;1:用户自定义;2:别名添加',
  `full_url` varchar(255) NOT NULL DEFAULT '' COMMENT '完整url',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '实际显示的url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='url路由表';

-- ----------------------------
-- Records of xjy_route
-- ----------------------------
INSERT INTO `xjy_route` VALUES ('1', '5000', '1', '2', 'admin/Index/index', 'YunJiuMin$');
INSERT INTO `xjy_route` VALUES ('2', '5000', '1', '2', 'portal/List/index?id=1', 'vode');
INSERT INTO `xjy_route` VALUES ('3', '4999', '1', '2', 'portal/Article/index?cid=1', 'vode/:id');

-- ----------------------------
-- Table structure for xjy_seller
-- ----------------------------
DROP TABLE IF EXISTS `xjy_seller`;
CREATE TABLE `xjy_seller` (
  `id` bigint(20) unsigned NOT NULL COMMENT '用户user_id',
  `create_time` int(11) NOT NULL COMMENT '注册时间',
  `seller_status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '运营状态;0:禁用,1:正常,2:未验证',
  `seller_nickname` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商家名称',
  `seller_logo` varchar(255) NOT NULL DEFAULT '' COMMENT '商家LOGO',
  `seller_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '点餐类型 0:都支持;1:点餐;2:外卖',
  `seller_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商家所在地',
  `seller_tel` varchar(20) NOT NULL DEFAULT '' COMMENT '商家手机号',
  `seller_time_start` varchar(10) NOT NULL COMMENT '开始营业时间',
  `seller_time_end` varchar(10) NOT NULL COMMENT '商家营业结束时间',
  `seller_advert` varchar(255) NOT NULL DEFAULT '' COMMENT '商家广告 ；号分割',
  `seller_show` varchar(255) NOT NULL DEFAULT '' COMMENT '商家环境展示 ；号分割',
  `seller_lng` decimal(20,16) NOT NULL DEFAULT '0.0000000000000000' COMMENT '商家经度',
  `seller_lat` decimal(20,16) NOT NULL DEFAULT '0.0000000000000000' COMMENT '商家纬度',
  `takeout_max` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '外卖满多少起送',
  `table` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '接受预约餐桌数量',
  `table_max` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '满多少可以预定',
  `seller_introduce` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '商家信息介绍',
  `mch_id` varchar(255) NOT NULL DEFAULT '' COMMENT '微信支付商户号',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT 'API密钥',
  `secret` varchar(255) NOT NULL DEFAULT '' COMMENT 'AppSecret是APPID对应的接口密码，用于获取接口调用凭证时使用',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标记删除字段',
  `appid` varchar(255) NOT NULL DEFAULT '' COMMENT '商家小程序ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家信息表';

-- ----------------------------
-- Records of xjy_seller
-- ----------------------------
INSERT INTO `xjy_seller` VALUES ('1', '1510108511', '0', 'lsj', 'https://ss0.baidu.com/73x1bjeh1BF3odCf/it/u=2033816434,820626626&amp;fm=85&amp;s=D23E3CC4D6D9912E31101C790300C050', '2', 'lsj', '12345678912', '10:00', '22:00', 'admin/20171111/f3ebb95a4d8ecb2d3c520e29ef6fc2e7.png;', '', '104.0954589843750000', '30.6677424850361680', '0', '1', '0', 'lsj', '', '', '', '0', '');
INSERT INTO `xjy_seller` VALUES ('3', '1510256042', '1', '哔哩哔哩', 'https://ss0.baidu.com/73x1bjeh1BF3odCf/it/u=2033816434,820626626&amp;fm=85&amp;s=D23E3CC4D6D9912E31101C790300C050', '0', '23333', '15982265259', '10:00', '22:00', 'admin/20171111/f3ebb95a4d8ecb2d3c520e29ef6fc2e7.png;', '', '104.0713405609130900', '30.5420822848145480', '0', '5', '0', '哔哩哔哩', '', '', '', '0', '99665511');
INSERT INTO `xjy_seller` VALUES ('4', '1510113296', '1', 'lilili', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '1', 'lili', '12345678912', '10:00', '22:00', 'admin/20171111/f3ebb95a4d8ecb2d3c520e29ef6fc2e7.png;', '', '104.0137481689453100', '30.6777823498600560', '0', '0', '0', 'asd', '', '', '', '0', '');
INSERT INTO `xjy_seller` VALUES ('5', '1505717400', '0', '12aaa', 'https://ss0.baidu.com/73x1bjeh1BF3odCf/it/u=2033816434,820626626&amp;fm=85&amp;s=D23E3CC4D6D9912E31101C790300C050', '0', '123', '12345677891', '10:00', '22:00', 'admin/20171111/f3ebb95a4d8ecb2d3c520e29ef6fc2e7.png;', '', '0.0000000000000000', '0.0000000000000000', '0', '0', '0', '', '', '', '', '0', '');
INSERT INTO `xjy_seller` VALUES ('10', '1510190880', '1', '川味印象美食城', 'admin/20180425/011c7fd50007f693e55dba071448f1f1.png', '0', '四川省成都市成华区杉板立交', '15915915915', '10:00', '22:00', 'admin/20180421/d31f4e9994ecc6742af502e9667104b6.png;admin/20180421/bb57bfac1bee15b84da6ff235a164a55.jpg;admin/20180421/580d0fd14561589def147f6a72e7e7f1.png;', '', '104.1145563125610400', '30.6633081868488870', '0', '12', '0', '川味印象·美食涵盖：火锅、中餐、宴席、小吃、茶楼、串串、干锅、海味、山珍等', '', '', '', '0', 'wx4612824b7c9f43b5');
INSERT INTO `xjy_seller` VALUES ('11', '1510395132', '0', '测试2', 'https://ss0.baidu.com/73x1bjeh1BF3odCf/it/u=2033816434,820626626&amp;fm=85&amp;s=D23E3CC4D6D9912E31101C790300C050', '0', '23333', '32132132112', '10:00', '22:00', 'admin/20171111/f3ebb95a4d8ecb2d3c520e29ef6fc2e7.png;', '', '104.0278244018554700', '30.6494318103898280', '0', '0', '0', '11', '', '', '', '0', '1');
INSERT INTO `xjy_seller` VALUES ('13', '1510393858', '0', '测试广告', 'https://ss0.baidu.com/73x1bjeh1BF3odCf/it/u=2033816434,820626626&amp;fm=85&amp;s=D23E3CC4D6D9912E31101C790300C050', '0', '233333', '32132132112', '10:00', '22:00', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg;video/20171013/7ed3f37227d5709c2529e844c1a9df1a.jpg;admin/20171111/f3ebb95a4d8ecb2d3c520e29ef6fc2e7.png;', '', '104.0676498413086000', '30.6039354538594200', '0', '0', '0', '', '', '', '', '0', '6');
INSERT INTO `xjy_seller` VALUES ('14', '1510648890', '0', '测试appid', 'https://ss0.baidu.com/73x1bjeh1BF3odCf/it/u=2033816434,820626626&amp;fm=85&amp;s=D23E3CC4D6D9912E31101C790300C050', '0', '测试appid', '12345678912', '10:00', '22:00', 'admin/20171111/f3ebb95a4d8ecb2d3c520e29ef6fc2e7.png;', '', '104.1174316406250000', '30.6485457220260100', '0', '0', '0', '', '', '', '', '0', '10');
INSERT INTO `xjy_seller` VALUES ('16', '1511778480', '1', 'hfhfa', 'admin/20171127/e19630412abdfdd39489c2ff2acc7bb1.jpg', '0', 'hfhfhf', '18010502235', '10:00', '22:00', 'admin/20171121/10a5b98ff94afa911a87fa56125a4003.png;admin/20171127/28d694b2ab0d1fc9e29ff2fe29367b40.jpg;', '', '104.0144348144531200', '30.6491364485041050', '201', '10', '0', 'jhgjgh', '', '', '', '0', '24524');
INSERT INTO `xjy_seller` VALUES ('17', '1513324314', '0', '测试添加蜂鸟商家信息', 'admin/20171215/fc8b7dde98424c9fe8403a210a4aaeb3.jpg', '0', '四川省成都市高新区环球中心E1', '02868730190', '10:00', '22:00', '', '', '104.0652680397030000', '30.5672264394445000', '0', '0', '0', '', '', '', '', '0', 'wx4fdc5885c2c4ad8c  ');
INSERT INTO `xjy_seller` VALUES ('19', '1524217061', '1', '张三小店', '', '1', '在中国四川资阳', '18380425296', '10:00', '22:00', '', '', '105.3382873535156200', '30.0857312296166100', '0', '100', '0', '我们是最好吃的，快来吃我', '', '', '', '0', '123456789');

-- ----------------------------
-- Table structure for xjy_seller_menu
-- ----------------------------
DROP TABLE IF EXISTS `xjy_seller_menu`;
CREATE TABLE `xjy_seller_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  `food_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '食物名称',
  `pinyin` varchar(255) NOT NULL COMMENT '食物拼音码',
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '食物价格',
  `discount` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
  `exhaust` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否告罄 1:告罄;2:没有',
  `food_class` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '食物分类',
  `hot` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '热销商品 1:正常;2:热销',
  `lunch_box` float(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '外卖餐盒费',
  `sales_volume` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品销量',
  `food_evaluate` int(2) unsigned NOT NULL DEFAULT '5' COMMENT '菜品评价平均值',
  `food_icon` varchar(255) NOT NULL DEFAULT '' COMMENT '菜品图片',
  `food_describe` varchar(255) NOT NULL DEFAULT '' COMMENT '对菜品的描述',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除标记字段',
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`),
  KEY `food_name` (`food_name`)
) ENGINE=InnoDB AUTO_INCREMENT=831 DEFAULT CHARSET=utf8 COMMENT='商家菜品信息';

-- ----------------------------
-- Records of xjy_seller_menu
-- ----------------------------
INSERT INTO `xjy_seller_menu` VALUES ('10', '10', '麻婆豆腐', 'MaPoDouFu', '18.00', '0.00', '2', '181', '1', '0.00', '0', '5', 'admin/20180421/75e2debbc82e99d34b11fa37dbf7837b.png', '麻婆豆腐', '1528705421');
INSERT INTO `xjy_seller_menu` VALUES ('11', '10', '蒜泥白肉', 'SuanNiBaiRou', '24.00', '0.00', '2', '182', '1', '0.00', '0', '5', 'admin/20180421/7eb25e0063d8b13ea1865481bc920e34.png', '蒜泥白肉', '1528705404');
INSERT INTO `xjy_seller_menu` VALUES ('12', '10', '小炒肉', 'XiaoChaoRou', '21.00', '0.00', '2', '181', '1', '0.00', '0', '5', 'admin/20180421/5594879d30275fe21a958cb5531c92d7.png', '小炒肉', '1528708742');
INSERT INTO `xjy_seller_menu` VALUES ('13', '10', '香草冰淇淋', '', '10.00', '0.00', '2', '185', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '香草口味冰淇淋', '0');
INSERT INTO `xjy_seller_menu` VALUES ('14', '10', '小白菜', '', '8.00', '0.00', '2', '183', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '香抄小白菜', '0');
INSERT INTO `xjy_seller_menu` VALUES ('15', '10', '水煮肉片', 'ShuiZhuRouPian', '24.00', '0.00', '2', '181', '1', '0.00', '0', '5', 'admin/20180421/eb817bd0abbfa458abbf64dc9460fe01.png', '水煮肉片', '1528705432');
INSERT INTO `xjy_seller_menu` VALUES ('16', '10', '烧仙草', '', '15.00', '0.00', '2', '186', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '烧仙草', '0');
INSERT INTO `xjy_seller_menu` VALUES ('17', '10', '青椒肉丝', '', '18.00', '0.00', '2', '187', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '青椒肉丝', '1510314720');
INSERT INTO `xjy_seller_menu` VALUES ('18', '10', '甜椒肉丝', 'TianJiaoRouSi', '18.00', '0.00', '1', '187', '1', '0.00', '0', '5', 'admin/20180421/b2f5bd94428705e45a04b225918531c1.png', '甜椒肉丝', '1528705398');
INSERT INTO `xjy_seller_menu` VALUES ('19', '10', '丝袜奶茶', '', '15.00', '0.00', '2', '186', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '丝袜奶茶', '0');
INSERT INTO `xjy_seller_menu` VALUES ('20', '10', '养生排骨汤', 'YangShengPaiGuTang', '18.00', '0.00', '2', '182', '1', '0.00', '0', '5', 'admin/20180421/df03de7b60724fc33ed16bddff39e0f7.png', '排骨汤', '1528705410');
INSERT INTO `xjy_seller_menu` VALUES ('21', '10', '水果茶', '', '15.00', '0.00', '2', '186', '1', '1.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '水果茶', '0');
INSERT INTO `xjy_seller_menu` VALUES ('23', '10', '抹茶奶盖', '', '18.00', '0.00', '1', '186', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '抹茶+奶盖', '0');
INSERT INTO `xjy_seller_menu` VALUES ('24', '10', '粉蒸肉', '', '12.00', '0.00', '2', '188', '1', '1.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '粉蒸肉', '1');
INSERT INTO `xjy_seller_menu` VALUES ('25', '15', '老冰棍', '', '4.00', '0.00', '2', '185', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '老冰棍', '0');
INSERT INTO `xjy_seller_menu` VALUES ('26', '10', '双球冰淇淋', '', '10.00', '0.00', '2', '185', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '草莓+巧克力', '0');
INSERT INTO `xjy_seller_menu` VALUES ('27', '12', '麦乐鸡', '', '8.00', '0.00', '2', '179', '1', '0.00', '0', '5', 'admin/20171108/00fea37b356d789c8d90c544694a7832.jpg', '麦乐鸡好好吃', '0');
INSERT INTO `xjy_seller_menu` VALUES ('28', '16', '大概', '', '50.00', '10.00', '2', '188', '1', '2.00', '0', '5', 'https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=462711364,3235688849&amp;fm=27&amp;gp=0.jpg', '的发给的发给发身份识别', '1511253089');
INSERT INTO `xjy_seller_menu` VALUES ('29', '16', '测试', '', '12.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '测试', '0');
INSERT INTO `xjy_seller_menu` VALUES ('30', '16', '测试', '', '123.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '测试', '0');
INSERT INTO `xjy_seller_menu` VALUES ('31', '17', '鱼香茄子', '', '18.00', '13.00', '2', '187', '2', '2.00', '0', '5', 'admin/20180108/59b8be9c5f4053880749f9f657b6c014.jpg', '美味可口，机不可失 失不再来！', '0');
INSERT INTO `xjy_seller_menu` VALUES ('32', '19', '酸溜土豆丝', '', '11.00', '0.00', '2', '190', '2', '0.00', '0', '5', '', '便宜又好吃', '0');
INSERT INTO `xjy_seller_menu` VALUES ('33', '10', '冰火两重天', 'BingHuoLiangZhongTian', '5.03', '0.00', '2', '194', '2', '0.00', '0', '5', 'admin/20180425/0e73435329aa4132fc1fb4e45f1edc05.jpg', '清凉可口0', '1528710517');
INSERT INTO `xjy_seller_menu` VALUES ('34', '10', '花毛峰', 'HuaMaoFeng', '15.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/8dd5e6b7259a18e4aa752ed70025bf06.jpg', '花毛峰', '0');
INSERT INTO `xjy_seller_menu` VALUES ('35', '10', '飘雪', 'PiaoXue', '22.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/8a3efd61cfc960b5ea8cd8df0bd6c0f0.jpg', '飘雪', '0');
INSERT INTO `xjy_seller_menu` VALUES ('36', '10', '素毛峰', 'SuMaoFeng', '15.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/12c1b196586d57e06291dc8201faaf39.jpg', '素毛峰', '0');
INSERT INTO `xjy_seller_menu` VALUES ('37', '10', '竹叶青', 'ZhuYeQing', '26.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/f367111aa162b43563189e0c0b326e13.jpg', '竹叶青', '0');
INSERT INTO `xjy_seller_menu` VALUES ('38', '10', '铁观音', 'TieGuanYin', '37.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/e3a8acff149ce147a18d0de01f31055c.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('39', '10', '铁观音2', 'TieGuanYin2', '77.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/b754571e68bbbf8994c676bc0b12198b.jpg', '铁观音', '0');
INSERT INTO `xjy_seller_menu` VALUES ('40', '10', '金骏眉', 'JinJunMei', '27.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/ce7ea6328a3156ed9b4e3e049f19fd44.jpg', '金骏眉', '0');
INSERT INTO `xjy_seller_menu` VALUES ('41', '10', '金骏眉2', 'JinJunMei2', '57.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/680a4869d5dcb577de8e1c86b5050895.jpg', '金骏眉', '0');
INSERT INTO `xjy_seller_menu` VALUES ('42', '10', '祁门红茶', 'QiMenHongCha', '22.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/10efdcb11c6a4cf7491f41eaade2c296.jpg', '祁门红茶', '0');
INSERT INTO `xjy_seller_menu` VALUES ('43', '10', '猴魁 测试', '', '25.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=2378404851,1335439450&amp;fm=58', '猴魁', '1528351986');
INSERT INTO `xjy_seller_menu` VALUES ('44', '10', '火腿肠', 'HuoTuiChang', '8.00', '1.00', '2', '200', '1', '1.00', '0', '5', '', '肉质鲜美  可口  是你火锅必选菜品', '0');
INSERT INTO `xjy_seller_menu` VALUES ('45', '10', '陈年普洱', 'ChenNianPuEr', '37.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/bf1227eaeb4d32e964c1a6d023c1948f.jpg', '陈年普洱', '0');
INSERT INTO `xjy_seller_menu` VALUES ('46', '10', '贡菊 ', 'GongJu-', '15.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/a5381b770570e3fa3755ffe036d7ce63.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('47', '10', '银花', 'YinHua', '15.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/2ad1e38da7d5205bc83d4c6f723f3471.jpg', '银花', '0');
INSERT INTO `xjy_seller_menu` VALUES ('48', '10', '苦荞', 'KuQiao', '15.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180616/37a2841b6170c1cd8dd167784e3be638.jpg', '苦荞', '0');
INSERT INTO `xjy_seller_menu` VALUES ('49', '10', '麻辣牛肉', '', '36.00', '0.00', '2', '200', '1', '0.00', '0', '5', '', '', '1527842644');
INSERT INTO `xjy_seller_menu` VALUES ('50', '10', '麻辣牛肉', 'MaLaNiuRou', '36.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '1528788104');
INSERT INTO `xjy_seller_menu` VALUES ('51', '10', '白开水', 'BaiKaiShui', '10.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180601/1f60a323ba83bf9df4379a2b411bc133.jpg', '白开水', '0');
INSERT INTO `xjy_seller_menu` VALUES ('52', '10', '扑克', 'PuKe', '8.00', '0.00', '2', '209', '1', '0.00', '0', '5', 'admin/20180601/f716a87b720cac43b37779e914cb5a71.jpg', '扑克', '0');
INSERT INTO `xjy_seller_menu` VALUES ('53', '10', '豆芽木耳炒粉条', 'DouYaMuErChaoFenTiao', '15.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '豆芽木耳炒粉条', '0');
INSERT INTO `xjy_seller_menu` VALUES ('54', '10', '白菜肉包', 'BaiCaiRouBao', '16.00', '0.00', '2', '203', '1', '0.00', '0', '5', '', '白菜肉包', '0');
INSERT INTO `xjy_seller_menu` VALUES ('55', '10', '菠萝蜜丝炒肉', 'BoLuoMiSiChaoRou', '19.00', '0.00', '2', '205', '1', '0.00', '0', '5', '', '1菠萝蜜丝炒肉', '0');
INSERT INTO `xjy_seller_menu` VALUES ('56', '10', '黄瓜粒煎蛋', 'HuangGuaLiJianDan', '56.00', '0.00', '2', '198', '1', '0.00', '0', '5', '', '445黄瓜粒煎蛋', '0');
INSERT INTO `xjy_seller_menu` VALUES ('57', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '16.00', '0.00', '2', '210', '1', '0.00', '0', '5', 'admin/20180604/c7836b0e00154bc1d52da3870bb706dc.png', '辣椒炒韭菜', '1529986576');
INSERT INTO `xjy_seller_menu` VALUES ('58', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '45.00', '0.00', '2', '211', '1', '0.00', '0', '5', 'admin/20180604/c7836b0e00154bc1d52da3870bb706dc.png', '辣椒炒韭菜', '1528709851');
INSERT INTO `xjy_seller_menu` VALUES ('59', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '498.00', '0.00', '2', '212', '1', '0.00', '0', '5', 'admin/20180604/e9a216ee22ba5919aea13fb144fea421.png', '辣椒炒韭菜', '1528710874');
INSERT INTO `xjy_seller_menu` VALUES ('60', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '785.00', '0.00', '2', '213', '1', '0.00', '0', '5', 'admin/20180604/e9a216ee22ba5919aea13fb144fea421.png', '辣椒炒韭菜', '1528788092');
INSERT INTO `xjy_seller_menu` VALUES ('61', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '75.00', '0.00', '2', '199', '1', '0.00', '0', '5', '', '辣椒炒韭菜', '1529986135');
INSERT INTO `xjy_seller_menu` VALUES ('62', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '45.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '辣椒炒韭菜', '1528788114');
INSERT INTO `xjy_seller_menu` VALUES ('63', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '45.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '辣椒炒韭菜', '1528788120');
INSERT INTO `xjy_seller_menu` VALUES ('64', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '46.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '辣椒炒韭菜', '1528705528');
INSERT INTO `xjy_seller_menu` VALUES ('65', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '45.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '辣椒炒韭菜', '0');
INSERT INTO `xjy_seller_menu` VALUES ('66', '10', '辣椒炒韭菜', 'LaJiaoChaoJiuCai', '45.00', '0.00', '2', '181', '1', '0.00', '0', '5', 'admin/20180604/c7836b0e00154bc1d52da3870bb706dc.png', '辣椒炒韭菜', '1528705438');
INSERT INTO `xjy_seller_menu` VALUES ('67', '10', '创意松饼球', 'ChuangYiSongBingQiu', '96.00', '0.00', '2', '182', '1', '0.00', '0', '5', 'admin/20180604/c7836b0e00154bc1d52da3870bb706dc.png', '创意松饼球', '1528705415');
INSERT INTO `xjy_seller_menu` VALUES ('68', '10', '圆滚滚', 'YuanGunGun', '4855.00', '0.00', '2', '187', '1', '0.00', '0', '5', 'admin/20180604/c7836b0e00154bc1d52da3870bb706dc.png', '圆滚滚', '1528705387');
INSERT INTO `xjy_seller_menu` VALUES ('69', '10', '鹅肝酱配面包片', 'EGanJiangPeiMianBaoPian', '67.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '酱香味十足', '1528705329');
INSERT INTO `xjy_seller_menu` VALUES ('70', '10', '麻辣牛肉干', 'MaLaNiuRouGan', '67.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '香麻牛肉，回味无穷', '1528705454');
INSERT INTO `xjy_seller_menu` VALUES ('71', '10', '川味葱椒鸡', 'ChuanWeiCongJiaoJi', '43.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '葱香四溢，辣味十足', '1528705461');
INSERT INTO `xjy_seller_menu` VALUES ('72', '10', '凉面白肉', 'LiangMianBaiRou', '32.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '凉面配白肉，荤素正搭', '1528705465');
INSERT INTO `xjy_seller_menu` VALUES ('73', '10', '糖醋排骨', 'TangCuPaiGu', '38.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '香甜口感', '1528705472');
INSERT INTO `xjy_seller_menu` VALUES ('74', '10', '口水姜丝鸭', 'KouShuiJiangSiYa', '37.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '保证鸭肉原有的口感，而又去除其中的腥味', '1528705477');
INSERT INTO `xjy_seller_menu` VALUES ('75', '10', '椒麻牙梗', 'JiaoMaYaGeng', '32.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '椒麻牙梗', '1528705486');
INSERT INTO `xjy_seller_menu` VALUES ('76', '10', '妙龄乳鸽', 'MiaoLingRuGe', '47.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '好吃又滋养', '1528705491');
INSERT INTO `xjy_seller_menu` VALUES ('77', '10', '夫妻肺片', 'FuQiFeiPian', '38.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '味足味香', '1528705482');
INSERT INTO `xjy_seller_menu` VALUES ('78', '10', '金丝如意紫山药', 'JinSiRuYiZiShanYao', '32.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '金丝如意，万事如意', '1528705496');
INSERT INTO `xjy_seller_menu` VALUES ('79', '10', '烧椒杏鲍菇', 'ShaoJiaoXingBaoGu', '23.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528705501');
INSERT INTO `xjy_seller_menu` VALUES ('80', '10', '红油小黄笋', 'HongYouXiaoHuangSun', '23.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '清脆，将笋的清脆和红油完美融合在一起', '1528705507');
INSERT INTO `xjy_seller_menu` VALUES ('81', '10', '一根莴笋', 'YiGenWoSun', '12.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528705511');
INSERT INTO `xjy_seller_menu` VALUES ('82', '10', '蛋酥花仁', 'DanSuHuaRen', '17.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528705517');
INSERT INTO `xjy_seller_menu` VALUES ('83', '10', '招牌什锦沙拉', 'ZhaoPaiShiJinShaLa', '26.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528705522');
INSERT INTO `xjy_seller_menu` VALUES ('84', '10', '开心萝卜皮', 'KaiXinLuoBuPi', '23.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528705528');
INSERT INTO `xjy_seller_menu` VALUES ('85', '10', '雷椒南瓜丝', 'LeiJiaoNanGuaSi', '17.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528705534');
INSERT INTO `xjy_seller_menu` VALUES ('86', '10', '果香红豆沙律', 'GuoXiangHongDouShaLv', '23.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528705380');
INSERT INTO `xjy_seller_menu` VALUES ('87', '10', '话梅凉瓜', 'HuaMeiLiangGua', '17.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528705392');
INSERT INTO `xjy_seller_menu` VALUES ('88', '10', '秀肌肉的牛肉（卤水小牛腱）', 'XiuJiRouDeNiuRouLuShuiXiaoNiuJian', '48.00', '0.00', '2', '215', '1', '0.00', '0', '5', '', '', '1528705322');
INSERT INTO `xjy_seller_menu` VALUES ('89', '10', '鹅肝酱配面包片', 'EGanJiangPeiMianBaoPian', '67.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '1528705444');
INSERT INTO `xjy_seller_menu` VALUES ('90', '10', '鹅肝酱配面包片', 'EGanJiangPeiMianBaoPian', '67.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('91', '10', '鹅肝酱配面包片', 'EGanJiangPeiMianBaoPian', '67.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '1528705722');
INSERT INTO `xjy_seller_menu` VALUES ('92', '10', '鹅肝酱配面包片', 'EGanJiangPeiMianBaoPian', '43.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '1528705716');
INSERT INTO `xjy_seller_menu` VALUES ('93', '10', '御膳肚子鸡(整只)', 'YuShanDuZiJiZhengZhi', '188.00', '0.00', '2', '195', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('94', '10', '御膳肚子鸡(整只)', 'YuShanDuZiJiZhengZhi', '188.00', '0.00', '2', '195', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('95', '10', '麻辣牛肉干', 'MaLaNiuRouGan', '67.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('96', '10', '川味葱椒鸡', 'ChuanWeiCongJiaoJi', '43.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('97', '10', '三更老鸭汤(整只)', 'SanGengLaoYaTangZhengZhi', '168.00', '0.00', '2', '195', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('98', '10', '凉面白肉', 'LiangMianBaiRou', '32.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '1528705905');
INSERT INTO `xjy_seller_menu` VALUES ('99', '10', '奥门大骨煲', 'AoMenDaGuBao', '138.00', '0.00', '2', '195', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('100', '10', '农家风排骨', 'NongJiaFengPaiGu', '108.00', '0.00', '2', '195', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('101', '10', '土家腊味煲', 'TuJiaLaWeiBao', '108.00', '0.00', '2', '195', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('102', '10', '川味葱椒鸡', 'ChuanWeiCongJiaoJi', '43.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('103', '10', '凉面白肉', 'LiangMianBaiRou', '32.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('104', '10', '糖醋排骨', 'TangCuPaiGu', '38.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '1528706133');
INSERT INTO `xjy_seller_menu` VALUES ('105', '10', '口水姜丝鸭', 'KouShuiJiangSiYa', '37.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '1528706140');
INSERT INTO `xjy_seller_menu` VALUES ('106', '10', '川味葱椒鸡', 'ChuanWeiCongJiaoJi', '43.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('107', '10', '凉面白肉', 'LiangMianBaiRou', '32.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('108', '10', '糖醋排骨', 'TangCuPaiGu', '38.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('109', '10', '御膳肚子鸡(整只)', 'YuShanDuZiJiZhengZhi', '188.00', '0.00', '2', '195', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('110', '10', '口水姜丝鸭', 'KouShuiJiangSiYa', '37.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('111', '10', '椒麻牙梗', 'JiaoMaYaGeng', '32.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('112', '10', '妙龄乳鸽', 'MiaoLingRuGe', '47.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('113', '10', '夫妻肺片', 'FuQiFeiPian', '38.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('114', '10', '金丝如意紫山药', 'JinSiRuYiZiShanYao', '32.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('115', '10', '风味竹虫', 'FengWeiZhuChong', '38.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('116', '10', '烧椒杏鲍菇', 'ShaoJiaoXingBaoGu', '23.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('117', '10', '红油小黄笋', 'HongYouXiaoHuangSun', '23.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('118', '10', '一根莴笋', 'YiGenWoSun', '12.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('119', '10', '蛋酥花仁', 'DanSuHuaRen', '17.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('120', '10', '招牌什锦沙拉', 'ZhaoPaiShiJinShaLa', '26.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('121', '10', '开心萝卜皮', 'KaiXinLuoBuPi', '23.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('122', '10', '雷椒南瓜丝', 'LeiJiaoNanGuaSi', '17.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('123', '10', '剁椒蒸鱼头', 'DuoJiaoZhengYuTou', '62.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('124', '10', '果香红豆沙律', 'GuoXiangHongDouShaLv', '23.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('125', '10', '话梅凉瓜', 'HuaMeiLiangGua', '17.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('126', '10', '椒盐蝉蛹', 'JiaoYanChanYong', '38.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('127', '10', '蒜蓉蒸扇贝', 'SuanRongZhengShanBei', '8.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '8/只', '0');
INSERT INTO `xjy_seller_menu` VALUES ('128', '10', '秀肌肉的牛肉（卤水小牛腱）', 'XiuJiRouDeNiuRouLuShuiXiaoNiuJian', '48.00', '0.00', '2', '215', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('129', '10', '农村来的土鸡爪（带腿土鸡爪）', 'NongCunLaiDeTuJiZhaoDaiTuiTuJiZhao', '17.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '17/只\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('130', '10', '老婆喜欢的耙耳朵（卤猪耳）', 'LaoPoXiHuanDeBaErDuoLuZhuEr', '32.00', '0.00', '2', '215', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('131', '10', '招财的金钱肚（卤水金钱肚）', 'ZhaoCaiDeJinQianDuLuShuiJinQianDu', '48.00', '0.00', '2', '215', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('132', '10', '农村来的土鸡爪', 'NongCunLaiDeTuJiZhao', '17.00', '0.00', '2', '215', '1', '0.00', '0', '5', '', '（带腿土鸡爪）（17/只）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('133', '10', '爱偷吃的鹅郡肝（卤鹅珍）', 'AiTouChiDeEJunGanLuEZhen', '36.00', '0.00', '2', '215', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('134', '10', '麻婆豆腐', 'MaPoDouFu', '29.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('135', '10', '麻婆豆腐', 'MaPoDouFu', '29.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '1528707532');
INSERT INTO `xjy_seller_menu` VALUES ('136', '10', '鱼香肉丝', 'YuXiangRouSi', '28.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('137', '10', '干烧辽参', 'GanShaoLiaoCan', '298.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('138', '10', '干烧辽参', 'GanShaoLiaoCan', '298.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('139', '10', '干烧蹄筋', 'GanShaoTiJin', '78.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('140', '10', '生爆生态甲鱼', 'ShengBaoShengTaiJiaYu', '169.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('141', '10', '风味牛仔骨', 'FengWeiNiuZiGu', '68.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('142', '10', '石锅土鳝鱼', 'ShiGuoTuShanYu', '98.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('143', '10', '双椒牛舌', 'ShuangJiaoNiuShe', '58.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('144', '10', '汗蒸回锅肉', 'HanZhengHuiGuoRou', '38.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('145', '10', '宫保鸡丁', 'GongBaoJiDing', '39.00', '0.00', '2', '214', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('146', '10', '石锅肥牛', 'ShiGuoFeiNiu', '58.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('147', '10', '炭烤牛肋骨', 'TanKaoNiuLeGu', '98.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('148', '10', '铁观音大虾', 'TieGuanYinDaXia', '98.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('149', '10', '鲍酱鹅掌', 'BaoJiangEZhang', '78.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('150', '10', '芙蓉鸡片', 'FuRongJiPian', '68.00', '0.00', '2', '182', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('151', '10', '仔姜美蛙', 'ZiJiangMeiWa', '78.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('152', '10', '天府荟萃(毛血旺)', 'TianFuHuiCuiMaoXueWang', '58.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('153', '10', '水豆豉鹅掌', 'ShuiDouChiEZhang', '68.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('154', '10', '映像三角蜂', 'YingXiangSanJiaoFeng', '78.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('155', '10', '土豆爱尚虾', 'TuDouAiShangXia', '68.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('156', '10', '香辣掌中宝', 'XiangLaZhangZhongBao', '48.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('157', '10', '鲜香草原肚', 'XianXiangCaoYuanDu', '58.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('158', '10', '小炒黄牛肉', 'XiaoChaoHuangNiuRou', '48.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('159', '10', '泡椒江团', 'PaoJiaoJiangTuan', '98.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '98/尾\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('160', '10', '糖醋脆皮鱼', 'TangCuCuiPiYu', '68.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '68/尾\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('161', '10', '油淋仔鸡', 'YouLinZiJi', '68.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('162', '10', '雪花鸡淖', 'XueHuaJiNe', '68.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('163', '10', '凉粉鲫鱼', 'LiangFenJiYu', '48.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('164', '10', '凉粉鲫鱼', 'LiangFenJiYu', '48.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '1528708580');
INSERT INTO `xjy_seller_menu` VALUES ('165', '10', '剁椒蒸鱼头', 'DuoJiaoZhengYuTou', '62.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('166', '10', '蒜蓉蒸扇贝', 'SuanRongZhengShanBei', '8.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '8/只\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('167', '10', '铁板生焗虾', 'TieBanShengXia', '62.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('168', '10', '瑶柱蒸娃娃菜', 'YaoZhuZhengWaWaCai', '32.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('169', '10', '原味酱肉蒸淮山', 'YuanWeiJiangRouZhengHuaiShan', '46.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('170', '10', '五谷丰登', 'WuGuFengDeng', '38.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('171', '10', '粉蒸肉', 'FenZhengRou', '32.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('172', '10', '咸烧白', 'XianShaoBai', '26.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('173', '10', '冬菜蒸坨坨肉', '', '48.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('174', '10', '红烧狮子头', 'HongShaoShiZiTou', '48.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('175', '10', '甜烧白', 'TianShaoBai', '32.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('176', '10', '蒸香碗', 'ZhengXiangWan', '38.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('177', '10', '糯米排骨', 'NuoMiPaiGu', '38.00', '0.00', '2', '188', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('178', '10', '担担面', 'DanDanMian', '6.00', '0.00', '2', '205', '1', '0.00', '0', '5', '', '6/碗\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('179', '10', '龙抄手（小）', 'LongChaoShouXiao', '6.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '6/小份\r\n\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('180', '10', '糖油果子', 'TangYouGuoZi', '12.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '12/份\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('181', '10', '手工金丝饼', 'ShouGongJinSiBing', '28.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '28/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('182', '10', '乐山豆腐脑', 'LeShanDouFuNao', '8.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '8/碗\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('183', '10', '风味蛋烘糕', 'FengWeiDanHongGao', '6.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '6/个\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('184', '10', '鸡尖', 'JiJian', '2.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '2/只', '0');
INSERT INTO `xjy_seller_menu` VALUES ('185', '10', '蟹黄烧麦', 'XieHuangShaoMai', '38.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '38/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('186', '10', '烤耙鸡脚', 'KaoBaJiJiao', '4.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('187', '10', '传统凉粉', 'ChuanTongLiangFen', '6.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '6/碗\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('188', '10', '鸡中翅', 'JiZhongChi', '4.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('189', '10', '鱿鱼须', 'YouYuXu', '4.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('190', '10', '宫廷豌豆黄', 'GongTingWanDouHuang', '18.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '18/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('191', '10', '鱿鱼', 'YouYu', '4.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('192', '10', '风味酱香春卷', 'FengWeiJiangXiangChunJuan', '18.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '18/半打\r\n', '1528710999');
INSERT INTO `xjy_seller_menu` VALUES ('193', '10', '玉米', 'YuMi', '8.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('194', '10', '千丝榴莲酥', 'QianSiLiuLianSu', '28.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '28/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('195', '10', '鸡脆骨', 'JiCuiGu', '4.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('196', '10', '豆腐干', 'DouFuGan', '2.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('197', '10', '紫薯蒸糕', 'ZiShuZhengGao', '24.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '24/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('198', '10', '脑花', 'NaoHua', '12.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('199', '10', '火腿肠', 'HuoTuiChang', '3.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('200', '10', '椰香小白兔', 'YeXiangXiaoBaiTu', '18.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '18/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('201', '10', '猪手', 'ZhuShou', '15.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('202', '10', '仔骨', 'ZiGu', '4.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('203', '10', '宜宾凉糕', 'YiBinLiangGao', '6.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '6/份\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('204', '10', '排骨', 'PaiGu', '4.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('205', '10', '三大炮', 'SanDaPao', '8.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '8/碗\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('206', '10', '茄子', 'QieZi', '8.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('207', '10', '锺水饺', 'ZhongShuiJiao', '6.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '6/碗\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('208', '10', '羊肉', 'YangRou', '4.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('209', '10', '酸辣粉', 'SuanLaFen', '6.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '6/碗\r\n', '1529987066');
INSERT INTO `xjy_seller_menu` VALUES ('210', '10', '韭菜', 'JiuCai', '2.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('211', '10', '土豆', 'TuDou', '2.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('212', '10', '红糖糍粑', 'HongTangCiBa', '22.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '22/份\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('213', '10', '鲫鱼', 'JiYu', '12.00', '0.00', '2', '211', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('214', '10', '水晶蒸饺', 'ShuiJingZhengJiao', '26.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '26/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('215', '10', '鸡丝凉面', 'JiSiLiangMian', '6.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '6/碗\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('216', '10', '圣子王', 'ShengZiWang', '68.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('217', '10', '一网情深', 'YiWangQingShen', '22.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '22/打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('218', '10', '波汁叶儿粑', 'BoZhiYeErBa', '24.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '24/打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('219', '10', '小鲜鲍', 'XiaoXianBao', '78.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('220', '10', '花螺', 'HuaLuo', '88.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('221', '10', '玻璃烧麦', 'BoLiShaoMai', '28.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '28/打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('222', '10', '天府米糕', 'TianFuMiGao', '16.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '16/打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('223', '10', '花甲', 'HuaJia', '38.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('224', '10', '圣子', 'ShengZi', '48.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('225', '10', '特色鲜花饼', 'TeSeXianHuaBing', '22.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '22/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('226', '10', '晶莹鲜虾饺', 'JingYingXianXiaJiao', '38.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '38/打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('227', '10', '天府熊猫', 'TianFuXiongMiao', '18.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '18/半打\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('228', '10', '现炸酥肉', 'XianZhaSuRou', '22.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '22/份\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('229', '10', '担担面（小）', 'DanDanMianXiao', '6.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '6/碗\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('230', '10', '直供鸭舌', 'ZhiGongYaShe', '16.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('231', '10', '鹌鹑蛋', 'AnChunDan', '8.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('232', '10', '菊花鲜鸭胗', 'JuHuaXianYaZhen', '23.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('233', '10', '梅林午餐肉', 'MeiLinWuCanRou', '12.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('234', '10', '一品虾饺', 'YiPinXiaJiao', '12.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('235', '10', '山药', 'ShanYao', '8.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('236', '10', '功夫青笋片', 'GongFuQingSunPian', '9.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('237', '10', '功夫黄瓜片', 'GongFuHuangGuaPian', '9.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('238', '10', '藕片', 'OuPian', '8.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('239', '10', '极品耗儿鱼', 'JiPinHaoErYu', '36.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('240', '10', '海带', 'HaiDai', '8.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('241', '10', '精品五花肉', 'JingPinWuHuaRou', '16.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('242', '10', '金针菇', 'JinZhenGu', '8.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('243', '10', '小郡肝', 'XiaoJunGan', '18.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('244', '10', '西红柿', 'XiHongShi', '8.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('245', '10', '酿豆腐', 'NiangDouFu', '22.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('246', '10', '白萝卜', 'BaiLuoBu', '3.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('247', '10', '无骨鲜鹅掌', 'WuGuXianEZhang', '16.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('248', '10', '安岳苕粉', 'AnYueShaoFen', '8.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('249', '10', '碗碗鲜鸭血', 'WanWanXianYaXue', '8.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('250', '10', '美好火腿肠', 'MeiHaoHuoTuiChang', '8.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('251', '10', '鲜黄花', 'XianHuangHua', '15.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('252', '10', '聪明脑花', 'CongMingNaoHua', '10.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('253', '10', '石磨豆腐', 'ShiMoDouFu', '10.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('254', '10', '滋补兔腰', 'ZiBuTuYao', '18.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('255', '10', '草原鲜毛肚', 'CaoYuanXianMaoDu', '26.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('256', '10', '千丝牛肚', 'QianSiNiuDu', '22.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('257', '10', '茼蒿', 'TongGao', '12.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('258', '10', '鹅郡片', 'EJunPian', '28.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('259', '10', '土豆', 'TuDou', '5.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('260', '10', '冬瓜', 'DongGua', '3.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('261', '10', '油麦菜', 'YouMaiCai', '6.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('262', '10', '麻辣牛油锅', 'MaLaNiuYouGuo', '46.00', '0.00', '2', '239', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('263', '10', '黄豆芽', 'HuangDouYa', '5.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('264', '10', '鲜豆皮', 'XianDouPi', '6.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('265', '10', '生态木耳', 'ShengTaiMuEr', '8.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('266', '10', '花菜', 'HuaCai', '6.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('267', '10', '龙口粉丝', 'LongKouFenSi', '8.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('268', '10', '牛油鸳鸯锅', 'NiuYouYuanYangGuo', '49.00', '0.00', '2', '239', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('269', '10', '娃娃菜', 'WaWaCai', '10.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('270', '10', '海带苗', 'HaiDaiMiao', '12.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('271', '10', '麻辣青油锅', 'MaLaQingYouGuo', '46.00', '0.00', '2', '239', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('272', '10', '上等牛里脊', 'ShangDengNiuLiJi', '32.00', '0.00', '2', '236', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('273', '10', '青油鸳鸯锅', 'QingYouYuanYangGuo', '49.00', '0.00', '2', '239', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('274', '10', '手工鲜牛肉滑', 'ShouGongXianNiuRouHua', '28.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '1528792688');
INSERT INTO `xjy_seller_menu` VALUES ('275', '10', '鲜嫩匙仁', 'XianNenChiRen', '28.00', '0.00', '2', '236', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('276', '10', '手工鲜牛肉滑', 'ShouGongXianNiuRouHua', '28.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('277', '10', '手工虾滑', 'ShouGongXiaHua', '28.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('278', '10', '秘制麻辣排骨', 'MiZhiMaLaPaiGu', '28.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('279', '10', '山椒牛肉', 'ShanJiaoNiuRou', '26.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('280', '10', '现杀土鳝鱼', 'XianShaTuShanYu', '38.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('281', '10', '耙牛肉', 'BaNiuRou', '28.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('282', '10', '手工香菜圆子', 'ShouGongXiangCaiYuanZi', '20.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('283', '10', '贵妃牛肉', 'GuiFeiNiuRou', '26.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('284', '10', '天香肥肠', 'TianXiangFeiChang', '26.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('285', '10', '现杀黄辣丁', 'XianShaHuangLaDing', '26.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('286', '10', '现杀泥鳅', 'XianShaNiQiu', '26.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('287', '10', '鲜猪黄喉', 'XianZhuHuangHou', '28.00', '0.00', '2', '241', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('288', '10', '双层肥胼', 'ShuangCengFeiPian', '28.00', '0.00', '2', '236', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('289', '10', '屠场直供鲜牛毛肚', 'TuChangZhiGongXianNiuMaoDu', '88.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('290', '10', '精品吊龙', 'JingPinDiaoLong', '28.00', '0.00', '2', '236', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('291', '10', '屠场直供鲜牛黄喉', 'TuChangZhiGongXianNiuHuangHou', '28.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('292', '10', '高钙脖仁', 'GaoGaiBoRen', '28.00', '0.00', '2', '236', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('293', '10', '麻辣霸王鲜牛肉', 'MaLaBaWangXianNiuRou', '28.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('294', '10', '屠场直供鲜兔肚', 'TuChangZhiGongXianTuDu', '22.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('295', '10', '极品五花腱', 'JiPinWuHuaJian', '32.00', '0.00', '2', '236', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('296', '10', '极品千层肚', 'JiPinQianCengDu', '28.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('297', '10', '混血儿肥牛', 'HunXueErFeiNiu', '30.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('298', '10', '冰川鲜鹅肠', 'BingChuanXianEChang', '28.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('299', '10', '刺身肥牛', 'CiShenFeiNiu', '58.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('300', '10', '屠场直供鲜牛蹄筋', 'TuChangZhiGongXianNiuTiJin', '26.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('301', '10', '精品羊肉卷', 'JingPinYangRouJuan', '26.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('302', '10', '生扣鸭肠', 'ShengKouYaChang', '20.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('303', '10', '肥肠节子', 'FeiChangJieZi', '28.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('304', '10', '相间肥牛王', 'XiangJianFeiNiuWang', '32.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('305', '10', '关公大刀腰片', 'GuanGongDaDaoYaoPian', '32.00', '0.00', '2', '240', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('306', '10', '混血儿肥牛', 'HunXueErFeiNiu', '30.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('307', '10', '刺身肥牛', 'CiShenFeiNiu', '58.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('308', '10', '胶原肥牛', 'JiaoYuanFeiNiu', '28.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('309', '10', '精品羊肉卷', 'JingPinYangRouJuan', '26.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('310', '10', '相间肥牛王', 'XiangJianFeiNiuWang', '32.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('311', '10', '安格斯牛小排', 'AnGeSiNiuXiaoPai', '48.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('312', '10', '胶原肥牛', 'JiaoYuanFeiNiu', '28.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('313', '10', '安格斯牛小排', 'AnGeSiNiuXiaoPai', '48.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('314', '10', '眼肉肥牛', 'YanRouFeiNiu', '32.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('315', '10', '眼肉肥牛', 'YanRouFeiNiu', '32.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('316', '10', '巨无霸雪花肥牛', 'JuWuBaXueHuaFeiNiu', '30.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('317', '10', '巨无霸雪花肥牛', 'JuWuBaXueHuaFeiNiu', '30.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('318', '10', '串烧肥牛', 'ChuanShaoFeiNiu', '26.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('319', '10', '串烧肥牛', 'ChuanShaoFeiNiu', '26.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('320', '10', '精品肥牛卷', 'JingPinFeiNiuJuan', '24.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('321', '10', '精品肥牛卷', 'JingPinFeiNiuJuan', '24.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('322', '10', '上脑肥牛', 'ShangNaoFeiNiu', '36.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('323', '10', '上脑肥牛', 'ShangNaoFeiNiu', '36.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('324', '10', '田园小肥鹅', 'TianYuanXiaoFeiE', '32.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('325', '10', '田园小肥鹅', 'TianYuanXiaoFeiE', '32.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('326', '10', '精品牛舌', 'JingPinNiuShe', '26.00', '0.00', '2', '242', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('327', '10', '上等牛里脊', 'ShangDengNiuLiJi', '32.00', '0.00', '2', '243', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('328', '10', '精品牛舌', 'JingPinNiuShe', '26.00', '0.00', '2', '238', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('329', '10', '鲜嫩匙仁', 'XianNenChiRen', '28.00', '0.00', '2', '243', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('330', '10', '双层肥胼', 'ShuangCengFeiPian', '28.00', '0.00', '2', '243', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('331', '10', '功夫养生汤', 'GongFuYangShengTang', '28.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '28/位', '1530010443');
INSERT INTO `xjy_seller_menu` VALUES ('332', '10', '精品吊龙', 'JingPinDiaoLong', '28.00', '0.00', '2', '243', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('333', '10', '松茸炖鸡', 'SongRongDunJi', '28.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '28/位', '1530010449');
INSERT INTO `xjy_seller_menu` VALUES ('334', '10', '高钙脖仁', 'GaoGaiBoRen', '28.00', '0.00', '2', '243', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('335', '10', '极品五花腱', 'JiPinWuHuaJian', '32.00', '0.00', '2', '243', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('336', '10', '雪梨炖排骨', 'XueLiDunPaiGu', '22.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '22/位', '1530010461');
INSERT INTO `xjy_seller_menu` VALUES ('337', '10', '山药', 'ShanYao', '8.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('338', '10', '天麻炖乳鸽', 'TianMaDunRuGe', '48.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '48/位', '1530010466');
INSERT INTO `xjy_seller_menu` VALUES ('339', '10', '功夫青笋片', 'GongFuQingSunPian', '9.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('340', '10', '清炖松茸', 'QingDunSongRong', '18.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '18/位', '1530010473');
INSERT INTO `xjy_seller_menu` VALUES ('341', '10', '开水白菜', 'KaiShuiBaiCai', '18.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '18/位', '1530010481');
INSERT INTO `xjy_seller_menu` VALUES ('342', '10', '泉水炖桃胶', 'QuanShuiDunTaoJiao', '18.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '18/位', '1530010509');
INSERT INTO `xjy_seller_menu` VALUES ('343', '10', '清炖狮子头', 'QingDunShiZiTou', '28.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '28/位', '1530010513');
INSERT INTO `xjy_seller_menu` VALUES ('344', '10', '功夫黄瓜片', 'GongFuHuangGuaPian', '9.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('345', '10', '竹荪炖菜胆', 'ZhuSunDunCaiDan', '18.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '18/位', '1530010487');
INSERT INTO `xjy_seller_menu` VALUES ('346', '10', '藕片', 'OuPian', '8.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('347', '10', '海带', 'HaiDai', '8.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('348', '10', '山珍鲜菌汤', 'ShanZhenXianJunTang', '18.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '18/位或48/例\r\n', '1530010494');
INSERT INTO `xjy_seller_menu` VALUES ('349', '10', '金针菇', 'JinZhenGu', '8.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('350', '10', '酸萝卜老鸭汤', 'SuanLuoBuLaoYaTang', '48.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '', '1530010499');
INSERT INTO `xjy_seller_menu` VALUES ('351', '10', '棒骨杂粮汤', 'BangGuZaLiangTang', '48.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '', '1530010505');
INSERT INTO `xjy_seller_menu` VALUES ('352', '10', '西红柿', 'XiHongShi', '8.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('353', '10', '豌豆炖猪手', 'WanDouDunZhuShou', '48.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '', '1530010518');
INSERT INTO `xjy_seller_menu` VALUES ('354', '10', '白萝卜', 'BaiLuoBu', '3.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('355', '10', '安岳苕粉', 'AnYueShaoFen', '8.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('356', '10', '鲜菌炖老鸡', 'XianJunDunLaoJi', '48.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '', '1530010524');
INSERT INTO `xjy_seller_menu` VALUES ('357', '10', '鲜黄花', 'XianHuangHua', '15.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('358', '10', '绿豆排骨汤', 'LvDouPaiGuTang', '48.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '', '1530010529');
INSERT INTO `xjy_seller_menu` VALUES ('359', '10', '石磨豆腐', 'Shi10MoDouFu', '10.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('360', '10', '小米辽参', 'XiaoMiLiaoCan', '68.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '68/位\r\n', '1530010536');
INSERT INTO `xjy_seller_menu` VALUES ('361', '10', '茼蒿', 'TongGao', '12.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('362', '10', '松茸捞饭', 'SongRongLaoFan', '58.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '58/位\r\n', '1530010541');
INSERT INTO `xjy_seller_menu` VALUES ('363', '10', '土豆', 'TuDou', '5.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('364', '10', '木瓜炖雪蛤(桃胶)', 'MuGuaDunXueGaTaoJiao', '48.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '48/位', '1530010546');
INSERT INTO `xjy_seller_menu` VALUES ('365', '10', '冬瓜', 'DongGua', '3.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('366', '10', '5021.油麦菜', '5021YouMaiCai', '6.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '1528794497');
INSERT INTO `xjy_seller_menu` VALUES ('367', '10', '金瓜鸡豆花', 'JinGuaJiDouHua', '26.00', '0.00', '2', '196', '1', '0.00', '0', '5', '', '26/位', '1530010551');
INSERT INTO `xjy_seller_menu` VALUES ('368', '10', '御膳肚子鸡(整只)', 'YuShanDuZiJiZhengZhi', '188.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('369', '10', '油麦菜', 'YouMaiCai', '6.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('370', '10', '黄豆芽', 'HuangDouYa', '5.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('371', '10', '鲜豆皮', 'XianDouPi', '6.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('372', '10', '生态木耳', 'ShengTaiMuEr', '8.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('373', '10', '三更老鸭汤（整只）', 'SanGengLaoYaTangZhengZhi', '168.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('374', '10', '花菜', 'HuaCai', '6.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('375', '10', '奥门大骨煲', 'AoMenDaGuBao', '138.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('376', '10', '农家风排骨', 'NongJiaFengPaiGu', '108.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('377', '10', '龙口粉丝', 'LongKouFenSi', '8.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('378', '10', '土家腊味煲', 'TuJiaLaWeiBao', '108.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('379', '10', '娃娃菜', 'WaWaCai', '10.00', '0.00', '2', '201', '1', '0.00', '0', '5', '', '', '1530011262');
INSERT INTO `xjy_seller_menu` VALUES ('380', '10', '海带苗', 'HaiDaiMiao', '12.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('381', '10', '自助调料', 'ZiZhuDiaoLiao', '6.00', '0.00', '2', '244', '1', '0.00', '0', '5', '', '6/位\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('382', '10', '生态甲鱼', 'ShengTaiJiaYu', '168.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '168/斤   生爆、酱烧、生焗\r\n\r\n', '1528967764');
INSERT INTO `xjy_seller_menu` VALUES ('383', '10', '竹荪', 'ZhuSun', '38.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('384', '10', '猴头菇', 'HouTouGu', '32.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('385', '10', '竹荪', 'ZhuSun', '38.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009128');
INSERT INTO `xjy_seller_menu` VALUES ('386', '10', '茶树菇', 'ChaShuGu', '16.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('387', '10', '鸡腿菇', 'JiTuiGu', '16.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('388', '10', '猴头菇', 'HouTouGu', '32.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009002');
INSERT INTO `xjy_seller_menu` VALUES ('389', '10', '猪肚菇', 'ZhuDuGu', '16.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('390', '10', '茶树菇', 'ChaShuGu', '16.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009008');
INSERT INTO `xjy_seller_menu` VALUES ('391', '10', '海鲜菇', 'HaiXianGu', '16.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('392', '10', '滑菇', 'HuaGu', '22.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('393', '10', '鸡腿菇', 'JiTuiGu', '16.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009014');
INSERT INTO `xjy_seller_menu` VALUES ('394', '10', '雪菇', 'XueGu', '18.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('395', '10', '猪肚菇', 'ZhuDuGu', '16.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009020');
INSERT INTO `xjy_seller_menu` VALUES ('396', '10', '球盖菇', 'QiuGaiGu', '18.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('397', '10', '海鲜菇', 'HaiXianGu', '16.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009025');
INSERT INTO `xjy_seller_menu` VALUES ('398', '10', '羊肚菌', 'YangDuJun', '96.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('399', '10', '滑菇', 'HuaGu', '22.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009032');
INSERT INTO `xjy_seller_menu` VALUES ('400', '10', '松茸', 'SongRong', '68.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('401', '10', '雪菇', 'XueGu', '18.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009037');
INSERT INTO `xjy_seller_menu` VALUES ('402', '10', '鸡枞', 'JiCong', '68.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('403', '10', '美味牛肝', 'MeiWeiNiuGan', '38.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('404', '10', '球盖菇', 'QiuGaiGu', '18.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009043');
INSERT INTO `xjy_seller_menu` VALUES ('405', '10', '老人头', 'LaoRenTou', '38.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('406', '10', '羊肚菌', 'YangDuJun', '96.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009049');
INSERT INTO `xjy_seller_menu` VALUES ('407', '10', '黄牛肝', 'HuangNiuGan', '38.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('408', '10', '松茸', 'SongRong', '68.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009056');
INSERT INTO `xjy_seller_menu` VALUES ('409', '10', '鸡枞', 'JiCong', '68.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009063');
INSERT INTO `xjy_seller_menu` VALUES ('410', '10', '美味牛肝', 'MeiWeiNiuGan', '38.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009072');
INSERT INTO `xjy_seller_menu` VALUES ('411', '10', '老人头', 'LaoRenTou', '38.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009078');
INSERT INTO `xjy_seller_menu` VALUES ('412', '10', '青杠', 'QingGong', '28.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('413', '10', '黄牛肝', 'HuangNiuGan', '38.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009082');
INSERT INTO `xjy_seller_menu` VALUES ('414', '10', '鸡油', 'JiYou', '32.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('415', '10', '青扛', 'QingKang', '28.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009094');
INSERT INTO `xjy_seller_menu` VALUES ('416', '10', '乳牛肝', 'RuNiuGan', '28.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('417', '10', '鸡油', 'JiYou', '32.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009106');
INSERT INTO `xjy_seller_menu` VALUES ('418', '10', '乳牛肝', 'RuNiuGan', '28.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009114');
INSERT INTO `xjy_seller_menu` VALUES ('419', '10', '竹荪', 'ZhuSun', '38.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967735');
INSERT INTO `xjy_seller_menu` VALUES ('420', '10', '猴头菇', 'HouTouGu', '32.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967751');
INSERT INTO `xjy_seller_menu` VALUES ('421', '10', '茶树菇', 'ChaShuGu', '16.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967743');
INSERT INTO `xjy_seller_menu` VALUES ('422', '10', '鸡腿菇', 'JiTuiGu', '16.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967773');
INSERT INTO `xjy_seller_menu` VALUES ('423', '10', '猪肚菇', 'ZhuDuGu', '16.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967780');
INSERT INTO `xjy_seller_menu` VALUES ('424', '10', '海鲜菇', 'HaiXianGu', '16.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967810');
INSERT INTO `xjy_seller_menu` VALUES ('425', '10', '滑菇', 'HuaGu', '32.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967816');
INSERT INTO `xjy_seller_menu` VALUES ('426', '10', '雪菇', 'XueGu', '18.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967788');
INSERT INTO `xjy_seller_menu` VALUES ('427', '10', '球盖菇', 'QiuGaiGu', '18.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967794');
INSERT INTO `xjy_seller_menu` VALUES ('428', '10', '羊肚菌', 'YangDuJun', '96.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967803');
INSERT INTO `xjy_seller_menu` VALUES ('429', '10', '羊肚菌', 'YangDuJun', '96.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528860435');
INSERT INTO `xjy_seller_menu` VALUES ('430', '10', '扇贝', 'ShanBei', '8.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '8/只', '0');
INSERT INTO `xjy_seller_menu` VALUES ('431', '10', '元贝', 'YuanBei', '12.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '（12/只）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('432', '10', '生蚝', 'ShengHao', '12.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '（12/只）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('433', '10', '青口', 'QingKou', '28.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('434', '10', '松茸', 'SongRong', '68.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967832');
INSERT INTO `xjy_seller_menu` VALUES ('435', '10', '带子', 'DaiZi', '16.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '（16/只）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('436', '10', '鸡枞', 'JiCong', '68.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967838');
INSERT INTO `xjy_seller_menu` VALUES ('437', '10', '大红虾', 'DaHongXia', '88.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '（88/只）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('438', '10', '美味牛肝', 'MeiWeiNiuGan', '38.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967843');
INSERT INTO `xjy_seller_menu` VALUES ('439', '10', '对虾', 'DuiXia', '68.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '（68/只）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('440', '10', '鱿鱼须', 'YouYuXu', '38.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('441', '10', '老人头', 'LaoRenTou', '38.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967959');
INSERT INTO `xjy_seller_menu` VALUES ('442', '10', '墨鱼仔', 'MoYuZi', '32.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('443', '10', '黄牛肝', 'HuangNiuGan', '38.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967943');
INSERT INTO `xjy_seller_menu` VALUES ('444', '10', '青扛', 'QingKang', '28.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967952');
INSERT INTO `xjy_seller_menu` VALUES ('445', '10', '鸡油', 'JiYou', '32.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967968');
INSERT INTO `xjy_seller_menu` VALUES ('446', '10', '乳牛肝', 'RuNiuGan', '28.00', '0.00', '2', '194', '1', '0.00', '0', '5', '', '', '1528967977');
INSERT INTO `xjy_seller_menu` VALUES ('447', '10', '山药', 'ShanYao', '8.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('448', '10', '功夫青笋片', 'GongFuQingSunPian', '9.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('449', '10', '功夫黄瓜片', 'GongFuHuangGuaPian', '9.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('450', '10', '藕片', 'OuPian', '8.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('451', '10', '海带', 'HaiDai', '8.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('452', '10', '金针菇', 'JinZhenGu', '8.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('453', '10', '西红柿', 'XiHongShi', '8.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('454', '10', '白萝卜', 'BaiLuoBu', '3.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('455', '10', '山药', 'ShanYao', '8.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('456', '10', '安岳苕粉', 'AnYueShaoFen', '8.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('457', '10', '功夫青笋片', 'GongFuQingSunPian', '9.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('458', '10', '鲜黄花', 'XianHuangHua', '15.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('459', '10', '功夫黄瓜片', 'GongFuHuangGuaPian', '9.00', '0.00', '2', '237', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('460', '10', '石磨豆腐', 'ShiMoDouFu', '10.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('461', '10', '茼蒿', 'TongGao', '12.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('462', '10', '土豆', 'TuDou', '5.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('463', '10', '藕片', 'OuPian', '8.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('464', '10', '生态甲鱼（生爆）', 'ShengTaiJiaYuShengBao', '168.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/7c1e825a95bd1cb9b91e7687f61634fc.jpg', '168一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('465', '10', '冬瓜', 'DongGua', '3.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('466', '10', '油麦菜', 'YouMaiCai', '6.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('467', '10', '海带', 'HaiDai', '8.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('468', '10', '黄豆芽', 'HuangDouYa', '5.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('469', '10', '金针菇', 'JinZhenGu', '8.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('470', '10', '鲜豆皮', 'XianDouPi', '6.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('471', '10', '西红柿', 'XiHongShi', '8.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('472', '10', '生态木耳', 'ShengTaiMuEr', '8.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('473', '10', '白萝卜', 'BaiLuoBu', '3.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('474', '10', '花菜', 'HuaCai', '6.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('475', '10', '安岳苕粉', 'AnYueShaoFen', '8.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('476', '10', '鲜黄花', 'XianHuangHua', '15.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('477', '10', '龙口粉丝', 'LongKouFenSi', '8.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('478', '10', '.娃娃菜', 'WaWaCai', '10.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('479', '10', '石磨豆腐', 'ShiMoDouFu', '10.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('480', '10', '海带苗', 'HaiDaiMiao', '12.00', '0.00', '2', '247', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('481', '10', '茼蒿', 'TongGao', '12.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('482', '10', '土豆', 'TuDou', '5.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('483', '10', '生态甲鱼（酱烧）', 'ShengTaiJiaYuJiangShao', '168.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/7c1e825a95bd1cb9b91e7687f61634fc.jpg', '168一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('484', '10', '冬瓜', 'DongGua', '3.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('485', '10', '油麦菜', 'YouMaiCai', '6.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('486', '10', '生态甲鱼（生焗）', 'ShengTaiJiaYuSheng', '168.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/7c1e825a95bd1cb9b91e7687f61634fc.jpg', '168一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('487', '10', '黄豆芽', 'HuangDouYa', '5.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('488', '10', '鲜豆皮', 'XianDouPi', '6.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('489', '10', '生态木耳', 'ShengTaiMuEr', '8.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('490', '10', '石斑鱼（清蒸）', 'ShiBanYuQingZheng', '168.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/2b384efc56d831df53b3e9ae586df757.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('491', '10', '花菜', 'HuaCai', '6.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('492', '10', '石斑鱼（过桥）', 'ShiBanYuGuoQiao', '168.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/2b384efc56d831df53b3e9ae586df757.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('493', '10', '龙口粉丝', 'LongKouFenSi', '8.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('494', '10', '娃娃菜', 'WaWaCai', '10.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('495', '10', '海带苗', 'HaiDaiMiao', '12.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('496', '10', '多宝鱼(清蒸)', 'DuoBaoYuQingZheng', '118.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/4eb049b628acfdbcfe2f7330186bc032.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('497', '10', '多宝鱼（干烧）', 'DuoBaoYuGanShao', '118.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/4eb049b628acfdbcfe2f7330186bc032.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('498', '10', '桂鱼（清蒸）', 'GuiYuQingZheng', '128.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/b06c1585e848b102fe9e07a1a54fd00d.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('499', '10', '桂鱼（干烧）', 'GuiYuGanShao', '128.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/b06c1585e848b102fe9e07a1a54fd00d.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('500', '10', '山图TU88', 'ShanTuTU88', '98.00', '0.00', '2', '254', '1', '0.00', '0', '5', 'admin/20180617/c66ac80c14824e01cc75bffaf13e50af.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('501', '10', '桂鱼（脆皮）', 'GuiYuCuiPi', '128.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/b06c1585e848b102fe9e07a1a54fd00d.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('502', '10', '山图TU188', 'ShanTuTU188', '138.00', '0.00', '2', '254', '1', '0.00', '0', '5', 'admin/20180617/c66ac80c14824e01cc75bffaf13e50af.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('503', '10', '鲈鱼（清蒸）', 'LuYuQingZheng', '78.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/9e68af8ec3423d9a528b894d9aabaae4.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('504', '10', '山图TU178', 'ShanTuTU178', '188.00', '0.00', '2', '254', '1', '0.00', '0', '5', 'admin/20180617/c66ac80c14824e01cc75bffaf13e50af.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('505', '10', '鲈鱼（酸菜）', 'LuYuSuanCai', '78.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/9e68af8ec3423d9a528b894d9aabaae4.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('506', '10', '山图TU218', 'ShanTuTU218', '238.00', '0.00', '2', '254', '1', '0.00', '0', '5', 'admin/20180617/a8ffe704e375878f0b88c87ae0ca1115.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('507', '10', '江团（清蒸）', 'JiangTuanQingZheng', '100.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/71ebd98c7539f1891052ceab49459c0b.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('508', '10', '五粮液', 'WuLiangYe', '950.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/3445c6eec76ced271ac3e35e4a5b219b.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('509', '10', '江团（泡椒）', 'JiangTuanPaoJiao', '100.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/71ebd98c7539f1891052ceab49459c0b.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('510', '10', '三角峰（水煮）', 'SanJiaoFengShuiZhu', '86.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/7b27cae869eab3672c4faad977e145a7.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('511', '10', '国窖1573', 'GuoJie1573', '850.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180616/5181135e34ac7c4ae87284662d1aa2c0.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('512', '10', '三角峰（红烧）', 'SanJiaoFengHongShao', '86.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/7b27cae869eab3672c4faad977e145a7.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('513', '10', '五粮春', 'WuLiangChun', '258.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/1013d3d1b3f9c164fd9148bb9651842f.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('514', '10', '大鲫鱼（泡椒）', 'DaJiYuPaoJiao', '87.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/d1147361c5dfecdac069bd29d3ecdeff.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('515', '10', '大鲫鱼（干烧）', 'DaJiYuGanShao', '87.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/d1147361c5dfecdac069bd29d3ecdeff.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('516', '10', '丰谷特曲（半斤）', 'FengGuTeQuBanJin', '98.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/2485b0f1a34e2537533d64841a328271.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('517', '10', '丰谷特曲', 'FengGuTeQu', '188.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/f7aa31392c5513a9c7c38741e0fcc187.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('518', '10', '五粮特曲精品', 'WuLiangTeQuJingPin', '288.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/ba29e11750d0ca72fabfab3eae717375.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('519', '10', '金剑南（K6)', 'JinJianNanK6', '218.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/723bcba5351e5e8ead55783e70687708.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('520', '10', '肉蟹（姜葱）', 'RouXieJiangCong', '89.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/3675c60503763ebd1763e5eae34ce143.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('521', '10', '复合莓', 'FuHeMei', '22.00', '0.00', '2', '252', '1', '0.00', '0', '5', '', '22一杯\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('522', '10', '剑南春', 'JianNanChun', '450.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/eccc6df776ae80fcf2130540e357e6b2.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('523', '10', '肉蟹（香辣）', 'RouXieXiangLa', '89.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/3675c60503763ebd1763e5eae34ce143.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('524', '10', '绵竹大曲', 'MianZhuDaQu', '40.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/49a46eb494301b717536011e147b7344.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('525', '10', '肉蟹（焗）', 'RouXie', '89.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/3675c60503763ebd1763e5eae34ce143.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('526', '10', '五歪嘴', 'WuWaiZui', '25.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/bb08650794aece2899be1d8ad4b0a709.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('527', '10', '青花蟹（姜葱）', 'QingHuaXieJiangCong', '8.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/0caec52ff6fa66fcb4f0e38021f467b1.jpg', '8元一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('528', '10', '小郎歪', 'XiaoLangWai', '20.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/92f4d0274cb4d59dbd7760460a1a6b04.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('529', '10', '江小白', 'JiangXiaoBai', '25.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/ba9a1cac7392abdfffbac14f657f022c.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('530', '10', '青花蟹（香辣）', 'QingHuaXieXiangLa', '8.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/0caec52ff6fa66fcb4f0e38021f467b1.jpg', '8元一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('531', '10', '二锅头', 'ErGuoTou', '8.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/dea3ade6bf6240dcde6c7227dd48ec52.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('532', '10', '青花蟹（焗）', 'QingHuaXie', '8.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/0caec52ff6fa66fcb4f0e38021f467b1.jpg', '8元一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('533', '10', '泸小二七彩', 'LuXiaoErQiCai', '32.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/5b3f6750149c21bef039afa7126f5a05.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('534', '10', '芒果百香', 'MangGuoBaiXiang', '22.00', '0.00', '2', '252', '1', '0.00', '0', '5', '', '22一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('535', '10', '泸小二', 'LuXiaoEr', '16.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/1c98e3f63627e0d06587e405f7c83aa7.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('536', '10', '红花蟹（姜葱）', 'HongHuaXieJiangCong', '0.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/b30de60b189e4f2c4695059e2de26078.jpg', '实价', '0');
INSERT INTO `xjy_seller_menu` VALUES ('537', '10', '红花蟹（焗）', 'HongHuaXie', '0.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/b30de60b189e4f2c4695059e2de26078.jpg', '实价', '0');
INSERT INTO `xjy_seller_menu` VALUES ('538', '10', '泸州柔顺', 'LuZhouRouShun', '88.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/f85a1caa4b49d26e44c85fe1527ed76e.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('539', '10', '蟹腿', 'XieTui', '0.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/ab65af53f886741527794e2bc0ebf372.jpg', '实价', '0');
INSERT INTO `xjy_seller_menu` VALUES ('540', '10', '梅子酒（150ml)', 'MeiZiJiu150ml', '22.00', '0.00', '2', '253', '1', '0.00', '0', '5', 'admin/20180617/33a180b3ab5302668e50e629eef73ffd.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('541', '10', '火龙果凤梨', 'HuoLongGuoFengLi', '22.00', '0.00', '2', '252', '1', '0.00', '0', '5', '', '22一杯    ', '0');
INSERT INTO `xjy_seller_menu` VALUES ('542', '10', '王老吉', 'WangLaoJi', '8.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/b20962d8074ad84570c8b46840c1d82e.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('543', '10', '帝王蟹（两吃）', 'DiWangXieLiangChi', '218.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/ed65a71d4326a90f3ccb7be4e360063c.jpg', '218一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('544', '10', '王老吉（无糖）', 'WangLaoJiWuTang', '10.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/f028237ed9e0d5d166986c5fed59d554.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('545', '10', '帝王蟹（浓汤）', 'DiWangXieNongTang', '218.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/ed65a71d4326a90f3ccb7be4e360063c.jpg', '218一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('546', '10', '拉可乐', 'LaKeLe', '6.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/897006d4e907f2297a768063e35b443b.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('547', '10', '帝王蟹（芙蓉）', 'DiWangXieFuRong', '218.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/ed65a71d4326a90f3ccb7be4e360063c.jpg', '218一斤', '0');
INSERT INTO `xjy_seller_menu` VALUES ('548', '10', '拉雪碧', 'LaXueBi', '6.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/f4b7733ef227415fa7d3ecc5a2f6009f.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('549', '10', '花鲢（水煮）', 'HuaLianShuiZhu', '68.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/900f16c722ee234f6c43574538cb1a53.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('550', '10', '花鲢（酸菜）', 'HuaLianSuanCai', '68.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/900f16c722ee234f6c43574538cb1a53.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('551', '10', '大鲜橙多（1.25L)', 'DaXianChengDuo125L', '10.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/65523740828beeaa22dcedd64d7b555f.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('552', '10', '西番蓮', 'XiFan', '15.00', '0.00', '2', '252', '1', '0.00', '0', '5', '', '15一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('553', '10', '花鲢（泡姜）', 'HuaLianPaoJiang', '68.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/900f16c722ee234f6c43574538cb1a53.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('554', '10', '大可乐（1.25L）', 'DaKeLe125L', '10.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/714b60b0f6d295de4fba419a5b7d9639.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('555', '10', '牛蛙（美蛙）（跳水）', 'NiuWaMeiWaTiaoShui', '78.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/0b6ab12ad12743a247faeb8e07338870.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('556', '10', '橙子', 'ChengZi', '11.00', '0.00', '2', '255', '1', '0.00', '0', '5', '', '11一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('557', '10', '恒大冰泉水', 'HengDaBingQuanShui', '5.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/b4a4032a89a6019696b8cf51f4007b5e.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('558', '10', '牛蛙（美蛙）（泡姜）', 'NiuWaMeiWaPaoJiang', '78.00', '0.00', '2', '249', '1', '0.00', '0', '5', 'admin/20180617/0b6ab12ad12743a247faeb8e07338870.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('559', '10', '芒果', 'MangGuo', '11.00', '0.00', '2', '255', '1', '0.00', '0', '5', '', '11一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('560', '10', '大唯一', 'DaWeiYi', '18.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/720a6b7520b4378f388257d199669b9c.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('561', '10', '小唯一', 'XiaoWeiYi', '5.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/6d4f80213423c54c980f6bfdf4be6b91.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('562', '10', '苹果醋', 'PingGuoCu', '28.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/d096a74cc6a743b6bcfe183a1b08abb4.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('563', '10', '红柚', 'HongYou', '11.00', '0.00', '2', '255', '1', '0.00', '0', '5', '', '11一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('564', '10', '酸角汁', 'SuanJiaoZhi', '7.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/803d863345b49368e9f39d74d5cfd975.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('565', '10', '火龙果', 'HuoLongGuo', '11.00', '0.00', '2', '255', '1', '0.00', '0', '5', '', '11一杯\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('566', '10', '新希望酸奶', 'XinXiWangSuanNai', '25.00', '0.00', '2', '251', '1', '0.00', '0', '5', 'admin/20180617/5d321b0ffc721e58133906d89e268039.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('567', '10', '勇闯', 'YongChuang', '8.00', '0.00', '2', '250', '1', '0.00', '0', '5', 'admin/20180616/76d9034961c97f243a7edaa1a30f556f.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('568', '10', '纯生', 'ChunSheng', '12.00', '0.00', '2', '250', '1', '0.00', '0', '5', 'admin/20180616/d3d065c9ea913a1348b90e26667248cb.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('569', '10', '红玉', 'HongYu', '17.00', '0.00', '2', '256', '1', '0.00', '0', '5', '', '17一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('570', '10', '茉莉', 'MoLi', '17.00', '0.00', '2', '256', '1', '0.00', '0', '5', '', '17一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('571', '10', '晶尊', 'JingZun', '15.00', '0.00', '2', '250', '1', '0.00', '0', '5', 'admin/20180617/82e826d415e32aaf236bd3248ed94944.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('572', '10', '花脸', 'HuaLian', '20.00', '0.00', '2', '250', '1', '0.00', '0', '5', 'admin/20180617/695cb0ba9880a1c6b1d508d508f03344.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('573', '10', '花旦', 'HuaDan', '20.00', '0.00', '2', '250', '1', '0.00', '0', '5', 'admin/20180617/7f4e9219ef8e9ad5b48d9e5a6122c632.jpg', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('574', '10', '金凤', 'JinFeng', '17.00', '0.00', '2', '256', '1', '0.00', '0', '5', '', '17一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('575', '10', '四季春', 'SiJiChun', '17.00', '0.00', '2', '256', '1', '0.00', '0', '5', '', '17一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('576', '10', '男神款', 'NanShenKuan', '13.00', '0.00', '2', '257', '1', '0.00', '0', '5', '', '13一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('577', '10', '女神款', 'NvShenKuan', '13.00', '0.00', '2', '257', '1', '0.00', '0', '5', '', '13一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('578', '10', '星空', 'XingKong', '10.00', '0.00', '2', '257', '1', '0.00', '0', '5', '', '10一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('579', '10', '蜜桃诱惑', 'MiTaoYouHuo', '27.00', '0.00', '2', '258', '1', '0.00', '0', '5', '', '27一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('580', '10', '荔枝戏乌龙', 'LiZhiXiWuLong', '25.00', '0.00', '2', '258', '1', '0.00', '0', '5', '', '25一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('581', '10', '洛神柠檬', 'LuoShenNinMeng', '22.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '22一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('582', '10', '混血儿肥牛', 'HunXueErFeiNiu', '30.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('583', '10', '混血儿肥牛', 'HunXueErFeiNiu', '30.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '1528965367');
INSERT INTO `xjy_seller_menu` VALUES ('584', '10', '刺身肥牛', 'CiShenFeiNiu', '58.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('585', '10', '桂花酷爽乐', 'GuiHuaKuShuangLe', '22.00', '0.00', '2', '258', '1', '0.00', '0', '5', '', '22一杯', '0');
INSERT INTO `xjy_seller_menu` VALUES ('586', '10', '精品羊肉卷', 'JingPinYangRouJuan', '26.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('587', '10', '刺身肥牛', 'CiShenFeiNiu', '58.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '1530010133');
INSERT INTO `xjy_seller_menu` VALUES ('588', '10', '相间肥牛王', 'XiangJianFeiNiuWang', '32.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('589', '10', '胶原肥牛', 'JiaoYuanFeiNiu', '28.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('590', '10', '混血儿肥牛', 'HunXueErFeiNiu', '30.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('591', '10', '安格斯牛小排', 'AnGeSiNiuXiaoPai', '48.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('592', '10', '青瓜优益C', 'QingGuaYouYiC', '11.00', '0.00', '2', '259', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('593', '10', '眼肉肥牛', 'YanRouFeiNiu', '32.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('594', '10', '刺身肥牛', 'CiShenFeiNiu', '58.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('595', '10', '巨无霸雪花肥牛', 'JuWuBaXueHuaFeiNiu', '30.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('596', '10', '鸿运当头', 'HongYunDangTou', '11.00', '0.00', '2', '259', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('597', '10', '精品羊肉卷', 'JingPinYangRouJuan', '26.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('598', '10', '巨无霸雪花肥牛', 'JuWuBaXueHuaFeiNiu', '30.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '1528965390');
INSERT INTO `xjy_seller_menu` VALUES ('599', '10', '相间肥牛王', 'XiangJianFeiNiuWang', '32.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('600', '10', '金桔柠檬', 'JinJieNinMeng', '11.00', '0.00', '2', '259', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('601', '10', '胶原肥牛', 'JiaoYuanFeiNiu', '28.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('602', '10', '金桔百香', 'JinJieBaiXiang', '11.00', '0.00', '2', '259', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('603', '10', '安格斯牛小排', 'AnGeSiNiuXiaoPai', '48.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('604', '10', '眼肉肥牛', 'YanRouFeiNiu', '32.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('605', '10', '巨无霸雪花肥牛', 'JuWuBaXueHuaFeiNiu', '30.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('606', '10', '串烧肥牛', 'ChuanShaoFeiNiu', '26.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('607', '10', '精品肥牛卷', 'JingPinFeiNiuJuan', '24.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('608', '10', '红菲冰酿奶茶', 'HongFeiBingNiangNaiCha', '13.00', '0.00', '2', '260', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('609', '10', '上脑肥牛', 'ShangNaoFeiNiu', '36.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('610', '10', '红豆奶茶', 'HongDouNaiCha', '13.00', '0.00', '2', '260', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('611', '10', '台式奶茶', 'TaiShiNaiCha', '13.00', '0.00', '2', '260', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('612', '10', '串烧肥牛', 'ChuanShaoFeiNiu', '26.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('613', '10', '上脑肥牛', 'ShangNaoFeiNiu', '36.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '1530010150');
INSERT INTO `xjy_seller_menu` VALUES ('614', '10', '田园小肥鹅', 'TianYuanXiaoFeiE', '32.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('615', '10', '精品肥牛卷', 'JingPinFeiNiuJuan', '24.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('616', '10', '上脑肥牛', 'ShangNaoFeiNiu', '36.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('617', '10', '田园小肥鹅', 'TianYuanXiaoFeiE', '32.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('618', '10', '精品牛舌', 'JingPinNiuShe', '26.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('619', '10', '精品牛舌', 'JingPinNiuShe', '26.00', '0.00', '2', '261', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('620', '10', '精品牛舌', 'JingPinNiuShe', '26.00', '0.00', '2', '262', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('621', '10', '屠场直供鲜牛毛肚', 'TuChangZhiGongXianNiuMaoDu', '88.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('622', '10', '屠场直供鲜牛黄喉', 'TuChangZhiGongXianNiuHuangHou', '28.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('623', '10', '麻辣霸王鲜牛肉', 'MaLaBaWangXianNiuRou', '28.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('624', '10', '屠场直供鲜兔肚', 'TuChangZhiGongXianTuDu', '22.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('625', '10', '极品千层肚', 'JiPinQianCengDu', '28.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('626', '10', '冰川鲜鹅肠', 'BingChuanXianEChang', '28.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('627', '10', '屠场直供鲜牛蹄筋', 'TuChangZhiGongXianNiuTiJin', '26.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('628', '10', '生扣鸭肠', 'ShengKouYaChang', '20.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('629', '10', '肥肠节子', 'FeiChangJieZi', '28.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('630', '10', '关公大刀腰片', 'GuanGongDaDaoYaoPian', '32.00', '0.00', '2', '263', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('631', '10', '屠场直供鲜牛毛肚', 'TuChangZhiGongXianNiuMaoDu', '88.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('632', '10', '屠场直供鲜牛黄喉', 'TuChangZhiGongXianNiuHuangHou', '28.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('633', '10', '手工鲜牛肉滑', 'ShouGongXianNiuRouHua', '28.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('634', '10', '手工虾滑', 'ShouGongXiaHua', '28.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('635', '10', '麻辣霸王鲜牛肉', 'MaLaBaWangXianNiuRou', '28.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('636', '10', '屠场直供鲜兔肚', 'TuChangZhiGongXianTuDu', '22.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('637', '10', '秘制麻辣排骨', 'MiZhiMaLaPaiGu', '28.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('638', '10', '山椒牛肉', 'ShanJiaoNiuRou', '26.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('639', '10', '现杀土鳝鱼', 'XianShaTuShanYu', '38.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('640', '10', '贵妃牛肉', 'GuiFeiNiuRou', '26.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('641', '10', '极品千层肚', 'JiPinQianCengDu', '28.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('642', '10', '冰川鲜鹅肠', 'BingChuanXianEChang', '28.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('643', '10', '手工香菜圆子', 'ShouGongXiangCaiYuanZi', '20.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '1528967175');
INSERT INTO `xjy_seller_menu` VALUES ('644', '10', '屠场直供鲜牛蹄筋', 'TuChangZhiGongXianNiuTiJin', '26.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('645', '10', '手工香菜圆子', 'ShouGongXiangCaiYuanZi', '20.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('646', '10', '生扣鸭肠', 'ShengKouYaChang', '20.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('647', '10', '天香肥肠', 'TianXiangFeiChang', '26.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('648', '10', '肥肠节子', 'FeiChangJieZi', '28.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('649', '10', '现杀黄辣丁', 'XianShaHuangLaDing', '26.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('650', '10', '关公大刀腰片', 'GuanGongDaDaoYaoPian', '32.00', '0.00', '2', '264', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('651', '10', '现杀泥鳅', 'XianShaNiQiu', '26.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('652', '10', '鲜猪黄喉', 'XianZhuHuangHou', '28.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('653', '10', '手工鲜牛肉滑', 'ShouGongXianNiuRouHua', '28.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('654', '10', '手工虾滑', 'ShouGongXiaHua', '28.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('655', '10', '秘制麻辣排骨', 'MiZhiMaLaPaiGu', '28.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('656', '10', '山椒牛肉', 'ShanJiaoNiuRou', '26.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('657', '10', '现杀土鳝鱼', 'XianShaTuShanYu', '38.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('658', '10', '耙牛肉', 'BaNiuRou', '28.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('659', '10', '手工香菜圆子', 'ShouGongXiangCaiYuanZi', '20.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('660', '10', '贵妃牛肉', 'GuiFeiNiuRou', '26.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('661', '10', '天香肥肠', 'TianXiangFeiChang', '26.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('662', '10', '现杀黄辣丁', 'XianShaHuangLaDing', '26.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('663', '10', '现杀泥鳅', 'XianShaNiQiu', '26.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('664', '10', '鲜猪黄喉', 'XianZhuHuangHou', '28.00', '0.00', '2', '266', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('665', '10', '竹荪', 'ZhuSun', '38.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('666', '10', '猴头菇', 'HouTouGu', '32.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('667', '10', '茶树菇', 'ChaShuGu', '16.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('668', '10', '鸡腿菇', 'JiTuiGu', '16.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('669', '10', '竹荪', 'ZhuSun', '38.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('670', '10', '猴头菇', 'HouTouGu', '32.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('671', '10', '猪肚菇', 'ZhuDuGu', '16.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('672', '10', '茶树菇', 'ChaShuGu', '16.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '1528967876');
INSERT INTO `xjy_seller_menu` VALUES ('673', '10', '海鲜菇', 'HaiXianGu', '16.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('674', '10', '鸡腿菇', 'JiTuiGu', '16.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('675', '10', '滑菇', 'HuaGu', '22.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('676', '10', '雪菇', 'XueGu', '18.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('677', '10', '猪肚菇', 'ZhuDuGu', '16.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('678', '10', '球盖菇', 'QiuGaiGu', '18.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('679', '10', '海鲜菇', 'HaiXianGu', '16.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('680', '10', '滑菇', 'HuaGu', '22.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('681', '10', '羊肚菌', 'YangDuJun', '96.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('682', '10', '雪菇', 'XueGu', '18.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('683', '10', '松茸', 'SongRong', '68.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('684', '10', '球盖菇', 'QiuGaiGu', '18.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('685', '10', '鸡枞', 'JiCong', '68.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('686', '10', '羊肚菌', 'YangDuJun', '96.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('687', '10', '美味牛肝', 'MeiWeiNiuGan', '38.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('688', '10', '松茸', 'SongRong', '68.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('689', '10', '老人头', 'LaoRenTou', '38.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('690', '10', '黄牛肝', 'HuangNiuGan', '38.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('691', '10', '青杠', 'QingGong', '28.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('692', '10', '鸡枞', 'JiCong', '68.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('693', '10', '鸡油', 'JiYou', '32.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('694', '10', '美味牛肝', 'MeiWeiNiuGan', '38.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('695', '10', '乳牛肝', 'RuNiuGan', '28.00', '0.00', '2', '267', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('696', '10', '老人头', 'LaoRenTou', '38.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('697', '10', '黄牛肝', 'HuangNiuGan', '38.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('698', '10', '竹荪', 'ZhuSun', '38.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('699', '10', '青杠', 'QingGong', '28.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('700', '10', '猴头菇', 'HouTouGu', '32.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('701', '10', '鸡油', 'JiYou', '32.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('702', '10', '茶树菇', 'ChaShuGu', '16.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('703', '10', '乳牛肝', 'RuNiuGan', '28.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('704', '10', '鸡腿菇', 'JiTuiGu', '16.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('705', '10', '雪菇', 'XueGu', '18.00', '0.00', '2', '193', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('706', '10', '猪肚菇', 'ZhuDuGu', '16.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('707', '10', '海鲜菇', 'HaiXianGu', '16.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('708', '10', '滑菇', 'HuaGu', '22.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('709', '10', '雪菇', 'XueGu', '18.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('710', '10', '球盖菇', 'QiuGaiGu', '18.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('711', '10', '羊肚菌', 'YangDuJun', '96.00', '0.00', '2', '195', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('712', '10', '松茸', 'SongRong', '68.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('713', '10', '鸡枞', 'JiCong', '68.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('714', '10', '美味牛肝', 'MeiWeiNiuGan', '38.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('715', '10', '老人头', 'LaoRenTou', '38.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('716', '10', '黄牛肝', 'HuangNiuGan', '38.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('717', '10', '青杠', 'QingGong', '28.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('718', '10', '鸡油', 'JiYou', '32.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('719', '10', '乳牛肝', 'RuNiuGan', '28.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('720', '10', '渣海椒回锅肉', 'ZhaHaiJiaoHuiGuoRou', '38.00', '0.00', '2', '270', '1', '0.00', '0', '5', '', '微酸，微辣', '0');
INSERT INTO `xjy_seller_menu` VALUES ('721', '10', '土家腊肉（渣海椒，蕨粑）', 'TuJiaLaRouZhaHaiJiaoJueBa', '68.00', '0.00', '2', '270', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('722', '10', '锅仔油渣菜豆腐', 'GuoZiYouZhaCaiDouFu', '38.00', '0.00', '2', '270', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('723', '10', '土家罐海椒', 'TuJiaGuanHaiJiao', '38.00', '0.00', '2', '270', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('724', '10', '小米辣炒牛肉', 'XiaoMiLaChaoNiuRou', '58.00', '0.00', '2', '270', '1', '0.00', '0', '5', '', '微酸辣味', '0');
INSERT INTO `xjy_seller_menu` VALUES ('725', '10', '青菜牛肉', 'QingCaiNiuRou', '48.00', '0.00', '2', '270', '1', '0.00', '0', '5', '', '青香泡椒味', '0');
INSERT INTO `xjy_seller_menu` VALUES ('726', '10', '川香小炒肉', 'ChuanXiangXiaoChaoRou', '38.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('727', '10', '石锅老豆腐', 'ShiGuoLaoDouFu', '38.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('728', '10', '宫廷红烧肉', 'GongTingHongShaoRou', '48.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('729', '10', '水煮牛里脊', 'ShuiZhuNiuLiJi', '38.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('730', '10', '歌乐山辣子鸡', 'GeLeShanLaZiJi', '88.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('731', '10', '冰镇芥兰', 'BingZhenJieLan', '28.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('732', '10', '养身萝卜', 'YangShenLuoBu', '26.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('733', '10', '上汤芥菜', 'ShangTangJieCai', '28.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('734', '10', '芽菜炒菜心', 'YaCaiChaoCaiXin', '26.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('735', '10', '茄子爱尚豇豆', 'QieZiAiShangJiangDou', '28.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('736', '10', '翅汤芥菜', 'ChiTangJieCai', '28.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('737', '10', '豆汤肚条', 'DouTangDuTiao', '58.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('738', '10', '奶油烩时蔬', 'NaiYouHuiShiShu', '28.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('739', '10', '炒时蔬', 'ChaoShiShu', '22.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('740', '10', '芽菜炒菜心', 'YaCaiChaoCaiXin', '26.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('741', '10', '勇闯', 'YongChuang', '8.00', '0.00', '2', '271', '1', '0.00', '0', '5', 'http://wx.ccapp.com.cn/upload/admin/20180616/76d9034961c97f243a7edaa1a30f556f.jpg', '', '1530011662');
INSERT INTO `xjy_seller_menu` VALUES ('742', '10', '武陵山珍锅《大》', 'WuLingShanZhenGuoDa', '48.00', '0.00', '2', '197', '1', '0.00', '0', '5', '', '', '1530009162');
INSERT INTO `xjy_seller_menu` VALUES ('743', '10', '白米饭（桶）', 'BaiMiFanTong', '8.00', '0.00', '2', '272', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('744', '10', '套餐', 'TaoCan', '998.00', '0.00', '2', '273', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('745', '10', '餐损', 'CanSun', '10.00', '0.00', '2', '274', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('746', '10', '套餐', 'TaoCan', '998.00', '0.00', '2', '275', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('747', '10', '餐损', 'CanSun', '10.00', '0.00', '2', '276', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('748', '10', '软中', 'RuanZhong', '80.00', '0.00', '2', '209', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('749', '10', '软云', 'RuanYun', '30.00', '0.00', '2', '209', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('750', '10', '干锅耙鸡脚（小）', 'GanGuoBaJiJiaoXiao', '68.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('751', '10', '干锅耙鸡脚（大）', 'GanGuoBaJiJiaoDa', '108.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('752', '10', '干锅排骨(小）', 'GanGuoPaiGuXiao', '58.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('753', '10', '干锅排骨（大）', 'GanGuoPaiGuDa', '98.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('754', '10', '干锅仔兔（小）', 'GanGuoZiTuXiao', '68.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('755', '10', '干锅仔兔(大）', 'GanGuoZiTuDa', '98.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('756', '10', '风味钵钵鸡', 'FengWeiBoBoJi', '38.00', '0.00', '2', '210', '1', '0.00', '0', '5', '', '（藤椒）（大份）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('757', '10', '干锅鸡杂（小）', 'GanGuoJiZaXiao', '58.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('758', '10', '风味钵钵鸡', 'FengWeiBoBoJi', '22.00', '0.00', '2', '210', '1', '0.00', '0', '5', '', '（藤椒）（小份）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('759', '10', '干锅鸡杂（大）', 'GanGuoJiZaDa', '88.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('760', '10', '干锅爬爬虾（小）', 'GanGuoPaPaXiaXiao', '98.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('761', '10', '干锅爬爬虾（大）', 'GanGuoPaPaXiaDa', '168.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('762', '10', '风味钵钵鸡', 'FengWeiBoBoJi', '38.00', '0.00', '2', '210', '1', '0.00', '0', '5', '', '（红油）（大份）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('763', '10', '干锅海鲜什锦（小）', 'GanGuoHaiXianShiJinXiao', '98.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('764', '10', '干锅海鲜什锦（大）', 'GanGuoHaiXianShiJinDa', '168.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('765', '10', '干锅鱿鱼须（小）', 'GanGuoYouYuXuXiao', '68.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('766', '10', '干锅鱿鱼须（大）', 'GanGuoYouYuXuDa', '108.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('767', '10', '风味钵钵鸡', 'FengWeiBoBoJi', '22.00', '0.00', '2', '210', '1', '0.00', '0', '5', '', '（红油）（小份）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('768', '10', '风味酱香春卷', 'FengWeiJiangXiangChunJuan', '18.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '（18/半打）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('769', '10', '酸辣粉', 'SuanLaFen', '6.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('770', '10', '山珍乌鸡锅', 'ShanZhenWuJiGuo', '16.00', '0.00', '2', '278', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('771', '10', '山珍乳鸽锅', 'ShanZhenRuGeGuo', '19.00', '0.00', '2', '278', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('772', '10', '武陵山珍锅', 'WuLingShanZhenGuo', '12.00', '0.00', '2', '278', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('773', '10', '山珍排骨锅', 'ShanZhenPaiGuGuo', '17.00', '0.00', '2', '278', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('774', '10', '原味海鲜锅', 'YuanWeiHaiXianGuo', '17.00', '0.00', '2', '279', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('775', '10', '生态甲鱼锅', 'ShengTaiJiaYuGuo', '27.00', '0.00', '2', '279', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('776', '10', '海鲜秘制红锅', 'HaiXianMiZhiHongGuo', '17.00', '0.00', '2', '279', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('777', '10', '筷子', 'KuaiZi', '1.00', '0.00', '2', '281', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('778', '10', '湿巾纸', 'ShiJinZhi', '2.00', '0.00', '2', '280', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('779', '10', '米饭（桶）', 'MiFanTong', '8.00', '0.00', '2', '282', '1', '0.00', '0', '5', '', '（一桶）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('780', '10', '洛神柠檬', 'LuoShenNinMeng', '22.00', '0.00', '2', '258', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('781', '10', '干锅爬爬虾（大）', 'GanGuoPaPaXiaDa', '168.00', '0.00', '2', '277', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('782', '10', '羊肚菌', 'YangDuJun', '96.00', '0.00', '2', '269', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('783', '10', '鲜卤拼盘', 'XianLuPinPan', '87.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '(87例)', '0');
INSERT INTO `xjy_seller_menu` VALUES ('784', '10', '三文鱼', 'SanWenYu', '77.00', '0.00', '2', '283', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('785', '10', '北极贝', 'BeiJiBei', '77.00', '0.00', '2', '283', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('786', '10', '金枪鱼（红色）', 'JinQiangYuHongSe', '77.00', '0.00', '2', '283', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('787', '10', '金枪鱼（白色）', 'JinQiangYuBaiSe', '77.00', '0.00', '2', '283', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('788', '10', '刺身拼盘', 'CiShenPinPan', '127.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '（127例）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('789', '10', '功夫黄瓜片', 'GongFuHuangGuaPian', '9.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('790', '10', '安岳苕粉', 'AnYueShaoFen', '8.00', '0.00', '2', '248', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('791', '10', '耙牛肉', 'BaNiuRou', '28.00', '0.00', '2', '265', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('792', '10', '功夫养生汤', 'GongFuYangShengTang', '28.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（28/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('793', '10', '海带', 'HaiDai', '8.00', '0.00', '2', '202', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('794', '10', '茶树菇', 'ChaShuGu', '16.00', '0.00', '2', '268', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('795', '10', '松茸炖鸡', 'SongRongDunJi', '28.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（28/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('796', '10', '雪梨炖排骨', 'XueLiDunPaiGu', '22.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（22/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('797', '10', '天麻炖乳鸽', 'TianMaDunRuGe', '48.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（48/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('798', '10', '清炖松茸', 'QingDunSongRong', '18.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（18/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('799', '10', '开水白菜', 'KaiShuiBaiCai', '18.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（18/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('800', '10', '泉水炖桃胶', 'QuanShuiDunTaoJiao', '18.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（18/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('801', '10', '清炖狮子头', 'QingDunShiZiTou', '28.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（28/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('802', '10', '竹荪炖菜胆', 'ZhuSunDunCaiDan', '18.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（18/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('803', '10', '山珍鲜菌汤', 'ShanZhenXianJunTang', '18.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（18/位）或（48例）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('804', '10', '酸萝卜老鸭汤', 'SuanLuoBuLaoYaTang', '48.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('805', '10', '棒骨杂粮汤', 'BangGuZaLiangTang', '48.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('806', '10', '豌豆炖猪手', 'WanDouDunZhuShou', '48.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('807', '10', '鲜菌炖老鸡', 'XianJunDunLaoJi', '48.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('808', '10', '绿豆排骨汤', 'LvDouPaiGuTang', '48.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('809', '10', '小米辽参', 'XiaoMiLiaoCan', '68.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（68/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('810', '10', '松茸捞饭', 'SongRongLaoFan', '58.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '（58/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('811', '10', '木瓜炖雪蛤(桃胶)', 'MuGuaDunXueGaTaoJiao', '48.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（48/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('812', '10', '金瓜鸡豆花', 'JinGuaJiDouHua', '26.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（26/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('813', '10', '松茸捞饭', 'SongRongLaoFan', '58.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '（58/位）', '0');
INSERT INTO `xjy_seller_menu` VALUES ('814', '10', '红花蟹（香辣）', 'HongHuaXieXiangLa', '0.00', '0.00', '2', '249', '1', '0.00', '0', '5', '', '实价', '0');
INSERT INTO `xjy_seller_menu` VALUES ('815', '10', '青椒土豆丝', 'QingJiaoTuDouSi', '18.00', '0.00', '2', '235', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('816', '10', '折耳根拌胡豆', 'ZheErGenBanHuDou', '22.00', '0.00', '2', '181', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('817', '10', '西红柿煎蛋汤', 'XiHongShiJianDanTang', '16.00', '0.00', '2', '284', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('818', '10', '米饭（碗）', 'MiFanWan', '1.00', '0.00', '2', '282', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('819', '10', '特殊套餐', 'TeShuTaoCan', '1281.00', '0.00', '2', '286', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('820', '10', '龙抄手（中）', 'LongChaoShouZhong', '12.00', '0.00', '2', '179', '1', '0.00', '0', '5', '', '12/中份\r\n', '0');
INSERT INTO `xjy_seller_menu` VALUES ('821', '10', '龙抄手（中）', 'LongChaoShouZhong', '12.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '12/中份', '0');
INSERT INTO `xjy_seller_menu` VALUES ('822', '10', '龙抄手（大）', 'LongChaoShouDa', '18.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '18/大份', '0');
INSERT INTO `xjy_seller_menu` VALUES ('823', '10', '担担面（中）', 'DanDanMianZhong', '12.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '12/中份', '0');
INSERT INTO `xjy_seller_menu` VALUES ('824', '10', '担担面（大）', 'DanDanMianDa', '18.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '18/大份', '0');
INSERT INTO `xjy_seller_menu` VALUES ('825', '10', '钟水饺（小）', 'ZhongShuiJiaoXiao', '6.00', '0.00', '2', '205', '1', '0.00', '0', '5', '', '钟水饺6/小份', '0');
INSERT INTO `xjy_seller_menu` VALUES ('826', '10', '钟水饺', 'ZhongShuiJiao', '12.00', '0.00', '2', '205', '1', '0.00', '0', '5', '', '钟水饺12/中份', '0');
INSERT INTO `xjy_seller_menu` VALUES ('827', '10', '钟水饺（大份）', 'ZhongShuiJiaoDaFen', '18.00', '0.00', '2', '205', '1', '0.00', '0', '5', '', '钟水饺18/大份', '0');
INSERT INTO `xjy_seller_menu` VALUES ('828', '10', '酸汤肥牛', 'SuanTangFeiNiu', '58.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('829', '10', '泡椒土豆丝', 'PaoJiaoTuDouSi', '18.00', '0.00', '2', '187', '1', '0.00', '0', '5', '', '', '0');
INSERT INTO `xjy_seller_menu` VALUES ('830', '10', '钟水饺', 'ZhongShuiJiao', '18.00', '0.00', '2', '212', '1', '0.00', '0', '5', '', '钟水饺/大份', '0');

-- ----------------------------
-- Table structure for xjy_seller_reserve
-- ----------------------------
DROP TABLE IF EXISTS `xjy_seller_reserve`;
CREATE TABLE `xjy_seller_reserve` (
  `id` varchar(30) NOT NULL COMMENT '订单ID号 对应order_id',
  `user_id` varchar(50) NOT NULL DEFAULT '' COMMENT '预定第三方用户OpenID',
  `seller_id` bigint(20) unsigned NOT NULL COMMENT '被预定商家',
  `user_nub` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '就餐人数',
  `table_nub` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '预定餐桌数',
  `reserve_time` int(11) unsigned NOT NULL COMMENT '预定时间',
  `seller_confirm` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '商家是否确认 1:未确认;2:确认;3:拒绝',
  `complete` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '预约是否完成 1:未完成;2:完成;3:商家违约;4:用户违约',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '订餐人电话',
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '预订人昵称',
  `reserve_class` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '预定餐桌类型 对应餐桌表id',
  `menu_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '服务厅id',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家预定信息';

-- ----------------------------
-- Records of xjy_seller_reserve
-- ----------------------------
INSERT INTO `xjy_seller_reserve` VALUES ('2018062810185299565753', '47', '10', '0', '0', '1530197818', '1', '1', '', '', '2', '179');
INSERT INTO `xjy_seller_reserve` VALUES ('2018062820471955991004', '10', '10', '0', '0', '1530197848', '1', '1', '', '', '2', '195');

-- ----------------------------
-- Table structure for xjy_seller_table
-- ----------------------------
DROP TABLE IF EXISTS `xjy_seller_table`;
CREATE TABLE `xjy_seller_table` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '餐桌id 自增主键',
  `seller_id` bigint(20) unsigned NOT NULL COMMENT '商家ID',
  `table_name` varchar(30) NOT NULL DEFAULT '' COMMENT '餐桌类型名称',
  `table_describe` varchar(255) NOT NULL DEFAULT '' COMMENT '商家对餐桌的描述',
  `delete_time` smallint(6) NOT NULL DEFAULT '0' COMMENT '是否删除 0:未删除;1:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xjy_seller_table
-- ----------------------------
INSERT INTO `xjy_seller_table` VALUES ('1', '10', '圆桌10人位', '适合10人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('2', '10', '方桌四人位', '适合4人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('3', '10', '豪包-梦幻里', '豪包-梦幻里', '0');
INSERT INTO `xjy_seller_table` VALUES ('4', '10', '豪包-星月里', '豪包-星月里', '0');
INSERT INTO `xjy_seller_table` VALUES ('5', '10', '豪包-和顺里', '豪包-和顺里', '0');
INSERT INTO `xjy_seller_table` VALUES ('6', '10', '豪包-时光里', '豪包-时光里', '0');
INSERT INTO `xjy_seller_table` VALUES ('7', '10', '圆桌8人位', '圆桌8人位 （干锅）', '0');
INSERT INTO `xjy_seller_table` VALUES ('8', '10', '圆桌8人位', '圆桌8人位 （干锅）', '0');
INSERT INTO `xjy_seller_table` VALUES ('9', '10', '方桌四人位', '方桌四人位 （干锅）', '0');
INSERT INTO `xjy_seller_table` VALUES ('10', '10', '圆桌8人位（汤锅）', '适合八人一起用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('11', '10', '方桌四人座（汤锅）', '适合四人一起吃', '0');
INSERT INTO `xjy_seller_table` VALUES ('12', '10', '长方形四人位（汤锅）', '适合四人一起吃饭', '0');
INSERT INTO `xjy_seller_table` VALUES ('13', '10', '四人位（山珍）', '适合四人一起用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('14', '10', '6人位（山珍）', '适合六人一起用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('15', '10', '八人位（山珍）', '适合8人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('16', '10', '四人位（海味）', '适合四人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('17', '10', '六人位（海味）', '适合六人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('18', '10', '四人位（串串）', '适合四人一起用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('19', '10', '四人桌（烧烤）', '适合七人一同用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('20', '10', '四人位（茶楼）', '适合四人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('21', '10', '六人位（茶楼）', '适合六人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('22', '10', '八人圆桌（火锅）', '适合八人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('23', '10', '十二人连桌（火锅）', '适合12人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('24', '10', '四人长方形桌（火锅）', '适合四人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('25', '10', '四人正方形桌（火锅）', '适合四人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('26', '10', '包间-V伍伍', 'V伍伍', '0');
INSERT INTO `xjy_seller_table` VALUES ('27', '10', '包间-V陆陆', '包间-V陆陆', '0');
INSERT INTO `xjy_seller_table` VALUES ('28', '10', '包间-V柒柒', '包间-V柒柒', '0');
INSERT INTO `xjy_seller_table` VALUES ('29', '10', '包间-V捌捌', '包间-V捌捌', '0');
INSERT INTO `xjy_seller_table` VALUES ('30', '10', '包间-V玖玖', '包间-V玖玖', '0');
INSERT INTO `xjy_seller_table` VALUES ('31', '10', '二人位（小吃）', '适合二人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('32', '10', '四人位（小吃）', '适合四人用餐', '0');
INSERT INTO `xjy_seller_table` VALUES ('33', '10', '1', '', '0');

-- ----------------------------
-- Table structure for xjy_slide
-- ----------------------------
DROP TABLE IF EXISTS `xjy_slide`;
CREATE TABLE `xjy_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:显示,0不显示',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '幻灯片分类',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '分类备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='幻灯片表';

-- ----------------------------
-- Records of xjy_slide
-- ----------------------------
INSERT INTO `xjy_slide` VALUES ('1', '1', '0', '首页幻灯片', '');

-- ----------------------------
-- Table structure for xjy_slide_item
-- ----------------------------
DROP TABLE IF EXISTS `xjy_slide_item`;
CREATE TABLE `xjy_slide_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL DEFAULT '0' COMMENT '幻灯片id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:显示;0:隐藏',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '幻灯片名称',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '幻灯片图片',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '幻灯片链接',
  `target` varchar(10) NOT NULL DEFAULT '' COMMENT '友情链接打开方式',
  `description` varchar(255) NOT NULL COMMENT '幻灯片描述',
  `content` text COMMENT '幻灯片内容',
  `more` text COMMENT '链接打开方式',
  PRIMARY KEY (`id`),
  KEY `slide_cid` (`slide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='幻灯片子项表';

-- ----------------------------
-- Records of xjy_slide_item
-- ----------------------------
INSERT INTO `xjy_slide_item` VALUES ('1', '1', '1', '10000', '鬼吹灯之黄皮子坟', 'http://www.cloudcooer.com/upload/vod/2017-08-16/201708161502852877.jpg', 'http://www.cloudcooer.com/?m=vod-detail-id-123712.html', '', '', '《鬼吹灯之牧野诡事2》\r\n王大陆 金晨 王大陆 金晨 ', null);

-- ----------------------------
-- Table structure for xjy_sum_count
-- ----------------------------
DROP TABLE IF EXISTS `xjy_sum_count`;
CREATE TABLE `xjy_sum_count` (
  `count_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '统计自增ID',
  `menu_id` int(20) NOT NULL COMMENT '服务厅id',
  `seller_id` bigint(20) unsigned NOT NULL COMMENT '需统计的商家ID',
  `count_time` int(11) NOT NULL COMMENT '统计日期（同一天金额相加）',
  `count_sum` int(15) unsigned NOT NULL DEFAULT '0' COMMENT '当天营业额',
  `count_num` int(15) NOT NULL DEFAULT '0' COMMENT '当天销售单量',
  PRIMARY KEY (`count_id`),
  KEY `seller_id+time` (`seller_id`,`count_time`),
  KEY `seller_id` (`seller_id`),
  KEY `count_time` (`count_time`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='营业额统计';

-- ----------------------------
-- Records of xjy_sum_count
-- ----------------------------
INSERT INTO `xjy_sum_count` VALUES ('1', '179', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('2', '180', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('3', '184', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('4', '195', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('5', '198', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('6', '200', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('7', '203', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('8', '204', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('9', '205', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('10', '206', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('11', '207', '10', '1529960309', '0', '0');
INSERT INTO `xjy_sum_count` VALUES ('12', '179', '10', '1530150996', '222', '3');
INSERT INTO `xjy_sum_count` VALUES ('13', '195', '10', '1530150996', '23', '1');
INSERT INTO `xjy_sum_count` VALUES ('14', '198', '10', '1530150996', '149', '1');
INSERT INTO `xjy_sum_count` VALUES ('15', '200', '10', '1530150996', '66', '2');
INSERT INTO `xjy_sum_count` VALUES ('16', '205', '10', '1530150996', '152', '1');
INSERT INTO `xjy_sum_count` VALUES ('17', '206', '10', '1530150996', '84', '1');
INSERT INTO `xjy_sum_count` VALUES ('18', '207', '10', '1530150996', '62', '1');

-- ----------------------------
-- Table structure for xjy_theme
-- ----------------------------
DROP TABLE IF EXISTS `xjy_theme`;
CREATE TABLE `xjy_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后升级时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '模板状态,1:正在使用;0:未使用',
  `is_compiled` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为已编译模板',
  `theme` varchar(20) NOT NULL DEFAULT '' COMMENT '主题目录名，用于主题的维一标识',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '主题名称',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '主题版本号',
  `demo_url` varchar(50) NOT NULL DEFAULT '' COMMENT '演示地址，带协议',
  `thumbnail` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `author` varchar(20) NOT NULL DEFAULT '' COMMENT '主题作者',
  `author_url` varchar(50) NOT NULL DEFAULT '' COMMENT '作者网站链接',
  `lang` varchar(10) NOT NULL DEFAULT '' COMMENT '支持语言',
  `keywords` varchar(50) NOT NULL DEFAULT '' COMMENT '主题关键字',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '主题描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xjy_theme
-- ----------------------------
INSERT INTO `xjy_theme` VALUES ('22', '0', '0', '0', '0', 'video_tpl', 'video_tpl', '1.0.0', 'http://ccapp.com.cn', '', 'YunJiu', 'http://ccapp.com.cn', 'zh-cn', 'YunJiuCMS视频模板', 'YunJiuCMS默认视频模板');

-- ----------------------------
-- Table structure for xjy_theme_file
-- ----------------------------
DROP TABLE IF EXISTS `xjy_theme_file`;
CREATE TABLE `xjy_theme_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_public` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否公共的模板文件',
  `list_order` float NOT NULL DEFAULT '10000' COMMENT '排序',
  `theme` varchar(20) NOT NULL DEFAULT '' COMMENT '模板名称',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '模板文件名',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '操作',
  `file` varchar(50) NOT NULL DEFAULT '' COMMENT '模板文件，相对于模板根目录，如Portal/index.html',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '模板文件描述',
  `more` text COMMENT '模板更多配置,用户自己后台设置的',
  `config_more` text COMMENT '模板更多配置,来源模板的配置文件',
  `draft_more` text COMMENT '模板更多配置,用户临时保存的配置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xjy_theme_file
-- ----------------------------
INSERT INTO `xjy_theme_file` VALUES ('181', '0', '10', 'video_tpl', '文章页', 'portal/Article/index', 'portal/article', '文章页模板文件', '{\"vars\":{\"hot_articles_category_id\":{\"title\":\"Hot Articles\\u5206\\u7c7bID\",\"name\":\"hot_articles_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"hot_articles_category_id\":{\"title\":\"Hot Articles\\u5206\\u7c7bID\",\"name\":\"hot_articles_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('182', '0', '10', 'video_tpl', '联系我们页', 'portal/Page/index', 'portal/contact', '联系我们页模板文件', '{\"vars\":{\"baidu_map_info_window_text\":{\"title\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57\",\"name\":\"baidu_map_info_window_text\",\"value\":\"ThinkCMF<br\\/><span class=\'\'>\\u5730\\u5740\\uff1a\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def2601\\u53f7<\\/span>\",\"type\":\"text\",\"tip\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57,\\u652f\\u6301\\u7b80\\u5355html\\u4ee3\\u7801\",\"rule\":[]},\"company_location\":{\"title\":\"\\u516c\\u53f8\\u5750\\u6807\",\"value\":\"\",\"type\":\"location\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_cn\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\",\"value\":\"\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def0001\\u53f7\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_en\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"NO.0001 Xie Tu Road, Shanghai China\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"email\":{\"title\":\"\\u516c\\u53f8\\u90ae\\u7bb1\",\"value\":\"catman@thinkcmf.com\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_cn\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\",\"value\":\"021 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_en\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"+8621 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"qq\":{\"title\":\"\\u8054\\u7cfbQQ\",\"value\":\"478519726\",\"type\":\"text\",\"tip\":\"\\u591a\\u4e2a QQ\\u4ee5\\u82f1\\u6587\\u9017\\u53f7\\u9694\\u5f00\",\"rule\":{\"require\":true}}}}', '{\"vars\":{\"baidu_map_info_window_text\":{\"title\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57\",\"name\":\"baidu_map_info_window_text\",\"value\":\"ThinkCMF<br\\/><span class=\'\'>\\u5730\\u5740\\uff1a\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def2601\\u53f7<\\/span>\",\"type\":\"text\",\"tip\":\"\\u767e\\u5ea6\\u5730\\u56fe\\u6807\\u6ce8\\u6587\\u5b57,\\u652f\\u6301\\u7b80\\u5355html\\u4ee3\\u7801\",\"rule\":[]},\"company_location\":{\"title\":\"\\u516c\\u53f8\\u5750\\u6807\",\"value\":\"\",\"type\":\"location\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_cn\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\",\"value\":\"\\u4e0a\\u6d77\\u5e02\\u5f90\\u6c47\\u533a\\u659c\\u571f\\u8def0001\\u53f7\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"address_en\":{\"title\":\"\\u516c\\u53f8\\u5730\\u5740\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"NO.0001 Xie Tu Road, Shanghai China\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"email\":{\"title\":\"\\u516c\\u53f8\\u90ae\\u7bb1\",\"value\":\"catman@thinkcmf.com\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_cn\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\",\"value\":\"021 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"phone_en\":{\"title\":\"\\u516c\\u53f8\\u7535\\u8bdd\\uff08\\u82f1\\u6587\\uff09\",\"value\":\"+8621 1000 0001\",\"type\":\"text\",\"tip\":\"\",\"rule\":{\"require\":true}},\"qq\":{\"title\":\"\\u8054\\u7cfbQQ\",\"value\":\"478519726\",\"type\":\"text\",\"tip\":\"\\u591a\\u4e2a QQ\\u4ee5\\u82f1\\u6587\\u9017\\u53f7\\u9694\\u5f00\",\"rule\":{\"require\":true}}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('186', '0', '10', 'video_tpl', '搜索页面', 'portal/search/index', 'portal/search', '搜索模板文件', '{\"vars\":{\"varName1\":{\"title\":\"\\u70ed\\u95e8\\u641c\\u7d22\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\\u8fd9\\u662f\\u4e00\\u4e2atext\",\"rule\":{\"require\":true}}}}', '{\"vars\":{\"varName1\":{\"title\":\"\\u70ed\\u95e8\\u641c\\u7d22\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\\u8fd9\\u662f\\u4e00\\u4e2atext\",\"rule\":{\"require\":true}}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('184', '0', '10', 'video_tpl', '文章列表页', 'portal/List/index', 'portal/list', '文章列表模板文件', '{\"vars\":[],\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', '{\"vars\":[],\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('185', '0', '10', 'video_tpl', '单页面', 'portal/Page/index', 'portal/page', '单页面模板文件', '{\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', '{\"widgets\":{\"hottest_articles\":{\"title\":\"\\u70ed\\u95e8\\u6587\\u7ae0\",\"display\":\"1\",\"vars\":{\"hottest_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_articles\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_articles_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('183', '0', '5', 'video_tpl', '首页', 'portal/Index/index', 'portal/index', '首页模板文件', '{\"vars\":{\"top_slide\":{\"title\":\"\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"admin\\/Slide\\/index\",\"multi\":false},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"tip\":\"\",\"rule\":{\"require\":true}}},\"widgets\":{\"features\":{\"title\":\"\\u5feb\\u901f\\u4e86\\u89e3ThinkCMF\",\"display\":\"1\",\"vars\":{\"sub_title\":{\"title\":\"\\u526f\\u6807\\u9898\",\"value\":\"Quickly understand the ThinkCMF\",\"type\":\"text\",\"placeholder\":\"\\u8bf7\\u8f93\\u5165\\u526f\\u6807\\u9898\",\"tip\":\"\",\"rule\":{\"require\":true}},\"features\":{\"title\":\"\\u7279\\u6027\\u4ecb\\u7ecd\",\"value\":[{\"title\":\"MVC\\u5206\\u5c42\\u6a21\\u5f0f\",\"icon\":\"bars\",\"content\":\"\\u4f7f\\u7528MVC\\u5e94\\u7528\\u7a0b\\u5e8f\\u88ab\\u5206\\u6210\\u4e09\\u4e2a\\u6838\\u5fc3\\u90e8\\u4ef6\\uff1a\\u6a21\\u578b\\uff08M\\uff09\\u3001\\u89c6\\u56fe\\uff08V\\uff09\\u3001\\u63a7\\u5236\\u5668\\uff08C\\uff09\\uff0c\\u4ed6\\u4e0d\\u662f\\u4e00\\u4e2a\\u65b0\\u7684\\u6982\\u5ff5\\uff0c\\u53ea\\u662fThinkCMF\\u5c06\\u5176\\u53d1\\u6325\\u5230\\u4e86\\u6781\\u81f4\\u3002\"},{\"title\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"icon\":\"group\",\"content\":\"ThinkCMF\\u5185\\u7f6e\\u4e86\\u7075\\u6d3b\\u7684\\u7528\\u6237\\u7ba1\\u7406\\u65b9\\u5f0f\\uff0c\\u5e76\\u53ef\\u76f4\\u63a5\\u4e0e\\u7b2c\\u4e09\\u65b9\\u7ad9\\u70b9\\u8fdb\\u884c\\u4e92\\u8054\\u4e92\\u901a\\uff0c\\u5982\\u679c\\u4f60\\u613f\\u610f\\u751a\\u81f3\\u53ef\\u4ee5\\u5bf9\\u5355\\u4e2a\\u7528\\u6237\\u6216\\u7fa4\\u4f53\\u7528\\u6237\\u7684\\u884c\\u4e3a\\u8fdb\\u884c\\u8bb0\\u5f55\\u53ca\\u5206\\u4eab\\uff0c\\u4e3a\\u60a8\\u7684\\u8fd0\\u8425\\u51b3\\u7b56\\u63d0\\u4f9b\\u6709\\u6548\\u53c2\\u8003\\u6570\\u636e\\u3002\"},{\"title\":\"\\u4e91\\u7aef\\u90e8\\u7f72\",\"icon\":\"cloud\",\"content\":\"\\u901a\\u8fc7\\u9a71\\u52a8\\u7684\\u65b9\\u5f0f\\u53ef\\u4ee5\\u8f7b\\u677e\\u652f\\u6301\\u4e91\\u5e73\\u53f0\\u7684\\u90e8\\u7f72\\uff0c\\u8ba9\\u4f60\\u7684\\u7f51\\u7ad9\\u65e0\\u7f1d\\u8fc1\\u79fb\\uff0c\\u5185\\u7f6e\\u5df2\\u7ecf\\u652f\\u6301SAE\\u3001BAE\\uff0c\\u6b63\\u5f0f\\u7248\\u5c06\\u5bf9\\u4e91\\u7aef\\u90e8\\u7f72\\u8fdb\\u884c\\u8fdb\\u4e00\\u6b65\\u4f18\\u5316\\u3002\"},{\"title\":\"\\u5b89\\u5168\\u7b56\\u7565\",\"icon\":\"heart\",\"content\":\"\\u63d0\\u4f9b\\u7684\\u7a33\\u5065\\u7684\\u5b89\\u5168\\u7b56\\u7565\\uff0c\\u5305\\u62ec\\u5907\\u4efd\\u6062\\u590d\\uff0c\\u5bb9\\u9519\\uff0c\\u9632\\u6cbb\\u6076\\u610f\\u653b\\u51fb\\u767b\\u9646\\uff0c\\u7f51\\u9875\\u9632\\u7be1\\u6539\\u7b49\\u591a\\u9879\\u5b89\\u5168\\u7ba1\\u7406\\u529f\\u80fd\\uff0c\\u4fdd\\u8bc1\\u7cfb\\u7edf\\u5b89\\u5168\\uff0c\\u53ef\\u9760\\uff0c\\u7a33\\u5b9a\\u7684\\u8fd0\\u884c\\u3002\"},{\"title\":\"\\u5e94\\u7528\\u6a21\\u5757\\u5316\",\"icon\":\"cubes\",\"content\":\"\\u63d0\\u51fa\\u5168\\u65b0\\u7684\\u5e94\\u7528\\u6a21\\u5f0f\\u8fdb\\u884c\\u6269\\u5c55\\uff0c\\u4e0d\\u7ba1\\u662f\\u4f60\\u5f00\\u53d1\\u4e00\\u4e2a\\u5c0f\\u529f\\u80fd\\u8fd8\\u662f\\u4e00\\u4e2a\\u5168\\u65b0\\u7684\\u7ad9\\u70b9\\uff0c\\u5728ThinkCMF\\u4e2d\\u4f60\\u53ea\\u662f\\u589e\\u52a0\\u4e86\\u4e00\\u4e2aAPP\\uff0c\\u6bcf\\u4e2a\\u72ec\\u7acb\\u8fd0\\u884c\\u4e92\\u4e0d\\u5f71\\u54cd\\uff0c\\u4fbf\\u4e8e\\u7075\\u6d3b\\u6269\\u5c55\\u548c\\u4e8c\\u6b21\\u5f00\\u53d1\\u3002\"},{\"title\":\"\\u514d\\u8d39\\u5f00\\u6e90\",\"icon\":\"certificate\",\"content\":\"\\u4ee3\\u7801\\u9075\\u5faaApache2\\u5f00\\u6e90\\u534f\\u8bae\\uff0c\\u514d\\u8d39\\u4f7f\\u7528\\uff0c\\u5bf9\\u5546\\u4e1a\\u7528\\u6237\\u4e5f\\u65e0\\u4efb\\u4f55\\u9650\\u5236\\u3002\"}],\"type\":\"array\",\"item\":{\"title\":{\"title\":\"\\u6807\\u9898\",\"value\":\"\",\"type\":\"text\",\"rule\":{\"require\":true}},\"icon\":{\"title\":\"\\u56fe\\u6807\",\"value\":\"\",\"type\":\"text\"},\"content\":{\"title\":\"\\u63cf\\u8ff0\",\"value\":\"\",\"type\":\"textarea\"}},\"tip\":\"\"}}},\"last_news\":{\"title\":\"\\u6700\\u65b0\\u8d44\\u8baf\",\"display\":\"1\",\"vars\":{\"last_news_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', '{\"vars\":{\"top_slide\":{\"title\":\"\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"admin\\/Slide\\/index\",\"multi\":false},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"tip\":\"\",\"rule\":{\"require\":true}}},\"widgets\":{\"features\":{\"title\":\"\\u5feb\\u901f\\u4e86\\u89e3ThinkCMF\",\"display\":\"1\",\"vars\":{\"sub_title\":{\"title\":\"\\u526f\\u6807\\u9898\",\"value\":\"Quickly understand the ThinkCMF\",\"type\":\"text\",\"placeholder\":\"\\u8bf7\\u8f93\\u5165\\u526f\\u6807\\u9898\",\"tip\":\"\",\"rule\":{\"require\":true}},\"features\":{\"title\":\"\\u7279\\u6027\\u4ecb\\u7ecd\",\"value\":[{\"title\":\"MVC\\u5206\\u5c42\\u6a21\\u5f0f\",\"icon\":\"bars\",\"content\":\"\\u4f7f\\u7528MVC\\u5e94\\u7528\\u7a0b\\u5e8f\\u88ab\\u5206\\u6210\\u4e09\\u4e2a\\u6838\\u5fc3\\u90e8\\u4ef6\\uff1a\\u6a21\\u578b\\uff08M\\uff09\\u3001\\u89c6\\u56fe\\uff08V\\uff09\\u3001\\u63a7\\u5236\\u5668\\uff08C\\uff09\\uff0c\\u4ed6\\u4e0d\\u662f\\u4e00\\u4e2a\\u65b0\\u7684\\u6982\\u5ff5\\uff0c\\u53ea\\u662fThinkCMF\\u5c06\\u5176\\u53d1\\u6325\\u5230\\u4e86\\u6781\\u81f4\\u3002\"},{\"title\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"icon\":\"group\",\"content\":\"ThinkCMF\\u5185\\u7f6e\\u4e86\\u7075\\u6d3b\\u7684\\u7528\\u6237\\u7ba1\\u7406\\u65b9\\u5f0f\\uff0c\\u5e76\\u53ef\\u76f4\\u63a5\\u4e0e\\u7b2c\\u4e09\\u65b9\\u7ad9\\u70b9\\u8fdb\\u884c\\u4e92\\u8054\\u4e92\\u901a\\uff0c\\u5982\\u679c\\u4f60\\u613f\\u610f\\u751a\\u81f3\\u53ef\\u4ee5\\u5bf9\\u5355\\u4e2a\\u7528\\u6237\\u6216\\u7fa4\\u4f53\\u7528\\u6237\\u7684\\u884c\\u4e3a\\u8fdb\\u884c\\u8bb0\\u5f55\\u53ca\\u5206\\u4eab\\uff0c\\u4e3a\\u60a8\\u7684\\u8fd0\\u8425\\u51b3\\u7b56\\u63d0\\u4f9b\\u6709\\u6548\\u53c2\\u8003\\u6570\\u636e\\u3002\"},{\"title\":\"\\u4e91\\u7aef\\u90e8\\u7f72\",\"icon\":\"cloud\",\"content\":\"\\u901a\\u8fc7\\u9a71\\u52a8\\u7684\\u65b9\\u5f0f\\u53ef\\u4ee5\\u8f7b\\u677e\\u652f\\u6301\\u4e91\\u5e73\\u53f0\\u7684\\u90e8\\u7f72\\uff0c\\u8ba9\\u4f60\\u7684\\u7f51\\u7ad9\\u65e0\\u7f1d\\u8fc1\\u79fb\\uff0c\\u5185\\u7f6e\\u5df2\\u7ecf\\u652f\\u6301SAE\\u3001BAE\\uff0c\\u6b63\\u5f0f\\u7248\\u5c06\\u5bf9\\u4e91\\u7aef\\u90e8\\u7f72\\u8fdb\\u884c\\u8fdb\\u4e00\\u6b65\\u4f18\\u5316\\u3002\"},{\"title\":\"\\u5b89\\u5168\\u7b56\\u7565\",\"icon\":\"heart\",\"content\":\"\\u63d0\\u4f9b\\u7684\\u7a33\\u5065\\u7684\\u5b89\\u5168\\u7b56\\u7565\\uff0c\\u5305\\u62ec\\u5907\\u4efd\\u6062\\u590d\\uff0c\\u5bb9\\u9519\\uff0c\\u9632\\u6cbb\\u6076\\u610f\\u653b\\u51fb\\u767b\\u9646\\uff0c\\u7f51\\u9875\\u9632\\u7be1\\u6539\\u7b49\\u591a\\u9879\\u5b89\\u5168\\u7ba1\\u7406\\u529f\\u80fd\\uff0c\\u4fdd\\u8bc1\\u7cfb\\u7edf\\u5b89\\u5168\\uff0c\\u53ef\\u9760\\uff0c\\u7a33\\u5b9a\\u7684\\u8fd0\\u884c\\u3002\"},{\"title\":\"\\u5e94\\u7528\\u6a21\\u5757\\u5316\",\"icon\":\"cubes\",\"content\":\"\\u63d0\\u51fa\\u5168\\u65b0\\u7684\\u5e94\\u7528\\u6a21\\u5f0f\\u8fdb\\u884c\\u6269\\u5c55\\uff0c\\u4e0d\\u7ba1\\u662f\\u4f60\\u5f00\\u53d1\\u4e00\\u4e2a\\u5c0f\\u529f\\u80fd\\u8fd8\\u662f\\u4e00\\u4e2a\\u5168\\u65b0\\u7684\\u7ad9\\u70b9\\uff0c\\u5728ThinkCMF\\u4e2d\\u4f60\\u53ea\\u662f\\u589e\\u52a0\\u4e86\\u4e00\\u4e2aAPP\\uff0c\\u6bcf\\u4e2a\\u72ec\\u7acb\\u8fd0\\u884c\\u4e92\\u4e0d\\u5f71\\u54cd\\uff0c\\u4fbf\\u4e8e\\u7075\\u6d3b\\u6269\\u5c55\\u548c\\u4e8c\\u6b21\\u5f00\\u53d1\\u3002\"},{\"title\":\"\\u514d\\u8d39\\u5f00\\u6e90\",\"icon\":\"certificate\",\"content\":\"\\u4ee3\\u7801\\u9075\\u5faaApache2\\u5f00\\u6e90\\u534f\\u8bae\\uff0c\\u514d\\u8d39\\u4f7f\\u7528\\uff0c\\u5bf9\\u5546\\u4e1a\\u7528\\u6237\\u4e5f\\u65e0\\u4efb\\u4f55\\u9650\\u5236\\u3002\"}],\"type\":\"array\",\"item\":{\"title\":{\"title\":\"\\u6807\\u9898\",\"value\":\"\",\"type\":\"text\",\"rule\":{\"require\":true}},\"icon\":{\"title\":\"\\u56fe\\u6807\",\"value\":\"\",\"type\":\"text\"},\"content\":{\"title\":\"\\u63cf\\u8ff0\",\"value\":\"\",\"type\":\"textarea\"}},\"tip\":\"\"}}},\"last_news\":{\"title\":\"\\u6700\\u65b0\\u8d44\\u8baf\",\"display\":\"1\",\"vars\":{\"last_news_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('171', '0', '10', 'video_tpl', '视频播放页', 'video/Play/index', 'video/play', '视频播放页模板文件', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('172', '0', '10', 'video_tpl', '搜索页面', 'video/search/index', 'video/search', '搜索模板文件', '{\"vars\":{\"varName1\":{\"title\":\"\\u70ed\\u95e8\\u641c\\u7d22\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\\u8fd9\\u662f\\u4e00\\u4e2atext\",\"rule\":{\"require\":true}}}}', '{\"vars\":{\"varName1\":{\"title\":\"\\u70ed\\u95e8\\u641c\\u7d22\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\\u8fd9\\u662f\\u4e00\\u4e2atext\",\"rule\":{\"require\":true}}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('173', '0', '10', 'video_tpl', '视频直播页', 'video/Tv/index', 'video/tv', '视频直播页模板文件', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('174', '0', '10', 'video_tpl', '视频分类列表页', 'video/Type/index', 'video/type', '视频分类列表页模板文件', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('187', '0', '10', 'video_tpl', '视频详细页', 'video/Video/index', 'video/video', '视频详细页模板文件', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('166', '0', '10', 'video_tpl', '视频排行榜页', 'video/Hot/index', 'video/hot', '视频排行榜页模板文件', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('167', '0', '5', 'video_tpl', '首页', 'video/Index/index', 'video/index', '首页模板文件', '{\"vars\":{\"top_slide\":{\"title\":\"\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"admin\\/Slide\\/index\",\"multi\":false},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"tip\":\"\",\"rule\":{\"require\":true}}},\"widgets\":{\"features\":{\"title\":\"\\u5feb\\u901f\\u4e86\\u89e3ThinkCMF\",\"display\":\"1\",\"vars\":{\"sub_title\":{\"title\":\"\\u526f\\u6807\\u9898\",\"value\":\"Quickly understand the ThinkCMF\",\"type\":\"text\",\"placeholder\":\"\\u8bf7\\u8f93\\u5165\\u526f\\u6807\\u9898\",\"tip\":\"\",\"rule\":{\"require\":true}},\"features\":{\"title\":\"\\u7279\\u6027\\u4ecb\\u7ecd\",\"value\":[{\"title\":\"MVC\\u5206\\u5c42\\u6a21\\u5f0f\",\"icon\":\"bars\",\"content\":\"\\u4f7f\\u7528MVC\\u5e94\\u7528\\u7a0b\\u5e8f\\u88ab\\u5206\\u6210\\u4e09\\u4e2a\\u6838\\u5fc3\\u90e8\\u4ef6\\uff1a\\u6a21\\u578b\\uff08M\\uff09\\u3001\\u89c6\\u56fe\\uff08V\\uff09\\u3001\\u63a7\\u5236\\u5668\\uff08C\\uff09\\uff0c\\u4ed6\\u4e0d\\u662f\\u4e00\\u4e2a\\u65b0\\u7684\\u6982\\u5ff5\\uff0c\\u53ea\\u662fThinkCMF\\u5c06\\u5176\\u53d1\\u6325\\u5230\\u4e86\\u6781\\u81f4\\u3002\"},{\"title\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"icon\":\"group\",\"content\":\"ThinkCMF\\u5185\\u7f6e\\u4e86\\u7075\\u6d3b\\u7684\\u7528\\u6237\\u7ba1\\u7406\\u65b9\\u5f0f\\uff0c\\u5e76\\u53ef\\u76f4\\u63a5\\u4e0e\\u7b2c\\u4e09\\u65b9\\u7ad9\\u70b9\\u8fdb\\u884c\\u4e92\\u8054\\u4e92\\u901a\\uff0c\\u5982\\u679c\\u4f60\\u613f\\u610f\\u751a\\u81f3\\u53ef\\u4ee5\\u5bf9\\u5355\\u4e2a\\u7528\\u6237\\u6216\\u7fa4\\u4f53\\u7528\\u6237\\u7684\\u884c\\u4e3a\\u8fdb\\u884c\\u8bb0\\u5f55\\u53ca\\u5206\\u4eab\\uff0c\\u4e3a\\u60a8\\u7684\\u8fd0\\u8425\\u51b3\\u7b56\\u63d0\\u4f9b\\u6709\\u6548\\u53c2\\u8003\\u6570\\u636e\\u3002\"},{\"title\":\"\\u4e91\\u7aef\\u90e8\\u7f72\",\"icon\":\"cloud\",\"content\":\"\\u901a\\u8fc7\\u9a71\\u52a8\\u7684\\u65b9\\u5f0f\\u53ef\\u4ee5\\u8f7b\\u677e\\u652f\\u6301\\u4e91\\u5e73\\u53f0\\u7684\\u90e8\\u7f72\\uff0c\\u8ba9\\u4f60\\u7684\\u7f51\\u7ad9\\u65e0\\u7f1d\\u8fc1\\u79fb\\uff0c\\u5185\\u7f6e\\u5df2\\u7ecf\\u652f\\u6301SAE\\u3001BAE\\uff0c\\u6b63\\u5f0f\\u7248\\u5c06\\u5bf9\\u4e91\\u7aef\\u90e8\\u7f72\\u8fdb\\u884c\\u8fdb\\u4e00\\u6b65\\u4f18\\u5316\\u3002\"},{\"title\":\"\\u5b89\\u5168\\u7b56\\u7565\",\"icon\":\"heart\",\"content\":\"\\u63d0\\u4f9b\\u7684\\u7a33\\u5065\\u7684\\u5b89\\u5168\\u7b56\\u7565\\uff0c\\u5305\\u62ec\\u5907\\u4efd\\u6062\\u590d\\uff0c\\u5bb9\\u9519\\uff0c\\u9632\\u6cbb\\u6076\\u610f\\u653b\\u51fb\\u767b\\u9646\\uff0c\\u7f51\\u9875\\u9632\\u7be1\\u6539\\u7b49\\u591a\\u9879\\u5b89\\u5168\\u7ba1\\u7406\\u529f\\u80fd\\uff0c\\u4fdd\\u8bc1\\u7cfb\\u7edf\\u5b89\\u5168\\uff0c\\u53ef\\u9760\\uff0c\\u7a33\\u5b9a\\u7684\\u8fd0\\u884c\\u3002\"},{\"title\":\"\\u5e94\\u7528\\u6a21\\u5757\\u5316\",\"icon\":\"cubes\",\"content\":\"\\u63d0\\u51fa\\u5168\\u65b0\\u7684\\u5e94\\u7528\\u6a21\\u5f0f\\u8fdb\\u884c\\u6269\\u5c55\\uff0c\\u4e0d\\u7ba1\\u662f\\u4f60\\u5f00\\u53d1\\u4e00\\u4e2a\\u5c0f\\u529f\\u80fd\\u8fd8\\u662f\\u4e00\\u4e2a\\u5168\\u65b0\\u7684\\u7ad9\\u70b9\\uff0c\\u5728ThinkCMF\\u4e2d\\u4f60\\u53ea\\u662f\\u589e\\u52a0\\u4e86\\u4e00\\u4e2aAPP\\uff0c\\u6bcf\\u4e2a\\u72ec\\u7acb\\u8fd0\\u884c\\u4e92\\u4e0d\\u5f71\\u54cd\\uff0c\\u4fbf\\u4e8e\\u7075\\u6d3b\\u6269\\u5c55\\u548c\\u4e8c\\u6b21\\u5f00\\u53d1\\u3002\"},{\"title\":\"\\u514d\\u8d39\\u5f00\\u6e90\",\"icon\":\"certificate\",\"content\":\"\\u4ee3\\u7801\\u9075\\u5faaApache2\\u5f00\\u6e90\\u534f\\u8bae\\uff0c\\u514d\\u8d39\\u4f7f\\u7528\\uff0c\\u5bf9\\u5546\\u4e1a\\u7528\\u6237\\u4e5f\\u65e0\\u4efb\\u4f55\\u9650\\u5236\\u3002\"}],\"type\":\"array\",\"item\":{\"title\":{\"title\":\"\\u6807\\u9898\",\"value\":\"\",\"type\":\"text\",\"rule\":{\"require\":true}},\"icon\":{\"title\":\"\\u56fe\\u6807\",\"value\":\"\",\"type\":\"text\"},\"content\":{\"title\":\"\\u63cf\\u8ff0\",\"value\":\"\",\"type\":\"textarea\"}},\"tip\":\"\"}}},\"last_news\":{\"title\":\"\\u6700\\u65b0\\u8d44\\u8baf\",\"display\":\"1\",\"vars\":{\"last_news_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', '{\"vars\":{\"top_slide\":{\"title\":\"\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"admin\\/Slide\\/index\",\"multi\":false},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u9876\\u90e8\\u5e7b\\u706f\\u7247\",\"tip\":\"\",\"rule\":{\"require\":true}}},\"widgets\":{\"features\":{\"title\":\"\\u5feb\\u901f\\u4e86\\u89e3ThinkCMF\",\"display\":\"1\",\"vars\":{\"sub_title\":{\"title\":\"\\u526f\\u6807\\u9898\",\"value\":\"Quickly understand the ThinkCMF\",\"type\":\"text\",\"placeholder\":\"\\u8bf7\\u8f93\\u5165\\u526f\\u6807\\u9898\",\"tip\":\"\",\"rule\":{\"require\":true}},\"features\":{\"title\":\"\\u7279\\u6027\\u4ecb\\u7ecd\",\"value\":[{\"title\":\"MVC\\u5206\\u5c42\\u6a21\\u5f0f\",\"icon\":\"bars\",\"content\":\"\\u4f7f\\u7528MVC\\u5e94\\u7528\\u7a0b\\u5e8f\\u88ab\\u5206\\u6210\\u4e09\\u4e2a\\u6838\\u5fc3\\u90e8\\u4ef6\\uff1a\\u6a21\\u578b\\uff08M\\uff09\\u3001\\u89c6\\u56fe\\uff08V\\uff09\\u3001\\u63a7\\u5236\\u5668\\uff08C\\uff09\\uff0c\\u4ed6\\u4e0d\\u662f\\u4e00\\u4e2a\\u65b0\\u7684\\u6982\\u5ff5\\uff0c\\u53ea\\u662fThinkCMF\\u5c06\\u5176\\u53d1\\u6325\\u5230\\u4e86\\u6781\\u81f4\\u3002\"},{\"title\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"icon\":\"group\",\"content\":\"ThinkCMF\\u5185\\u7f6e\\u4e86\\u7075\\u6d3b\\u7684\\u7528\\u6237\\u7ba1\\u7406\\u65b9\\u5f0f\\uff0c\\u5e76\\u53ef\\u76f4\\u63a5\\u4e0e\\u7b2c\\u4e09\\u65b9\\u7ad9\\u70b9\\u8fdb\\u884c\\u4e92\\u8054\\u4e92\\u901a\\uff0c\\u5982\\u679c\\u4f60\\u613f\\u610f\\u751a\\u81f3\\u53ef\\u4ee5\\u5bf9\\u5355\\u4e2a\\u7528\\u6237\\u6216\\u7fa4\\u4f53\\u7528\\u6237\\u7684\\u884c\\u4e3a\\u8fdb\\u884c\\u8bb0\\u5f55\\u53ca\\u5206\\u4eab\\uff0c\\u4e3a\\u60a8\\u7684\\u8fd0\\u8425\\u51b3\\u7b56\\u63d0\\u4f9b\\u6709\\u6548\\u53c2\\u8003\\u6570\\u636e\\u3002\"},{\"title\":\"\\u4e91\\u7aef\\u90e8\\u7f72\",\"icon\":\"cloud\",\"content\":\"\\u901a\\u8fc7\\u9a71\\u52a8\\u7684\\u65b9\\u5f0f\\u53ef\\u4ee5\\u8f7b\\u677e\\u652f\\u6301\\u4e91\\u5e73\\u53f0\\u7684\\u90e8\\u7f72\\uff0c\\u8ba9\\u4f60\\u7684\\u7f51\\u7ad9\\u65e0\\u7f1d\\u8fc1\\u79fb\\uff0c\\u5185\\u7f6e\\u5df2\\u7ecf\\u652f\\u6301SAE\\u3001BAE\\uff0c\\u6b63\\u5f0f\\u7248\\u5c06\\u5bf9\\u4e91\\u7aef\\u90e8\\u7f72\\u8fdb\\u884c\\u8fdb\\u4e00\\u6b65\\u4f18\\u5316\\u3002\"},{\"title\":\"\\u5b89\\u5168\\u7b56\\u7565\",\"icon\":\"heart\",\"content\":\"\\u63d0\\u4f9b\\u7684\\u7a33\\u5065\\u7684\\u5b89\\u5168\\u7b56\\u7565\\uff0c\\u5305\\u62ec\\u5907\\u4efd\\u6062\\u590d\\uff0c\\u5bb9\\u9519\\uff0c\\u9632\\u6cbb\\u6076\\u610f\\u653b\\u51fb\\u767b\\u9646\\uff0c\\u7f51\\u9875\\u9632\\u7be1\\u6539\\u7b49\\u591a\\u9879\\u5b89\\u5168\\u7ba1\\u7406\\u529f\\u80fd\\uff0c\\u4fdd\\u8bc1\\u7cfb\\u7edf\\u5b89\\u5168\\uff0c\\u53ef\\u9760\\uff0c\\u7a33\\u5b9a\\u7684\\u8fd0\\u884c\\u3002\"},{\"title\":\"\\u5e94\\u7528\\u6a21\\u5757\\u5316\",\"icon\":\"cubes\",\"content\":\"\\u63d0\\u51fa\\u5168\\u65b0\\u7684\\u5e94\\u7528\\u6a21\\u5f0f\\u8fdb\\u884c\\u6269\\u5c55\\uff0c\\u4e0d\\u7ba1\\u662f\\u4f60\\u5f00\\u53d1\\u4e00\\u4e2a\\u5c0f\\u529f\\u80fd\\u8fd8\\u662f\\u4e00\\u4e2a\\u5168\\u65b0\\u7684\\u7ad9\\u70b9\\uff0c\\u5728ThinkCMF\\u4e2d\\u4f60\\u53ea\\u662f\\u589e\\u52a0\\u4e86\\u4e00\\u4e2aAPP\\uff0c\\u6bcf\\u4e2a\\u72ec\\u7acb\\u8fd0\\u884c\\u4e92\\u4e0d\\u5f71\\u54cd\\uff0c\\u4fbf\\u4e8e\\u7075\\u6d3b\\u6269\\u5c55\\u548c\\u4e8c\\u6b21\\u5f00\\u53d1\\u3002\"},{\"title\":\"\\u514d\\u8d39\\u5f00\\u6e90\",\"icon\":\"certificate\",\"content\":\"\\u4ee3\\u7801\\u9075\\u5faaApache2\\u5f00\\u6e90\\u534f\\u8bae\\uff0c\\u514d\\u8d39\\u4f7f\\u7528\\uff0c\\u5bf9\\u5546\\u4e1a\\u7528\\u6237\\u4e5f\\u65e0\\u4efb\\u4f55\\u9650\\u5236\\u3002\"}],\"type\":\"array\",\"item\":{\"title\":{\"title\":\"\\u6807\\u9898\",\"value\":\"\",\"type\":\"text\",\"rule\":{\"require\":true}},\"icon\":{\"title\":\"\\u56fe\\u6807\",\"value\":\"\",\"type\":\"text\"},\"content\":{\"title\":\"\\u63cf\\u8ff0\",\"value\":\"\",\"type\":\"textarea\"}},\"tip\":\"\"}}},\"last_news\":{\"title\":\"\\u6700\\u65b0\\u8d44\\u8baf\",\"display\":\"1\",\"vars\":{\"last_news_category_id\":{\"title\":\"\\u6587\\u7ae0\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('168', '0', '10', 'video_tpl', '视频列表页', 'video/List/index', 'video/list', '视频列表模板文件', '{\"vars\":[],\"widgets\":{\"hottest_videos\":{\"title\":\"\\u70ed\\u95e8\\u89c6\\u9891\",\"display\":\"1\",\"vars\":{\"hottest_videos_category_id\":{\"title\":\"\\u89c6\\u9891\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_videos\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_videos_category_id\":{\"title\":\"\\u89c6\\u9891\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', '{\"vars\":[],\"widgets\":{\"hottest_videos\":{\"title\":\"\\u70ed\\u95e8\\u89c6\\u9891\",\"display\":\"1\",\"vars\":{\"hottest_videos_category_id\":{\"title\":\"\\u89c6\\u9891\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}},\"last_videos\":{\"title\":\"\\u6700\\u65b0\\u53d1\\u5e03\",\"display\":\"1\",\"vars\":{\"last_videos_category_id\":{\"title\":\"\\u89c6\\u9891\\u5206\\u7c7bID\",\"value\":\"\",\"type\":\"text\",\"dataSource\":{\"api\":\"portal\\/category\\/index\",\"multi\":true},\"placeholder\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"tip\":\"\",\"rule\":{\"require\":true}}}}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('169', '0', '10', 'video_tpl', '网站地图页', 'video/Map/index', 'video/map', '网站地图页模板文件', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('170', '0', '10', 'video_tpl', '最近更新页', 'video/New/index', 'video/new', '最近更新页模板文件', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"hot_video_category_id\":{\"title\":\"Hot Video\\u5206\\u7c7bID\",\"name\":\"hot_video_category_id\",\"value\":\"1\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('163', '1', '0', 'video_tpl', '模板全局配置', 'public/Config', 'public/config', '模板全局配置文件', '{\"vars\":{\"enable_mobile\":{\"title\":\"\\u624b\\u673a\\u6ce8\\u518c\",\"value\":1,\"type\":\"select\",\"options\":{\"1\":\"\\u5f00\\u542f\",\"0\":\"\\u5173\\u95ed\"},\"tip\":\"\"}}}', '{\"vars\":{\"enable_mobile\":{\"title\":\"\\u624b\\u673a\\u6ce8\\u518c\",\"value\":1,\"type\":\"select\",\"options\":{\"1\":\"\\u5f00\\u542f\",\"0\":\"\\u5173\\u95ed\"},\"tip\":\"\"}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('164', '1', '1', 'video_tpl', '导航条', 'public/Nav', 'public/nav', '导航条模板文件', '{\"vars\":{\"company_name\":{\"title\":\"\\u516c\\u53f8\\u540d\\u79f0\",\"name\":\"company_name\",\"value\":\"ThinkCMF\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', '{\"vars\":{\"company_name\":{\"title\":\"\\u516c\\u53f8\\u540d\\u79f0\",\"name\":\"company_name\",\"value\":\"ThinkCMF\",\"type\":\"text\",\"tip\":\"\",\"rule\":[]}}}', null);
INSERT INTO `xjy_theme_file` VALUES ('188', '0', '5', 'wechat_ordering', '首页', 'user/Index/index', 'user/index/index', '首页模板文件', '[]', '[]', null);

-- ----------------------------
-- Table structure for xjy_third_party_user
-- ----------------------------
DROP TABLE IF EXISTS `xjy_third_party_user`;
CREATE TABLE `xjy_third_party_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '本站用户id',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'access_token过期时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '绑定时间',
  `login_times` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '登录次数',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:正常;0:禁用',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `third_party` varchar(20) NOT NULL DEFAULT '' COMMENT '第三方惟一码',
  `app_id` varchar(64) NOT NULL DEFAULT '' COMMENT '第三方应用 id',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `access_token` varchar(512) NOT NULL DEFAULT '' COMMENT '第三方授权码',
  `openid` varchar(40) NOT NULL DEFAULT '' COMMENT '第三方用户id',
  `union_id` varchar(64) NOT NULL DEFAULT '' COMMENT '第三方用户多个产品中的惟一 id,(如:微信平台)',
  `more` text COMMENT '扩展信息',
  `avatarUrl` varchar(255) NOT NULL DEFAULT '' COMMENT '第三方用户头像地址',
  `gender` tinyint(3) NOT NULL DEFAULT '0' COMMENT '性别 0：未知 1：男、2：女 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COMMENT='第三方用户表';

-- ----------------------------
-- Records of xjy_third_party_user
-- ----------------------------
INSERT INTO `xjy_third_party_user` VALUES ('1', '0', '1510641286', '0', '1510641286', '0', '1', '测试4', '', '10', '', '', '4', '微信', null, '', '0');
INSERT INTO `xjy_third_party_user` VALUES ('2', '0', '1510641599', '0', '1510641286', '3', '1', '测试1', '', '4', '', '', '1', '', null, '\'23333333333333333333\'', '0');
INSERT INTO `xjy_third_party_user` VALUES ('3', '0', '1524189053', '0', '1510998959', '4', '1', '测试登录', '', '123115', '', '', '10086', '', null, '20', '0');
INSERT INTO `xjy_third_party_user` VALUES ('4', '20', '1530095732', '0', '1524636322', '77', '1', '', '', 'wx4612824b7c9f43b5', '110.184.33.63', '', 'oGxoe1VxD1CQbWK5UrSM0HHlUu4k', '', '{\"gender\":1,\"nickName\":\"\\u9ece\\u6d69\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTJVVBpDhvNsU3eJ8ynXzhlalc5icSYcJ3dsePDXb3MnvUIaAG8HyMXsyQYckThB9KqGibsvaFVmECaQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', '', '0');
INSERT INTO `xjy_third_party_user` VALUES ('5', '21', '1529726756', '0', '1524640177', '50', '1', '南冥灬雨', '', 'wx4612824b7c9f43b5', '125.69.124.66', '', 'oGxoe1VMYH4M3Np_ITy1kxRKGUEw', '', '{\"gender\":1,\"nickName\":\"\\u8c22\\u946b\\u78ca\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/FnfnEco7BdgKxoHHcyvTCbeCDureVVREsoovd0TuNUmZ55iaVPgLUmB5Ha6WBxrryp2sPPpJLBV4VEm5PvnlJcw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/FnfnEco7BdgKxoHHcyvTCbeCDureVVREsoovd0TuNUmZ55iaVPgLUmB5Ha6WBxrryp2sPPpJLBV4VEm5PvnlJcw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('6', '22', '1530091376', '0', '1524650166', '31', '1', 'Hosni', '', 'wx4612824b7c9f43b5', '171.210.34.123', '', 'oGxoe1Sc-eO2WLhPD1Sbe2NoQch8', '', '{\"gender\":1,\"nickName\":\"Hosni\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/6OlFfArInlmYpyW4B0jX0zvfCKuIyZQbhBB6iaLsxxFibafzic5xyibDITibJicy1K6b8m34eNXMd1BY2ODWQJicCickiag\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/6OlFfArInlmYpyW4B0jX0zvfCKuIyZQbhBB6iaLsxxFibafzic5xyibDITibJicy1K6b8m34eNXMd1BY2ODWQJicCickiag/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('7', '23', '1530089003', '0', '1524817776', '65', '1', '品味中国', '', 'wx4612824b7c9f43b5', '110.184.33.63', '', 'oGxoe1Z-ZFB-zeanSTT8U-BOKreQ', '', '{\"gender\":1,\"nickName\":\"\\u54c1\\u5473\\u4e2d\\u56fd\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/R9hiag9MqTHZdooQcRfolOFHWjbQDniaj3bAZFiaJg0LxrAXiaXOOp70eFbxTH3XAkJia5gibLu7584mo5hicDWZ9TTlg\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/R9hiag9MqTHZdooQcRfolOFHWjbQDniaj3bAZFiaJg0LxrAXiaXOOp70eFbxTH3XAkJia5gibLu7584mo5hicDWZ9TTlg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('8', '26', '1524898842', '0', '1524898841', '2', '1', '余東洺', '', 'wx4612824b7c9f43b5', '117.139.208.9', '', 'oGxoe1ZGyYxrowWRGenbOYISNGb8', '', '{\"gender\":2,\"nickName\":\"\\u4f59\\u6771\\u6d3a\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/2fm5CUGvV73IPI5UJiaHFpMVpq0pM314XlY06l0c4lfAPdcAQQ2UY46YzPgI9mLFuIPEGA6VFlc4a00gOpbNO0w\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/2fm5CUGvV73IPI5UJiaHFpMVpq0pM314XlY06l0c4lfAPdcAQQ2UY46YzPgI9mLFuIPEGA6VFlc4a00gOpbNO0w/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('9', '36', '1530073856', '0', '1526809451', '10', '1', '川味印象秦勇15216737215', '', 'wx4612824b7c9f43b5', '223.104.216.123', '', 'oGxoe1Rm3c-epA4rYiMS58WaEFuw', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5ddd\\u5473\\u5370\\u8c61\\u79e6\\u52c7\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTILsdfVI9jlvswcpGs78m2EbOFn4Ed9yXQfHhcTLAlFqvfyWdib2HlwIpoJqzSK9HHjaIOtkHwfRiag\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTILsdfVI9jlvswcpGs78m2EbOFn4Ed9yXQfHhcTLAlFqvfyWdib2HlwI1vSqdVBUGEr3UcYUI4JibHw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('10', '37', '1528361613', '0', '1527068811', '5', '1', '郁笙。', '', 'wx4612824b7c9f43b5', '110.184.37.49', '', 'oGxoe1aiRlJCrcveXXrX3WIFPCdg', '微信平台', '{\"gender\":1,\"nickName\":\"\\u732b\\u633d\\u3002\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/ics2BWvggibiawBaaskctFtXWNwwEIR1iaqxQhgUGoe1ibUYS36KAQyWYZ3ZdWSic7xueptmDAysNfd3oHAoGyDqI0Xg\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ics2BWvggibiawBaaskctFtXWNwwEIR1iaqxQhgUGoe1ibUYS36KAQyWYZ3ZdWSic7xuep3Wz3YZ9pac6yjChNM3oK8A/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('11', '38', '1530003652', '0', '1527732915', '7', '1', 'Chencen', '', 'wx4612824b7c9f43b5', '117.136.63.165', '', 'oGxoe1ffK94rTQxvMeMfR8aFVYwk', '微信平台', '{\"gender\":2,\"nickName\":\"Chencen\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTIe0a4SU6iczsDicSUQXUKJwBa0L7icDMngyNdq6v5XgLowL2nKb7icQiauIWLqX5nW4hkzWIibcNYNYpQQ\\/132\",\"user_address\":\"\\u7ef4\\u591a\\u5229\\u4e9a\\u58a8\\u5c14\\u672c\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIe0a4SU6iczsDicSUQXUKJwBa0L7icDMngyNdq6v5XgLowL2nKb7icQiauIWLqX5nW4hkzWIibcNYNYpQQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('12', '39', '1530090016', '0', '1527733274', '7', '1', '彩色风林', '', 'wx4612824b7c9f43b5', '171.223.32.71', '', 'oGxoe1UhqbiOdThWTKFeedKJ3SOo', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5f69\\u8272\\u67ab\\u6797\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/iaZbYjI1GKasuVt3qXiaflQzeNFtL4HPDOkbH9vibFibZbHT7TQaACibOxVJva5x4seicqCDrHRiagf9Ve7KdAb5r7C7g\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/iaZbYjI1GKasuVt3qXiaflQzeNFtL4HPDOkbH9vibFibZbHT7TQaACibOxVJva5x4seicqCDrHRiagf9Ve7KdAb5r7C7g/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('13', '40', '1529917932', '0', '1527735761', '4', '1', '桃花', '', 'wx4612824b7c9f43b5', '171.223.32.71', '', 'oGxoe1XDV9FNmhaP7aYYaCwFQ_vM', '微信平台', '{\"gender\":0,\"nickName\":\"\\u6843\\u82b1\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/bIOE3icSicttKJZRRVJJpI3FO20euzqhtic3mmgjuGicibCT0cIE7jcJjRBbEs7OA5EIbF174Z90icfs0CPFaQepicY0A\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/bIOE3icSicttKJZRRVJJpI3FO20euzqhtic3mmgjuGicibCT0cIE7jcJjRBbEs7OA5EIbF174Z90icfs0CPFaQepicY0A/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('14', '41', '1529995110', '0', '1527749612', '4', '1', '人生就是一场经历@', '', 'wx4612824b7c9f43b5', '110.184.38.75', '', 'oGxoe1ZPnMBU-f_bx_pd9LM6YIr4', '微信平台', '{\"gender\":1,\"nickName\":\"\\u4eba\\u751f\\u5c31\\u662f\\u4e00\\u573a\\u7ecf\\u5386@\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/2vibEmr3e6jqUF3pBot3Uic2cT1PQbcZuPIZIHCmRJPibCsFuMv0dFiaZxg59BhZReILCsMIwWEBZbf2T1wvcTQhGQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/2vibEmr3e6jqUF3pBot3Uic2cT1PQbcZuPIZIHCmRJPibCsFuMv0dFiaZxg59BhZReILCsMIwWEBZbf2T1wvcTQhGQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('15', '42', '1529991461', '0', '1527749613', '8', '1', '', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1UAiLNRE2VY9vh9bAsZ1RrQ', '微信平台', '{\"gender\":2,\"nickName\":\"\\ud83d\\udc8bpfc\\u4f34\\u6211\\u4e45\\u4e45\\u53ef\\u597d\\ud83d\\udc8b\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/M0TTYA7lvC1ge3eXn88G9icGzibPsGP70qZ5NZpTiatgNdd4Znmp503n3iaBuc8La3bic9YPibtqyLFGdGQLcd5kFjyQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/M0TTYA7lvC1ge3eXn88G9icGzibPsGP70qZ5NZpTiatgNdd4Znmp503n3iaBuc8La3bicxYcicic2fe8RfGwBvszLtLdA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('16', '43', '1529986109', '0', '1527749614', '10', '1', '任性、诠释了我们的青春', '', 'wx4612824b7c9f43b5', '171.210.165.32', '', 'oGxoe1fb1uDsmIQhSKXmJ58IPOFs', '微信平台', '{\"gender\":1,\"nickName\":\"\\u4efb\\u6027\\u3001\\u8be0\\u91ca\\u4e86\\u6211\\u4eec\\u7684\\u9752\\u6625\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTKTXzqsgAaBOXeZ8s4MP65C6amTYRXpX0iaTUgiaicl16DzibDgiaaicHxrZo607iapqu1zZxZalGpQicrstA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKTXzqsgAaBOXeZ8s4MP65C6amTYRXpX0iaTUgiaicl16DzibDgiaaicHxrZo607iapqu1zZxZalGpQicrstA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('17', '44', '1530005860', '0', '1527749616', '9', '1', '玉梅儿', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1YAk851Xo_Ws_yEA3jAPEkw', '微信平台', '{\"gender\":2,\"nickName\":\"\\u7389\\u6885\\u513f\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/ekFWm6NDQzQ6yBO03HDq0saUX12h80ZMjmOvZsThsec2fxVkZle7VohLUHcL1bFc0EH1Dxyz3YWEhpXSicicUBibw\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ekFWm6NDQzQ6yBO03HDq0saUX12h80ZMjmOvZsThsec2fxVkZle7VohLUHcL1bFc0EH1Dxyz3YWEhpXSicicUBibw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('18', '45', '1529984707', '0', '1527749618', '5', '1', '海洋之星', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1beh_PhMj59GJ0-KU0KK238', '微信平台', '{\"gender\":2,\"nickName\":\"\\u6d77\\u6d0b\\u4e4b\\u661f\\uff5e\\u8054\\u7cfb\\u65b9\\u5f0f13882104862\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/PVJ9CBd6fPFA3Cdvpyr0iaAskKlmMmTLNu7SWTBxtFTXs7W6vYddObTl0FlfiaTOlia0FEyzE7DR7B3xnHaJ0bMibQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/PVJ9CBd6fPFA3Cdvpyr0iaAskKlmMmTLNu7SWTBxtFTXs7W6vYddObTl0FlfiaTOlia0FEyzE7DR7B3xnHaJ0bMibQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('19', '46', '1529984512', '0', '1527749619', '9', '1', 'Later', '', 'wx4612824b7c9f43b5', '110.184.38.140', '', 'oGxoe1Wtp5dlHnf8u1h2-IoMyDJU', '微信平台', '{\"gender\":2,\"nickName\":\"Later\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/COvoKLRm7ybCWB3q2KuBQrymV1icn113s1EU2pbLHMUsSENvNj5v852iamxGGE2JGfpANPsSLr8PbvoIDQy1safQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u963f\\u575d\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/COvoKLRm7ybCWB3q2KuBQrymV1icn113s1EU2pbLHMUsSENvNj5v852iamxGGE2JGfpANPsSLr8PbvoIDQy1safQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('20', '47', '1530150304', '0', '1527749621', '12', '1', '情', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1doZZO7Lwk5aHcWntUVrSO4', '微信平台', '{\"gender\":1,\"nickName\":\"\\u60c5\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83epMSjakiavMwHVn41rRFfQRZSg0ENOWjZW5uZLHMrVlFF754ibQlibeJSf08gqmqVfsibM1Ts2bnjWnibA\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epMSjakiavMwHVn41rRFfQRZSg0ENOWjZW5uZLHMrVlFF754ibQlibeJSf08gqmqVfsibM1Ts2bnjWnibA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('21', '48', '1530095087', '0', '1527749622', '6', '1', '南帝', '', 'wx4612824b7c9f43b5', '223.104.216.53', '', 'oGxoe1XoTYXGp0n_5YzAzWdNSHC8', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5357\\u5e1d\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/s3VZAbuz2Z1zP6FcaGOYRhkicoGC9yT7l1RaJSxJBibLmMU7BMeicFczgs9yxyU6GjjKXwMdJCZibLcyP8xGMr0OwQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/s3VZAbuz2Z1zP6FcaGOYRhkicoGC9yT7l1RaJSxJBibLmMU7BMeicFczgs9yxyU6GjjKXwMdJCZibLcyP8xGMr0OwQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('22', '49', '1529831132', '0', '1527749624', '5', '1', '二锅头', '', 'wx4612824b7c9f43b5', '139.207.25.178', '', 'oGxoe1eBsrPWkcCosHyGtQDHjzVA', '微信平台', '{\"gender\":2,\"nickName\":\"\\u4e8c\\u9505\\u5934\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/d5cBBmtIRNtrSdumxLVb3bO50ccBCVmzjh3wAcPU7s2da68PQlbYG6SGQBTW7fJLswU37ib5dQIz63Sg1TVfoFQ\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/d5cBBmtIRNtrSdumxLVb3bO50ccBCVmzjh3wAcPU7s2da68PQlbYG6SGQBTW7fJLjyw9Y1iakSe9K0qxH98agZg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('23', '50', '1529485888', '0', '1527749634', '2', '1', 'JIAN。', '', 'wx4612824b7c9f43b5', '101.206.167.114', '', 'oGxoe1av44CHktbjLAtUB-VdU8Eo', '微信平台', '{\"gender\":2,\"nickName\":\"JIAN\\u3002\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/TYPuwz3zUpqA1ofGzSvM4sYa8rib1CeNT2VjxE9pU5AVmzrsI29qHUGk7x26nS2yYpAgicuAtVH1gfWmL1tjZ4qg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/TYPuwz3zUpqA1ofGzSvM4sYa8rib1CeNT2VjxE9pU5AVmzrsI29qHUGk7x26nS2yYpAgicuAtVH1gfWmL1tjZ4qg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('24', '51', '1529984508', '0', '1527749702', '6', '1', '丫头', '', 'wx4612824b7c9f43b5', '117.136.63.140', '', 'oGxoe1fm_kEfTOVaTPRtm3Z9w4Ds', '微信平台', '{\"gender\":2,\"nickName\":\"\\u4e2b\\u5934\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/AStWfQ6jicJxiczEJ0n4X6dqzJUXBONFrLUH5wkwvDeWaCicQ7icRZoGdzclKoHW3RiaU46qfXWJFhAbKOAeUD1BYpQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/AStWfQ6jicJxiczEJ0n4X6dqzJUXBONFrLUH5wkwvDeWaCicQ7icRZoGdzclKoHW3RiaUXBFN2McO8Q8gKozHVwWEKg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('25', '52', '1529984693', '0', '1527749766', '6', '1', '别问我是谁', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1YFoDFh-mh3HgB5hTvMxdmI', '微信平台', '{\"gender\":2,\"nickName\":\"\\ue110\\u522b\\u95ee\\u6211\\u662f\\u8c01\\ue110\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTJ0wBXrCUVbWBpvNN8Ew3tUCgwFF0qz5PQic0sbTF3vib0PjskpT30QHW76cxPwLO8XGIfDbWLZPkmw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJ0wBXrCUVbWBpvNN8Ew3tUCgwFF0qz5PQic0sbTF3vib0PjskpT30QHW76cxPwLO8XGIfDbWLZPkmw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('26', '53', '1529924467', '0', '1527749767', '4', '1', '南北', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1YgC5eVAfeRIEy1zj-NiZ7c', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5357\\u5317\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTLard73s4fMYNVW7eBTGOlhuHR9r31ArC2Q2Vj4yokxBg7VbM5hibib1USyRGA1AgcYNPWNpK1d2nCw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLard73s4fMYNVW7eBTGOlhuHR9r31ArC2Q2Vj4yokxBg7VbM5hibib1UVd70HAduiaiaqptb4pX3Y6jg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('27', '54', '1529825612', '0', '1527749781', '7', '1', '燕姐', '', 'wx4612824b7c9f43b5', '171.223.32.71', '', 'oGxoe1eTBY9IKjeUV4jz64QU95zU', '微信平台', '{\"gender\":2,\"nickName\":\"\\u71d5\\u59d0\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/FtHjELh6iadWcPQcmTvQrBw8dGhhVIt7FOvUeibUKojUGiaMzuPwxKfMPyIsNmYwJHRpiaJym2Olu00Qne32wBy0ibw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/FtHjELh6iadWcPQcmTvQrBw8dGhhVIt7FOvUeibUKojUGiaMzuPwxKfMPyIsNmYwJHRpiaJym2Olu00Qne32wBy0ibw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('28', '55', '1527750628', '0', '1527750628', '1', '1', '渊歌', '', 'wx4612824b7c9f43b5', '222.211.182.222', '', 'oGxoe1cZCy9QQck1rJd-IBNgFlmQ', '微信平台', '{\"gender\":1,\"nickName\":\"\\u6e0a\\u6b4c\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/8mpjS2GNWPFjXp9xzsUfic1Kv4TDykVhibLvDvI4S0w2nVHoZJmjAT5JfuPIQMW4XYSK0Fw9kRy6m5tT1SQSJf3Q\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/8mpjS2GNWPFjXp9xzsUfic1Kv4TDykVhibLvDvI4S0w2nVHoZJmjAT5JfuPIQMW4XYSK0Fw9kRy6m5tT1SQSJf3Q/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('29', '56', '1527751103', '0', '1527751103', '1', '1', '落叶纷飞', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1Yp4z3jwEfAphKXy8gYD-2I', '微信平台', '{\"gender\":1,\"nickName\":\"\\u843d\\u53f6\\u7eb7\\u98de\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/WiaiaMkbC0nqQURZ5JbIQKOQ9b8k75QFicqet6tyYShv2K837WOCGbQEG9V5veY3sbA5ITYwJQUv8Rynbvic0XFHAw\\/132\",\"user_address\":\"\\u91cd\\u5e86\\u9149\\u9633\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/WiaiaMkbC0nqQURZ5JbIQKOQ9b8k75QFicqet6tyYShv2K837WOCGbQEG9V5veY3sbA5ITYwJQUv8Rynbvic0XFHAw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('30', '57', '1529486322', '0', '1527751148', '12', '1', '小燕', '', 'wx4612824b7c9f43b5', '110.184.36.159', '', 'oGxoe1SzR4ZqQMZ-JVKUkz8riQ2E', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5c0f\\u71d5\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTKVUCukKunFOAfEgBJspGBFJIT1TMY5apEnlJ0Q4H1RLniaSMmyLKdIWwnc6ufk8WwhtWrjjOSLT0A\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u8d44\\u9633\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKVUCukKunFOAfEgBJspGBFJIT1TMY5apEnlJ0Q4H1RLniaSMmyLKdIWGet6PpLFxQEefUsJ5XItuw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('31', '58', '1530006071', '0', '1527841732', '7', '1', '琴婧', '', 'wx4612824b7c9f43b5', '171.223.32.71', '', 'oGxoe1TjDYpVZsao15q_jmpbamI4', '微信平台', '{\"gender\":2,\"nickName\":\"\\u7434\\u5a67\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/D51Ez4AAKETXvrNbibK9A3SCKxQHtRbF1NsMwg9Ixjc1pEOdkxFexGe85vfZ0vDPQVXAXg5rMhmO73tUYXeibbpw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/D51Ez4AAKETXvrNbibK9A3SCKxQHtRbF1NsMwg9Ixjc1pEOdkxFexGe85vfZ0vDPQVuZdloQ1DAgDtlqRbQNNnA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('32', '59', '1530070153', '0', '1528177693', '11', '1', '用微笑、掩饰不安', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1SNWlrkyAjQr4QJGw4wWP4Q', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5f20\\u671b\\u7684\\u65f6\\u5149\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/ibbg35VbtSTV5zV1jSa4CWq0PjoWYOkK1TQjmBpsNt3m6poVaIBt9rsN6y3iauWXu5snTwnB5TMhSjwKXtt6TaUA\\/132\",\"user_address\":\"\\u56db\\u5ddd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ibbg35VbtSTV5zV1jSa4CWq0PjoWYOkK1TQjmBpsNt3m6poVaIBt9rsN6y3iauWXu50dLicSkqFIg9jREHePbibbdQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('33', '60', '1528268516', '0', '1528268516', '1', '1', '天昕', '', 'wx4612824b7c9f43b5', '110.184.37.49', '', 'oGxoe1V8gpKbWzYse7Wzm2O94m7g', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5929\\u6615\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTJMW3f6jeDLDXASRXxExEDvmOdZNKSKFrWonFH3XFHdNkMiaibba4dgSRfKiaNY88FXMv4t7oaSHy5cg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJMW3f6jeDLDXASRXxExEDvmOdZNKSKFrWonFH3XFHdNkMiaibba4dgSRfKiaNY88FXMv4t7oaSHy5cg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('34', '61', '1528361642', '0', '1528361642', '1', '1', '武陵刀王', '', 'wx4612824b7c9f43b5', '110.184.37.49', '', 'oGxoe1Slmwj_YM30CQMEA1MQnNWI', '微信平台', '{\"gender\":0,\"nickName\":\"\\u6b66\\u9675\\u5200\\u738b\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTLDWrn4NBpLf1aS3YibOxV3nMEcB90t3Nx5frCY0IoEzctEn2dPM4QVje2KJfiag5NSclzRdjUZg7Tw\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLDWrn4NBpLf1aS3YibOxV3nMEcB90t3Nx5frCY0IoEzctEn2dPM4QVje2KJfiag5NSclzRdjUZg7Tw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('35', '62', '1530091100', '0', '1528780925', '3', '1', '吃亏是福（杜晓东）', '', 'wx4612824b7c9f43b5', '110.184.33.251', '', 'oGxoe1dNQ0_u_J73gduC8QCYPLkA', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5403\\u4e8f\\u662f\\u798f\\uff08\\u675c\\u6653\\u4e1c\\uff09\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/2WCb4rGJ6407r9XbG1ibbiaUx0jZT0bdtRprAm3RSSwwbvvVF18lOoQk1BKGVB3ibxBW9jGSRvHJLDhU1tc5mhic9A\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/2WCb4rGJ6407r9XbG1ibbiaUx0jZT0bdtRprAm3RSSwwbvvVF18lOoQk1BKGVB3ibxBW9jGSRvHJLDhU1tc5mhic9A/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('36', '63', '1530006022', '0', '1528783534', '5', '1', '爱文弟', '', 'wx4612824b7c9f43b5', '110.184.38.75', '', 'oGxoe1bGHDB12mc_NzY6Q2UWqIA8', '微信平台', '{\"gender\":1,\"nickName\":\"\\u7231\\u6587\\u5f1f\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/e6MOM2dHvushyEwKDqY93ymmlVphJiayko2tzJTChrjggpYjb6KqicKqtcY1aBK8QXpZp3VGiaAicQoTdDITJJbbJg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u7ef5\\u9633\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/e6MOM2dHvushyEwKDqY93ymmlVphJiayko2tzJTChrjggpYjb6KqicKqtcY1aBK8QXufESW9zYE5QlW7EBp57VLw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('37', '64', '1529984547', '0', '1528783578', '4', '1', 'づ苏沫妤', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1dcP1qit7gPp6lw_P0NzR38', '微信平台', '{\"gender\":2,\"nickName\":\"\\u3065\\u82cf\\u6cab\\u59a4\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTL0uZWOCiaffvWGIItZcPtRA1AyVv3GM7iaeIZgCzTJXeDFMDPJDqebLPDCayb3G42NQJSykua6bjicw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u5185\\u6c5f\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTL0uZWOCiaffvWGIItZcPtRA1AyVv3GM7iaeIZgCzTJXeDFMDPJDqebLPDCayb3G42NQJSykua6bjicw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('38', '65', '1530007603', '0', '1528784951', '5', '1', '尽量改变自己', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1ZSinXrGmvZm8LbI07WQJSc', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5c3d\\u91cf\\u6539\\u53d8\\u81ea\\u5df1\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/2HTU1lARXy0DNpa0nRiapMclibxXdb4uBqhicymbFsuRuXt4Cv6lcrMANzhyCuKUAOTmzJDxmuFf2SDx8CRQv9wuQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/2HTU1lARXy0DNpa0nRiapMclibxXdb4uBqhicymbFsuRuXt4Cv6lcrMANzhyCuKUAOTmzJDxmuFf2SDx8CRQv9wuQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('39', '66', '1529488989', '0', '1528788540', '2', '1', '四川人', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1YSr4oDLEvM3tzPZ_Ft4WIE', '微信平台', '{\"gender\":1,\"nickName\":\"\\u56db\\u5ddd\\u4eba\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTINfm2yDMH1r4DkricQ9zV8kvCJrrcu2vgqr0fEreibiaa5VeSibZSpWDcx5Jp6exq3B4ITE69DS0PsVw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTINfm2yDMH1r4DkricQ9zV8kvCJrrcu2vgqr0fEreibiaa5VeSibZSpWDcx5Jp6exq3B4ITE69DS0PsVw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('40', '67', '1529635660', '0', '1528789142', '2', '1', '开始流浪', '', 'wx4612824b7c9f43b5', '110.184.38.90', '', 'oGxoe1ZS4k2S_YGgTiJaoAnmGbdw', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5f00\\u59cb\\u6d41\\u6d6a\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/nzEWxyQpKrDnfkXurndGpZEpd31sS2HuKNzhgve76otNtJIVtH1KBDB4NxOtIFywJ2WIMt5ZqZkrBoEdCXibhvA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u7ef5\\u9633\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/nzEWxyQpKrDnfkXurndGpZEpd31sS2HuKNzhgve76otNtJIVtH1KBDB4NxOtIFywJ2WIMt5ZqZkrBoEdCXibhvA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('41', '68', '1528789222', '0', '1528789222', '1', '1', '不许流年', '', 'wx4612824b7c9f43b5', '110.184.33.65', '', 'oGxoe1QrMkFfKoXblJwRIDrUGlSg', '微信平台', '{\"gender\":1,\"nickName\":\"\\u4e0d\\u8bb8\\u6d41\\u5e74\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Tp5fCsKL6dECbShF0nfZrEDu9kC28DEu5gjibcWbl8qJu1JdeqxibXlnmpVeviaBStruUbicOG5WMG8b9mRiaicWbllQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Tp5fCsKL6dECbShF0nfZrEDu9kC28DEu5gjibcWbl8qJu1JdeqxibXlnmpVeviaBStruUbicOG5WMG8b9mRiaicWbllQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('42', '69', '1530007742', '0', '1528789238', '2', '1', '仰天长笑', '', 'wx4612824b7c9f43b5', '117.136.62.61', '', 'oGxoe1bwjC2NpuQQ7TxKo9vUfxGA', '微信平台', '{\"gender\":1,\"nickName\":\"\\u4ef0\\u5929\\u957f\\u7b11\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/XG4WBgoq0cDRoQ4IphPet5wNbFyAicwsYBa5ZIFSLXBJEdqAEjbFNWgvecWdPHJW8HZfSicEQGFEwIMxSPWW2T2Q\\/132\",\"user_address\":\"\\u4e91\\u5357\\u662d\\u901a\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/XG4WBgoq0cDRoQ4IphPet5wNbFyAicwsYBa5ZIFSLXBJEdqAEjbFNWgvecWdPHJW8HZfSicEQGFEwIMxSPWW2T2Q/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('43', '70', '1529980507', '0', '1528789301', '3', '1', '虚幻的梦', '', 'wx4612824b7c9f43b5', '222.211.182.211', '', 'oGxoe1Sj2sCrw61FXMa1xk7VBBLU', '微信平台', '{\"gender\":0,\"nickName\":\"\\u865a\\u5e7b\\u7684\\u68a6\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/3LwKfG9K6kiaOEMLEtw7cOkbKwrq8Jl8l41Wp4Zs4vITyllbzuf06V52zyRb4bcZSuyddtIyaUhPibIccODxESwg\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/3LwKfG9K6kiaOEMLEtw7cOkbKwrq8Jl8l41Wp4Zs4vITyllbzuf06V52zyRb4bcZSuyddtIyaUhPibIccODxESwg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('44', '71', '1529984599', '0', '1528789374', '4', '1', '七爷', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1UNBMArNYzOOrGNYS2woG2k', '微信平台', '{\"gender\":2,\"nickName\":\"\\u4e03\\u7237\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTJLHJiar5ry33vEkg13eedsCDHaNV9S0MS6wVA2dStqwW4UQJ46T3LTdkAVB28XBrUuibGBIvcSNk5g\\/132\",\"user_address\":\"\\u51ef\\u91cc\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJLHJiar5ry33vEkg13eedsCDHaNV9S0MS6wVA2dStqwW4UQJ46T3LTdkAVB28XBrUuibGBIvcSNk5g/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('45', '72', '1528789485', '0', '1528789485', '1', '1', '繁花似锦', '', 'wx4612824b7c9f43b5', '110.184.33.65', '', 'oGxoe1RMm7g4RdAJbfT9U7t19zsc', '微信平台', '{\"gender\":0,\"nickName\":\"\\u7e41\\u82b1\\u4f3c\\u9526\\ue022\\ue022\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83eogTLyCM8KkDQUgWpT84oxYFeaF99Le4GTtOa5iau98assxf6ibsrdlMC9h4Gr09YBqw3xQrBcgplFw\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eogTLyCM8KkDQUgWpT84oxYFeaF99Le4GTtOa5iau98assxf6ibsrdlMC9h4Gr09YBqw3xQrBcgplFw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('46', '73', '1529984543', '0', '1528789531', '2', '1', '有人@我', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1TjhOoUnBFdDKhIX_fazSdk', '微信平台', '{\"gender\":1,\"nickName\":\"\\u6709\\u4eba@\\u6211\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/bNg76ejYSXvRsM5pGNHH7yqZQmAY3cpVGFnbkJElRAHFR1sjpWia9gGscFnZHicEHlpq3Ribk7icx1DZiabaoUC651w\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u7ef5\\u9633\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/bNg76ejYSXvRsM5pGNHH7yqZQmAY3cpVGFnbkJElRAHFR1sjpWia9gGscFnZHicEHlpq3Ribk7icx1DZiabaoUC651w/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('47', '74', '1528789578', '0', '1528789578', '1', '1', '微笑', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1QwB7Og_eG9bzug2XjkLgYM', '微信平台', '{\"gender\":0,\"nickName\":\"\\u5fae\\u7b11\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/acjcuuTycbaUJp7osibWR7oJEWZ90Ve7xjhhXElk9CT663SxJDLLdvj7euImFZfReUDicl89kLj1VSBIqc8F9xGA\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/acjcuuTycbaUJp7osibWR7oJEWZ90Ve7xjhhXElk9CT663SxJDLLdvj7euImFZfReUDicl89kLj1VSBIqc8F9xGA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('48', '75', '1528849973', '0', '1528849973', '1', '1', '幸福', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1VIBj3f1IiqkzciWraRqzoU', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5e78\\u798f\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/XLXutttfiajrbaFibic4ofkOrza8ILzA7VlfShISUibw0sRgpz36EEbib9c9SSEfHV1laqgNbGJbBd9maZESHickh9RQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/XLXutttfiajrbaFibic4ofkOrza8ILzA7VlfShISUibw0sRgpz36EEbib9c9SSEfHV1laqgNbGJbBd9maZESHickh9RQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('49', '76', '1528858235', '0', '1528858235', '1', '1', '夜& 微凉~zZ', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1bnjo75wfu41OnpwK7QL-YI', '微信平台', '{\"gender\":0,\"nickName\":\"\\u591c& \\u5fae\\u51c9~zZ\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Vs8R6iaHKnDk4sia7dAk3Dib0AGsoMrlHTMeicJ50rYbwGEOeBCbXBiaeUqcBqqV3kaibDJdKQBUh10IhCCeIoVvOwuA\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Vs8R6iaHKnDk4sia7dAk3Dib0AGsoMrlHTMeicJ50rYbwGEOeBCbXBiaeUqcBqqV3kaibDJdKQBUh10IhCCeIoVvOwuA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('50', '77', '1528869363', '0', '1528869363', '1', '1', '唐', '', 'wx4612824b7c9f43b5', '101.206.167.168', '', 'oGxoe1fAKwZ8IyVUDIOEk6CJkcl0', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5510\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83eqoBNrGAszXzU75XY2yibn25rYGktyOKlEoFU8dW51CqMrC1dWYLUaUnU6ngtLzhMt05MjxgyiaKBbg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqoBNrGAszXzU75XY2yibn25rYGktyOKlEoFU8dW51CqMrC1dWYLUaUnU6ngtLzhMt05MjxgyiaKBbg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('51', '78', '1528869473', '0', '1528869473', '1', '1', '野望', '', 'wx4612824b7c9f43b5', '117.136.63.130', '', 'oGxoe1TzpbQPolqsacfp7ZV62IVw', '微信平台', '{\"gender\":1,\"nickName\":\"\\u91ce\\u671b\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/xdicGCy5dw3Qlb8bz0RLf1gBEFfT7AFEgdIc0ibstXo6SXk5wpVu6twrhhCU0znicH5eEVLl4Ir3YGLlSUN10Vo9Q\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/xdicGCy5dw3Qlb8bz0RLf1gBEFfT7AFEgdIc0ibstXo6SXk5wpVu6twrhhCU0znicH5eEVLl4Ir3YGLlSUN10Vo9Q/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('52', '79', '1528878600', '0', '1528878600', '1', '1', '冉光辉', '', 'wx4612824b7c9f43b5', '222.211.182.239', '', 'oGxoe1exI0e9kWJ7ac1HDwIwkwBM', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5189\\u5149\\u8f89\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/tsvfmBcs23VwXH9GmOkRH6ia8pJ0ldkWDv4fT0ICAwmibWIicZAVbknvbnicQlicmTsPBaticc2PBRtnaEFiavawT5Z9g\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/tsvfmBcs23VwXH9GmOkRH6ia8pJ0ldkWDv4fT0ICAwmibWIicZAVbknvbnicQlicmTsPBaticc2PBRtnaEFiavawT5Z9g/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('53', '80', '1528878988', '0', '1528878892', '2', '1', '回眸', '', 'wx4612824b7c9f43b5', '123.147.244.15', '', 'oGxoe1cHJLUigFhEcTMvOKcJUM7k', '微信平台', '{\"gender\":1,\"nickName\":\"\\u56de\\u7738\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/dP93Qib8AS2gz4JcFcmu4IZdRz8lBLLwnnWTOR9JJICCkSrmwEoRN3wk8OWJupXPic9MZibFeIVz6xFe0A4Wic6M2g\\/132\",\"user_address\":\"\\u91cd\\u5e86\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/dP93Qib8AS2gz4JcFcmu4IZdRz8lBLLwnnWTOR9JJICCkSrmwEoRN3wk8OWJupXPic9MZibFeIVz6xFe0A4Wic6M2g/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('54', '81', '1529807830', '0', '1528881486', '4', '1', '柏烨广告-01', '', 'wx4612824b7c9f43b5', '118.114.104.227', '', 'oGxoe1cUI2FEIh7cJcLy4T7zmhME', '微信平台', '{\"gender\":0,\"nickName\":\"\\u67cf\\u70e8\\u5e7f\\u544a-01\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/CYvUSVt0C4ADLibw2bELuBibsqg4dickVCfYGs2Tq8GXv5Pqia5PyN3lZ8g8ibsSKHYMChwjRqEuzRSiat2yicJ7Y3Tjg\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/CYvUSVt0C4ADLibw2bELuBibsqg4dickVCfYGs2Tq8GXv5Pqia5PyN3lZ8g8ibsSKHYMChwjRqEuzRSiat2yicJ7Y3Tjg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('55', '82', '1530099948', '0', '1529136120', '5', '1', ' 柳宝', '', 'wx4612824b7c9f43b5', '223.104.216.87', '', 'oGxoe1e4PNlczXed44reSe4Z4U_w', '微信平台', '{\"gender\":2,\"nickName\":\"\\ue328 \\u67f3\\u5b9d\\ue328\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTIbAcgp9o2B8tNPEHX5O95q24yHSxJrOSCCHOPCz5iak64HJJSQzuPrBMlmsMjTchen0dh98wyaGZA\\/132\",\"user_address\":\"\\u5317\\u4eac\\u77f3\\u666f\\u5c71\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIbAcgp9o2B8tNPEHX5O95q24yHSxJrOSCCHOPCz5iak64HJJSQzuPrBMlmsMjTchen0dh98wyaGZA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('56', '83', '1529918842', '0', '1529485970', '2', '1', '一只傻@阿荣', '', 'wx4612824b7c9f43b5', '110.184.38.140', '', 'oGxoe1dGkm5M5xb-MsCWEcNt2ho0', '微信平台', '{\"gender\":1,\"nickName\":\"\\u4e00\\u53ea\\u50bb@\\u963f\\u8363\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/ApNlcIJIHaJA11Kepba3dSiavWsSCIVyHWl6gKmoZwvS6dqT0onb6m0BXUTU9ymX98hAh08y94D7uicCv2yJRMtA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ApNlcIJIHaJA11Kepba3dSiavWsSCIVyHWl6gKmoZwvS6dqT0onb6m0BXUTU9ymX98hAh08y94D7uicCv2yJRMtA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('57', '84', '1529984523', '0', '1529486117', '3', '1', '', '', 'wx4612824b7c9f43b5', '110.184.38.140', '', 'oGxoe1WoIrVos_rIar2NlF5hfqHw', '微信平台', '{\"gender\":1,\"nickName\":\"\\ud83c\\udde8\\ud83c\\uddf3\\u963f\\u8363  Demon\\u309b\\u6f6e\\u6d41\\uff08\\u79c1\\uff09\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/iabXQCrWqUCYttcSfJVP9CACtIru13PjjMqKD7vUmhn8ewViaIQAKX360q10StVQT4jFQia6LCAIo0rIU2dCKUOzg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/iabXQCrWqUCYttcSfJVP9CACtIru13PjjMqKD7vUmhn8ewViaIQAKX360q10StVQT43N1Rb6f9H3kPYtYULECtkQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('58', '85', '1530007373', '0', '1529488415', '3', '1', '三年', '', 'wx4612824b7c9f43b5', '110.184.38.75', '', 'oGxoe1YrqqUliA7S4HPKiE-UmrRw', '微信平台', '{\"gender\":2,\"nickName\":\"\\u4e09\\u5e74\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83eqUBmStQSOtIzqvx0geCy6L8MW2spQKvhfJYWjx9ya0PdAGj5b7KEu3MylGI8vGG2WLughx69oREw\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqUBmStQSOtIzqvx0geCy6L8MW2spQKvhfJYWjx9ya0PdAGj5b7KEu3CN0Sn5Ao3diceJTWFjLiaDOA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('59', '86', '1529980584', '0', '1529488471', '2', '1', '可乐', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1UkhIwcqIJyPGMpwct8kIog', '微信平台', '{\"gender\":2,\"nickName\":\"\\u53ef\\u4e50\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/vp81ML0pFfzAGWU4v1Kcn9Wh5s8sauzMmiaDZ5K0ic44PlqnIendia2uhhraAFUMUGocQFdUD4icqplT05OZvmqltQ\\/132\",\"user_address\":\"Al Fujayrah\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/vp81ML0pFfzAGWU4v1Kcn9Wh5s8sauzMmiaDZ5K0ic44PlqnIendia2uhhraAFUMUGoBZOxMTBFiaoH7etq8XicdgoQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('60', '87', '1529490528', '0', '1529490528', '1', '1', 'A-H', '', 'wx4612824b7c9f43b5', '117.174.95.30', '', 'oGxoe1YzPcEWhQn_U-g5yqTv_2vk', '微信平台', '{\"gender\":2,\"nickName\":\"A-H\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/yyakpwENic4REdSfSlLjub6ayK49WHib3Zkjypia2FQgOYGcqJJnDYibhcOgZkic3GP0ictul5F4em08t5RzPMpbXGqw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u5357\\u5145\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/yyakpwENic4REdSfSlLjub6ayK49WHib3Zkjypia2FQgOYGcqJJnDYibhcOgZkic3GP0ictul5F4em08t5RzPMpbXGqw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('61', '88', '1529651024', '0', '1529651024', '1', '1', '天汇', '', 'wx4612824b7c9f43b5', '117.136.70.49', '', 'oGxoe1WEsGnI4YqI0BxfPcG47qFk', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5929\\u6c47\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/mVaN1K0AibPQfeCBG4dDkNiaglzEPGbJFEzvadEmz9cSg2unQicXoicQ9Kw0ia8yuibUAZeg7nLENjGfJ5tzmgc4IVfg\\/132\",\"user_address\":\"\\u5317\\u4eac\\u4e30\\u53f0\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/mVaN1K0AibPQfeCBG4dDkNiaglzEPGbJFEzvadEmz9cSg2unQicXoicQ9Kw0ia8yuibUAZeg7nLENjGfJ5tzmgc4IVfg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('62', '89', '1529728227', '0', '1529728227', '1', '1', '宋祉欢', '', 'wx4612824b7c9f43b5', '110.184.39.219', '', 'oGxoe1WCsL0pmJ8kd8GgYcd20bmQ', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5b8b\\u7949\\u6b22\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTKV1oFGkPN2D7sQaEkhw75jQKcHibVgwfyicEPM7yezMnMiaJPHmicr7JXceAvT4YpbjKYbS5wHoFxonA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKV1oFGkPN2D7sQaEkhw75jQKcHibVgwfyicEPM7yezMnMiaJPHmicr7JXceAvT4YpbjKYbS5wHoFxonA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('63', '90', '1529728375', '0', '1529728375', '1', '1', '龙', '', 'wx4612824b7c9f43b5', '117.136.63.152', '', 'oGxoe1ajGla5JGQkJemdxpg97h8E', '微信平台', '{\"gender\":1,\"nickName\":\"\\u9f99\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/8KiayooR1HTpQXJu77poYpaeAsIyKibbfnhIy8VnkRjkKPZCza9V6VMBXhvlZvvTmca7IicqU6ics6dCtCibE1jfw1Q\\/132\",\"user_address\":\"\\u963f\\u514b\\u91cc\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/8KiayooR1HTpQXJu77poYpaeAsIyKibbfnhIy8VnkRjkKPZCza9V6VMBXhvlZvvTmca7IicqU6ics6dCtCibE1jfw1Q/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('64', '91', '1529739696', '0', '1529739696', '1', '1', '刘岐+大连海鲜批发', '', 'wx4612824b7c9f43b5', '171.223.32.71', '', 'oGxoe1UIuPcvHPEm0y3za417pffg', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5218\\u5c90+\\u5927\\u8fde\\u6d77\\u9c9c\\u6279\\u53d1\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/hU3tEK1xZ3rAIw1pAvHyZqW68NiaIiaeMFibwaO2HaBSLwicAbKs1fj0Vhww4plNPf6pDLs2FmXdkHrLr8KApdUORQ\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/hU3tEK1xZ3rAIw1pAvHyZqW68NiaIiaeMFibwaO2HaBSLwicAbKs1fj0Vhww4plNPf6pDLs2FmXdkHrLr8KApdUORQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('65', '92', '1529745690', '0', '1529745690', '1', '1', '一心只为妳一人', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1W-FnN_WLwnuZiSQrSRCFco', '微信平台', '{\"gender\":1,\"nickName\":\"\\u4e00\\u5fc3\\u53ea\\u4e3a\\u59b3\\u4e00\\u4eba\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Y26sDWV2njnwwYUnEic9NQEkhQNjheia5jQiciajfXSDm9zyn0TbMIqAVKmB3RHibDnoQiaYbeFVIYYCt2cvCFOt7icPA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Y26sDWV2njnwwYUnEic9NQEkhQNjheia5jQiciajfXSDm9zyn0TbMIqAVKmB3RHibDnoQiaYbeFVIYYCt2cvCFOt7icPA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('66', '93', '1529821388', '0', '1529821388', '1', '1', '七哥', '', 'wx4612824b7c9f43b5', '171.223.32.71', '', 'oGxoe1SOalBBiHzAu-oXbhavfb2E', '微信平台', '{\"gender\":1,\"nickName\":\"\\u4e03\\u54e5\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/wsRmxcKeyV2TxvDQn5eekk2zTkia5RDickmBib79DaBgAesFtXpNWzIibE0XiasFEAxrm4RJocf2u7mgtUhmRndxxbg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/wsRmxcKeyV2TxvDQn5eekk2zTkia5RDickmBib79DaBgAesFtXpNWzIibE0XiasFEAxrm4RJocf2u7mgtUhmRndxxbg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('67', '94', '1529822087', '0', '1529822087', '1', '1', 'BEE', '', 'wx4612824b7c9f43b5', '117.136.63.173', '', 'oGxoe1ad4a_yy8jh1ZmnXE_BCcxw', '微信平台', '{\"gender\":1,\"nickName\":\"BEE\\ud83d\\udc1d13880116948\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/9vmNpnpybgibtho9zAz8GRQ0DKRFD2RVTbqn8kxJ5MtQTzfx01LbPYMqhQ5B6SbPVVtgibic3Zu3lm5mLWEXe5eLQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/9vmNpnpybgibtho9zAz8GRQ0DKRFD2RVTbqn8kxJ5MtQTzfx01LbPYMqhQ5B6SbPVVtgibic3Zu3lm5mLWEXe5eLQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('68', '95', '1529831260', '0', '1529831260', '1', '1', '大大', '', 'wx4612824b7c9f43b5', '139.207.25.178', '', 'oGxoe1Z1pZt0ntNM93eA3GUehCbE', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5927\\u5927\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Nrmd1Asp5FJu7lGhbKQ4DoKzD2nCaUnneZdibnxiaxLG67smsvC3xQTsYla2AeFpPDjCE7dx6H4Ss5Z03rC5ricww\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Nrmd1Asp5FJu7lGhbKQ4DoKzD2nCaUnneZdibnxiaxLG67smsvC3xQTsYla2AeFpPDjCE7dx6H4Ss5Z03rC5ricww/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('69', '96', '1529834845', '0', '1529834845', '1', '1', '千觞i', '', 'wx4612824b7c9f43b5', '110.184.35.237', '', 'oGxoe1aoAP0WNQJlZ3a9tzjDUGG0', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5343\\u89dei\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83eo3HceUtKUKzjK4yvicBxNY5ulbSbNmqejXBxnNaWwVh5G8UyAVkaIL13UNaw15dq4FuHKqDT3VxOA\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eo3HceUtKUKzjK4yvicBxNY5ulbSbNmqejXBxnNaWwVh5G8UyAVkaIL13UNaw15dq4FuHKqDT3VxOA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('70', '100', '1529923599', '0', '1529923599', '1', '1', '静々萱', '', 'wx4612824b7c9f43b5', '223.104.216.85', '', 'oGxoe1c8FqtKUtQqHqb3jHWzMe8M', '微信平台', '{\"gender\":2,\"nickName\":\"\\u9759\\u3005\\u8431\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/hQUo9ZZDcjneOyXd2soDRkFMgqRaiaA8rZ3ln5h9h2dJCvic8TZKJXictLKHx3z4licasP39VDM99fMjf3EyxCKiacg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/hQUo9ZZDcjneOyXd2soDRkFMgqRaiaA8rZ3ln5h9h2dJCvic8TZKJXictLKHx3z4licasP39VDM99fMjf3EyxCKiacg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('71', '101', '1529923782', '0', '1529923782', '1', '1', '石胜利', '', 'wx4612824b7c9f43b5', '171.223.32.71', '', 'oGxoe1XelUHm64YoXMu6Ww9WWgOg', '微信平台', '{\"gender\":0,\"nickName\":\"\\u77f3\\u80dc\\u5229\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/LI4hiaWPVGyGuqBmdX0nRD52pwtgrs3DLKnLRxblZL2VwhIXQzAqdsiatMGY2sYJzv34BvV2zzcZC9gXeqxNEuTw\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/LI4hiaWPVGyGuqBmdX0nRD52pwtgrs3DLKnLRxblZL2VwhIXQzAqdsiatMGY2sYJzv34BvV2zzcZC9gXeqxNEuTw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('72', '102', '1529924712', '0', '1529924712', '1', '1', '石兰13058127999', '', 'wx4612824b7c9f43b5', '112.97.192.136', '', 'oGxoe1QoYi03Op_IUj_Jfb7AyBM4', '微信平台', '{\"gender\":1,\"nickName\":\"\\u77f3\\u517013058127999\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/5mqzEySTibjZKLleRfcRE2xh8aE1YEUc4rEbteAMJxRMicVN2ibrN69ElDibEIHt6YXicqZDqrMiarq2IXbgk93MymJw\\/132\",\"user_address\":\"\\u5317\\u4eac\\u671d\\u9633\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/5mqzEySTibjZKLleRfcRE2xh8aE1YEUc4rEbteAMJxRMicVN2ibrN69ElDibEIHt6YXicqZDqrMiarq2IXbgk93MymJw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('73', '103', '1529929472', '0', '1529929472', '1', '1', '朱德锋', '', 'wx4612824b7c9f43b5', '117.136.62.101', '', 'oGxoe1UnehhQ9vdgwC5WQwpHzQXY', '微信平台', '{\"gender\":2,\"nickName\":\"\\u6731\\u5fb7\\u950b\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Cw3fAQust2NiaUSq1kcN8riclXNcXhVNBkuJfNjKG6wKYhV5iaGv4aFpBOhX3jPD6LB7KMiaXnYic5cZlNj5Rpe9XCg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u8fbe\\u5dde\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Cw3fAQust2NiaUSq1kcN8riclXNcXhVNBkuJfNjKG6wKYhV5iaGv4aFpBOhX3jPD6LB7KMiaXnYic5cZlNj5Rpe9XCg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('74', '104', '1529981630', '0', '1529981630', '1', '1', '晴天', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1boAEmPQEzkCd55xPDQ39HY', '微信平台', '{\"gender\":0,\"nickName\":\"\\u6674\\u5929\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/ImsHeARJf24CBNTFYSh9Qk80vjjEOyicShXLicSc9We7tlmDdgVjz3akCkqoicz720T0ZJMDsmiaAo2fnc76SgOP5Q\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ImsHeARJf24CBNTFYSh9Qk80vjjEOyicShXLicSc9We7tlmDdgVjz3akCkqoicz720T0ZJMDsmiaAo2fnc76SgOP5Q/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('75', '105', '1529985144', '0', '1529985144', '1', '1', 'R', '', 'wx4612824b7c9f43b5', '101.206.170.67', '', 'oGxoe1ae01S2lE6yuc1Zb2R3F8LM', '微信平台', '{\"gender\":2,\"nickName\":\"R\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/9TI94QLP4dpy3xhH9jXuBdXE5CLenBf03pWExFjdCunGLq1HdZHPnqoJkZM8w1hR3EDqiaIn7ibNZ2JlCxoic2zSA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/9TI94QLP4dpy3xhH9jXuBdXE5CLenBf03pWExFjdCunGLq1HdZHPnqoJkZM8w1hR3EDqiaIn7ibNZ2JlCxoic2zSA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('76', '106', '1529985188', '0', '1529985188', '1', '1', '傲娇', '', 'wx4612824b7c9f43b5', '139.207.52.70', '', 'oGxoe1dIRtmxWWwJXrsRrqZaH34k', '微信平台', '{\"gender\":2,\"nickName\":\"\\u50b2\\u5a07\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83eohbzP1wznJjMHag61X7PpqQDdc7rn9f8XydysAH77DamccIyictTd5Fn05jvv4X35aC6PH12Qq2aA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eohbzP1wznJjMHag61X7PpqQDdc7rn9f8XydysAH77DamccIyictTd5Fn05jvv4X35aC6PH12Qq2aA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('77', '107', '1529987951', '0', '1529987951', '1', '1', '大山', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1cUXz63OW47kAU_9B1KPOos', '微信平台', '{\"gender\":0,\"nickName\":\"\\u5927\\u5c71\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/PiajxSqBRaEIBLuWjWAeMOfeI7bvW2KbXlTGSP7qE3ow1rEdqx7SA9tfWkOPNiamjwkpiaVW27ow3AYMTykwOJXfg\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIBLuWjWAeMOfeI7bvW2KbXlTGSP7qE3ow1rEdqx7SA9tfWkOPNiamjwkpiaVW27ow3AYMTykwOJXfg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('78', '108', '1529987963', '0', '1529987963', '1', '1', '独孤九剑', '', 'wx4612824b7c9f43b5', '117.136.65.223', '', 'oGxoe1WTnm4ocLq3do33PdnySo0k', '微信平台', '{\"gender\":1,\"nickName\":\"\\u72ec\\u5b64\\u4e5d\\u5251\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/OCZB8zQibR6ql7Z6nOD4JtvIMZiaKENsXQlnVZfOq0pIPaVOX4mJQmpicSMUOlMq7g3ArNeG68pnQZWrCvbvyRxlA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u8d44\\u9633\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/OCZB8zQibR6ql7Z6nOD4JtvIMZiaKENsXQlnVZfOq0pIPaVOX4mJQmpicSMUOlMq7g3ArNeG68pnQZWrCvbvyRxlA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('79', '109', '1529990458', '0', '1529990458', '1', '1', '综合金融   滕芹', '', 'wx4612824b7c9f43b5', '139.207.94.166', '', 'oGxoe1ZBXpZ7r3rVRk_Ri9Vwzmqo', '微信平台', '{\"gender\":2,\"nickName\":\"\\u7efc\\u5408\\u91d1\\u878d   \\u6ed5\\u82b9\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83eqhf9NQyvibXhE7htuBrqa75vtEOiakXNUkOIrgQWjlBGoptAHs81gkaPaibmKjmiabRibCnOGfH7NT8fg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqhf9NQyvibXhE7htuBrqa75vtEOiakXNUkOIrgQWjlBGoptAHs81gkaPaibmKjmiabRibCnOGfH7NT8fg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('80', '110', '1530014263', '0', '1529993430', '3', '1', '英子', '', 'wx4612824b7c9f43b5', '110.184.38.140', '', 'oGxoe1ZDqjD6tOlCuZz1fCcXuMv4', '微信平台', '{\"gender\":2,\"nickName\":\"\\u82f1\\u5b50\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTK0cZnxTS0IoicT08dEb5GiawdV0ia1ku7p61ibdFPyvCWiaib5sfk6ibO0vBiba34gpXmy4Lpice2IzicnC8kw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK0cZnxTS0IoicT08dEb5GiawdV0ia1ku7p61ibdFPyvCWiaib5sfk6ibO0vBiba34gpXmy4Lpice2IzicnC8kw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('81', '111', '1529993484', '0', '1529993484', '1', '1', 'จุ๊บ你是柠檬超级酸', '', 'wx4612824b7c9f43b5', '117.136.62.102', '', 'oGxoe1bCfJXmqOGsG3Slq7oAmlOE', '微信平台', '{\"gender\":1,\"nickName\":\"\\u0e08\\u0e38\\u0e4a\\u0e1a\\u4f60\\u662f\\u67e0\\u6aac\\u8d85\\u7ea7\\u9178\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83er5wV1iat8Licm12uQDvs9ZVZk8vmTqU34SqibZmKicDy4iaX7mcrPB2jgicJEgqiaa4LuYuubsViaLGDwcpQ\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83er5wV1iat8Licm12uQDvs9ZVZk8vmTqU34SqibZmKicDy4iaX7mcrPB2jgicJEgqiaa4LuYuubsViaLGDwcpQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('82', '112', '1530098190', '0', '1530006074', '3', '1', '罗杰 (塑胶地板)', '', 'wx4612824b7c9f43b5', '119.4.252.157', '', 'oGxoe1T3neFDb0LFRSMQVIqggWWc', '微信平台', '{\"gender\":1,\"nickName\":\"\\u7f57\\u6770 (\\u5851\\u80f6\\u5730\\u677f)\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTKiaCYWiak1CC3icxgXia0DhklZxtldpbB33wvvD3jefExA7G0scAV8y2oQ6dCRibqN27lpib6grFgTia3iaw\\/132\",\"user_address\":\"Umm al Qaiwain\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKiaCYWiak1CC3icxgXia0DhklZxtldpbB33wvvD3jefExA7G0scAV8y2oQ6dCRibqN27lpib6grFgTia3iaw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('83', '113', '1530017965', '0', '1530010090', '2', '1', '陈燕', '', 'wx4612824b7c9f43b5', '117.136.62.91', '', 'oGxoe1QK8fOSvALtCNLsSjvcbBt0', '微信平台', '{\"gender\":2,\"nickName\":\"\\u9648\\u71d5\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTKNpepsCnC60WPF6icfTBiaVe2jamQ3t5XSJVuyHsuKooPQv5Glkran8fr9TnVZhnROHCM4Hib1rSrcw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKNpepsCnC60WPF6icfTBiaVe2jamQ3t5XSJVuyHsuKooPQv5Glkran8fr9TnVZhnROHCM4Hib1rSrcw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('84', '114', '1530063365', '0', '1530063365', '1', '1', '永不言败', '', 'wx4612824b7c9f43b5', '60.255.137.222', '', 'oGxoe1WewAUagDjkIzf_T6ZOQl84', '微信平台', '{\"gender\":1,\"nickName\":\"\\u6c38\\u4e0d\\u8a00\\u8d25\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/1LicJkQNo7ic1sviasoXzcS8VzlHMNFz8h8QiaUjqYiapmJQ0ydrvYREdCk2NwYOyz0GoLkgvkGjIvnBszA5t5x9ZMA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/1LicJkQNo7ic1sviasoXzcS8VzlHMNFz8h8QiaUjqYiapmJQ0ydrvYREdCk2NwYOyz0GoLkgvkGjIvnBszA5t5x9ZMA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('85', '115', '1530067470', '0', '1530067470', '1', '1', '裙子控', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1alvvNjFHefgvOK4y0QioRs', '微信平台', '{\"gender\":2,\"nickName\":\"\\u88d9\\u5b50\\u63a7\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/WgDvzLVTxx0KGy0mDzr9Md1BV1XCnDZWnIIibiclCu2Dq6So7nKjRBk64nVr3NvMUxxRQ20iaOqXhLicu3TjCIO0iaw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/WgDvzLVTxx0KGy0mDzr9Md1BV1XCnDZWnIIibiclCu2Dq6So7nKjRBk64nVr3NvMUxxRQ20iaOqXhLicu3TjCIO0iaw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('86', '116', '1530098269', '0', '1530068443', '3', '1', '筱燕', '', 'wx4612824b7c9f43b5', '139.207.41.164', '', 'oGxoe1bj8g7CGDHv1vJGw47-I0oM', '微信平台', '{\"gender\":2,\"nickName\":\"\\u7b71\\u71d5\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTKsNN0PyDl8Ok9HwYPsuxuibo2tIicTXBecJ97MlECddxZPH1YmC9WeM95IdfnBEiarobHxXQfIA2zUA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKsNN0PyDl8Ok9HwYPsuxuibo2tIicTXBecJ97MlECddxZPH1YmC9WeM95IdfnBEiarobHxXQfIA2zUA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('87', '117', '1530069813', '0', '1530069813', '1', '1', '张雪锋', '', 'wx4612824b7c9f43b5', '171.210.167.84', '', 'oGxoe1VS8y4OTDxrxtGgB8Scaf8Y', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5f20\\u96ea\\u950b\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTLmnGMszeibYjTsHaPtxK3icEuJPz6E6VPPj5DiaKtr76s8OwaJtYbZU39lGPGwG6V4Q9tYribU4VjdOw\\/132\",\"user_address\":\"\\u4e9a\\u5229\\u6851\\u90a3\\u56fe\\u68ee\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLmnGMszeibYjTsHaPtxK3icEuJPz6E6VPPj5DiaKtr76s8OwaJtYbZU39lGPGwG6V4Q9tYribU4VjdOw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('88', '118', '1530086640', '0', '1530071769', '2', '1', '光全', '', 'wx4612824b7c9f43b5', '182.139.30.172', '', 'oGxoe1Tb0IOG0f7XV0Q80-LkvL1A', '微信平台', '{\"gender\":0,\"nickName\":\"\\u5149\\u5168\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/cyrMMpVGvX558MDOC4XB3s7jE0IWoQ1lKKxcS2dfcBFZmfHhthUwsh0EwAF4gJsxvmq9oRqPZHVxgdnvbDZ6VA\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/cyrMMpVGvX558MDOC4XB3s7jE0IWoQ1lKKxcS2dfcBFZmfHhthUwsh0EwAF4gJsxvmq9oRqPZHVxgdnvbDZ6VA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('89', '119', '1530071773', '0', '1530071773', '1', '1', '肖玉龙', '', 'wx4612824b7c9f43b5', '117.176.217.173', '', 'oGxoe1XHhHH4rl9vTJC5RBa8qLzE', '微信平台', '{\"gender\":1,\"nickName\":\"\\u8096\\u7389\\u9f99\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/fWQje8A61juaSY0esWZ75Dx0k66XrPCHAUhVDLicrMBnROqE38xWs62DoITCle0XbGUm2z5bjUdzyOxicgsCMwIw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u5b9c\\u5bbe\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/fWQje8A61juaSY0esWZ75Dx0k66XrPCHAUhVDLicrMBnROqE38xWs62DoITCle0XbGUm2z5bjUdzyOxicgsCMwIw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('90', '120', '1530074102', '0', '1530072664', '2', '1', ' Catherine青', '', 'wx4612824b7c9f43b5', '171.210.228.203', '', 'oGxoe1UlzfnLM2mAQacdVqzGDb2E', '微信平台', '{\"gender\":2,\"nickName\":\" Catherine\\u9752\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/SPkqa14HYU6Y5esLibKj18Bweq9AHuWjczJa88PfmC1rfVrtDMuV7Q8E6ynEypgJOKl17MGXZooW1Ik3ibpjwHMA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/SPkqa14HYU6Y5esLibKj18Bweq9AHuWjczJa88PfmC1rfVrtDMuV7Q8E6ynEypgJOKl17MGXZooW1Ik3ibpjwHMA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('91', '121', '1530072695', '0', '1530072695', '1', '1', '向阳花', '', 'wx4612824b7c9f43b5', '117.136.63.178', '', 'oGxoe1TEBFlEvGcYlVdJsjNYfMFE', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5411\\u9633\\u82b1\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/k18geoiaOjmKYVjYWRiclhKCtpL7b3gVghdMdN8pydPJDDnmZiciciaWRowiaPhVSk4SxqhAw06sSS9Mtly1wzpFfgYw\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/k18geoiaOjmKYVjYWRiclhKCtpL7b3gVghdMdN8pydPJDDnmZiciciaWRowiaPhVSk4SxqhAw06sSS9Mtly1wzpFfgYw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('92', '122', '1530072737', '0', '1530072737', '1', '1', '栗子果', '', 'wx4612824b7c9f43b5', '223.104.216.205', '', 'oGxoe1aRT-6_6KdKoueT0QWe_vdQ', '微信平台', '{\"gender\":2,\"nickName\":\"\\u6817\\u5b50\\u679c\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/hjlicodBlnUxsaWeY2f1ticpWpTeicjjFN7HGR0IttFiayHYywoREXsg0zPXaOJAcW9QuUSH9ehwpcaVks71WbYLsQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/hjlicodBlnUxsaWeY2f1ticpWpTeicjjFN7HGR0IttFiayHYywoREXsg0zPXaOJAcW9QuUSH9ehwpcaVks71WbYLsQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('93', '123', '1530072965', '0', '1530072965', '1', '1', '巴山蜀水', '', 'wx4612824b7c9f43b5', '101.206.168.109', '', 'oGxoe1YjIV43jsPHph3MOvFY6hm8', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5df4\\u5c71\\u8700\\u6c34\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/amLWwmab78o8ibRoehDcmMgSrJMq41uW8tcDPzYibapibz1zdwTmtkibM3h0BVb0S16TMKJLOLclwDmiaoZZhdqXvCw\\/132\",\"user_address\":\"PennsylvaniaPittsburgh City\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/amLWwmab78o8ibRoehDcmMgSrJMq41uW8tcDPzYibapibz1zdwTmtkibM3h0BVb0S16TMKJLOLclwDmiaoZZhdqXvCw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('94', '124', '1530073114', '0', '1530073114', '1', '1', '杨娟', '', 'wx4612824b7c9f43b5', '139.207.105.121', '', 'oGxoe1WwhRVaMLFHEzaKl_7bZOy4', '微信平台', '{\"gender\":2,\"nickName\":\"\\u6768\\u5a1f\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTLSj3ccmTuNZfHtwhD06sibtae72k1pewEJbxZRu5jEUudLExmlibVPDwOcEHy5MMvhbAJLwloial7lg\\/132\",\"user_address\":\"\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLSj3ccmTuNZfHtwhD06sibtae72k1pewEJbxZRu5jEUudLExmlibVPDwOcEHy5MMvhbAJLwloial7lg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('95', '125', '1530073116', '0', '1530073116', '1', '1', '小闹头', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1QwJOT0tmPcxFq9NFXD_P5A', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5c0f\\u95f9\\u5934\\ud83d\\udc74\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/k3r9YIaWdlkax86PLglXPz2IUvS6wq1FQwvu0llv3ibc1ncXGV9NuUx8fZIUnyR5w9EaLX6G0ibuiaGibeCHpQ0cibw\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/k3r9YIaWdlkax86PLglXPz2IUvS6wq1FQwvu0llv3ibc1ncXGV9NuUx8fZIUnyR5w9EaLX6G0ibuiaGibeCHpQ0cibw/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('96', '126', '1530073286', '0', '1530073286', '1', '1', '雯雯', '', 'wx4612824b7c9f43b5', '117.136.62.59', '', 'oGxoe1cUFEIYKNNffd-EFUag5frs', '微信平台', '{\"gender\":2,\"nickName\":\"\\u96ef\\u96ef\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/g4NibWOeiaGTpLGrbhjr3dDYCxG7oyxUxFvGhLicYKofhU7RNibWW5eNIjKdLnA4icNThdPWOkG5IPrXoFicTahibmBqQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/g4NibWOeiaGTpLGrbhjr3dDYCxG7oyxUxFvGhLicYKofhU7RNibWW5eNIjKdLnA4icNThdPWOkG5IPrXoFicTahibmBqQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('97', '127', '1530073314', '0', '1530073314', '1', '1', '海哥', '', 'wx4612824b7c9f43b5', '223.104.9.203', '', 'oGxoe1Zp0P4fC5fjFVpAe0UVOrqE', '微信平台', '{\"gender\":1,\"nickName\":\"\\u6d77\\u54e5\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/38b2NKFmwic9rvoS2icLPYibW8KLlfm4zia1Bia6oxYqEWSGfUvicibGkIhz4XZNZdw60kMLj2mR7pkLM3B0kZayC7K8w\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/38b2NKFmwic9rvoS2icLPYibW8KLlfm4zia1Bia6oxYqEWSGfUvicibGkIhz4XZNZdw60kMLj2mR7pkLM3B0kZayC7K8w/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('98', '128', '1530073599', '0', '1530073599', '1', '1', '李敏', '', 'wx4612824b7c9f43b5', '171.210.152.106', '', 'oGxoe1ckS78eflIniszfz38Dy5X4', '微信平台', '{\"gender\":2,\"nickName\":\"\\u674e\\u654f\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/cBRpUbwpvQG05tv0YbDBWasp4twJzMk7bfcKBuNuVeZlDUmv78Xdfs9xPTN15hmkpKzpuopZtaOVQCpvbyPr8g\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/cBRpUbwpvQG05tv0YbDBWasp4twJzMk7bfcKBuNuVeZlDUmv78Xdfs9xPTN15hmkpKzpuopZtaOVQCpvbyPr8g/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('99', '129', '1530073626', '0', '1530073626', '1', '1', '蒋', '', 'wx4612824b7c9f43b5', '223.104.216.109', '', 'oGxoe1R06uBOUg4e3rwC1N8-kPuA', '微信平台', '{\"gender\":1,\"nickName\":\"\\u848b\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTLeyzm6NrQVn62zRgsRw7ZzZzaZjXkicibScGwEa6x5WJIvFfJ69TYkfFyicLPooLKYFRzRu4HxFFsfg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLeyzm6NrQVn62zRgsRw7ZzZzaZjXkicibScGwEa6x5WJIvFfJ69TYkfFyicLPooLKYFRzRu4HxFFsfg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('100', '130', '1530073865', '0', '1530073865', '1', '1', '高忠祥', '', 'wx4612824b7c9f43b5', '182.150.41.80', '', 'oGxoe1d82DYncRJTpCJDAe0RiCqc', '微信平台', '{\"gender\":1,\"nickName\":\"\\u9ad8\\u5fe0\\u7965\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/qB8wVXOLIwYfiabtODkDss3lxFjjekCb1ah7oGprEoM6blhcDsb9WJwWU87PXyo6nWVicfJ0pUmIcwYiageOiaxGOQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/qB8wVXOLIwYfiabtODkDss3lxFjjekCb1ah7oGprEoM6blhcDsb9WJwWU87PXyo6nWVicfJ0pUmIcwYiageOiaxGOQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('101', '131', '1530073882', '0', '1530073882', '1', '1', '丑尘子', '', 'wx4612824b7c9f43b5', '110.184.33.63', '', 'oGxoe1YYNHzXegB2KGDlUMjRAdfY', '微信平台', '{\"gender\":2,\"nickName\":\"\\u4e11\\u5c18\\u5b50\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/EuABtfJBiaRibmicibyQ6aHa7iaoJiawQCrYI9XoF85oiaP1XibyRTNyibbGKklLhJTsdjvUNcxUryDW6pnRceFg5VCNI1g\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/EuABtfJBiaRibmicibyQ6aHa7iaoJiawQCrYI9XoF85oiaP1XibyRTNyibbGKklLhJTsdjvUNcxUryDW6pnRceFg5VCNI1g/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('102', '132', '1530074155', '0', '1530074155', '1', '1', '', '', 'wx4612824b7c9f43b5', '171.210.202.221', '', 'oGxoe1cYMfp4ND9UUZtmw4g3ho28', '微信平台', '{\"gender\":2,\"nickName\":\"\\ud83e\\udd10\\u4e0d\\u7626\\u4e0d\\u6539\\u540d\\u3002\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/Q0j4TwGTfTLlJxKedn4vSibguBt8qlE6ianFTpUJ4RG14K3Mnmc3zhsiakHacV4aIBictGTvPyundf0gWoH8cdsDyQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u963f\\u575d\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLlJxKedn4vSibguBt8qlE6ianFTpUJ4RG14K3Mnmc3zhsiakHacV4aIBictGTvPyundf0gWoH8cdsDyQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('103', '133', '1530074161', '0', '1530074161', '1', '1', '木子', '', 'wx4612824b7c9f43b5', '171.210.186.217', '', 'oGxoe1Y4NMmefa3NMmsgbHlJvYfk', '微信平台', '{\"gender\":2,\"nickName\":\"\\u6728\\u5b50\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/IsuYTztuGb7gpOxwHUgsyl9xQSjId8pR2mCHLwIUbmtVl61atRXhk3xL3WSibVQ97JaR5v9MMcSPooICLoCOjdg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/IsuYTztuGb7gpOxwHUgsyl9xQSjId8pR2mCHLwIUbmtVl61atRXhk3xL3WSibVQ97JaR5v9MMcSPooICLoCOjdg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('104', '134', '1530081820', '0', '1530081820', '1', '1', '刘燕', '', 'wx4612824b7c9f43b5', '171.223.32.71', '', 'oGxoe1ZMmSFNK2621bO55V-W89Ug', '微信平台', '{\"gender\":2,\"nickName\":\"\\u5218\\u71d5\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/NOmDwicK9hEsV2NrMF3uWV9R7f404Tb66EicoUSNHuibqqnS6ibb3rz2ichEibPUGB5WzKasKNyBE5c2RHL13XJUW7kA\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/NOmDwicK9hEsV2NrMF3uWV9R7f404Tb66EicoUSNHuibqqnS6ibb3rz2ichEibPUGB5WzKasKNyBE5c2RHL13XJUW7kA/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('105', '135', '1530083017', '0', '1530083017', '1', '1', '套马的汉子', '', 'wx4612824b7c9f43b5', '139.207.88.126', '', 'oGxoe1UbyG4Ir9e6qRDClnwbfmiU', '微信平台', '{\"gender\":1,\"nickName\":\"\\u5957\\u9a6c\\u7684\\u6c49\\u5b50\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/nuMAosL2gMXdBY1HicyqyicHxbyayKynmI9icBQNWdNaR4j1OhAO6FIEdR2BOyYzyF9pTHarD5e4qJos5BW2FpPpQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/nuMAosL2gMXdBY1HicyqyicHxbyayKynmI9icBQNWdNaR4j1OhAO6FIEdR2BOyYzyF9pTHarD5e4qJos5BW2FpPpQ/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('106', '136', '1530087023', '0', '1530087023', '1', '1', '杨登登（ISO质量管理体系认证）', '', 'wx4612824b7c9f43b5', '112.44.101.172', '', 'oGxoe1QL2ogUvlDkqSc6qEVF2OLE', '微信平台', '{\"gender\":1,\"nickName\":\"\\u6768\\u767b\\u767b\\uff08ISO\\u8d28\\u91cf\\u7ba1\\u7406\\u4f53\\u7cfb\\u8ba4\\u8bc1\\uff09\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/DYAIOgq83eq5VSjsNgBQPom5cz5RHJ7vnUjVNibChhACnq1JE44PvElPdLxHnibaD5vNQUayiatcE4PK0pv5ObRQg\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u6210\\u90fd\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq5VSjsNgBQPom5cz5RHJ7vnUjVNibChhACnq1JE44PvElPdLxHnibaD5vNQUayiatcE4PK0pv5ObRQg/132', '0');
INSERT INTO `xjy_third_party_user` VALUES ('107', '137', '1530155388', '0', '1530155388', '1', '1', '美团收银点餐系统  余伟', '', 'wx4612824b7c9f43b5', '117.136.70.33', '', 'oGxoe1Q7SMQh-BJCY26uFdSHDlCQ', '微信平台', '{\"gender\":1,\"nickName\":\"\\u7f8e\\u56e2\\u6536\\u94f6\\u70b9\\u9910\\u7cfb\\u7edf  \\u4f59\\u4f1f\",\"avatarUrl\":\"http:\\/\\/thirdwx.qlogo.cn\\/mmopen\\/vi_32\\/PiajxSqBRaEI7vzFqJGXARQEssIoN3ag2zlVyCz1JdRlsteb7uGp2cjPwtPYbEeguml2gMiaLYLfFqC3gRODfnpQ\\/132\",\"user_address\":\"\\u56db\\u5ddd\\u51c9\\u5c71\",\"union_id\":\"\\u5fae\\u4fe1\\u5e73\\u53f0\"}', 'http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEI7vzFqJGXARQEssIoN3ag2zlVyCz1JdRlsteb7uGp2cjPwtPYbEeguml2gMiaLYLfFqC3gRODfnpQ/132', '0');

-- ----------------------------
-- Table structure for xjy_traffic
-- ----------------------------
DROP TABLE IF EXISTS `xjy_traffic`;
CREATE TABLE `xjy_traffic` (
  `tra_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '货品名称',
  `category_id` int(11) unsigned NOT NULL DEFAULT '20' COMMENT '分类ID （商品）20 默认其它',
  `stock` bigint(11) NOT NULL DEFAULT '0' COMMENT '库存量',
  `buy_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '进货价',
  `ret_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '零售价',
  `member_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '会员价',
  `company` varchar(50) NOT NULL DEFAULT '元/斤' COMMENT '单位',
  `pinyin` varchar(255) NOT NULL DEFAULT '' COMMENT '拼音码',
  `add_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `brand` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `type` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '状态  0:申请;1:发货中;2:完成;3:拒绝;9:采购品',
  `delete_time` smallint(1) unsigned NOT NULL DEFAULT '0' COMMENT '回收站  1:被删除;0:可用',
  `alert_type` smallint(2) unsigned NOT NULL DEFAULT '1' COMMENT '警报标识 1:正常;2:报警;',
  `alert` smallint(5) unsigned NOT NULL DEFAULT '50' COMMENT '报警库存',
  `traffic_number` varchar(20) NOT NULL DEFAULT '' COMMENT '商品编号',
  PRIMARY KEY (`tra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='货流商品表';

-- ----------------------------
-- Records of xjy_traffic
-- ----------------------------
INSERT INTO `xjy_traffic` VALUES ('1', '红酒', '2', '7', '200.00', '1000.00', '800.00', '元/斤', 'hongjiu', '1525939268', '铁血山庄', '10', '美味', '0', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('2', '脉动', '4', '20', '2.00', '5.00', '3.50', '元/斤', 'maidong', '1526004373', '娃哈哈', '10', '脉动能量', '0', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('3', '果粒橙', '5', '420', '80.00', '100.00', '95.00', '元/斤', 'guolicheng', '1526030205', '统一', '10', '统一', '0', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('4', '狗肉', '16', '18', '50.00', '0.00', '0.00', '元/斤', '', '1526086867', '', '10', '', '9', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('5', '羊排', '18', '3', '20.00', '0.00', '0.00', '元/斤', '', '1526086982', '', '1', '', '9', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('6', ' 可口可乐 汽水饮料', '5', '10', '40.90', '55.00', '50.00', '元/斤', '-KeKouKeLe-QiShuiYinLiao', '1528546544', ' 可口可乐', '10', '', '0', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('7', '排骨', '18', '50', '600.00', '0.00', '0.00', '元/斤', '', '1528549384', '', '10', '', '9', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('8', '国窖1573', '3', '0', '500.00', '1000.00', '800.00', '元/斤', 'GuoJie1573', '1528550985', '国窖', '10', '中国驰名好酒', '0', '0', '2', '50', '');
INSERT INTO `xjy_traffic` VALUES ('9', '五花肉', '20', '20', '13.00', '0.00', '0.00', '元/斤', '', '1528551413', '', '10', '', '9', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('10', '娃哈哈', '20', '20', '2.00', '4.00', '0.00', '元/斤', 'wahaha', '1528551569', '', '10', '', '0', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('11', '旺仔', '20', '20', '2.00', '4.00', '0.00', '元/斤', 'wangzai', '1528552047', '', '10', '', '0', '0', '1', '50', '');
INSERT INTO `xjy_traffic` VALUES ('12', '羊肉', '20', '0', '20.00', '0.00', '0.00', '元/斤', '', '1528552129', '', '10', '', '9', '0', '1', '50', '');

-- ----------------------------
-- Table structure for xjy_traffic_all_record
-- ----------------------------
DROP TABLE IF EXISTS `xjy_traffic_all_record`;
CREATE TABLE `xjy_traffic_all_record` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `tra_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '货品id',
  `before` bigint(20) NOT NULL COMMENT '更改前的库存',
  `add_num` bigint(20) NOT NULL COMMENT '更改量',
  `time` int(20) unsigned NOT NULL COMMENT '更改时间',
  `seller_id` int(20) unsigned NOT NULL COMMENT '商家id',
  `menu_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '服务厅',
  `type` smallint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1:入库;2:出库;',
  `record_number` varchar(20) NOT NULL DEFAULT '' COMMENT '单据编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='库存出入记录';

-- ----------------------------
-- Records of xjy_traffic_all_record
-- ----------------------------
INSERT INTO `xjy_traffic_all_record` VALUES ('1', '3', '400', '20', '1529415350', '10', '0', '1', 'RKD20180619213550218');
INSERT INTO `xjy_traffic_all_record` VALUES ('2', '8', '0', '10', '1529415376', '10', '0', '2', 'CKD20180619213616319');

-- ----------------------------
-- Table structure for xjy_traffic_category
-- ----------------------------
DROP TABLE IF EXISTS `xjy_traffic_category`;
CREATE TABLE `xjy_traffic_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父菜单id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态;1:显示,0:不显示',
  `list_order` int(5) unsigned NOT NULL DEFAULT '10000' COMMENT '排序',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `seller_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商家id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类别：  9:采购品',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回收站  0:可用；其他数字为删除时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`) USING BTREE,
  KEY `parentid` (`parent_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of xjy_traffic_category
-- ----------------------------
INSERT INTO `xjy_traffic_category` VALUES ('1', '0', '1', '10000', '茶饮系列', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('2', '0', '1', '10000', '饮料系列', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('3', '2', '1', '10000', '听装饮料', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('4', '2', '1', '10000', '瓶装饮料', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('5', '2', '1', '10000', '盒装饮料', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('6', '0', '1', '10000', '食品系列', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('7', '6', '1', '10000', '速食面', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('8', '6', '1', '10000', '饼干', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('9', '6', '1', '10000', '火腿肠', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('10', '6', '1', '10000', '零散食品', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('11', '4', '1', '10000', '啤酒', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('12', '4', '1', '10000', '可乐', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('13', '5', '1', '10000', '果汁', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('14', '3', '1', '10000', '白酒', '', '', '10', '0', '0');
INSERT INTO `xjy_traffic_category` VALUES ('15', '0', '1', '1', '荤菜系列', '', '', '10', '9', '0');
INSERT INTO `xjy_traffic_category` VALUES ('16', '0', '1', '10000', '蔬菜系列', '', '', '10', '9', '0');
INSERT INTO `xjy_traffic_category` VALUES ('17', '0', '1', '10000', '海鲜系列', '', '', '10', '9', '0');
INSERT INTO `xjy_traffic_category` VALUES ('18', '15', '1', '10000', '猪肉类', '', '', '10', '9', '0');
INSERT INTO `xjy_traffic_category` VALUES ('20', '0', '1', '10000', '其它', '', '', '10', '0', '0');

-- ----------------------------
-- Table structure for xjy_traffic_inventory
-- ----------------------------
DROP TABLE IF EXISTS `xjy_traffic_inventory`;
CREATE TABLE `xjy_traffic_inventory` (
  `inven_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '服务厅id',
  `seller_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '商家id',
  `inven_number` varchar(15) NOT NULL DEFAULT '' COMMENT '单据编号',
  `user_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '盘点人',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '盘点时间',
  `inven_type` smallint(2) unsigned NOT NULL DEFAULT '2' COMMENT '单据总状态 1:有盈亏;2:无盈亏;',
  `profit` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '盘盈金额',
  `deficit` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '盘亏金额',
  `delete_time` smallint(2) unsigned NOT NULL DEFAULT '1' COMMENT '删除标识 1:正常;2:删除;',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `type` smallint(2) unsigned NOT NULL DEFAULT '1' COMMENT '作废标识 1:正常;2:作废;',
  PRIMARY KEY (`inven_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='盘点总表';

-- ----------------------------
-- Records of xjy_traffic_inventory
-- ----------------------------
INSERT INTO `xjy_traffic_inventory` VALUES ('1', '0', '10', 'PD2018062018856', '10', '1529490978', '2', '0.00', '0.00', '1', '', '1');

-- ----------------------------
-- Table structure for xjy_traffic_inventory_more
-- ----------------------------
DROP TABLE IF EXISTS `xjy_traffic_inventory_more`;
CREATE TABLE `xjy_traffic_inventory_more` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `inven_number` varchar(20) NOT NULL COMMENT '单据编号',
  `tra_id` int(20) NOT NULL DEFAULT '0' COMMENT '商品id',
  `record` float(20,2) NOT NULL DEFAULT '0.00' COMMENT '当前库存数量',
  `actual` float(20,2) NOT NULL DEFAULT '0.00' COMMENT '实际盘点数量',
  `why` varchar(50) NOT NULL DEFAULT '' COMMENT '差异原因',
  `delet_time` smallint(2) NOT NULL DEFAULT '0' COMMENT '删除标识 0:正常;1:被删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='盘点详细表';

-- ----------------------------
-- Records of xjy_traffic_inventory_more
-- ----------------------------
INSERT INTO `xjy_traffic_inventory_more` VALUES ('1', 'PD2018062018856', '1', '7.00', '7.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('2', 'PD2018062018856', '2', '20.00', '20.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('3', 'PD2018062018856', '3', '420.00', '420.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('4', 'PD2018062018856', '4', '18.00', '18.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('5', 'PD2018062018856', '6', '10.00', '10.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('6', 'PD2018062018856', '7', '50.00', '50.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('7', 'PD2018062018856', '8', '0.00', '0.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('8', 'PD2018062018856', '9', '20.00', '20.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('9', 'PD2018062018856', '10', '20.00', '20.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('10', 'PD2018062018856', '11', '20.00', '20.00', '', '0');
INSERT INTO `xjy_traffic_inventory_more` VALUES ('11', 'PD2018062018856', '12', '0.00', '0.00', '', '0');

-- ----------------------------
-- Table structure for xjy_traffic_loss
-- ----------------------------
DROP TABLE IF EXISTS `xjy_traffic_loss`;
CREATE TABLE `xjy_traffic_loss` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `tra_id` int(20) NOT NULL COMMENT '商品id',
  `tra_num` int(20) unsigned NOT NULL COMMENT '商品数量',
  `take_id` int(20) NOT NULL COMMENT '操作人员id/报损人id',
  `time` int(20) NOT NULL COMMENT '添加时间',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `reason` varchar(255) NOT NULL COMMENT '报损原因',
  `seller_id` int(20) NOT NULL COMMENT '商家id',
  `delete_time` int(5) NOT NULL DEFAULT '0' COMMENT '删除标识，0表示正常',
  `type` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态 1:已出库商品;2:未出库商品;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='报损表';

-- ----------------------------
-- Records of xjy_traffic_loss
-- ----------------------------
INSERT INTO `xjy_traffic_loss` VALUES ('1', '3', '1', '10', '1529415631', '', '不好喝', '10', '0', '1');

-- ----------------------------
-- Table structure for xjy_traffic_record
-- ----------------------------
DROP TABLE IF EXISTS `xjy_traffic_record`;
CREATE TABLE `xjy_traffic_record` (
  `re_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `tra_id` int(20) unsigned NOT NULL COMMENT '货物id',
  `tra_num` int(20) unsigned NOT NULL COMMENT '货物数量',
  `all_price` decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '总价',
  `man_id` int(10) unsigned NOT NULL COMMENT '申请人id',
  `start_time` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '申请时间',
  `end_time` int(20) unsigned DEFAULT '0' COMMENT '结束时间',
  `result` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '结果 0:未确认;1:配送中;2:完成;3:拒绝',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`re_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='货流记录表';

-- ----------------------------
-- Records of xjy_traffic_record
-- ----------------------------
INSERT INTO `xjy_traffic_record` VALUES ('1', '8', '10', '10000.00', '10', '1529415368', '0', '1', '');

-- ----------------------------
-- Table structure for xjy_user
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user`;
CREATE TABLE `xjy_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `parent_id` bigint(20) unsigned DEFAULT '0' COMMENT '上级管理员/商家/代理商ID',
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '用户类型;1:admin;2:会员',
  `sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '性别;0:保密,1:男,2:女',
  `birthday` int(11) NOT NULL DEFAULT '0' COMMENT '生日',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `coin` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '金币',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `user_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态;0:禁用,1:正常,2:未验证',
  `user_nickname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `user_lv` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '会员等级',
  `user_email` varchar(100) NOT NULL DEFAULT '' COMMENT '用户登录邮箱',
  `user_address` varchar(255) DEFAULT '' COMMENT '用户所在地区',
  `user_url` varchar(100) NOT NULL DEFAULT '' COMMENT '用户个人网址',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `signature` varchar(255) NOT NULL DEFAULT '' COMMENT '个性签名',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '' COMMENT '激活码',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '用户手机号',
  `more` text COMMENT '扩展属性',
  `coupon` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户优惠劵剩余量',
  `user_RMB` decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '用户账户余额',
  `user_login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码;cmf_password加密',
  `withdrawals_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家提现日期',
  `seller_openid` varchar(50) NOT NULL DEFAULT '' COMMENT '商家打款唯一标识',
  `seller_name` varchar(50) NOT NULL DEFAULT '' COMMENT '收款人名字',
  `Alipay_RMB` decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '支付宝金额',
  `Supermarket` int(2) NOT NULL DEFAULT '0' COMMENT '是否为超市  0:不是;1:是;',
  `card_no` varchar(20) NOT NULL COMMENT '卡上编号',
  `card_number` varchar(16) NOT NULL COMMENT '会员号码',
  `real_name` varchar(50) NOT NULL COMMENT '真实姓名',
  `card_time` int(20) NOT NULL COMMENT '开卡时间',
  `harge` varchar(255) NOT NULL COMMENT '充值密码',
  `menu_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '服务厅id',
  PRIMARY KEY (`id`),
  KEY `user_nickname` (`user_nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of xjy_user
-- ----------------------------
INSERT INTO `xjy_user` VALUES ('1', '1', '1', '0', '1459440000', '1530195114', '2', '0', '1506178927', '1', '云九科技', '1', '963024514@qq.com', '', '', '', '', '127.0.0.1', '', '', null, '0', '0.00', 'admin', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('3', '1', '2', '0', '0', '1524226496', '0', '0', '0', '1', '', '1', '123@qq.com', '', '', '', '', '127.0.0.1', '', '', null, '0', '335.00', 'li', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '小谢', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('4', '1', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '101@qq.com', '', '', '', '', '', '', '', null, '0', '0.00', 'a', '###d499dd12603c11857d2a01858d2de534', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('5', '1', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '410@qq.com', '', '', '', '', '', '', '', null, '0', '0.00', 'asd', '###d499dd12603c11857d2a01858d2de534', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('10', '1', '2', '1', '739814400', '1530237393', '0', '0', '0', '1', '川味印象', '1', '1101@qq.com', '', '', '', '23333', '127.0.0.1', '', '', null, '0', '10377.75', 'chuanweiyinxiang', '###af86cfadf817a90bf88dcaa14a7fa0cd', '1512992954', 'oKKb00KIIZt7e5ZMWWokcqq6y5jc', '黎波', '59.02', '0', '', '', '', '0', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0');
INSERT INTO `xjy_user` VALUES ('11', '1', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '10111@qq.com', '', '', '', '', '', '', '', null, '0', '0.00', 'Lisj', '###d499dd12603c11857d2a01858d2de534', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('12', '1', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '10111111@qq.com', '', '', '', '', '', '', '', null, '0', '0.00', 'lsjj', '###d499dd12603c11857d2a01858d2de534', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('13', '1', '2', '0', '0', '1510368589', '0', '0', '0', '1', '', '1', '1017658209@a.com', '', '', '', '', '192.168.0.87', '', '', null, '0', '0.00', 'lisiji', '###d499dd12603c11857d2a01858d2de534', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('14', '1', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '101111@12.com', '', '', '', '', '', '', '', null, '0', '0.00', '2333333', '###d499dd12603c11857d2a01858d2de534', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('15', '1', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '93222@we20000.cpm', '', '', '', '', '', '', '', null, '0', '0.00', 'lkjkm ', '###b0fbb401a305615dcec05a589879790b', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('16', '1', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '2149213612@qq.com', '', '', '', '', '', '', '', null, '0', '0.00', 'test1', '###b0fbb401a305615dcec05a589879790b', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('17', '1', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '123@qq.comtel', '', '', '', '', '', '', '', null, '0', '0.00', 'mirui', '###d499dd12603c11857d2a01858d2de534', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('18', '1', '2', '0', '0', '1524190024', '0', '0', '0', '0', '', '1', '2470588931@qq.com', '', '', '', '', '127.0.0.1', '', '', null, '0', '0.00', 'q2470588931w', '###562db0c6fc4bd2d3de8abddbe7ecf59e', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('19', '0', '2', '0', '0', '1524917719', '0', '0', '0', '1', '', '1', 'xiaozhang@qq.com', '', '', '', '', '192.168.0.66', '', '', null, '0', '0.00', 'zhangsan', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('20', '0', '2', '1', '0', '1524636322', '0', '0', '1524636322', '1', '黎浩', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJVVBpDhvNsU3eJ8ynXzhlalc5icSYcJ3dsePDXb3MnvUIaAG8HyMXsycUoQCZND4zD8tO0vY3p7Tw/132', '', '125.69.126.170', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('21', '0', '2', '1', '0', '1524640177', '0', '0', '1524640177', '1', '南冥灬雨', '2', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/FnfnEco7BdgKxoHHcyvTCbeCDureVVREsoovd0TuNUmZ55iaVPgLUmB5Ha6WBxrryp2sPPpJLBV4VEm5PvnlJcw/132', '', '117.136.70.58', '', '', null, '0', '15140.27', '', '', '0', '', '', '0.00', '0', '', '2653571569', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('22', '0', '2', '1', '0', '1524650166', '0', '0', '1524650166', '1', 'Hosni', '2', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/6OlFfArInlmYpyW4B0jX0zvfCKuIyZQbhBB6iaLsxxFibafzic5xyibDITibJicy1K6b8m34eNXMd1BY2ODWQJicCickiag/132', '', '125.69.126.170', '', '', null, '0', '85463.00', '', '', '0', '', '', '0.00', '0', '', '3594411405', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('23', '0', '2', '1', '0', '1524817776', '0', '0', '1524817776', '1', '品味中国', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/R9hiag9MqTHZdooQcRfolOFHWjbQDniaj3bAZFiaJg0LxrAXiaXOOp70eFbxTH3XAkJia5gibLu7584mo5hicDWZ9TTlg/132', '', '125.69.126.170', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('24', '0', '2', '0', '0', '1525315065', '0', '0', '0', '1', '', '1', '123456@12.com', '', '', '', '', '182.138.218.123', '', '', null, '0', '0.00', 'f123456', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('25', '0', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '123456@102.com', '', '', '', '', '', '', '', null, '0', '0.00', 'h123456', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('26', '0', '2', '2', '0', '1524898841', '0', '0', '1524898841', '1', '余東洺', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/2fm5CUGvV73IPI5UJiaHFpMVpq0pM314XlY06l0c4lfAPdcAQQ2UY46YzPgI9mLFuIPEGA6VFlc4a00gOpbNO0w/132', '', '117.139.208.9', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('29', '0', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '9225@qq.com', '', '', '', '', '', '', '', null, '0', '0.00', 'hu', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('30', '0', '2', '0', '0', '0', '0', '0', '0', '1', '', '1', '85555522@qq.com', '', '', '', '', '', '', '', null, '0', '0.00', 'jui', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('31', '0', '1', '0', '0', '0', '0', '0', '0', '1', '', '1', '922556@qq.com', '', '', '', '', '', '', '', null, '0', '0.00', 'lib', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('32', '10', '1', '0', '0', '1528551287', '0', '0', '0', '1', '', '1', '58952@qq.com', '', '', '', '', '171.217.142.17', '', '', null, '0', '0.00', 'guanliyuan', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '179');
INSERT INTO `xjy_user` VALUES ('33', '10', '1', '0', '0', '1530153295', '0', '0', '0', '1', '', '1', 'CWYX02@qq.com', '', '', '', '', '110.184.33.251', '', '', null, '0', '0.00', 'houchu', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('34', '10', '1', '0', '0', '1530013391', '0', '0', '0', '1', '', '1', 'CWYX03@qq.com', '', '', '', '', '182.139.28.146', '', '', null, '0', '0.00', 'fuwuyuan', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '', '179');
INSERT INTO `xjy_user` VALUES ('35', '10', '1', '0', '0', '1526263391', '0', '0', '0', '1', '', '1', '123456@qq.com', '', '', '', '', '171.217.142.53', '', '', null, '0', '0.00', 'chaoshi', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '1', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('36', '0', '2', '2', '0', '1526809451', '0', '0', '1526809451', '1', '川味印象秦勇15216737215', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTILsdfVI9jlvswcpGs78m2EbOFn4Ed9yXQfHhcTLAlFqvfyWdib2HlwI1vSqdVBUGEr3UcYUI4JibHw/132', '', '223.87.40.227', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('37', '0', '2', '1', '0', '1527068811', '0', '0', '1527068811', '1', '郁笙。', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ics2BWvggibiawBaaskctFtXWNwwEIR1iaqxQhgUGoe1ibUYS36KAQyWYZ3ZdWSic7xuep3Wz3YZ9pac6yjChNM3oK8A/132', '', '101.206.168.102', '', '17302837271', null, '0', '1377.00', '', '', '0', '', '', '0.00', '0', '', '', '吕婷', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('38', '0', '2', '2', '0', '1527732915', '0', '0', '1527732915', '1', 'Chencen', '1', '', '维多利亚墨尔本', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIe0a4SU6iczsDicSUQXUKJwBa0L7icDMngyNdq6v5XgLowL2nKb7icQiauIWLqX5nW4hkzWIibcNYNYpQQ/132', '', '117.136.63.153', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('39', '0', '2', '2', '0', '1527733274', '0', '0', '1527733274', '1', '彩色风林', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/iaZbYjI1GKasuVt3qXiaflQzeNFtL4HPDOkbH9vibFibZbHT7TQaACibOxVJva5x4seicqCDrHRiagf9Ve7KdAb5r7C7g/132', '', '222.211.182.222', '', '13551162176', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '李雪玲', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('40', '0', '2', '2', '0', '1527735761', '0', '0', '1527735761', '1', '桃花', '5', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/bIOE3icSicttKJZRRVJJpI3FO20euzqhtic3mmgjuGicibCT0cIE7jcJjRBbEs7OA5EIbF174Z90icfs0CPFaQepicY0A/132', '', '222.211.182.222', '', '13540359255', null, '0', '53331.00', '', '', '0', '', '', '0.00', '0', '', '3556738413', '田桃云', '1527736224', '', '0');
INSERT INTO `xjy_user` VALUES ('41', '0', '2', '1', '0', '1527749612', '0', '0', '1527749612', '1', '人生就是一场经历@', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/2vibEmr3e6jqUF3pBot3Uic2cT1PQbcZuPIZIHCmRJPibCsFuMv0dFiaZxg59BhZReILCsMIwWEBZbf2T1wvcTQhGQ/132', '', '182.144.118.54', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('42', '0', '2', '2', '0', '1527749613', '0', '0', '1527749613', '1', '', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/M0TTYA7lvC1ge3eXn88G9icGzibPsGP70qZ5NZpTiatgNdd4Znmp503n3iaBuc8La3bicxYcicic2fe8RfGwBvszLtLdA/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('43', '0', '2', '1', '0', '1527749614', '0', '0', '1527749614', '1', '任性、诠释了我们的青春', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKTXzqsgAaBOXeZ8s4MP65C6amTYRXpX0iaTUgiaicl16DzibDgiaaicHxrZo607iapqu1zZxZalGpQicrstA/132', '', '139.207.30.167', '', '17761413457', null, '0', '1377.00', '', '', '0', '', '', '0.00', '0', '', '', '赵伟', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('44', '0', '2', '2', '0', '1527749616', '0', '0', '1527749616', '1', '玉梅儿', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ekFWm6NDQzQ6yBO03HDq0saUX12h80ZMjmOvZsThsec2fxVkZle7VohLUHcL1bFc0EH1Dxyz3YWEhpXSicicUBibw/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('45', '0', '2', '0', '0', '1527749618', '0', '0', '1527749618', '1', '海洋之星', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/PVJ9CBd6fPFA3Cdvpyr0iaAskKlmMmTLNu7SWTBxtFTXs7W6vYddObTl0FlfiaTOlia0FEyzE7DR7B3xnHaJ0bMibQ/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('46', '0', '2', '2', '0', '1527749619', '0', '0', '1527749619', '1', 'Later', '1', '', '四川阿坝', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/COvoKLRm7ybCWB3q2KuBQrymV1icn113s1EU2pbLHMUsSENvNj5v852iamxGGE2JGfpANPsSLr8PbvoIDQy1safQ/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('47', '0', '2', '1', '0', '1527749621', '0', '0', '1527749621', '1', '情', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83epMSjakiavMwHVn41rRFfQRZSg0ENOWjZW5uZLHMrVlFF754ibQlibeJSf08gqmqVfsibM1Ts2bnjWnibA/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('48', '0', '2', '1', '0', '1527749622', '0', '0', '1527749622', '1', '南帝', '1', '', '四川', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/s3VZAbuz2Z1zP6FcaGOYRhkicoGC9yT7l1RaJSxJBibLmMU7BMeicFczgs9yxyU6GjjKXwMdJCZibLcyP8xGMr0OwQ/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('49', '0', '2', '2', '0', '1527749624', '0', '0', '1527749624', '1', '二锅头', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/d5cBBmtIRNtrSdumxLVb3bO50ccBCVmzjh3wAcPU7s2da68PQlbYG6SGQBTW7fJLjyw9Y1iakSe9K0qxH98agZg/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('50', '0', '2', '2', '0', '1527749634', '0', '0', '1527749634', '1', 'JIAN。', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/TYPuwz3zUpqA1ofGzSvM4sYa8rib1CeNT2VjxE9pU5AVmzrsI29qHUGk7x26nS2yYpAgicuAtVH1gfWmL1tjZ4qg/132', '', '101.206.169.24', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('51', '0', '2', '2', '0', '1527749702', '0', '0', '1527749702', '1', '丫头', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/AStWfQ6jicJxiczEJ0n4X6dqzJUXBONFrLUH5wkwvDeWaCicQ7icRZoGdzclKoHW3RiaUXBFN2McO8Q8gKozHVwWEKg/132', '', '117.136.63.135', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('52', '0', '2', '2', '0', '1527749766', '0', '0', '1527749766', '1', '别问我是谁', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJ0wBXrCUVbWBpvNN8Ew3tUCgwFF0qz5PQic0sbTF3vib0PjskpT30QHW76cxPwLO8XGIfDbWLZPkmw/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('53', '0', '2', '1', '0', '1527749767', '0', '0', '1527749767', '1', '南北', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLard73s4fMYNVW7eBTGOlhuHR9r31ArC2Q2Vj4yokxBg7VbM5hibib1UVd70HAduiaiaqptb4pX3Y6jg/132', '', '139.207.80.182', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('54', '0', '2', '2', '0', '1527749781', '0', '0', '1527749781', '1', '燕姐', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/FtHjELh6iadWcPQcmTvQrBw8dGhhVIt7FOvUeibUKojUGiaMzuPwxKfMPyIsNmYwJHRpiaJym2Olu00Qne32wBy0ibw/132', '', '171.210.220.144', '', '15928456507', null, '0', '1377.00', '', '', '0', '', '', '0.00', '0', '', '', '石燕', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('55', '0', '2', '1', '0', '1527750628', '0', '0', '1527750628', '1', '渊歌', '5', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/8mpjS2GNWPFjXp9xzsUfic1Kv4TDykVhibLvDvI4S0w2nVHoZJmjAT5JfuPIQMW4XYSK0Fw9kRy6m5tT1SQSJf3Q/132', '', '222.211.182.222', '', '13882056629', null, '0', '108885.00', '', '', '0', '', '', '0.00', '0', '99990003', '3593981837', '刘渊', '1527754008', '', '0');
INSERT INTO `xjy_user` VALUES ('56', '0', '2', '1', '0', '1527751103', '0', '0', '1527751103', '1', '落叶纷飞', '1', '', '重庆酉阳', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/WiaiaMkbC0nqQURZ5JbIQKOQ9b8k75QFicqet6tyYShv2K837WOCGbQEG9V5veY3sbA5ITYwJQUv8Rynbvic0XFHAw/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('57', '0', '2', '2', '0', '1527751148', '0', '0', '1527751148', '1', '小燕', '1', '', '四川资阳', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKVUCukKunFOAfEgBJspGBFJIT1TMY5apEnlJ0Q4H1RLniaSMmyLKdIWGet6PpLFxQEefUsJ5XItuw/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('58', '0', '2', '2', '0', '1527841732', '0', '0', '1527841732', '1', '琴婧', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/D51Ez4AAKETXvrNbibK9A3SCKxQHtRbF1NsMwg9Ixjc1pEOdkxFexGe85vfZ0vDPQVuZdloQ1DAgDtlqRbQNNnA/132', '', '222.211.182.222', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('59', '0', '2', '2', '0', '1528177693', '0', '0', '1528177693', '1', '用微笑、掩饰不安', '1', '', '四川', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ibbg35VbtSTV5zV1jSa4CWq0PjoWYOkK1TQjmBpsNt3m6poVaIBt9rsN6y3iauWXu50dLicSkqFIg9jREHePbibbdQ/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('60', '0', '2', '2', '0', '1528268516', '0', '0', '1528268516', '1', '天昕', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJMW3f6jeDLDXASRXxExEDvmOdZNKSKFrWonFH3XFHdNkMiaibba4dgSRfKiaNY88FXMv4t7oaSHy5cg/132', '', '110.184.37.49', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('61', '0', '2', '0', '0', '1528361642', '0', '0', '1528361642', '1', '武陵刀王', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLDWrn4NBpLf1aS3YibOxV3nMEcB90t3Nx5frCY0IoEzctEn2dPM4QVje2KJfiag5NSclzRdjUZg7Tw/132', '', '110.184.37.49', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('62', '0', '2', '1', '0', '1528780925', '0', '0', '1528780925', '1', '吃亏是福（杜晓东）', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/2WCb4rGJ6407r9XbG1ibbiaUx0jZT0bdtRprAm3RSSwwbvvVF18lOoQk1BKGVB3ibxBW9jGSRvHJLDhU1tc5mhic9A/132', '', '222.211.182.239', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('63', '0', '2', '1', '0', '1528783534', '0', '0', '1528783534', '1', '爱文弟', '1', '', '四川绵阳', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/e6MOM2dHvushyEwKDqY93ymmlVphJiayko2tzJTChrjggpYjb6KqicKqtcY1aBK8QXufESW9zYE5QlW7EBp57VLw/132', '', '119.4.252.106', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('64', '0', '2', '2', '0', '1528783578', '0', '0', '1528783578', '1', 'づ苏沫妤', '1', '', '四川内江', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTL0uZWOCiaffvWGIItZcPtRA1AyVv3GM7iaeIZgCzTJXeDFMDPJDqebLPDCayb3G42NQJSykua6bjicw/132', '', '222.211.182.239', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('65', '0', '2', '1', '0', '1528784951', '0', '0', '1528784951', '1', '尽量改变自己', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/2HTU1lARXy0DNpa0nRiapMclibxXdb4uBqhicymbFsuRuXt4Cv6lcrMANzhyCuKUAOTmzJDxmuFf2SDx8CRQv9wuQ/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('66', '0', '2', '1', '0', '1528788540', '0', '0', '1528788540', '1', '四川人', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTINfm2yDMH1r4DkricQ9zV8kvCJrrcu2vgqr0fEreibiaa5VeSibZSpWDcx5Jp6exq3B4ITE69DS0PsVw/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('67', '0', '2', '1', '0', '1528789142', '0', '0', '1528789142', '1', '开始流浪', '1', '', '四川绵阳', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/nzEWxyQpKrDnfkXurndGpZEpd31sS2HuKNzhgve76otNtJIVtH1KBDB4NxOtIFywJ2WIMt5ZqZkrBoEdCXibhvA/132', '', '117.136.63.186', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('68', '0', '2', '1', '0', '1528789222', '0', '0', '1528789222', '1', '不许流年', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Tp5fCsKL6dECbShF0nfZrEDu9kC28DEu5gjibcWbl8qJu1JdeqxibXlnmpVeviaBStruUbicOG5WMG8b9mRiaicWbllQ/132', '', '110.184.33.65', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('69', '0', '2', '1', '0', '1528789238', '0', '0', '1528789238', '1', '仰天长笑', '1', '', '云南昭通', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/XG4WBgoq0cDRoQ4IphPet5wNbFyAicwsYBa5ZIFSLXBJEdqAEjbFNWgvecWdPHJW8HZfSicEQGFEwIMxSPWW2T2Q/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('70', '0', '2', '0', '0', '1528789301', '0', '0', '1528789301', '1', '虚幻的梦', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/3LwKfG9K6kiaOEMLEtw7cOkbKwrq8Jl8l41Wp4Zs4vITyllbzuf06V52zyRb4bcZSuyddtIyaUhPibIccODxESwg/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('71', '0', '2', '2', '0', '1528789374', '0', '0', '1528789374', '1', '七爷', '1', '', '凯里', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJLHJiar5ry33vEkg13eedsCDHaNV9S0MS6wVA2dStqwW4UQJ46T3LTdkAVB28XBrUuibGBIvcSNk5g/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('72', '0', '2', '0', '0', '1528789485', '0', '0', '1528789485', '1', '繁花似锦', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eogTLyCM8KkDQUgWpT84oxYFeaF99Le4GTtOa5iau98assxf6ibsrdlMC9h4Gr09YBqw3xQrBcgplFw/132', '', '110.184.33.65', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('73', '0', '2', '1', '0', '1528789531', '0', '0', '1528789531', '1', '有人@我', '1', '', '四川绵阳', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/bNg76ejYSXvRsM5pGNHH7yqZQmAY3cpVGFnbkJElRAHFR1sjpWia9gGscFnZHicEHlpq3Ribk7icx1DZiabaoUC651w/132', '', '171.210.232.242', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('74', '0', '2', '0', '0', '1528789578', '0', '0', '1528789578', '1', '微笑', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/acjcuuTycbaUJp7osibWR7oJEWZ90Ve7xjhhXElk9CT663SxJDLLdvj7euImFZfReUDicl89kLj1VSBIqc8F9xGA/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('75', '0', '2', '1', '0', '1528849973', '0', '0', '1528849973', '1', '幸福', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/XLXutttfiajrbaFibic4ofkOrza8ILzA7VlfShISUibw0sRgpz36EEbib9c9SSEfHV1laqgNbGJbBd9maZESHickh9RQ/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('76', '0', '2', '0', '0', '1528858235', '0', '0', '1528858235', '1', '夜& 微凉~zZ', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Vs8R6iaHKnDk4sia7dAk3Dib0AGsoMrlHTMeicJ50rYbwGEOeBCbXBiaeUqcBqqV3kaibDJdKQBUh10IhCCeIoVvOwuA/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('77', '0', '2', '1', '0', '1528869363', '0', '0', '1528869363', '1', '唐', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqoBNrGAszXzU75XY2yibn25rYGktyOKlEoFU8dW51CqMrC1dWYLUaUnU6ngtLzhMt05MjxgyiaKBbg/132', '', '101.206.167.168', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('78', '0', '2', '1', '0', '1528869473', '0', '0', '1528869473', '1', '野望', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/xdicGCy5dw3Qlb8bz0RLf1gBEFfT7AFEgdIc0ibstXo6SXk5wpVu6twrhhCU0znicH5eEVLl4Ir3YGLlSUN10Vo9Q/132', '', '117.136.63.130', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('79', '0', '2', '2', '0', '1528878600', '0', '0', '1528878600', '1', '冉光辉', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/tsvfmBcs23VwXH9GmOkRH6ia8pJ0ldkWDv4fT0ICAwmibWIicZAVbknvbnicQlicmTsPBaticc2PBRtnaEFiavawT5Z9g/132', '', '222.211.182.239', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('80', '0', '2', '1', '0', '1528878892', '0', '0', '1528878892', '1', '回眸', '1', '', '重庆', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/dP93Qib8AS2gz4JcFcmu4IZdRz8lBLLwnnWTOR9JJICCkSrmwEoRN3wk8OWJupXPic9MZibFeIVz6xFe0A4Wic6M2g/132', '', '123.147.244.15', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('81', '0', '2', '0', '0', '1528881486', '0', '0', '1528881486', '1', '柏烨广告-01', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/CYvUSVt0C4ADLibw2bELuBibsqg4dickVCfYGs2Tq8GXv5Pqia5PyN3lZ8g8ibsSKHYMChwjRqEuzRSiat2yicJ7Y3Tjg/132', '', '118.114.106.174', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('82', '0', '2', '2', '0', '1529136120', '0', '0', '1529136120', '1', ' 柳宝', '1', '', '北京石景山', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIbAcgp9o2B8tNPEHX5O95q24yHSxJrOSCCHOPCz5iak64HJJSQzuPrBMlmsMjTchen0dh98wyaGZA/132', '', '117.136.63.157', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('83', '0', '2', '1', '0', '1529485970', '0', '0', '1529485970', '1', '一只傻@阿荣', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ApNlcIJIHaJA11Kepba3dSiavWsSCIVyHWl6gKmoZwvS6dqT0onb6m0BXUTU9ymX98hAh08y94D7uicCv2yJRMtA/132', '', '119.4.252.101', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('84', '0', '2', '1', '0', '1529486117', '0', '0', '1529486117', '1', '', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/iabXQCrWqUCYttcSfJVP9CACtIru13PjjMqKD7vUmhn8ewViaIQAKX360q10StVQT43N1Rb6f9H3kPYtYULECtkQ/132', '', '171.210.176.24', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('85', '0', '2', '2', '0', '1529488415', '0', '0', '1529488415', '1', '三年', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqUBmStQSOtIzqvx0geCy6L8MW2spQKvhfJYWjx9ya0PdAGj5b7KEu3CN0Sn5Ao3diceJTWFjLiaDOA/132', '', '110.184.33.227', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('86', '0', '2', '2', '0', '1529488471', '0', '0', '1529488471', '1', '可乐', '1', '', 'Al Fujayrah', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/vp81ML0pFfzAGWU4v1Kcn9Wh5s8sauzMmiaDZ5K0ic44PlqnIendia2uhhraAFUMUGoBZOxMTBFiaoH7etq8XicdgoQ/132', '', '171.210.73.109', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('87', '0', '2', '2', '0', '1529490528', '0', '0', '1529490528', '1', 'A-H', '1', '', '四川南充', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/yyakpwENic4REdSfSlLjub6ayK49WHib3Zkjypia2FQgOYGcqJJnDYibhcOgZkic3GP0ictul5F4em08t5RzPMpbXGqw/132', '', '117.174.95.30', '', '13512345678', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('88', '0', '2', '1', '0', '1529651024', '0', '0', '1529651024', '1', '天汇', '1', '', '北京丰台', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/mVaN1K0AibPQfeCBG4dDkNiaglzEPGbJFEzvadEmz9cSg2unQicXoicQ9Kw0ia8yuibUAZeg7nLENjGfJ5tzmgc4IVfg/132', '', '117.136.70.49', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('89', '0', '2', '1', '0', '1529728227', '0', '0', '1529728227', '1', '宋祉欢', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKV1oFGkPN2D7sQaEkhw75jQKcHibVgwfyicEPM7yezMnMiaJPHmicr7JXceAvT4YpbjKYbS5wHoFxonA/132', '', '110.184.39.219', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('90', '0', '2', '1', '0', '1529728375', '0', '0', '1529728375', '1', '龙', '1', '', '阿克里', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/8KiayooR1HTpQXJu77poYpaeAsIyKibbfnhIy8VnkRjkKPZCza9V6VMBXhvlZvvTmca7IicqU6ics6dCtCibE1jfw1Q/132', '', '117.136.63.152', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('91', '0', '2', '1', '0', '1529739696', '0', '0', '1529739696', '1', '刘岐+大连海鲜批发', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/hU3tEK1xZ3rAIw1pAvHyZqW68NiaIiaeMFibwaO2HaBSLwicAbKs1fj0Vhww4plNPf6pDLs2FmXdkHrLr8KApdUORQ/132', '', '171.223.32.71', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('92', '0', '2', '1', '0', '1529745690', '0', '0', '1529745690', '1', '一心只为妳一人', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Y26sDWV2njnwwYUnEic9NQEkhQNjheia5jQiciajfXSDm9zyn0TbMIqAVKmB3RHibDnoQiaYbeFVIYYCt2cvCFOt7icPA/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('93', '0', '2', '1', '0', '1529821388', '0', '0', '1529821388', '1', '七哥', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/wsRmxcKeyV2TxvDQn5eekk2zTkia5RDickmBib79DaBgAesFtXpNWzIibE0XiasFEAxrm4RJocf2u7mgtUhmRndxxbg/132', '', '171.223.32.71', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('94', '0', '2', '1', '0', '1529822087', '0', '0', '1529822087', '1', 'BEE', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/9vmNpnpybgibtho9zAz8GRQ0DKRFD2RVTbqn8kxJ5MtQTzfx01LbPYMqhQ5B6SbPVVtgibic3Zu3lm5mLWEXe5eLQ/132', '', '117.136.63.173', '', '13880116948', null, '0', '7777.00', '', '', '0', '', '', '0.00', '0', '', '', '吴洪江', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('95', '0', '2', '2', '0', '1529831260', '0', '0', '1529831260', '1', '大大', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Nrmd1Asp5FJu7lGhbKQ4DoKzD2nCaUnneZdibnxiaxLG67smsvC3xQTsYla2AeFpPDjCE7dx6H4Ss5Z03rC5ricww/132', '', '139.207.25.178', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('96', '0', '2', '2', '0', '1529834845', '0', '0', '1529834845', '1', '千觞i', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eo3HceUtKUKzjK4yvicBxNY5ulbSbNmqejXBxnNaWwVh5G8UyAVkaIL13UNaw15dq4FuHKqDT3VxOA/132', '', '110.184.35.237', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('97', '10', '1', '0', '0', '1530152740', '0', '0', '0', '1', '', '1', '44423456@qq.com', '', '', '', '', '171.223.32.71', '', '', null, '0', '0.00', '1001', '###af86cfadf817a90bf88dcaa14a7fa0cd', '0', '', '', '0.00', '0', '', '', '', '0', '###af86cfadf817a90bf88dcaa14a7fa0cd', '207');
INSERT INTO `xjy_user` VALUES ('98', '10', '1', '0', '0', '1530154586', '0', '0', '0', '1', '', '1', 'fuwuyuan@qq.com', '', '', '', '', '110.184.33.63', '', '', null, '0', '0.00', '1002', '###9f3a0b22da6ca92265c46005e4e7ef3b', '0', '', '', '0.00', '0', '', '', '', '0', '###9f3a0b22da6ca92265c46005e4e7ef3b', '179');
INSERT INTO `xjy_user` VALUES ('99', '10', '1', '0', '0', '1530150160', '0', '0', '0', '1', '', '1', '456123@qq.com', '', '', '', '', '110.184.33.251', '', '', null, '0', '0.00', '1003', '###fc4336882073a1ddca95e68388e22054', '0', '', '', '0.00', '0', '', '', '', '0', '###af86cfadf817a90bf88dcaa14a7fa0cd', '200');
INSERT INTO `xjy_user` VALUES ('100', '0', '2', '2', '0', '1529923599', '0', '0', '1529923599', '1', '静々萱', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/hQUo9ZZDcjneOyXd2soDRkFMgqRaiaA8rZ3ln5h9h2dJCvic8TZKJXictLKHx3z4licasP39VDM99fMjf3EyxCKiacg/132', '', '223.104.216.85', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('101', '0', '2', '0', '0', '1529923782', '0', '0', '1529923782', '1', '石胜利', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/LI4hiaWPVGyGuqBmdX0nRD52pwtgrs3DLKnLRxblZL2VwhIXQzAqdsiatMGY2sYJzv34BvV2zzcZC9gXeqxNEuTw/132', '', '171.223.32.71', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('102', '0', '2', '1', '0', '1529924712', '0', '0', '1529924712', '1', '石兰13058127999', '1', '', '北京朝阳', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/5mqzEySTibjZKLleRfcRE2xh8aE1YEUc4rEbteAMJxRMicVN2ibrN69ElDibEIHt6YXicqZDqrMiarq2IXbgk93MymJw/132', '', '112.97.192.136', '', '13058127999', null, '0', '1377.00', '', '', '0', '', '', '0.00', '0', '', '', '石兰', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('103', '0', '2', '2', '0', '1529929472', '0', '0', '1529929472', '1', '朱德锋', '1', '', '四川达州', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Cw3fAQust2NiaUSq1kcN8riclXNcXhVNBkuJfNjKG6wKYhV5iaGv4aFpBOhX3jPD6LB7KMiaXnYic5cZlNj5Rpe9XCg/132', '', '117.136.62.101', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('104', '0', '2', '0', '0', '1529981630', '0', '0', '1529981630', '1', '晴天', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/ImsHeARJf24CBNTFYSh9Qk80vjjEOyicShXLicSc9We7tlmDdgVjz3akCkqoicz720T0ZJMDsmiaAo2fnc76SgOP5Q/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('105', '0', '2', '2', '0', '1529985144', '0', '0', '1529985144', '1', 'R', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/9TI94QLP4dpy3xhH9jXuBdXE5CLenBf03pWExFjdCunGLq1HdZHPnqoJkZM8w1hR3EDqiaIn7ibNZ2JlCxoic2zSA/132', '', '101.206.170.67', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('106', '0', '2', '2', '0', '1529985188', '0', '0', '1529985188', '1', '傲娇', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eohbzP1wznJjMHag61X7PpqQDdc7rn9f8XydysAH77DamccIyictTd5Fn05jvv4X35aC6PH12Qq2aA/132', '', '139.207.52.70', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('107', '0', '2', '0', '0', '1529987951', '0', '0', '1529987951', '1', '大山', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEIBLuWjWAeMOfeI7bvW2KbXlTGSP7qE3ow1rEdqx7SA9tfWkOPNiamjwkpiaVW27ow3AYMTykwOJXfg/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('108', '0', '2', '1', '0', '1529987963', '0', '0', '1529987963', '1', '独孤九剑', '1', '', '四川资阳', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/OCZB8zQibR6ql7Z6nOD4JtvIMZiaKENsXQlnVZfOq0pIPaVOX4mJQmpicSMUOlMq7g3ArNeG68pnQZWrCvbvyRxlA/132', '', '117.136.65.223', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('109', '0', '2', '2', '0', '1529990458', '0', '0', '1529990458', '1', '综合金融   滕芹', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqhf9NQyvibXhE7htuBrqa75vtEOiakXNUkOIrgQWjlBGoptAHs81gkaPaibmKjmiabRibCnOGfH7NT8fg/132', '', '139.207.94.166', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('110', '0', '2', '2', '0', '1529993430', '0', '0', '1529993430', '1', '英子', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK0cZnxTS0IoicT08dEb5GiawdV0ia1ku7p61ibdFPyvCWiaib5sfk6ibO0vBiba34gpXmy4Lpice2IzicnC8kw/132', '', '223.104.216.74', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('111', '0', '2', '1', '0', '1529993484', '0', '0', '1529993484', '1', 'จุ๊บ你是柠檬超级酸', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83er5wV1iat8Licm12uQDvs9ZVZk8vmTqU34SqibZmKicDy4iaX7mcrPB2jgicJEgqiaa4LuYuubsViaLGDwcpQ/132', '', '117.136.62.102', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('112', '0', '2', '1', '0', '1530006074', '0', '0', '1530006074', '1', '罗杰 (塑胶地板)', '1', '', 'Umm al Qaiwain', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKiaCYWiak1CC3icxgXia0DhklZxtldpbB33wvvD3jefExA7G0scAV8y2oQ6dCRibqN27lpib6grFgTia3iaw/132', '', '119.4.252.157', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('113', '0', '2', '2', '0', '1530010090', '0', '0', '1530010090', '1', '陈燕', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKNpepsCnC60WPF6icfTBiaVe2jamQ3t5XSJVuyHsuKooPQv5Glkran8fr9TnVZhnROHCM4Hib1rSrcw/132', '', '117.136.62.91', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('114', '0', '2', '1', '0', '1530063365', '0', '0', '1530063365', '1', '永不言败', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/1LicJkQNo7ic1sviasoXzcS8VzlHMNFz8h8QiaUjqYiapmJQ0ydrvYREdCk2NwYOyz0GoLkgvkGjIvnBszA5t5x9ZMA/132', '', '60.255.137.222', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('115', '0', '2', '2', '0', '1530067470', '0', '0', '1530067470', '1', '裙子控', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/WgDvzLVTxx0KGy0mDzr9Md1BV1XCnDZWnIIibiclCu2Dq6So7nKjRBk64nVr3NvMUxxRQ20iaOqXhLicu3TjCIO0iaw/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('116', '0', '2', '2', '0', '1530068443', '0', '0', '1530068443', '1', '筱燕', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKsNN0PyDl8Ok9HwYPsuxuibo2tIicTXBecJ97MlECddxZPH1YmC9WeM95IdfnBEiarobHxXQfIA2zUA/132', '', '139.207.41.164', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('117', '0', '2', '1', '0', '1530069813', '0', '0', '1530069813', '1', '张雪锋', '1', '', '亚利桑那图森', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLmnGMszeibYjTsHaPtxK3icEuJPz6E6VPPj5DiaKtr76s8OwaJtYbZU39lGPGwG6V4Q9tYribU4VjdOw/132', '', '171.210.167.84', '', '18190725416', null, '0', '7777.00', '', '', '0', '', '', '0.00', '0', '', '', '张雪锋', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('118', '0', '2', '0', '0', '1530071769', '0', '0', '1530071769', '1', '光全', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/cyrMMpVGvX558MDOC4XB3s7jE0IWoQ1lKKxcS2dfcBFZmfHhthUwsh0EwAF4gJsxvmq9oRqPZHVxgdnvbDZ6VA/132', '', '223.104.216.114', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('119', '0', '2', '1', '0', '1530071773', '0', '0', '1530071773', '1', '肖玉龙', '1', '', '四川宜宾', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/fWQje8A61juaSY0esWZ75Dx0k66XrPCHAUhVDLicrMBnROqE38xWs62DoITCle0XbGUm2z5bjUdzyOxicgsCMwIw/132', '', '117.176.217.173', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('120', '0', '2', '2', '0', '1530072664', '0', '0', '1530072664', '1', ' Catherine青', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/SPkqa14HYU6Y5esLibKj18Bweq9AHuWjczJa88PfmC1rfVrtDMuV7Q8E6ynEypgJOKl17MGXZooW1Ik3ibpjwHMA/132', '', '171.210.228.203', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('121', '0', '2', '2', '0', '1530072695', '0', '0', '1530072695', '1', '向阳花', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/k18geoiaOjmKYVjYWRiclhKCtpL7b3gVghdMdN8pydPJDDnmZiciciaWRowiaPhVSk4SxqhAw06sSS9Mtly1wzpFfgYw/132', '', '117.136.63.178', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('122', '0', '2', '2', '0', '1530072737', '0', '0', '1530072737', '1', '栗子果', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/hjlicodBlnUxsaWeY2f1ticpWpTeicjjFN7HGR0IttFiayHYywoREXsg0zPXaOJAcW9QuUSH9ehwpcaVks71WbYLsQ/132', '', '223.104.216.205', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('123', '0', '2', '1', '0', '1530072965', '0', '0', '1530072965', '1', '巴山蜀水', '1', '', 'PennsylvaniaPittsburgh City', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/amLWwmab78o8ibRoehDcmMgSrJMq41uW8tcDPzYibapibz1zdwTmtkibM3h0BVb0S16TMKJLOLclwDmiaoZZhdqXvCw/132', '', '101.206.168.109', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('124', '0', '2', '2', '0', '1530073114', '0', '0', '1530073114', '1', '杨娟', '1', '', '', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLSj3ccmTuNZfHtwhD06sibtae72k1pewEJbxZRu5jEUudLExmlibVPDwOcEHy5MMvhbAJLwloial7lg/132', '', '139.207.105.121', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('125', '0', '2', '1', '0', '1530073116', '0', '0', '1530073116', '1', '小闹头', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/k3r9YIaWdlkax86PLglXPz2IUvS6wq1FQwvu0llv3ibc1ncXGV9NuUx8fZIUnyR5w9EaLX6G0ibuiaGibeCHpQ0cibw/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('126', '0', '2', '2', '0', '1530073286', '0', '0', '1530073286', '1', '雯雯', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/g4NibWOeiaGTpLGrbhjr3dDYCxG7oyxUxFvGhLicYKofhU7RNibWW5eNIjKdLnA4icNThdPWOkG5IPrXoFicTahibmBqQ/132', '', '117.136.62.59', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('127', '0', '2', '1', '0', '1530073314', '0', '0', '1530073314', '1', '海哥', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/38b2NKFmwic9rvoS2icLPYibW8KLlfm4zia1Bia6oxYqEWSGfUvicibGkIhz4XZNZdw60kMLj2mR7pkLM3B0kZayC7K8w/132', '', '223.104.9.203', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('128', '0', '2', '2', '0', '1530073599', '0', '0', '1530073599', '1', '李敏', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/cBRpUbwpvQG05tv0YbDBWasp4twJzMk7bfcKBuNuVeZlDUmv78Xdfs9xPTN15hmkpKzpuopZtaOVQCpvbyPr8g/132', '', '171.210.152.106', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('129', '0', '2', '1', '0', '1530073626', '0', '0', '1530073626', '1', '蒋', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLeyzm6NrQVn62zRgsRw7ZzZzaZjXkicibScGwEa6x5WJIvFfJ69TYkfFyicLPooLKYFRzRu4HxFFsfg/132', '', '223.104.216.109', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('130', '0', '2', '1', '0', '1530073865', '0', '0', '1530073865', '1', '高忠祥', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/qB8wVXOLIwYfiabtODkDss3lxFjjekCb1ah7oGprEoM6blhcDsb9WJwWU87PXyo6nWVicfJ0pUmIcwYiageOiaxGOQ/132', '', '182.150.41.80', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('131', '0', '2', '2', '0', '1530073882', '0', '0', '1530073882', '1', '丑尘子', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/EuABtfJBiaRibmicibyQ6aHa7iaoJiawQCrYI9XoF85oiaP1XibyRTNyibbGKklLhJTsdjvUNcxUryDW6pnRceFg5VCNI1g/132', '', '110.184.33.63', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('132', '0', '2', '2', '0', '1530074155', '0', '0', '1530074155', '1', '', '1', '', '四川阿坝', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLlJxKedn4vSibguBt8qlE6ianFTpUJ4RG14K3Mnmc3zhsiakHacV4aIBictGTvPyundf0gWoH8cdsDyQ/132', '', '171.210.202.221', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('133', '0', '2', '2', '0', '1530074161', '0', '0', '1530074161', '1', '木子', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/IsuYTztuGb7gpOxwHUgsyl9xQSjId8pR2mCHLwIUbmtVl61atRXhk3xL3WSibVQ97JaR5v9MMcSPooICLoCOjdg/132', '', '171.210.186.217', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('134', '0', '2', '2', '0', '1530081820', '0', '0', '1530081820', '1', '刘燕', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/NOmDwicK9hEsV2NrMF3uWV9R7f404Tb66EicoUSNHuibqqnS6ibb3rz2ichEibPUGB5WzKasKNyBE5c2RHL13XJUW7kA/132', '', '171.223.32.71', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('135', '0', '2', '1', '0', '1530083017', '0', '0', '1530083017', '1', '套马的汉子', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/nuMAosL2gMXdBY1HicyqyicHxbyayKynmI9icBQNWdNaR4j1OhAO6FIEdR2BOyYzyF9pTHarD5e4qJos5BW2FpPpQ/132', '', '139.207.88.126', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('136', '0', '2', '1', '0', '1530087023', '0', '0', '1530087023', '1', '杨登登（ISO质量管理体系认证）', '1', '', '四川成都', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq5VSjsNgBQPom5cz5RHJ7vnUjVNibChhACnq1JE44PvElPdLxHnibaD5vNQUayiatcE4PK0pv5ObRQg/132', '', '112.44.101.172', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');
INSERT INTO `xjy_user` VALUES ('137', '0', '2', '1', '0', '1530155388', '0', '0', '1530155388', '1', '美团收银点餐系统  余伟', '1', '', '四川凉山', '', 'http://thirdwx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEI7vzFqJGXARQEssIoN3ag2zlVyCz1JdRlsteb7uGp2cjPwtPYbEeguml2gMiaLYLfFqC3gRODfnpQ/132', '', '117.136.70.33', '', '', null, '0', '0.00', '', '', '0', '', '', '0.00', '0', '', '', '', '0', '', '0');

-- ----------------------------
-- Table structure for xjy_user_action
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_action`;
CREATE TABLE `xjy_user_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '更改积分，可以为负',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '更改金币，可以为负',
  `reward_number` int(11) NOT NULL DEFAULT '0' COMMENT '奖励次数',
  `cycle_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '周期类型;0:不限;1:按天;2:按小时;3:永久',
  `cycle_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '周期时间值',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `app` varchar(50) NOT NULL DEFAULT '' COMMENT '操作所在应用名或插件名等',
  `url` text COMMENT '执行操作的url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户操作表';

-- ----------------------------
-- Records of xjy_user_action
-- ----------------------------
INSERT INTO `xjy_user_action` VALUES ('1', '1', '0', '1', '1', '1', '用户登录', 'login', 'user', '');

-- ----------------------------
-- Table structure for xjy_user_action_log
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_action_log`;
CREATE TABLE `xjy_user_action_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访问次数',
  `last_visit_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后访问时间',
  `object` varchar(100) NOT NULL DEFAULT '' COMMENT '访问对象的id,格式:不带前缀的表名+id;如posts1表示xx_posts表里id为1的记录',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '操作名称;格式:应用名+控制器+操作名,也可自己定义格式只要不发生冲突且惟一;',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT '用户ip',
  PRIMARY KEY (`id`),
  KEY `user_object_action` (`user_id`,`object`,`action`),
  KEY `user_object_action_ip` (`user_id`,`object`,`action`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='访问记录表';

-- ----------------------------
-- Records of xjy_user_action_log
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_user_address
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_address`;
CREATE TABLE `xjy_user_address` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增默认ID',
  `user_id` bigint(20) NOT NULL COMMENT '第三方用户ID',
  `default` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否为默认地址 0:不是;1:是;',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '用户收货地址',
  `Contacts` varchar(50) NOT NULL DEFAULT '' COMMENT '联系人',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人手机',
  `lng` decimal(20,16) unsigned NOT NULL COMMENT '收货地址经度',
  `lat` decimal(20,16) unsigned NOT NULL COMMENT '收货地址纬度',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除标记',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='用户收货地址表';

-- ----------------------------
-- Records of xjy_user_address
-- ----------------------------
INSERT INTO `xjy_user_address` VALUES ('1', '1', '1', '四川省成都市高新区环球中心', '云九', '15982265259', '103.9900588989257800', '30.6172320553904530', '0');
INSERT INTO `xjy_user_address` VALUES ('2', '0', '0', 'a', '', 'a', '0.0000000000000000', '0.0000000000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('3', '0', '0', '环球中心E1', '李思健', '15982265259', '104.0697097778320300', '30.5448173680151100', '0');
INSERT INTO `xjy_user_address` VALUES ('4', '0', '0', '1010', 'LSJ', '123145678912', '104.0758895874023400', '30.6077768818237850', '0');
INSERT INTO `xjy_user_address` VALUES ('5', '0', '0', '1010', 'LSJ', '123145678912', '104.0758895874023400', '30.6077768818237850', '0');
INSERT INTO `xjy_user_address` VALUES ('6', '0', '0', '1010', 'LSJ', '123145678912', '104.0758895874023400', '30.6077768818237850', '0');
INSERT INTO `xjy_user_address` VALUES ('7', '1', '0', '1010', 'LSJ', '123145678912', '104.0758895874023400', '30.6077768818237850', '0');
INSERT INTO `xjy_user_address` VALUES ('8', '1', '0', '250', 'LSJ', '123145678912', '104.0758895874023400', '30.6077768818237850', '1510383319');
INSERT INTO `xjy_user_address` VALUES ('9', '1', '0', '233', '哈哈', '233', '104.0710830688476600', '30.6243228296460300', '1510383490');
INSERT INTO `xjy_user_address` VALUES ('10', '1', '0', '223', '233', '233', '104.0803527832031200', '30.3005750070908880', '0');
INSERT INTO `xjy_user_address` VALUES ('11', '1', '0', '', '', 'fsfsdf', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('12', '1', '0', 'sdgdsgsdgsdg', 'gdsgs', 'dsgsdgsdg', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('13', '1', '0', 'gsdgsdg', 'gsgs', 'gsdgsd', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('14', '1', '0', 'sfsdfsf', 'fdsfs', 'sfsdfsdf', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('15', '1', '0', 'fsfsfsdf', 'fsdfs', '182004959', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('16', '1', '0', '大撒旦大大', '大大测试', '182004522', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('17', '1', '0', 'czczcz czc', 'libo ', '182000', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('18', '1', '0', 'dadasdad', 'hdagd', '18010250252', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('19', '1', '0', 'dadasdad', 'hdagd', '18010250252', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('20', '1', '0', 'dadasdad', 'hdagd', '18010250252', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('21', '1', '0', 'dadasdad', 'hdagd', '18010250252', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('22', '1', '0', 'sfsdfsdf', 'gdsgs', 'gsdgsdgs', '113.3245211000000000', '23.1022900000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('23', '4', '0', '九眼桥', '测试收货人', '159156156198', '130.0000000000000000', '80.0000000000000000', '1510998364');
INSERT INTO `xjy_user_address` VALUES ('24', '2', '0', 'fsf s', 'fsf', '18010502235', '0.0000000000000000', '0.0000000000000000', '0');
INSERT INTO `xjy_user_address` VALUES ('25', '0', '0', '广东省广州市海珠区新港中路397号', '张三', '18200493959', '113.3237700000000000', '23.0964200000000000', '0');

-- ----------------------------
-- Table structure for xjy_user_balance
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_balance`;
CREATE TABLE `xjy_user_balance` (
  `record_id` smallint(20) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` bigint(20) unsigned NOT NULL,
  `WeChat` decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '微信交易额',
  `Alipay` decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '支付宝交易额',
  `UnionPay` decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '银联交易额',
  `Cash` decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '现金交易额',
  `time` bigint(40) unsigned NOT NULL COMMENT '时间',
  `VIP_card` decimal(20,2) unsigned NOT NULL COMMENT 'vip卡',
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='记录商家在微信，支付宝，银联，现金的余额';

-- ----------------------------
-- Records of xjy_user_balance
-- ----------------------------
INSERT INTO `xjy_user_balance` VALUES ('1', '10', '0.00', '177.00', '0.00', '0.00', '1524471233', '0.00');
INSERT INTO `xjy_user_balance` VALUES ('2', '10', '0.00', '0.00', '0.00', '2.00', '1524653881', '0.00');
INSERT INTO `xjy_user_balance` VALUES ('3', '10', '0.00', '0.00', '0.00', '0.00', '1524715745', '0.00');
INSERT INTO `xjy_user_balance` VALUES ('4', '10', '0.00', '0.00', '0.00', '0.00', '1524995589', '0.00');
INSERT INTO `xjy_user_balance` VALUES ('5', '32', '0.00', '0.00', '0.00', '90.00', '1525015064', '0.00');
INSERT INTO `xjy_user_balance` VALUES ('6', '10', '0.00', '0.00', '0.00', '0.00', '1527479300', '24.00');
INSERT INTO `xjy_user_balance` VALUES ('7', '10', '0.00', '0.00', '0.00', '0.00', '1527658799', '1514.73');
INSERT INTO `xjy_user_balance` VALUES ('8', '10', '0.00', '0.00', '0.00', '0.00', '1528143825', '5044.00');
INSERT INTO `xjy_user_balance` VALUES ('9', '10', '0.00', '0.00', '0.00', '0.00', '1529917442', '834.00');
INSERT INTO `xjy_user_balance` VALUES ('10', '10', '0.00', '0.00', '0.00', '0.00', '1529992959', '763.00');
INSERT INTO `xjy_user_balance` VALUES ('11', '10', '0.00', '0.00', '0.00', '0.00', '1530079392', '1398.00');

-- ----------------------------
-- Table structure for xjy_user_card
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_card`;
CREATE TABLE `xjy_user_card` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL COMMENT '用户id',
  `card_no` varchar(255) NOT NULL COMMENT '卡上编号',
  `card_number` varchar(255) NOT NULL COMMENT '会员内置号码',
  `card_time` int(50) NOT NULL COMMENT '开卡时间',
  `user_lv` int(20) NOT NULL COMMENT '卡片等级',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `user_RMB` decimal(50,2) NOT NULL COMMENT '账号余额',
  `type` smallint(5) NOT NULL DEFAULT '1' COMMENT '卡片状态 1:正常;2:冻结;3:删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='会员卡多卡管理';

-- ----------------------------
-- Records of xjy_user_card
-- ----------------------------
INSERT INTO `xjy_user_card` VALUES ('1', '22', '99990235', '3507075232', '1528097551', '4', '', '0.00', '1');
INSERT INTO `xjy_user_card` VALUES ('2', '23', '99990556', '2601350980', '1528097616', '1', '', '0.00', '1');
INSERT INTO `xjy_user_card` VALUES ('3', '22', '666666', '3265251181', '1528098906', '5', '', '0.00', '1');
INSERT INTO `xjy_user_card` VALUES ('4', '22', '55550031', '3557755437', '1528139620', '3', '', '40095.00', '1');
INSERT INTO `xjy_user_card` VALUES ('5', '21', 'NO.00060', '3264879581', '1528189655', '2', '内测人员', '94.00', '1');
INSERT INTO `xjy_user_card` VALUES ('6', '55', '99990004', '3593981837', '1528700721', '5', '', '17484.00', '1');
INSERT INTO `xjy_user_card` VALUES ('7', '40', '99990002', '3556738413', '1528701303', '5', '', '16721.00', '1');
INSERT INTO `xjy_user_card` VALUES ('8', '40', '99990003', '3556602365', '1528701370', '5', '', '17777.00', '1');
INSERT INTO `xjy_user_card` VALUES ('9', '94', '88880002', '3557193837', '1529828862', '4', '', '7681.00', '1');
INSERT INTO `xjy_user_card` VALUES ('10', '87', '55550002', '3556461789', '1529909221', '2', '', '0.00', '1');
INSERT INTO `xjy_user_card` VALUES ('11', '102', '55550003', '3596123613', '1529925219', '2', '', '836.00', '1');
INSERT INTO `xjy_user_card` VALUES ('12', '43', '55550004', '3557305037', '1529993985', '2', '', '1377.00', '1');
INSERT INTO `xjy_user_card` VALUES ('13', '54', '55550005', '3557453373', '1529994103', '2', '', '1377.00', '1');
INSERT INTO `xjy_user_card` VALUES ('14', '37', '55550006', '3557327085', '1529994638', '2', '', '1377.00', '1');
INSERT INTO `xjy_user_card` VALUES ('15', '117', '88880003', '3557781949', '1530070803', '4', '', '7777.00', '1');

-- ----------------------------
-- Table structure for xjy_user_collection
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_collection`;
CREATE TABLE `xjy_user_collection` (
  `user_id` bigint(20) unsigned NOT NULL COMMENT '第三用户ID',
  `menu_id` varchar(255) NOT NULL DEFAULT '' COMMENT '收藏商品 ;分号分割',
  `time` int(10) NOT NULL DEFAULT '0' COMMENT '收藏时间',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方用户收藏表';

-- ----------------------------
-- Records of xjy_user_collection
-- ----------------------------
INSERT INTO `xjy_user_collection` VALUES ('1', '12;11;', '0');

-- ----------------------------
-- Table structure for xjy_user_favorite
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_favorite`;
CREATE TABLE `xjy_user_favorite` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户 id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '收藏内容的标题',
  `url` varchar(255) DEFAULT '' COMMENT '收藏内容的原文地址，不带域名',
  `description` varchar(500) DEFAULT '' COMMENT '收藏内容的描述',
  `table_name` varchar(64) NOT NULL DEFAULT '' COMMENT '收藏实体以前所在表,不带前缀',
  `object_id` int(10) unsigned DEFAULT '0' COMMENT '收藏内容原来的主键id',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '收藏时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户收藏表';

-- ----------------------------
-- Records of xjy_user_favorite
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_user_level
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_level`;
CREATE TABLE `xjy_user_level` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(255) NOT NULL COMMENT '等级名称',
  `discount` smallint(4) NOT NULL COMMENT '优惠折扣',
  `full_level` int(50) DEFAULT NULL COMMENT '最大积分',
  `level_type` smallint(2) NOT NULL DEFAULT '0' COMMENT '是否开启积分系统 0:否;1:是;',
  `type` smallint(3) NOT NULL DEFAULT '0' COMMENT '状态 0:正常;1:删除;',
  `seller_id` int(20) NOT NULL COMMENT '商家id',
  `sort` int(20) NOT NULL DEFAULT '100' COMMENT '排列等级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xjy_user_level
-- ----------------------------
INSERT INTO `xjy_user_level` VALUES ('1', '普通', '100', null, '1', '0', '10', '100');
INSERT INTO `xjy_user_level` VALUES ('2', '金卡', '100', null, '1', '0', '10', '100');
INSERT INTO `xjy_user_level` VALUES ('3', '铂金', '100', null, '1', '0', '10', '100');
INSERT INTO `xjy_user_level` VALUES ('4', '钻石', '100', null, '1', '0', '10', '100');
INSERT INTO `xjy_user_level` VALUES ('5', '黑卡', '100', null, '1', '0', '10', '100');

-- ----------------------------
-- Table structure for xjy_user_login
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_login`;
CREATE TABLE `xjy_user_login` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_login` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户登录ID',
  `user_pass` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户登录密码password加密',
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '3' COMMENT '用户类型 1:admin;2:商家;3:会员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='登录信息';

-- ----------------------------
-- Records of xjy_user_login
-- ----------------------------
INSERT INTO `xjy_user_login` VALUES ('1', 'admin', '###d499dd12603c11857d2a01858d2de534', '1');
INSERT INTO `xjy_user_login` VALUES ('6', 'lsj', '###d499dd12603c11857d2a01858d2de534', '1');
INSERT INTO `xjy_user_login` VALUES ('7', '123', 'a', '1');
INSERT INTO `xjy_user_login` VALUES ('8', 'asd', 'as', '1');
INSERT INTO `xjy_user_login` VALUES ('9', '233333', '2333', '1');
INSERT INTO `xjy_user_login` VALUES ('10', 'bilibili', '###d499dd12603c11857d2a01858d2de534', '2');
INSERT INTO `xjy_user_login` VALUES ('11', '123321', '123321', '1');
INSERT INTO `xjy_user_login` VALUES ('12', 'as123', '123', '1');
INSERT INTO `xjy_user_login` VALUES ('13', 'lsja', '123', '1');
INSERT INTO `xjy_user_login` VALUES ('14', 'lisi', '###6a72d8579cb8391b587572c801efb37c', '1');
INSERT INTO `xjy_user_login` VALUES ('15', 'li', '###d499dd12603c11857d2a01858d2de534', '2');

-- ----------------------------
-- Table structure for xjy_user_login_attempt
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_login_attempt`;
CREATE TABLE `xjy_user_login_attempt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login_attempts` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '尝试次数',
  `attempt_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '尝试登录时间',
  `locked_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '锁定时间',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT '用户 ip',
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT '用户账号,手机号,邮箱或用户名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户登录尝试表';

-- ----------------------------
-- Records of xjy_user_login_attempt
-- ----------------------------

-- ----------------------------
-- Table structure for xjy_user_menu
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_menu`;
CREATE TABLE `xjy_user_menu` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `uer_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `menu_id` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '服务厅id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='分配服务厅';

-- ----------------------------
-- Records of xjy_user_menu
-- ----------------------------
INSERT INTO `xjy_user_menu` VALUES ('1', '99', '200');
INSERT INTO `xjy_user_menu` VALUES ('2', '98', '179');
INSERT INTO `xjy_user_menu` VALUES ('3', '98', '180');
INSERT INTO `xjy_user_menu` VALUES ('4', '98', '184');
INSERT INTO `xjy_user_menu` VALUES ('5', '98', '195');
INSERT INTO `xjy_user_menu` VALUES ('6', '98', '198');
INSERT INTO `xjy_user_menu` VALUES ('7', '98', '203');
INSERT INTO `xjy_user_menu` VALUES ('8', '98', '204');
INSERT INTO `xjy_user_menu` VALUES ('9', '98', '205');
INSERT INTO `xjy_user_menu` VALUES ('10', '97', '207');
INSERT INTO `xjy_user_menu` VALUES ('11', '32', '179');
INSERT INTO `xjy_user_menu` VALUES ('12', '34', '179');
INSERT INTO `xjy_user_menu` VALUES ('13', '34', '180');
INSERT INTO `xjy_user_menu` VALUES ('14', '34', '184');
INSERT INTO `xjy_user_menu` VALUES ('15', '34', '195');
INSERT INTO `xjy_user_menu` VALUES ('16', '34', '198');
INSERT INTO `xjy_user_menu` VALUES ('17', '34', '203');
INSERT INTO `xjy_user_menu` VALUES ('18', '34', '204');
INSERT INTO `xjy_user_menu` VALUES ('19', '34', '205');
INSERT INTO `xjy_user_menu` VALUES ('20', '98', '179');
INSERT INTO `xjy_user_menu` VALUES ('21', '98', '180');
INSERT INTO `xjy_user_menu` VALUES ('22', '98', '184');
INSERT INTO `xjy_user_menu` VALUES ('23', '98', '195');
INSERT INTO `xjy_user_menu` VALUES ('24', '98', '198');
INSERT INTO `xjy_user_menu` VALUES ('25', '98', '203');
INSERT INTO `xjy_user_menu` VALUES ('26', '98', '204');
INSERT INTO `xjy_user_menu` VALUES ('27', '98', '205');
INSERT INTO `xjy_user_menu` VALUES ('28', '98', '246');
INSERT INTO `xjy_user_menu` VALUES ('29', '98', '272');
INSERT INTO `xjy_user_menu` VALUES ('30', '98', '273');
INSERT INTO `xjy_user_menu` VALUES ('31', '98', '274');
INSERT INTO `xjy_user_menu` VALUES ('32', '99', '200');
INSERT INTO `xjy_user_menu` VALUES ('33', '99', '272');
INSERT INTO `xjy_user_menu` VALUES ('34', '99', '274');

-- ----------------------------
-- Table structure for xjy_user_score_log
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_score_log`;
CREATE TABLE `xjy_user_score_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户 id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '用户操作名称',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '更改积分，可以为负',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '更改金币，可以为负',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户操作积分等奖励日志表';

-- ----------------------------
-- Records of xjy_user_score_log
-- ----------------------------
INSERT INTO `xjy_user_score_log` VALUES ('1', '1', '1506184278', 'login', '1', '0');
INSERT INTO `xjy_user_score_log` VALUES ('2', '1', '1509595006', 'login', '1', '0');

-- ----------------------------
-- Table structure for xjy_user_token
-- ----------------------------
DROP TABLE IF EXISTS `xjy_user_token`;
CREATE TABLE `xjy_user_token` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户id',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT ' 过期时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `token` varchar(64) NOT NULL DEFAULT '' COMMENT 'token',
  `device_type` varchar(10) NOT NULL DEFAULT '' COMMENT '设备类型;mobile,android,iphone,ipad,web,pc,mac,wxapp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COMMENT='用户客户端登录 token 表';

-- ----------------------------
-- Records of xjy_user_token
-- ----------------------------
INSERT INTO `xjy_user_token` VALUES ('3', '1', '1545747114', '1530195114', '7218986d0db8424fb7f33eecb573fb0d7218986d0db8424fb7f33eecb573fb0d', 'web');
INSERT INTO `xjy_user_token` VALUES ('4', '15', '1525743794', '1510191794', '62dcde7f979b17aa7a622d96ae6ce1a062dcde7f979b17aa7a622d96ae6ce1a0', 'web');
INSERT INTO `xjy_user_token` VALUES ('5', '10', '1545789393', '1530237393', '90e63745125524135ef3043d972c2daf90e63745125524135ef3043d972c2daf', 'web');
INSERT INTO `xjy_user_token` VALUES ('6', '3', '1539778496', '1524226496', 'bb087c706abff9ab5bd60311df0080bebb087c706abff9ab5bd60311df0080be', 'web');
INSERT INTO `xjy_user_token` VALUES ('7', '2', '1525777428', '1510225428', '355a88a8c469c0afc4c0d15627c40c32355a88a8c469c0afc4c0d15627c40c32', 'web');
INSERT INTO `xjy_user_token` VALUES ('8', '13', '1525920589', '1510368589', 'ac9bb465bd5b28ef08db047f44fe4749ac9bb465bd5b28ef08db047f44fe4749', 'web');
INSERT INTO `xjy_user_token` VALUES ('9', '18', '1539742024', '1524190024', '04bea6e85f3c352b45bcd7147aaf766604bea6e85f3c352b45bcd7147aaf7666', 'web');
INSERT INTO `xjy_user_token` VALUES ('10', '19', '1540469719', '1524917719', 'ac1a20999f3cd347c429959ea4af923bac1a20999f3cd347c429959ea4af923b', 'web');
INSERT INTO `xjy_user_token` VALUES ('11', '20', '1545647732', '1530095732', '9149c719d466fa48c4a6d5bfc5b5b0489149c719d466fa48c4a6d5bfc5b5b048', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('12', '21', '1545278756', '1529726756', '58efb37d6a13fa67d9d0adaf9ff5fdde58efb37d6a13fa67d9d0adaf9ff5fdde', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('13', '22', '1545643376', '1530091376', 'be6b44df0a79d83470be63f5ab41b90ebe6b44df0a79d83470be63f5ab41b90e', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('14', '23', '1545641003', '1530089003', 'b38c6bc7991b6892b5f2ddd2a9794003b38c6bc7991b6892b5f2ddd2a9794003', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('15', '24', '1540867065', '1525315065', '20d6ca811a96ebb8161842a24b5463e520d6ca811a96ebb8161842a24b5463e5', 'web');
INSERT INTO `xjy_user_token` VALUES ('16', '26', '1540450842', '1524898842', 'c9c69a96575233cab7b5d98b1a11ec32c9c69a96575233cab7b5d98b1a11ec32', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('17', '32', '1544103287', '1528551287', '8d4b6deea78532b6755227523fd69b438d4b6deea78532b6755227523fd69b43', 'web');
INSERT INTO `xjy_user_token` VALUES ('18', '33', '1545705295', '1530153295', '36e740575b428e2d91b32b996a87421b36e740575b428e2d91b32b996a87421b', 'web');
INSERT INTO `xjy_user_token` VALUES ('19', '34', '1545565391', '1530013391', 'c8bb1d606351e2ec46559a1c7dab1989c8bb1d606351e2ec46559a1c7dab1989', 'web');
INSERT INTO `xjy_user_token` VALUES ('20', '35', '1541815391', '1526263391', '3965112fe5386103463e712eabdab9f03965112fe5386103463e712eabdab9f0', 'web');
INSERT INTO `xjy_user_token` VALUES ('21', '36', '1545647052', '1530095052', '24f3c892e918aadfe047c949a81d698c24f3c892e918aadfe047c949a81d698c', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('22', '37', '1543913614', '1528361614', 'f5b2d371019229d5f69e475cb4416257f5b2d371019229d5f69e475cb4416257', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('23', '38', '1545555652', '1530003652', '40568f423f3f696b5f03b2cbacf0927340568f423f3f696b5f03b2cbacf09273', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('24', '39', '1545642016', '1530090016', 'f06f5bd984ccb3e2de6a79201ca1b942f06f5bd984ccb3e2de6a79201ca1b942', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('25', '40', '1545469932', '1529917932', '2758c969cdc1a5fa5463ea0a2947700b2758c969cdc1a5fa5463ea0a2947700b', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('26', '41', '1545547110', '1529995110', '229fc0a2723e91e15793565842b90cff229fc0a2723e91e15793565842b90cff', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('27', '42', '1545543461', '1529991461', 'e3cc5a516016b44b6a4b8bbb2c30ca4ee3cc5a516016b44b6a4b8bbb2c30ca4e', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('28', '43', '1545538109', '1529986109', '3d118490d2047f4787c20aaacd988b453d118490d2047f4787c20aaacd988b45', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('29', '44', '1545557860', '1530005860', '8ced14dd3124c4008d46cf1f6621e3098ced14dd3124c4008d46cf1f6621e309', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('30', '45', '1545536707', '1529984707', '3b70cab8b55d3705ced51a173bccd1df3b70cab8b55d3705ced51a173bccd1df', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('31', '46', '1545536512', '1529984512', '64676ef4463bded7ff5434df93f9963664676ef4463bded7ff5434df93f99636', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('32', '47', '1545702304', '1530150304', '12913eba94a9b90ebd697c0ebec1c4e212913eba94a9b90ebd697c0ebec1c4e2', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('33', '48', '1545647087', '1530095087', '330f6b2baed5d00458e2549de8e54ed3330f6b2baed5d00458e2549de8e54ed3', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('34', '49', '1545383132', '1529831132', 'e531464de5017dcdecbc6148b4be3cd9e531464de5017dcdecbc6148b4be3cd9', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('35', '50', '1545037888', '1529485888', '35a662167406bfaa9535ba857b0f56b935a662167406bfaa9535ba857b0f56b9', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('36', '51', '1545536508', '1529984508', '123077e497053d10dede307cc2b7a161123077e497053d10dede307cc2b7a161', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('37', '52', '1545536693', '1529984693', '4700cdf05702984eafeba286b72c10ce4700cdf05702984eafeba286b72c10ce', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('38', '53', '1545476467', '1529924467', 'ff7261dc4a7f8c0191df1a1185608183ff7261dc4a7f8c0191df1a1185608183', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('39', '54', '1545377612', '1529825612', '4e39944284942fed973efdc7d94234424e39944284942fed973efdc7d9423442', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('40', '55', '1543302628', '1527750628', 'f0d6fe6d4d81d5ccd8f5aeddfe17c34af0d6fe6d4d81d5ccd8f5aeddfe17c34a', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('41', '56', '1543303104', '1527751104', '263b89e514cc9c58361c36f8ca100658263b89e514cc9c58361c36f8ca100658', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('42', '57', '1545038322', '1529486322', '994b254ff36a2d486e1fe4911d41c397994b254ff36a2d486e1fe4911d41c397', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('43', '58', '1545558071', '1530006071', 'd20c982976a498cf8f1072829b7386b3d20c982976a498cf8f1072829b7386b3', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('44', '59', '1545622153', '1530070153', '3711aaeeebe62c6673d6e8f73b223f403711aaeeebe62c6673d6e8f73b223f40', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('45', '60', '1543820517', '1528268517', '28247e48ebee63f619943ffe60d4e73528247e48ebee63f619943ffe60d4e735', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('46', '61', '1543913642', '1528361642', '3a130bd90fc5c44dc0a9e3932b784ed23a130bd90fc5c44dc0a9e3932b784ed2', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('47', '62', '1545643100', '1530091100', 'd8258e0123a0b279b385844f3fd960d1d8258e0123a0b279b385844f3fd960d1', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('48', '63', '1545558022', '1530006022', 'cd21c5eb1543c2797d56fe16cf7f74f4cd21c5eb1543c2797d56fe16cf7f74f4', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('49', '64', '1545536547', '1529984547', 'e50903959bc23c6fc4c4f4a3aa939eb2e50903959bc23c6fc4c4f4a3aa939eb2', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('50', '65', '1545559603', '1530007603', 'a6eddb286db0766773ac4374e6055e1da6eddb286db0766773ac4374e6055e1d', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('51', '66', '1545040989', '1529488989', '18d0ac4038b7709a4e78a28203755e6e18d0ac4038b7709a4e78a28203755e6e', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('52', '67', '1545187660', '1529635660', '18c5a37fb81aadaaa74d5099897f5a5518c5a37fb81aadaaa74d5099897f5a55', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('53', '68', '1544341222', '1528789222', 'e556973c1f05cafb98c3685e193c78cee556973c1f05cafb98c3685e193c78ce', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('54', '69', '1545559743', '1530007743', '848253cc9334da1b86929847159c4949848253cc9334da1b86929847159c4949', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('55', '70', '1545532507', '1529980507', '645180663673ce520308e6a95661527f645180663673ce520308e6a95661527f', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('56', '71', '1545536599', '1529984599', 'f011f2f12d8bbcefc601c96efd93bd70f011f2f12d8bbcefc601c96efd93bd70', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('57', '72', '1544341485', '1528789485', '9cd153d5ce2161aefbf312af41e160c69cd153d5ce2161aefbf312af41e160c6', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('58', '73', '1545536543', '1529984543', '330e2ee3010e34087d837a2b56890cf6330e2ee3010e34087d837a2b56890cf6', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('59', '74', '1544341578', '1528789578', '895f010a746cefcdd7017b6260cbf973895f010a746cefcdd7017b6260cbf973', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('60', '75', '1544401973', '1528849973', '434c92744fe008b4edfcb75b83a4205f434c92744fe008b4edfcb75b83a4205f', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('61', '76', '1544410235', '1528858235', 'e7093a9326a0ba8a4aac37c9b78df48ce7093a9326a0ba8a4aac37c9b78df48c', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('62', '77', '1544421363', '1528869363', '5129cc649a02cb5fb9b282fe244caf155129cc649a02cb5fb9b282fe244caf15', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('63', '78', '1544421473', '1528869473', '8f75b1b0c4cafc5d15f2df0bf84db7778f75b1b0c4cafc5d15f2df0bf84db777', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('64', '79', '1544430601', '1528878601', '9f868ce05e1f9092c343739aa83e60c79f868ce05e1f9092c343739aa83e60c7', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('65', '80', '1544430988', '1528878988', '8801c6e5cc3ceb502d500a4fa500b9758801c6e5cc3ceb502d500a4fa500b975', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('66', '81', '1545359830', '1529807830', '0c655bad3b7121b77a3ca7df081d99fb0c655bad3b7121b77a3ca7df081d99fb', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('67', '82', '1545651948', '1530099948', '81c647e0c2713ee130d5380ff331560981c647e0c2713ee130d5380ff3315609', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('68', '83', '1545470842', '1529918842', 'ef1632ab1f698e90a2567e47eade25f4ef1632ab1f698e90a2567e47eade25f4', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('69', '84', '1545536523', '1529984523', '17086d0145bc7f35f8222f8162f85fd317086d0145bc7f35f8222f8162f85fd3', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('70', '85', '1545559373', '1530007373', 'add3bc2b9986487202ef7d6eff44abbdadd3bc2b9986487202ef7d6eff44abbd', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('71', '86', '1545532584', '1529980584', '8e05f4c6f22e5b8a25bcafc40afe7ae98e05f4c6f22e5b8a25bcafc40afe7ae9', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('72', '87', '1545042528', '1529490528', '94b292a0d4cca930ea60518eca3ffb9594b292a0d4cca930ea60518eca3ffb95', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('73', '88', '1545203024', '1529651024', 'cb87ce81213662a3152485df8d20979acb87ce81213662a3152485df8d20979a', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('74', '89', '1545280227', '1529728227', '327117fafcbeefa2db94864c49a522cd327117fafcbeefa2db94864c49a522cd', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('75', '90', '1545280375', '1529728375', '111a4e0859434610148cf8b2445a8337111a4e0859434610148cf8b2445a8337', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('76', '91', '1545291696', '1529739696', '3df840181822fae8de61cf12002b5fa33df840181822fae8de61cf12002b5fa3', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('77', '92', '1545297691', '1529745691', '617b203f31e9b2170b064095c78193ad617b203f31e9b2170b064095c78193ad', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('78', '93', '1545373388', '1529821388', 'fcef2b8bb5753f610b7221269a0577bcfcef2b8bb5753f610b7221269a0577bc', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('79', '94', '1545374087', '1529822087', '45c5342d0b0660ab3bc46b8f4e6729a545c5342d0b0660ab3bc46b8f4e6729a5', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('80', '95', '1545383260', '1529831260', 'e40ed8348c0cd130575cb02979e6fee3e40ed8348c0cd130575cb02979e6fee3', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('81', '96', '1545386846', '1529834846', 'd917cf4020a5cb01732c183de0be86c1d917cf4020a5cb01732c183de0be86c1', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('82', '97', '1545704740', '1530152740', '2f2a7fa0365dd34ec146bcf04568e0672f2a7fa0365dd34ec146bcf04568e067', 'web');
INSERT INTO `xjy_user_token` VALUES ('83', '98', '1545706586', '1530154586', '0c6bab187a20926ec7d2fb1b7511a0e30c6bab187a20926ec7d2fb1b7511a0e3', 'web');
INSERT INTO `xjy_user_token` VALUES ('84', '99', '1545702160', '1530150160', 'a69825083b02eba4ff4e270c2f53c54aa69825083b02eba4ff4e270c2f53c54a', 'web');
INSERT INTO `xjy_user_token` VALUES ('85', '100', '1545475599', '1529923599', '2e8e776e093620a4469285da2b986c802e8e776e093620a4469285da2b986c80', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('86', '101', '1545475782', '1529923782', '341f966315d759e754f7eb09f8be8d8c341f966315d759e754f7eb09f8be8d8c', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('87', '102', '1545476713', '1529924713', '401bd2ec45300691776ed4c50d48bf77401bd2ec45300691776ed4c50d48bf77', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('88', '103', '1545481472', '1529929472', '5425fd263eaf70a03cbb3a387cf294ba5425fd263eaf70a03cbb3a387cf294ba', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('89', '104', '1545533630', '1529981630', 'c8dc897784c4e0031a890f2b74c76ff8c8dc897784c4e0031a890f2b74c76ff8', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('90', '105', '1545537144', '1529985144', '7bf5e69a1224e5dbfaa4e801373231237bf5e69a1224e5dbfaa4e80137323123', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('91', '106', '1545537188', '1529985188', '379746adb1379132e97e9a005e981246379746adb1379132e97e9a005e981246', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('92', '107', '1545539951', '1529987951', 'bee9685cb8af6a4e415687cab0e40569bee9685cb8af6a4e415687cab0e40569', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('93', '108', '1545539963', '1529987963', '8aa44aa0147166ab85e769862984617e8aa44aa0147166ab85e769862984617e', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('94', '109', '1545542458', '1529990458', '4d669a28c0cc75ea7056511041e32af74d669a28c0cc75ea7056511041e32af7', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('95', '110', '1545566263', '1530014263', '80ec95e993523a1a430653ee6741161c80ec95e993523a1a430653ee6741161c', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('96', '111', '1545545484', '1529993484', 'f72a15f73981af538ed91d2b94b2b707f72a15f73981af538ed91d2b94b2b707', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('97', '112', '1545650190', '1530098190', 'c1c9bd26d659b4aadbe5d42e533e1280c1c9bd26d659b4aadbe5d42e533e1280', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('98', '113', '1545569965', '1530017965', 'ad769d7842bbced5456e260dc0798a26ad769d7842bbced5456e260dc0798a26', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('99', '114', '1545615365', '1530063365', '5710814ca0ecc527c710481fd0fd53765710814ca0ecc527c710481fd0fd5376', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('100', '115', '1545619470', '1530067470', 'd664790dd9d8fca693c426edc654fdb0d664790dd9d8fca693c426edc654fdb0', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('101', '116', '1545650269', '1530098269', 'c714cbf74bcea62d7ed55c24e6d3d6f6c714cbf74bcea62d7ed55c24e6d3d6f6', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('102', '117', '1545621813', '1530069813', 'd01942bae82c72eb6c3447bb5ddc5b71d01942bae82c72eb6c3447bb5ddc5b71', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('103', '118', '1545638640', '1530086640', '88a2fb9b37e6e61456d0153020bab83088a2fb9b37e6e61456d0153020bab830', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('104', '119', '1545623773', '1530071773', '2372c35d57e14dd402ba393d928b307c2372c35d57e14dd402ba393d928b307c', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('105', '120', '1545626102', '1530074102', '28c5bf97203df2b185a8ed00ea5b8ddc28c5bf97203df2b185a8ed00ea5b8ddc', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('106', '121', '1545624695', '1530072695', '4ef58eed88f63f402765ac6697fc4c2e4ef58eed88f63f402765ac6697fc4c2e', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('107', '122', '1545624737', '1530072737', '8f43f74b40840562b778366bed245c218f43f74b40840562b778366bed245c21', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('108', '123', '1545624965', '1530072965', '7e2bde0036400c51ea10ef53c86208b27e2bde0036400c51ea10ef53c86208b2', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('109', '124', '1545625114', '1530073114', '34cc185d13fb28d0007ceb79c6ad876734cc185d13fb28d0007ceb79c6ad8767', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('110', '125', '1545625116', '1530073116', 'ce3f9883ce8755163b755d64ee9479d1ce3f9883ce8755163b755d64ee9479d1', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('111', '126', '1545625286', '1530073286', '998c23d115ab3c372125cd4b22534051998c23d115ab3c372125cd4b22534051', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('112', '127', '1545625314', '1530073314', 'e8cd70d2f147fd4daaa7033a11295edfe8cd70d2f147fd4daaa7033a11295edf', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('113', '128', '1545625599', '1530073599', '2ba454c83dbfccdd704891e5189383c62ba454c83dbfccdd704891e5189383c6', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('114', '129', '1545625626', '1530073626', '46f2c65da4cae13e4e159c04aadbcf0246f2c65da4cae13e4e159c04aadbcf02', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('115', '130', '1545625865', '1530073865', '038cbdc80d6ffb1a2768400deb9310de038cbdc80d6ffb1a2768400deb9310de', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('116', '131', '1545625882', '1530073882', '11747e798798903160b98a3e61f9f69511747e798798903160b98a3e61f9f695', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('117', '132', '1545626155', '1530074155', 'ebda9718206e86616606fb808043a8b4ebda9718206e86616606fb808043a8b4', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('118', '133', '1545626161', '1530074161', 'b946466a6db8e8f0fa6522784a382f63b946466a6db8e8f0fa6522784a382f63', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('119', '134', '1545633820', '1530081820', 'd817ae63ce3f087f9e43ef235ae042cfd817ae63ce3f087f9e43ef235ae042cf', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('120', '135', '1545635018', '1530083018', 'c6e30821b213202e796d80f9263b8afec6e30821b213202e796d80f9263b8afe', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('121', '136', '1545639023', '1530087023', '7ccd6bc8968bbfb8d105a7bdce5109d47ccd6bc8968bbfb8d105a7bdce5109d4', 'wxapp');
INSERT INTO `xjy_user_token` VALUES ('122', '137', '1545707388', '1530155388', 'cd3f039e38e6bbf7f3b8433feb3f9d1ccd3f039e38e6bbf7f3b8433feb3f9d1c', 'wxapp');

-- ----------------------------
-- Table structure for xjy_verification_code
-- ----------------------------
DROP TABLE IF EXISTS `xjy_verification_code`;
CREATE TABLE `xjy_verification_code` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当天已经发送成功的次数',
  `send_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后发送成功时间',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '验证码过期时间',
  `code` varchar(8) NOT NULL DEFAULT '' COMMENT '最后发送成功的验证码',
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT '手机号或者邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='手机邮箱数字验证码表';

-- ----------------------------
-- Records of xjy_verification_code
-- ----------------------------
