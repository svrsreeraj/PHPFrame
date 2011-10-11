<?php
/**************************************************************************************
Created by :Hari Krishna
Created on :2010-12-2
Purpose    :changePassword
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Change")		$obj->setAction("Change");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
$obj->executeAction(array("loadData"=>true));
loadView();
?>
