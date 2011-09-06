<?php
/**************************************************************************************
Created By 	:	Anith M .S
Created On	:	2010-11-16
Description	:	This is admin home page after login
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Admin Home");err_status("header included");

$obj	=	loadModelClass(true);
$obj->executeAction();




$smarty->assign('obj',$obj);
$smarty->display('adminHome.tpl.html');
?>
