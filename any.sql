# Host: 127.0.0.1  (Version: 5.5.5-10.1.8-MariaDB)
# Date: 2016-04-20 21:09:32
# Generator: MySQL-Front 5.3  (Build 4.214)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "yfdyf_consult"
#

DROP TABLE IF EXISTS `yfdyf_consult`;
CREATE TABLE `yfdyf_consult` (
  `consult_id` int(11) NOT NULL AUTO_INCREMENT,
  `platform` enum('yhd','jd','tmall','yfdyf','other') DEFAULT NULL,
  `status` enum('review','pass','end') DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `realname` varchar(30) DEFAULT NULL,
  `tellphone` varchar(30) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `check_remark` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `edittime` int(11) DEFAULT NULL,
  PRIMARY KEY (`consult_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "yfdyf_consult"
#

/*!40000 ALTER TABLE `yfdyf_consult` DISABLE KEYS */;
INSERT INTO `yfdyf_consult` VALUES (1,'yhd','review','啥事颠三倒四','周杰伦','17821891287','976038747@qq.com','河北省石家庄市长安区','2016-04-20 20:36:41','的所得税的所得税说到底是多少',NULL,'http://127.0.0.1/ydcopy/admin/uploads/images/vqECL6RvIQ0.87357600 1461155710.jpg,http://127.0.0.1/ydcopy/admin/uploads/images/xATjcg5ive0.24449500 1461155776.jpg','请回复',NULL),(2,'tmall','review','有个库存错误','李再试','18739222323','233232323@cc.odd','北京市市辖区东城区','2016-04-20 20:40:11','撒飒飒',NULL,NULL,'sssss',NULL),(3,'yhd','review','颠三倒四','徐峰','19832322302','xiangruitang@163.com','辽宁省大连市西岗区','2016-04-20 20:40:51','颠倒是非而大多数',NULL,NULL,'32323232',NULL),(4,'yhd','pass','3232322332','查询','13223323232','jcklsdkl@sls.com','吉林省白山市靖宇县','2016-04-20 20:41:38','233232222222222222','已审查','http://127.0.0.1/ydcopy/admin/uploads/images/QGYNdFVDrL0.77699900 1461156091.jpg','ssasa',1461156327);
/*!40000 ALTER TABLE `yfdyf_consult` ENABLE KEYS */;

#
# Structure for table "yfdyf_task"
#

DROP TABLE IF EXISTS `yfdyf_task`;
CREATE TABLE `yfdyf_task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `platform` enum('yhd','jd','tmall','yfdyf','other') DEFAULT NULL COMMENT '平台',
  `title` varchar(30) DEFAULT NULL COMMENT '标题',
  `status` enum('on','finished') DEFAULT 'on' COMMENT '状态',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `edittime` int(11) DEFAULT NULL COMMENT '修改时间',
  `expire_time` int(11) DEFAULT NULL COMMENT '期望时间',
  `author` varchar(40) DEFAULT NULL COMMENT '提出人',
  `department_id` varchar(255) DEFAULT NULL COMMENT '部门',
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='任务表';

#
# Data for table "yfdyf_task"
#

/*!40000 ALTER TABLE `yfdyf_task` DISABLE KEYS */;
INSERT INTO `yfdyf_task` VALUES (3,'yhd','是是是','finished',1461069231,NULL,1461069231,'85FEFD18-2B81-4189-9116-A5760094CE96',''),(6,'tmall','第三个','on',1461070346,1461073523,1459440000,'85FEFD18-2B81-4189-9116-A5760094CE96',''),(7,'other','第四个测试','finished',1461136075,NULL,1459612800,'85FEFD18-2B81-4189-9116-A5760094CE96',NULL);
/*!40000 ALTER TABLE `yfdyf_task` ENABLE KEYS */;

#
# Structure for table "yfdyf_task_detail"
#

DROP TABLE IF EXISTS `yfdyf_task_detail`;
CREATE TABLE `yfdyf_task_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` varchar(255) DEFAULT NULL COMMENT '对应的任务',
  `status` enum('on','finished') DEFAULT NULL COMMENT '状态',
  `currentone` varchar(40) DEFAULT NULL COMMENT '当前人',
  `order` tinyint(3) DEFAULT NULL,
  `current_department` varchar(40) DEFAULT NULL COMMENT '当前部门',
  `lastone` varchar(40) DEFAULT NULL COMMENT '上一个',
  `rank` tinyint(3) DEFAULT NULL COMMENT '优先级',
  `op_time` int(11) DEFAULT NULL,
  `edittime` int(11) DEFAULT NULL COMMENT '修改时间',
  `nextone` varchar(40) DEFAULT NULL COMMENT '下一个',
  `addons` varchar(255) DEFAULT NULL COMMENT '附件部分',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `expire_time` int(11) DEFAULT NULL COMMENT '预计时间',
  PRIMARY KEY (`detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='任务流程表';

#
# Data for table "yfdyf_task_detail"
#

/*!40000 ALTER TABLE `yfdyf_task_detail` DISABLE KEYS */;
INSERT INTO `yfdyf_task_detail` VALUES (2,'3','finished','85FEFD18-2B81-4189-9116-A5760094CE96',1,'',NULL,NULL,NULL,0,'72EBA6ED-E3DD-445B-88CB-A5940102555B','','环境的借款收到借款',1461069231),(3,'3','finished','72EBA6ED-E3DD-445B-88CB-A5940102555B',2,'90A0C5B9-BBC1-475F-976B-A5EC010168D0','85FEFD18-2B81-4189-9116-A5760094CE96',124,1459526400,1461120643,'3DDAA423-C4AF-4418-A1A3-A5E700FBF134','','点对点',1459440000),(6,'6','finished','85FEFD18-2B81-4189-9116-A5760094CE96',1,'',NULL,NULL,NULL,1461073523,'1D45C1A5-C417-4257-B9AD-A5A1011E44AB','http://127.0.0.1/ydcopy/admin/uploads/addons/IXJXllcTLg0.20885700 1461073165.jpg,','第三个测试点对点',1459440000),(7,'6','on','1D45C1A5-C417-4257-B9AD-A5A1011E44AB',2,'90A0C5B9-BBC1-475F-976B-A5EC010168D0','80EC6331-2FB4-4328-BD1C-A5EC0101CE6A',NULL,NULL,NULL,NULL,'','',NULL),(8,'3','finished','3DDAA423-C4AF-4418-A1A3-A5E700FBF134',3,'90A0C5B9-BBC1-475F-976B-A5EC010168D0','72EBA6ED-E3DD-445B-88CB-A5940102555B',NULL,NULL,1461132338,NULL,'','已经完成',NULL),(9,'7','finished','85FEFD18-2B81-4189-9116-A5760094CE96',1,NULL,NULL,NULL,NULL,NULL,'1D45C1A5-C417-4257-B9AD-A5A1011E44AB','http://127.0.0.1/ydcopy/admin/uploads/addons/9bMLQqkI4k0.21452600 1461136065.jpg','第四个测试飒飒',1459612800),(10,'7','finished','1D45C1A5-C417-4257-B9AD-A5A1011E44AB',2,'90A0C5B9-BBC1-475F-976B-A5EC010168D0',NULL,12,1460217600,1461136312,NULL,'','撒飒飒飒飒',1460217600),(11,'7','finished','369E2F74-E670-4B60-9CEC-A57301159F0C',3,'8C631F03-BA3D-48C2-B69A-A5EC01017DC3','1D45C1A5-C417-4257-B9AD-A5A1011E44AB',NULL,NULL,1461136474,NULL,'','已经完成',NULL);
/*!40000 ALTER TABLE `yfdyf_task_detail` ENABLE KEYS */;
