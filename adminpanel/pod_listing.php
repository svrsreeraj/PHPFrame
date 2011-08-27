<?php
/**************************************************************************************
Created by 		:	Jitha
Created on 		:	2010-12-30
Purpose    		:	Bulk email templates managing
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("POD Coupons");err_status("header included");

$obj	=	loadModelClass(true);


if($obj->getRealAction()	==	"Update")		$obj->setAction("Updatedata");
if($obj->getRealAction()	==	"Add New")		$obj->setAction("Addnew");

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('pod_listing.tpl.html');
?>
