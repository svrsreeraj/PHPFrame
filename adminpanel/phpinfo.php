<?php
/**************************************************************************************
Created By 	:	Anith M .S
Created On	:	2010-11-05
Description	:	PHP Information
**************************************************************************************/
require_once 'init.php';err_status("init.php included");

$cls_db->db_query("SET time_zone = '+05:30'");
$temp	=	$cls_db->getdbcontents_sql("SELECT @@global.time_zone, @@session.time_zone;");


echo "<br>".date('l jS \of F Y h:i:s A');
date_default_timezone_set('Pacific/Fiji');
echo "<br>".date('l jS \of F Y h:i:s A');


phpinfo();

?>
