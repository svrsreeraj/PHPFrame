<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Ecomm Products
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Ecommerce Products");err_status("header included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Save")			$obj->setAction("Savedata");
if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
$obj->executeAction();
$cmsObj=new cms;
$smarty->assign('obj',$obj);
$smarty->display('ecommProduct.tpl.html');
?>
