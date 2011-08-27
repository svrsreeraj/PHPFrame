<?php
/**************************************************************************************
Created by 		:	Jitha
Created on 		:	2010-12-29
Purpose    		:	Bulk email managing
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Bulk Emails");err_status("header included");

$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Add New")		{$obj->setAction("Addformbtn");}
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
if($obj->getRealAction()	==	"Upload CSV")	$obj->setAction("Uploadcsv");
if($obj->getRealAction()	==	"Upload")		$obj->setAction("Uploaddata");

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('bulkEmail.tpl.html');
?>
