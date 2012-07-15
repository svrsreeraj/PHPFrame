<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2010-11-04
Purpose    :Including Classes
**************************************************************************************/

//include module classes
$modulesObj			=	new moduleclass();
$allModules			=	$modulesObj->getModulesListWithStatus();
$installedArr		=	array();
$modulesClsFiles	=	array();
foreach($allModules	as	$key=>$val)	
	{
		if($val["status"]["moduleInstalled"]	==	1)	$installedArr[]	=	$val["module"];
	}
foreach($installedArr	as	$key=>$val)
	{
		$tempModInit	=	CONST_SITE_ABSOLUTE_PATH.$modulesObj->moduleLocation.$val."/init.php";
		require_once($tempModInit);
	}
?>
