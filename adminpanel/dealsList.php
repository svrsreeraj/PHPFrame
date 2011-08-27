<?php
/****************************************************************************************
Created by	:	M S Anith
Created on	:	2010-11-30
Purpose		:	Manage Deals
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Deals");err_status("header included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
if($obj->getRealAction()	==	"Delete")		$obj->setAction("Deletedata");

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('dealsList.tpl.html');

?>