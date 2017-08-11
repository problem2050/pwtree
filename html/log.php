<?php

$lastLogger_1 = SeasLog::getLastLogger();

//SeasLog::setBasePath("/var/log/pwtree");

SeasLog::log(SEASLOG_ERROR,'this is a error test by ::log');

$basePath_1 = SeasLog::getBasePath();


var_dump($lastLogger_1);

var_dump($basePath_1);

?>
