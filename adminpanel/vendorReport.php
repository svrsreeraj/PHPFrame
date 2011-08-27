<?php
/****************************************************************************************
Created by	:	hari Krishna
Created on	:	2010-12-29
Purpose		:	Manage Vendor Report
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Vendor Report");err_status("header included");
$obj	=	loadModelClass(true);

if($obj->getRealAction()			==	"Search")		
	{
		if($_POST["runningAction"]	==	"Daily")			$obj->setAction("Transdailysearch");
		if($_POST["runningAction"]	==	"Monthly")			$obj->setAction("Transmonthlysearch");
		if($_POST["runningAction"]	==	"Yearly")			$obj->setAction("Transyearlysearch");
		if($_POST["runningAction"]	==	"Consolidated")		$obj->setAction("Transconsolidatedsearch");
	}
if($obj->getRealAction()		==	"Reset")		
	{
		if($_POST["runningAction"]	==	"Daily")			$obj->setAction("Transdailyreset");
		if($_POST["runningAction"]	==	"Monthly")			$obj->setAction("Transmonthlyreset");
		if($_POST["runningAction"]	==	"Yearly")			$obj->setAction("Transyearlyreset");
		if($_POST["runningAction"]	==	"Consolidated")		$obj->setAction("TransConsolidatedreset");
	}
if($obj->getRealAction()			==	"Getcsv")		
	{
		if($_GET["runningAction"]	==	"Daily")			$obj->setAction("Transdailycsv");
		if($_GET["runningAction"]	==	"Yearly")			$obj->setAction("Transmonthlycsv");
		if($_GET["runningAction"]	==	"Monthly")			$obj->setAction("Transmonthlycsv");
		if($_GET["runningAction"]	==	"Consolidated")		$obj->setAction("TransConsolidatedcsv");
	}

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('vendorReport.tpl.html');

?>