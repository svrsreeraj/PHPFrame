<?php
/**************************************************************************************
Created by 	:Anith M.S
Created on 	:2010-11-09
Purpose     : Add/Edit submenus to the page
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Page Settings");err_status("header included");	

$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
 
$obj->executeAction();
$smarty->assign('obj',$obj);
$smarty->display('pageSettings.tpl.html');
?>



