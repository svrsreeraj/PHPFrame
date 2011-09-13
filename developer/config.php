<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	2011-10-12
Description	:	This is admin home page after login
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Admin Home");err_status("header included");

$obj	=	loadModelClass(false);
$obj->executeAction();




$smarty->assign('obj',$obj);
$smarty->display('config.tpl.html');
?>
