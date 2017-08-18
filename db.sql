DROP FUNCTION IF EXISTS pwtree.queryChildrenForDown;
CREATE FUNCTION pwtree.`queryChildrenForDown`(nid INT) RETURNS varchar(4000) CHARSET latin1
BEGIN
DECLARE sTemp VARCHAR(4000);
DECLARE sTempChd VARCHAR(4000);

SET sTemp='0';
SET sTempChd = CAST(nid AS CHAR);

WHILE sTempChd IS NOT NULL DO
SET sTemp= CONCAT(sTemp,',',sTempChd);
SELECT GROUP_CONCAT(f_id) INTO sTempChd FROM pw_treenav WHERE FIND_IN_SET(f_parentid,sTempChd)>0;
END WHILE;
RETURN sTemp;
END;


DROP FUNCTION IF EXISTS pwtree.queryChildrenForUp;
CREATE FUNCTION pwtree.`queryChildrenForUp`(areaId INT) RETURNS varchar(4000) CHARSET utf8
BEGIN
DECLARE sTemp VARCHAR(4000);
DECLARE sTempChd VARCHAR(4000);

SET sTemp='0';
SET sTempChd = CAST(areaId AS CHAR);
SET sTemp = CONCAT(sTemp,',',sTempChd);

SELECT f_parentid INTO sTempChd FROM pw_treenav WHERE f_id = sTempChd;
WHILE sTempChd <> 0 DO
SET sTemp = CONCAT(sTemp,',',sTempChd);
SELECT f_parentid INTO sTempChd FROM pw_treenav WHERE f_id = sTempChd;
END WHILE;
RETURN  sTemp;
END;
