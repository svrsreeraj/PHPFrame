<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-11-30
Purpose		:	Manage Customers
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Customer Invites");err_status("header included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Delete")	$obj->setAction("Deletedata");

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('customerInvites.tpl.html');
?>