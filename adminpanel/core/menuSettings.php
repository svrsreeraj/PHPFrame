<?php
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-15
Purpose    :Leftmenu Settings
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
$obj->executeAction(array("loadData"=>true));
loadView();
?>
