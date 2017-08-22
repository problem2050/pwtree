-- MySQL dump 10.14  Distrib 5.5.52-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pwtree
-- ------------------------------------------------------
-- Server version	5.5.52-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pw_category`
--

DROP TABLE IF EXISTS `pw_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_category` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `f_category` varchar(50) NOT NULL COMMENT '类别名称',
  `f_about` varchar(200) DEFAULT NULL COMMENT '描述',
  `f_siteid` varchar(50) NOT NULL COMMENT '站点ID',
  `f_merid` varchar(30) NOT NULL COMMENT '商户ID',
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='站点表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_category`
--

LOCK TABLES `pw_category` WRITE;
/*!40000 ALTER TABLE `pw_category` DISABLE KEYS */;
INSERT INTO `pw_category` VALUES (3,'系统权限','系统','10000','10001'),(4,'业务权限','业务','10000','10001');
/*!40000 ALTER TABLE `pw_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_dept`
--

DROP TABLE IF EXISTS `pw_dept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_dept` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `f_department` varchar(64) DEFAULT NULL COMMENT '部门名称',
  `f_about` varchar(64) DEFAULT NULL COMMENT '部门描述',
  `f_merid` bigint(20) DEFAULT NULL COMMENT '商户ID',
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_dept`
--

LOCK TABLES `pw_dept` WRITE;
/*!40000 ALTER TABLE `pw_dept` DISABLE KEYS */;
INSERT INTO `pw_dept` VALUES (1,'开发','开发',100001),(2,'财务','财务',100001),(3,'产品','产品',100001),(4,'运营','运营',100001);
/*!40000 ALTER TABLE `pw_dept` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_groupitem`
--

DROP TABLE IF EXISTS `pw_groupitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_groupitem` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `f_groupid` bigint(20) NOT NULL,
  `f_permissionid` bigint(20) NOT NULL,
  `f_merid` bigint(20) DEFAULT NULL COMMENT '商户ID',
  PRIMARY KEY (`f_id`),
  KEY `f_groupid` (`f_groupid`),
  CONSTRAINT `pw_groupitem_ibfk_1` FOREIGN KEY (`f_groupid`) REFERENCES `pw_permissiongroup` (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_groupitem`
--

LOCK TABLES `pw_groupitem` WRITE;
/*!40000 ALTER TABLE `pw_groupitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `pw_groupitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_merinfo`
--

DROP TABLE IF EXISTS `pw_merinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_merinfo` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `f_usermoney` bigint(20) NOT NULL COMMENT '商户余额',
  `f_username` varchar(50) NOT NULL COMMENT '用户名',
  `f_truename` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `f_entname` varchar(50) DEFAULT NULL COMMENT '企业名称',
  `f_userpwd` varchar(50) NOT NULL DEFAULT 'c33367701511b4f6020ec61ded352059' COMMENT '123456',
  `f_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `f_lastdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `f_valid` int(11) NOT NULL COMMENT '是否有效',
  `f_lastip` varchar(30) DEFAULT NULL COMMENT '最后登录IP',
  `f_pwdtime` timestamp NULL DEFAULT NULL COMMENT '密码修改时间',
  `f_address` int(11) DEFAULT NULL COMMENT '地址',
  `f_usertype` varchar(50) DEFAULT NULL COMMENT '个人/企业',
  `f_telnet` varchar(50) DEFAULT NULL COMMENT '电话',
  `f_mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `f_email` varchar(50) DEFAULT NULL COMMENT 'EMAIL',
  PRIMARY KEY (`f_id`),
  UNIQUE KEY `idx_username` (`f_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_merinfo`
--

LOCK TABLES `pw_merinfo` WRITE;
/*!40000 ALTER TABLE `pw_merinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `pw_merinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_permission`
--

DROP TABLE IF EXISTS `pw_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_permission` (
  `f_id` bigint(20) NOT NULL COMMENT '权限ID',
  `f_name` varchar(50) NOT NULL COMMENT '权限名称',
  `f_about` varchar(3500) DEFAULT NULL COMMENT '权限描述',
  `f_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `f_siteid` bigint(20) DEFAULT NULL COMMENT '站点id',
  `f_cateid` bigint(20) DEFAULT NULL COMMENT '权限分类',
  `f_treenavid` bigint(20) DEFAULT NULL COMMENT '权限ID对应的节点ID',
  `f_merid` bigint(20) DEFAULT NULL COMMENT '商户ID',
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限ID表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_permission`
--

LOCK TABLES `pw_permission` WRITE;
/*!40000 ALTER TABLE `pw_permission` DISABLE KEYS */;
INSERT INTO `pw_permission` VALUES (1000011,'test01','about','2017-08-22 12:49:05',10000,0,3000009,10001),(1000016,'r001','r1','2017-08-22 11:39:45',10000,3,3000010,10001),(1000017,'u001','u01','2017-08-22 11:59:38',10000,4,3000012,10001),(1000018,'u0001','uuu','2017-08-22 12:55:12',10000,3,3000014,10001),(1000019,'u0002','uuu','2017-08-22 12:55:14',10000,3,3000014,10001),(1000020,'u0003','uuu','2017-08-22 12:55:17',10000,3,3000014,10001),(1000021,'u0004','uuu','2017-08-22 12:55:20',10000,3,3000014,10001),(1000022,'u0005','uuu','2017-08-22 12:55:24',10000,3,3000014,10001),(1000023,'u20001','111','2017-08-22 12:57:35',10000,3,3000013,10001),(1000024,'u20002','111','2017-08-22 12:57:39',10000,3,3000013,10001),(1000025,'u1A0001','','2017-08-22 12:58:12',10000,3,3000012,10001),(1000026,'u0004','','2017-08-22 12:58:40',10000,3,3000013,10001),(1000027,'u0006','11','2017-08-22 13:00:37',10000,3,3000013,10001),(1000028,'r2201','rr','2017-08-22 13:06:58',10000,3,3000010,10001),(1000029,'rr001','w','2017-08-22 13:07:31',10000,3,3000010,10001),(1000030,'rr002','w','2017-08-22 13:07:38',10000,3,3000010,10001),(1000031,'www','ww','2017-08-22 13:09:08',10000,3,3000013,10001),(1000032,'eee888','wyyy','2017-08-22 14:05:06',10000,4,3000012,10001),(1000033,'qqq','wq','2017-08-22 13:11:51',10000,3,3000012,10001),(1000034,'qqq22','wq','2017-08-22 13:17:00',10000,3,3000012,10001),(1000039,'ttcc','tt','2017-08-22 13:46:36',10000,3,3000009,10001),(1000045,'www','eee','2017-08-22 13:51:11',10000,3,3000010,10001),(1000046,'www','eee','2017-08-22 13:51:16',10000,3,3000010,10001),(1000047,'ttww','tww','2017-08-22 13:52:00',10000,3,3000009,10001),(1000048,'ttww','tww','2017-08-22 13:52:04',10000,3,3000009,10001),(1000049,'kkk','kk','2017-08-22 13:53:44',10000,3,3000009,10001),(1000050,'bb','bb','2017-08-22 13:55:15',10000,3,3000009,10001),(1000051,'ggg','ggg','2017-08-22 14:01:19',10000,3,3000009,10001),(1000055,'popo','','2017-08-22 14:03:10',10000,3,3000009,10001),(1000056,'popo','','2017-08-22 14:03:12',10000,3,3000009,10001),(1000059,'pp01','','2017-08-22 15:16:39',10000,3,3000026,10001),(1000060,'pp02','','2017-08-22 15:16:49',10000,3,3000026,10001),(1000061,'pp03','','2017-08-22 15:16:53',10000,3,3000026,10001),(1000062,'ppppp999','9','2017-08-22 16:38:16',10000,3,3000026,10001),(1000063,'这是测试UIDooo','9','2017-08-22 16:38:45',10000,3,3000026,10001);
/*!40000 ALTER TABLE `pw_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_permission_treenav`
--

DROP TABLE IF EXISTS `pw_permission_treenav`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_permission_treenav` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `f_userid` bigint(20) NOT NULL COMMENT '用户ID',
  `f_treenavid` bigint(20) DEFAULT NULL COMMENT '树ID',
  `f_siteid` bigint(20) NOT NULL COMMENT '站点ID',
  `f_permissionid` bigint(20) DEFAULT NULL COMMENT '权限ID',
  `f_merid` bigint(20) NOT NULL COMMENT '商户ID',
  `f_groupid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限树表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_permission_treenav`
--

LOCK TABLES `pw_permission_treenav` WRITE;
/*!40000 ALTER TABLE `pw_permission_treenav` DISABLE KEYS */;
/*!40000 ALTER TABLE `pw_permission_treenav` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_permissiongroup`
--

DROP TABLE IF EXISTS `pw_permissiongroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_permissiongroup` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `f_userid` bigint(20) NOT NULL,
  `f_siteid` bigint(20) DEFAULT NULL COMMENT '站点ID',
  `f_merid` bigint(20) DEFAULT NULL COMMENT '站点ID',
  `f_groupid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_permissiongroup`
--

LOCK TABLES `pw_permissiongroup` WRITE;
/*!40000 ALTER TABLE `pw_permissiongroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `pw_permissiongroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_sequence`
--

DROP TABLE IF EXISTS `pw_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_sequence` (
  `name` varchar(50) NOT NULL,
  `current_value` bigint(20) NOT NULL,
  `increment` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_sequence`
--

LOCK TABLES `pw_sequence` WRITE;
/*!40000 ALTER TABLE `pw_sequence` DISABLE KEYS */;
INSERT INTO `pw_sequence` VALUES ('pw_permission',1000063,1),('pw_treenav',3000026,1);
/*!40000 ALTER TABLE `pw_sequence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_sites`
--

DROP TABLE IF EXISTS `pw_sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_sites` (
  `f_id` bigint(20) NOT NULL COMMENT '站点ID',
  `f_sitename` varchar(30) NOT NULL COMMENT '站点名称',
  `f_staticpath` varchar(200) DEFAULT NULL COMMENT 'XML存储路径',
  `f_sitedomain` varchar(30) NOT NULL COMMENT '站点域名',
  `f_merid` varchar(30) NOT NULL COMMENT '商户ID',
  `f_about` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_sites`
--

LOCK TABLES `pw_sites` WRITE;
/*!40000 ALTER TABLE `pw_sites` DISABLE KEYS */;
INSERT INTO `pw_sites` VALUES (10000,'finance',NULL,'finance.boss.com','10001','finance'),(10009,'admin',NULL,'admin.boss.com','10001','admin');
/*!40000 ALTER TABLE `pw_sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_treenav`
--

DROP TABLE IF EXISTS `pw_treenav`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_treenav` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `f_parentid` bigint(20) NOT NULL COMMENT '父节点ID',
  `f_name` varchar(100) NOT NULL COMMENT '节点名称',
  `f_path` varchar(200) DEFAULT NULL COMMENT '连接路径',
  `f_rootid` int(11) NOT NULL,
  `f_divno` bigint(20) NOT NULL COMMENT '层次',
  `f_orderno` bigint(20) NOT NULL COMMENT '排序ID',
  `f_merid` bigint(20) DEFAULT NULL COMMENT '商户ID',
  `f_displayorderno` bigint(11) DEFAULT NULL,
  `f_classpath` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000012031 DEFAULT CHARSET=utf8 COMMENT='目录树表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_treenav`
--

LOCK TABLES `pw_treenav` WRITE;
/*!40000 ALTER TABLE `pw_treenav` DISABLE KEYS */;
INSERT INTO `pw_treenav` VALUES (10000,0,'finance','',0,0,0,10001,0,''),(10009,0,'admin','',0,0,0,10001,0,''),(3000005,10000,'report','',0,0,0,10001,NULL,''),(3000006,10000,'user','',0,0,0,10001,NULL,''),(3000007,10000,'other','',0,0,0,10001,NULL,''),(3000008,10000,'sns','',0,0,0,10001,NULL,''),(3000009,3000005,'r1','#',0,0,0,10001,NULL,''),(3000010,3000005,'r2','#',0,0,0,10001,NULL,''),(3000011,3000005,'r3','#',0,0,0,10001,NULL,''),(3000012,3000006,'u1','#',0,0,0,10001,NULL,''),(3000013,3000006,'u2','#',0,0,0,10001,NULL,''),(3000014,3000006,'u3','#',0,0,0,10001,NULL,''),(3000015,10009,'setting','',0,0,0,10001,NULL,''),(3000016,10009,'login','',0,0,0,10001,NULL,''),(3000017,10009,'logout','',0,0,0,10001,NULL,''),(3000018,10009,'about','',0,0,0,10001,NULL,''),(3000019,3000015,'s1','#',0,0,0,10001,NULL,''),(3000020,3000015,'s2','#',0,0,0,10001,NULL,''),(3000021,3000015,'s3','#',0,0,0,10001,NULL,''),(3000022,3000016,'log1','#',0,0,0,10001,NULL,''),(3000023,3000016,'log','#',0,0,0,10001,NULL,''),(3000024,3000018,'info','#',0,0,0,10001,NULL,''),(3000025,3000005,'report2','',0,0,0,10001,NULL,''),(3000026,3000025,'port2','#',0,0,0,10001,NULL,'');
/*!40000 ALTER TABLE `pw_treenav` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_user_group`
--

DROP TABLE IF EXISTS `pw_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_user_group` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `f_groupname` varchar(64) DEFAULT NULL COMMENT '组名称',
  `f_about` varchar(200) DEFAULT NULL COMMENT '拥有者',
  `f_siteid` int(11) DEFAULT NULL COMMENT '部门',
  `f_merid` bigint(20) DEFAULT NULL COMMENT '商户ID',
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户分组标签';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_user_group`
--

LOCK TABLES `pw_user_group` WRITE;
/*!40000 ALTER TABLE `pw_user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `pw_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_userinfo`
--

DROP TABLE IF EXISTS `pw_userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_userinfo` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `f_username` varchar(50) NOT NULL COMMENT '用户名',
  `f_truename` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `f_userpwd` varchar(50) NOT NULL DEFAULT 'c33367701511b4f6020ec61ded352059' COMMENT '123456',
  `f_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `f_lastdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `f_valid` int(11) NOT NULL COMMENT '是否有效',
  `f_lastip` varchar(30) DEFAULT NULL COMMENT '最后登录IP',
  `f_pwdtime` timestamp NULL DEFAULT NULL COMMENT '密码修改时间',
  `f_department` int(11) DEFAULT NULL COMMENT '部门id',
  `f_merid` varchar(50) DEFAULT NULL COMMENT '商户id',
  `f_mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `f_email` varchar(50) DEFAULT NULL COMMENT 'EMAIL',
  PRIMARY KEY (`f_id`),
  UNIQUE KEY `idx_username` (`f_username`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_userinfo`
--

LOCK TABLES `pw_userinfo` WRITE;
/*!40000 ALTER TABLE `pw_userinfo` DISABLE KEYS */;
INSERT INTO `pw_userinfo` VALUES (1,'test001','许文强','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,2,'10001','18927484228','ww@qq.com'),(2,'test002','刘备','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,2,'10001','18927484228','liub@qq.com'),(4,'test003','张飞','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,2,'10001','18927484228','zahngf@qq.com'),(5,'test004','赵云','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,2,'10001','18927484228','zhaoyun@qq.com'),(7,'test005','关羽','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,2,'10001','18927484228','guanyu@qq.com'),(8,'test006','魏延','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,1,'10001','18927484228','weiyan@qq.com'),(9,'test007','吕布','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,3,'10001','18927484228','lvb@qq.com'),(10,'test008','李典','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,3,'10001','18927484228','lid@qq.com'),(11,'test009','曹操','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,3,'10001','18927484228','caoc@qq.com'),(12,'test010','夏候渊','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,1,'10001','18927484228','xiah@qq.com'),(13,'test011','姜维','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(14,'test012','诸葛亮','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(16,'test013','郭嘉','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(18,'test014','许攸','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(19,'test015','孙权','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(20,'test016','孙策','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(21,'test017','颜良','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(23,'test018','文丑','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,1,'10001','18927484228','jianw@qq.com'),(25,'test019','马超','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(26,'test021','黄盖','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(28,'test022','陆逊','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,4,'10001','18927484228','jianw@qq.com'),(29,'test023','庞统','123456','2017-08-22 16:15:34','2017-08-22 15:28:11',0,NULL,NULL,1,'10001','18927484228','jianw@qq.com');
/*!40000 ALTER TABLE `pw_userinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) DEFAULT NULL,
  `label` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,'ssssa'),(2,'ttt'),(3,'tttwwww'),(5,'vv'),(5,'vv'),(5,'vv'),(5,'vv'),(5,'vv'),(5,'vv'),(5,'vv'),(5,'vv'),(99,'yyyy'),(99,'yyyy'),(99,'yyyy'),(5,'vv'),(5,'vv'),(5,'vv');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-23  1:09:11
