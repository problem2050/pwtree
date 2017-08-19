CREATE TABLE `pw_category` (
  `f_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT  'ID',
  `f_category` varchar(50) NOT NULL COMMENT 'À±ðÆ,
  `f_about` varchar(200) DEFAULT NULL COMMENT 'ÃÊ',
  `f_siteid` varchar(50) NOT NULL COMMENT 'վµã',
  `f_merid` varchar(30) NOT NULL COMMENT 'É»§ID',  
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='վµã';

