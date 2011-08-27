<?php
/**************************************************************************************
Created By 	:	Anith M .S
Created On	:	2010-11-5
Description	:	This is mainly for a admin to login
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(true);
$obj->executeAction();
//$obj->redirectPage($obj->getLink("","adminHome.php",false));
$smarty->assign('TPL_MSG',$_SESSION['sess_message']);
$_SESSION['sess_message']	=	"";
$smarty->assign('obj',$obj);
$smarty->display('forgotPassword.tpl.html');
?>
