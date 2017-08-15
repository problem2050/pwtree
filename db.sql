CREATE TABLE `pw_site` (
  `aw_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `aw_sitename` varchar(30) NOT NULL,
  `aw_staticpath` varchar(200) DEFAULT NULL,
  `aw_siteurl` varchar(30) NOT NULL,
  PRIMARY KEY (`aw_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

