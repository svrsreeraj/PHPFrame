<?php
/****************************************************************************************
Created by	:	Mahinsha T.K
Created on	:	2010-12-02
Purpose		:	Manage Ecomm Ordes
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Ecommerce order Details");err_status("header included");
$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Update")	$obj->setAction("Updatedata");
if($obj->getRealAction()	==	"Delete")	$obj->setAction("Deletedata");

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('ecomOrderDetails.tpl.html');

?>