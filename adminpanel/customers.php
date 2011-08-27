<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-11-24
Purpose		:	Manage Customers
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Customers");err_status("header included");
$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Update")	$obj->setAction("Updatedata");
if($obj->getRealAction()	==	"Delete")	$obj->setAction("Deletedata");

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('customers.tpl.html');
?>