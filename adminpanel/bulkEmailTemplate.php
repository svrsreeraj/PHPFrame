<?php
/**************************************************************************************
Created by 		:	Jitha
Created on 		:	2010-12-30
Purpose    		:	Bulk email templates managing
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Bulk Email Templates");err_status("header included");

$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Add New")		{$obj->setAction("Addformbtn");}
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('bulkEmailTemplate.tpl.html');
?>
