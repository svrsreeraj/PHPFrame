<?php
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-15
Purpose    :Leftmenu Settinga
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Menu Settings");err_status("header included");
$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");

$obj->executeAction();


$smarty->assign('obj',$obj);
$smarty->display('menuSettings.tpl.html');
?>
