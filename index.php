<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	2010-12-14
Description	:	Home Test
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(true);
$obj->executeAction();
loadView();
?>
