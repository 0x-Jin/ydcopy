# Host: 192.168.235.112  (Version: 5.6.12-log)
# Date: 2016-05-11 15:56:07
# Generator: MySQL-Front 5.3  (Build 4.214)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "sdb_base_queue"
#

DROP TABLE IF EXISTS `sdb_base_queue`;
CREATE TABLE `sdb_base_queue` (
  `queue_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `queue_title` varchar(50) NOT NULL,
  `status` enum('running','hibernate','paused','failure') NOT NULL DEFAULT 'hibernate',
  `worker` varchar(200) NOT NULL,
  `start_time` int(10) unsigned NOT NULL,
  `worker_active` int(10) unsigned DEFAULT NULL,
  `total` mediumint(8) unsigned DEFAULT NULL,
  `remaining` mediumint(8) unsigned DEFAULT NULL,
  `cursor_id` varchar(255) NOT NULL DEFAULT '0',
  `runkey` char(32) DEFAULT NULL,
  `task_name` varchar(50) DEFAULT NULL,
  `params` longtext NOT NULL,
  `errmsg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`queue_id`),
  KEY `ind_worker` (`worker`),
  KEY `ind_worker_active` (`worker_active`),
  KEY `ind_status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=13132 DEFAULT CHARSET=utf8;

#
# Data for table "sdb_base_queue"
#

/*!40000 ALTER TABLE `sdb_base_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `sdb_base_queue` ENABLE KEYS */;
