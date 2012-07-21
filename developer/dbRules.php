<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	2011-07-17
Description	:	Defining the Rules
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(true);
$obj->executeAction(array("loadData"=>true));
loadView();
?>
