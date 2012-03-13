<?php
/**************************************************************************************
Created by :Anu
Created on :28-2-2011
Purpose    :Manage Campaign
**************************************************************************************/
require_once 'init.php';err_status("init.php included");

$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
if($obj->getRealAction()	==	"Copy")		$obj->setAction("Copydata");
$obj->executeAction(array("loadData"=>true));
loadView();
?>
