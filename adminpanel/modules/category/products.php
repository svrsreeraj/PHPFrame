<?php
/**************************************************************************************
Created By 	:	Maria 
Created On	:	2011-09-20
Purpose		:	Manage Product Section
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj		=	loadModelClass(true);
$cls		=	new categoryModule();
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
$obj->executeAction(array("loadData"=>true));
loadView();
?>
