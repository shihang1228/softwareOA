/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : esm

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2014-12-30 13:52:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `rv_beiji`
-- ----------------------------
DROP TABLE IF EXISTS `rv_beiji`;
CREATE TABLE `rv_beiji` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `company` varchar(100) NOT NULL COMMENT '公司名称',
  `carNum` varchar(10) NOT NULL COMMENT '车牌号',
  `chaidate` varchar(20) default NULL COMMENT '拆取日期',
  `chaipeople` varchar(10) NOT NULL COMMENT '拆取人',
  `agreement` varchar(10) default NULL COMMENT '备机协议编号',
  `agreedate` varchar(20) NOT NULL COMMENT '机备协议日期',
  `deposit` decimal(20,2) default NULL COMMENT '押金',
  `beichaidate` varchar(20) default NULL COMMENT '机备拆取日期',
  `model` varchar(20) default NULL COMMENT '设备型号',
  `beizhu` varchar(20) default NULL COMMENT '备注',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of rv_beiji
-- ----------------------------
INSERT INTO `rv_beiji` VALUES ('1', '等哈就好', '1424', '2014-10-01', 'fdsf', '567867', '2014-10-03', '100.00', '2014-10-21', '75', 'hncfg', '冀东启明科技有限公司');
INSERT INTO `rv_beiji` VALUES ('2', '太原运输公司', '752', '2014-10-07', '多方便', '4554545', '2014-10-07', '100.00', '2014-10-09', '不敢发', '', '太原科技有限公司');
INSERT INTO `rv_beiji` VALUES ('3', '忻州运输公司', '741', '', '都是', 'sc', '', '100.00', '', 'll', '', '太原科技有限公司');
INSERT INTO `rv_beiji` VALUES ('4', '忻州运输公司', 'H54321', '2014-10-08', '张长伟', 'JD-B0001', '2014-10-08', '0.00', '2014-09-30', 'R6带北斗', '已拆取备机', '启明科技');
INSERT INTO `rv_beiji` VALUES ('5', '忻州运输公司', 'H12345', '2014-09-08', '辅导方法', 'fff677', '2014-09-22', '200.00', '', 'R带北斗', '已安装备机', '启明科技');
INSERT INTO `rv_beiji` VALUES ('6', '太原运输公司', '晋45612', '2014-10-08', '小王', '645645435', '', '100.00', '2014-10-23', '778', '255325', '启明科技');
INSERT INTO `rv_beiji` VALUES ('7', '太原运输公司', '晋45612', '', '让', 'tgw', '2014-10-17', '100.00', '', '456', '', '启明科技');
INSERT INTO `rv_beiji` VALUES ('8', '太原运输公司', '晋45612', '', '是对的', 'adf', '2014-10-09', '2002.00', '', '5454', '', '启明科技');
INSERT INTO `rv_beiji` VALUES ('9', '太原运输公司', '晋45612', '', '杰克', '45468', '2014-10-15', '300.00', '', '54', '', '启明科技');

-- ----------------------------
-- Table structure for `rv_buyway`
-- ----------------------------
DROP TABLE IF EXISTS `rv_buyway`;
CREATE TABLE `rv_buyway` (
  `id` int(11) NOT NULL auto_increment,
  `buyway` varchar(50) NOT NULL COMMENT '车辆购置方式',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_buyway
-- ----------------------------
INSERT INTO `rv_buyway` VALUES ('1', '分期付款');
INSERT INTO `rv_buyway` VALUES ('2', '一次性付清');

-- ----------------------------
-- Table structure for `rv_caidan`
-- ----------------------------
DROP TABLE IF EXISTS `rv_caidan`;
CREATE TABLE `rv_caidan` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `productId` int(11) default NULL COMMENT '商品ID',
  `model` varchar(11) default NULL COMMENT '商品型号',
  `supplierId` int(11) default NULL COMMENT '供货商名称',
  `supplier` varchar(50) default NULL COMMENT '设备厂家',
  `roomId` int(11) default NULL COMMENT '库房',
  `roomruId` int(11) default NULL,
  `username` varchar(12) NOT NULL COMMENT '用户名',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  `qufen` varchar(50) NOT NULL COMMENT '区分是哪个模块使用的',
  PRIMARY KEY  (`id`),
  KEY `1` (`productId`),
  KEY `2` (`roomId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of rv_caidan
-- ----------------------------
INSERT INTO `rv_caidan` VALUES ('4', null, null, null, null, null, null, '李四', '启明科技', 'device');
INSERT INTO `rv_caidan` VALUES ('6', null, null, null, null, null, null, '李四', '冀东启明', 'sale');
INSERT INTO `rv_caidan` VALUES ('13', null, null, null, null, null, null, '李四', '冀东启明', 'diaobo');
INSERT INTO `rv_caidan` VALUES ('14', null, null, null, null, null, null, '李四', '冀东启明', 'device');

-- ----------------------------
-- Table structure for `rv_car`
-- ----------------------------
DROP TABLE IF EXISTS `rv_car`;
CREATE TABLE `rv_car` (
  `id` int(11) NOT NULL auto_increment COMMENT '车辆ID',
  `company` varchar(50) default NULL COMMENT '单位名称',
  `carNum` varchar(20) NOT NULL default '' COMMENT '车号',
  `chejiaNum` varchar(18) default NULL COMMENT '车架号',
  `platform` varchar(50) default NULL COMMENT '车辆平台',
  `carleixing` varchar(50) NOT NULL COMMENT '车辆类型',
  `carstateId` int(11) NOT NULL COMMENT '车辆状态',
  `xianlu` varchar(50) NOT NULL COMMENT '线路',
  `zhengdate` varchar(50) default NULL COMMENT '行车证审验日期',
  `linkname` varchar(20) NOT NULL COMMENT '联系人',
  `tel` varchar(20) NOT NULL COMMENT '联系电话',
  `zidai` int(5) NOT NULL COMMENT '判断是否为出厂自带设备，1为出厂自带',
  `fuwufei` decimal(20,2) default NULL COMMENT '每年需交的服务费',
  `stopdate` varchar(50) default NULL COMMENT '停运日期',
  `startdate` varchar(50) default NULL COMMENT '恢复运行日期',
  `judge` int(5) NOT NULL default '0' COMMENT '0为没有任何操作，1为减款，2为已减款',
  `doubledevice` varchar(10) NOT NULL COMMENT '是否属于双设备',
  `fenqi` varchar(10) NOT NULL COMMENT '是否属于分期付款',
  `zhuanfa` varchar(10) default '否' COMMENT '是否属于转发车辆',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`),
  KEY `carNum` (`carNum`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_car
-- ----------------------------
INSERT INTO `rv_car` VALUES ('42', '祥龙公司', '晋H12312', 'fdsa1111111111111', '冀东启明车联网平台', '长途客车', '15', '太原——五台', '8', '张三', '10000000000', '0', '720.00', null, null, '0', '', '否', null, '启明科技');
INSERT INTO `rv_car` VALUES ('43', '祥龙公司', '晋H12312(2G)', 'fdsa1111111111111', '冀东启明车联网平台', '长途客车', '15', '太原——五台', '8', '张三', '10000000000', '0', '720.00', null, null, '0', '', '否', null, '启明科技');
INSERT INTO `rv_car` VALUES ('44', '祥龙公司', '晋H11111', 'ds121212121212121', '1号平台', '长途客车', '15', '分', '5', '小王', '12121212121', '0', '720.00', null, null, '0', '否', '否', null, '启明科技');
INSERT INTO `rv_car` VALUES ('45', '祥龙公司', '晋H45124', 'ds121212121212121', '冀东启明车联网平台', '长途客车', '15', '', '5', '放到', '15245555555', '0', '720.00', null, null, '0', '否', '否', null, '启明科技');
INSERT INTO `rv_car` VALUES ('46', '祥龙公司', '晋H784515(2G)', 'LFWSRXPJ9B1E09446', '冀东启明车联网平台', '长途客车', '15', '繁峙--大同', '8', '王应和', '13294616693', '0', '720.00', null, null, '0', '是', '否', null, '启明科技');
INSERT INTO `rv_car` VALUES ('47', '祥龙公司', '晋H784515(3G)', 'LFWSRXPJ9B1E09446', '冀东启明车联网平台', '长途客车', '15', '繁峙--大同', '8', '王应和', '13294616693', '0', '720.00', null, null, '0', '是', '否', null, '冀东启明');
INSERT INTO `rv_car` VALUES ('48', '祥龙公司', '晋H45124', 'mhb11111111111111', '1号平台', '长途客车', '15', '改行', '5', '结果', '12121212121', '0', '720.00', null, null, '0', '否', '否', '否', '启明科技');

-- ----------------------------
-- Table structure for `rv_cards`
-- ----------------------------
DROP TABLE IF EXISTS `rv_cards`;
CREATE TABLE `rv_cards` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `tmobile` varchar(50) NOT NULL COMMENT '运营商',
  `cardnum` varchar(20) NOT NULL COMMENT '卡号',
  `simstateId` int(11) NOT NULL COMMENT '当前缴费状态',
  `changedate` varchar(20) default NULL COMMENT '卡状态变更日期',
  `imei` int(100) default NULL COMMENT '串号',
  `tariff` varchar(20) default NULL COMMENT '当前资费',
  `tariffdate` varchar(20) default NULL COMMENT '资费变更日期',
  `test` varchar(20) default NULL COMMENT '测试',
  `sales` varchar(10) default NULL COMMENT '是否需销号',
  `beizhu` varchar(100) default NULL COMMENT '备注',
  `date` varchar(20) default NULL COMMENT '最新日期',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_cards
-- ----------------------------
INSERT INTO `rv_cards` VALUES ('5', '电信', '2147483647', '0', '', '0', '5', null, '', '否', '', null, '太原科技有限公司');
INSERT INTO `rv_cards` VALUES ('6', '移动', '787877872222', '0', '', '0', '10', null, '', '否', '', null, '太原科技有限公司');
INSERT INTO `rv_cards` VALUES ('7', '联通', '54545454545411111', '0', '', '0', '10', null, '', '否', '', null, '太原科技有限公司');
INSERT INTO `rv_cards` VALUES ('10', '移动', '147845', '0', '2014-10-14', '45588', '10', '2014-10-07', null, '是', 'yuiyuiy', null, '冀东启明');
INSERT INTO `rv_cards` VALUES ('11', '电信', '12345678945', '0', '2014-10-23', '0', '5', '2014-10-16', null, '', '付过款', null, '启明科技');
INSERT INTO `rv_cards` VALUES ('12', '联通', '18235623562', '6', '', '0', '12', '', null, '', '', null, '启明科技');
INSERT INTO `rv_cards` VALUES ('13', '电信', '14526235623', '4', '2014-11-06', '0', '11', '', null, '', '', null, '启明科技');
INSERT INTO `rv_cards` VALUES ('14', '电信', '14526235623', '4', '2014-11-06', '0', '11', '', null, '', '', null, '启明科技');
INSERT INTO `rv_cards` VALUES ('15', '联通', '145255566', '5', '', '0', '20', '', null, '', '', null, '启明科技');
INSERT INTO `rv_cards` VALUES ('16', '移动', '1548595623', '6', '', '0', '5', '', null, '', '', null, '启明科技');
INSERT INTO `rv_cards` VALUES ('18', '联通', '15236525624', '4', null, null, '5', null, null, '', null, '2014-09', '启明科技');
INSERT INTO `rv_cards` VALUES ('19', '联通', '18475262356', '5', '2014-11-03', null, '5', '2014-11-13', null, '', '各打各的', '2014-09', '启明科技');
INSERT INTO `rv_cards` VALUES ('20', '移动', '18459685745', '4', null, null, '5', null, null, '', null, '2014-11', '启明科技');
INSERT INTO `rv_cards` VALUES ('21', '移动', '111111', '4', null, null, '5', null, null, '', null, '2014-11', '启明科技');
INSERT INTO `rv_cards` VALUES ('22', '移动', '18645952352', '6', '2014-11-13', '0', '8', '2014-11-14', null, null, '', '2014-11', '启明科技');
INSERT INTO `rv_cards` VALUES ('23', '移动', '1524825623', '5', '', null, '', null, null, null, null, '2014-10', '启明科技');
INSERT INTO `rv_cards` VALUES ('24', '移动', '1524825623', '5', '', null, '', null, null, null, null, '2014-11', '启明科技');
INSERT INTO `rv_cards` VALUES ('25', '移动', '1524825623', '5', '', null, '', null, null, null, null, '2014-11', '启明科技');
INSERT INTO `rv_cards` VALUES ('26', '移动', '1524825623', '5', '2014-11-24', null, '15', '', null, null, null, '2014-11', '启明科技');
INSERT INTO `rv_cards` VALUES ('27', '移动', '15241241241', '4', null, null, '10元', '2014-12-08', null, null, null, '2014-12', '启明科技');
INSERT INTO `rv_cards` VALUES ('28', '', '111111111111', '4', null, null, '5元', null, null, null, null, '2014-12', '启明科技');
INSERT INTO `rv_cards` VALUES ('29', '移动', '12111111111', '4', null, null, '5元', null, null, null, null, '2014-12', '启明科技');

-- ----------------------------
-- Table structure for `rv_carleixing`
-- ----------------------------
DROP TABLE IF EXISTS `rv_carleixing`;
CREATE TABLE `rv_carleixing` (
  `id` int(11) NOT NULL auto_increment,
  `leixing` varchar(50) NOT NULL COMMENT '车辆类型',
  `company1` varchar(50) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_carleixing
-- ----------------------------
INSERT INTO `rv_carleixing` VALUES ('1', '长途客车', '启明科技');
INSERT INTO `rv_carleixing` VALUES ('2', '长途货车', '启明科技');
INSERT INTO `rv_carleixing` VALUES ('3', '县乡车', '启明科技');
INSERT INTO `rv_carleixing` VALUES ('4', '校车', '启明科技');
INSERT INTO `rv_carleixing` VALUES ('5', '县际客车', '启明科技');
INSERT INTO `rv_carleixing` VALUES ('6', '其他  ', '启明科技');

-- ----------------------------
-- Table structure for `rv_carstate`
-- ----------------------------
DROP TABLE IF EXISTS `rv_carstate`;
CREATE TABLE `rv_carstate` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `carstate` varchar(30) default NULL COMMENT '车辆状态',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_carstate
-- ----------------------------
INSERT INTO `rv_carstate` VALUES ('1', '正常', '冀东启明科技有限公司');
INSERT INTO `rv_carstate` VALUES ('2', '报废', '冀东启明科技有限公司');
INSERT INTO `rv_carstate` VALUES ('3', '到期', '冀东启明科技有限公司');
INSERT INTO `rv_carstate` VALUES ('4', '转户', '冀东启明科技有限公司');
INSERT INTO `rv_carstate` VALUES ('5', '停运', '冀东启明科技有限公司');
INSERT INTO `rv_carstate` VALUES ('6', '正常', '太原科技有限公司');
INSERT INTO `rv_carstate` VALUES ('7', '到期', '太原科技有限公司');
INSERT INTO `rv_carstate` VALUES ('8', '停运', '太原科技有限公司');
INSERT INTO `rv_carstate` VALUES ('9', '报废', '太原科技有限公司');
INSERT INTO `rv_carstate` VALUES ('10', '转户', '太原科技有限公司');
INSERT INTO `rv_carstate` VALUES ('11', '正常', '冀东启明');
INSERT INTO `rv_carstate` VALUES ('12', '报停', '冀东启明');
INSERT INTO `rv_carstate` VALUES ('13', '报废', '冀东启明');
INSERT INTO `rv_carstate` VALUES ('14', '转户', '冀东启明');
INSERT INTO `rv_carstate` VALUES ('15', '正常', '启明科技');
INSERT INTO `rv_carstate` VALUES ('17', '报废', '启明科技');
INSERT INTO `rv_carstate` VALUES ('18', '转户', '启明科技');

-- ----------------------------
-- Table structure for `rv_cartype`
-- ----------------------------
DROP TABLE IF EXISTS `rv_cartype`;
CREATE TABLE `rv_cartype` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `cartype` varchar(20) NOT NULL COMMENT '车辆类型',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_cartype
-- ----------------------------
INSERT INTO `rv_cartype` VALUES ('1', '重型厢式货车');
INSERT INTO `rv_cartype` VALUES ('2', '普通货车');
INSERT INTO `rv_cartype` VALUES ('3', '罐车');
INSERT INTO `rv_cartype` VALUES ('4', '牵引车');
INSERT INTO `rv_cartype` VALUES ('5', '集装箱车');
INSERT INTO `rv_cartype` VALUES ('6', '半挂车');
INSERT INTO `rv_cartype` VALUES ('7', '自卸车');
INSERT INTO `rv_cartype` VALUES ('8', '大型货车');
INSERT INTO `rv_cartype` VALUES ('9', '厢式货车');
INSERT INTO `rv_cartype` VALUES ('10', '低速载货汽车');
INSERT INTO `rv_cartype` VALUES ('11', '专用运输车');
INSERT INTO `rv_cartype` VALUES ('12', '仓栅式货车');
INSERT INTO `rv_cartype` VALUES ('13', '平头柴油载货汽车');
INSERT INTO `rv_cartype` VALUES ('14', '洒布车');
INSERT INTO `rv_cartype` VALUES ('15', '粉粒物料运输车');
INSERT INTO `rv_cartype` VALUES ('16', '重型普通货车');
INSERT INTO `rv_cartype` VALUES ('17', '中型半挂牵引车');
INSERT INTO `rv_cartype` VALUES ('18', '中型普通货车');
INSERT INTO `rv_cartype` VALUES ('19', '重型罐式货车');
INSERT INTO `rv_cartype` VALUES ('20', '重型货车');
INSERT INTO `rv_cartype` VALUES ('21', '爆破器材运输车');
INSERT INTO `rv_cartype` VALUES ('22', '中型自卸货车');
INSERT INTO `rv_cartype` VALUES ('23', '重型专项作业车');
INSERT INTO `rv_cartype` VALUES ('24', '重型特殊结构货车');
INSERT INTO `rv_cartype` VALUES ('25', '大型专项作业车');
INSERT INTO `rv_cartype` VALUES ('26', '重型半挂牵引车');
INSERT INTO `rv_cartype` VALUES ('27', '封闭厢式');
INSERT INTO `rv_cartype` VALUES ('28', '非封闭厢式');
INSERT INTO `rv_cartype` VALUES ('29', '非厢式');
INSERT INTO `rv_cartype` VALUES ('30', '载货汽车');
INSERT INTO `rv_cartype` VALUES ('31', '农用车');
INSERT INTO `rv_cartype` VALUES ('32', '整车');
INSERT INTO `rv_cartype` VALUES ('33', '挂车');
INSERT INTO `rv_cartype` VALUES ('34', '重型平板货车');
INSERT INTO `rv_cartype` VALUES ('35', '仓栅式运输车');
INSERT INTO `rv_cartype` VALUES ('36', '重型仓栅式货车');
INSERT INTO `rv_cartype` VALUES ('37', '重型自卸货车');
INSERT INTO `rv_cartype` VALUES ('38', '重型封闭货车');
INSERT INTO `rv_cartype` VALUES ('39', '混凝土搅拌运输车');

-- ----------------------------
-- Table structure for `rv_chat`
-- ----------------------------
DROP TABLE IF EXISTS `rv_chat`;
CREATE TABLE `rv_chat` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `chtime` datetime default NULL,
  `nick` char(10) NOT NULL,
  `words` char(150) default NULL,
  `face` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_chat
-- ----------------------------
INSERT INTO `rv_chat` VALUES ('1', '2014-12-18 12:49:22', '123', 'hdasjkh', '1');
INSERT INTO `rv_chat` VALUES ('2', '2014-12-18 12:49:22', '123', 'hdasjkh', '1');
INSERT INTO `rv_chat` VALUES ('3', '2014-12-18 12:49:23', '123', 'hdasjkh', '1');
INSERT INTO `rv_chat` VALUES ('4', '2014-12-18 12:49:23', '123', 'hdasjkh', '1');
INSERT INTO `rv_chat` VALUES ('5', '2014-12-18 12:49:24', '123', 'hdasjkh', '1');
INSERT INTO `rv_chat` VALUES ('6', '2014-12-18 12:49:31', '789', 'hdasjkh', '1');
INSERT INTO `rv_chat` VALUES ('7', '2014-12-18 12:49:31', '789', 'hdasjkh', '1');
INSERT INTO `rv_chat` VALUES ('8', '2014-12-18 12:49:32', '789', 'hdasjkh', '1');
INSERT INTO `rv_chat` VALUES ('9', '2014-12-18 12:49:35', '789', 'hdasjkh', '2');
INSERT INTO `rv_chat` VALUES ('10', '2014-12-18 12:49:35', '789', 'hdasjkh', '2');
INSERT INTO `rv_chat` VALUES ('11', '2014-12-18 12:49:35', '789', 'hdasjkh', '2');
INSERT INTO `rv_chat` VALUES ('12', '2014-12-18 12:49:45', '789', 'hdasjkh', '4');
INSERT INTO `rv_chat` VALUES ('13', '2014-12-18 12:49:46', '789', 'hdasjkh', '4');
INSERT INTO `rv_chat` VALUES ('14', '2014-12-18 12:49:46', '789', 'hdasjkh', '4');
INSERT INTO `rv_chat` VALUES ('15', '2014-12-18 12:50:31', '789', 'hdasjkh', '7');

-- ----------------------------
-- Table structure for `rv_city`
-- ----------------------------
DROP TABLE IF EXISTS `rv_city`;
CREATE TABLE `rv_city` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `city` varchar(20) NOT NULL COMMENT '城市',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_city
-- ----------------------------
INSERT INTO `rv_city` VALUES ('1', '太原市');
INSERT INTO `rv_city` VALUES ('2', '大同市');
INSERT INTO `rv_city` VALUES ('3', '阳泉市');
INSERT INTO `rv_city` VALUES ('4', '长治市');
INSERT INTO `rv_city` VALUES ('5', '晋城市');
INSERT INTO `rv_city` VALUES ('6', '朔州市');
INSERT INTO `rv_city` VALUES ('7', '晋中市');
INSERT INTO `rv_city` VALUES ('8', '运城市');
INSERT INTO `rv_city` VALUES ('9', '忻州市');
INSERT INTO `rv_city` VALUES ('10', '临汾市');
INSERT INTO `rv_city` VALUES ('11', '吕梁市');

-- ----------------------------
-- Table structure for `rv_client`
-- ----------------------------
DROP TABLE IF EXISTS `rv_client`;
CREATE TABLE `rv_client` (
  `id` int(11) NOT NULL auto_increment COMMENT '公司ID',
  `name` varchar(50) NOT NULL COMMENT '公司名称',
  `carNum` varchar(20) default NULL COMMENT '车号',
  `platform` varchar(50) NOT NULL COMMENT '平台名称',
  `carleixing` varchar(20) NOT NULL COMMENT '车辆类型',
  `beizhu` varchar(100) default NULL COMMENT '变动内容',
  `chuanNum` varchar(50) default NULL COMMENT 'SIM卡串号',
  `simNum` varchar(20) default NULL COMMENT 'SIM卡号',
  `simstate` varchar(20) default NULL COMMENT 'SIM卡状态',
  `changedate` varchar(50) default NULL COMMENT '变更日期',
  `installdate` varchar(50) default NULL COMMENT '安装日期',
  `zifei` varchar(20) default NULL COMMENT '资费',
  `zichangedate` varchar(50) default NULL COMMENT '资费变更日期',
  `chejiaNum` varchar(20) default NULL COMMENT '车架号',
  `yundate` varchar(50) default NULL COMMENT '运管审验日期',
  `yunNum` varchar(50) default NULL COMMENT '运管不干胶',
  `yunmoney` decimal(20,2) default NULL COMMENT '运管金额',
  `chedate` varchar(50) default NULL COMMENT '车管审验日期',
  `jiaojingNum` varchar(50) default NULL COMMENT '交警不干胶',
  `chemoney` decimal(20,2) default NULL COMMENT '车管金额',
  `money` decimal(20,2) default '0.00' COMMENT '总金额',
  `fuwufei` decimal(20,2) default NULL COMMENT '每年需交的服务费',
  `fwjzdate` varchar(50) default NULL COMMENT '服务费交至日期',
  `zhengdate` varchar(50) default NULL COMMENT '行车证审验日期',
  `carstateId` int(11) default NULL COMMENT '车辆类型',
  `danhao` varchar(20) default NULL COMMENT '业务单号（合同编号）',
  `zhongduanNum` varchar(20) default NULL COMMENT '终端编号',
  `fangweiNum` varchar(20) default NULL COMMENT '防伪标记',
  `model` varchar(20) default NULL COMMENT '型号',
  `xianlu` varchar(20) default NULL COMMENT '线路',
  `linkname` varchar(20) NOT NULL COMMENT '联系人',
  `tel` varchar(20) NOT NULL COMMENT '联系电话',
  `zidai` int(5) default NULL COMMENT '断判是否为出厂自带设备，1为出厂自带',
  `deviceName` varchar(50) default NULL COMMENT '设备名称',
  `factory` varchar(50) default NULL COMMENT '设备厂家',
  `devicemoney` decimal(20,2) default NULL COMMENT '设备金额',
  `installperson` varchar(50) default NULL COMMENT '安装人员',
  `biaoshi` int(5) default NULL COMMENT '标识',
  `chaidate` varchar(50) default NULL COMMENT '备机安装日期',
  `beichaidate` varchar(50) default NULL COMMENT '备机拆取日期',
  `beibeizhu` varchar(100) default NULL COMMENT '备机备注',
  `terminalchaidate` varchar(50) default NULL COMMENT '终端拆取日期',
  `terminalandate` varchar(50) default NULL COMMENT '终端安装日期',
  `fenqi` varchar(10) NOT NULL COMMENT '是否分期付款',
  `doubledevice` varchar(10) NOT NULL COMMENT '是否属于双设备',
  `zhuanfa` varchar(10) default NULL COMMENT '是否属于转发车辆',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`),
  KEY `31` (`carNum`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_client
-- ----------------------------
INSERT INTO `rv_client` VALUES ('1', '等哈就好', '1424', '', '客车', null, null, '12345441', '0', null, '2014-09-10', '5', null, '24254', '2014-10-13', null, '-500.00', '2014-10-09', null, '400.00', null, '980.00', '', '2014-09-04', '1', '5454', null, null, '45454', '', '张三', '15236253698', '2', null, '东运', null, null, null, null, null, null, null, null, '', '', null, '冀东启明科技有限公司');
INSERT INTO `rv_client` VALUES ('2', 'gf', '11124', '', '校车', null, null, '14258652365', '0', '2014-10-08', '2014-09-09', '5', null, '7656', '2014-10-11', null, '980.00', '2014-10-11', null, '100.00', null, '980.00', '', '2014-09-01', '1', '21', null, null, 'dsa', '太原——临汾', '李四', '15236236523', '2', null, '国脉', null, null, null, null, null, null, null, null, '', '', null, '冀东启明科技有限公司');
INSERT INTO `rv_client` VALUES ('3', '太原运输局', '晋A45123', '', '客车', null, null, null, null, null, null, null, null, '45522125455525', null, null, null, null, null, null, null, '980.00', null, '2014-10-01', '2', null, null, null, null, '太原——忻州', '王五', '15236235623', '1', null, null, null, null, null, null, null, null, null, null, '', '', null, '冀东启明科技有限公司');
INSERT INTO `rv_client` VALUES ('4', '太原运输局', '晋A789545', '', '县乡', null, null, '152658975890', '0', '0000-00-00', '2014-10-01', '5元', null, '123455666', '2014-10-10', null, '544.00', '2014-10-10', null, '1444.00', null, '981.00', '', '2014-09-28', '2', '143654', null, null, 'JK451', '太原——阳泉', '周', '14256235623', '2', null, '深圳', null, null, null, null, null, null, null, null, '', '', null, '冀东启明科技有限公司');
INSERT INTO `rv_client` VALUES ('6', '太原运输公司', '晋A47589', '', '客车', null, null, '1542623562555', '0', '0000-00-00', null, '5元', null, 'HJ45765656', '2014-10-13', null, '180.00', '2014-10-13', null, '800.00', '-100.00', '980.00', '', '2014-10-07', '6', null, null, null, null, '太原——临汾', '胡', '15262536235', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('7', '忻州运输公司', '晋H451265', '', '货车', null, null, null, null, null, null, null, null, 'hj455645454', '2014-10-13', null, '100.00', '2014-10-13', null, '200.00', '-100.00', '980.00', '', '2014-10-01', '6', null, null, null, null, '忻州——阳泉', '周黑', '123554444', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('8', '忻州运输公司', '晋H78787', '', '县乡', null, null, null, null, null, null, null, null, '454756456', '2014-10-13', null, '-200.00', null, null, null, '-200.00', '980.00', '', '2014-10-13', '6', null, null, null, null, '太原——广州', '杰克', '1526355255', '1', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('9', '忻运', '4524', '', '客车', null, null, null, null, null, null, null, null, '4587', '2014-10-13', null, '-300.00', null, null, null, '-300.00', '980.00', '', '2014-10-14', '6', null, null, null, null, '', '发', '74687', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('10', 'gfd ', '1235', '', '校车', null, null, null, null, null, null, null, null, '4534', '2014-10-13', null, '500.00', '2014-10-13', null, '200.00', null, '980.00', '', '2014-10-07', '1', null, null, null, null, '', '十大', '4534368', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '冀东启明科技有限公司');
INSERT INTO `rv_client` VALUES ('11', 'gjhjg', '123', '', '货车', null, null, null, null, null, null, null, null, '6546', '2014-10-13', null, '-300.00', null, null, null, '-300.00', '980.00', '', '2014-10-01', '6', null, null, null, null, '老考', '看见', '6546', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('12', '空调', '147', '', '校车', null, null, null, null, null, null, null, null, '45646', '2014-10-13', null, '-100.00', null, null, null, '-100.00', '980.00', '', '2014-10-01', '6', null, null, null, null, '', '都是', '45645', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('13', '打', '456', '', '客车', null, null, null, null, null, null, null, null, '4568', null, null, null, null, null, null, null, '980.00', null, '0000-00-00', '6', null, null, null, null, '', '饿啊我', '5468768', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('15', '刚好发的', '258', '', '客车', null, null, null, null, null, null, null, null, '1564', null, null, null, '2014-10-13', null, '160.00', '160.00', '980.00', '', '0000-00-00', '6', null, null, null, null, '', '打', '545', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('16', '规定', '369', '', '县乡', null, null, null, null, null, null, null, null, '524', '2014-10-13', null, '600.00', '2014-10-13', null, '200.00', '800.00', '980.00', '', '0000-00-00', '6', null, null, null, null, '', '不能把', '445546', '2', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('17', '几乎覆盖', '741', '', '客车', null, null, null, null, null, null, null, null, '774568', '2014-10-13', null, '800.00', '2014-10-13', null, '100.00', '900.00', '980.00', '', '0000-00-00', '6', null, null, null, null, '', '发', '4245', '1', null, null, null, null, null, null, null, null, null, null, '', '', null, '太原科技有限公司');
INSERT INTO `rv_client` VALUES ('18', '忻州运输公司', 'H12345', '', '长途客车', '关于韩国韩国', null, '12562356245', '正常', '2014-10-14', '2014-10-14', '11', null, 'JKLJ1236598977', '2014-10-14', null, '960.00', '2014-10-14', null, '0.00', '960.00', '960.00', '', '2004-05-01', '13', '20141012', null, null, 'CA-8B', '忻州----五台', '张三', '18603504622', '2', null, '深圳市国脉', null, null, null, '2014-10-08', null, '已安装备机', '2014-08-20', '2014-10-29', '', '', null, '冀东启明');
INSERT INTO `rv_client` VALUES ('19', '利达', 'H123', '', '县乡', '更好呵呵', null, '15454', '正常', '0000-00-00', null, '5', '2014-10-01', 'JKL1233654', '2014-10-20', null, '120.00', '2014-10-14', null, '720.00', '840.00', '720.00', '', '2014-10-14', '11', null, null, null, null, '忻州--太原', '小王', '18635162311', '1', null, null, null, null, null, null, null, null, '2014-10-08', '2014-10-29', '', '', null, '冀东启明');
INSERT INTO `rv_client` VALUES ('20', '忻州运输公司', 'H54321', '', '长途客车', '你今年', null, '152623562356', '正常', '2014-10-16', null, '5', '0000-00-00', 'HJKG11111111', null, null, null, null, null, null, null, '960.00', null, '2014-10-14', '11', null, null, null, null, '忻州--五台', '张三', '18603504622', '2', null, null, null, null, null, null, '2014-10-30', '已拆取备机', '2014-10-14', '2014-10-01', '', '', null, '冀东启明');
INSERT INTO `rv_client` VALUES ('22', '太原运输公司', '晋45612', '1号平台', '县级客车', null, null, '18459685745', '正常', '2014-11-06', '2014-10-08', '5', '', 'jk4512456632256', '2014-10-23', null, '200.00', '2014-10-23', null, '800.00', '1000.00', '760.00', '', '4月，12月', '15', '5434335', null, null, 'RMT', '太原---五台', '小周', '15623564897', '1', '汽车行驶记录仪', '深圳东运科技有限公司', '100.00', null, null, '', '2014-10-23', '', '2014-10-06', '2014-10-28', '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('23', '刚好回家', '456', '1号平台', '客车', null, null, null, null, null, null, null, null, '14526325623489526', null, null, null, null, null, null, null, '0.00', null, '1', '15', null, null, null, null, '', '分', '156256844', '1', null, null, null, null, null, null, null, null, '2014-10-14', '', '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('24', '公分', '126', '1号平台', '不过V', null, null, null, null, null, null, null, null, '145265235623589564', null, null, null, null, null, null, null, '0.00', null, '4', '15', null, null, null, null, '', '高富帅', '54456', '1', null, null, null, null, null, null, null, null, '2014-07-03', '2014-09-10', '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('25', '公分', '12644', '1号平台', '不过V', null, null, '15263256235', '正常', null, '', '5', null, '', null, null, null, null, null, null, null, '0.00', null, '4', '15', '', null, null, 'JGN', '', '高富帅', '54456', '1', '摄像头', '国脉畅行信息科技有限公司', '444.00', null, null, null, null, null, null, null, '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('26', '忻州运输公司', '晋K852', '1号平台', '客车', null, null, '18475262356', '报停', '2014-11-03', '', '5', '2014-11-13', 'jk458546545548956', null, null, null, null, null, null, null, '980.00', null, '1月，8月', '15', '', null, null, 'JGN', '忻州——五台', '小张', '1245455', '2', '摄像头', '国脉畅行信息科技有限公司', '120.00', null, null, null, null, null, null, null, '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('27', '忻州', '753', '1号平台', '货车', null, null, null, null, null, '', null, null, 'jk152632562548745', '2014-10-30', null, '200.00', '2014-11-03', null, '300.00', '512.00', '820.00', '2015-6-03', '1', '15', '', null, null, 'JGN', '', '和规范的', '65465', '2', '摄像头', '国脉畅行信息科技有限公司', '12.00', null, null, null, null, null, null, null, '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('28', '太原运输公司', '123', '2号平台', '货车', null, null, null, null, null, '2014-10-02', null, null, 'jh451263526325698', null, null, null, null, null, null, null, '750.00', null, '47', '15', '58686', null, null, 'JGN', '发', '发点', '4546589', '1', '摄像头', '国脉畅行信息科技有限公司', '0.00', null, null, null, null, null, null, null, '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('29', '太原', '789', '1号平台', '客车', null, null, null, null, null, '', null, null, 'hj451226698555558', '2014-10-30', null, '2.00', '2014-10-30', null, '800.00', '802.00', '980.00', '2015-7-30', '', '15', '', null, null, 'JGN', '', '好几个', '45454', '1', '摄像头', '国脉畅行信息科技有限公司', '3.00', null, null, null, null, null, null, null, '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('30', '而是在V', '147', '1号平台', '客车', null, null, null, null, null, '2014-11-05', null, null, 'kj451262532599874', '2014-10-30', null, '200.00', null, null, null, '257.00', '980.00', '2014-12-30', '', '15', '', null, null, 'JGN', '', '6U盾太原', '6344', '1', '摄像头', '国脉畅行信息科技有限公司', '65.00', '换一台', null, null, null, null, null, null, '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('31', '不回家', '963', '2号平台', '货车', null, null, null, null, null, '2014-10-14', null, null, 'hj451258595685232', '2014-10-30', null, '100.00', '2014-11-07', null, '111.00', '217.00', '800.00', '2015-2-07', '4', '15', '546', null, null, 'JGN', '特搜部', '个人同时', '534653653', '1', '摄像头', '国脉畅行信息科技有限公司', '6.00', null, null, null, null, null, null, null, '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('32', '打', '852', '2号平台', '长途客车', null, null, null, null, null, null, null, null, 'hj451263524141525', null, null, null, null, null, null, '0.00', '980.00', null, '1', '15', null, null, null, null, '广泛的', '规定', '542', '1', null, null, null, null, null, null, null, null, null, null, '', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('33', 'dfs', '742', '冀东启明车联网平台', '长途客车', null, null, null, null, null, null, null, null, 'hg152365234562314', null, null, null, null, null, null, '0.00', '980.00', null, '1', '15', null, null, null, null, '', 'ngv', '31534563643', null, null, null, null, null, null, null, null, null, null, null, '是', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('34', 'gfds', '369', '4号平台', '县际客车', null, null, null, null, null, null, null, null, 'gfgfsd48521152452', null, null, null, null, null, null, '0.00', '780.00', null, '4', '15', null, null, null, null, '', 'gfs', '536654', null, null, null, null, null, null, null, null, null, null, null, '是', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('35', 'aaa', '999', '冀东启明车联网平台', '校车', '由258转户过来', null, '18645952352', '复话', '2014-11-13', '', '8', '2014-11-14', 'fd154543543543152', '2014-11-06', null, '800.00', '2014-11-06', null, '500.00', '1301.00', '987.00', '2016-2-06', '', '15', '', null, null, 'JGN', '', '三', '123525252', null, '摄像头', '国脉畅行信息科技有限公司', '1.00', '小网', null, null, null, null, null, null, '是', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('36', '呃啊', '555', '2号平台', '长途货车', null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, '0.00', '0.00', null, '', '15', null, null, null, null, '', '放到', '54325', null, null, null, null, null, null, null, null, null, null, null, '是', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('37', '范德萨', '444', '1号平台', '长途货车', null, null, null, null, null, null, null, null, 'fdsf', '2014-11-12', null, '123.00', '2014-11-12', null, '520.00', '643.00', '0.00', '2014-11-12', '', '15', null, null, null, null, '', '出现在', '5435', null, null, null, null, null, null, null, null, null, null, null, '否', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('38', 'ur', '678', '2号平台', '长途客车', null, null, null, null, null, '2014-11-05', null, null, '', '2014-11-07', null, '300.00', '2014-11-07', null, '222.00', '609.00', '0.00', '2014-11-07', '', '15', '', null, null, 'JGN', '', 'gj', '76', null, '摄像头', '国脉畅行信息科技有限公司', '87.00', 'ui', null, null, null, null, null, null, '是', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('39', '忻州运输公司', '晋H78452', '2号平台', '长途客车', null, null, null, null, null, '2014-11-14', null, null, 'jkdf4512352632541', '2014-12-01', null, '123.00', '2014-12-01', null, '152.00', '989.00', '800.00', '2015-3-01', '1,5', '15', '', null, null, 'JGN', '忻州——五台', '小王', '645656', null, '摄像头', '国脉畅行信息科技有限公司', '789.00', '李四', null, null, null, null, null, null, '是', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('40', '忻州运输公司', '晋H45263', '1号平台', '长途客车', null, null, null, null, null, '', null, null, 'ghkdgsh4512523652', '2014-11-28', null, '123.00', null, null, null, '345.00', '960.00', '2014-12-28', '11,3', '15', '', null, null, 'JGN', '忻州——五台', '小王', '14523652358', null, '摄像头', '国脉畅行信息科技有限公司', '222.00', '789', null, null, null, null, null, null, '否', '是', null, '启明科技');
INSERT INTO `rv_client` VALUES ('41', '忻州运输公司', '晋H45263', '1号平台', '长途客车', null, null, null, null, null, '2014-11-04', null, null, 'ghkdgsh4512523652', '2014-11-28', null, '123.00', null, null, null, '123.00', '980.00', '2014-12-28', '11,3', '15', '', null, null, 'JGN', '', '小王', '14523652358', null, '摄像头', '国脉畅行信息科技有限公司', '999.00', '很贵', null, null, null, null, null, null, '否', '是', null, '启明科技');
INSERT INTO `rv_client` VALUES ('42', '祥龙公司', '晋H12312', '冀东启明车联网平台', '长途客车', null, null, null, null, null, null, null, null, 'fdsa1111111111111', '2014-12-08', null, '500.00', null, null, null, '500.00', '720.00', '2015-8-08', '8', '15', null, null, null, null, '太原——五台', '张三', '10000000000', null, null, null, null, null, null, null, null, null, null, null, '否', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('43', '祥龙公司', '晋H12312(2G)', '冀东启明车联网平台', '长途客车', null, null, '15241241241', '正常', null, '2014-12-10', '10元', null, 'fdsa1111111111111', null, null, null, '2014-12-09', null, '260.00', '260.00', '720.00', '2015-4-09', '8', '15', '1457858', null, null, 'JGN', '太原——五台', '张三', '10000000000', null, '摄像头', '国脉畅行信息科技有限公司', '800.00', 'V规范', null, null, null, null, null, null, '否', '', null, '启明科技');
INSERT INTO `rv_client` VALUES ('44', '祥龙公司', '晋H11111', '1号平台', '长途客车', null, null, null, null, null, null, null, null, 'ds121212121212121', null, null, null, null, null, null, '0.00', '720.00', null, '5', '15', null, null, null, null, '分', '小王', '12121212121', null, null, null, null, null, null, null, null, null, null, null, '否', '否', null, '启明科技');
INSERT INTO `rv_client` VALUES ('45', '祥龙公司', '晋H45124', '冀东启明车联网平台', '长途客车', null, null, null, null, null, null, null, null, 'ds121212121212121', null, null, null, null, null, null, '0.00', '720.00', null, '5', '15', null, null, null, null, '', '放到', '15245555555', null, null, null, null, null, null, null, null, null, null, null, '否', '否', null, '启明科技');
INSERT INTO `rv_client` VALUES ('46', '祥龙公司', '晋H784515(2G)', '冀东启明车联网平台', '长途客车', null, null, null, null, null, null, null, null, 'LFWSRXPJ9B1E09446', null, null, null, null, null, null, '0.00', '720.00', null, '8', '15', null, null, null, null, '繁峙--大同', '王应和', '13294616693', null, null, null, null, null, null, null, null, null, null, null, '否', '是', null, '启明科技');
INSERT INTO `rv_client` VALUES ('47', '祥龙公司', '晋H784515(3G)', '冀东启明车联网平台', '长途客车', null, null, null, null, null, null, null, null, 'LFWSRXPJ9B1E09446', null, null, null, null, null, null, '0.00', '720.00', null, '8', '15', null, null, null, null, '繁峙--大同', '王应和', '13294616693', null, null, null, null, null, null, null, null, null, null, null, '否', '是', null, '启明科技');
INSERT INTO `rv_client` VALUES ('48', '祥龙公司', '晋H45124', '1号平台', '长途客车', null, null, null, null, null, null, null, null, 'mhb11111111111111', null, null, null, null, null, null, '0.00', '720.00', null, '5', '15', null, null, null, null, '改行', '结果', '12121212121', null, null, null, null, null, null, null, null, null, null, null, '否', '否', '否', '启明科技');

-- ----------------------------
-- Table structure for `rv_company`
-- ----------------------------
DROP TABLE IF EXISTS `rv_company`;
CREATE TABLE `rv_company` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `company` varchar(100) NOT NULL COMMENT '公司名称',
  `company1` varchar(100) NOT NULL COMMENT '分公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_company
-- ----------------------------
INSERT INTO `rv_company` VALUES ('1', '祥龙公司', '启明科技');

-- ----------------------------
-- Table structure for `rv_county`
-- ----------------------------
DROP TABLE IF EXISTS `rv_county`;
CREATE TABLE `rv_county` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `county` varchar(50) NOT NULL COMMENT '县',
  `cityId` int(11) NOT NULL COMMENT '城市ID外键',
  PRIMARY KEY  (`id`),
  KEY `county` (`cityId`),
  CONSTRAINT `county` FOREIGN KEY (`cityId`) REFERENCES `rv_city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_county
-- ----------------------------
INSERT INTO `rv_county` VALUES ('1', '小店区', '1');
INSERT INTO `rv_county` VALUES ('2', '迎泽区', '1');
INSERT INTO `rv_county` VALUES ('3', '杏花岭区', '1');
INSERT INTO `rv_county` VALUES ('4', '尖草坪区', '1');
INSERT INTO `rv_county` VALUES ('5', '万柏林区', '1');
INSERT INTO `rv_county` VALUES ('6', '晋源区', '1');
INSERT INTO `rv_county` VALUES ('7', '清徐县', '1');
INSERT INTO `rv_county` VALUES ('8', '阳曲县', '1');
INSERT INTO `rv_county` VALUES ('9', '娄烦县', '1');
INSERT INTO `rv_county` VALUES ('10', '古交市', '1');
INSERT INTO `rv_county` VALUES ('11', '城区', '2');
INSERT INTO `rv_county` VALUES ('12', '矿区', '2');
INSERT INTO `rv_county` VALUES ('13', '南郊区', '2');
INSERT INTO `rv_county` VALUES ('14', '新荣区', '2');
INSERT INTO `rv_county` VALUES ('15', '阳高县', '2');
INSERT INTO `rv_county` VALUES ('16', '天镇县', '2');
INSERT INTO `rv_county` VALUES ('17', '广灵县', '2');
INSERT INTO `rv_county` VALUES ('18', '灵丘县', '2');
INSERT INTO `rv_county` VALUES ('19', '浑源县', '2');
INSERT INTO `rv_county` VALUES ('20', '左云县', '2');
INSERT INTO `rv_county` VALUES ('21', '大同县', '2');
INSERT INTO `rv_county` VALUES ('22', '城区', '3');
INSERT INTO `rv_county` VALUES ('23', '矿区', '3');
INSERT INTO `rv_county` VALUES ('24', '郊区', '3');
INSERT INTO `rv_county` VALUES ('25', '平定县', '3');
INSERT INTO `rv_county` VALUES ('26', '盂县', '3');
INSERT INTO `rv_county` VALUES ('27', '城区', '4');
INSERT INTO `rv_county` VALUES ('28', '郊区', '4');
INSERT INTO `rv_county` VALUES ('29', '长治县', '4');
INSERT INTO `rv_county` VALUES ('30', '襄垣县', '4');
INSERT INTO `rv_county` VALUES ('31', '屯留县', '4');
INSERT INTO `rv_county` VALUES ('32', '平顺县', '4');
INSERT INTO `rv_county` VALUES ('33', '黎城县', '4');
INSERT INTO `rv_county` VALUES ('34', '壶关县', '4');
INSERT INTO `rv_county` VALUES ('35', '长子县', '4');
INSERT INTO `rv_county` VALUES ('36', '武乡县', '4');
INSERT INTO `rv_county` VALUES ('37', '沁县', '4');
INSERT INTO `rv_county` VALUES ('38', '沁源县', '4');
INSERT INTO `rv_county` VALUES ('39', '潞城市', '4');
INSERT INTO `rv_county` VALUES ('40', '城区', '5');
INSERT INTO `rv_county` VALUES ('41', '沁水县', '5');
INSERT INTO `rv_county` VALUES ('42', '阳城县', '5');
INSERT INTO `rv_county` VALUES ('43', '陵川县', '5');
INSERT INTO `rv_county` VALUES ('44', '泽州县', '5');
INSERT INTO `rv_county` VALUES ('45', '高平市', '5');
INSERT INTO `rv_county` VALUES ('46', '朔城区', '6');
INSERT INTO `rv_county` VALUES ('47', '平鲁区', '6');
INSERT INTO `rv_county` VALUES ('48', '山阴县', '6');
INSERT INTO `rv_county` VALUES ('49', '应县', '6');
INSERT INTO `rv_county` VALUES ('50', '右玉县', '6');
INSERT INTO `rv_county` VALUES ('51', '怀仁县', '6');
INSERT INTO `rv_county` VALUES ('52', '榆次区', '7');
INSERT INTO `rv_county` VALUES ('53', '榆社县', '7');
INSERT INTO `rv_county` VALUES ('54', '左权县', '7');
INSERT INTO `rv_county` VALUES ('55', '和顺县', '7');
INSERT INTO `rv_county` VALUES ('56', '昔阳县', '7');
INSERT INTO `rv_county` VALUES ('57', '寿阳县', '7');
INSERT INTO `rv_county` VALUES ('58', '太谷县', '7');
INSERT INTO `rv_county` VALUES ('59', '祁县', '7');
INSERT INTO `rv_county` VALUES ('60', '平遥县', '7');
INSERT INTO `rv_county` VALUES ('61', '灵石县', '7');
INSERT INTO `rv_county` VALUES ('62', '介休市', '7');
INSERT INTO `rv_county` VALUES ('63', '盐湖区', '8');
INSERT INTO `rv_county` VALUES ('64', '临猗县', '8');
INSERT INTO `rv_county` VALUES ('65', '万荣县', '8');
INSERT INTO `rv_county` VALUES ('66', '闻喜县', '8');
INSERT INTO `rv_county` VALUES ('67', '稷山县', '8');
INSERT INTO `rv_county` VALUES ('68', '新绛县', '8');
INSERT INTO `rv_county` VALUES ('69', '绛县', '8');
INSERT INTO `rv_county` VALUES ('70', '垣曲县', '8');
INSERT INTO `rv_county` VALUES ('71', '夏县', '8');
INSERT INTO `rv_county` VALUES ('72', '平陆县', '8');
INSERT INTO `rv_county` VALUES ('73', '芮城县', '8');
INSERT INTO `rv_county` VALUES ('74', '永济市', '8');
INSERT INTO `rv_county` VALUES ('75', '河津市', '8');
INSERT INTO `rv_county` VALUES ('76', '忻府区', '9');
INSERT INTO `rv_county` VALUES ('77', '定襄县', '9');
INSERT INTO `rv_county` VALUES ('78', '五台县', '9');
INSERT INTO `rv_county` VALUES ('79', '代县', '9');
INSERT INTO `rv_county` VALUES ('80', '繁峙县', '9');
INSERT INTO `rv_county` VALUES ('81', '宁武县', '9');
INSERT INTO `rv_county` VALUES ('82', '静乐县', '9');
INSERT INTO `rv_county` VALUES ('83', '神池县', '9');
INSERT INTO `rv_county` VALUES ('84', '五寨县', '9');
INSERT INTO `rv_county` VALUES ('85', '岢岚县', '9');
INSERT INTO `rv_county` VALUES ('86', '河曲县', '9');
INSERT INTO `rv_county` VALUES ('87', '保德县', '9');
INSERT INTO `rv_county` VALUES ('88', '偏关县', '9');
INSERT INTO `rv_county` VALUES ('89', '原平市', '9');
INSERT INTO `rv_county` VALUES ('90', '尧都区', '10');
INSERT INTO `rv_county` VALUES ('91', '曲沃县', '10');
INSERT INTO `rv_county` VALUES ('92', '冀城县', '10');
INSERT INTO `rv_county` VALUES ('93', '襄汾县', '10');
INSERT INTO `rv_county` VALUES ('94', '洪桐县', '10');
INSERT INTO `rv_county` VALUES ('95', '古县', '10');
INSERT INTO `rv_county` VALUES ('96', '安泽县', '10');
INSERT INTO `rv_county` VALUES ('97', '浮山县', '10');
INSERT INTO `rv_county` VALUES ('98', '吉县', '10');
INSERT INTO `rv_county` VALUES ('99', '乡宁县', '10');
INSERT INTO `rv_county` VALUES ('100', '大宁县', '10');
INSERT INTO `rv_county` VALUES ('101', '永和县', '10');
INSERT INTO `rv_county` VALUES ('102', '蒲县', '10');
INSERT INTO `rv_county` VALUES ('103', '汾西县', '10');
INSERT INTO `rv_county` VALUES ('104', '侯马市', '10');
INSERT INTO `rv_county` VALUES ('105', '霍州市', '10');
INSERT INTO `rv_county` VALUES ('106', '离石区', '11');
INSERT INTO `rv_county` VALUES ('107', '文水县', '11');
INSERT INTO `rv_county` VALUES ('108', '兴县', '11');
INSERT INTO `rv_county` VALUES ('109', '临县', '11');
INSERT INTO `rv_county` VALUES ('110', '柳林县', '11');
INSERT INTO `rv_county` VALUES ('111', '石楼县', '11');
INSERT INTO `rv_county` VALUES ('112', '岚县', '11');
INSERT INTO `rv_county` VALUES ('113', '方山县', '11');
INSERT INTO `rv_county` VALUES ('114', '中阳县', '11');
INSERT INTO `rv_county` VALUES ('115', '交口县', '11');
INSERT INTO `rv_county` VALUES ('116', '孝义市', '11');
INSERT INTO `rv_county` VALUES ('117', '汾阳市', '11');
INSERT INTO `rv_county` VALUES ('118', '交城县', '11');
INSERT INTO `rv_county` VALUES ('119', '隰县', '10');

-- ----------------------------
-- Table structure for `rv_dengji`
-- ----------------------------
DROP TABLE IF EXISTS `rv_dengji`;
CREATE TABLE `rv_dengji` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  `dengji` int(10) NOT NULL COMMENT '等级',
  `one` int(10) default NULL COMMENT '一级',
  `two` int(10) default NULL COMMENT '二级',
  `three` int(10) default NULL COMMENT '三级',
  `four` int(10) default NULL COMMENT '四级',
  `five` int(10) default NULL COMMENT '五级',
  `city` varchar(50) default NULL COMMENT '市区',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_dengji
-- ----------------------------
INSERT INTO `rv_dengji` VALUES ('1', '冀东启明', '1', '1', null, null, null, null, '太原市');
INSERT INTO `rv_dengji` VALUES ('4', '456', '2', '1', '1', '0', '0', '0', '太原市');
INSERT INTO `rv_dengji` VALUES ('5', '三级公司', '3', '1', '1', '1', '0', '0', '太原市');
INSERT INTO `rv_dengji` VALUES ('6', '三级公司2', '3', '1', '1', '2', '0', '0', '太原市');
INSERT INTO `rv_dengji` VALUES ('7', '启明科技', '2', '1', '2', '0', '0', '0', '太原市');
INSERT INTO `rv_dengji` VALUES ('8', 'yrt', '2', '1', '3', '0', '0', '0', '太原市');
INSERT INTO `rv_dengji` VALUES ('9', '4444', '2', '1', '4', '0', '0', '0', '太原市');

-- ----------------------------
-- Table structure for `rv_detail`
-- ----------------------------
DROP TABLE IF EXISTS `rv_detail`;
CREATE TABLE `rv_detail` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `productId` int(11) NOT NULL COMMENT '商品ID',
  `model` varchar(11) default NULL COMMENT '商品型号',
  `supplierId` int(11) default NULL COMMENT '供应商ID',
  `roomId` int(11) NOT NULL COMMENT '库房ID',
  `curruquantity` int(11) default '0' COMMENT '本月入库数量',
  `curchuquantity` int(11) default '0' COMMENT '本月出库数量',
  `shouquantity` int(11) default '0' COMMENT '出库收款数量',
  `kucun` int(11) NOT NULL,
  `beizhu` varchar(80) default NULL COMMENT '备注',
  `inputer` varchar(10) default NULL COMMENT '操作者',
  `date` varchar(20) NOT NULL COMMENT '日期',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_detail
-- ----------------------------
INSERT INTO `rv_detail` VALUES ('205', '5', '32G', '1', '1', '15', '5', '5', '10', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('206', '5', '32G', '1', '27', '11', '11', '11', '0', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('211', '5', '32G', '2', '27', '0', '115', '10', '142', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('212', '5', '32G', '2', '1', '25', '2', '1', '41', 'jjj', 'admin', '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('214', '5', '16G', '2', '1', '4', '1', '11', '0', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('217', '5', '16G', '2', '27', '0', '2', '0', '0', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('221', '5', '32G', '1', '30', '0', '4', '4', '1', '12344', 'admin', '2014-8', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('223', '5', '16G', '1', '1', '10', '8', '5', '12', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('224', '5', '32G', '1', '30', '0', '1', '0', '1', '321', 'admin', '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('225', '5', '16G', '1', '30', '2', '0', '0', '2', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('226', '5', '16G', '1', '27', '1', '0', '0', '1', '仨', 'admin', '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('233', '5', '32G', '2', '0', '40', '20', '0', '70', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('236', '5', '32G', '2', '30', '0', '1', '0', '1', null, null, '2014-9', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('239', '5', '32G', '2', '1', '0', '4', '4', '41', 'yyy', 'admin', '2014-10', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('241', '5', '16G', '1', '27', '0', '0', '0', '1', '天天', 'test2', '2014-10', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('254', '5', '16G', '1', '30', '0', '0', '0', '2', '15265', 'admin', '2014-10', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('260', '123', '', '0', '0', '0', '0', '0', '0', '99', 'admin', '2014-10', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('261', '5', '32G', '1', '1', '0', '0', '0', '10', 'jhku', 'admin', '2014-10', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('262', '5', '16G', '1', '1', '0', '0', '0', '12', 'hhhh', 'admin', '2014-10', '冀东启明科技有限公司');
INSERT INTO `rv_detail` VALUES ('269', '8', '500W', '8', '36', '15', '0', '0', '15', '风风火火回家', '于工', '2014-10', '太原科技有限公司');
INSERT INTO `rv_detail` VALUES ('270', '8', '500W', '8', '35', '10', '7', '2', '3', '刚回北京', '于工', '2014-10', '太原科技有限公司');
INSERT INTO `rv_detail` VALUES ('271', '11', 'VA-8B', '10', '37', '50', '1', '1', '49', null, null, '2014-10', '冀东启明');
INSERT INTO `rv_detail` VALUES ('272', '13', 'JGN', '11', '39', '15', '8', '6', '200', '桂花糕过', '李四', '2014-10', '启明科技');
INSERT INTO `rv_detail` VALUES ('274', '12', 'RMT', '12', '39', '1', '0', '0', '0', null, null, '2014-10', '启明科技');
INSERT INTO `rv_detail` VALUES ('275', '13', 'JGN', '11', '40', '3', '0', '0', '3', null, null, '2014-10', '启明科技');
INSERT INTO `rv_detail` VALUES ('276', '13', 'JGN', '11', '39', '202', '9', '9', '200', null, null, '2014-11', '启明科技');
INSERT INTO `rv_detail` VALUES ('277', '12', 'RMT', '12', '39', '0', '1', '1', '0', null, null, '2014-11', '启明科技');
INSERT INTO `rv_detail` VALUES ('278', '13', 'JGN', '11', '40', '1', '1', '0', '3', null, null, '2014-11', '启明科技');

-- ----------------------------
-- Table structure for `rv_device`
-- ----------------------------
DROP TABLE IF EXISTS `rv_device`;
CREATE TABLE `rv_device` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `carId` int(11) NOT NULL COMMENT '辆车ID',
  `name` varchar(50) NOT NULL COMMENT '设备名称',
  `factory` varchar(50) NOT NULL COMMENT '设备厂家',
  `model` varchar(60) NOT NULL COMMENT '设备型号',
  `roomId` int(11) NOT NULL COMMENT '库房名称',
  `money` decimal(20,2) default NULL COMMENT '设备金额',
  `installdate` varchar(20) default NULL COMMENT '安装日期',
  `installperson` varchar(50) NOT NULL COMMENT '安装人员',
  `danhao` varchar(40) NOT NULL COMMENT '业务单号（合同编号）',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`),
  KEY `33` (`carId`),
  CONSTRAINT `33` FOREIGN KEY (`carId`) REFERENCES `rv_car` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_device
-- ----------------------------
INSERT INTO `rv_device` VALUES ('1', '43', '摄像头', '国脉畅行信息科技有限公司', 'JGN', '39', '800.00', '2014-12-10', 'V规范', '1457858', '启明科技');

-- ----------------------------
-- Table structure for `rv_diaobo`
-- ----------------------------
DROP TABLE IF EXISTS `rv_diaobo`;
CREATE TABLE `rv_diaobo` (
  `id` int(11) NOT NULL auto_increment,
  `productId` int(11) NOT NULL,
  `model` varchar(11) NOT NULL COMMENT '型号',
  `supplierId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `roomruId` int(11) NOT NULL,
  `roomchuId` int(11) NOT NULL,
  `agreetime` varchar(20) default NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '时间',
  `inputer` varchar(20) NOT NULL,
  `stchuId` int(11) default NULL COMMENT '调出商品在出库表中的ID',
  `struId` int(11) default NULL COMMENT '调入商品在入库表中的ID',
  `person` varchar(20) default NULL COMMENT '负责人',
  `judge` int(5) NOT NULL COMMENT '1为录入人员操作，2为负责人确认',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_diaobo
-- ----------------------------
INSERT INTO `rv_diaobo` VALUES ('1', '5', '32G', '1', '10', '30', '1', null, '2014-09-29 10:37:02', 'admin', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('2', '5', '32G', '2', '5', '1', '27', null, '2014-09-29 11:40:58', 'admin', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('3', '5', '16G', '2', '4', '1', '27', null, '2014-09-29 11:46:09', 'admin', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('4', '5', '16G', '2', '2', '1', '27', null, '2014-09-29 11:49:50', 'admin', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('5', '5', '16G', '2', '1', '1', '27', null, '2014-09-29 12:03:47', 'admin', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('6', '5', '32G', '1', '1', '1', '30', null, '2014-09-29 15:09:48', 'admin', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('7', '5', '16G', '1', '1', '30', '1', null, '2014-09-29 15:32:25', 'admin', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('8', '5', '16G', '1', '1', '30', '1', null, '2014-09-29 15:33:57', 'admin', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('9', '5', '16G', '1', '1', '27', '1', null, '2014-09-29 16:25:55', 'admin', '23', null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('10', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 17:38:33', 'admin', '24', '169', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('11', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 17:41:17', 'admin', '25', '170', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('12', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 17:45:07', 'admin', '26', '171', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('13', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 17:48:11', 'admin', '27', '172', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('14', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 17:51:50', 'admin', '28', '173', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('15', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 18:03:38', 'admin', '29', '174', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('16', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 18:04:03', 'admin', '30', '175', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('17', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 18:04:04', 'admin', '31', '176', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('18', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 18:06:37', 'admin', '32', '177', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('19', '5', '32G', '2', '10', '1', '27', null, '2014-09-29 18:07:14', 'admin', '33', '178', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('20', '5', '32G', '2', '10', '1', '27', null, '2014-09-30 09:16:06', 'admin', '34', '179', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('21', '5', '32G', '2', '10', '1', '27', null, '2014-09-30 09:57:46', 'admin', '37', '180', null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_diaobo` VALUES ('22', '5', '32G', '2', '1', '30', '1', null, '2014-09-30 16:52:55', 'admin', '42', '183', '李四', '2', '启明科技');
INSERT INTO `rv_diaobo` VALUES ('23', '8', '500W', '8', '5', '36', '35', null, '2014-10-13 10:47:11', '于工', '46', '193', '李四', '2', '启明科技');
INSERT INTO `rv_diaobo` VALUES ('24', '13', 'JGN', '11', '1', '40', '39', null, '2014-10-29 15:16:47', '李四', '51', '206', '李四', '2', '启明科技');
INSERT INTO `rv_diaobo` VALUES ('25', '13', 'JGN', '11', '1', '40', '39', null, '2014-10-29 16:28:06', '李四', '52', '207', '李四', '2', '启明科技');
INSERT INTO `rv_diaobo` VALUES ('26', '13', 'JGN', '11', '1', '39', '40', null, '2014-11-20 13:50:53', '李四', '66', '210', '李四', '2', '启明科技');

-- ----------------------------
-- Table structure for `rv_doc`
-- ----------------------------
DROP TABLE IF EXISTS `rv_doc`;
CREATE TABLE `rv_doc` (
  `id` int(11) NOT NULL auto_increment COMMENT '文档ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `doctid` int(11) NOT NULL COMMENT '类型ID',
  `intro` text NOT NULL COMMENT '内容',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime default NULL COMMENT '更新日期',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_doc
-- ----------------------------
INSERT INTO `rv_doc` VALUES ('1', '冀东启明OA协同办公使用说明.', '18', '冀东启明OA协同办公使用说明..... <br />', '2014-06-27 14:40:32', '2014-07-16 23:42:10', '');

-- ----------------------------
-- Table structure for `rv_duizhang`
-- ----------------------------
DROP TABLE IF EXISTS `rv_duizhang`;
CREATE TABLE `rv_duizhang` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `company` varchar(50) NOT NULL COMMENT '公司名称',
  `huokuan` decimal(20,2) default '0.00' COMMENT '货款',
  `huikuan` decimal(20,2) default '0.00' COMMENT '回款',
  `date` timestamp NULL default NULL on update CURRENT_TIMESTAMP COMMENT '日期',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_duizhang
-- ----------------------------
INSERT INTO `rv_duizhang` VALUES ('1', '1', '7907.00', '80.00', '2014-08-27 11:36:25', '');
INSERT INTO `rv_duizhang` VALUES ('2', '3', '44.00', '611.00', '2014-08-21 16:46:54', '');
INSERT INTO `rv_duizhang` VALUES ('3', '4', '1849.00', '0.00', '2014-08-29 15:48:33', '');
INSERT INTO `rv_duizhang` VALUES ('4', '5', '4.00', '0.00', null, '');
INSERT INTO `rv_duizhang` VALUES ('5', '忻州运输公司', '15.00', '0.00', '2014-09-17 12:22:45', '');
INSERT INTO `rv_duizhang` VALUES ('6', '等哈就好', '7452.00', '0.00', '2014-10-08 11:12:32', '冀东启明科技有限公司');
INSERT INTO `rv_duizhang` VALUES ('7', '几乎覆盖', '400.00', '0.00', null, '太原科技有限公司');
INSERT INTO `rv_duizhang` VALUES ('8', '利达', '1500.00', '0.00', null, '冀东启明');
INSERT INTO `rv_duizhang` VALUES ('9', '不回家', '800.00', '0.00', null, '启明科技');

-- ----------------------------
-- Table structure for `rv_fee`
-- ----------------------------
DROP TABLE IF EXISTS `rv_fee`;
CREATE TABLE `rv_fee` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `carNum` varchar(12) NOT NULL COMMENT '车牌号',
  `feetypeId` int(11) NOT NULL COMMENT '费用类型ID',
  `money` decimal(20,2) NOT NULL,
  `inputer` varchar(20) NOT NULL COMMENT '操作者',
  `date` date NOT NULL COMMENT '日期',
  `financeName` varchar(50) default NULL COMMENT '核对人员名称',
  `feetime` varchar(20) default NULL COMMENT '添加虚拟费用时间',
  `checktime` varchar(20) default NULL COMMENT '核对时间',
  `judge` int(5) NOT NULL COMMENT '1：出纳核对，2：打印收据',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`),
  KEY `43` (`carNum`),
  KEY `44` (`feetypeId`),
  CONSTRAINT `44` FOREIGN KEY (`feetypeId`) REFERENCES `rv_feetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of rv_fee
-- ----------------------------
INSERT INTO `rv_fee` VALUES ('1', '1424', '1', '441.00', 'admin', '0000-00-00', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_fee` VALUES ('2', '1424', '2', '14.00', 'admin', '0000-00-00', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_fee` VALUES ('3', '1424', '5', '100.00', '郝', '0000-00-00', null, null, null, '0', '冀东启明科技有限公司');
INSERT INTO `rv_fee` VALUES ('4', '741', '8', '50.00', '于工', '0000-00-00', null, null, null, '0', '太原科技有限公司');
INSERT INTO `rv_fee` VALUES ('5', 'H12345', '13', '111.00', '小于', '0000-00-00', null, null, null, '0', '冀东启明');
INSERT INTO `rv_fee` VALUES ('6', '晋45612', '17', '10.00', '李四', '0000-00-00', '李四', null, null, '2', '启明科技');
INSERT INTO `rv_fee` VALUES ('7', '晋45612', '16', '100.00', '123', '0000-00-00', '李四', null, null, '2', '启明科技');
INSERT INTO `rv_fee` VALUES ('8', '678', '16', '500.00', '李四', '0000-00-00', '李四', '2014-11-07 09:46:31', '2014-11-07 09:50:44', '2', '启明科技');
INSERT INTO `rv_fee` VALUES ('9', '999', '17', '100.00', '李四', '0000-00-00', '李四', '2014-11-07 10:01:50', '2014-11-07 10:02:01', '2', '启明科技');
INSERT INTO `rv_fee` VALUES ('10', '999', '16', '20.00', '李四', '0000-00-00', '李四', '2014-11-07 10:04:38', '2014-11-07 10:04:49', '2', '启明科技');
INSERT INTO `rv_fee` VALUES ('11', '678', '16', '30.00', '李四', '0000-00-00', '李四', '2014-11-07 10:07:30', '2014-11-07 10:07:39', '2', '启明科技');

-- ----------------------------
-- Table structure for `rv_feetype`
-- ----------------------------
DROP TABLE IF EXISTS `rv_feetype`;
CREATE TABLE `rv_feetype` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL COMMENT '费用名称',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_feetype
-- ----------------------------
INSERT INTO `rv_feetype` VALUES ('1', '检修费', '冀东启明科技有限公司');
INSERT INTO `rv_feetype` VALUES ('2', '卡费', '冀东启明科技有限公司');
INSERT INTO `rv_feetype` VALUES ('3', '超费', '冀东启明科技有限公司');
INSERT INTO `rv_feetype` VALUES ('4', '平台费', '冀东启明科技有限公司');
INSERT INTO `rv_feetype` VALUES ('5', '押金', '冀东启明科技有限公司');
INSERT INTO `rv_feetype` VALUES ('6', '退款', '冀东启明科技有限公司');
INSERT INTO `rv_feetype` VALUES ('7', '其他', '冀东启明科技有限公司');
INSERT INTO `rv_feetype` VALUES ('8', '检修费', '太原科技有限公司');
INSERT INTO `rv_feetype` VALUES ('9', '卡费', '太原科技有限公司');
INSERT INTO `rv_feetype` VALUES ('10', '超费', '太原科技有限公司');
INSERT INTO `rv_feetype` VALUES ('11', '其他', '太原科技有限公司');
INSERT INTO `rv_feetype` VALUES ('13', '检修费', '冀东启明');
INSERT INTO `rv_feetype` VALUES ('14', '卡费', '冀东启明');
INSERT INTO `rv_feetype` VALUES ('15', '卡超费', '冀东启明');
INSERT INTO `rv_feetype` VALUES ('16', '检修费', '启明科技');
INSERT INTO `rv_feetype` VALUES ('17', '卡费', '启明科技');

-- ----------------------------
-- Table structure for `rv_fenqicar`
-- ----------------------------
DROP TABLE IF EXISTS `rv_fenqicar`;
CREATE TABLE `rv_fenqicar` (
  `id` int(11) NOT NULL auto_increment,
  `carId` int(11) NOT NULL COMMENT '车辆ID',
  `getmoney` decimal(20,2) NOT NULL COMMENT '已还款金额',
  `totalmoney` decimal(20,2) default NULL COMMENT '总金额',
  `remainmoney` decimal(20,2) default NULL COMMENT '剩余金额',
  `repaydate` varchar(20) NOT NULL COMMENT '还款日期',
  `truedate` varchar(20) NOT NULL COMMENT '实际还款日期',
  `totalyear` varchar(20) default NULL COMMENT '总时间（分几年还完）',
  `beizhu` varchar(100) default NULL COMMENT '备注',
  `judge` int(5) NOT NULL COMMENT '1：可编辑状态，2：已编辑状态',
  `company1` varchar(50) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_fenqicar
-- ----------------------------
INSERT INTO `rv_fenqicar` VALUES ('1', '33', '100.00', '5000.00', '0.00', '5', '2013-11-05 09:55:43', '5', 'hyt ', '2', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('2', '34', '0.00', '0.00', '0.00', '', '', '', null, '0', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('3', '35', '500.00', '2000.00', '0.00', '12', '2011-10-10', '4', '', '2', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('4', '36', '1000.00', '11000.00', '0.00', '5', '2011-10-10', '10', '关于铁观音', '2', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('5', '35', '500.00', '0.00', '0.00', '', '2011-11-14', '', 'ds ', '0', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('6', '36', '200.00', null, null, '', '2011-11-14', null, '', '0', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('7', '33', '500.00', null, null, '', '2013-11-05 10:01:32', null, 'fdssss', '0', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('8', '34', '100.00', null, null, '', '2014-11-06 10:35:33', null, '', '0', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('9', '38', '0.00', '2000.00', null, '06', '2014-01-06 16:44:48', '2', '', '2', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('10', '38', '1000.00', null, null, '', '2014-01-06 16:45:13', null, '', '0', '启明科技');
INSERT INTO `rv_fenqicar` VALUES ('11', '39', '333.00', '1000.00', null, '11', '2014-11-24 10:41:19', '2', '', '2', '启明科技');

-- ----------------------------
-- Table structure for `rv_fuwufei`
-- ----------------------------
DROP TABLE IF EXISTS `rv_fuwufei`;
CREATE TABLE `rv_fuwufei` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `fuwufei` varchar(20) NOT NULL COMMENT '每年需交服务费',
  `company1` varchar(50) NOT NULL COMMENT '分公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_fuwufei
-- ----------------------------
INSERT INTO `rv_fuwufei` VALUES ('1', '720', '启明科技');
INSERT INTO `rv_fuwufei` VALUES ('2', '960.00', '启明科技');
INSERT INTO `rv_fuwufei` VALUES ('3', '2400.00', '启明科技');
INSERT INTO `rv_fuwufei` VALUES ('4', '3000.00', '启明科技');

-- ----------------------------
-- Table structure for `rv_huikuan`
-- ----------------------------
DROP TABLE IF EXISTS `rv_huikuan`;
CREATE TABLE `rv_huikuan` (
  `id` int(11) NOT NULL auto_increment,
  `clientId` int(11) NOT NULL COMMENT '客户ID',
  `money` decimal(20,2) NOT NULL COMMENT '回款金额',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP COMMENT '回款日期',
  `inputer` varchar(20) NOT NULL COMMENT '录入人',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_huikuan
-- ----------------------------
INSERT INTO `rv_huikuan` VALUES ('1', '1', '180.00', '2014-08-19 12:04:29', 'admin', '');
INSERT INTO `rv_huikuan` VALUES ('3', '3', '421.00', '2014-08-19 15:35:03', 'admin', '');
INSERT INTO `rv_huikuan` VALUES ('4', '1', '60.00', '2014-08-19 15:38:13', 'admin', '');
INSERT INTO `rv_huikuan` VALUES ('5', '3', '90.00', '2014-08-19 15:42:07', 'admin', '');
INSERT INTO `rv_huikuan` VALUES ('6', '1', '80.00', '2014-08-19 15:43:34', 'admin', '');
INSERT INTO `rv_huikuan` VALUES ('7', '3', '100.00', '2014-08-19 15:49:52', 'admin', '');
INSERT INTO `rv_huikuan` VALUES ('8', '1', '80.00', '2014-08-19 15:50:06', 'admin', '');

-- ----------------------------
-- Table structure for `rv_info`
-- ----------------------------
DROP TABLE IF EXISTS `rv_info`;
CREATE TABLE `rv_info` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(60) NOT NULL COMMENT '客户名称',
  `address` varchar(60) NOT NULL COMMENT '客户地址',
  `linkman` varchar(20) NOT NULL COMMENT '联系人',
  `tel` varchar(20) NOT NULL COMMENT '客户电话',
  `longitude` varchar(10) NOT NULL COMMENT '经度',
  `latitude` varchar(10) NOT NULL COMMENT '纬度',
  `location` varchar(20) NOT NULL COMMENT '位置',
  `areaid` int(11) NOT NULL COMMENT '区域',
  `salesid` int(11) NOT NULL COMMENT '销售',
  `typeid` int(11) NOT NULL COMMENT '客户类型',
  `intro` text NOT NULL COMMENT '备注',
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` datetime default NULL COMMENT '更新时间',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_info
-- ----------------------------
INSERT INTO `rv_info` VALUES ('82', '东运', '忻州', '123', '1234567898', '', '', '', '22', '4', '20', '', '2014-08-06 11:17:19', '2014-08-08 12:49:47', '');
INSERT INTO `rv_info` VALUES ('83', 'hfs', '水电费', '特温特', '154558386824290', '', '', '', '26', '1', '20', '', '2014-08-08 12:49:13', '2014-08-27 14:36:19', '');
INSERT INTO `rv_info` VALUES ('84', '功夫', '黄冠草服', '很过分', '765', '', '', '', '26', '2', '20', '', '2014-08-11 14:25:48', null, '');

-- ----------------------------
-- Table structure for `rv_kucun`
-- ----------------------------
DROP TABLE IF EXISTS `rv_kucun`;
CREATE TABLE `rv_kucun` (
  `id` int(11) NOT NULL auto_increment,
  `productId` int(11) NOT NULL COMMENT '商品ID',
  `quantity` int(11) NOT NULL COMMENT '数量',
  `roomId` int(11) NOT NULL COMMENT '库房ID',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '日期',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_kucun
-- ----------------------------
INSERT INTO `rv_kucun` VALUES ('9', '5', '176', '1', '2014-09-25 14:41:42', '冀东启明科技有限公司');
INSERT INTO `rv_kucun` VALUES ('10', '5', '119', '1', '2014-09-25 14:41:42', '冀东启明科技有限公司');
INSERT INTO `rv_kucun` VALUES ('11', '5', '18', '27', '2014-09-25 14:41:42', '冀东启明科技有限公司');
INSERT INTO `rv_kucun` VALUES ('12', '5', '1', '27', '2014-09-25 14:41:42', '冀东启明科技有限公司');
INSERT INTO `rv_kucun` VALUES ('13', '5', '20', '30', '2014-09-25 14:41:42', '冀东启明科技有限公司');
INSERT INTO `rv_kucun` VALUES ('14', '5', '12', '1', '2014-09-25 14:41:42', '冀东启明科技有限公司');
INSERT INTO `rv_kucun` VALUES ('15', '5', '1', '31', '2014-09-25 14:41:42', '冀东启明科技有限公司');
INSERT INTO `rv_kucun` VALUES ('16', '5', '24', '27', '2014-09-25 14:41:42', '冀东启明科技有限公司');

-- ----------------------------
-- Table structure for `rv_log`
-- ----------------------------
DROP TABLE IF EXISTS `rv_log`;
CREATE TABLE `rv_log` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `carNum` varchar(10) NOT NULL COMMENT '车牌号',
  `caozuo` varchar(100) NOT NULL COMMENT '所做操作',
  `date` datetime NOT NULL COMMENT '日期',
  `inputer` varchar(20) NOT NULL COMMENT '操作者',
  `company1` varchar(50) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_log
-- ----------------------------
INSERT INTO `rv_log` VALUES ('1', '晋H15241', '新增车辆', '2014-12-12 17:12:59', '郝', '冀东启明科技有限公司');
INSERT INTO `rv_log` VALUES ('2', '晋A45412', '修改车辆信息', '2014-12-15 11:17:25', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('3', '晋H15242', '新增车辆', '2014-12-15 11:19:18', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('4', '晋A45412', '修改车辆信息', '2014-12-15 14:03:25', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('5', '晋H45124', '修改车辆信息', '2014-12-19 10:39:12', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('6', '晋A45412', '修改车辆信息', '2014-12-19 10:39:58', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('7', '晋A45412', '修改车辆信息', '2014-12-19 10:40:05', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('8', '晋A45412', '修改车辆信息', '2014-12-19 10:40:35', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('9', '晋A45412', '修改车辆信息', '2014-12-19 10:40:54', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('10', '晋A45412', '修改车辆信息', '2014-12-19 10:41:30', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('11', '晋A45412', '修改车辆信息', '2014-12-19 10:42:35', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('12', '晋A45412', '修改车辆信息', '2014-12-19 10:46:40', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('13', '晋A45412', '修改车辆信息', '2014-12-19 10:47:38', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('14', '晋A45412', '修改车辆信息', '2014-12-19 10:48:28', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('15', '晋A45412', '修改车辆信息', '2014-12-19 10:49:26', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('16', '晋H45124', '修改车辆信息', '2014-12-19 10:53:43', '李四', '启明科技');
INSERT INTO `rv_log` VALUES ('17', '晋H15241', '修改车辆信息', '2014-12-22 10:26:36', '郝', '冀东启明科技有限公司');
INSERT INTO `rv_log` VALUES ('18', '晋H00001', '新增车辆', '2014-12-22 11:43:06', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('19', '晋H00001', '修改车辆信息', '2014-12-22 11:50:21', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('20', '晋H00001', '修改车辆信息', '2014-12-22 11:50:33', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('21', '晋H00002', '新增车辆', '2014-12-22 11:53:11', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('22', '晋H00002', '新增车辆', '2014-12-22 11:53:18', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('23', '晋H00002', '新增车辆', '2014-12-22 11:53:24', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('24', '晋H00002', '新增车辆', '2014-12-22 11:54:30', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('25', '晋H00002', '修改车辆信息', '2014-12-22 11:54:43', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('26', '晋H00003', '新增车辆', '2014-12-22 11:56:04', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('27', '晋H10004', '新增车辆', '2014-12-22 11:58:08', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('28', '晋H10004', '新增车辆', '2014-12-22 12:00:28', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('29', '晋H10001', '新增车辆', '2014-12-22 12:01:16', '', '冀东启明');
INSERT INTO `rv_log` VALUES ('30', '晋H14212', '修改车辆信息', '2014-12-22 12:22:01', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('31', '晋H15212', '新增车辆', '2014-12-22 13:00:30', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('32', '晋H12121', '新增车辆', '2014-12-22 13:22:29', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('33', '晋H15212', '修改车辆信息', '2014-12-22 13:22:46', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('34', '晋H45454', '新增车辆', '2014-12-22 14:24:36', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('35', '晋H45125', '新增车辆', '2014-12-22 14:33:49', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('36', '晋KF0701', '修改车辆信息', '2014-12-23 11:18:43', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('37', '晋KF0701', '修改车辆信息', '2014-12-23 11:23:48', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('38', '晋KF0701', '修改车辆信息', '2014-12-23 11:36:22', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('39', '晋KF0701', '修改车辆信息', '2014-12-23 11:38:27', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('40', '晋LB7188', '修改车辆信息', '2014-12-23 11:40:02', '李四', '冀东启明');
INSERT INTO `rv_log` VALUES ('41', '晋KF0701', '修改车辆信息', '2014-12-23 11:48:50', '李四', '冀东启明');

-- ----------------------------
-- Table structure for `rv_maintain`
-- ----------------------------
DROP TABLE IF EXISTS `rv_maintain`;
CREATE TABLE `rv_maintain` (
  `id` int(11) NOT NULL auto_increment,
  `chudate` varchar(20) NOT NULL COMMENT '忻州寄出时间',
  `getdate` varchar(20) default NULL COMMENT '收到日期',
  `fromcity` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL COMMENT '公司名称',
  `carNum` varchar(20) NOT NULL,
  `supplierId` int(11) NOT NULL COMMENT '终端厂家',
  `model` varchar(30) NOT NULL COMMENT '型号',
  `xuliehao` varchar(30) default NULL COMMENT '序列号',
  `reason` varchar(200) default NULL COMMENT '返修原因',
  `phenomenon` varchar(200) default NULL COMMENT '检测现象',
  `reasult` varchar(200) default NULL COMMENT '维修结果',
  `backdate` varchar(20) default NULL COMMENT '寄出日期',
  `zhujiId` varchar(30) default NULL,
  `mainNum` varchar(20) default NULL COMMENT '检修次数',
  `beizhu` varchar(200) default NULL COMMENT '备注',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_maintain
-- ----------------------------
INSERT INTO `rv_maintain` VALUES ('1', '2014-12-10', '2014-12-09', '忻州市', '', '晋H12312', '11', 'CA-8B', '423423', '不定位', '漏电', '正常', '2014-12-10', null, '1', '正在维修', '启明科技');
INSERT INTO `rv_maintain` VALUES ('3', '2014-12-05', null, '太原', '祥龙公司', '晋H12312', '11', 'CA-8B', '543535', null, null, null, null, null, null, 'CBXV', '启明科技');
INSERT INTO `rv_maintain` VALUES ('4', '2014-12-10', null, 'fds', '祥龙公司', '晋H784515(3G)', '1', '432', null, null, null, null, null, 'rew', null, '', '冀东启明');

-- ----------------------------
-- Table structure for `rv_note`
-- ----------------------------
DROP TABLE IF EXISTS `rv_note`;
CREATE TABLE `rv_note` (
  `id` int(11) NOT NULL auto_increment,
  `sendid` smallint(6) NOT NULL,
  `collectid` smallint(11) NOT NULL,
  `open` smallint(6) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime default NULL,
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_note
-- ----------------------------

-- ----------------------------
-- Table structure for `rv_outrepair`
-- ----------------------------
DROP TABLE IF EXISTS `rv_outrepair`;
CREATE TABLE `rv_outrepair` (
  `id` int(11) NOT NULL auto_increment,
  `company` varchar(100) NOT NULL COMMENT '公司名称',
  `carNum` varchar(50) NOT NULL,
  `fachudate` date default NULL COMMENT '维修时间',
  `finishdate` date default NULL COMMENT '完成时间',
  `weixiuproject` varchar(100) default NULL COMMENT '维修项目',
  `reason` varchar(200) default NULL COMMENT '故障原因',
  `result` varchar(150) default NULL COMMENT '维修结果',
  `location1` varchar(200) default NULL,
  `location2` varchar(200) default NULL,
  `wangdian` varchar(100) default NULL COMMENT '维修网点',
  `fachuperson` varchar(100) default NULL COMMENT '发出人员',
  `weixiuperson` varchar(100) default NULL COMMENT '维修人员',
  `judge` int(10) NOT NULL COMMENT '1：审验 2：审验完成',
  `company1` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_outrepair
-- ----------------------------
INSERT INTO `rv_outrepair` VALUES ('1', '祥龙公司', '晋H784515(3G)', '2014-12-10', '0000-00-00', null, '开个会', '', null, null, '库管', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('2', '祥龙公司', '晋H784515(3G)', '2014-12-10', '0000-00-00', null, '开个会', '', null, null, '库管', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('3', '祥龙公司', '晋H784515(3G)', '2014-12-10', '0000-00-00', null, '开个会', '', null, null, '库管', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('4', '祥龙公司', '晋H784515(3G)', '2014-12-10', '0000-00-00', null, '烦烦烦', '', null, null, '放到', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('5', '祥龙公司', '晋H784515(3G)', '2014-12-17', '0000-00-00', null, '让V', '', null, null, '额我擦', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('6', '祥龙公司', '晋H784515(3G)', '2014-12-10', '0000-00-00', null, '烦烦烦', '', null, null, '放到', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('8', '祥龙公司', '晋H784515(3G)', '2014-12-04', '0000-00-00', null, 'kkk', '', null, null, 'kkk', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('9', '祥龙公司', '晋H784515(3G)', '2014-12-03', '0000-00-00', null, 'ng', '', null, null, 'hgf', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('10', '祥龙公司', '晋H784515(3G)', '2014-12-11', '0000-00-00', null, 'kiu', '', null, null, 'iu', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('11', '祥龙公司', '晋H784515(3G)', '2014-12-03', '0000-00-00', null, 'uuu', '', null, null, 'uuu', '李四', null, '1', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('12', '祥龙公司', '晋H784515(3G)', '2014-12-09', '2014-12-29', '熄火', 'fds', '不错V下', 'uploads/8ceb5790faf811d1cc12879e3c4f38a90', 'uploads/6bc4044063c343d56a783e1ebada0f390', 'hg', '李四', 'jg', '2', '冀东启明');
INSERT INTO `rv_outrepair` VALUES ('13', '祥龙公司', '晋H784515(3G)', '2014-12-18', null, null, null, null, null, null, '忻州', '李四', '凤飞飞', '1', '冀东启明');

-- ----------------------------
-- Table structure for `rv_paicolor`
-- ----------------------------
DROP TABLE IF EXISTS `rv_paicolor`;
CREATE TABLE `rv_paicolor` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `paicolor` varchar(20) NOT NULL COMMENT '车牌颜色',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_paicolor
-- ----------------------------
INSERT INTO `rv_paicolor` VALUES ('1', '黄色');

-- ----------------------------
-- Table structure for `rv_photo`
-- ----------------------------
DROP TABLE IF EXISTS `rv_photo`;
CREATE TABLE `rv_photo` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `salesid` int(11) NOT NULL COMMENT '销售ID',
  `filename` varchar(400) NOT NULL COMMENT '描述',
  `intro` varchar(255) NOT NULL COMMENT '简介',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime default NULL COMMENT '更新时间',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_photo
-- ----------------------------

-- ----------------------------
-- Table structure for `rv_platform`
-- ----------------------------
DROP TABLE IF EXISTS `rv_platform`;
CREATE TABLE `rv_platform` (
  `id` int(11) NOT NULL auto_increment,
  `platform` varchar(50) NOT NULL COMMENT '车辆平台',
  `company1` varchar(50) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_platform
-- ----------------------------
INSERT INTO `rv_platform` VALUES ('2', '1号平台', '启明科技');
INSERT INTO `rv_platform` VALUES ('3', '2号平台', '启明科技');
INSERT INTO `rv_platform` VALUES ('4', '3号平台', '启明科技');
INSERT INTO `rv_platform` VALUES ('5', '4号平台', '启明科技');
INSERT INTO `rv_platform` VALUES ('6', '5号平台', '启明科技');
INSERT INTO `rv_platform` VALUES ('7', '冀东启明车联网平台', '启明科技');

-- ----------------------------
-- Table structure for `rv_product`
-- ----------------------------
DROP TABLE IF EXISTS `rv_product`;
CREATE TABLE `rv_product` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL COMMENT '物品名称',
  `unit` varchar(10) NOT NULL COMMENT '计量单位',
  `model` varchar(60) default NULL,
  `categoryId` int(11) NOT NULL COMMENT '物品类型',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`),
  KEY `13` (`categoryId`),
  CONSTRAINT `13` FOREIGN KEY (`categoryId`) REFERENCES `rv_sort` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_product
-- ----------------------------

-- ----------------------------
-- Table structure for `rv_product2`
-- ----------------------------
DROP TABLE IF EXISTS `rv_product2`;
CREATE TABLE `rv_product2` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL COMMENT '物品名称',
  `unit` varchar(10) NOT NULL COMMENT '单位',
  `model` varchar(60) NOT NULL COMMENT '型号',
  `category` varchar(50) NOT NULL COMMENT '类别',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_product2
-- ----------------------------

-- ----------------------------
-- Table structure for `rv_record`
-- ----------------------------
DROP TABLE IF EXISTS `rv_record`;
CREATE TABLE `rv_record` (
  `id` int(11) NOT NULL auto_increment,
  `tranNum` varchar(50) default NULL COMMENT '道路运输证号',
  `city` varchar(50) default NULL COMMENT '市ID',
  `county` varchar(50) default NULL COMMENT '县ID',
  `owner` varchar(50) default NULL COMMENT '车主/业主',
  `linkman` varchar(50) default NULL COMMENT '联系人',
  `linktel` varchar(20) default NULL COMMENT '联系人手机号',
  `chejiaNum` varchar(20) default NULL COMMENT '车架号',
  `carNum` varchar(10) NOT NULL COMMENT '车牌号',
  `paicolor` varchar(50) default NULL COMMENT '车辆颜色',
  `cartype` varchar(100) default NULL COMMENT '车辆类型',
  `carbrand` varchar(100) default NULL COMMENT '车辆品牌',
  `carmodel` varchar(100) default NULL COMMENT '车辆型号',
  `totalweight` varchar(20) default NULL COMMENT '总质量',
  `payload` varchar(20) default NULL COMMENT '核定载质量',
  `pullweight` varchar(20) default NULL COMMENT '准牵引总质量',
  `outlength` varchar(20) default NULL COMMENT '外廓长',
  `outwidth` varchar(20) default NULL COMMENT '外廓宽',
  `outhigh` varchar(20) default NULL COMMENT '外廓高',
  `inlength` varchar(20) default NULL COMMENT '货厢内部长',
  `inwidth` varchar(20) default NULL COMMENT '内部宽',
  `inhigh` varchar(20) default NULL COMMENT '内部高',
  `zhouNum` varchar(20) default NULL COMMENT '轴数',
  `tiresNum` varchar(20) default NULL COMMENT '轮胎数',
  `tiresstandard` varchar(50) default NULL COMMENT '轮胎规格',
  `chutime` varchar(50) default NULL COMMENT '车辆出厂时间',
  `operascope` varchar(50) default NULL COMMENT '经营范围',
  `carcolor` varchar(20) default NULL COMMENT '车身颜色',
  `buyway` varchar(20) default NULL COMMENT '购买方式',
  `insuretime` varchar(20) default NULL COMMENT '车辆保险到期时间',
  `checkdue` varchar(20) default NULL COMMENT '检验有效期',
  `licence` varchar(50) default NULL COMMENT '道路运输经营许可证',
  `insuresort` text COMMENT '车辆保险种类',
  `deviceId` varchar(50) default NULL COMMENT '终端ID',
  `simNum` varchar(20) default NULL COMMENT 'SIM卡号',
  `lasttime` datetime default NULL COMMENT '最后操作时间',
  `inputer` varchar(20) default NULL COMMENT '操作人',
  `judge` int(5) default NULL COMMENT '1：有待审核  2：已审核状态',
  `location1` varchar(200) default NULL COMMENT '车辆登记证上传',
  `location2` varchar(200) default NULL COMMENT '车辆合格证/行驶证',
  `location3` varchar(200) default NULL COMMENT '车身照片',
  `location4` varchar(200) default NULL,
  `location5` varchar(200) default NULL,
  `location6` varchar(200) default NULL,
  `location7` varchar(200) default NULL,
  `location8` varchar(200) default NULL,
  `location9` varchar(200) default NULL,
  `location10` varchar(200) default NULL,
  `location11` varchar(200) default NULL,
  `beizhu` varchar(200) default NULL COMMENT '备注，显示不通过的原因',
  `company1` varchar(50) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_record
-- ----------------------------
INSERT INTO `rv_record` VALUES ('4', '14102902827', '临汾市', '乡宁县', '胡杨博', '胡杨博', '15535736856', 'LFNMVUNW9D1F40918', '晋LB9453', '黄色', '重型自卸货车', '解放牌', 'CA3310P63K2L4T4E', '31000', '16005', '--', '10245', '2495', '3260', '7200', '2300', '1170', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY00465', '15503572694', '2014-12-08 11:04:22', '临汾货运平台', '2', 'uploads/223155f0dd27503abafae9990a5d0b620', 'uploads/0bbb3407acc53c3955782f97437d3e900', 'uploads/83df95bb04f81606af996f4f331b8cb00', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('8', '14100224216', '临汾市', '尧都区', '王峰军', '王峰军', '13096522998', 'LZGJLG895EX055672', '晋LB5767', '黄色', '重型半挂牵引车', '陕汽牌', 'SX4258GR279TL', '--', '--', '38300', '6885', '2490', '3900', '--', '--', '--', '3', '8', '12R22.5_18PR', '', '', '', '', '', '', '', '', 'CY00623', '15503576974', '2014-12-16 14:29:52', '临汾货运平台', '2', 'uploads/e9f7af24f0f43ab8ea8f733504749e910', 'uploads/cb52c153897bab6c3374be7bf1a43ca60', 'uploads/7dd6d980eab6103644a7c3290f484e780', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('9', '14102901966', '临汾市', '乡宁县', '王秀萍', '王秀萍', '13835366784', 'LGHXLGCP7A7005548', '晋L77409', '黄色', '重型自卸货车', '东风牌', 'EQ3259GF', '24900', '12805', '35700', '8370', '2480', '3150', '5800', '2300', '1160', '3', '8', '', '', '', '', '', '', '', '', '', 'CY00518', '15503574854', '2014-12-04 14:49:34', '临汾货运平台', '2', 'uploads/9babebdbad0803b8b1a88c063d3d6bc60', 'uploads/ae07347e042c585a08527977488b12240', 'uploads/881dbaea05f5590bf83f8295ec22fde10', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('10', '14230101820', '吕梁市', '柳林县', '刘永兴', '刘永兴', '13383583331', 'LS3T3CH6590104081', '晋J24140', '黄色', '重型自卸货车', '十通牌', 'STQ3313L8Y5B3', '31000', '16040', '--', '9100', '2490', '3450', '6100', '2200', '1420', '4', '12', '10.00-20', '', '', '', '', '', '', '', '', '4302071', '15534302071', '2014-12-08 11:24:51', '吕梁货运平台', '2', 'uploads/2b3a64931f37398e242c6450921a7b260', 'uploads/b2e906d1923f3da79c5751056ff36ac80', '', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('11', '', '临汾市', '尧都区', '临汾晋临运货运有限公司', '王洪胜', '13934343443', 'LGAG4LX30E4000971', '晋LB9843', '黄色', '重型半挂牵引车', '东风牌', 'DFH4240A1', '--', '--', '37070', '7300', '2500', '3770', '--', '--', '--', '3', '8', '12R22.5_18PR', '', '', '', '', '', '', '', '', 'E405775', '15997459717', '2014-12-04 16:57:15', '临汾货运平台', '2', 'uploads/6d3ddc7bdfcc94bb131b30a81e2a51210', 'uploads/0ba6808dc39fb5081502618c780098360', 'uploads/cd8128da7c79bc5af8876ec929f8eda70', null, null, null, null, null, null, null, null, '登记证车号看不清；没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('12', '', '临汾市', '尧都区', '临汾晋临运货运有限公司', '王洪胜', '13934343443', 'LGAG4LX3XE4000766', '晋LB9844', '黄色', '重型半挂牵引车', '东风牌', 'DFH4240A1', '--', '--', '37070', '7300', '2500', '3770', '--', '--', '--', '3', '8', '12R22.5_18PR', '', '', '', '', '', '', '', '', 'E403011', '15997491807', '2014-12-04 16:59:04', '临汾货运平台', '2', 'uploads/f1d6af3ce3aec64c7cb331e7b56d05340', 'uploads/98102dd9072a43d60adfb1779e8aacc40', 'uploads/ce83a1cc7b9b5ba50212c20e3d93e31e0', null, null, null, null, null, null, null, null, '登记证车号看不清；没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('13', '14102901635', '临汾市', '乡宁县', '安郭峰', '安郭峰', '15935326358', 'LFWSRXNJ561F13375', '晋L46744', '黄色', '重型半挂牵引车', '解放牌', 'CA4252P21K2T1A', '24950', '--', '35700', '6888', '2490', '3240', '--', '--', '--', '3', '10', '12.20R20', '', '', '', '', '', '', '', '', 'CY00639', '15503571452', '2014-12-05 10:08:13', '临汾货运平台', '2', 'uploads/4a7a9004c068615d2de5c30d0da635b50', 'uploads/ef5b5c3526c80c0878f6e9d759c4b49f0', 'uploads/83a0de6458504072e3834dcaf044db230', null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('19', '14232602054', '吕梁市', '临县', '薛凤龙', '薛凤龙', '13293486333', 'LGAX5D645B3029543', '晋J36073', '黄色', '重型自卸货车', '东风', 'DFL3311AXA', '31000', '15925', '--', '9750', '2500', '3450', '7100', '2300', '1180', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', '2471532', '13033471532', '2014-12-08 11:55:09', '吕梁货运平台', '2', null, null, null, null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('20', '14232704393', '吕梁市', '柳林县', '柳林世捷开元汽车运输服务有限公司', '薛凤龙', '13293486333', 'LGAX5DF4XD3017844', '晋J51577', '黄色', '重型自卸货车', '东风', 'DFL3310A9', '31000', '15870', '1000', '9800', '2500', '3450', '7200', '2300', '1160', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', '3472045', '13033472045', '2014-12-08 11:53:53', '吕梁货运平台', '2', null, null, null, null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('21', '14230203427', '吕梁市', '离石区', '高建荣', '高建荣', '13753356672', 'LVBV6PDCX7W122831', '晋J07461', '黄色', '重型自卸货车', '时代牌', 'BJ3168DJPHE', '16285', '7990', '--', '9770', '2460', '2940', '7300', '2300', '550', '3', '8', '10.00-20', '', '', '', '', '', '', '', '', '3471689', '13033471689', '2014-12-08 16:15:40', '吕梁货运平台', '2', null, null, null, null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('22', '', '吕梁市', '离石区', '薛少宇', '薛少宇', '15234895125', 'LGAX5DF4XE3002701', '晋J52331', '黄色', '重型自卸货车', '东风', 'DFL3310A9', '31000', '15870', '10000', '9890', '2500', '3450', '7200', '2300', '1160', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', '3471632', '13033471632', '2014-12-08 16:25:31', '吕梁货运平台', '2', 'uploads/ec302fe97c820ce84ed84f1f96e388db0', 'uploads/344ba77eb6cde6f0c71a1fbde6142a680', null, null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('23', '14232206201', '吕梁市', '中阳县', '付永忠', '付永忠', '13383583331', 'LFNFPXNX971E04838', '晋J07353', '黄色', '重型普通货车', '解放', 'CA5242XXYP21K2LT4B', '24030', '9500', '--', '11990', '2495', '3880', '9500', '2300', '2200', '4', '12', '12.00R20', '', '', '', '', '', '', '', '', '4301769', '15534301769', '2014-12-09 11:19:37', '吕梁货运平台', '2', 'uploads/26b5efb39014c3325af72e510ee50fa70', 'uploads/75d6304dd3fa5ac0591217926109a71d0', 'uploads/99ea593232718d504ca5a7de99a15b360', null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('24', '14108103409', '临汾市', '侯马市', '山西三皇侯马运业集团股份有限公司', '张明', '13994002406', 'LFNABRJN66AA20023', '晋L25630', '黄色', '重型厢式货车', '解放牌', 'CA5122XXYPK2L4A80-3', '12005', '1900', '--', '9585', '2470', '3815', '7200', '2300', '2310', '2', '6', '9.00_20', '', '', '', '', '', '', '', '', 'CY00303', '15635778034', '2014-12-22 11:15:01', '临汾货运平台', '2', 'uploads/177cec58e494cc02bb86a030a6caf51a0', 'uploads/0d022c77c471c5bb8dbd564720d5114d0', 'uploads/551252651ab1dd1ea031705d630c77cc0', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('25', '14108103396', '临汾市', '侯马市', '山西三皇侯马运业集团股份有限公司', '张明', '13994002406', 'LFNCKXLX16LA17420', '晋L25637', '黄色', '重型厢式货车', '柳特神力', 'LZT5201XXYP1K2L10T3A91', '20295', '7900', '--', '11980', '2490', '3810', '9600', '2300', '2400', '3', '8', '10.00_20', '', '', '', '', '', '', '', '', 'CY00346', '15635772994', '2014-12-22 11:15:16', '临汾货运平台', '2', 'uploads/1b79745de0cdfb2085773e1146521f5a0', 'uploads/e518ca2941fe585edafe0ba0706687ae0', 'uploads/26bc1020d0d53426977984025a31df370', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('26', '14108108498', '临汾市', '侯马市', '山西三皇侯马运业集团股份有限公司', '张明', '13994002406', 'LGAX4B356B3040328', '晋L52057', '黄色', '重型仓栅式运输车', '东风牌', 'DFL5253CCQAXA', '24930', '16930', '--', '11990', '2500', '3900', '9600', '2400', '550', '3', '8', '295/80R22.5', '', '', '', '', '', '', '', '', 'CY00253', '15635778612', '2014-12-22 11:15:26', '临汾货运平台', '2', 'uploads/d275f064a58c2619e9bf041e70ffb8890', 'uploads/07dcfb627d0caa3747aa0f6b9e30914d0', 'uploads/b21fce4a5b1bcec1cada185aebe7e8760', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('27', '14108108867', '临汾市', '侯马市', '山西三皇侯马运业集团股份有限公司', '张明', '13994002406', 'LFWRKUMF0AAC44659', '晋L63569', '黄色', '重型半挂牵引车', '解放牌', 'CA4206P1K2T3FA80', '--', '--', '31815', '6475', '2490', '3080', '--', '--', '--', '3', '8', '11.00R20', '', '', '', '', '', '', '', '', 'CY00252', '15635778608', '2014-12-22 11:15:38', '临汾货运平台', '2', 'uploads/be74f44a538c71d0029c699993a4b5a90', 'uploads/30af0bb5680f0a5b326fe35e991ec46f0', 'uploads/be570df53d39d0846184f690bbebb0420', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('28', '14108107711', '临汾市', '侯马市', '山西三皇侯马运业集团股份有限公司', '张明', '13994002406', 'LFWRMXNF59AC24848', '晋L73773', '黄色', '重型半挂牵引车', '解放牌', 'CA4226P2K2T3EA81', '--', '--', '38000', '6538', '2490', '3350', '--', '--', '--', '3', '8', '11.00R20', '', '', '', '', '', '', '', '', 'CY00302', '15635776481', '2014-12-22 11:15:50', '临汾货运平台', '2', 'uploads/dd9a1771789826f992d38d293a3d668c0', 'uploads/f00747710ef8cae044f0a05da4eeeee00', 'uploads/cea7f0565befd8250e369b19b639a1090', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('29', '14100218489', '临汾市', '尧都区', '王永刚', '王永刚', '13703558620', 'LGAX5CF42C8018191', '晋LA4063', '黄色', '重型自卸货车', '东风牌', 'DLF3311AX1A', '31000', '15925', '--', '10250', '2500', '3450', '7600', '2300', '1110', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY00133', '15635777969', '2014-12-18 10:58:00', '临汾货运平台', '2', 'uploads/b10898e7256f9089f58b4c686725d08f0', 'uploads/9886a225ef8c8a2cb1770822ab5a40890', 'uploads/e6d8ffd8adf746ca3ca7991ecfc566770', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('30', '', '临汾市', '乡宁县', '乡宁县中远物流有限责任公司', '赵闫喜', '13934174333', 'LZGJLG897DX121332', '晋LB2703', '黄色', '重型半挂牵引车', '陕汽牌', 'SX4256GR279TL', '-', '--', '38300', '6885', '2490', '3560', '--', '--', '---', '3', '8', '12R22.5_18PR', '', '', '', '', '', '', '', '', 'CY00221', '15635772148', '2014-12-12 08:41:33', '临汾货运平台', '2', 'uploads/223155f0dd27503abafae9990a5d0b620', 'uploads/88af220d892cf9c2fd738172f2bbaa380', 'uploads/2191a448cd6471ed3a751ff9efc984170', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('35', '14230206928', '吕梁市', '离石区', '宋少雄', '宋少雄', '18636432222', 'LGAX5C640A5008029', '晋J39480', '黄色', '重型自卸货车', '东风', 'EQ3318VB3GB', '31000', '15990', '0', '9590', '2480', '3400', '6800', '2300', '1236', '4', '12', '1100R20', '2010-04-30', '普货', '红色', '', '', '', '', 'jiaoqiang,transport', '3471927', '13033471927', '2014-12-16 17:05:52', '吕梁货运平台', '2', 'uploads/58b9b495bfba42995d573d5a61d2e8710', 'uploads/667e4bb81981b504cf0fbb234845ef200', 'uploads/0011a331d9f69be8e04eae4f3ccde4c00', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('36', '', '临汾市', '洪桐县', '张玲玲', '张玲玲', '13994037608', 'LFNAFUJK0E1F98082', '晋LC0193', '黄色', '重型仓栅式运输车', '解放牌', 'CA5160CLXYP62K1L4A2E', '16000', '9805', '--', '9000', '2495', '3610', '6800', '2400', '600', '2', '6', '9.00R20', '', '', '', '', '', '', '', '', 'CY00811', '13111276441', '2014-12-15 10:37:45', '临汾货运平台', '2', 'uploads/da7476645231556c2cd4075906102c9a0', 'uploads/d82caedc4575207ad364f8c25127edfc0', 'uploads/2aa16a118eb66ca8be20bf037c234fb90', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('37', '', '临汾市', '襄汾县', '郝玉海', '郝玉海', '13133183926', 'LS7DSGNV3AB000965', '晋LC0200', '黄色', '重型自卸货车', '远威牌', 'SXQ3310G5D5', '31000', '16030', '--', '10610', '2498', '3200', '7580', '2250', '1393', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY00610', '15503575494', '2014-12-16 14:46:02', '临汾货运平台', '2', 'uploads/223155f0dd27503abafae9990a5d0b620', 'uploads/d6839f4588faac45fbdc3d796ffcef010', 'uploads/e07c210675035af359c98d509c18eb000', null, null, null, null, null, null, null, null, '登记证不清晰，没有运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('38', '14110207459', '吕梁市', '离石区', '贺永利', '贺永利', '15935829878', 'LGAG4DY33A3007711', '晋J25582', '黄色', '重型半挂牵引车', '东风牌', 'DFL4251A9', '--', '--', '40000', '6810', '2500', '3700', '--', '--', '--', '3', '10', '11.00R20', '2010-03-15', '普通货运', '红', '一次性付清', '', '', '', '', '3471840', '13033471840', '2014-12-19 17:07:27', '吕梁货运平台', '2', 'uploads/fe7e8b97d0780e2bc6d37d11c99c67210', 'uploads/d72ba5983996f9419be094b9239e3b1c0', 'uploads/d21a85ef6e104e766b2c2208483261e70', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('39', '14230206151', '吕梁市', '离石区', '李丸顺', '李丸顺', '13834364463', 'LGAG4DY33A2023526', '晋J28633', '黄色', '重型半挂牵引车', '东风牌', 'DFL4251A9', '--', '--', '40000', '6810', '2500', '3700', '--', '--', '--', '3', '10', '315/80R22.5', '2010-11-10', '普通货运', '红', '一次性付清', '', '', '', '', '3471586', '13033471586', '2014-12-19 16:11:44', '吕梁货运平台', '2', 'uploads/799bad5a3b514f096e69bbc4a7896cd90', 'uploads/dafc98e04de91b9762af7ca4d3fbac2f0', 'uploads/05999bcc6cbb7af5d9a71e8adaabeeea0', null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('40', '14230205320', '吕梁市', '离石区', '任才云', '任才云', '15513588780', 'LS3T3CH3290103945', '晋J24185', '黄色', '重型自卸货车', '十通牌', 'STQ3255L10Y4D3', '25000', '12900', '--', '8430', '2490', '3200', '5700', '2280', '1200', '3', '8', '10.00-20', '2009-11-03', '普通货运', '紫', '一次性付清', '', '', '', '', '3476245', '13033476245', '2014-12-18 16:35:20', '吕梁货运平台', '2', 'uploads/5d5e4c9134c72efef3dcb6aea1f060fe0', 'uploads/a48c40d5d63f31606bf3b77ee06746b10', 'uploads/b45817f7dfb3460998ee75d9a259ac0f0', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('41', '', '临汾市', '襄汾县', '贾从武', '贾从武', '15934553533', 'LJ11R9DE0E3004197', '晋LC0223', '黄色', '重型普通货车', '江淮牌', 'HFC1160P81K1E1', '15685', '9990', '--', '8980', '2495', '2600', '6800', '2300', '600', '2', '6', '9.00R20', '', '', '', '', '', '', '', '', 'CY01078', '13111273483', '2014-12-17 08:41:29', '临汾货运平台', '2', 'uploads/223155f0dd27503abafae9990a5d0b620', 'uploads/3bf977e4e6efb75843e9938342c799b80', 'uploads/050aa36dc928c858510de6c890a0ae840', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('42', '123', '临汾市', '襄汾县', '123', '1222', '12345678901', '1234567890qwertyu', '晋a12345', '黄色', '重型厢式货车', '2', '2', '12', '2', '2', '2', '2', '5', '2', '2', '5', '5', '6', '5', '', '', '', '', '', '', '', '', '12', '11111111111', '2014-12-22 12:31:29', '测试1', '1', 'uploads/b3c1f39a5481d0004da93c7d46882f120', 'uploads/b20e1846ac4a978bfa0c159d6eec350e0', 'uploads/8e093bbb5b6a7ded9d3218032204f73b0', 'uploads/d779f7ce39638b944c27046ee20fa8b10', 'uploads/a06889c872220aa28e6bb8b4db6f99bf0', 'uploads/a51f23642cf6020bb8c44919849fa1b50', 'uploads/bd998273af9096cb942c61d585a6076c0', 'uploads/42cd6e2f14bc0ec80e1457663e97f92c0', 'uploads/2fd024e93517c8029029b14b7edfac8b0', 'uploads/7ed9d9f3921092250e4ab7bc0bdce2680', 'uploads/42cd6e2f14bc0ec80e1457663e97f92c0', null, '冀东启明');
INSERT INTO `rv_record` VALUES ('43', '', '临汾市', '汾西县', '延建华', '延建华', '13994029353', 'LZGCK2G32BB001170', '晋L79810', '黄色', '重型自卸货车', '陕汽牌', 'SX3241GP3F', '24180', '12455', '--', '8180', '2400', '3050', '5500', '2200', '1200', '3', '8', '10.00R20', '', '', '', '', '', '', '', '', 'CY00714', '13111272471', '2014-12-17 16:40:38', '临汾货运平台', '2', 'uploads/792a6bdbbcfba9e3dc932c060c1349540', 'uploads/34402aea08b35d0ac5b2f036a1ec2f370', 'uploads/56054076e4148f37dff39698ac4900650', null, null, null, null, null, null, null, null, '没道路运输证号', '启明科技');
INSERT INTO `rv_record` VALUES ('44', '', '临汾市', '襄汾县', '段潇桢', '段潇桢', '15035789087', 'LGAG4DY34B2025528', '晋LC0120', '黄色', '重型半挂牵引车', '东风牌', 'DFL4251A10', '--', '--', '40000', '6810', '2500', '3700', '--', '--', '--', '3', '10', '315/80E22.5', '', '', '', '', '', '', '', '', 'CY00701', '13111270274', '2014-12-17 17:38:34', '临汾货运平台', '2', 'uploads/4a7a9004c068615d2de5c30d0da635b50', 'uploads/a1a43834d8d375a43965d2f1e24aaba80', 'uploads/c2f74cd888766b2efc0dd3a026fbe28b0', null, null, null, null, null, null, null, null, '没道路运输证号', '启明科技');
INSERT INTO `rv_record` VALUES ('45', '14102902580', '临汾市', '乡宁县', '毕爱芳', '毕爱芳', '13835756288', 'LFWSRXPJ7D1F72079', '晋LA9045', '黄色', '重型半挂牵引车', '解放牌', 'CA4252P21K2T1A2E', '--', '--', '40000', '6888', '2495', '3747', '--', '--', '--', '3', '10', '12.00R20', '', '', '', '', '', '', '', '', 'CY01097', '13111277274', '2014-12-18 08:46:01', '临汾货运平台', '2', 'uploads/23faff8c91d7a50d606cb1a24ebfbf870', 'uploads/0407d2cc26b324346750688105099ea30', 'uploads/24ffcdb4c96407b27b87cf2a4f3073fe0', null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('46', '', '临汾市', '乡宁县', '董文荣', '董文荣', '15835280987', 'LFNMVUMW3D1E50603', '晋LC0310', '黄色', '重型半挂牵引车', '解放牌', 'CA3313P7K1T4AE', '31000', '16040', '--', '10160', '2490', '3250', '7200', '2300', '1175', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY01088', '13111279084', '2014-12-18 08:49:10', '临汾货运平台', '2', 'uploads/4a7a9004c068615d2de5c30d0da635b50', 'uploads/aaed523ef712d2b5fcde19f2ca66f8be0', 'uploads/1c547546060569419b640187f6cd093f0', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('47', '14078109233', '晋中市', '介休市', '曹志峰', '曹志峰', '18634886408', 'LFWRMXNF89AC33690', '晋K49598', '黄色', '重型半挂牵引车', '解放牌', 'CA4226P2K2T3EA81', '---', '---', '38000', '6538', '2490', '3350', '---', '---', '---', '3', '8', '', '2009-11-27', '', '红色', '一次性付清', '2015-12-20', '2015-12-20', '', 'jiaoqiang,daoqiang,three,cardamage,carperson', '4831874', '18734831874', '2014-12-20 11:06:17', '栋俊货运平台', '2', 'uploads/b3c1f39a5481d0004da93c7d46882f120', 'uploads/79374c1343b034d68b43defa5b35b2800', 'uploads/2a30b5d58c92a4c29a88844c8f0d05a60', null, null, null, null, null, null, null, null, '照片上传不上', '冀东启明');
INSERT INTO `rv_record` VALUES ('48', '', '临汾市', '襄汾县', '郭建光', '郭建光', '15934589568', 'LGAX5C64495018977', '晋LA5900', '黄色', '重型自卸货车', '东风牌', 'EQ3318VB3GB', '31000', '15990', '--', '9590', '2480', '3400', '6800', '2300', '1236', '4', '12', '11.00_20', '', '', '', '', '', '', '', '', 'CY00681', '15503572074', '2014-12-19 11:20:31', '临汾货运平台', '2', 'uploads/4a7a9004c068615d2de5c30d0da635b50', 'uploads/869cfb5600f69373a48f3a7a8706fae00', 'uploads/57407bcc731ac4212b266ec1fe77fb190', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('49', '1478109233', '晋中市', '介休市', '李成军', '白亮保', '13994238292', 'LFWRMXNG4B1E46537', '晋KN4738', '黄色', '重型半挂牵引车', '解放牌', 'CA4222P21K2T3A3E', '---', '---', '37900', '6788', '2495', '3747', '--', '--', '--', '3', '8', '', '', '', '', '', '', '', '', 'jiaoqiang,daoqiang,three,cardamage,carperson', '4859244', '13754859244', '2014-12-19 12:59:33', '栋俊货运平台', '2', null, null, null, null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('50', '', '临汾市', '襄汾县', '续建军', '续建军', '15834212106', 'LGAX5CF45D1084339', '晋LB2413', '黄色', '重型自卸货车', '东风牌', 'DFL3310BX1A', '31000', '15925', '--', '9690', '2500', '3050', '6800', '2300', '1230', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY01028', '13111279204', '2014-12-19 15:58:25', '临汾货运平台', '2', 'uploads/5242a3fdde8c531d5aa64670f05dfb2f0', 'uploads/ee7dea1c96f572415297e4324b2e024e0', 'uploads/ca70579a56d30a2b69002774fce7b9320', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('51', '', '临汾市', '襄汾县', '范铁奎', '范铁奎', '13835666516', 'LGAX5CF41D1084337', '晋LB4299', '黄色', '重型自卸货车', '东风牌', 'DFL3310BX1A', '31000', '15925', '--', '9690', '2500', '3050', '6800', '2300', '1230', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY01047', '13111274791', '2014-12-19 15:57:58', '临汾货运平台', '2', 'uploads/4c8eb9111727b42fd8641115c13a86d10', 'uploads/4bdc1299cb29eb8a16a6d8c56e406c900', 'uploads/3ccccba5c686579db3c38d8d408758870', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('52', '14102311677', '临汾市', '襄汾县', '车志峰', '车志峰', '13835648885', 'LGAX4C649AL097887', '晋LB7008', '黄色', '重型自卸货车', '葛汽牌', 'CGQ3318G1', '31000', '16035', '--', '10290', '2500', '3300', '7600', '2300', '1419', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY01022', '13111271704', '2014-12-22 11:47:11', '临汾货运平台', '2', 'uploads/637fe445f2fb87e0f7f9ec4012ef39a70', 'uploads/d58393ad35e204a113bd082c9683cdb60', 'uploads/aafeacdaefb66dd74b2343faa24407370', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('53', '14102311674', '临汾市', '襄汾县', '车志峰', '车志峰', '13835648885', 'LGAX4C647AL097886', '晋LB7007', '黄色', '重型自卸货车', '葛汽牌', 'CGQ3318G1', '31000', '16035', '--', '10290', '2500', '3300', '7600', '2300', '1419', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY01075', '13111272418', '2014-12-22 09:35:04', '临汾货运平台', '2', 'uploads/223155f0dd27503abafae9990a5d0b620', 'uploads/b974af96251e33dd37a18ffc5aa9d3380', 'uploads/a332d5bac3c4c8885b42575b855890a90', null, null, null, null, null, null, null, null, '', '冀东启明');
INSERT INTO `rv_record` VALUES ('54', '', '临汾市', '襄汾县', '周晋凯', '周晋凯', '13663563351', 'LGAX5C648BL090489', '晋LA3617', '黄色', '重型自卸货车', '双机牌', 'AY3318VB3G', '31000', '16020', '--', '9600', '2480', '3250', '6800', '2260', '1480', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY01026', '13111271394', '2014-12-19 15:25:19', '临汾货运平台', '2', 'uploads/6b48c1d759ee3b281796f62bab518f340', 'uploads/9428aeff7fbfd9755aafcda1d8e1ef2b0', 'uploads/0cb533014bebacb95d62ebd7d352a0d60', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('55', '', '临汾市', '襄汾县', '周晋凯', '周晋凯', '13663563351', 'LGAX5C644BL090490', '晋LA3713', '黄色', '重型自卸货车', '双机牌', 'AY3318VB3G', '31000', '16020', '--', '9600', '2480', '3250', '6800', '2260', '1480', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY01021', '13111276244', '2014-12-19 15:32:07', '临汾货运平台', '2', 'uploads/d2ce947401e18c55e5554e0dab49f05c0', 'uploads/39dada4a12b92d50b5457888165e7d020', 'uploads/e62c447701b57eb88f029772477a4d4a0', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('56', '', '临汾市', '襄汾县', '牛晋广', '牛晋广', '15834212106', 'LGHXPHFS8D7006853', '晋LB2568', '黄色', '重型自卸货车', '东风牌', 'EQ3312GF1', '31000', '16035', '--', '8950', '2480', '3300', '5950', '2300', '1400', '4', '12', '10.00R20', '', '', '', '', '', '', '', '', 'CY01063', '13111274765', '2014-12-19 15:13:32', '临汾货运平台', '2', 'uploads/75664b9c0407f297634282885b7d00660', 'uploads/a14258ebf9aeaca0dd135c94f075c3940', 'uploads/b7efac48617f7ff170d36baa33f249060', null, null, null, null, null, null, null, null, '没道路运输证号', '冀东启明');
INSERT INTO `rv_record` VALUES ('57', '14102311676', '临汾市', '襄汾县', '车志峰', '车志峰', '13835648885', 'LGAX4C646AL097894', '晋LB7088', '黄色', '重型自卸货车', '葛汽牌', 'CGQ3318G1', '31000', '16035', '--', '10290', '2500', '3300', '7600', '2300', '1419', '4', '12', '11.00R20', '', '', '', '', '', '', '', '', 'CY01029', '13111272421', '2014-12-19 15:18:38', '临汾货运平台', '2', 'uploads/815071ae1458385192827e2c754c4c8d0', 'uploads/8655b78b94f65abc98caea3886221e040', 'uploads/6165358906879716e9ae2d88030875160', null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('58', '14102311675', '临汾市', '襄汾县', '车志峰', '车志峰', '13835648885', 'LGAX4C646AL097913', '晋LB7188', '黄色', '重型自卸货车', '葛汽牌', 'CGQ3318G1', '31000', '16035', '--', '10290', '2500', '3300', '7600', '2300', '1419', '4', '12', '11.00R20', '', '', '', '分期付款', '', '', '', '', 'CY01079', '13111274184', '2014-12-23 11:40:02', '李四', '2', 'uploads/17c2abf5ef14575a861b705f2b43b66c0', 'uploads/897755ca5a1a0872855b0e332b13ad6c0', 'uploads/3ae0657d59971267e55851302aa67a980', null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('69', null, null, null, null, null, null, null, '晋K19726', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'uploads/e8d76dc2be6890ceb90f56ccd669fabc0', 'uploads/b3c1f39a5481d0004da93c7d46882f120', 'uploads/9ad2f5ea44aaecf8d54c5a091c22d0db0', null, null, null, null, null, null, null, null, null, '冀东启明');
INSERT INTO `rv_record` VALUES ('70', '1', '晋中市', '介休市', '曹忠虎', '曹忠虎', '18636088981', 'LGAX5DF42A3036562', '晋KF0701', '黄色', '重型自卸货车', '东风牌', 'DFL3311AX1A', '31000', '15925', '--', '9950', '2500', '3450', '--', '--', '--', '4', '', '', '', '', '', '分期付款', '', '', '', '', '3659964', '13653659964', '2014-12-23 11:48:50', '李四', null, 'uploads/bb04194fea7f6419d308ba93aae952e80', 'uploads/4202f8dced6dac40c164fde7e08806ba0', 'uploads/45ba6190ee9a377d53768da8c1ac71260', null, null, null, null, null, null, null, null, null, '冀东启明');

-- ----------------------------
-- Table structure for `rv_repair`
-- ----------------------------
DROP TABLE IF EXISTS `rv_repair`;
CREATE TABLE `rv_repair` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `company` varchar(100) NOT NULL COMMENT '公司名称',
  `carNum` varchar(10) NOT NULL COMMENT '车牌号',
  `model` varchar(50) NOT NULL COMMENT '型号',
  `chaidate` varchar(50) NOT NULL COMMENT '拆取日期',
  `changdate` varchar(50) default NULL COMMENT '返厂日期',
  `huidate` varchar(50) default NULL COMMENT '返回日期',
  `andate` varchar(50) default NULL COMMENT '安装日期',
  `baoxiuqi` varchar(50) NOT NULL COMMENT '是否过保修期',
  `jianxiufei` varchar(50) NOT NULL COMMENT '受否收取检修费',
  `chaipeople` varchar(50) NOT NULL COMMENT '拆取人',
  `beizhu` varchar(100) default NULL COMMENT '备注',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_repair
-- ----------------------------
INSERT INTO `rv_repair` VALUES ('1', '忻州运输公司', 'H12345', 'JG', '2014-08-20', '2014-09-02', '2014-09-25', '2014-10-29', '是', '否', '王飞', '安装备机', '冀东启明');
INSERT INTO `rv_repair` VALUES ('2', '利达', 'H123', 'G63', '2014-05-09', '2014-10-15', '2014-10-23', '2014-10-29', '是', '是', '广泛的', '国防观', '冀东启明');
INSERT INTO `rv_repair` VALUES ('3', 'gggg', '789', '32', '2014-10-08', '2014-10-08', '2014-10-07', '2014-10-22', '是', '是', '热瓦甫', '非违法', '冀东启明');
INSERT INTO `rv_repair` VALUES ('4', '忻州运输公司', 'H54321', 'JG', '2014-10-14', '2014-10-21', '2014-10-23', '2014-10-01', '否', '否', '范德萨', '改革和规范', '冀东启明');
INSERT INTO `rv_repair` VALUES ('5', '太原运输公司', '晋45612', '54', '2014-10-06', '2014-09-29', '2014-10-06', '2014-10-28', '否', '否', 'dtf ', '', '启明科技');
INSERT INTO `rv_repair` VALUES ('6', '刚好回家', '456', 'ui', '2014-10-14', '', '', '', '是', '否', 'kh', 'hkh,kiklyl', '启明科技');
INSERT INTO `rv_repair` VALUES ('7', '公分', '126', 'jion', '2014-07-03', '2014-08-06', '2014-08-06', '2014-09-10', '否', '不收', 'ncndfndg', '不V孤鸿寡鹄', '启明科技');

-- ----------------------------
-- Table structure for `rv_role`
-- ----------------------------
DROP TABLE IF EXISTS `rv_role`;
CREATE TABLE `rv_role` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `action` text NOT NULL,
  `company1` varchar(50) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of rv_role
-- ----------------------------
INSERT INTO `rv_role` VALUES ('1', '系统管理员', 'room,roomnew,roomadd,roomdel,roomedit,roomupdata,sort,sortnew,sortadd,sortdel,sortedit,sortupdata,feetype,feetypenew,feetypeadd,feetypedel,feetypeedit,feetypeupdata,product,productnew,productadd,productdel,productedit,productupdata,supplier,suppliernew,supplieradd,supplierdel,supplieredit,supplierupdata,company,companynew,companyadd,companydel,companyedit,companyupdata,simstate,simstatenew,simstateadd,simstatedel,simzifei,simzifeinew,simzifeiadd,simzifeidel,caigou,caigounew,caigouadd,storage_ru,storage_rusure,storage_chu,storage_chusure,diaobo,diaobonew,diaoboadd,diaoboagree,diaoboagreesure,storage,sim_sto,sim_stonew,sim_stoadd,sim_stodel,sim_stoedit,sim_stoupdata,detail,detailedit,detailupdata,detailprint,platform,platformnew,platformadd,platformdel,platformedit,platformupdata,carstate,carstatenew,carstateadd,carstatedel,carstateedit,carstateupdata,carleixing,carleixingnew,carleixingadd,carleixingdel,carleixingedit,carleixingupdata,car,carnew,caradd,cardel,caredit,carupdata,careditfuwufei,carupdatafuwufei,careditstop,carupdatastop,carsure,caredittransfer,carupdatatransfer,fenqicar,fenqicarnew,fenqicaradd,fenqicaredit,fenqicarupdata,fenqicarshow,fenqicarwarn,fenqicarprint,sim,simnew,simadd,simedit,simupdata,shenyan,shenyannewyun,shenyanaddyun,shenyannewche,shenyanaddche,shenyansureyun1,shenyansureche1,device,devicenew,deviceadd,deviceedit,deviceupdata,beiji,beijinew,beijiadd,beijiedit,beijiupdata,beijiprint,repair,repairnew,repairadd,repairedit,repairupdata,repairprint,carinfo,carinfoedit,carinfoupdata,carinfoprint,day,dayprint,week,weekprint,month,monthprint,year,yearprint,maintain,maintainnew,maintainadd,maintainedit,maintaindel,maintainupdata,maintainprint,sale,salenew,saleadd,fuwu,fuwunew,fuwuadd,finance,financesure,fuwucheck,fuwuchecksure,shencheck,shenchecksureyun1,shenchecksureyun2,shenchecksureche1,shenchecksureche2,cards,cardsdel,cardsedit,cardsupdata,cardsprint,weixiuproject,weixiuprojectnew,weixiuprojectadd,weixiuprojectdel,weixiuprojectedit,weixiuprojectupdata,outrepair,outrepairnew,outrepairadd,outrepairdel,outrepairedit,outrepairupdata,outrepairsure,weixiuresult,weixiuresultedit,weixiuresultupdata,tongji,tongjiprint,log,record,recordnew,recordadd,recorddel,recordedit,recordupdata,recordsure,recordshow,recordeditbeizhu,recordupdatabeizhu,user,usernew,useradd,useredit,usereditpass,userupdata,userupdatapass,userdel,role,rolenew,roleadd,roleedit,roleupdata,roledel,company1,company1new,company1add,company1edit,company1updata,company1del,config,confignew,configadd,configedit,configupdata,configdel,datalist,databackupupdata,datarecoverupdata', '冀东启明');
INSERT INTO `rv_role` VALUES ('2', '维护经理', 'info,infonew,infoadd,infoedit,infoupdata,infodel,infoshow,sell,sellnew,selladd,dailyedit,dailyupdata,doc,docupload,docnew,docadd,docedit,docupdata,docshow,note,notenew,noteadd,noteedit,noteupdata,notedel,tel,telnew,teladd,teledit,telupdata,reportt1,reportt1t,reportt2,reportt2t,reportt3,reportt3t,user,usernew,useradd,useredit,usereditpass,userupdata,userupdatapass,userdel,confignew,configadd,configedit,configupdata', '');
INSERT INTO `rv_role` VALUES ('3', '维护', 'info,infonew,infoadd,infoedit,infoupdata,infoshow,sell,sellnew,selladd,doc,docupload,docshow,note,notenew,noteadd,noteedit,noteupdata,notedel,tel,telnew,teladd', '');
INSERT INTO `rv_role` VALUES ('4', '123', 'info,infonew,infomap,infoadd,infoedit,infoupdata,infodel,infoshow', '');
INSERT INTO `rv_role` VALUES ('5', 'admin', 'room,roomnew', '');
INSERT INTO `rv_role` VALUES ('6', '普通成员', 'info,infoedit,room,roomnew,roomadd,roomedit', '冀东启明科技有限');
INSERT INTO `rv_role` VALUES ('7', '475', 'infonew,infoupdata', '');
INSERT INTO `rv_role` VALUES ('8', 'kjkj,khj', 'infoupdata,sell,daily', '冀东启明科技有限公司');
INSERT INTO `rv_role` VALUES ('9', '4536', 'infonew', '冀东启明科技有限公司');

-- ----------------------------
-- Table structure for `rv_room`
-- ----------------------------
DROP TABLE IF EXISTS `rv_room`;
CREATE TABLE `rv_room` (
  `id` int(11) NOT NULL auto_increment COMMENT '文档ID',
  `name` varchar(20) NOT NULL COMMENT '品牌名',
  `address` varchar(50) NOT NULL COMMENT '地址',
  `company1` varchar(100) NOT NULL COMMENT '公司',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_room
-- ----------------------------
INSERT INTO `rv_room` VALUES ('1', '1号仓库', '太原', '冀东启明科技有限公司');
INSERT INTO `rv_room` VALUES ('27', '2号仓库', '忻州', '冀东启明科技有限公司');
INSERT INTO `rv_room` VALUES ('30', '3号仓库', '忻州', '冀东启明科技有限公司');
INSERT INTO `rv_room` VALUES ('31', '4号仓库', '忻州', '冀东启明科技有限公司');
INSERT INTO `rv_room` VALUES ('33', '5号仓库', '太原', '冀东启明科技有限公司');
INSERT INTO `rv_room` VALUES ('34', '6号仓库', '太原', '冀东启明科技有限公司');
INSERT INTO `rv_room` VALUES ('35', '忻州库房', '忻州', '太原科技有限公司');
INSERT INTO `rv_room` VALUES ('36', '太原库房', '太原', '太原科技有限公司');
INSERT INTO `rv_room` VALUES ('37', '忻州库房', '忻州市 ', '冀东启明');
INSERT INTO `rv_room` VALUES ('38', '太原库房', '太原市 ', '冀东启明');
INSERT INTO `rv_room` VALUES ('39', '太原库房', '太原', '启明科技');
INSERT INTO `rv_room` VALUES ('40', '忻州库房', '忻州市', '启明科技');
INSERT INTO `rv_room` VALUES ('41', 'asad', 'dsad', '');
INSERT INTO `rv_room` VALUES ('42', '1', '1', '');
INSERT INTO `rv_room` VALUES ('43', '7', '7', '');
INSERT INTO `rv_room` VALUES ('44', '6', '6', '');
INSERT INTO `rv_room` VALUES ('45', '5', '5', '');
INSERT INTO `rv_room` VALUES ('46', 'gcj', 'jgc', '');
INSERT INTO `rv_room` VALUES ('47', '1', '1', '冀东启明');
INSERT INTO `rv_room` VALUES ('48', '32', '32', '456');

-- ----------------------------
-- Table structure for `rv_sell`
-- ----------------------------
DROP TABLE IF EXISTS `rv_sell`;
CREATE TABLE `rv_sell` (
  `id` int(11) NOT NULL auto_increment COMMENT '拜访ID',
  `infoid` int(11) NOT NULL COMMENT '拜访客户',
  `intro` text NOT NULL COMMENT '拜访描述',
  `sellproduct` varchar(200) NOT NULL COMMENT '登记产品',
  `sellvol` varchar(200) NOT NULL COMMENT '本次销量',
  `filename` varchar(40) default NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime default NULL,
  `salesid` int(11) NOT NULL COMMENT '用户ID',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of rv_sell
-- ----------------------------
INSERT INTO `rv_sell` VALUES ('11', '81', '123', '23', '0', null, '2014-07-17 11:41:00', null, '1', '');
INSERT INTO `rv_sell` VALUES ('12', '81', '', '23', '5', null, '2014-07-17 11:41:49', null, '1', '');

-- ----------------------------
-- Table structure for `rv_shenyan`
-- ----------------------------
DROP TABLE IF EXISTS `rv_shenyan`;
CREATE TABLE `rv_shenyan` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `carId` int(11) default NULL COMMENT '车辆ID',
  `yundate` date default NULL COMMENT '运管审验日',
  `yunNum` varchar(20) default NULL COMMENT '运管不干胶',
  `yunmoney` decimal(20,2) default NULL COMMENT '运管金额',
  `yundanhao` int(20) default NULL COMMENT '运管单号',
  `chedate` date default NULL COMMENT '车管审验日',
  `cheNum` varchar(20) default NULL COMMENT '车管不干胶',
  `chemoney` decimal(20,2) default NULL COMMENT '车管金额',
  `chedanhao` int(20) default NULL COMMENT '车管单号',
  `nameshen` varchar(50) default NULL COMMENT '审核人',
  `checkpeople` varchar(50) default NULL COMMENT '出纳核对人员',
  `judgeyun` int(5) default NULL COMMENT '1:出纳核对，2:打印票据，3:审核，4:打印单据',
  `judgeche` int(5) default NULL COMMENT '1:出纳核对，2:打印票据，3:审核，4:打印单据',
  `judgepryun` int(5) default NULL COMMENT '2:打印运管收据',
  `judgeprche` int(5) default NULL COMMENT '2打印车管收据',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`),
  KEY `34` (`carId`),
  CONSTRAINT `34` FOREIGN KEY (`carId`) REFERENCES `rv_car` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_shenyan
-- ----------------------------
INSERT INTO `rv_shenyan` VALUES ('1', '42', '2014-12-08', null, '500.00', '351000001', null, null, null, null, null, '李四', '3', null, '2', null, '启明科技');
INSERT INTO `rv_shenyan` VALUES ('2', '43', null, null, null, null, '2014-12-09', null, '260.00', '351000001', null, '李四', null, '3', null, '2', '启明科技');

-- ----------------------------
-- Table structure for `rv_sim`
-- ----------------------------
DROP TABLE IF EXISTS `rv_sim`;
CREATE TABLE `rv_sim` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `carId` int(11) NOT NULL COMMENT '车辆ID',
  `simNum` varchar(20) NOT NULL COMMENT 'sim卡号',
  `zifei` varchar(20) default NULL COMMENT 'SIM卡资费',
  `zichangedate` varchar(20) default NULL COMMENT '资费变更日期',
  `simstateId` int(11) NOT NULL COMMENT 'sim卡状态',
  `changedate` varchar(20) default NULL COMMENT '卡状态变更日期',
  `beizhu` varchar(100) default NULL,
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`),
  KEY `a` (`carId`),
  CONSTRAINT `32` FOREIGN KEY (`carId`) REFERENCES `rv_car` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of rv_sim
-- ----------------------------
INSERT INTO `rv_sim` VALUES ('1', '43', '15241241241', '10元', null, '4', null, '', '启明科技');

-- ----------------------------
-- Table structure for `rv_simstate`
-- ----------------------------
DROP TABLE IF EXISTS `rv_simstate`;
CREATE TABLE `rv_simstate` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `simstate` varchar(20) NOT NULL COMMENT 'sim卡状态',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_simstate
-- ----------------------------
INSERT INTO `rv_simstate` VALUES ('1', '正常', '冀东启明');
INSERT INTO `rv_simstate` VALUES ('2', '报停', '冀东启明');
INSERT INTO `rv_simstate` VALUES ('3', '复话', '冀东启明');
INSERT INTO `rv_simstate` VALUES ('4', '正常', '启明科技');
INSERT INTO `rv_simstate` VALUES ('5', '报停', '启明科技');

-- ----------------------------
-- Table structure for `rv_simzifei`
-- ----------------------------
DROP TABLE IF EXISTS `rv_simzifei`;
CREATE TABLE `rv_simzifei` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `zifei` varchar(20) NOT NULL COMMENT '资费',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_simzifei
-- ----------------------------
INSERT INTO `rv_simzifei` VALUES ('4', '0元', '启明科技');
INSERT INTO `rv_simzifei` VALUES ('5', '5元', '启明科技');
INSERT INTO `rv_simzifei` VALUES ('6', '10元', '启明科技');

-- ----------------------------
-- Table structure for `rv_sim_sto`
-- ----------------------------
DROP TABLE IF EXISTS `rv_sim_sto`;
CREATE TABLE `rv_sim_sto` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `tmobile` varchar(50) NOT NULL COMMENT '运营商',
  `cardnum` varchar(12) NOT NULL COMMENT '卡号',
  `simstateId` int(11) NOT NULL COMMENT '卡状态',
  `zifei` varchar(10) NOT NULL COMMENT '资费',
  `time` datetime NOT NULL COMMENT '录入时间',
  `inputer` varchar(20) NOT NULL COMMENT '操作者',
  `company1` varchar(50) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_sim_sto
-- ----------------------------
INSERT INTO `rv_sim_sto` VALUES ('1', '移动', '1524825623', '5', '15', '2014-11-24 14:57:51', '', '启明科技');
INSERT INTO `rv_sim_sto` VALUES ('2', '', '111111111111', '4', '5元', '2014-12-09 11:09:26', '李四', '启明科技');
INSERT INTO `rv_sim_sto` VALUES ('3', '移动', '12111111111', '4', '5元', '2014-12-16 12:10:00', '李四', '启明科技');

-- ----------------------------
-- Table structure for `rv_sort`
-- ----------------------------
DROP TABLE IF EXISTS `rv_sort`;
CREATE TABLE `rv_sort` (
  `id` int(11) NOT NULL auto_increment COMMENT '文档ID',
  `category` varchar(20) NOT NULL COMMENT '类别',
  `terminal` varchar(20) NOT NULL COMMENT '是否属于终端',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_sort
-- ----------------------------
INSERT INTO `rv_sort` VALUES ('1', 'SIM卡', '是', '冀东启明科技有限公司');
INSERT INTO `rv_sort` VALUES ('6', '车载设备', '是', '冀东启明科技有限公司');
INSERT INTO `rv_sort` VALUES ('8', '服务', '否', '冀东启明科技有限公司');
INSERT INTO `rv_sort` VALUES ('9', '摄像头', '是', '冀东启明科技有限公司');
INSERT INTO `rv_sort` VALUES ('10', '监控设备', '是', '太原科技有限公司');
INSERT INTO `rv_sort` VALUES ('11', '办公用品', '否', '太原科技有限公司');
INSERT INTO `rv_sort` VALUES ('12', '终端', '是', '冀东启明');
INSERT INTO `rv_sort` VALUES ('13', '天线', '否', '冀东启明');
INSERT INTO `rv_sort` VALUES ('14', '终端', '是', '启明科技');
INSERT INTO `rv_sort` VALUES ('15', '监控设备', '否', '启明科技');

-- ----------------------------
-- Table structure for `rv_storage`
-- ----------------------------
DROP TABLE IF EXISTS `rv_storage`;
CREATE TABLE `rv_storage` (
  `id` int(11) NOT NULL auto_increment,
  `productId` int(11) NOT NULL COMMENT '商品Id',
  `model` varchar(11) default NULL COMMENT '商品型号',
  `quantity` int(11) NOT NULL COMMENT '数量',
  `supplierId` int(11) NOT NULL COMMENT '供应商ID',
  `roomId` int(11) NOT NULL COMMENT '仓库Id',
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP COMMENT '日期',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_storage
-- ----------------------------
INSERT INTO `rv_storage` VALUES ('50', '5', '32G', '10', '1', '1', '2014-09-30 16:53:09', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('51', '5', '32G', '2', '1', '27', '2014-10-10 10:47:12', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('52', '5', '32G', '142', '2', '27', '2014-10-08 10:03:42', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('53', '5', '16G', '0', '2', '27', '2014-09-29 12:03:58', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('54', '5', '32G', '1', '1', '30', '2014-09-29 15:09:56', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('55', '5', '16G', '0', '2', '1', '2014-09-29 14:17:05', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('56', '5', '16G', '12', '1', '1', '2014-09-30 16:34:52', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('57', '5', '16G', '2', '1', '30', '2014-09-29 15:34:57', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('58', '5', '16G', '1', '1', '27', '2014-09-29 16:26:01', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('59', '5', '32G', '70', '2', '0', '2014-09-29 18:09:12', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('60', '5', '32G', '41', '2', '1', '2014-10-08 11:12:32', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('61', '5', '32G', '1', '2', '30', '2014-09-30 16:53:13', '冀东启明科技有限公司');
INSERT INTO `rv_storage` VALUES ('67', '8', '500W', '15', '8', '36', '2014-10-13 11:01:18', '太原科技有限公司');
INSERT INTO `rv_storage` VALUES ('68', '8', '500W', '3', '8', '35', '2014-10-14 09:15:53', '太原科技有限公司');
INSERT INTO `rv_storage` VALUES ('69', '11', 'VA-8B', '49', '10', '37', '2014-10-14 16:29:19', '冀东启明');
INSERT INTO `rv_storage` VALUES ('70', '13', 'JGN', '200', '11', '39', '2014-11-20 14:09:47', '启明科技');
INSERT INTO `rv_storage` VALUES ('72', '12', 'RMT', '0', '12', '39', '2014-11-07 09:21:52', '启明科技');
INSERT INTO `rv_storage` VALUES ('73', '13', 'JGN', '3', '11', '40', '2014-11-20 13:58:19', '启明科技');

-- ----------------------------
-- Table structure for `rv_storage_chu`
-- ----------------------------
DROP TABLE IF EXISTS `rv_storage_chu`;
CREATE TABLE `rv_storage_chu` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `productId` int(11) default NULL,
  `model` varchar(11) default NULL COMMENT '型号',
  `carNum` varchar(10) default NULL COMMENT '车牌号',
  `quantity` int(11) NOT NULL,
  `outprice` decimal(20,2) default NULL COMMENT '��Ʒ�ۼ�',
  `supplierId` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `time` varchar(20) default NULL COMMENT '销售日期',
  `shouquantity` int(11) default '0' COMMENT '收款数量',
  `inputer` varchar(20) NOT NULL COMMENT '������',
  `financeName` varchar(20) default NULL,
  `kuguanName` varchar(20) default NULL,
  `judge` int(5) NOT NULL COMMENT '判断经手人员是谁',
  `leixing` int(5) NOT NULL COMMENT '1为销售，2为调拨',
  `checktime` varchar(20) default NULL COMMENT '出纳核对时间',
  `chutime` varchar(20) default NULL COMMENT '出库时间',
  `danhao` int(20) NOT NULL default '0' COMMENT '单号',
  `diaojudge` int(5) default '0' COMMENT '调拨经确认后才能在出库表中显示，即diaojudge=2',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of rv_storage_chu
-- ----------------------------
INSERT INTO `rv_storage_chu` VALUES ('4', '5', '32G', '1424', '2', '58.00', '1', '1', '2014-09-30 11:45:01', '2', 'admin', null, null, '3', '1', null, null, '351000001', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_chu` VALUES ('40', '5', '32G', '1424', '1', '1.00', '2', '1', '2014-10-08 09:39:23', '1', 'admin', null, null, '3', '1', null, null, '351000002', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_chu` VALUES ('41', '5', '32G', '1424', '1', '1.00', '2', '1', '2014-09-30 12:03:27', '1', 'admin', null, null, '3', '1', null, null, '351000003', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_chu` VALUES ('42', '5', '32G', '1424', '2', '2424.00', '2', '1', '2014-10-08 09:43:32', '2', 'admin', 'admin', 'admin', '3', '1', null, null, '351000004', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_chu` VALUES ('43', '5', '32G', '1424', '2', '144.00', '2', '1', '2014-10-08 11:12:31', '2', '', '', 'test2', '3', '1', null, null, '351000005', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_chu` VALUES ('44', '5', '32G', '1424', '2', '22.00', '2', '1', '2014-10-08 09:56:35', '2', '', null, null, '1', '1', null, null, '351000006', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_chu` VALUES ('45', '5', '32G', '1424', '2', '222.00', '2', '1', '2014-10-08 09:58:49', '2', 'admin', 'test2', 'test2', '3', '1', null, null, '351000007', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_chu` VALUES ('48', '8', '500W', '741', '2', '200.00', '8', '35', '2014-10-14 09:15:52', '2', '于工', '于工', '于工', '3', '1', null, null, '351000001', null, '太原科技有限公司');
INSERT INTO `rv_storage_chu` VALUES ('49', '11', 'VA-8B', 'H123', '1', '1500.00', '10', '37', '2014-10-14 16:29:18', '1', '小于', '小于', '小于', '3', '1', null, null, '351000001', null, '冀东启明');
INSERT INTO `rv_storage_chu` VALUES ('50', '13', 'JGN', '晋45612', '1', '100.00', '11', '39', '2014-11-07 10:08:35', '1', '李四', '李四', null, '2', '1', '2014-11-07 10:08:35', null, '351000001', null, '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('51', '13', 'JGN', null, '1', null, '11', '39', '2014-10-29 16:45:12', '0', '李四', null, '李四', '3', '2', null, null, '0', '2', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('52', '13', 'JGN', null, '1', null, '11', '39', '2014-10-29 16:45:16', '0', '李四', null, '李四', '3', '2', null, null, '0', '2', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('53', '13', 'JGN', '963', '1', '800.00', '11', '39', '2014-10-31 10:47:27', '1', '', '李四', '李四', '3', '3', null, null, '0', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('54', '13', 'JGN', '963', '1', '100.00', '11', '39', '2014-10-31 11:08:18', '1', '', '李四', '李四', '3', '3', null, null, '0', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('55', '13', 'JGN', '963', '1', '22.00', '11', '39', '2014-11-07 10:08:56', '1', '', '李四', '李四', '3', '3', null, '2014-11-07 10:08:56', '0', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('56', '13', 'JGN', '963', '1', '6.00', '11', '39', '2014-11-07 09:34:20', '1', '', '李四', '李四', '3', '3', null, '2014-11-07 09:34:20', '0', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('57', '13', 'JGN', '963', '1', '3.00', '11', '39', '2014-10-31 13:49:37', '1', '', '李四', '李四', '3', '3', null, null, '0', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('58', '13', 'JGN', '963', '1', '9.00', '11', '39', '2014-10-31 13:54:35', '1', '', '李四', '李四', '3', '3', null, null, '0', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('59', '13', 'JGN', '963', '1', '1.00', '11', '39', '2014-10-31 13:59:47', '1', '', '李四', '李四', '3', '3', null, null, '0', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('60', '13', 'JGN', '963', '1', '6.00', '11', '39', '2014-10-31 15:51:56', '1', '', '李四', '李四', '3', '3', null, null, '351000002', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('61', '13', 'JGN', '258', '1', '200.00', '11', '39', '2014-11-07 09:33:23', '1', '', '李四', '李四', '3', '3', '2014-11-07 09:30:37', null, '351000003', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('62', '12', 'RMT', '678', '1', '100.00', '12', '39', '2014-11-07 09:21:52', '1', '', '李四', '李四', '3', '3', null, null, '351000004', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('63', '12', 'RMT', '678', '1', '200.00', '12', '39', '2014-11-07 11:41:07', '1', '', '李四', null, '2', '3', '2014-11-07 11:41:07', null, '351000005', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('64', '13', 'JGN', '999', '1', '8.00', '11', '39', '2014-11-07 12:06:17', '1', '', null, null, '1', '3', null, null, '351000006', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('65', '13', 'JGN', '999', '1', '1.00', '11', '39', '2014-11-07 12:07:18', '1', '', null, null, '1', '3', null, null, '351000007', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('66', '13', 'JGN', null, '1', null, '11', '40', '2014-11-20 13:58:19', '0', '李四', null, '李四', '3', '2', null, '2014-11-20 13:58:19', '0', '2', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('67', '13', 'JGN', '晋H78452', '6', '222.00', '11', '39', '2014-11-20 14:06:10', '6', '李四', '李四', '李四', '3', '1', '2014-11-20 14:06:10', '2014-11-20 14:09:47', '351000008', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('68', '13', 'JGN', '晋H78452', '1', '111.00', '11', '39', null, '1', '', null, null, '1', '3', null, null, '351000009', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('69', '13', 'JGN', '晋H78452', '1', '789.00', '11', '39', null, '1', '', null, null, '1', '3', null, null, '351000010', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('70', '13', 'JGN', '678', '1', '57.00', '11', '40', null, '1', '', null, null, '1', '3', null, null, '351000011', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('71', '13', 'JGN', '晋H45263', '1', '999.00', '11', '40', null, '1', '', null, null, '1', '3', null, null, '351000012', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('72', '13', 'JGN', '147', '1', '65.00', '11', '39', null, '1', '', null, null, '1', '3', null, null, '351000013', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('73', '13', 'JGN', '晋H45263', '1', '222.00', '11', '39', null, '1', '', null, null, '1', '3', null, null, '351000014', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('74', '13', 'JGN', '678', '1', '87.00', '11', '39', null, '1', '', null, null, '1', '3', null, null, '351000015', '0', '启明科技');
INSERT INTO `rv_storage_chu` VALUES ('75', '13', 'JGN', '晋H12312(2G', '1', '800.00', '11', '39', null, '1', '', null, null, '1', '3', null, null, '351000016', '0', '启明科技');

-- ----------------------------
-- Table structure for `rv_storage_ru`
-- ----------------------------
DROP TABLE IF EXISTS `rv_storage_ru`;
CREATE TABLE `rv_storage_ru` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `productId` int(11) NOT NULL COMMENT '物品ID',
  `model` varchar(11) default NULL COMMENT '商品型号',
  `quantity` int(11) NOT NULL COMMENT '数量',
  `inprice` decimal(20,2) default NULL COMMENT '物品进价',
  `supplierId` int(11) NOT NULL COMMENT '供货商',
  `roomId` int(11) NOT NULL COMMENT '库房ID',
  `caigoutime` datetime NOT NULL COMMENT '采购时间',
  `rukutime` datetime default NULL COMMENT '入库时间',
  `inputer` varchar(20) NOT NULL COMMENT '采购者',
  `kuguanName` varchar(20) default NULL COMMENT '库管名称',
  `judge` int(5) NOT NULL COMMENT '1为采购商品，2为确认入库',
  `leixing` int(5) NOT NULL COMMENT '1为采购商品，2为调拨入库的商品',
  `diaojudge` int(5) default '0' COMMENT '调拨经确认后才能在入库表中显示即diaojudge=2',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of rv_storage_ru
-- ----------------------------
INSERT INTO `rv_storage_ru` VALUES ('161', '5', '32G', '14', '52.00', '1', '1', '0000-00-00 00:00:00', null, 'admin', null, '0', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('162', '5', '32G', '11', '25.00', '1', '27', '0000-00-00 00:00:00', null, 'admin', null, '0', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('163', '5', '32G', '10', '25.00', '2', '27', '0000-00-00 00:00:00', null, 'admin', null, '0', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('164', '5', '16G', '10', '25.00', '2', '27', '0000-00-00 00:00:00', null, 'admin', null, '0', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('165', '5', '16G', '10', '10.00', '1', '1', '0000-00-00 00:00:00', null, 'admin', null, '0', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('166', '5', '32G', '42', '58.00', '2', '27', '0000-00-00 00:00:00', null, 'admin', 'test2', '2', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('167', '5', '32G', '42', '58.00', '2', '27', '0000-00-00 00:00:00', null, 'admin', null, '2', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('168', '5', '32G', '42', '58.00', '2', '27', '0000-00-00 00:00:00', null, 'admin', null, '2', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('169', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('170', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('171', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('172', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('173', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('174', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('175', '5', '32G', '10', null, '2', '1', '2018-09-12 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('176', '5', '32G', '10', null, '2', '1', '2018-04-12 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('177', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('178', '5', '32G', '10', null, '2', '1', '2018-07-23 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('179', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('180', '5', '32G', '10', null, '2', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('181', '5', '16G', '10', '20.00', '1', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '0', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('182', '5', '32G', '10', '10.00', '1', '1', '0000-00-00 00:00:00', null, 'admin', null, '2', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('183', '5', '32G', '1', null, '2', '30', '0000-00-00 00:00:00', null, 'admin', null, '2', '2', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('184', '5', '32G', '2', '2.00', '1', '27', '0000-00-00 00:00:00', null, 'admin', '郝', '2', '1', null, '冀东启明科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('191', '8', '500W', '10', '100.00', '8', '35', '0000-00-00 00:00:00', null, '于工', '于工', '2', '1', null, '太原科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('192', '8', '500W', '10', '100.00', '8', '36', '0000-00-00 00:00:00', null, '于工', '于工', '2', '1', null, '太原科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('193', '8', '500W', '5', null, '8', '36', '2011-01-18 00:00:00', null, '于工', '于工', '2', '2', null, '太原科技有限公司');
INSERT INTO `rv_storage_ru` VALUES ('194', '11', 'VA-8B', '50', '400.00', '10', '37', '0000-00-00 00:00:00', null, '小于', '小于', '2', '1', null, '冀东启明');
INSERT INTO `rv_storage_ru` VALUES ('195', '13', 'JGN', '10', '100.00', '11', '39', '0000-00-00 00:00:00', null, '李四', '李四', '2', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('196', '12', 'all', '15', '20.00', '11', '39', '0000-00-00 00:00:00', '2014-10-22 10:11:08', '李四', '李四', '2', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('197', '13', 'JGN', '1', '100.00', '12', '40', '0000-00-00 00:00:00', null, '李四', null, '1', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('198', '13', 'JGN', '1', '10.00', '11', '39', '2010-07-24 00:00:00', null, '李四', null, '1', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('199', '13', 'JGN', '5', '20.00', '11', '39', '2014-10-22 10:08:42', '2014-10-22 10:11:30', '李四', '李四', '2', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('200', '12', 'RMT', '1', '21.00', '12', '39', '2014-10-22 14:57:26', '2014-10-22 14:57:41', '李四', '李四', '2', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('201', '12', 'all', '1', '1.00', '0', '0', '2014-10-22 14:58:34', null, '李四', null, '1', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('202', '13', 'all', '1', '1.00', '0', '0', '2014-10-22 16:43:26', null, '李四', null, '1', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('203', '13', 'all', '1', '20.00', '0', '0', '2014-10-23 09:12:16', null, '李四', null, '1', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('204', '13', 'all', '4', '4.00', '0', '0', '2014-10-23 09:33:34', null, '李四', null, '1', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('205', '12', '', '1', '1.00', '0', '0', '2014-10-23 09:47:12', null, '李四', null, '1', '1', null, '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('206', '13', 'JGN', '1', null, '11', '40', '0000-00-00 00:00:00', '2014-11-07 11:40:01', '李四', '李四', '2', '2', '2', '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('207', '13', 'JGN', '1', null, '11', '40', '0000-00-00 00:00:00', '2014-10-29 17:20:58', '李四', '李四', '2', '2', '2', '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('208', '13', 'JGN', '101', '20.00', '11', '39', '2014-11-06 16:18:42', '2014-11-06 16:19:39', '李四', '李四', '2', '1', '0', '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('209', '13', 'JGN', '100', '50.00', '11', '39', '2014-11-20 09:51:30', '2014-11-20 13:59:21', '李四', '李四', '2', '1', '0', '启明科技');
INSERT INTO `rv_storage_ru` VALUES ('210', '13', 'JGN', '1', null, '11', '39', '0000-00-00 00:00:00', '2014-11-20 13:58:52', '李四', '李四', '2', '2', '2', '启明科技');

-- ----------------------------
-- Table structure for `rv_supplier`
-- ----------------------------
DROP TABLE IF EXISTS `rv_supplier`;
CREATE TABLE `rv_supplier` (
  `id` int(11) NOT NULL auto_increment COMMENT '文档ID',
  `name` varchar(20) NOT NULL COMMENT '供应商名称',
  `linkman` varchar(20) NOT NULL COMMENT '联系人',
  `address` varchar(100) NOT NULL COMMENT '地址',
  `phone` varchar(20) NOT NULL COMMENT '联系电话',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_supplier
-- ----------------------------
INSERT INTO `rv_supplier` VALUES ('1', '东运', '张三', '陕西', '15426397842', '冀东启明科技有限公司');
INSERT INTO `rv_supplier` VALUES ('2', '国脉', '李四', '杭州', '18653249745', '冀东启明科技有限公司');
INSERT INTO `rv_supplier` VALUES ('5', '雅讯', '于工', '厦门', '15423698758', '冀东启明科技有限公司');
INSERT INTO `rv_supplier` VALUES ('6', 'fds', 'gfs', 'fs', 'gfs', '冀东启明科技有限公司');
INSERT INTO `rv_supplier` VALUES ('7', 'hgf ', 'hf', 'hhhhhhhhhh', 'hg', '冀东启明科技有限公司');
INSERT INTO `rv_supplier` VALUES ('8', '东运', '张三', '深圳', '12563256321', '太原科技有限公司');
INSERT INTO `rv_supplier` VALUES ('9', '国脉', '李四', '厦门', '15623456235', '太原科技有限公司');
INSERT INTO `rv_supplier` VALUES ('10', '国脉畅行信息技术有限公司', '小周', '深圳市', '0755-89564123', '冀东启明');
INSERT INTO `rv_supplier` VALUES ('11', '国脉畅行信息科技有限公司', '小王', '深圳市', '14251256235', '启明科技');
INSERT INTO `rv_supplier` VALUES ('12', '深圳东运科技有限公司', '小张', '深圳市', '15623562356', '启明科技');

-- ----------------------------
-- Table structure for `rv_tel`
-- ----------------------------
DROP TABLE IF EXISTS `rv_tel`;
CREATE TABLE `rv_tel` (
  `id` int(11) NOT NULL auto_increment COMMENT '电话ID',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `number` varchar(20) NOT NULL COMMENT '号码',
  `department` varchar(20) NOT NULL COMMENT '部门',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime default NULL COMMENT '更新时间',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_tel
-- ----------------------------
INSERT INTO `rv_tel` VALUES ('1', '于惊涛', '13803468273', '网络技术', '2014-06-27 09:57:49', null, '');

-- ----------------------------
-- Table structure for `rv_tongji`
-- ----------------------------
DROP TABLE IF EXISTS `rv_tongji`;
CREATE TABLE `rv_tongji` (
  `id` int(11) NOT NULL auto_increment COMMENT 'ID',
  `biaoshi` varchar(30) default NULL COMMENT '标识是新安还是审验等',
  `name` varchar(30) NOT NULL COMMENT '名称',
  `quantity` int(11) default NULL COMMENT '数量',
  `money` decimal(20,2) default NULL COMMENT '金额',
  `date` date NOT NULL COMMENT '日期',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_tongji
-- ----------------------------
INSERT INTO `rv_tongji` VALUES ('1', '审验', '货车', '2', '880.00', '2014-09-14', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('2', '审验', '客车', '7', '1423.00', '2014-09-15', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('3', '审验', '货车', '1', '980.00', '2014-09-16', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('4', '审验', '客车', '8', '1643.00', '2014-08-06', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('6', '审验', '货车', '1', '500.00', '2014-09-21', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('7', '审验', '县乡', '5', '236.00', '2014-09-15', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('13', '新安', '客车', '9', '799.00', '2014-10-23', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('15', '车管维护', '县乡', '1', '15.00', '2014-09-15', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('16', '新安', '客车', '9', '879.00', '2014-09-16', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('17', '配件销售', '', '10', '10.00', '2014-09-16', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('18', '费用', '超费', '2', '26.00', '2014-09-17', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('19', '费用', '检修费', '1', '10.00', '2014-09-17', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('20', '配件销售', 'U盘', '36', '6306.00', '2013-01-17', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('21', '新增', '校车', '1', '0.00', '2014-09-25', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('22', '配件销售', 'U盘', '37', '6361.00', '2014-09-25', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('23', '新增', '客车', '1', '0.00', '2014-09-26', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('24', '配件销售', 'U盘', '39', '6321.00', '2014-09-26', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('25', '新安', '客车', '9', '1254.00', '2014-09-26', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('26', '费用', '检修费', '1', '441.00', '2014-09-26', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('27', '配件销售', 'U盘', '37', '6421.00', '2014-09-28', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('28', '新安', '客车', '9', '922.00', '2014-09-28', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('29', '车管维护', '客车', '9', '532.00', '2014-09-28', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('30', '配件销售', 'U盘', '36', '6319.00', '2014-09-29', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('31', '配件销售', 'U盘', '17', '6581.00', '2014-09-30', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('32', '车管维护', '客车', '9', '81.00', '2014-09-30', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('33', '新安', '客车', '9', '846.00', '2014-09-30', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('34', '运管维护', '客车', '4', '167.00', '2014-09-30', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('35', '费用', '卡费', '1', '14.00', '2014-09-30', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('36', '配件销售', 'U盘', '7', '5581.00', '2014-10-08', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('37', '运管维护', '客车', '1', '100.00', '2014-10-09', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('38', '车管维护', '客车', '1', '400.00', '2014-10-09', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('39', '新安', '县乡', '1', '800.00', '2014-10-09', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('40', '车管维护', '县乡', '1', '800.00', '2014-10-09', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('41', '费用', '押金', '1', '100.00', '2014-10-10', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('42', '运管维护', '县乡', '1', '544.00', '2014-10-10', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('43', '车管维护', '县乡', '1', '1444.00', '2014-10-10', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('44', '新安', '校车', '1', '980.00', '2014-10-11', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('45', '车管维护', '校车', '3', '400.00', '2014-10-11', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('46', '运管维护', '客车', '1', '-500.00', '2014-10-13', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('47', '新安', '校车', '2', '1000.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('48', '车管维护', '校车', '2', '350.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('49', '运管维护', '校车', '3', '-300.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('50', '新安', '客车', '5', '3060.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('51', '车管维护', '客车', '6', '1480.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('52', '运管维护', '客车', '5', '-320.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('53', '新安', '货车', '2', '1300.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('54', '车管维护', '货车', '2', '100.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('55', '新安', '县乡', '2', '1400.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('56', '运管维护', '县乡', '2', '-300.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('57', '运管维护', '货车', '6', '300.00', '2014-10-13', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('58', '新安', '校车', '1', '400.00', '2014-10-13', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('59', '车管维护', '校车', '3', '1100.00', '2014-10-13', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('60', '运管维护', '校车', '2', '800.00', '2014-10-16', '冀东启明科技有限公司');
INSERT INTO `rv_tongji` VALUES ('61', '车管维护', '县乡', '1', '200.00', '2014-10-16', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('62', '配件销售', '摄像头', '2', '400.00', '2014-10-14', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('63', '费用', '检修费', '1', '50.00', '2014-10-16', '太原科技有限公司');
INSERT INTO `rv_tongji` VALUES ('64', '新安', '长途客车', '1', '960.00', '2014-10-15', '冀东启明');
INSERT INTO `rv_tongji` VALUES ('65', '车管维护', '长途客车', '1', '0.00', '2014-10-16', '冀东启明');
INSERT INTO `rv_tongji` VALUES ('66', '新安', '县乡', '1', '0.00', '2014-10-16', '冀东启明');
INSERT INTO `rv_tongji` VALUES ('67', '配件销售', '汽车行驶记录仪', '1', '1500.00', '2014-10-16', '冀东启明');
INSERT INTO `rv_tongji` VALUES ('68', '费用', '检修费', '1', '111.00', '2014-10-17', '冀东启明');
INSERT INTO `rv_tongji` VALUES ('69', '运管维护', '县乡', '1', '120.00', '2014-10-20', '冀东启明');
INSERT INTO `rv_tongji` VALUES ('70', '费用', '卡费', '2', '10.00', '2014-10-23', '启明科技');
INSERT INTO `rv_tongji` VALUES ('71', '费用', '检修费', '3', '130.00', '2014-10-23', '启明科技');
INSERT INTO `rv_tongji` VALUES ('72', '新安', '县级客车', '1', '200.00', '2014-10-23', '启明科技');
INSERT INTO `rv_tongji` VALUES ('73', '车管维护', '县级客车', '1', '800.00', '2014-10-23', '启明科技');
INSERT INTO `rv_tongji` VALUES ('74', '运管维护', '', '1', '0.00', '2014-10-23', '启明科技');
INSERT INTO `rv_tongji` VALUES ('75', '新安', '不过V', '7', '1897.00', '2014-10-30', '启明科技');
INSERT INTO `rv_tongji` VALUES ('76', '新安', '货车', '5', '595.00', '2014-10-30', '启明科技');
INSERT INTO `rv_tongji` VALUES ('77', '运管维护', '货车', '3', '500.00', '2014-10-30', '启明科技');
INSERT INTO `rv_tongji` VALUES ('78', '新安', '客车', '4', '15.00', '2014-10-30', '启明科技');
INSERT INTO `rv_tongji` VALUES ('79', '运管维护', '客车', '3', '402.00', '2014-10-30', '启明科技');
INSERT INTO `rv_tongji` VALUES ('80', '车管维护', '客车', '1', '800.00', '2014-10-30', '启明科技');
INSERT INTO `rv_tongji` VALUES ('81', '新安', '货车', '2', '822.00', '2014-10-31', '启明科技');
INSERT INTO `rv_tongji` VALUES ('82', '配件销售', '摄像头', '1', '800.00', '2014-10-31', '启明科技');
INSERT INTO `rv_tongji` VALUES ('83', '重购', '货车', '6', '129.00', '2014-10-31', '启明科技');
INSERT INTO `rv_tongji` VALUES ('84', '车管维护', '货车', '1', '300.00', '2014-11-03', '启明科技');
INSERT INTO `rv_tongji` VALUES ('85', '运管维护', '校车', '1', '800.00', '2014-11-06', '启明科技');
INSERT INTO `rv_tongji` VALUES ('86', '车管维护', '校车', '1', '500.00', '2014-11-06', '启明科技');
INSERT INTO `rv_tongji` VALUES ('87', '新安', '长途客车', '1', '100.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('88', '新安', '', '1', '200.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('89', '重购', '货车', '2', '28.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('90', '费用', '检修费', '3', '530.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('91', '费用', '卡费', '2', '100.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('92', '车管维护', '校车', '1', '500.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('93', '运管维护', '货车', '1', '100.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('94', '车管维护', '货车', '1', '111.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('95', '运管维护', '长途客车', '1', '300.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('96', '车管维护', '长途客车', '1', '222.00', '2014-11-07', '启明科技');
INSERT INTO `rv_tongji` VALUES ('97', '运管维护', '县级客车', '1', '0.00', '2014-11-12', '启明科技');
INSERT INTO `rv_tongji` VALUES ('98', '运管维护', '客车', '2', '202.00', '2014-11-12', '启明科技');
INSERT INTO `rv_tongji` VALUES ('99', '运管维护', '长途客车', '1', '200.00', '2014-11-13', '启明科技');
INSERT INTO `rv_tongji` VALUES ('100', '配件销售', '摄像头', '6', '1332.00', '2014-11-20', '启明科技');
INSERT INTO `rv_tongji` VALUES ('101', '运管审验', '长途客车', '1', '500.00', '2014-12-08', '启明科技');
INSERT INTO `rv_tongji` VALUES ('102', '车管审验', '长途客车', '1', '260.00', '2014-12-09', '启明科技');

-- ----------------------------
-- Table structure for `rv_track`
-- ----------------------------
DROP TABLE IF EXISTS `rv_track`;
CREATE TABLE `rv_track` (
  `id` int(11) NOT NULL auto_increment,
  `longitude` varchar(10) NOT NULL COMMENT '经度',
  `latitude` varchar(10) NOT NULL COMMENT '纬度',
  `location` varchar(20) NOT NULL COMMENT '位置',
  `status` smallint(1) NOT NULL COMMENT '状态',
  `salesid` int(11) NOT NULL COMMENT '销售ID',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_track
-- ----------------------------

-- ----------------------------
-- Table structure for `rv_type`
-- ----------------------------
DROP TABLE IF EXISTS `rv_type`;
CREATE TABLE `rv_type` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(80) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime default NULL,
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_type
-- ----------------------------
INSERT INTO `rv_type` VALUES ('18', '公共文档', 'doctid', '2014-07-16 23:40:18', null, '');
INSERT INTO `rv_type` VALUES ('19', '培训资料', 'doctid', '2014-07-16 23:40:27', null, '');
INSERT INTO `rv_type` VALUES ('20', '忻运公司', 'typeid', '2014-07-16 23:40:42', '2014-07-17 12:33:35', '');
INSERT INTO `rv_type` VALUES ('26', '太原', 'areaid', '2014-08-04 19:56:29', null, '');
INSERT INTO `rv_type` VALUES ('22', '忻州', 'areaid', '2014-07-16 23:40:59', null, '');
INSERT INTO `rv_type` VALUES ('23', '更换设备', 'productid', '2014-07-16 23:41:20', '2014-07-17 11:57:45', '');
INSERT INTO `rv_type` VALUES ('24', '检修设备', 'productid', '2014-07-17 11:56:19', '2014-07-17 11:57:36', '');
INSERT INTO `rv_type` VALUES ('25', '安装设备', 'productid', '2014-07-17 11:57:27', null, '');

-- ----------------------------
-- Table structure for `rv_user`
-- ----------------------------
DROP TABLE IF EXISTS `rv_user`;
CREATE TABLE `rv_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `roleid` int(11) NOT NULL,
  `areaid` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime default NULL,
  `trueName` varchar(50) NOT NULL COMMENT '真实姓名',
  `company1` varchar(100) NOT NULL COMMENT '公司名称',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_user
-- ----------------------------
INSERT INTO `rv_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '22,26', '2014-06-19 11:20:44', '2014-10-09 16:12:06', '郝', '冀东启明科技有限公司');
INSERT INTO `rv_user` VALUES ('2', 'leader', 'c444858e0aaeb727da73d2eae62321ad', '2', '1,2,3,4', '2014-06-19 11:21:32', '2014-06-29 10:30:11', '', '冀东启明科技有限公司');
INSERT INTO `rv_user` VALUES ('3', 'test', '098f6bcd4621d373cade4e832627b4f6', '3', '1,2,3,4', '2014-06-20 11:21:42', '2014-06-29 10:30:05', '', '冀东启明科技有限公司');
INSERT INTO `rv_user` VALUES ('4', 'test1', '5a105e8b9d40e1329780d62ea2265d8a', '3', '22', '2014-07-02 13:04:32', '2014-07-17 14:34:50', '', '冀东启明科技有限公司');
INSERT INTO `rv_user` VALUES ('9', '123', '202cb962ac59075b964b07152d234b70', '3', '22', '2014-07-17 14:56:00', '2014-07-17 19:32:16', '', '冀东启明科技有限公司');
INSERT INTO `rv_user` VALUES ('10', 'hmc', 'cf82a9577f8e6fa17ce3ccf4daaf94e9', '6', '', '2014-08-18 16:40:10', '2014-08-18 16:43:05', '', '冀东启明科技有限公司');
INSERT INTO `rv_user` VALUES ('11', 'test2', '202cb962ac59075b964b07152d234b70', '1', '', '2014-10-08 09:45:16', null, '', '冀东启明科技有限公司');
INSERT INTO `rv_user` VALUES ('12', '111', '202cb962ac59075b964b07152d234b70', '2', '', '2014-10-09 15:59:25', '2014-10-09 16:10:03', '张三', '冀东启明科技有限公司');
INSERT INTO `rv_user` VALUES ('13', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', '1', '', '2014-10-11 09:34:23', null, '于工', '太原科技有限公司');
INSERT INTO `rv_user` VALUES ('14', 'admin2', 'e99a18c428cb38d5f260853678922e03', '1', '', '2014-10-14 13:59:06', '2014-12-18 17:38:05', '小于', '冀东启明');
INSERT INTO `rv_user` VALUES ('15', 'admin3', '32cacb2f994f6b42183a1300d9a3e8d6', '1', '', '2014-10-22 09:27:16', '2014-12-22 10:42:12', '李四', '冀东启明');
INSERT INTO `rv_user` VALUES ('16', '789', '68053af2923e00204c3ca7c6a3150cf7', '1', '', '2014-10-23 13:14:04', null, '123', '启明科技');
INSERT INTO `rv_user` VALUES ('17', 'haomacun', 'de9bb0fbd0ed6b2331201a30d85db35a', '1', '', '2014-11-24 13:04:20', '2014-12-22 10:42:21', 'haomacun', '启明科技');
INSERT INTO `rv_user` VALUES ('18', '1', 'c4ca4238a0b923820dcc509a6f75849b', '1', '', '2014-12-22 10:42:46', null, '1', '冀东启明');

-- ----------------------------
-- Table structure for `rv_weixiuproject`
-- ----------------------------
DROP TABLE IF EXISTS `rv_weixiuproject`;
CREATE TABLE `rv_weixiuproject` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL COMMENT '维修项目名称',
  `price` decimal(20,2) NOT NULL COMMENT '价格',
  `company1` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_weixiuproject
-- ----------------------------
INSERT INTO `rv_weixiuproject` VALUES ('2', '熄火', '20.00', '冀东启明');

-- ----------------------------
-- Table structure for `rv_weixiuresult`
-- ----------------------------
DROP TABLE IF EXISTS `rv_weixiuresult`;
CREATE TABLE `rv_weixiuresult` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL COMMENT '维修人员',
  `weixiuproject` varchar(100) NOT NULL COMMENT '维修项目',
  `price` decimal(20,2) NOT NULL,
  `date` varchar(20) default NULL COMMENT '日期',
  `beizhu` varchar(200) default NULL COMMENT '备注',
  `company1` varchar(100) NOT NULL COMMENT '所属分公司',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rv_weixiuresult
-- ----------------------------
INSERT INTO `rv_weixiuresult` VALUES ('1', 'jg', '熄火', '20.00', '2014-12-29', '给', '冀东启明');
INSERT INTO `rv_weixiuresult` VALUES ('2', 'sa', '熄火', '10.00', '2014-12-15', null, '冀东启明');
INSERT INTO `rv_weixiuresult` VALUES ('3', 'jg', '熄火', '11.00', '2014-12-14', null, '冀东启明');
INSERT INTO `rv_weixiuresult` VALUES ('4', 'jg', 'sa', '30.00', '2014-12-11', null, '冀东启明');
