<?php
/**************************************************************************************
Created By 	:	Anith M .S
Created On	:	2010-11-19
Description	:	This is error page
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
$objCls     = new adminUser();
$smarty->assign("objCls",$objCls);
$smarty->display('noPermission.tpl.html');
?>
