<?php
/****************************************************************************************
Created by	:	hari krishna
Created on	:	2010-12-07
Purpose		:	manage customer report
****************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Customer Report");err_status("header included");
$obj		=	loadModelClass(true);

if($obj->getRealAction()	==	"Search")		
	{
		if($_POST["runningAction"]	==	"Transcomplete") 	$obj->setAction("Transcompletesearch");
		if($_POST["runningAction"]	==	"Daily") 			$obj->setAction("Transdailysearch");
		if($_POST["runningAction"]	==	"Monthly")			$obj->setAction("Transmonthlysearch");
		if($_POST["runningAction"]	==	"Yearly")			$obj->setAction("Transyearlysearch");
	
	}

if($obj->getRealAction()	==	"Reset")		
	{
		if($_POST["runningAction"]	==	"Transcomplete") 	$obj->setAction("Transcompletereset");
		if($_POST["runningAction"]	==	"Daily")			$obj->setAction("transdailyreset");
		if($_POST["runningAction"]	==	"Monthly")			$obj->setAction("Transmonthlyreset");
		if($_POST["runningAction"]	==	"Yearly")			$obj->setAction("Transyearlyreset");
		
	}


if($obj->getRealAction()	==	"Getcsv")
	{
		if($_GET["runningAction"]	==	"Transcomplete") 	$obj->setAction("Transcompletecsv");
		if($_GET["runningAction"]	==	"Daily")			$obj->setAction("Transdailycsv");
		if($_GET["runningAction"]	==	"Monthly")			$obj->setAction("Transmonthlycsv");
		if($_GET["runningAction"]	==	"Yearly")			$obj->setAction("Transyearlycsv");
	}

$obj->executeAction();

$smarty->assign('obj',$obj);
$smarty->display('customerReport.tpl.html');

?>