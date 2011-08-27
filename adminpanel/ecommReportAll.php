<?php
/****************************************************************************************
Created by	:	Meghna
Created on	:	2010-12-07
Purpose		:	Manage Ecommerce Report
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Ecommerce Orders");err_status("header included");
$obj	=	loadModelClass(true);

if($obj->getRealAction()	==	"Search")		
	{
		if($_POST["runningAction"]	==	"Transall")		$obj->setAction("Transallsearch");
		if($_POST["runningAction"]	==	"Transdaily")	$obj->setAction("Transdailysearch");
		if($_POST["runningAction"]	==	"Transmonthly")	$obj->setAction("Transmonthlysearch");
		if($_POST["runningAction"]	==	"Transyearly")	$obj->setAction("Transyearlysearch");
		if($_POST["runningAction"]	==	"Transcomplete")$obj->setAction("Transcompletesearch");
	}
if($obj->getRealAction()	==	"Reset")		
	{
		if($_POST["runningAction"]	==	"Transall")		$obj->setAction("Transallreset");
		if($_POST["runningAction"]	==	"Transdaily")	$obj->setAction("Transdailyreset");
		if($_POST["runningAction"]	==	"Transmonthly")	$obj->setAction("Transmonthlyreset");
		if($_POST["runningAction"]	==	"Transyearly")	$obj->setAction("Transyearlyreset");
		if($_POST["runningAction"]	==	"Transcomplete")$obj->setAction("Transcompletereset");
	}
if($obj->getRealAction()	==	"Csv")		
	{
		if($_GET["runningAction"]	==	"Transall")		$obj->setAction("Transallcsv");
		if($_GET["runningAction"]	==	"Transdaily")	$obj->setAction("Transdailycsv");
		if($_GET["runningAction"]	==	"Transmonthly")	$obj->setAction("Transmonthlycsv");
		if($_GET["runningAction"]	==	"Transyearly")	$obj->setAction("Transyearlycsv");
	}
if($obj->getRealAction()	==	"Paid")		$obj->setAction("Setpaid");
if($obj->getRealAction()	==	"Not Paid")	$obj->setAction("Setnotpaid");
$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('ecommReportAll.tpl.html');

?>