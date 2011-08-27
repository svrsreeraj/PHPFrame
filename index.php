<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	2010-12-14
Description	:	Home Test
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Home");err_status("header included");
$obj	=	loadModelClass(true);
$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('index.tpl.html');
?>
