<?php
/**************************************************************************************
Created by :Meghna
Created on :2011-10-21
Purpose    :Defaults
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
$obj->executeAction(array("loadData"=>true));
loadView();
?>
