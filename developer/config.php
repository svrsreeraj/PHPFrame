<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	2011-10-12
Description	:	This is admin home page after login
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(true);
$obj->executeAction(array("loadData"=>true));
loadView();
?>
