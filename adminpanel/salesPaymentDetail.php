<?php
/**************************************************************************************
Created by :M S Anith
Created on :2010-11-29
Purpose    :Sales Payment Tranaction Details
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Sales Payment Tranaction Details");err_status("header included");
$obj	=	loadModelClass(true);

$obj->executeAction();					
$smarty->assign('obj',$obj);
$smarty->display('salesPaymentDetail.tpl.html');
?>
