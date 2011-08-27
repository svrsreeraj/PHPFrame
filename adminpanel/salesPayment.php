<?php
/**************************************************************************************
Created by :Hari Krishna
Created on :2010-11-16
Purpose    :Sales Payment Tranaction
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Sales Agent Payments");err_status("header included");
$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Pay Now")		$obj->setAction("Pay");

$obj->executeAction();					
$smarty->assign('obj',$obj);
$smarty->display('salesPayment.tpl.html');
?>
