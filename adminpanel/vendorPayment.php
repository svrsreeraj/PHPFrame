<?php
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-30
Purpose    :Vendor Payment Tranaction
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Vendor Payment");err_status("header included");
$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addformbtn");
if($obj->getRealAction()	==	"Pay Now")		$obj->setAction("Pay");
if($obj->getRealAction()	==	"Back")		    $obj->setAction("Fetchcancel");

$obj->executeAction();					
$smarty->assign('obj',$obj);
$smarty->display('vendorPayment.tpl.html');
?>
