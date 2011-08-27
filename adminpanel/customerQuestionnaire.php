<?php
/****************************************************************************************
Created by	:	hari krishna
Created on	:	2010-12-3
Purpose		:	Manage Customers
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Customer Questionnaire");err_status("header included");
$obj	=	loadModelClass(true);
if($obj->getRealAction()	==	"Delete")	$obj->setAction("Deletedata");
if($obj->getRealAction()	==	"Search")	$obj->setAction("Search");
$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('customerQuestionnaire.tpl.html');

?>