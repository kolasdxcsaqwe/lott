/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : v9ym

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2023-11-01 14:57:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `fn_lottery19`
-- ----------------------------
DROP TABLE IF EXISTS `fn_lottery19`;
CREATE TABLE `fn_lottery19` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) NOT NULL,
  `gameopen` text NOT NULL,
  `fanshui` varchar(255) NOT NULL DEFAULT 'false',
  `0027` text,
  `0126` text,
  `0225` text,
  `0324` text,
  `0423` text,
  `0522` text,
  `0621` text,
  `0720` text,
  `891819` text,
  `10111617` text,
  `1215` text,
  `1314` text,
  `jida` text,
  `jixiao` text,
  `baozi` text,
  `duizi` text,
  `shunzi` text,
  `dxds` text,
  `dadan` text,
  `xiaodan` text,
  `dashuang` text,
  `xiaoshuang` text,
  `dxds_zongzhu1` text,
  `dxds_1314_1` text,
  `dxds_zongzhu2` text,
  `dxds_1314_2` text,
  `dxds_zongzhu3` text,
  `dxds_1314_3` text,
  `zuhe_zongzhu1` text,
  `zuhe_1314_1` text,
  `zuhe_zongzhu2` text,
  `zuhe_1314_2` text,
  `zuhe_zongzhu3` text,
  `zuhe_1314_3` text,
  `danzhu_min` text,
  `zongzhu_max` text,
  `shuzi_max` text,
  `zuhe_max` text,
  `dxds_max` text,
  `jidx_max` text,
  `baozi_max` text,
  `shunzi_max` text,
  `duizi_max` text,
  `setting_shazuhe` text,
  `setting_fanxiangzuhe` text,
  `setting_tongxiangzuhe` text,
  `setting_liwai` text,
  `fengtime` int(11) DEFAULT NULL,
  `rules` text,
  `shenglv` varchar(100) DEFAULT '0' COMMENT '胜率',
  `kongzhi` varchar(100) DEFAULT '0' COMMENT '控制开关',
  `jsdiy` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10030 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fn_lottery19
-- ----------------------------
INSERT INTO `fn_lottery19` VALUES ('10029', '10029', 'true', 'false', '608', '228', '108', '68', '50', '39', '28', '22', '15', '13', '12', '12', '15', '15', '60', '3', '15', '2', '4.2', '4.6', '4.6', '4.2', '1', '1.8', '1000', '1.6', '10000', '1.2', '1', '1', '1000', '1', '', '1', '20', '20000', '10000', '100000', '100000', '100000', '5000', '10000', '100000', 'false', 'false', 'false', '', '30', '<div class=\"RuleT1\">【北京28】</div>\r\n<div class=\"RuleT2\">【游戏介绍】</div>\r\n北京28是PC蛋蛋首创的竞猜游戏。开奖号码源于国家福利彩票【国家福利彩票官网：bwlc.net】北京28开奖号码为三个（0 - 9）中随机产生的数字之和，总共有28种结果（0 - 27）。\r\n<br>\r\n<br>\r\n<div class=\"RuleT2\">北京28是根据什么开奖的？</div>\r\n北京28开奖结果来源于国家福利彩票北京快乐8开奖号码，北京快乐8每期开奖共开出20个数字，北京28将这20个开奖号码按照由小到大的顺序依次排列；取其1-6位开奖号码相加，和值的末位数作为北京28开奖第一个数值；取其7-12位开奖号码相加，和值的末位数作为北京28开奖第二个数值，取其13-18位开奖号码相加，和值的末位数作为北京28开奖第三个数值；三个数值相加即为北京28最终的开奖结果。<br>\r\n<br>\r\n例如：快乐8第\"641841\"期数据从小到大排序01,03,13,16,23,27,40,41,45,49,53,54,57,62,63,67,68,71,72,78<br>\r\n第一区[第1/2/3/4/5/6位数字] 1,3,13,16,23,27<br>\r\n计算：1+3+13+16+23+27= 83<br>\r\n结果为3<br>\r\n第二区[第7/8/9/10/11/12位数字] 40,41,45,49,53,54<br>\r\n计算：40+41+45+49+53+54= 282<br>\r\n结果为2<br>\r\n第三区[第13/14/15/16/17/18位数字] 57,62,63,67,68,71<br>\r\n计算：57+62+63+67+68+71= 388<br>\r\n结果为8<br>\r\n最终游戏开奖为：3+2+8=13<br>\r\n<br>\r\n<div class=\"RuleT2\">【相关资料】</div>\r\n【视频开奖官网】www.bwlc.net 或 http://www.uc3039.com/<br>\r\n【开奖时间】北京28为每天早上9:05至23:55，每5分钟一期，共179期。<br>\r\n<br>\r\n<div class=\"RuleT2\">【玩法】</div>\r\n<div class=\"RuleT3\">【猜特码大小单双】</div>\r\n<div class=\"RuleT3\">开出之号码小于或等于13为小，大于或等于14为大。开出的号码偶数为双，号码奇数为单。开出结果为13,14时大小单双赔含本1.5倍 </div>\r\n■奖历：含本2倍<br>\r\n■限额：50-30,000<br>\r\n■格式：大小单双+金额<br>\r\n　例：大100；单200<br>\r\n<div class=\"RuleT3\">【猜特码组合】</div>\r\n<div class=\"RuleT3\">开出之号码小于或等于13为小，大于或等于14为大，偶数为双，奇数为单，竞猜「大单」「小双」「小单」「大双」，共4种。开出结果为13,14时中组合回本</div>\r\n■奖历：<br>\r\n「小单」「大双」含本4.4倍<br>\r\n「大单」「小双」含本4倍<br>\r\n■限额：50-20,000<br>\r\n■格式：组合+金额<br>\r\n　例：大单100；小双200<br>\r\n<div class=\"RuleT3\">【猜和值(特码)数字】</div>\r\n<div class=\"RuleT3\">开出的三个号码加总为和值(特码)，可能的结果为0至27，以下赔率皆含本。</div>\r\n■奖历、限额：<br>\r\n00、27含本608倍，限额20-500<br>\r\n01、26含本228倍，限额20-1,000<br>\r\n02、25含本108倍，限额20-3,000<br>\r\n03、24含本68倍，限额20-5,000<br>\r\n04、23含本50倍，限额20-6,000<br>\r\n05、22含本39倍，限额20-8,000<br>\r\n06、21含本28倍，限额20-9,000<br>\r\n07、20含本22倍，限额20-10,000<br>\r\n08、19含本15倍，限额20-10,000<br>\r\n09、18含本15倍，限额20-10,000<br>\r\n10、17含本13倍，限额20-10,000<br>\r\n11、16含本13倍，限额20-10,000<br>\r\n12、13、14、15含本12倍，限额50-10,000<br>\r\n■格式：单点有效字眼：草or操or点or买or / 符号<br>\r\n　例：6草100，7操100，8点100，9买100<br>\r\n<div class=\"RuleT3\">【猜极大、极小】</div>\r\n<div class=\"RuleT3\">开出的三个号码加总为和值(特码)，可能的结果为0至27，00至05为极小，22至27为极大</div>\r\n■奖历：含本15倍<br>\r\n■限额：50-10,000<br>\r\n■格式：极大or极小+金额<br>\r\n　例：极大100；极小200<br>\r\n<div class=\"RuleT3\">【猜对子、顺子、豹子】</div>\r\n<div class=\"RuleT3\">以三个开奖数字为准，三个开奖数字任意两个数字相同为对子，三个相同的数字为豹子，三个相邻的数字为顺子（0-9个数字头尾不相连）</div>\r\n■奖历、限额：<br>\r\n对子含本3.5倍，限额50-30,000（豹子不属于对子）<br>\r\n顺子含本15倍，限额50-10,000<br>\r\n豹子含本61倍，限额50-3,000<br>\r\n例：<br>\r\n2+1+2、5+8+8 为对子<br>\r\n2+0+1、7+6+5 为顺子<br>\r\n8+9+0、9+1+0 不属于顺子<br>\r\n■格式：对子or顺子or豹子+金额 <br>\r\n　例：对子100，豹子200<br>\r\n<div class=\"RuleT2\">每期下注：总额15万封顶！</div>\r\n<br>\r\n<br>\r\n<div class=\"RuleT2\">若因任何无法抗拒之外力因素导致临时关盘，或是官网问题临时关盘，会员不得在没有下注的情况下以结果论的要求赔偿损失，所有投注皆以会员投注记录明细为主。</div>\r\n<div class=\"RuleT2\">若发现多个帐号为同一人所有，或同一帐号进行无风险投注，将永久取消帐号。本平台最终解释权归华人国际娱乐所有，并保留修改以上条款的最终权力。</div>', '0', '0', '');
