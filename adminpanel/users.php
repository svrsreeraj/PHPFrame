<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	2012-04-03
Description	:	Trainees
 **************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addform");
$obj->executeAction(array("loadData"=>true));
loadView();
?>
