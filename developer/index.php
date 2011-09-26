<?php
/**************************************************************************************
Created By 	:	Anith M .S
Created On	:	2010-11-5
Description	:	This is mainly for a admin to login
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(false);
$obj->executeAction(array("loadData"=>true));
$smarty->assign('TPL_MSG',$_SESSION['sess_message']);
$_SESSION['sess_message']	=	"";
loadView();
?>
