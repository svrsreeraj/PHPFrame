<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2010-11-04
Purpose    :Testing page
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
//header_view();err_status("header included");
$obj	=	loadModelClass(false);
$obj->executeAction();
$smarty->assign('x',$obj);
if($_REQUEST["json"]	==	"true")
	{
		echo json_encode(array("name"=>"sreeraj",array("post"=>$_POST),array("get"=>$_GET),array("server"=>$_SERVER)));exit;	
	}
$smarty->display('testSreeraj.tpl.html');

?>
