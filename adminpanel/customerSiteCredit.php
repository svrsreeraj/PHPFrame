<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-12-02
Purpose		:	Manage Customers
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Customer Sitecredits");err_status("header included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Delete")	$obj->setAction("Deletedata");

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('customerSiteCredit.tpl.html');

?>