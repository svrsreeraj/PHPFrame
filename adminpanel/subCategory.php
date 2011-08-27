<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Sub Categories
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("SubCategories");err_status("header included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
$obj->executeAction();
$smarty->assign('obj',$obj);
$smarty->display('subCategory.tpl.html');
?>
